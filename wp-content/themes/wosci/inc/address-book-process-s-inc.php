<script language="javascript">


  
<!--

function loadXMLDocNewXXX(key, key2) {

 jQuery('#states_s').html('<img style="vertical-align:middle" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">&nbsp;&nbsp;<?php _e('Yükleniyor...', 'wosci-language');?>');
   

var request = jQuery.ajax({
  url: "<?php echo bloginfo('template_url'); ?>/state_dropdown.php",
  type: "POST",
  data: { country : key , city_code : key2 },
  dataType: "html"
});
 
request.done(function( msg ) {
 jQuery('#states_s').html(msg);
});
 
request.fail(function( jqXHR, textStatus ) {
  alert( "Request failed: " + textStatus );
});
  
}

jQuery(document).ready(function() {

<?php $zid =  tep_get_zone_code($entry ['entry_country_id'],$entry ['entry_zone_id'],''); ?>
<?php if($zid == ''){ $zid = $entry ['entry_state']; } ?>

loadXMLDocNew("<?php if($entry['entry_country_id'] == ''){echo STORE_COUNTRY;}else{echo $entry['entry_country_id'];} ?>"<?php echo ', "'.$zid.'"'; ?>);












});



//-->
</script>
<?php
/*
 <script type="text/javascript">

 function processJson(data) { 
 	
 	if( data.message != 'tamam' ) {
	
	var fields = data.errorfields.split(" ");
    
	for (var i = 0; i < fields.length; i++) {

	jQuery('input[name="'+fields[i]+'"]').css("border", "solid 1px red");
   
	}
	jQuery('input[name="'+fields[0]+'"]').focus();
	}

	if( data.message == 'tamam' ) {
	
	jQuery('input').css("border", ""); jQuery('#myModal2').modal('hide');
	//alert(data.address);
	jQuery('select[name="shipping_address_select"] option[value="' + data.edit + '"]').empty();
	jQuery('select[name="payment_address_select"] option[value="' + data.edit + '"]').empty();
	
	jQuery('select[name="shipping_address_select"] option[value="' + data.edit + '"]').append(data.address);
	jQuery('select[name="payment_address_select"] option[value="' + data.edit + '"]').append(data.address);
	
	jQuery('select[name="shipping_address_select"]').css("border", "solid 1px green");
	jQuery('select[name="payment_address_select"]').css("border", "solid 1px green");
	}
	var btn = jQuery('#save_edit_shipping');
	btn.button('reset');
	    
}

jQuery(document).ready(function(){


jQuery('form[name="Edit_Shipping_Address"]').submit(function() {

	var stateselect = jQuery('form[name="Edit_Shipping_Address"] select[name="state"]').find(":selected").text();
	var firstname = jQuery('form[name="Edit_Shipping_Address"] input[name="firstname"]').val();
	var lastname = jQuery('form[name="Edit_Shipping_Address"] input[name="lastname"]').val();
	var company = jQuery('form[name="Edit_Shipping_Address"] input[name="company"]').val();
	var street_address = jQuery('form[name="Edit_Shipping_Address"] input[name="street_address"]').val();
	var suburb = jQuery('form[name="Edit_Shipping_Address"] input[name="suburb"]').val();
	var postcode = jQuery('form[name="Edit_Shipping_Address"] input[name="postcode"]').val();
	var city = jQuery('form[name="Edit_Shipping_Address"] input[name="city"]').val();
	var state = jQuery('form[name="Edit_Shipping_Address"] input[name="state"]').val();

if( typeof state !== 'undefined' || stateselect != '' ){
if(  firstname.length < 3 || lastname.length < 3 || company.length < 3 || street_address.length < 13 || suburb.length < 3 || postcode.length < 3 || city.length < 3 )
{
	var btn = jQuery('#save_edit_shipping');
	btn.button('reset');
	alert("Formda eksik doldurulmuş alanlar bulunuyoredit!");
	return false;
}
}
});



    jQuery('form[name="Edit_Shipping_Address"]').ajaxForm({
        // dataType identifies the expected content type of the server response 
        dataType:  'json', 
 
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson 
    }); 



jQuery('#save_edit_shipping')
    .click(function () {
        var btn = jQuery(this)
        btn.button('loading')
        setTimeout(function () {
            btn.button('reset')
        }, 300000)
	
	jQuery('form[name="Edit_Shipping_Address"]').submit();

    });


  });





</script>
*/
?>
<?php  if (!isset($_GET['delete'])) echo tep_draw_form('Edit_Shipping_Address', '', 'post', 'target="_parent"'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><<?php if (isset($_GET['edit'])) { echo HEADING_TITLE_MODIFY_ENTRY; } elseif (isset($_GET['delete'])) { echo HEADING_TITLE_DELETE_ENTRY; } else { echo HEADING_TITLE_ADD_ENTRY; } ?></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
 
<?php
  if ($messageStack->size('addressbook') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('addressbook'); ?></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
<?php
  }

  if (isset($_GET['delete'])) {
?>
      <tr>
        <td class="main"><b><?php echo DELETE_ADDRESS_TITLE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><hr style="color:#ffffff" id="pixel_trans"></td>
                <td class="main" width="50%" valign="top"><?php echo DELETE_ADDRESS_DESCRIPTION; ?></td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="center" valign="top"><b><?php echo SELECTED_ADDRESS; ?></b><br><img src="<?php echo bloginfo('template_url'); ?>/images/arrow_south_east.gif"/></td>
                    <td><hr style="color:#ffffff" id="pixel_trans"></td>
                    <td class="main" valign="top"><?php echo tep_address_label($current_user->ID, $_GET['delete'], true, ' ', '<br>'); ?></td>
                    <td><hr style="color:#ffffff" id="pixel_trans"></td>
                  </tr>
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
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                <td></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'] . '&action=deleteconfirm', 'SSL') . '" class="sbutton big bo">' . _('Delete') . '</a>'; ?></td>
                <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td><?php include( 'address/address_book_details_s.php'); ?></td>
      </tr>
     
<?php
    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
               
                <td></td>
                <td align="right"><?php //echo '<input value="' . _('Güncelle') . '" class="btn btn-primary btn-success" type="submit">'; ?></td>
                
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
    } else {
      if (sizeof($navigation->snapshot) > 0) {
        $back_link = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
      } else {
        $back_link = tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL');
      }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
               
                <td></td>
                <td><div style="margin:0 auto;width:120px;"><?php echo tep_draw_hidden_field('action', 'process'); ?><?php echo '<input value="' . _('Değişikliği Kaydet') . '" class="btn btn-primary btn-success" type="submit">'; ?></div></td>
               
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>

<?php
    }
  }
?>
    </table><?php if (!isset($_GET['delete'])) echo '</form>'; ?>