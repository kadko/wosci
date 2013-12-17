<div class="well">
<?php echo tep_draw_form('checkout_address', esc_url( home_url( '/' ) ).'order-confirmation', 'post') ; ?>
    
      
      
<?php if( !empty($_GET['error_message']) ) { ?>     
<div class="alert alert-danger"><b><?php echo $_GET['error_message']; ?></b></div>
<?php } ?>    

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo __('New Shipping Address', 'wosci-language'); ?></h4>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Cancel', 'wosci-language' ); ?></button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __( 'Save', 'wosci-language' ); ?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
                    
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo __('Edit Shipping Address', 'wosci-language'); ?></h4>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Cancel', 'wosci-language' ); ?></button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __( 'Save', 'wosci-language' ); ?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->      


  <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo __('Edit Payment Address', 'wosci-language'); ?></h4>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Cancel', 'wosci-language' ); ?></button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __( 'Save', 'wosci-language' ); ?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal --> 
      

  <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo __('New Payment Address', 'wosci-language'); ?></h4>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Cancel', 'wosci-language' ); ?></button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __( 'Save', 'wosci-language' ); ?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->     

          
  
      <div class="row">
  <div class="col-lg-6">
    <h2><?php echo __( 'Shipping', 'wosci-language' );?></h2>
     <div class="margin-top"></div>   
   <div class="row">
  <div class="col-lg-9">
<select name="shipping_address_select" class="form-control" style="font-size:11px;width:100%;height:34px;margin:0px;">
<?php
      $radio_buttons = 0;

      $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$current_user->ID . "'");
      while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);

       if ($addresses['address_book_id'] == $sendto) {
         echo '<option selected value="'. $addresses['address_book_id'] .'">'. tep_address_label($current_user->ID, $addresses['address_book_id'], true, ' ', ' ') .'</option>';
        } else {
         echo '<option value="'. $addresses['address_book_id'] .'">'. tep_address_label($current_user->ID, $addresses['address_book_id'], true, ' ', ' ') .'</option>';
        }

                    
                    //echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); 
                    //echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $sendto)); 
                    
                   //echo tep_address_format($format_id, $addresses, true, ' ', ', '); 

        //$radio_buttons++;
      }
      
?>
</select>
<?php /*
   <select name="shipping_address_select" class="form-control" style="width:100%;height:34px;margin:0px;"><option value="<?php echo $sendto; ?>"> <?php echo  tep_address_label($current_user->ID, $sendto, true, ' ', ' '); ?></option></select> */ ?>
    
  </div><!-- /.col-lg-10 -->
  <div class="col-lg-3" style="">
   <?php echo '<a data-target="#myModal2" role="button" data-toggle="modal" href="'. esc_url( home_url( '/' ) ).'edit-shipping-address/?edit='. $sendto .'&from=Edit_Shipping_Address" id="edit_shipping_address" class="btn btn-default">' . __('Edit', 'wosci-language') . '</a>'; ?><?php //echo $addresses_count = tep_count_customer_address_book_entries(); ?>
   
  </div><!-- /.col-lg-2 -->
</div><!-- /.row -->

<div class="margin-top"></div>
 <?php echo '<a data-target="#myModal" role="button"  data-toggle="modal" href="'.esc_url( home_url( '/' ) ).'new-shipping-address/?from=New_Shipping_Address" id="yeni_adres_ekle" class="btn-sm btn-primary btn-success" style=""><span class="glyphicon glyphicon-plus"></span> ' . __('New Shipping Address', 'wosci-language') . '</a>'; ?>      

<div class="margin-top"></div>
      


<div class="row"><div id="loading_shipping_modules" style="display:none;position: absolute; top: 50%; right: 50%;"> <img style="background-color:transparent;" src="<?php echo get_bloginfo('template_url');?>/loading.gif"> </div>



<div class="row" id="shipping_modules_loaded"  style="z-index:100;display:none;width:100%;position: absolute; top: 50%;">
  <div class="col-xs-3 col-md-2"></div>
  <div class="col-xs-12 col-md-8"><div class="alert alert-success"><b><?php echo __('Shipping modules and costs updated!', 'wosci-language'); ?></b></div></div>
  <div class="col-xs-3 col-md-2"></div>
</div>


  <div class="col-lg-12" id="shipping_modules">
  
   <table width="100%">
<?php
  if (tep_count_shipping_modules() > 0) {
?>
     
      <tr>
        <td><table  width="100%">
          <tr class="infoBoxContents">
            <td><table   class="shippingtable table table-hover table-responsive">
            
            
            
<?php
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
              <thead>
                    <td><h4><?php _e('Shipping Methods', 'wosci-language'); ?></h4></td>
                    <td></td>
                    <td></td>
                  </thead>
<?php
    } elseif ($free_shipping == 'false') {
?>
              <tr>
                <td><?php _e('Shipping Methods', 'wosci-language'); ?></td>
              </tr>
<?php
    }

    if ($free_shipping == true) {
?>
              <tr>
                <td colspan="4" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                   
                    <td class="main" colspan="3"><b><?php echo __('Free Shipping', 'wosci-language'); ?></b>&nbsp;<?php echo $quotes[$i]['icon']; ?><br><p><?php echo __('Free Shipping Orders Over', 'wosci-language'). ' '. $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) . tep_draw_hidden_field('shipping', 'free_free'); ?></p></td>
                    
                    
                  </tr>
                </table></td>
                
              </tr>
<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>
              <?php 
              for ($j2=0, $n2=sizeof($quotes[$i]['methods']); $j2<$n2; $j2++) { if($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j2]['id'] == $shipping['id']){echo '<tr style="background-color:#dff8df;" id="selectedshipment"> ';}else{ echo '<tr > '; } }
              ?>
              
               
                <td class="shipping_row" colspan="3"><table  width="100%">
                  
<?php
        if (isset($quotes[$i]['error'])) {
?>
                  <tr style="border:0px;">
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                    <td class="main" colspan="3"><?php echo $quotes[$i]['error']; ?></td>
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                  </tr>
<?php
        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              echo '                  <tr id="selected_shipping"  >';
            } else {
              echo '                  <tr id="selected_shipping"  >';
            }
?>
                 
                    <td style=" border: none;"  width="100%"><h5><?php echo $quotes[$i]['module']; ?></h5><small><?php echo $quotes[$i]['methods'][$j]['title']; ?></small></td>
<?php
            if ( ($n > 1) || ($n2 > 1) ) {
?>
                    <td style=" border: none;" ><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></td>
                    <td style=" border: none;" ><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked ); ?></td>
<?php
            } else {
?>
                    <td style=" border: none;"  colspan="3"><h5><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></h5></td>
<?php
            }
?>
                   </tr>
<?php
            $radio_buttons++;
          }
        }
?>
                </table></td>
                
              </tr>
<?php
      }
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
     
<?php
  }
?>
  </table>  



  </div><!-- /.col-lg-12 -->
  <div class="col-lg">
   
   
  </div><!-- /.col-lg -->
</div><!-- /.row -->   




   
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6" style="border-left:1px solid #cccccc;">
	<h2><?php echo __( 'Payment', 'wosci-language' );?></h2>
     <div class="margin-top"></div>   
 
   
	<!-- / PAYMENT SIDE -->
	
	
   <div class="row">
  <div class="col-lg-9">

 
 
 
 
 <select name="payment_address_select" class="form-control" style="font-size:11px;width:100%;height:34px;margin:0px;">
<?php
      $radio_buttons = 0;

      $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$current_user->ID . "'");
      while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);

       if ($addresses['address_book_id'] == $billto) {
         echo '<option selected value="'. $addresses['address_book_id'] .'">'. tep_address_label($current_user->ID, $addresses['address_book_id'], true, ' ', ' ') .'</option>';
        } else {
         echo '<option value="'. $addresses['address_book_id'] .'">'. tep_address_label($current_user->ID, $addresses['address_book_id'], true, ' ', ' ') .'</option>';
        }

                    
                    //echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); 
                    //echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $sendto)); 
                    
                   //echo tep_address_format($format_id, $addresses, true, ' ', ', '); 

        //$radio_buttons++;
      }
      
?>
</select>
 
 
 
 
 
 
</div><!-- /.col-lg-10 -->

<div class="col-lg-3" style="">

<?php echo '<a data-target="#myModal3" role="button"  data-toggle="modal" href="'.esc_url( home_url( '/' ) ).'edit-shipping-address/?edit='.$billto.'&from=Edit_Payment_Address" id="edit_payment_address" class="btn btn-default">' . __('Edit', 'wosci-language') . '</a>'; ?>

 </div><!-- /.col-lg-2 -->
</div><!-- /.row -->


<div class="margin-top"></div>
 <?php echo '<a data-target="#myModal4" role="button"  data-toggle="modal" href="'.esc_url( home_url( '/' ) ).'new-payment-address/?from=New_Payment_Address" id="new_payment_address" class="btn-sm btn-primary btn-success"><span class="glyphicon glyphicon-plus"></span> ' . __('New Payment Address', 'wosci-language') . '</a>'; ?>      
      <div class="margin-top"></div>
	
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
  if (isset($_GET['payment_error']) && is_object(${$_GET['payment_error']}) && ($error = ${$_GET['payment_error']}->get_error())) {
?>
     
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBoxNotice">
          <div class="infoBoxNoticeContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
<?php


	function get_between_two($haystack, $start, $end ){ //based on first occourance of string
		$wordlen = strlen($start);
		$startpos = strpos( $haystack, $start);
		$endpos = strpos( $haystack , $end, $startpos + $wordlen );//+$wordlen added so we will pass "&error="
		return substr( $haystack, $startpos+$wordlen, ($endpos-$startpos)-$wordlen );
		}


?>
                <?php echo "<div style=\"margin:15px 0 15px 0;\" class=\"alert alert-danger\">

<strong>". $error['title'] .":</strong> " . stripslashes(urldecode(get_between_two($_SERVER['REQUEST_URI'], '&error=', '&'))) ."
</div>";

//echo '..'.substr($_SERVER['REQUEST_URI'], strpos( $_SERVER['REQUEST_URI'],'&error=')+7, strpos( $_SERVER['REQUEST_URI'], '&', strpos($_SERVER['REQUEST_URI'], '&error=')+11 ));
              
              /*
		$start = strpos( $_SERVER['REQUEST_URI'],'&error=');
		$end = strpos( $_SERVER['REQUEST_URI'] , '&', $start + 1 );//+1 added for passing first "&" of "&error="
		$wordlen = strlen('&error=');
		echo '<br>'. substr( $_SERVER['REQUEST_URI'], $start+$wordlen, ($end-$start)-$wordlen );
               */

             
              
                ?>
                
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
?> 
     
    
      
      
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table width="100%" class="paymenttable table table-hover table-responsive">
<?php
  $selection = $payment_modules->selection();

  if (sizeof($selection) > 1) {
?>
		
		<thead>
                <td colspan="6"><h4><?php _e('Payment Methods', 'wosci-language'); ?></h4><td>
                </thead>
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
              <tr <?php if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) { echo 'style="background-color:#dff8df"'; }; ?> >
              
                <td colspan="5"><table class="paymentrow" width="100%" >
<?php
    if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
      echo '<tr>';
    } else {
      echo '<tr>';
    }
?>
                  <!--  <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td> -->
                    <td  class="moduletitle" style=" border: none;" colspan="5"><?php echo $selection[$i]['module']; ?></td>
                    <td   class="moduletitle" style=" border: none;" align="right">
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
                  <tr class="moduleRowP">
                    <td  style=" border: none;" ></td>
                    <td  style=" border: none;" colspan="4"><table  style=" border: none;" >
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
                      <tr style=" border: none;" >
                        <td  style=" border: none;" ></td>
                        <td  style=" border: none;" ><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
                        <td style=" border: none;" ></td>
                        <td  style=" border: none;" ><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
                        <td  style=" border: none;" ></td>
                      </tr>
<?php
      }
?>
                    </table></td>
                    <td style=" border: none;" ></td>
                  </tr>
<?php
    }
?>
                </table></td>
             <!--   <div><hr style="color:#ffffff" id="pixel_trans"></div> -->
              </tr>
<?php
    $radio_buttons++;
  }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
    
      
     
    
     
     
     
    </table>
	<!-- / PAYMENT SIDE END-->
   
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<?php
/*
<small><?php echo _('Notes For Your Order If Available'); ?></small>
<?php echo tep_draw_textarea_field('osc_comments', 'soft', '173', '5',$osc_comments,'class="form-control" style="width:100%;"'); ?>      
*/      
?>
<div class="row">
                
                <div class="col-xs-6 col-lg-9" style="line-height:32px;text-align:middle;" style="margin-right:20%;" align="right"><small><?php echo __('Please select above shipping and payment method and continue to order confirmation page', 'wosci-language'); ?></small></div>
                <div class="col-xs-6 col-lg-3"  ><?php echo '<button type="submit" class="btn btn-primary btn-success" style="float:right;" type="submit">'; ?> <span class="glyphicon glyphicon-arrow-right"></span> <?php echo __('Continue Checkout', 'wosci-language');?></button></div>
               
</div>      
     
      
      <?php 
      /*
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33%"  align="center"><img src="<?php echo bloginfo('template_url'); ?>/pin.png"/></td>
            <td width="33%"></td>
            <td width="33%"></td>
          </tr>
          <tr>
           
            <td align="center" width="33%" class="checkoutBarFrom"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '" class="checkoutBarFrom">'. _('SHIPPING / PAYMENT'). '</a>'; ?></td>
            <td align="center" width="33%" class="checkoutBarCurrent"><?php _e('CONFIRMATION'); ?></td>
            <td align="center" width="33%" class="checkoutBarTo"><?php _e('FINISHED!'); ?></td>
          </tr>
        </table>
        */
        ?>
      </form>
</div><!-- .well-->