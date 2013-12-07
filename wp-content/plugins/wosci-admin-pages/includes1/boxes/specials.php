<?php
/*
  $Id: specials.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
global $currencies,$languages_id,$customer_group_id;
  // BOF Separate Pricing Per Customer

//  global variable (session): $sppc_customers_group_id -> local variable $customer_group_id

  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
    $customer_group_id = '0';
  }

  if ($customer_group_id == '0')  {
      $random_product = tep_random_select("select p.products_id, pd.products_name, p.products_price,p.products_currency, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id = '0' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS);
  } else { // $sppc_customer_group_id is in the session variables, so must be set
      $random_product = tep_random_select("select p.products_id, pd.products_name, p.products_currency, IF(pg.customers_group_price IS NOT NULL,pg.customers_group_price, p.products_price) as products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s LEFT JOIN " . TABLE_PRODUCTS_GROUPS . " pg using (products_id, customers_group_id) where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id= '".$customer_group_id."' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS);
    }

  if (tep_not_null($random_product)) {
// EOF Separate Pricing Per Customer

?>
<!-- specials //-->
         
            
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_SPECIALS);

//    new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_SPECIALS));

   
    $info_box_content = '<table width="270" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><h3 class="widgettitle">'.BOX_HEADING_SPECIALS.'</h3></td>
  </tr>
  <tr>
    <td><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"].'&p=' . $random_product["products_id"]) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], 110, 110) . '</a></td>
    <td width="1">&nbsp;</td>
    <td class="T12"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id'].'&p=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br><s>' . $currencies->display_price($random_product['products_currency'], $random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . $currencies->display_price($random_product['products_currency'], $random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span></td>
  </tr>
  <tr>
    <td class="T11" colspan="3"><a href="specials.php">Diğer İndirimdekiler</a></td>
  </tr>
</table>';

//    new infoBox($info_box_contents);
?>

 
      <?php  echo '<table width="250" border="0" cellpadding="0" cellspacing="0">
 
  <tr>
    <td><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"].'&p=' . $random_product["products_id"]) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], 110, 110) . '</a></td>
    <td width="1">&nbsp;</td>
    <td class="T12"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id'].'&p=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br><s>' . $currencies->display_price($random_product['products_currency'], $random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . $currencies->display_price($random_product['products_currency'], $random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span></td>
  </tr>
  <tr>
    <td class="T11" style="padding-top:10px;" colspan="3"><a href="specials.php">'.OTHER_SPECIALS.'</a></td>
  </tr>
</table>'; ?>
        


            
            
            
          
<!-- specials_eof //-->
<?php
  }
?>
