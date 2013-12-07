<?php

  /*
  garanti.php
  Version 1.2 3/7/2005

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  Contributed by CardinalCommerce
  http://www.cardinalcommerce.com

  Purpose
    Module to perform credit card authorizations using the USAePay AIM
    service.

    This module is also capable of passing Verified by Visa, MasterCard
    SecureCode, and JCB J/Secure payer authentication results along to
    Payflow Pro. This added feature requires the Cardinal Centinel
    service and Cardinal Centinel osCommerce module. For more information on
    or to register for the Cardinal Centinel service, please visit:

    http://www.cardinalcommerce.com/html/frame_services.html

    This module is not dependent upon the Cardinal Centinel service or module
    and may be used exclusively of it.

  */

  class garanti {
    var $code, $title, $description, $enabled;

// class constructor
    function garanti() {
      global $order;


      $this->code = 'garanti';
      $this->title = MODULE_PAYMENT_GARANTI_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_GARANTI_TEXT_DESCRIPTION;
      $this->enabled = ((MODULE_PAYMENT_GARANTI_STATUS == 'true') ? true : false);
   
    if ((int)MODULE_PAYMENT_GARANTI_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_GARANTI_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();


     // $this->form_action_url = 'https://ccpos.garanti.com.tr/servlet/gar3Dgate';
     $this->form_action_url = MODULE_PAYMENT_GARANTI_URL;
    }

// class methods
 function update_status() {
      global $order;





      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_GARANTI_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_GARANTI_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }
    function javascript_validation() {
	   $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_firstname = document.checkout_payment.garanti_cc_owner.value;' . "\n" .
		    '    var cc_lastname = document.checkout_payment.garanti_cc_owner.value;' . "\n" .
		    '    var cc_owner = cc_firstname & " " & cc_lastname;' . "\n" .
            '    var cc_number = document.checkout_payment.garanti_cc_number.value;' . "\n" .
            '    var cc_cvv = document.checkout_payment.garanti_cc_cvv.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_GARANTI_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_GARANTI_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_cvv != "" && cc_cvv.length < "3") {' . "\n".
            '      error_message = error_message + "' . MODULE_PAYMENT_GARANTI_TEXT_JS_CC_CVV . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;

    }

    function selection() {
      global $order;
     
    $table_cost = split("[:,]" , MODULE_PAYMENT_GARANTI_KEY);
     $size = (sizeof($table_cost)+1)/2;
   $taksit[] = array('id' => "", 'text' => "PEŞİN");
   for ($i=2; $i <  $size; $i++) {
   

   
        $taksit[] = array('id' => $i, 'text' => $i);
      }
   

      for ($i=1; $i < 13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%m',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

	  $fields[0]=array('title' => '</td><tr><td colspan=6 class=main><B>'.  MODULE_PAYMENT_GARANTI_TEXT_TITLE2 .'</a> </B>' ,
                       'field' => '</td>');
	  $fields[1]=array('title' => MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_OWNER_FIRST_NAME,
			'field' => tep_draw_input_field('garanti_cc_owner_firstname', $order->billing['firstname']));
	  $fields[2]=array('title' => MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_OWNER_LAST_NAME,
			'field' => tep_draw_input_field('garanti_cc_owner_lastname', $order->billing['lastname']));

      $cc_images_html = '';
      if (strcasecmp('true', MODULE_PAYMENT_GARANTI_ACCEPT_VISA) == 0) {
      //  $cc_images_html .= tep_image(DIR_WS_IMAGES . 'icons/Visa.gif');
      }
      if (strcasecmp('true', MODULE_PAYMENT_GARANTI_ACCEPT_MC) == 0) {
     //   $cc_images_html .= tep_image(DIR_WS_IMAGES . 'icons/Mastercard.gif');
      }
      if (strcasecmp('true', MODULE_PAYMENT_GARANTI_ACCEPT_DISCOVER) == 0) {
     //   $cc_images_html .= tep_image(DIR_WS_IMAGES . 'icons/Discover.gif');
      }
      if (strcasecmp('true', MODULE_PAYMENT_GARANTI_ACCEPT_AMEX) == 0) {
      //  $cc_images_html .= tep_image(DIR_WS_IMAGES . 'icons/Amex.gif');
      }

      $fields[3]=array('title' => MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_NUMBER,
                       'field' => tep_draw_input_field('garanti_cc_number','','valign=Center') .'&nbsp'. $cc_images_html);

      $fields[4]=array('title' =>  MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_EXPIRES ,
                          'field' => tep_draw_pull_down_menu('garanti_cc_expires_month', $expires_month) . '&nbsp;&nbsp;' . tep_draw_pull_down_menu('garanti_cc_expires_year', $expires_year));

      $fields[5]=array('title' =>  MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_CHECKNUMBER . ' ' . '<a href=javascript:{}; onclick="javascript:{window.open(\'./popup_cvv.php\',\'test\',\'width=600,top=100,scrollbars=yes,scroll=yes, left=100\');false}">' . '<u><i>' . '(' . MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_CVV_HELP . ')' . '</i></u></a>',
                          'field' => tep_draw_input_field('garanti_cc_cvv','','size="4" maxlenght="4" valign="center"').'<br>'.tep_image(DIR_WS_IMAGES . 'icons/cid.gif'));
	  
//	   $pesin="";            
 $fields[6]=array('title' =>  MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_TAKSIT ,
                          'field' => tep_draw_pull_down_menu('garanti_cc_taksit', $taksit,$pesin));

	  
	  $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => $fields);

      return $selection;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS;

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($HTTP_POST_VARS['garanti_cc_number'], $HTTP_POST_VARS['garanti_cc_expires_month'], $HTTP_POST_VARS['garanti_cc_expires_year'], $HTTP_POST_VARS['garanti_cc_cvv'],
$HTTP_POST_VARS['garanti_cc_taksit']);
      $error = '';
      switch ($result) {
		case -1:
			$error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
			break;
		case -2:
		case -3:
		case -4:
			$error = TEXT_CCVAL_ERROR_INVALID_DATE;
			break;
		case -5:
		case -6;
			$error = TEXT_CCVAL_ERROR_CVV_LENGTH;
			break; 
		case false:
			$error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
			break;
	  }

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&garanti_cc_owner_firstname=' . urlencode($HTTP_POST_VARS['garanti_cc_owner_firstname']) . '&garanti_cc_owner_lastname=' . urlencode($HTTP_POST_VARS['garanti_cc_owner_lastname']) . '&garanti_cc_expires_month=' . $HTTP_POST_VARS['garanti_cc_expires_month'] . '&garanti_cc_expires_year=' . $HTTP_POST_VARS['garanti_cc_expires_year']. $HTTP_POST_VARS['garanti_cc_taksit'];

        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }

      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_type_value = $cc_validation->cc_type_value;
      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expiry_month = $cc_validation->cc_expiry_month;
      $this->cc_expiry_year = $cc_validation->cc_expiry_year;

	  // Set the credit card information in the session to enable the Payer Authentication Processing.
	  // Once Payer Authentication completes then the values will be retrieved from session.

      global $garanti_cc_number, $garanti_cc_expires_month, $garanti_cc_expires_year, $garanti_cc_cvv, $taksit, $garanti_cc_taksit, $order, $garanti_cc_type;







	$garanti_cc_type = $cc_validation->cc_type; 
	$garanti_cc_number = $cc_validation->cc_number; 
	$garanti_cc_expires_month = $cc_validation->cc_expiry_month; 
	$garanti_cc_expires_year = $cc_validation->cc_expiry_year; 
	$garanti_cc_cvv = $HTTP_POST_VARS['garanti_cc_cvv'];
	$garanti_cc_taksit = $HTTP_POST_VARS['garanti_cc_taksit'];

      $dada="dada";
      
      
      

      
      
      
     

   



    


      

      
      tep_session_register('garanti_cc_type');
      tep_session_register('garanti_cc_number');
      tep_session_register('garanti_cc_expires_month');
      tep_session_register('garanti_cc_expires_year');
      tep_session_register('garanti_cc_cvv');
      tep_session_register('garanti_cc_taksit');






    }

    function confirmation() {
      global $HTTP_POST_VARS, $garanti_cc_taksit, $mag_no, $ia;




$num = mt_rand ( 0, 0xffffff ); // trust the library, love the library...
$output = sprintf ( "%06x" , $num ); // muchas smoochas to you, PHP!



$num2 = mt_rand ( 0, 0xffffff ); // trust the library, love the library...
$output2 = sprintf ( "%06x" , $num2 ); // muchas smoochas to you, PHP!



	  #  Mask the Credit Card Number for display purposes
	  $masked_cc_card_num = '';
      for ($i = 0; $i < strlen($this->cc_card_number) - 4; $i++) {
			$masked_cc_card_num .= '*';
      }
      $masked_cc_card_num .= substr($this->cc_card_number, strlen($this->cc_card_number) - 4);

      $confirmation = array('title' => $this->title,
                            'fields' => array(array('title' => MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $HTTP_POST_VARS['garanti_cc_owner_firstname'] . ' ' . $HTTP_POST_VARS['garanti_cc_owner_lastname']),
                                              array('title' => MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => $masked_cc_card_num),
                                                    array('title' => 'Kart Tipi:',
                                                    'field' => $this->cc_card_type),
                                                    array('title' => MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_TAKSIT,
                                                    'field' => $HTTP_POST_VARS['garanti_cc_taksit']),
                                                                                    
                                              array('title' => MODULE_PAYMENT_GARANTI_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['garanti_cc_expires_month'], 1, '20' . $HTTP_POST_VARS['garanti_cc_expires_year'])))));

      return $confirmation;
      
    
      
    }

   function process_button() {
      global $HTTP_POST_VARS, $order, $currencies, $currency, $tutar, $garanti_cc_taksit, $faiz, $fby, $tutar_h, $mag_no, $ia;




$fu= tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true);
$ou = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true);


 $sessionName = tep_session_name();
        $sessionId = $HTTP_GET_VARS[$sessionName];
        $hrefLink = tep_href_link(FILENAME_CHECKOUT_PAYMENT, tep_session_name() . '=' . $sessionId . '&error_message=Hata', 'SSL', false, false);



$s_id = tep_session_id();
$hashstr=MODULE_PAYMENT_GARANTI_MAG_KOD.$output.$order->info['total'].HTTPS_SERVER.DIR_WS_HTTP_CATALOG.'3DModelodeme.php?osCsid='.$s_id.HTTPS_SERVER.DIR_WS_HTTP_CATALOG.'3DModelodeme.php?osCsid='.$s_id.'Auth'.$garanti_cc_taksit.$output2.MODULE_PAYMENT_GARANTI_IA;

$hsh = base64_encode (pack('H*',sha1($hashstr)));

//echo "<br>";
//echo $hashstr;
//echo "<br>";
//echo $hsh; 
	tep_session_unregister('garanti_cc_number');
	tep_session_unregister('garanti_cc_expires_month');
	tep_session_unregister('garanti_cc_expires_year');
	tep_session_unregister('garanti_cc_cvv');
	tep_session_unregister('garanti_cc_taksit');
	tep_session_unregister('garanti_cc_expires_month');



$process_button_string = tep_draw_hidden_field('okUrl',HTTPS_SERVER.DIR_WS_HTTP_CATALOG.'3DModelodeme.php?osCsid='.$s_id) . tep_draw_hidden_field('failUrl',HTTPS_SERVER.DIR_WS_HTTP_CATALOG.'3DModelodeme.php?osCsid='.$s_id) . tep_draw_hidden_field('ia', MODULE_PAYMENT_GARANTI_IA) . tep_draw_hidden_field('oid', $output) . 
tep_draw_hidden_field('firmaadi', STORE_NAME) . 
tep_draw_hidden_field('storetype', '3d') . tep_draw_hidden_field('rnd', $output2) . tep_draw_hidden_field('lang', 'tr') . tep_draw_hidden_field('hash', $hsh) . tep_draw_hidden_field('islemtipi', 'Auth') . tep_draw_hidden_field('clientid', MODULE_PAYMENT_GARANTI_MAG_KOD) . tep_draw_hidden_field('taksit', $garanti_cc_taksit) . tep_draw_hidden_field('amount', $order->info['total']) . tep_draw_hidden_field('Ecom_Payment_Card_ExpDate_Month', $HTTP_POST_VARS['garanti_cc_expires_month']) . tep_draw_hidden_field('Ecom_Payment_Card_ExpDate_Year', $HTTP_POST_VARS['garanti_cc_expires_year']) . 
tep_draw_hidden_field('pan', $HTTP_POST_VARS['garanti_cc_number']) . 
tep_draw_hidden_field('cv2', $HTTP_POST_VARS['garanti_cc_cvv']) . 
tep_draw_hidden_field('addr_name', $HTTP_POST_VARS['garanti_cc_owner']) . 
tep_draw_hidden_field('cardType', $this->cc_card_type_value);

      return $process_button_string;
    }

    function before_process() {

       return false;

    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_GARANTI_TEXT_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_GARANTI_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
    
    


      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Taksit Tablosu', 'MODULE_PAYMENT_GARANTI_KEY', '', 'Taksit Tablosuna taksitleri yazınız <a href=\"javascript:void window.open(\'osi_oos_taksitler.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', now())");
      
      
      
      
            tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sanal pos adresine baglanti adresi', 'MODULE_PAYMENT_GARANTI_URL', '', 'Bilgilerin Yollanacağı Banka URLsi  <a href=\"javascript:void window.open(\'osi_oos_url.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', now())");
      
      
            tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mağaza Kodu', 'MODULE_PAYMENT_GARANTI_MAG_KOD', '', 'Mağaza Kodunuz  <a href=\"javascript:void window.open(\'osi_oos_m_kod.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', now())");
      
      

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('İşyeri Anahtarı', 'MODULE_PAYMENT_GARANTI_IA', '', 'Banka Tarafında Tanımlanmış İşyeri Anahtarı <a href=\"javascript:void window.open(\'osi_oos_ia.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', now())");
        
        
                tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Kullanıcı Adı', 'MODULE_PAYMENT_GARANTI_USERNAME', '', 'Banka Tarafında Tanımlanmış İşyeri Kullanici Adi <a href=\"javascript:void window.open(\'osi_oos_ia.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', now())");
                
                
                                tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Kullanıcı Şifresi', 'MODULE_PAYMENT_GARANTI_PASSWORD', '', 'Banka Tarafında Tanımlanmış İşyeri Kullanici Sifresi <a href=\"javascript:void window.open(\'osi_oos_ia.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', now())");
    
    ///
     
    
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Garanti 3D Secure Aktif Et', 'MODULE_PAYMENT_GARANTI_STATUS', 'false', 'Bu ödeme modülünü aktif etmek istiyormusunuz? <a href=\"javascript:void window.open(\'usaepay_popup.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Debug Logging to Error Log', 'MODULE_PAYMENT_GARANTI_DEBUGGING', 'true', 'Do you want to enable debug logging to the error log? <a href=\"javascript:void window.open(\'usaepay_popup.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_GARANTI_TESTMODE', 'Test', 'Transaction mode used for the USAePay service. <a href=\"javascript:void window.open(\'usaepay_popup.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', 'tep_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Accept VISA', 'MODULE_PAYMENT_GARANTI_ACCEPT_VISA', 'true', 'Accept VISA <a href=\"javascript:void window.open(\'usaepay_popup.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', 'tep_cfg_select_option(array(\'true\',\'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Accept MasterCard', 'MODULE_PAYMENT_GARANTI_ACCEPT_MC', 'true', 'Accept MasterCard <a href=\"javascript:void window.open(\'usaepay_popup.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', 'tep_cfg_select_option(array(\'true\',\'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Accept Discover', 'MODULE_PAYMENT_GARANTI_ACCEPT_DISCOVER', 'false', 'Accept Discover <a href=\"javascript:void window.open(\'usaepay_popup.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', 'tep_cfg_select_option(array(\'true\',\'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Accept AMEX', 'MODULE_PAYMENT_GARANTI_ACCEPT_AMEX', 'false', 'Accept AMEX <a href=\"javascript:void window.open(\'usaepay_popup.html\',\'usaepay_info\',\'width=480,height=480\')\"><img src=images/icon_info.gif border=0/></a>', '6', '0', 'tep_cfg_select_option(array(\'true\',\'false\'), ', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_GARANTI_KEY', 'MODULE_PAYMENT_GARANTI_URL', 'MODULE_PAYMENT_GARANTI_MAG_KOD', 'MODULE_PAYMENT_GARANTI_IA', 'MODULE_PAYMENT_GARANTI_USERNAME', 'MODULE_PAYMENT_GARANTI_PASSWORD', 'MODULE_PAYMENT_GARANTI_STATUS', 'MODULE_PAYMENT_GARANTI_DEBUGGING', 'MODULE_PAYMENT_GARANTI_TESTMODE', 'MODULE_PAYMENT_GARANTI_ACCEPT_VISA', 'MODULE_PAYMENT_GARANTI_ACCEPT_MC', 'MODULE_PAYMENT_GARANTI_ACCEPT_DISCOVER', 'MODULE_PAYMENT_GARANTI_ACCEPT_AMEX');
    }
    

  }
?>