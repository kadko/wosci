<script type="text/javascript">
<?php
/*
 function processJson(data) {
 	alert(data.message); 
 	
 	if( data.message != 'tamam' ) {
	
	var fields = data.errorfields.split(" ");
    
	for (var i = 0; i < fields.length; i++) {

	jQuery('input[name="'+fields[i]+'"]').css("border", "solid 1px red");
   
	}
	jQuery('input[name="'+fields[0]+'"]').focus();
	}

	if( data.message == 'tamam' ) {
	
	jQuery('input').css("border", ""); jQuery('#myModal').modal('hide');
	
	//jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').empty();
	//jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').empty();
	
	//jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').append(data.address);
	//jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').append(data.address);
	
	jQuery('select[name="shipping_address_select"]').prepend("<option value='"+ data.new +"'>"+data.address+"</option>");
	jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').prop('selected', true);
	
	jQuery('#edit_shipping_address').attr('href', '<?php echo esc_url( home_url( '/' ) ); ?>?page_id=83&edit='+ data.new +'&from=Edit_Shipping_Address');
	
	
	
	jQuery('select[name="shipping_address_select"]').css("border", "solid 1px green");
	jQuery('select[name="payment_address_select"]').css("border", "solid 1px green");
	}
	var btn = jQuery('#save_new_shipping_address');
	btn.button('reset');
	    
}

jQuery(document).ready(function(){


jQuery('form[name="checkout_address_shipping"]').submit(function() {

	var stateselect = jQuery('form[name="checkout_address_shipping"] select[name="state"]').find(":selected").text();
	var firstname = jQuery('form[name="checkout_address_shipping"] input[name="firstname"]').val();
	var lastname = jQuery('form[name="checkout_address_shipping"] input[name="lastname"]').val();
	var company = jQuery('form[name="checkout_address_shipping"] input[name="company"]').val();
	var street_address = jQuery('form[name="checkout_address_shipping"] input[name="street_address"]').val();
	var suburb = jQuery('form[name="checkout_address_shipping"] input[name="suburb"]').val();
	var postcode = jQuery('form[name="checkout_address_shipping"] input[name="postcode"]').val();
	var city = jQuery('form[name="checkout_address_shipping"] input[name="city"]').val();
	var state = jQuery('form[name="checkout_address_shipping"] input[name="state"]').val();

if( typeof state !== 'undefined' || stateselect != '' ){
if(  firstname.length < 3 || lastname.length < 3 || company.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
	var btn = jQuery('#save_new_shipping_address');
	btn.button('reset');
	alert("Formda eksik doldurulmuş alanlar bulunuyor!");
	return false;
}
}
  
  

});



    jQuery('form[name="checkout_address_shipping"]').ajaxForm({
        // dataType identifies the expected content type of the server response 
        dataType:  'json', 
 
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson 
    }); 



jQuery('#save_new_shipping_address')
    .click(function () {
        var btn = jQuery(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 3000)
	
	jQuery('form[name="checkout_address_shipping"]').submit();

    });




  });

*/
?>



</script>


<?php echo tep_draw_form('checkout_address_shipping', '', 'post', 'target="_parent"'); ?><div border="0" width="100%" cellspacing="0" cellpadding="0">
      

<?php
  if ($messageStack->size('checkout_address') > 0) {
?>
      <div>
        <div><?php echo $messageStack->output('checkout_address'); ?></div>
      </div>
      
<?php
  }

  if ($process == false) {
?>
     
     
     
<?php
    if ($addresses_count > 1) {
?>
     
<?php
      $radio_buttons = 0;

      $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$current_user->ID . "'");
      while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);
?>
             
<?php
       if ($addresses['address_book_id'] == $sendto) {
         // echo '                  <div id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
        } else {
         // echo '                  <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
        }
?>
                    
                    <?php //echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?>
                    <?php //echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $sendto)); ?>
                    <?php //echo tep_address_format($format_id, $addresses, true, ' ', ', '); ?>
<?php
        $radio_buttons++;
      }
?>
           
    
<?php
    }
  }

  if ($addresses_count < 99) {
?>
      <?php //echo TEXT_CREATE_NEW_SHIPPING_ADDRESS; ?>
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
             
              <div>
               
                <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
                  <div>
                  
                    <div><?php require( 'address/checkout_new_address_s.php'); ?></div>
                    
                  </div>
                </div></div>
               
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
<?php
  }
?>
      
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
                
               <div style="margin:10px;"></div>
                <div class="main" style="margin:0 auto;width:100px;"><?php echo tep_draw_hidden_field('action', 'submit'); ?><?php //echo '<input value="' . _('Yeni Adresi Ekle') . '" class="btn btn-primary btn-success" type="submit">'; ?></div>
                
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
<?php
  if ($process == true) {
?>
     
      <div>
        <div><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></div>
      </div>
<?php
  }
?>

     
    </div></form>