<script language="javascript"><!--
var selected;

function selectRowEffect(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

// one button is not an array
  if (document.checkout_payment.payment[0]) {
    document.checkout_payment.payment[buttonSelect].checked=true;
  } else {
    document.checkout_payment.payment.checked=true;
  }
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script>



<?php echo $payment_modules->javascript_validation(); ?>

<?php echo tep_draw_form('checkout_payment', tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post'); ?><div border="0" width="100%" cellspacing="0" cellpadding="0">
      <div>
        <div><div border="0" width="100%" cellspacing="0" cellpadding="0">
          <div style="padding-top:4px;">
            </div><h1 style="font-size:2.5em;float:left;" class="entry-title"><?php echo HEADING_TITLE; ?></h1>
            <div class="pageHeading" style="float:right;"><img src="<?php echo bloginfo('template_url'); ?>/images/table_background_payment.gif"/></div>
          </div>
        </div></div>
      </div>
      <div>
       <!-- <div><hr style="color:#ffffff" id="pixel_trans"></div> -->
      </div><div style="padding-top:40px;"></div>
<?php
  if (isset($HTTP_GET_VARS['payment_error']) && is_object(${$HTTP_GET_VARS['payment_error']}) && ($error = ${$HTTP_GET_VARS['payment_error']}->get_error())) {
?>
     
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBoxNotice">
          <div class="infoBoxNoticeContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
                <div style="margin:65px;"></div>
                <div style="margin:0 0 16px 0;border-width:1px;border-style:solid;padding:12px;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;background-color:#ffebe8;border-color:#c00;" width="100%" valign="top"><?php echo tep_output_string_protected($error['title']); ?>: <?php echo tep_output_string_protected(stripslashes($error['error'])); ?></div>
                
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
      <div>
        <!-- <div><hr style="color:#ffffff" id="pixel_trans"></div> -->
      </div>
<?php
  }
?> <br><br>
     
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
                
                <div align="right" width="50%" valign="top"><div border="0" cellspacing="0" cellpadding="2">
                  <div>
                    
                    
                    
                    
                    
                    
                    <table width="100%">
                    <tr>
                    
                    <td class="main" valign="bottom" align="left">
                    <?php echo 'Fatura adresiniz sağ tarafta belirtilen adres değilse farklı bir adres girmek için aşağıdaki butonu tıklayınız.'; ?><br><br><?php echo '<a href="'.tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL').'" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',dimmingOpacity: 0.75,height:570,width:400,outlineType: \'rounded-white\', wrapperClassName: \'draggable-header\' } )" class="btn btn-primary btn-success">' . __('Change Address', 'wosci-language') . '</a>'; ?>
                    </td>
                    <td>
                   
                    </td>
                    
                    <td class="main" valign="bottom" >
                     <div><?php echo  tep_address_label($current_user->ID, $billto, true, ' ', '<br>'); ?></div>
                    
                    <?php echo '<a href="'.tep_href_link('address_book_process_hs.php', 'edit='.$billto.'&frompage=checkout_payment.php', 'SSL').'" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',dimmingOpacity: 0.75,height:550,width:400,outlineType: \'rounded-white\', wrapperClassName: \'draggable-header\' } )" class="btn btn-primary btn-success">' . __('Edit', 'wosci-language') . '</a>'; ?>
                    </td>
                    </tr></table>
                    
                    
                  </div>
                </div></div>
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
      
      
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $selection = $payment_modules->selection();

  if (sizeof($selection) > 1) {
?>
              <div>
              <!--  <div><hr style="color:#ffffff" id="pixel_trans"></div>-->
                <div class="main" width="50%" valign="top"><h3><?php echo 'Ödeme seçeneklerimiz'; ?></h3></div>
               
                <!-- <div><hr style="color:#ffffff" id="pixel_trans"></div> -->
              </div>
<?php
  } else {
?>
              <div>
                <div><hr style="color:#ffffff" id="pixel_trans"></div>
                <div class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></div>
                <div><hr style="color:#ffffff" id="pixel_trans"></div>
              </div>
<?php
  }

  $radio_buttons = 0;
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>
              <div>
              <!--  <div><hr style="color:#ffffff" id="pixel_trans"></div> -->
                <div colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="12">
<?php
    if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
      echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    } else {
      echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    }
?>
                  <!--  <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td> -->
                    <td class="main" colspan="3"><h4><?php echo $selection[$i]['module']; ?></h4></td>
                    <td class="main" align="right">
<?php
    if (sizeof($selection) > 1) {
      echo tep_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $payment),  'style="width:18px; height:18px;"');
    } else {
      echo tep_draw_hidden_field('payment', $selection[$i]['id']);
    }
?>
                    </td>
                <!--    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td> -->
                  </tr>
<?php
    if (isset($selection[$i]['error'])) {
?>
                  <tr>
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                    <td class="main" colspan="4"><?php echo $selection[$i]['error']; ?></td>
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                  </tr>
<?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>
                  <tr>
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                    <td colspan="4"><table border="0" cellspacing="0" cellpadding="2">
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
                      <tr>
                        <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
                        <td><hr style="color:#ffffff" id="pixel_trans"></td>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
                        <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                      </tr>
<?php
      }
?>
                    </table></td>
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                  </tr>
<?php
    }
?>
                </table></div>
             <!--   <div><hr style="color:#ffffff" id="pixel_trans"></div> -->
              </div>
<?php
    $radio_buttons++;
  }
?>
            </div></div>
          </div>
        </div></div>
      </div>
      <div>
        <div><hr style="color:#ffffff" id="pixel_trans"></div>
      </div>
      <div>
        <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
          <div>
            <div class="main"><b><?php echo 'Siparişiniz için varsa notunuz'; ?></b></div>
          </div>
        </div></div>
      </div>
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
                <div><?php echo tep_draw_textarea_field('osc_comments', 'soft', '173', '5', $osc_comments,'style="width:100%;"'); ?></div>
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
      <div>
        
      </div>
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
               
                <div class="main"><b><?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div>
                <div class="main" align="right"><?php echo '<input value="' . __('Continue', 'wosci-language') . '" class="btn btn-primary btn-success" type="submit">'; ?></div>
               
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
      <div>
        
      </div>
      <div>
        <div><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"></td>
            <td width="25%" align="center" ><img src="<?php echo bloginfo('template_url'); ?>/images/pin.png"/></td>
            <td width="25%"></td>
            <td width="25%"></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '" class="checkoutBarFrom">' . CHECKOUT_BAR_DELIVERY . '</a>'; ?></td>
            <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
            <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
            <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
          </tr>
        </table></div>
      </div>
    </div></form>