<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class shoppingCart {
    var $contents, $total, $weight, $cartID, $content_type;

    function shoppingCart() {
      $this->reset();
    }

    function restore_contents() {
      global $current_user;
      
	if ( $current_user->ID === 0 ){ return false; }
	if ( $current_user->ID == 0 ){ return false; }
	if ( $current_user->ID == '0' ){ return false; }

// insert current cart contents in database
      if (is_array($this->contents)) {
        reset($this->contents);
        
        // BOF SPPC attribute hide/invalid check: loop through the shopping cart and check the attributes if they
// are hidden for the now logged-in customer
      $this->cg_id = $this->get_customer_group_id();
        while (list($products_id, ) = each($this->contents)) {
					// only check attributes if they are set for the product in the cart
				   if (isset($this->contents[$products_id]['attributes'])) {
				$check_attributes_query = tep_db_query("select options_id, options_values_id, IF(find_in_set('" . $this->cg_id . "', attributes_hide_from_groups) = 0, '0', '1') as hide_attr_status from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . tep_get_prid($products_id) . "'");
				while ($_check_attributes = tep_db_fetch_array($check_attributes_query)) {
					$check_attributes[] = $_check_attributes;
				} // end while ($_check_attributes = tep_db_fetch_array($check_attributes_query))
				$no_of_check_attributes = count($check_attributes);
				$change_products_id = '0';

				foreach($this->contents[$products_id]['attributes'] as $attr_option => $attr_option_value) {
					$valid_option = '0';
					for ($x = 0; $x < $no_of_check_attributes ; $x++) {
						if ($attr_option == $check_attributes[$x]['options_id'] && $attr_option_value == $check_attributes[$x]['options_values_id']) {
							$valid_option = '1';
							if ($check_attributes[$x]['hide_attr_status'] == '1') {
							// delete hidden attributes from array attributes, change products_id accordingly later
							$change_products_id = '1';
							unset($this->contents[$products_id]['attributes'][$attr_option]);
							}
						} // end if ($attr_option == $check_attributes[$x]['options_id']....
					} // end for ($x = 0; $x < $no_of_check_attributes ; $x++)
					if ($valid_option == '0') {
						// after having gone through the options for this product and not having found a matching one
						// we can conclude that apparently this is not a valid option for this product so remove it
						unset($this->contents[$products_id]['attributes'][$attr_option]);
						// change products_id accordingly later
						$change_products_id = '1';
					}
				} // end foreach($this->contents[$products_id]['attributes'] as $attr_option => $attr_option_value)

          if ($change_products_id == '1') {
	           $original_products_id = $products_id;
	           $products_id = tep_get_prid($original_products_id);
	           $products_id = tep_get_uprid($products_id, $this->contents[$original_products_id]['attributes']);
						 // add the product without the hidden attributes to the cart
	           $this->contents[$products_id] = $this->contents[$original_products_id];
				     // delete the originally added product with the hidden attributes
	           unset($this->contents[$original_products_id]);
            }
				  } // end if (isset($this->contents[$products_id]['attributes']))
				} // end while (list($products_id, ) = each($this->contents))
       reset($this->contents); // reset the array otherwise the cart will be emptied
// EOF SPPC attribute hide/invalid check

        
        while (list($products_id, ) = each($this->contents)) {
          $qty = $this->contents[$products_id]['qty'];
          $product_query = tep_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($products_id) . "'");
          if (!tep_db_num_rows($product_query)) {
            tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$current_user->ID . "', '" . tep_db_input($products_id) . "', '" . tep_db_input($qty) . "', '" . date('Ymd') . "')");
            if (isset($this->contents[$products_id]['attributes'])) {
              reset($this->contents[$products_id]['attributes']);
              while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
                tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$current_user->ID . "', '" . tep_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "')");
              }
            }
          } else {
            tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . tep_db_input($qty) . "' where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($products_id) . "'");
          }
        }
      }

// reset per-session cart contents, but not the database contents
      $this->reset(false);

      $products_query = tep_db_query("select products_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$current_user->ID. "'");
      while ($products = tep_db_fetch_array($products_query)) {
        $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity']);
// attributes
        $attributes_query = tep_db_query("select products_options_id, products_options_value_id from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($products['products_id']) . "'");
        while ($attributes = tep_db_fetch_array($attributes_query)) {
          $this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
        }
      }

      $this->cleanup();
    }

    function reset($reset_database = false) {
      global $current_user;

      $this->contents = array();
      $this->total = 0;
      $this->weight = 0;
      $this->content_type = false;

      if (($current_user->ID != '0') && ($reset_database == true)) {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$current_user->ID . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$current_user->ID . "'");
      }

      unset($this->cartID);
      if (tep_session_is_registered('cartID')) tep_session_unregister('cartID');
    }

    function add_cart($products_id, $qty = '1', $attributes = '', $notify = true) {
      global $new_products_id_in_cart, $current_user;

      $products_id_string = tep_get_uprid($products_id, $attributes);
      $products_id = tep_get_prid($products_id_string);

      if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$qty > MAX_QTY_IN_CART)) {
        $qty = MAX_QTY_IN_CART;
      }

      $attributes_pass_check = true;

      if (is_array($attributes) && !empty($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          if (!is_numeric($option) || !is_numeric($value)) {
            $attributes_pass_check = false;
            break;
          } else {
            $check_query = tep_db_query("select products_attributes_id from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "' limit 1");
            if (tep_db_num_rows($check_query) < 1) {
              $attributes_pass_check = false;
              break;
            }
          }
        }
      } elseif (tep_has_product_attributes($products_id)) {
        $attributes_pass_check = false;
      }

      if (is_numeric($products_id) && is_numeric($qty) && ($attributes_pass_check == true)) {
        $check_product_query = tep_db_query("select post_status from wp_posts where ID = '" . (int)$products_id . "'");
        $check_product = tep_db_fetch_array($check_product_query);

        if (($check_product !== false) && ($check_product['post_status'] == 'publish')) {
          if ($notify == true) {
            $new_products_id_in_cart = $products_id;
            tep_session_register('new_products_id_in_cart');
          }

          if ($this->in_cart($products_id_string)) {
            $this->update_quantity($products_id_string, $qty, $attributes);
          } else {
            $this->contents[$products_id_string] = array('qty' => (int)$qty);
// insert into database
            if ( $current_user->ID != 0 ) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$current_user->ID . "', '" . tep_db_input($products_id_string) . "', '" . (int)$qty . "', '" . date('Ymd') . "')");

            if (is_array($attributes)) {
              reset($attributes);
              while (list($option, $value) = each($attributes)) {
                $this->contents[$products_id_string]['attributes'][$option] = $value;
// insert into database
                if ( $current_user->ID != 0 ) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$current_user->ID . "', '" . tep_db_input($products_id_string) . "', '" . (int)$option . "', '" . (int)$value . "')");
              }
            }
          }

          $this->cleanup();

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
          $this->cartID = $this->generate_cart_id();
        }
      }
    }

    function update_quantity($products_id, $quantity = '', $attributes = '') {
      global $current_user;

      $products_id_string = tep_get_uprid($products_id, $attributes);
      $products_id = tep_get_prid($products_id_string);

      if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$quantity > MAX_QTY_IN_CART)) {
        $quantity = MAX_QTY_IN_CART;
      }

      $attributes_pass_check = true;

      if (is_array($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          if (!is_numeric($option) || !is_numeric($value)) {
            $attributes_pass_check = false;
            break;
          }
        }
      }

      if (is_numeric($products_id) && isset($this->contents[$products_id_string]) && is_numeric($quantity) && ($attributes_pass_check == true)) {
        $this->contents[$products_id_string] = array('qty' => (int)$quantity);
// update database
        if ($current_user->ID != '0') tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . (int)$quantity . "' where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($products_id_string) . "'");

        if (is_array($attributes)) {
          reset($attributes);
          while (list($option, $value) = each($attributes)) {
            $this->contents[$products_id_string]['attributes'][$option] = $value;
// update database
            if ($current_user->ID != '0') tep_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " set products_options_value_id = '" . (int)$value . "' where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($products_id_string) . "' and products_options_id = '" . (int)$option . "'");
          }
        }
      }
    }

    function cleanup() {
      global $current_user;

      reset($this->contents);
      while (list($key,) = each($this->contents)) {
        if ($this->contents[$key]['qty'] < 1) {
          unset($this->contents[$key]);
// remove from database
          if ($current_user->ID != '0') {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($key) . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($key) . "'");
          }
        }
      }
    }

    function count_contents() {  // get total number of items in cart 
      $total_items = 0;
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $total_items += $this->get_quantity($products_id);
        }
      }

      return $total_items;
    }

    function get_quantity($products_id) {
      if (isset($this->contents[$products_id])) {
        return $this->contents[$products_id]['qty'];
      } else {
        return 0;
      }
    }

    function in_cart($products_id) {
      if (isset($this->contents[$products_id])) {
        return true;
      } else {
        return false;
      }
    }

    function remove($products_id) {
      global $current_user;

      unset($this->contents[$products_id]); 

// remove from database
      if ($current_user->ID != '0') {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($products_id) . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$current_user->ID . "' and products_id = '" . tep_db_input($products_id) . "'");
      }

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();
    }

    function remove_all() {
      $this->reset();
    }

    function get_product_id_list() {
      $product_id_list = '';
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $product_id_list .= ', ' . $products_id;
        }
      }

      return substr($product_id_list, 2);
    }

    function calculate() {
      global $currencies;
//print_r($this->contents);


      $this->total = 0;
      $this->weight = 0;
      if (!is_array($this->contents)) return 0;
// BOF Separate Pricing Per Customer
// global variable (session) $sppc_customer_group_id -> class variable cg_id
      $this->cg_id = $this->get_customer_group_id();
// EOF Separate Pricing Per Customer

      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $qty = $this->contents[$products_id]['qty'];
$f = get_post_custom_values('Price', $products_id); 
$pb = get_post_custom_values('Currency', $products_id); 
$postdata = get_post($products_id);
$postdata->post_title;

// products price
        $product_query = tep_db_query("select products_id, products_price, products_currency, products_tax_class_id, products_weight from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        if ($f) {
          $prid = $product['products_id']; 
          $t = get_post_custom_values('Tax_', $products_id);// products_tax_class_id
          $products_tax = tep_get_tax_rate($t[0]);
          $products_price = $f[0];
          $products_currency = $pb[0];//$product['products_currency'];
          $products_weight = $product['products_weight'];

// BOF Separate Pricing Per Customer
   $specials_price = tep_get_products_special_price((int)$prid);
      if (tep_not_null($specials_price)) {
	 $products_price = $specials_price;
      } elseif ($this->cg_id != 0){
        $customer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$prid . "' and customers_group_id =  '" . $this->cg_id . "'");
        if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
	//müþteri gruplarýna göre adet limitleri bazýnda indirimli fiyatlar - Price Breaks for SPPC BOF
        //$products_price = $customer_group_price['customers_group_price'];
	$raw_pr_arr = preg_split("/[=>,-]+/", $customer_group_price['customers_group_price']);
	$i=0;
	for ($ii=0;$ii<count($raw_pr_arr)/3;$ii++) {
	$pr['a'][]=$raw_pr_arr[$i];
	$pr['u'][]=$raw_pr_arr[$i+1];
	$pr['p'][]=$raw_pr_arr[$i+2];
	$i += 3;
	if ($this->contents[$products_id]['qty'] >= $pr['a'][$ii]){
	$products_price = $pr['p'][$ii];
	}
	}
	//müþteri gruplarýna göre adet limitleri bazýnda indirimli fiyatlar - Price Breaks for SPPC EOF
        }
      }
// EOF Separate Pricing Per Customer

          $this->total += $currencies->calculate_price($products_currency, $products_price, $products_tax, $qty);
          $this->weight += ($qty * $products_weight);
        }

// attributes price
// BOF SPPC attributes mod
        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
       $where = " AND ((";
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
         $where .= "options_id = '" . (int)$option . "' AND options_values_id = '" . (int)$value . "') OR (";
       }
       $where=substr($where, 0, -5) . ')';
    
       $attribute_price_query = tep_db_query("SELECT products_attributes_id, options_values_price, price_prefix FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id = '" . (int)$products_id . "'" . $where ."");

       if (tep_db_num_rows($attribute_price_query)) { 
	       $list_of_prdcts_attributes_id = '';
				 // empty array $attribute_price
				 $attribute_price = array();
	       while ($attributes_price_array = tep_db_fetch_array($attribute_price_query)) { 
		   $attribute_price[] =  $attributes_price_array;
		   $list_of_prdcts_attributes_id .= $attributes_price_array['products_attributes_id'].",";
            }
	       if (tep_not_null($list_of_prdcts_attributes_id) && $this->cg_id != '0') { 
         $select_list_of_prdcts_attributes_ids = "(" . substr($list_of_prdcts_attributes_id, 0 , -1) . ")";
	 $pag_query = tep_db_query("select products_attributes_id, options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES_GROUPS . " where products_attributes_id IN " . $select_list_of_prdcts_attributes_ids . " AND customers_group_id = '" . $this->cg_id . "'");
	 while ($pag_array = tep_db_fetch_array($pag_query)) {
		 $cg_attr_prices[] = $pag_array;
	 }

	 // substitute options_values_price and prefix for those for the customer group (if available)
	 if ($customer_group_id != '0' && tep_not_null($cg_attr_prices)) {
	    for ($n = 0 ; $n < count($attribute_price); $n++) {
		 for ($i = 0; $i < count($cg_attr_prices) ; $i++) {
			 if ($cg_attr_prices[$i]['products_attributes_id'] == $attribute_price[$n]['products_attributes_id']) {
				$attribute_price[$n]['price_prefix'] = $cg_attr_prices[$i]['price_prefix'];
				$attribute_price[$n]['options_values_price'] = $cg_attr_prices[$i]['options_values_price'];
			 }
		 } // end for ($i = 0; $i < count($cg_att_prices) ; $i++)
          }
        } // end if ($customer_group_id != '0' && (tep_not_null($cg_attr_prices))
      } // end if (tep_not_null($list_of_prdcts_attributes_id) && $customer_group_id != '0')
// now loop through array $attribute_price to add up/substract attribute prices

   for ($n = 0 ; $n < count($attribute_price); $n++) {
            if ($attribute_price[$n]['price_prefix'] == '+') {
              $this->total += $currencies->calculate_price($products_currency, $attribute_price[$n]['options_values_price'], $products_tax, $qty);
            } else {
              $this->total -= $currencies->calculate_price($products_currency, $attribute_price[$n]['options_values_price'], $products_tax, $qty);
        }
   } // end for ($n = 0 ; $n < count($attribute_price); $n++)
          } // end if (tep_db_num_rows($attribute_price_query))
        } // end if (isset($this->contents[$products_id]['attributes'])) 
      }
    }
// EOF SPPC attributes mod


    
// function attributes_price changed partially according to FalseDawn's post
// http://forums.oscommerce.com/index.php?showtopic=139587
// changed completely for Separate Pricing Per Customer, attributes mod
    function attributes_price($products_id) {
// global variable (session) $sppc_customer_group_id -> class variable cg_id
    $this->cg_id = $this->get_customer_group_id();
		
      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
       $where = " AND ((";
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
         $where .= "options_id = '" . (int)$option . "' AND options_values_id = '" . (int)$value . "') OR (";
       }
       $where=substr($where, 0, -5) . ')';
    
       $attribute_price_query = tep_db_query("SELECT products_attributes_id, options_values_price, price_prefix FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id = '" . (int)$products_id . "'" . $where ."");
 			 
      if (tep_db_num_rows($attribute_price_query)) {
	       $list_of_prdcts_attributes_id = '';
	       while ($attributes_price_array = tep_db_fetch_array($attribute_price_query)) { 
		   $attribute_price[] =  $attributes_price_array;
		   $list_of_prdcts_attributes_id .= $attributes_price_array['products_attributes_id'].",";
          }

	       if (tep_not_null($list_of_prdcts_attributes_id) && $this->cg_id != '0') { 
         $select_list_of_prdcts_attributes_ids = "(" . substr($list_of_prdcts_attributes_id, 0 , -1) . ")";
	 $pag_query = tep_db_query("select products_attributes_id, options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES_GROUPS . " where products_attributes_id IN " . $select_list_of_prdcts_attributes_ids . " AND customers_group_id = '" . $this->cg_id . "'");
	 while ($pag_array = tep_db_fetch_array($pag_query)) {
		 $cg_attr_prices[] = $pag_array;
	 }

	 // substitute options_values_price and prefix for those for the customer group (if available)
	 if ($customer_group_id != '0' && tep_not_null($cg_attr_prices)) {
	    for ($n = 0 ; $n < count($attribute_price); $n++) {
		 for ($i = 0; $i < count($cg_attr_prices) ; $i++) {
			 if ($cg_attr_prices[$i]['products_attributes_id'] == $attribute_price[$n]['products_attributes_id']) {
				$attribute_price[$n]['price_prefix'] = $cg_attr_prices[$i]['price_prefix'];
				$attribute_price[$n]['options_values_price'] = $cg_attr_prices[$i]['options_values_price'];
        }
		 } // end for ($i = 0; $i < count($cg_att_prices) ; $i++)
      }
        } // end if ($customer_group_id != '0' && (tep_not_null($cg_attr_prices))
      } // end if (tep_not_null($list_of_prdcts_attributes_id) && $customer_group_id != '0')
// now loop through array $attribute_price to add up/substract attribute prices

   for ($n = 0 ; $n < count($attribute_price); $n++) {
            if ($attribute_price[$n]['price_prefix'] == '+') {
              $attributes_price += $attribute_price[$n]['options_values_price'];
            } else {
              $attributes_price -= $attribute_price[$n]['options_values_price'];
            }
   } // end for ($n = 0 ; $n < count($attribute_price); $n++)
      return $attributes_price;
       } else { // end if (tep_db_num_rows($attribute_price_query))
         return 0;
       } 
     }  else { // end if (isset($this->contents[$products_id]['attributes']))
       return 0;
    }
   } // end of function attributes_price, modified for SPPC with attributes

    function get_products() {
      global $languages_id;
// BOF Separate Pricing Per Customer
  $this->cg_id = $this->get_customer_group_id();
// EOF Separate Pricing Per Customer

      if (!is_array($this->contents)) return false;

      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_model, p.products_image, p.products_price, p.products_currency, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$products_id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
       if ($this->contents) {
          $f = get_post_custom_values('Price', $products_id); 
          $pb = get_post_custom_values('Currency', $products_id); 
          $prid = $products['products_id'];
          $products_price = $f[0];
	  $products_currency = $pb[0];
// BOF Separate Pricing Per Customer
   $specials_price = tep_get_products_special_price($prid);
  if (tep_not_null($specials_price)) {
	 $products_price = $specials_price;
      } elseif ($this->cg_id != 0){
        $customer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$prid . "' and customers_group_id =  '" . $this->cg_id . "'");
        if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
	//müþteri gruplarýna göre adet limitleri bazýnda indirimli fiyatlar - Price Breaks for SPPC BOF
        //$products_price = $customer_group_price['customers_group_price'];
	$raw_pr_arr = preg_split("/[=>,-]+/", $customer_group_price['customers_group_price']);
	$i=0;
	for ($ii=0;$ii<count($raw_pr_arr)/3;$ii++) {
	$pr['a'][]=$raw_pr_arr[$i];
	$pr['u'][]=$raw_pr_arr[$i+1];
	$pr['p'][]=$raw_pr_arr[$i+2];
	$i += 3;
	if ($this->contents[$products_id]['qty'] >= $pr['a'][$ii]){
	$products_price = $pr['p'][$ii];
	}
	}
	//müþteri gruplarýna göre adet limitleri bazýnda indirimli fiyatlar - Price Breaks for SPPC EOF
        }
  }
// EOF Separate Pricing Per Customer

$f = get_post_custom_values('Price', $products_id); $t = get_post_custom_values('Tax_', $products_id); $sku = get_post_custom_values('SKU_', $products_id);

$postdata = get_post($products_id);
$postdata->post_title;
          $products_array[] = array('id' => $products_id,
                                    'name' => $postdata->post_title,
                                    'model' => $sku[0],
                                    'image' => get_the_post_thumbnail( (int) $products_id, array('40','40') ),
                                    'price' => $f[0],
                                    'currency' => $products_currency,
                                    'quantity' => $this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $t[0],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
        }
      }

      return $products_array;
    }

    function show_total() {
      $this->calculate();

      return $this->total;
    }

    function show_weight() {
      $this->calculate();

      return $this->weight;
    }

    function generate_cart_id($length = 5) {
      return tep_create_random_value($length, 'digits');
    }

    function get_content_type() {
      $this->content_type = false;

      if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);
            while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
              $virtual_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad where pa.products_id = '" . (int)$products_id . "' and pa.options_values_id = '" . (int)$value . "' and pa.products_attributes_id = pad.products_attributes_id");
              $virtual_check = tep_db_fetch_array($virtual_check_query);

              if ($virtual_check['total'] > 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }
          } else {
            switch ($this->content_type) {
              case 'virtual':
                $this->content_type = 'mixed';

                return $this->content_type;
                break;
              default:
                $this->content_type = 'physical';
                break;
            }
          }
        }
      } else {
        $this->content_type = 'physical';
      }

      return $this->content_type;
    }

    function unserialize($broken) {
      for(reset($broken);$kv=each($broken);) {
        $key=$kv['key'];
        if (gettype($this->$key)!="user function")
        $this->$key=$kv['value'];
      }
    }

// added for Separate Pricing Per Customer, returns customer_group_id
    function get_customer_group_id() {
      if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
        $_cg_id = $_SESSION['sppc_customer_group_id'];
      } else {
         $_cg_id = 0;
      }
      return $_cg_id;
    }


  }
?>
