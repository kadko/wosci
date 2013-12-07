<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/


get_header();

?>
<?php
/*
  $Id: account_history_info.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

//  require('includes/application_top.php');
$languages_id = 1;
  if ( $current_user->ID == '0' ) {
    $navigation->set_snapshot();
    wp_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
  
  $customer_info_query = tep_db_query("select o.customers_id from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS . " s where o.orders_id = '". (int)$_GET['order_id'] . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1'");
  $customer_info = tep_db_fetch_array($customer_info_query);
  if ($customer_info['customers_id'] != $current_user->ID) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }




  $order = new order($_GET['order_id']);
?>
<?php /* Template Name: Wosci - Account History Info Page*/ ?>
<div class="well">

<?php include("inc/account-history-info-inc.php"); ?>
	
</div><!--.well-->
<?php get_footer(); ?>