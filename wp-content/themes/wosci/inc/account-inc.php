<script language="javascript"><!--
function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1><?php _e('Account','wosci-language'); ?></h1>
</td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table>
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
         
<?php
  if ($messageStack->size('account') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('account'); ?></td>
      </tr>
      
<?php
  }

  if (tep_count_customer_orders($current_user->ID, false) > 0) {
?>
      <tr>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><h3><?php _e('Latest Orders','wosci-language'); ?></h2></td>
            <td style="text-align:center;width:20px;">—</td><td class="main"><h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>account-history"><?php echo __('View All', 'wosci-language'); ?></a></h3></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td valign="top" width="370"></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="5">
<?php
    $orders_query = tep_db_query("select o.orders_id, o.date_purchased, o.delivery_name, o.delivery_country, o.billing_name, o.billing_country, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$current_user->ID . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1' order by orders_id desc limit 3");
    while ($orders = tep_db_fetch_array($orders_query)) {
      if (tep_not_null($orders['delivery_name'])) {
        $order_name = $orders['delivery_name'];
        $order_country = $orders['delivery_country'];
      } else {
        $order_name = $orders['billing_name'];
        $order_country = $orders['billing_country'];
      }
?>
                  <tr class="moduleRow">
                    <td class="main" width="80"><?php echo tep_date_short($orders['date_purchased']); ?></td>
                    <td class="main"><?php echo '#' . $orders['orders_id']; ?></td>
                    <td class="main"><?php echo tep_output_string_protected($order_name) . ', ' . $order_country; ?></td>
                    <td class="main"><?php echo $orders['orders_status_name']; ?></td>
                    <td class="main" align="right"><?php echo $orders['order_total']; ?></td>
                    <td style="line-height:30px;" align="right">
                    
                    <div class="btn-group"><a class="btn btn-sm btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>pdf-invoice?order_id=<?php echo $orders['orders_id']; ?>" target="_blank"><span class="glyphicon glyphicon-file"></span> <?php echo __('Printable Invoice','wosci-language'); ?></a>
                  
<a class="btn btn-sm btn-info" href="<?php echo esc_url( home_url( '/' ) ); ?>account-history-info?order_id=<?php echo $orders['orders_id']; ?>" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> <?php echo __('View', 'wosci-language'); ?></a>  

                    </td>


                

</div>

    </tr>
<?php
    }
?>
                </table></td>
                <td></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><h3><?php _e('Account Details','wosci-language'); ?></h3></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"></td>
                <td width="60"><!--<img src="<?php echo bloginfo('template_url'); ?>/images/account_personal.gif"/>--></td>
                <td width="10"></td>
                <td><ul>
                 
                    <li><h4 style="font-weight:normal;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/profile.php"><?php echo  __('Edit Profile','wosci-language'); ?></a></h4></li>
                  
                   <li><h4 style="font-weight:normal;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>address-book"><?php echo __('Address Book','wosci-language'); ?></a></h4></li>
                  
                   
                  
                </ul></td>
                <td width="10" align="right"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>

      </table>