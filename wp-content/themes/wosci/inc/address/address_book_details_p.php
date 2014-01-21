<?php
/*
  $Id: address_book_details.php.tortoise.removed,v 1.1 2008/12/26 13:10:22 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  if (!isset($process)) $process = false;
?>
<?php if (isset($_GET['edit'])) { /*echo _('Edit Address');*/ } elseif (isset($_GET['delete'])) { /*echo NEW_ADDRESS_TITLE;*/ } ?>
<?php
/*  if (ACCOUNT_GENDER == 'true') {
    $male = $female = false;
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = !$male;
    } elseif (isset($entry['entry_gender'])) {
      $male = ($entry['entry_gender'] == 'm') ? true : false;
      $female = !$male;
    }
?>
<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:2px;"><?php echo ENTRY_GENDER; ?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_radio_field('gender', 'm', $male,'') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female,'') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></div>
  </div>   
<?php
  }
  */
?>

<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'First Name', 'wosci-language' ) ;?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('firstname', $entry['entry_firstname'],'class="form-control" ') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement"></span>': ''); ?></div>
</div>

<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'Last Name', 'wosci-language' );?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('lastname', $entry['entry_lastname'],'class="form-control"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement"></span>': ''); ?></div>
</div>  

<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
<div class="row">
            <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'Company', 'wosci-language' ) ;?></div>
            <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('company', $entry['entry_company'],'class="form-control" ') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement"></span>': ''); ?></div>
          </div>

<?php
  }
?>

<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'Address', 'wosci-language' );?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('street_address', $entry['entry_street_address'],'class="form-control" ') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement"></span>': ''); ?></div>
</div>  



<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
          <div class="row">
            <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'Suburb', 'wosci-language' );?></div>
            <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('suburb', $entry['entry_suburb'],'class="form-control" ') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement"></span>': ''); ?></div>
          </div>
<?php
  }
?>

<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'Post Code', 'wosci-language' );?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('postcode', $entry['entry_postcode'],'class="form-control" ') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement"></span>': ''); ?></div>
</div>  

<div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'City', 'wosci-language' );?></div>
    <div class="col-xs-6 col-lg-9"><?php echo tep_draw_input_field('city', $entry['entry_city'],'class="form-control" ') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement"></span>': ''); ?></div>
</div>  




<?php 
  if (ACCOUNT_STATE == 'true') {}
?>
  <div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'State/Province', 'wosci-language' );?></div>
    <div class="col-xs-6 col-lg-9" id="states_p">
<?php

    if ($process == true) {
     if ($entry ['entry_zone_id'] != '' && is_numeric($entry['entry_zone_id'])) {
     $entry_state_has_zones = true; 

     $z_query = tep_db_query("select zone_code, zone_name, zone_code from " . TABLE_ZONES . " where zone_id = '" . (int)$entry['entry_zone_id'] . "'");
     $zone_query = tep_db_fetch_array($z_query);
     
     }
      if ($entry_state_has_zones == true ) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name, zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry ['entry_country_id'] . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_code'], 'text' => $zones_values['zone_name']);
        }
	if( count($zones_array) > 0 ){
	echo tep_draw_pull_down_menu('state', $zones_array, $zone_query['zone_code'],'class="form-control"'). '&nbsp;<span class="inputRequirement"></span>';
	} else {
        echo tep_draw_input_field('state',   $entry['entry_state'], 'class="form-control" ') . '&nbsp;<span class="inputRequirement"></span>';
      }
      }
    } else {
	$zones_array = array();
        $zones_query = tep_db_query("select zone_name, zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry ['entry_country_id'] . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_code'], 'text' => $zones_values['zone_name']);
        }
      
	if( count($zones_array) > 0 ){
	echo tep_draw_pull_down_menu('state', $zones_array,$entry ['entry_state'],'class="form-control" '). '&nbsp;<span class="inputRequirement"></span>'; 
	}else{
	echo tep_draw_input_field('state',$entry ['entry_state'],'class="form-control" '); 
	}
      
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) ;
?>
    </div>
  </div>
  </div>
<?php

  
?>



  <div class="row">
    <div class="col-xs-6 col-lg-3" style="margin-top:8px;"><?php echo __( 'Country', 'wosci-language' );?></div>
    <div class="col-xs-6 col-lg-9">
    
     <?php
		
		//country autoselect by OSIcommerce - BOF
		$zonecode = ", '".tep_get_zone_code($entry ['entry_country_id'],$entry ['entry_zone_id'],'')."'";
		
		if($zonecode == ", ''"){$zonecode = ", ''";}

		if($HTTP_POST_VARS['country'] ==''){
		if($entry ['entry_country_id'] == ''){
		echo tep_get_country_list('country', STORE_COUNTRY, 'class="form-control" onchange="loadXMLDocNewp(this.value'.$zonecode.');" '); 
		} else {
		echo tep_get_country_list('country', $entry ['entry_country_id'], 'class="form-control" onchange="loadXMLDocNewp(this.value'.$zonecode.');" '); 
		}
		} else {
		echo tep_get_country_list('country', $HTTP_POST_VARS['country'], 'class="form-control" onchange="loadXMLDocNewp(this.value'.$zonecode.');" ');
		}
		
		//country autoselect by OSIcommerce - EOE
		
		?>
    
    </div>
  </div>

<?php echo tep_draw_hidden_field('action', 'update'); ?>
<?php echo tep_draw_hidden_field('frompage', $_GET['frompage']); ?>
<?php echo tep_draw_hidden_field('edit', $_GET['edit']); ?>
<input name="returnto" value="<?php echo $_GET['returnto']; ?>" type="hidden">

<?php
  if ((isset($_GET['edit']) && ($customer_default_address_id != $_GET['edit'])) || (isset($_GET['edit']) == false) ) {
?>
          
<div class="row">
	<div class="col-xs-6 col-lg-7"></div>
	<div class="col-xs-6 col-lg-5" >
            
            
		<div class="row">
		<div class="col-xs-6 col-lg-9 text-right" style=" line-height: 40px; margin: 0;vertical-align:middle;"><?php _e('Set As Primary', 'wosci-language'); ?></div>
		<div class="col-xs-6 col-lg-3">
	<?php
            
            if ( !empty($_GET['returnto']) ) {
            echo tep_draw_checkbox_field('primary', 'on', true, 'class="form-control" id="primary" style="display:inline;"'); 
            }else{
            echo tep_draw_checkbox_field('primary', 'on', false, 'class="form-control" id="primary"'); 
            }
             
             
	?>
		</div>
		</div>
            
            
	</div><!-- .col-lg-5 -->
</div><!-- .row -->
<?php
  }
?>
