<div class="well">
<h1><?php _e('Siparişi Onayla', 'wosci-language'); ?></h1>
<div class="margin-top"></div>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
<?php
  if (isset($$payment->form_action_url)) {
    $form_action_url = $$payment->form_action_url;
  } else {
    $form_action_url = 'checkout-process';
  }

  echo tep_draw_form('checkout_confirmation', $form_action_url, 'post');
?>
        </td>
      </tr>
     
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
<?php
  if ($sendto != false) {
?>
            <td width="30%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><?php echo '<h3>' . __('Shipping Address', 'wosci-language') . '</h3> <a href="'. esc_url( home_url( '/' ) ). 'shipping-payment"><span class="orderEdit">(' . __('Edit', 'wosci-language') . ')</span></a>'; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>'); ?></td>
              </tr>
<?php
    if ($order->info['shipping_method']) {
?>
              <tr>
                <td class="main"><div class="margin-top"></div><?php echo '<h3>' . __('Shipping Method', 'wosci-language') . '</h3> <small><a href="'. esc_url( home_url( '/' ) ). 'shipping-payment"><span class="orderEdit">(' . __('Edit', 'wosci-language') . ')</span></a></small>'; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo $order->info['shipping_method']; ?></td>
              </tr>
<?php
    }
?>
            </table></td>
<?php
  }
?>
            <td width="<?php echo (($sendto != false) ? '70%' : '100%'); ?>" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
                  <tr>
                    <td class="main" colspan="2"><?php echo '<h3>' . __('Products', 'wosci-language') . '</h3> <a href="'. esc_url( home_url( '/' ) ). 'cart"><span class="orderEdit">(' . __('Edit', 'wosci-language') . ')</span></a>'; ?></td>
                    <td class="smallText" align="right"><h3><?php echo __('Tax', 'wosci-language'); ?></h3></td>
                    <td class="smallText" align="right"><h3><?php echo __('Total', 'wosci-language'); ?></h3></td>
                  </tr>
<?php
  } else {
?>
                  <tr>
                    <td class="main" colspan="3"><?php echo '<h3>' . __('Products', 'wosci-language') . '</h3> <a href="'. esc_url( home_url( '/' ) ). 'cart"><span class="orderEdit">(' . __('Edit', 'wosci-language') . ')</span></a>'; ?></td>
                  </tr>
<?php
  }

  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    echo '          <tr>' .
         '            <td class="main" align="right" valign="top" width="30">' . $order->products[$i]['qty'] . '&nbsp;x&nbsp;</td>' .
         '            <td class="main" valign="top">' . $order->products[$i]['name'];

    if (STOCK_CHECK == 'true') {
      echo tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
    }

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
      }
    }

    echo '<br><br></td>';

    if (sizeof($order->info['tax_groups']) > 1) echo '<td class="main" valign="top" align="right">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>';

    echo '            <td class="main" align="right" valign="top">' . $currencies->display_price($order->products[$i]['currency'], $order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '</td>'.
         '          </tr>';
  }
?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
      <tr>
        <td class="main"><h2><?php echo __('Billing Details', 'wosci-language'); ?></h2></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="30%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><?php echo '<h3>' . __('Billing Address', 'wosci-language') . '</h3> <a href="'. esc_url( home_url( '/' ) ). 'shipping-payment"><span class="orderEdit">(' . __('Edit', 'wosci-language') . ')</span></a>'; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>'); ?></td>
              </tr>
              <tr>
                <td class="main"><div class="margin-top"></div><?php echo '<h3>' . __('Payment Method', 'wosci-language') . '</h3> <small><a href="'. esc_url( home_url( '/' ) ). 'shipping-payment"><span class="orderEdit">(' . __('Edit', 'wosci-language') . ')</span></a></small>'; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo $order->info['payment_method']; ?></td>
              </tr>
            </table></td>
            <td width="70%" valign="top" align="right"><table border="0" cellspacing="0" cellpadding="2">
<?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    echo $order_total_modules->output();
  }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {
?>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo __('Payment Details', 'wosci-language'); ?></b></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" colspan="4"><?php echo $confirmation['title']; ?></td>
              </tr>
<?php
      for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
?>
              <tr>
                <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                <td class="main"><?php echo $confirmation['fields'][$i]['title']; ?></td>
                <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                <td class="main"><?php echo $confirmation['fields'][$i]['field']; ?></td>
              </tr>
<?php
      }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
    }
  }
?>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
<?php
  if (tep_not_null($order->info['comments'])) {
?>
      <tr>
        <td class="main"><?php echo '<b>' . __('Order Comments', 'wosci-language') . '</b> <a href="'. esc_url( home_url( '/' ) ). 'shipping-payment"><span class="orderEdit">(' . __('Edit', 'wosci-language') . ')</span></a>'; ?></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><?php echo nl2br(tep_output_string_protected($order->info['comments'])) . tep_draw_hidden_field('osc_comments', $order->info['comments']); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" class="main">
<?php
  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }

  //echo '<input value="'._('Siparişi Onayla').'" class="btn btn-primary btn-large btn-success" type="submit">' . "\n";
?>
<?php echo '<button type="submit" class="btn btn-primary btn-success" type="submit">'; ?> <span class="glyphicon glyphicon-ok"></span> <?php echo __('Confirm Order', 'wosci-language'); ?></button>

            </td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td><?php
        /*<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33%"></td>
            <td width="33%" align="center"><img src="<?php echo bloginfo('template_url'); ?>/pin.png"/></td>
            <td width="33%"></td>
          </tr>
          <tr>
           
            <td align="center" width="33%" class="checkoutBarFrom"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '" class="checkoutBarFrom">'. _('SHIPPING / PAYMENT'). '</a>'; ?></td>
            <td align="center" width="33%" class="checkoutBarCurrent"><?php _e('CONFIRMATION'); ?></td>
            <td align="center" width="33%" class="checkoutBarTo"><?php _e('FINISHED!'); ?></td>
          </tr>
        </table>
        */
?></td>
      </tr>
    </table></form></td>

  </tr>
</table>

</div><!-- .well -->