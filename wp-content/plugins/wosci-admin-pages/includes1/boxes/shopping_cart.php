<?php
/*
  $Id: shopping_cart.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
global $cart,$currencies,$customer_id;
  $cart_contents_string = '';
  if ($cart->count_contents() > 0) {
?>
<!-- shopping_cart //-->

<?php
  $info_box_contents = array();
 // $info_box_contents[] = array('text' => BOX_HEADING_SHOPPING_CART);

//  new infoBoxHeading($info_box_contents, false, true, tep_href_link(FILENAME_SHOPPING_CART));


  

  
    $cart_contents_string = '<table style="padding-top:10px;" border="0" cellspacing="0" cellpadding="0">';
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $cart_contents_string .= '<tr><td align="right" valign="top">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $cart_contents_string .= '<span class="newItemInCart">';
      } else {
        $cart_contents_string .= '<span>';
      }

      $cart_contents_string .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top"><a href="' . tep_href_link('?', 'p=' . $products[$i]['id']) . '">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $cart_contents_string .= '<span class="newItemInCart">';
      } else {
        $cart_contents_string .= '<span>';
      }

      $cart_contents_string .= $products[$i]['name'] . '</span></a></td></tr>';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        tep_session_unregister('new_products_id_in_cart');
      }
    }
    $cart_contents_string .= '</table>';
   

  $info_box_contents = array();
  $info_box_contents[] = array('text' => $cart_contents_string);

  if ($cart->count_contents() > 0) {
    $info_box_contents[] = array('text' => '<div style="border-bottom:#666666 solid thin;"></div>');
    $info_box_contents[] = array('align' => 'right',
                                 'text' => $currencies->format($cart->show_total()));
  }
/*
// Start - CREDIT CLASS Gift Voucher Contribution
  if (tep_session_is_registered('customer_id')) {
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $gv_result = tep_db_fetch_array($gv_query);
  
    if ($gv_result['amount'] > 0 ) {
      $info_box_contents[] = array('align' => 'left','text' => '<div style="border-bottom:#666666 solid thin;"></div>');
      $info_box_contents[] = array('align' => 'left','text' => '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext">' . VOUCHER_BALANCE . '</td><td class="smalltext" align="right" valign="bottom">' . $currencies->format($gv_result['amount']) . '</td></tr></table>');
      $info_box_contents[] = array('align' => 'left','text' => '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext"><a href="'. tep_href_link(FILENAME_GV_SEND) . '">' . BOX_SEND_TO_FRIEND . '</a></td></tr></table>');
    }
  }
  if (tep_session_is_registered('gv_id')) {
    $gv_query = tep_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
    $coupon = tep_db_fetch_array($gv_query);
    $info_box_contents[] = array('align' => 'left','text' => '<div style="border-bottom:#666666 solid thin;"></div>');
    $info_box_contents[] = array('align' => 'left','text' => '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext">' . VOUCHER_REDEEMED . '</td><td class="smalltext" align="right" valign="bottom">' . $currencies->format($coupon['coupon_amount']) . '</td></tr></table>');

  }
if (tep_session_is_registered('cc_id') && $cc_id) {
 $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $cc_id . "'");
 $coupon = tep_db_fetch_array($coupon_query);
 $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_id . "' and language_id = '" . $languages_id . "'");
 $coupon_desc = tep_db_fetch_array($coupon_desc_query);
 $text_coupon_help = sprintf("%s",$coupon_desc['coupon_name']);
   $info_box_contents[] = array('align' => 'left','text' => '<div style="border-bottom:#666666 solid thin;"></div>');
   $info_box_contents[] = array('align' => 'left','text' => '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td>' . CART_COUPON . $text_coupon_help . '<br>' . '</td></tr></table>');
   }  
// End - CREDIT CLASS Gift Voucher Contribution
*/
echo $cart_contents_string;
echo '<div style="padding:3px;border-bottom:#666666 solid thin;"></div>';
echo '<div style="text-align:right;">'.$currencies->format($cart->show_total()).'</div>';
//  new infoBox($info_box_contents);
?>



          <?php } ?>
<!-- shopping_cart_eof //-->
