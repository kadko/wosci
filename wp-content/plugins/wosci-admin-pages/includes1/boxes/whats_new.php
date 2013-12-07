<?php
/*
  $Id: whats_new.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
global $currencies,$customer_group_id,  $languages_id;
  // BOF Separate Pricing Per Customer
  if ($random_product = tep_random_select("select p.products_id, p.products_image, p.products_tax_class_id, p.products_price, p.products_currency, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and pd.language_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id order by p.products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
?>
<!-- whats_new //-->
        
<?php
//    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);
// global variable (session) $sppc_customer_group_id -> local variable customer_group_id

  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
    $customer_group_id = '0';
  }

  if ($customer_group_id !='0') {
	$customer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $random_product['products_id'] . "' and customers_group_id =  '" . $customer_group_id . "'");
	  if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
	    $random_product['products_price'] = $customer_group_price['customers_group_price'];
	  }
  }
// EOF Separate Pricing Per Customer


    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_WHATS_NEW);

//    new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_PRODUCTS_NEW));

    if (tep_not_null($random_product['specials_new_products_price'])) {
      $whats_new_price = '<s>' . $currencies->display_price($random_product['products_currency'], $random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br>';
      $whats_new_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['products_currency'], $random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
    } else {
      $whats_new_price = $currencies->display_price($random_product['products_currency'], $random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id']));
    }

 
    $info_box_contents = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id'].'&p=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id'].'&p=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $whats_new_price;
                                 
echo    $info_box_contents;
?>
           



   

<!-- whats_new_eof //-->
<?php
  }
?>
