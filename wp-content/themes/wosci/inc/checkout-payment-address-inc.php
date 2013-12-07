<script language="javascript"><!--

function loadXMLDocNewPAXX(key, key2) {

 jQuery('#statesNPA').html('<img style="vertical-align:middle" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">&nbsp;&nbsp;<?php _e('Yükleniyor...', 'wosci-language');?>');
   

var request = jQuery.ajax({
  url: "<?php echo bloginfo('template_url'); ?>/state_dropdown.php",
  type: "POST",
  data: { country : key , city_code : key2 },
  dataType: "html"
});
 
request.done(function( msg ) {
 jQuery('#statesNPA').html(msg);
});
 
request.fail(function( jqXHR, textStatus ) {
  alert( "Request failed: " + textStatus );
});
  
}


jQuery(document).ready(function() {
loadXMLDocNewPA(<?php if($HTTP_POST_VARS['country'] ==''){echo STORE_COUNTRY;}else{echo $HTTP_POST_VARS['country'];} ?>);
});

//--></script>


<?php
/*
<script type="text/javascript">


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
	
	jQuery('input').css("border", ""); jQuery('#myModal4').modal('hide');
	
	//jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').empty();
	//jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').empty();
	
	//jQuery('select[name="shipping_address_select"] option[value="' + data.new + '"]').append(data.address);
	//jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').append(data.address);
	
	jQuery('select[name="payment_address_select"]').prepend("<option value='"+ data.new +"'>"+data.address+"</option>");
	jQuery('select[name="payment_address_select"] option[value="' + data.new + '"]').prop('selected', true);
	
	jQuery('#edit_payment_address').attr('href', '<?php echo esc_url( home_url( '/' ) ); ?>?page_id=83&edit='+ data.new +'&from=Edit_Payment_Address');
	
	
	
	jQuery('select[name="shipping_address_select"]').css("border", "solid 1px green");
	jQuery('select[name="payment_address_select"]').css("border", "solid 1px green");
	}
	var btn = jQuery('#save_new_payment_address');
	btn.button('reset');
	    
}


jQuery(document).ready(function(){    



jQuery('form[name="checkout_address_payment"]').submit(function() {

	var stateselect = jQuery('select[name="state"]').find(":selected").text();
	var firstname = jQuery('input[name="firstname"]').val();
	var lastname = jQuery('input[name="lastname"]').val();
	var company = jQuery('input[name="company"]').val();
	var street_address = jQuery('input[name="street_address"]').val();
	var suburb = jQuery('input[name="suburb"]').val();
	var postcode = jQuery('input[name="postcode"]').val();
	var city = jQuery('input[name="city"]').val();
	var state = jQuery('input[name="state"]').val();

if( stateselect != '' ){

if(   firstname.length < 3 || lastname.length < 3 || company.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
alert("Formda eksik doldurulmu? alanlar bulunuyor!");
  return false;
}
}else{

if(  state.length < 3 || firstname.length < 3 || lastname.length < 3 || company.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
alert("Formda eksik doldurulmu? alanlar bulunuyor!");
  return false;
}
}
  
  

});





    jQuery('form[name="checkout_address_payment"]').ajaxForm({
        // dataType identifies the expected content type of the server response 
        dataType:  'json', 
 
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson 
    }); 



jQuery('#save_new_payment_address')
    .click(function () {
        var btn = jQuery(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 3000)
	
	jQuery('form[name="checkout_address_payment"]').submit();

    });




  });





</script>
*/
?>

<?php echo tep_draw_form('checkout_address_payment', '', 'post', 'target="_parent"'); ?><div border="0" width="100%" cellspacing="0" cellpadding="0">
     

<?php
  if ($messageStack->size('checkout_address') > 0) {
?>
      <div>
        <div><?php echo $messageStack->output('checkout_address'); ?></div>
      </div>
      <div>
        <div></div>
      </div>
<?php
  }

  if ($process == false) {
?>
      <div>
        <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
          <div>
            <div class="main"></div>
          </div>
        </div></div>
      </div>
     
      <div>
        <div></div>
      </div>
<?php
    if ($addresses_count > 99) {
?>
      <div>
        <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
          <div>
            <div class="main"><b><?php echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></b></div>
          </div>
        </div></div>
      </div>
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
                <div></div>
                <div class="main" width="50%" valign="top"><?php echo TEXT_SELECT_OTHER_PAYMENT_DESTINATION; ?></div>
                <div class="main" width="50%" valign="top" align="right"><?php echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>'; ?><img src="<?php echo bloginfo('template_url'); ?>/images/arrow_south_east.gif"/></div>
                <div></div>
              </div>
<?php
      $radio_buttons = 0;

      $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $current_user->ID . "'");
      while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);
?>
              <div>
                <div></div>
                <div colspan="2"><div border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
       if ($addresses['address_book_id'] == $billto) {
          echo '                  <div id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
        } else {
          echo '                  <div class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
        }
?>
                    <div width="10"></div>
                    <div class="main" colspan="2"><b><?php echo $addresses['firstname'] . ' ' . $addresses['lastname']; ?></b></div>
                    <div class="main" align="right"><?php echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $billto)); ?></div>
                    <div width="10"></div>
                  </div>
                  <div>
                    <div width="10"></div>
                    <div colspan="3"><div border="0" cellspacing="0" cellpadding="2">
                      <div>
                        <div width="10"></div>
                        <div class="main"><?php echo tep_address_format($format_id, $addresses, true, ' ', ', '); ?></div>
                        <div width="10"></div>
                      </div>
                    </div></div>
                    <div width="10"></div>
                  </div>
                </div></div>
                <div></div>
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
        <div></div>
      </div>
<?php
    }
  }

  if ($addresses_count < 99) {
?>
      <div>
        <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
          <!--<div>
            <div class="main"><b><?php echo TABLE_HEADING_NEW_PAYMENT_ADDRESS; ?></b></div>
          </div>-->
        </div></div>
      </div>
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
                <div><!--</div>
                <div class="main" width="100%" valign="top"><?php echo TEXT_CREATE_NEW_PAYMENT_ADDRESS; ?></div>
                <div>--></div>
              </div>
              <div>
                <div></div>
                <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
                  <div>
                    <div width="10"></div>
                    <div><?php require('address/checkout_new_address_p.php'); ?></div>
                   <div style="margin:10px;"></div>
                    <div style="margin:0 auto;width:200px;"><?php echo tep_draw_hidden_field('action', 'submit'); ?><?php //echo '<input value="' . _('Yeni Adresi Kaydet') . '" class="btn btn-primary btn-success" type="submit">'; ?></div>
                    
                  </div>
                </div></div>
                <div></div>
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
<?php
  }
?>
      <div>
        <div></div>
      </div>
      <div>
        <div><div border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <div class="infoBoxContents">
            <div><div border="0" width="100%" cellspacing="0" cellpadding="2">
              <div>
                <div width="10"></div>
                
                <div class="main" align="right"></div>
                <div width="10"></div>
              </div>
            </div></div>
          </div>
        </div></div>
      </div>
<?php
  if ($process == true) {
?>
      <div>
        <div></div>
      </div>
      <div>
        <div><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '" class="sbutton big bo">' . _('Back') . '</a>'; ?></div>
      </div>
<?php
  }
?>

  
    </div></form>