<div class="well">
<h2><?php _e('Shopping cart', 'wosci-language'); ?></h2>
<p id="message" class="margin-top">

<?php if ($cart->count_contents() == 0) { ?>

<div class="alert alert-warning" id="cart-empty"><?php _e('Your Shopping Cart is Empty.', 'wosci-language'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="alert-link"><?php _e('Continue Shopping', 'wosci-language'); ?></a></div>

<?php }else{ ?>

<div class="alert alert-warning" id="cart-empty" style="display:none;"><?php _e('Your Shopping Cart is Empty.', 'wosci-language'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="alert-link"><?php _e('Continue Shopping', 'wosci-language'); ?></a></div>

<?php } ?>
</p>
<?php
  if ($cart->count_contents() > 0) {
?>
      <table class="table table-hover table-responsive">
<thead>
          <tr>
            <th><?php _e('Remove', 'wosci-language'); ?></th>
            <th><?php _e('Product Name', 'wosci-language'); ?></th>
            <th><?php _e('Product Image', 'wosci-language'); ?></th>
            <th><?php _e('Quantity', 'wosci-language'); ?></th>
            <th><?php _e('Price', 'wosci-language'); ?></th>
          </tr>
        </thead>
        
<?php
/*    $info_box_contents = array();
    $info_box_contents[0][] = array('align' => 'center',
                                    'params' => 'class="productListing-heading"',
                                    'text' => '<h3 class="widget-title">'.TABLE_HEADING_REMOVE.'</h3>');

    $info_box_contents[0][] = array('params' => 'class="productListing-heading"',
                                    'text' => '<h3 class="widget-title">'.TABLE_HEADING_PRODUCTS.'</h3>');

    $info_box_contents[0][] = array('align' => 'center',
                                    'params' => 'class="productListing-heading"',
                                    'text' => '<h3 class="widget-title">'.TABLE_HEADING_QUANTITY.'</h3>');

    $info_box_contents[0][] = array('align' => 'right',
                                    'params' => 'style="width:100px;" class="productListing-heading"',
                                    'text' => '<h3 class="widget-title">'.TABLE_HEADING_TOTAL.'</h3>');*/

    $any_out_of_stock = 0;
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
// Push all attributes information in an array
      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        while (list($option, $value) = each($products[$i]['attributes'])) {
          echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . (int)$products[$i]['id'] . "'
                                       and pa.options_id = '" . (int)$option . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . (int)$value . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . (int)$languages_id . "'
                                       and poval.language_id = '" . (int)$languages_id . "'");
          $attributes_values = tep_db_fetch_array($attributes);

          $products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
          $products[$i][$option]['options_values_id'] = $value;
          $products[$i][$option]['products_options_values_name'] = $attributes_values['products_options_values_name'];
          $products[$i][$option]['options_values_price'] = $attributes_values['options_values_price'];
          $products[$i][$option]['price_prefix'] = $attributes_values['price_prefix'];
        }
      }
    }

    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
    
    $jq_slctr = str_replace("{", "_", str_replace("}", "_", $products[$i]['id']));//for jQuery selectors

     
      if (($i/2) == floor($i/2)) {
        $info_box_contents[] = array('params' => 'class="productListing-even urun'.$jq_slctr.'"');
      } else {
        $info_box_contents[] = array('params' => 'class="productListing-odd urun'.$jq_slctr.'"');
      }

      $cur_row = sizeof($info_box_contents) - 1;

      $info_box_contents[$cur_row][] = array('align' => 'center',
                                             'params' => '',
                                             'text' => '<div style="line-height:50px;display:table-cell;vertical-align:middle;" class="listingbutton" data-prodid="'.$products[$i]['id'].'" data-jq_slctr="'.$jq_slctr.'" id="sepettenurunsil" >
                                             <img class="trashcan" src="'.get_bloginfo('template_url').'/trash.png"></div>');

	$info_box_contents[$cur_row][] = array('align' => 'center',
                                             'params' => '',
                                             'text' => '<div style="line-height:50px;display:table-cell;vertical-align:middle;"><a href="' . get_permalink($products[$i]['id']) . '">' . $products[$i]['name'] . '</a></div>');


      $products_name = '<a href="' . get_permalink($products[$i]['id']) . '">'  . $products[$i]['image'] . '</a>' ;

      if (STOCK_CHECK == 'true') {
        $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
        if (tep_not_null($stock_check)) {
          $any_out_of_stock = 1;

          $products_name .= $stock_check;
        }
      }

      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        reset($products[$i]['attributes']);
        while (list($option, $value) = each($products[$i]['attributes'])) {
          $products_name .= '<br><small><i> - ' . $products[$i][$option]['products_options_name'] . ' ' . $products[$i][$option]['products_options_values_name'] . '</i></small>';
        }
      }

      $products_name .= '';

      $info_box_contents[$cur_row][] = array('params' => '',
                                             'text' => '<div >'.$products_name.'</div>');

      $info_box_contents[$cur_row][] = array('align' => 'center',
                                             'params' => '',
                                             'text' => '<div style="line-height:50px;vertical-align:middle;">'.tep_draw_form('cart_quantity', '','','id="cart_quantity'.$jq_slctr.'"').'<input name="cart_quantity[]" type="number" step="1" min="1" data-id="'.$products[$i]['id'].'" id="'.$jq_slctr.'" value="'.$products[$i]['quantity'].'" class="abcd btn btn-default" style="width:58px;">' . tep_draw_hidden_field('products_id[]', $products[$i]['id']).tep_draw_hidden_field('jq_slctr', $jq_slctr,'id="jq_slctr"').tep_draw_hidden_field('tax_class_id', $products[$i]['tax_class_id']).tep_draw_hidden_field('final_price', $products[$i]['final_price']).tep_draw_hidden_field('currency', $products[$i]['currency']).'</form></div>');

      $info_box_contents[$cur_row][] = array('align' => 'right',
                                             'params' => '',
                                             'text' => '<div style="line-height:50px;vertical-align:middle;"><span style="" id="jq_slctr_'.$jq_slctr.'">' . $currencies->display_price($products[$i]['currency'], $products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) . '</span></div>');

	
echo '<tr class="urun'.$jq_slctr.'"><td>'.$info_box_contents[$i][0][text].'</td>  <td>'.$info_box_contents[$i][1][text].'</td> <td>'.$info_box_contents[$i][2][text].'</td> <td>'.$info_box_contents[$i][3][text].'</td> <td>'.$info_box_contents[$i][4][text].'</td> </tr>';

	


    }

//print_r($info_box_contents);
    

?>
        </table>
      
       <p style="float:right;" id="sub_txt"><?php echo __('Subtotal', 'wosci-language'); ?>: <b><span id="sub_total"><?php echo $currencies->format($cart->show_total()); ?></span></b></p>
      
<?php
    if ($any_out_of_stock == 1) {
      if (STOCK_ALLOW_CHECKOUT == 'true') {
?>
     
        <div class="stockWarning" align="center"><br><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>
     
<?php
      } else {
?>
      
        <div class="stockWarning" align="center"><br><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>
      
<?php
      }
    }
?>
     
      <table id="actionbuttons" border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
               
                <td style="padding:20px;" class="main"></td>
<?php
    $back = sizeof($navigation->path)-2;
    if (isset($navigation->path[$back])) {
?>
                <td class="main" align="center"><?php /*echo '<a href="' . tep_href_link($navigation->path[$back]['page'], tep_array_to_string($navigation->path[$back]['get'], array('action')), $navigation->path[$back]['mode']) . '" class="sbutton big bo2">' . _('Continue Shopping') . '</a>'; */?></td>
<?php
    }
?>
                <td align="right" class="main"><div class="margin-top"></div><?php echo '<a href="'.esc_url( home_url( '/' ) ).'shipping-payment" class="btn btn-primary btn-success">'; ?> <span class="glyphicon glyphicon-arrow-right"></span> <?php echo __('Checkout', 'wosci-language');?></a><div class="margin-top"></div></td>
               
              </tr>
            </table>
<?php
    $initialize_checkout_methods = $payment_modules->checkout_initialization_method();

    if (!empty($initialize_checkout_methods)) {
?>
      <div>
        <div></div>
      </div>
      <div>
        <div align="right" class="main" style="padding-right: 50px;"><?php echo TEXT_ALTERNATIVE_CHECKOUT_METHODS; ?></div>
      </div>
<?php
      reset($initialize_checkout_methods);
      while (list(, $value) = each($initialize_checkout_methods)) {
?>
      <div>
        <div></div>
      </div>
      <div>
        <div align="right" class="main"><?php echo $value; ?></div>
      </div>
<?php
      }
    }
  }
?>
</div><!-- .well -->