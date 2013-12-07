<?php
/*
  $Id: checkout_new_address.php.tortoise.removed,v 1.1 2008/12/26 13:10:22 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if (!isset($process)) $process = false;
?>


<?php
/*
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = ($gender == 'f') ? true : false;
    } else {
      $male = false;
      $female = false;
    }
    
?>
  <div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:4px;"><?php echo ENTRY_GENDER; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_radio_field('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></div>
  </div>    
<?php
  }
  */
?>



<div class="row">
                
                <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_FIRST_NAME; ?></div>
                <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('firstname','','class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></div>
               
</div>


<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_LAST_NAME; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('lastname','','class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></div>
</div>

<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_COMPANY; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('company','','class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></div>
  </div>
<?php
  }
?>

<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_STREET_ADDRESS; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('street_address','','class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></div>
  </div>


<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_SUBURB; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('suburb','','class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></div>
  </div>
<?php
  }
?>

<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_POST_CODE; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('postcode','','class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></div>
  </div>
  
<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_CITY; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('city','','class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></div>
  </div>
  


<?php
  if (ACCOUNT_STATE == 'true') {
?>
<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_STATE; ?></div>
    <div class="col-xs-6 col-lg-9" id="statesNSA">
<?php
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu('state', $zones_array,'class="form-control"');
      } else {
        echo tep_draw_input_field('state','','class="form-control"');
      }
    } else {
      echo tep_draw_input_field('state','','class="form-control"');
    }

   // if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;
?>
   </div>
    
    </div>
  
<?php

  }
?>




<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo ENTRY_COUNTRY; ?></div>
    <div class="col-xs-6 col-lg-9">
    
     <?php
		
		//country autoselect by OSIcommerce - BOF
		
		if($_POST['country'] ==''){
		if(osC_Country_Id($yer['country_code']) == ''){
		echo tep_get_country_list('country', STORE_COUNTRY, 'class="form-control" onchange="loadXMLDocNewSA(this.value);" '); 
		}else{
		echo tep_get_country_list('country', osC_Country_Id($yer['country_code']), 'class="form-control" loadXMLDocNewSA="loadXMLDoc(this.value);" '); 
		}
		}else{
		echo tep_get_country_list('country', $_POST['country'], 'class="form-control" onchange="loadXMLDocNewSA(this.value);" ');
		}
		
		//country autoselect by OSIcommerce - EOE
		
		?>
    
    </div>
  </div>
  