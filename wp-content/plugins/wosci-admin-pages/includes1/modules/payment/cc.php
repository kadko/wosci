<?php

/*

  $Id: cc.php,v 1.53 2003/02/04 09:55:01 project3000 Exp $



  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2003 osCommerce



  Released under the GNU General Public License

*/
	
	require_once('/posnet/posnet_oos_config.php');
	require_once('/posnet/Posnet Modules/Posnet OOS/posnet_oos.php');

  class cc {

    var $code, $title, $description, $enabled;



// class constructor

    function cc() {

      global $order;

	//Taksitler
	define('MODULE_PAYMENT_62_KEY', '1:0,2:3,3:4.5,4:6,5:7.75,6:9,7:10,8:11,9:12,10:13,11:14,12:15','wosci-language'  );//Garanti
	define('MODULE_PAYMENT_111_KEY', '1:0,2:3,3:4.5,4:6,5:7.75,6:9,7:10,8:11,9:12,10:13,11:14,12:15','wosci-language'  );//Finansbank
	define('MODULE_PAYMENT_67_KEY', '1:0,2:3,3:4.5,4:6,5:7.75,6:9,7:10,8:11,9:12,10:13,11:14,12:15','wosci-language'  );//YKB  

	//websitesinde aktif olarak kullanılan sanal posların banka kodları
	define('BANKALAR',  '62,67,111','wosci-language'  );//Garanti
  
	$this->code = 'cc';
	
	$this->title = MODULE_PAYMENT_CC_TEXT_TITLE;

	$this->description = MODULE_PAYMENT_CC_TEXT_DESCRIPTION;

	$this->sort_order = '0'; //MODULE_PAYMENT_CC_SORT_ORDER;

	$this->enabled = ((MODULE_PAYMENT_CC_STATUS == 'True') ? true : false);

	$this->form_action_url = 'ccpay';



      if ((int)MODULE_PAYMENT_CC_ORDER_STATUS_ID > 0) {

        $this->order_status = MODULE_PAYMENT_CC_ORDER_STATUS_ID;

      }



      if (is_object($order)) $this->update_status();

    }



// class methods

    function update_status() {

      global $order;



      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_CC_ZONE > 0) ) {

        $check_flag = false;

        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_CC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");

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

            '    var cc_owner = document.checkout_payment.cc_owner.value;' . "\n" .

            '    var cc_number = document.checkout_payment.cc_number.value;' . "\n" .

            '    var cvvnumber = document.checkout_payment.cc_checkcode.value;' . "\n" . 

            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .

            '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER . '";' . "\n" .

            '      error = 1;' . "\n" .

            '    }' . "\n" .

            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .

            '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER . '";' . "\n" .

            '      error = 1;' . "\n" .

            '    }' . "\n" .

            '    if (cvvnumber == ""|| cc_checkcode.length < 3) {' . "\n" . 

            '      error_message = error_message + "' . MODULE_PAYMENT_CC_TEXT_JS_CVVNUMBER . '";' . "\n" . 

            '      error = 1;' . "\n" . 

            '    }' . "\n" . 

            '  }' . "\n"; 



      return $js;

    }





    function selection() {

      global $order;



      for ($i=1; $i < 13; $i++) {
	if($i < 10) {$motext = '0'.$i;}else{ $motext = $i; }
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%m',mktime(0,0,0,$i,1,2000)));

      }



      $today = getdate();

      for ($i=$today['year']; $i < $today['year']+10; $i++) {

        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%y',mktime(0,0,0,1,1,$i)));

      }

	

	  /* Modifiye */



function yuvarla($sayi) {



	$pos=strpos($sayi, ".");

	$sayison=substr($sayi, 0, $pos+2);

	$ondalik=explode(".", $sayi);

	if($ondalik[1][2] >= 5):

		$sayison+=0.01;

		endif;



	return $sayison; }



  //require(DIR_WS_CLASSES . 'order.php');

  $toplam = $order->info['total'];

  $toplam = number_format($toplam, 2, '.',' ');



global $currencies;
$bankalar = explode( ",", BANKALAR );
for ($a=0; $a<3; $a++) {

	$bank_taks_c = 'MODULE_PAYMENT_'.$bankalar[$a].'_KEY';
	$bank_taks_con = constant($bank_taks_c);
        $t = 'taksit'.($a+1);//  ${$t}[]  >  http://php.net/manual/en/language.variables.variable.php
        
        
	$taksit_title = VADE_FARKI;
	$table_cost = split("[:,]" , $bank_taks_con);
	$size = sizeof($table_cost);
        
        ${$t}[]=array('id' => '', 'text' => '— TEK ÇEKİM : ' . $currencies->format($order->info['total']) );
        for ($i=0,$l=0, $n=$size; $i<$n; $i+=2,$l++) {
        
        	$tak[] = $table_cost[$i+1];// $tak[$l] taksit faiz oranlarÄ± array, taksit sayÄ±sÄ± iÃ§in $l+1
		
		
		${$t}[] = array('id' => $l+1, 'text' => ($l+1) .' Taksit : '. $currencies->format(($order->info['total']+($order->info['total']*($tak[$l]/100))))); 
	}//for
	}//for

  $selection = array('id' => $this->code,

                         'module' => $this->title,

                         'fields' => array(

	array('title' => '<div style="line-height:32px;vertical-align:middle;"><small>' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER . '</small></div>',
		'field' => tep_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'],'class="form-control"')),

                                           array('title' => '<div style="line-height:32px;vertical-align:middle;"><small>' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER.'</small></div>',

                                                 'field' => '<div style="line-height:32px;vertical-align:middle;">'.tep_draw_input_field('cc_number', '', 'style="background:url('. get_bloginfo('template_url').'/placeholder.png) no-repeat right 3px top 6px #ffffff;" maxlength="16" class="form-control"').'<small id="bankaadi"></small></div>'),


                                          /* array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,

                                                 'field' => tep_draw_input_field('cc_nr1', '', 'maxlength="4" size="4"').tep_draw_input_field('cc_nr2', '', 'maxlength="4" size="4"').tep_draw_input_field('cc_nr3', '', 'maxlength="4" size="4"').tep_draw_input_field('cc_nr4', '', 'maxlength="4" size="4"')),
*/
array('title' => '<div style="line-height:32px;vertical-align:middle;"><small>' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES . '</small></div>',

'field' => '<div style="display:inline;float:left;">'.tep_draw_input_field('cc_expires_full', '', 'placeholder="'.__( 'MM / YY','wosci-language' ) .'" class="form-control" style="width:100px;" maxlength="10"') . '</div>&nbsp;&nbsp;<div style="display:inline;float:right;">'. tep_draw_input_field('cc_checkcode', '', 'placeholder="CVV" class="form-control" style="width:100px;" maxlength="4"').tep_draw_hidden_field('bankaID', '').tep_draw_hidden_field('bankaADI', '').'</div></div>'
                                                 ),


/*
                                           array('title' => '<div style="line-height:32px;vertical-align:middle;"><small>' . MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES . '</small></div>',

                                                 'field' => tep_draw_pull_down_menu('cc_expires_month', $expires_month,'','class="form-control" style="display:inline;float:left;width:80px;"') . '&nbsp;' . tep_draw_pull_down_menu('cc_expires_year', $expires_year,'','class="form-control" style="float:right;display:inline;width:80px;"')),
*/
/*
                                           array('title' => '<div style="line-height:32px;vertical-align:middle;"><small>' . CVV_NUMBER . '</small></div>',

                                                 'field' => '<div style="display:inline;float:left;">'.tep_draw_input_field('cc_checkcode', '', 'class="form-control" style="font-size:11px;width:50px;" maxlength="4"') . '</div><div style="display:inline;"><small style="line-height:32px;vertical-align:middle;margin:0 0 0 6px;">' . CVV_NOTE . '</small></div>'.),

					*/						

											

						array('title' => '<div style="line-height:32px;display:inline;float:left;"><small id="cardfinans_taksit">Taksit Seçimi:</small></div>',

                                                 'field' => '<div style="display:inline;float:left;">'.tep_draw_pull_down_menu('finansbank_cc_taksit', $taksit,'','class="form-control"') .tep_draw_pull_down_menu('bonuskart_cc_taksit', $taksit2,'','class="form-control"').tep_draw_pull_down_menu('ykb_cc_taksit', $taksit3,'','class="form-control"').'<input name="ccdata" type="hidden" value="1"></div>'.'<!--&nbsp;<BR><div class="finans_taksit_not"><small>' . '<font color=#FF0033><B>Sadece <font color=#6600FF>CardFinans</font> sahipleri bu taksit seçeneğinden yararlanabilir.</B> <BR><B>Eğer kartınız başka bir bankadansa lütfen bu seçeneği değiştirmeyiniz.</B></font>' . '</small></div>-->'),

													 

						/*array('title' => '<div id="bonus_taksit">Bonus Kart Taksit:</div>',

                                                 'field' => '&nbsp;' . tep_draw_pull_down_menu('bonuskart_cc_taksit', $taksit2) . '<!--&nbsp;<BR><div class="bonus_taksit_not"><small>' . '<font color=#FF0033><B>Sadece <font color=#009900>Bonus Kart</font> sahipleri bu taksit seÃ§eneÄŸinden yararlanabilir.</B> <BR><B>EÄŸer kartÄ±nÄ±z baÅŸka bir bankadansa lÃ¼tfen bu seÃ§eneÄŸi deÄŸiÅŸtirmeyiniz.</B></font>' . '</small></div>-->'),
                                                 
                                                 array('title' => '<div id="ykb_taksit">WORLD CARD Taksit:</div>',

                                                 'field' => tep_draw_pull_down_menu('ykb_cc_taksit', $taksit3) . '&nbsp;<!--<div class="ykb_taksit_not"><small>' . '<font color=#FF0033><B>Sadece <font color=#4a085c>WORLD CARD</font> sahipleri bu taksit seÃ§eneÄŸinden yararlanabilir.</B> <BR><B>EÄŸer kartÄ±nÄ±z baÅŸka bir bankadansa lÃ¼tfen bu seÃ§eneÄŸi deÄŸiÅŸtirmeyiniz.</B></font>' . '</small></div>-->'),*/
//kullanÄ±cÄ± bilgilerini ykb ortak Ã¶deme sayfasÄ±nda girmek isterse aÅŸaÄŸÄ±daki kutu ile seÃ§enek aktif edilebilir, kart giriÅŸ alanlarÄ± disabled yapÄ±labilir javascript ile (checkout_payment.php sayfasÄ±nda bulunuyor js kodu)
                    //'<input name="ccdata" type="checkbox" value="1" onclick="DisBox()">'                             
                                                 /*array('title' => '<div style="padding:20px;margin-top:80px;"></div>',

                                                 'field' => '<div style="padding:20px;margin-top:80px;"></div>')*/
                                                 ) );



      return $selection;

    }



function pre_confirmation_check() {
global $_POST;

if(!class_exists('cc_validation')){
	include( '/../../classes/cc_validation.php'); 	
}
      
$cc_validation = new cc_validation();
      $expiredate = explode('/',$_POST['cc_expires_full']);

      $result = $cc_validation->validate($_POST['cc_number'], $expiredate[0], $expiredate[1]);



      $error = '';

      switch ($result) {

        case -1:

          $error = sprintf(__( 'As the first four digits of the number entered this type of credit cards not accepted. Please try again.', 'wosci-language' ), substr($cc_validation->cc_number, 0, 4));

          break;

        case -2:

        case -3:

        case -4:

          $error = TEXT_CCVAL_ERROR_INVALID_DATE;

          break;

        case false:

          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;

          break;

      }



      if ( ($result == false) || ($result < 1) ) {

        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&cc_owner=' . urlencode($_POST['cc_owner']) . '&cc_expires_month=' . $expiredate[0] . '&cc_expires_year=' . $expiredate[1] . '&cc_checkcode=' . $_POST['cc_checkcode'];



        tep_redirect(tep_href_link('shipping-payment', $payment_error_return, 'SSL', true, false));

      }



      $this->cc_card_type = $cc_validation->cc_type;

      $this->cc_card_number = $cc_validation->cc_number;

      $this->cc_expiry_month = $cc_validation->cc_expiry_month;

      $this->cc_expiry_year = $cc_validation->cc_expiry_year;

    }



    function confirmation() {

      global $_POST;

$expiredate = explode('/',$_POST['cc_expires_full']);

      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,

                            'fields' => array(array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER,

                                                    'field' => $_POST['cc_owner']),

                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER,

                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('*', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),

                                              array('title' => MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES,

                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$expiredate[0], 1, '20' . $expiredate[1])))));



      if (tep_not_null($_POST['cc_checkcode'])) {

        $confirmation['fields'][] = array('title' => CVV_NUMBER,

                                          'field' => $_POST['cc_checkcode']); }


	  if ((int)$_POST['ykb_cc_taksit'] > 0) {

        $confirmation['fields'][] = array('title' => '<font color="#000099"><B>WorldCard </B></font> Taksit SeÃ§eneÄŸi:',

                                          'field' => $_POST['ykb_cc_taksit']);

      }


	  if ((int)$_POST['finansbank_cc_taksit'] > 0) {

        $confirmation['fields'][] = array('title' => '<font color="#000099"><B>CardFinans</B></font> Taksit SeÃ§eneÄŸi:',

                                          'field' => $_POST['finansbank_cc_taksit']);

      }



	  if ((int)$_POST['bonuskart_cc_taksit'] > 0) {

        $confirmation['fields'][] = array('title' => '<font color="#009900"><B>Bonus Kart</B></font> Taksit SeÃ§eneÄŸi:',

                                          'field' => $_POST['bonuskart_cc_taksit']);

      }



      return $confirmation;

    }



    function process_button() {
      global $_POST, $order;

      $process_button_string = tep_draw_hidden_field('oid', date('Ymdhis')) . tep_draw_hidden_field('sessionid', tep_session_id()).tep_draw_hidden_field('total', $order->info['total']);
      $expiredate = explode('/',$_POST['cc_expires_full']);
						   
switch ($_POST['bankaID']) {
    case "62": // Garanti bankas?


		$process_button_string.=
		tep_draw_hidden_field('expmonth', $expiredate[0]) .
		tep_draw_hidden_field('expyear', $expiredate[1]) .
		tep_draw_hidden_field('cardno', $_POST['cc_number']) .
		tep_draw_hidden_field('cv2', $_POST['cc_checkcode']) .
		tep_draw_hidden_field('taksit', $_POST['finansbank_cc_taksit']) .
		tep_draw_hidden_field('bonus_taksit', $_POST['bonuskart_cc_taksit']) .
		tep_draw_hidden_field('mode', 'auth') .
		tep_draw_hidden_field('currency', '949') .
		tep_draw_hidden_field('Bname', $order->billing['firstname'] . ' ' . $order->billing['lastname']).
		tep_draw_hidden_field('bankaID', $_POST['bankaID']);


        break;
    case "67": // Yap? kredi


    $mid = MID;
    $tid = TID;
    $posnetid = POSNETID;
    $ykbOOSURL = OOS_TDS_SERVICE_URL;
    $xmlServiceURL = XML_SERVICE_URL;







    //??lem Bilgileri
    /*
    Bu bilgiler bir Ã¶nceki sayfadan al?nmaktad?r.Ancak bu bilgilerin
    session'dan al?nmas? sistemin daha gÃ¼venli olmas?n? sa?l?yacakt?r.
    */

    $xid = 'YKB_0000'.date("ymdHis");
    $instnumber = $_POST['ykb_cc_taksit'];
    $amount = round($order->info['total']*100);
    $currencycode = 'YT';
    $custName = $order->customer['firstname'].' '.$order->customer['lastname'];
    $trantype = 'Sale';//Auth,Sale,WP,SaleWP,Vft
    $vftCode = 'K001';//vade farkl? sat?? kampanya kodu
    $openANewWindow = 'false';// yeni pencerede aÃ§?ls?n m?? form iÃ§in target="YKBWindow"

/* PENCERE JS KODU -- yukar?daki target ve a?a??daki js kodunu kullanarak pencere versiyonunu kullanabilirsin--
<script language="JavaScript" type="text/JavaScript">
function submitFormEx(Form, OpenNewWindowFlag, WindowName) {
    	submitForm(Form, OpenNewWindowFlag, WindowName)
    	Form.submit();
}
</script>
*/
    //E?er ki kredi kart? bilgileri Ã¼ye i?yeri sayfas?nda al?nacak ise
    if(array_key_exists("ccdata", $_POST))
    {
        $ccdataisexist = true;
        $ccno = $_POST['cc_number'];
        $expdate = $expiredate[0].$expiredate[1];
        $cvc = $_POST['cc_checkcode'];
    }
    else {
        $ccdataisexist = false;
}
    $posnetOOS = new PosnetOOS;
    //$posnetOOS->SetDebugLevel(1);

    $posnetOOS->SetPosnetID($posnetid);
    $posnetOOS->SetMid($mid);
    $posnetOOS->SetTid($tid);

	
	
	    if($ccdataisexist)
    {
        //E?er ki kredi kart? bilgileri Ã¼ye i?yeri sayfas?nda al?nacak ise
        if(!$posnetOOS->CreateTranRequestDatas($custName,
                                        $amount,
                                        $currencycode,
                                        $instnumber,
                                        $xid,
                                        $trantype,
                                        $ccno,
                                        $expdate,
                                        $cvc
                                        ))
        {
            echo("PosnetData'lari olusturulamadiE.<br>".
                        "Data1 = ".$posnetOOS->GetData1()."<br>".
                        "Data2 = ".$posnetOOS->GetData2()."<br>".
                        "XML Response Data = ".$posnetOOS->GetResponseXMLData()
                );
            echo("Error Code : ".$posnetOOS->GetResponseCode());
            echo("<br>");
            echo("Error Text : ".$posnetOOS->GetResponseText());
        }
    }
    else
    {
        //Kart Bilgilerinin OOS sisteminde girilmesi isteniyor ise
        if(!$posnetOOS->CreateTranRequestDatas($custName,
                                        $amount,
                                        $currencycode,
                                        $instnumber,
                                        $xid,
                                        $trantype
                                        ))
        {
            echo("<html>");
            echo("PosnetData'lari olusturulamadi.<br>".
                       "Data1 = ".$posnetOOS->GetData1()."<br>".
                       "Data2 = ".$posnetOOS->GetData2()."<br>".
                       "XML Response Data = ".$posnetOOS->GetResponseXMLData()
                );
            echo("Error Code : ".$posnetOOS->GetResponseCode());
            echo("<br>");
            echo("Error Text : ".$posnetOOS->GetResponseText());
            echo("</html>");
            return;
        }
    }








$s_id = tep_session_id();
$okURL = HTTPS_SERVER.DIR_WS_HTTP_CATALOG.'kk_provizyon.php';
$failURL = HTTPS_SERVER.DIR_WS_HTTP_CATALOG.'checkout_payment.php?osCsid='.$s_id;

//3d_pay_hosting , 3d_oos_pay
$process_button_string = '<input name="posnetData" type="hidden" id="posnetData" value="'.$posnetOOS->GetData1().'">
      <input name="posnetData2" type="hidden" id="posnetData2" value="'.$posnetOOS->GetData2().'">
      <input name="mid" type="hidden" id="mid" value="'.$mid.'">
      <input name="posnetID" type="hidden" id="posnetID" value="'.$posnetid.'">
      <input name="digest" type="hidden" id="sign" value="'.$posnetOOS->GetSign().'">
      <input name="vftCode" type="hidden" id="vftCode" value="'.$vftCode.'">
      <input name="merchantReturnURL" type="hidden" id="merchantReturnURL" value="'.$okURL.'">
      <!-- <input name="koiCode" type="hidden" id="koiCode" value="2"> -->
      
      <!-- Static Parameters -->
      <input name="lang" type="hidden" id="lang" value="tr">
      <input name="url" type="hidden" id="url" value="">
      <input name="openANewWindow" type="hidden" id="openANewWindow" value="1">
      <input name="bankaID" type="hidden" id="bankaID" value="'.$_POST['bankaID'].'">';




        break;
    case "111": // finansbank

		$process_button_string.=
		tep_draw_hidden_field('expmonth', $expiredate[0]) .
		tep_draw_hidden_field('expyear', $expiredate[1]) .
		tep_draw_hidden_field('cardno', $_POST['cc_number']) .
		tep_draw_hidden_field('cv2', $_POST['cc_checkcode']) .
		tep_draw_hidden_field('taksit', $_POST['finansbank_cc_taksit']) .
		tep_draw_hidden_field('bonus_taksit', $_POST['bonuskart_cc_taksit']) .
		tep_draw_hidden_field('mode', 'auth') .
		tep_draw_hidden_field('currency', '949') .
		tep_draw_hidden_field('Bname', $order->billing['firstname'] . ' ' . $order->billing['lastname']).
		tep_draw_hidden_field('bankaID', $_POST['bankaID']);

        break;
        
     default:    
		$process_button_string.=
		tep_draw_hidden_field('expmonth', $expiredate[0]) .
		tep_draw_hidden_field('expyear', $expiredate[1]) .
		tep_draw_hidden_field('cardno', $_POST['cc_number']) .
		tep_draw_hidden_field('cv2', $_POST['cc_checkcode']) .
		tep_draw_hidden_field('taksit', $_POST['finansbank_cc_taksit']) .
		tep_draw_hidden_field('bonus_taksit', $_POST['bonuskart_cc_taksit']) .
		tep_draw_hidden_field('mode', 'auth') .
		tep_draw_hidden_field('currency', '949') .
		tep_draw_hidden_field('Bname', $order->billing['firstname'] . ' ' . $order->billing['lastname']).
		tep_draw_hidden_field('bankaID', $_POST['bankaID']);
}

      return $process_button_string;

    }



    function before_process() {

	   return false;

	    }

 	   

 	  function after_process() {

      	    return false;



	 	  }

     

    function get_error() {

      global $_GET;



      $error = array('title' => __('Credit Card Error', 'wosci-language'),

                     'error' => ((isset($_GET['error'])) ? stripslashes(urldecode($_GET['error'])) : __('Please check your credit card details', 'wosci-language')));



      return $error;

    }



    function check() {

      if (!isset($this->_check)) {

        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_STATUS'");

        $this->_check = tep_db_num_rows($check_query);

      }

      return $this->_check;

    }





    function install() {

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Credit Card Module', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)', '6', '0', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0' , now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_CC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");

    }



    function remove() {

      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");

    }



    function keys() {

      return array('MODULE_PAYMENT_CC_STATUS');

    }

  }

?>