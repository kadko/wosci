<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1><?php _e('Account History','wosci-language'); ?></h1></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
<?php
  $orders_total = tep_count_customer_orders($current_user->ID, false);

  if ($orders_total > 0) {
    $history_query_raw = "select o.orders_id, o.date_purchased, o.delivery_name, o.billing_name, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$current_user->ID . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1' order by orders_id DESC";
    $history_split = new splitPageResults($history_query_raw, MAX_DISPLAY_ORDER_HISTORY);
    $history_query = tep_db_query($history_split->sql_query);

    while ($history = tep_db_fetch_array($history_query)) {
      $products_query = tep_db_query("select products_id from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$history['orders_id'] . "'");
      
while ( $products = tep_db_fetch_array($products_query) ) {
$productsid[] = $products['products_id'];
}
      if (tep_not_null($history['delivery_name'])) {
        $order_type = __('Ship to:', 'wosci-language');
        $order_name = $history['delivery_name'];
      } else {
        $order_type = TEXT_ORDER_BILLED_TO;
        $order_name = $history['billing_name'];
      }
?>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="main"><?php _e('Order Number','wosci-language') ;?>: <b>#<?php echo $history['orders_id']; ?></b></td>
              <td class="main" align="right"><?php _e('Order Status','wosci-language'); ?>: <b><?php echo  $history['orders_status_name']; ?></b></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td><table border="0" width="100%" cellspacing="2" cellpadding="4">
                <tr>
                  <td class="main" width="50%" valign="top"><b><?php _e('Date','wosci-language'); ?>: </b> <small><?php echo tep_date_long($history['date_purchased']) . '</small><br><b>' . $order_type . '</b> ' . tep_output_string_protected($order_name); ?></td>
                  <td class="main" width="30%" valign="top"><b><?php _e('Products Qty','wosci-language') ;?>: </b><?php echo count($productsid) ;?><br><b><?php _e('Order Total','wosci-language'); ?></b>: <?php echo strip_tags($history['order_total']); ?></td>
                  <td class="main" width="20%" align="right"><div class="btn-group"><a class="btn btn-sm btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>pdf-invoice?order_id=<?php echo $history['orders_id']; ?>" target="_blank"><span class="glyphicon glyphicon-file"></span> <?php echo __('Printable Invoice','wosci-language'); ?></a>
                  
<a class="btn btn-sm btn-info" href="<?php echo esc_url( home_url( '/' ) ); ?>account-history-info?order_id=<?php echo $history['orders_id']; ?>" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> <?php echo __('View', 'wosci-language'); ?></a>                  

</div></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td></td>
            </tr>
          </table>
          <hr>
<?php
    }
  } else {
?>
          <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td><table border="0" width="100%" cellspacing="2" cellpadding="4">
                <tr>
                  <td class="main"><?php echo __('You dont have orders','wosci-language'); ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
<?php
  }
?>
        </td>
      </tr>
<?php
  if ($orders_total > 0) {
?>
      <tr>
        <td>
        
<div class="row" style="line-height:40px;vertical-align:middle;">
  <div class="col-xs-12 col-sm-6 col-md-8" style="line-height:80px;vertical-align:middle;" ><?php echo $history_split->display_count(__( 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)','wosci-language' )); ?></div>
  <div class="col-xs-6 col-md-4" style="line-height:80px;text-align:right;vertical-align:middle;"><?php echo $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
</div>
        
        
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText" valign="top"></td>
            <td class="smallText" align="right"></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td></td>
                <td><a class="btn btn-success" href="<?php echo esc_url( home_url( '/' ) ); ?>account"><?php echo __('Back','wosci-language'); ?></a></td>
                <td></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>