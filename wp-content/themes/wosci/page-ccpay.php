<?php
//	require('includes/application_top.php');
	$expiredate = explode('/',$_POST['cc_expires_full']);
    	$rand = mt_rand ( 0, 0xffffff );
	$order_rnd_id = sprintf ( "%06x" , $rand );
	global $order;
	if(isset($_POST['bonus_taksit'])){
	$taksit = '';
	}else{
	$taksit = $_POST['bonus_taksit'];
	}
	

	$order = new order;
	
	if($_POST['total']==''){
	$toplam = $order->info['total'];
	}else{
	$toplam = $_POST['total'];
	}
	
        $strMode = "PROD";
        $strVersion = "v0.01";
        $strTerminalID = "XX10004437XX";
        $strTerminalID_ = "XX010004437XX"; //TerminalID baþýna 0 eklenerek 9 digite tamamlanmalýdýr.
        $strProvUserID = "PROVAUT";
        $strProvisionPassword = "XX8LVAYlrwEa4KGXX"; //ProvUserID þifresi
        $strUserID = "XXXXXX";
        $strMerchantID = "XX9120770XX"; //Üye Ýþyeri Numarasý
        $strIPAddress =  $_SERVER['REMOTE_ADDR'];//"192.168.1.1";  //Müþteri IP si 
        $strEmailAddress = 'test@test.gov';
        $strOrderID = $order_rnd_id;//"Deneme";
        $strInstallmentCnt =  $taksit; //Taksit Sayýsý. Boþ gönderilirse taksit yapýlmaz
        $strNumber = $_POST['cardno'];
        $strExpireDate = $expiredate[0].$expiredate[1];
        $strCVV2 = $_POST['cv2'];
        $strAmount = $toplam*100;//"100"; //Ýþlem Tutarý 1.00 TL için 100 gönderilmelidir. 
        $strType = "sales";
        $strCurrencyCode = "949";
        $strCardholderPresentCode = "0";
        $strMotoInd = "N";
        $strHostAddress = "https://sanalposprov.garanti.com.tr/VPServlet";
        $SecurityData = strtoupper(sha1($strProvisionPassword.$strTerminalID_));
        $HashData = strtoupper(sha1($strOrderID.$strTerminalID.$strNumber.$strAmount.$SecurityData));
        $xml= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
        <GVPSRequest>
        <Mode>$strMode</Mode><Version>$strVersion</Version>
        <Terminal><ProvUserID>$strProvUserID</ProvUserID><HashData>$HashData</HashData><UserID>$strUserID</UserID><ID>$strTerminalID</ID><MerchantID>$strMerchantID</MerchantID></Terminal>
        <Customer><IPAddress>$strIPAddress</IPAddress><EmailAddress>$strEmailAddress</EmailAddress></Customer>
        <Card><Number>$strNumber</Number><ExpireDate>$strExpireDate</ExpireDate><CVV2>$strCVV2</CVV2></Card>
        <Order><OrderID>$strOrderID</OrderID><GroupID></GroupID><AddressList><Address><Type>S</Type><Name></Name><LastName></LastName><Company></Company><Text></Text><District></District><City></City><PostalCode></PostalCode><Country></Country><PhoneNumber></PhoneNumber></Address></AddressList></Order><Transaction><Type>$strType</Type><InstallmentCnt>$strInstallmentCnt</InstallmentCnt><Amount>$strAmount</Amount><CurrencyCode>$strCurrencyCode</CurrencyCode><CardholderPresentCode>$strCardholderPresentCode</CardholderPresentCode><MotoInd>$strMotoInd</MotoInd><Description></Description><OriginalRetrefNum></OriginalRetrefNum></Transaction>
        </GVPSRequest>";
    
        /*If ($_POST['IsFormSubmitted'] == ""){
        }
        else {
        */
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $strHostAddress);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, "data=".$xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $results = curl_exec($ch);
        curl_close($ch);

        /*echo "<b>Giden Ýstek </b><br />";
        echo $xml;
        echo "<br /><b>Gelen Yanýt </b><br />";
        echo $results;
        echo $toplam; echo  $_POST['cardno']; exit();*/
        
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser,$results,$vals,$index);
        xml_parser_free($xml_parser);
        
        //Sadece ReasonCode deðerini alýyoruz.
        $strReasonCodeValue = $vals[$index['REASONCODE'][0]]['value'];
        //print_r($vals);
        //echo "<br /><b>Ýþlem Sonucu </b><br />";
        if($strReasonCodeValue == "00")
        {
       
              header( 'Location: https://www.asd.com/catalog/checkout_process.php' ) ;

        } else {
             header( 'Location: https://www.asd.com/catalog/checkout_payment.php' ) ;
        }
        //}
    ?>