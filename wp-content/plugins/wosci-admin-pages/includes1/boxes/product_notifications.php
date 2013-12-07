<?php
/*
  $Id: product_notifications.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
global $customer_id,$request_type;
  if (isset($_GET['products_id'])) {
?>
<!-- notifications //-->
         
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_NOTIFICATIONS);

//    new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL'));

    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$_GET['products_id'] . "' and customers_id = '" . (int)$customer_id . "'");
      $check = tep_db_fetch_array($check_query);

      $notification_exists = (($check['count'] > 0) ? true : false);
    } else {
      $notification_exists = false;
    }

    $info_box_contents = array();
    if ($notification_exists == true) {
      $info_box_contents =  '<table border="0" cellspacing="0" cellpadding="2"><tr><td><a href="' . tep_href_link(basename($_SERVER['PHP_SELF']), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', IMAGE_BUTTON_REMOVE_NOTIFICATIONS) . '</a></td><td><a href="' . tep_href_link(basename($_SERVER['PHP_SELF']), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY_REMOVE, tep_get_products_name($_GET['products_id'])) .'</a></td></tr></table>';
    } else {
      $info_box_contents =  '<table border="0" cellspacing="0" cellpadding="2"><tr><td><a href="' . tep_href_link(basename($_SERVER['PHP_SELF']), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', IMAGE_BUTTON_NOTIFICATIONS) . '</a></td><td><a href="' . tep_href_link(basename($_SERVER['PHP_SELF']), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, tep_get_products_name($_GET['products_id'])) .'</a></td></tr></table>';
    }

//    new infoBox($info_box_contents);
?>


   
        
       <?php echo $info_box_contents; ?>
        
   


<!-- notifications_eof //-->
<?php
  }
?>
