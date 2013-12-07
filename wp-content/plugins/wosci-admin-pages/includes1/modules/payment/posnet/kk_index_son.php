<?php

    /**
     * @package posnet oostest
     */

    //Include POSNETOOS Class
	require_once('posnet_oos_config.php');
	require_once('Posnet Modules/Posnet OOS/posnet_oos.php');
    
    //Üye iþyeri Bilgileri
    $mid = MID;
    $tid = TID;
    $posnetid = POSNETID;
    $ykbOOSURL = OOS_TDS_SERVICE_URL;
    $xmlServiceURL = XML_SERVICE_URL;

    //Ýþlem Bilgileri
    /*
    Bu bilgiler bir önceki sayfadan alýnmaktadýr.Ancak bu bilgilerin
    session'dan alýnmasý sistemin daha güvenli olmasýný saðlýyacaktýr.
    */
    $xid = $HTTP_POST_VARS['XID'];
    $instnumber = $HTTP_POST_VARS['instalment'];
    $amount = $HTTP_POST_VARS['amount'];
    $currencycode = $HTTP_POST_VARS['currency'];
    $custName = $HTTP_POST_VARS['custName'];
    $trantype = $HTTP_POST_VARS['tranType'];
    $vftCode = $HTTP_POST_VARS['vftCode'];
    $openANewWindow = $HTTP_POST_VARS['openANewWindow'];

    //Eðer ki kredi kartý bilgileri üye iþyeri sayfasýnda alýnacak ise
    if(array_key_exists("ccdata", $HTTP_POST_VARS))
    {
        $ccdataisexist = true;
        $ccno = $HTTP_POST_VARS['ccno'];
        $expdate = $HTTP_POST_VARS['expdate'];
        $cvc = $HTTP_POST_VARS['cvv'];
    }
    else
        $ccdataisexist = false;

    $posnetOOS = new PosnetOOS;
    //$posnetOOS->SetDebugLevel(1);

    $posnetOOS->SetPosnetID($posnetid);
    $posnetOOS->SetMid($mid);
    $posnetOOS->SetTid($tid);

    //XML Servisi için
    $posnetOOS->SetURL($xmlServiceURL);
    $posnetOOS->SetUsername(USERNAME);
    $posnetOOS->SetPassword(PASSWORD);

    if($ccdataisexist)
    {
        //Eðer ki kredi kartý bilgileri üye iþyeri sayfasýnda alýnacak ise
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
            echo("PosnetData'lari olusturulamadi.<br>".
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
?>
<html>
<head>
<title>3-D Secure veya Ortak Ödeme Sayfasý Uygulama Baþlangýç Sayfasý</title>
<META HTTP-EQUIV="Content-Type" content="text/html; charset=windows-1254">
<META HTTP-EQUIV="expires" CONTENT="0">
<META HTTP-EQUIV="cache-control" CONTENT="no-cache">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<script language="JavaScript" src="https://www.posnet.ykb.com/3DSWebService/scriptler/posnet.js"></script>
<script language="JavaScript" type="text/JavaScript">
function submitFormEx(Form, OpenNewWindowFlag, WindowName) {
    	submitForm(Form, OpenNewWindowFlag, WindowName)
    	Form.submit();
}
</script>

</head>
<body>
<blockquote> 
  <blockquote>
    <p align="center"><font color="#0099FF" size="6" face="Geneva, Arial, Helvetica, sans-serif">Alýþveriþi 
      Sonlandýr, Ýþlem bilgilerini YKB' ye gönder !</font></p>
  </blockquote>
</blockquote>
<form name="formName" method="post" action="<? echo $ykbOOSURL; ?>" target="YKBWindow">
  <div align="center"> 
    <table width="44%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
      <tr bordercolor="#0099FF"> 
        <td height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">Sipariþ 
          Numarasý :</font></td>
        <td height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">&nbsp;<? echo $xid; ?></font></td>
      </tr>
      <tr bordercolor="#0099FF"> 
        <td height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">Toplam 
          tutar (x100) :</font></td>
        <td height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">&nbsp;<? echo $amount; ?></font></td>
      </tr>
      <tr BORDERCOLOR="#0099ff">
        <td height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">Para 
          Birimi  :</font></td>
        <td height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">&nbsp;<? echo $currencycode; ?></font></td>
      </tr>
      <tr bordercolor="#0099FF">
        <td width="46%" height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">Taksit
          sayýsý :</font></td>
        <td width="54%" height="28" bordercolor="#CCCCCC"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">&nbsp;<? echo $instnumber; ?></font></td>
      </tr>
    </table>
    <p> <font size="2">
      <input name="posnetData" type="hidden" id="posnetData" value="<? echo $posnetOOS->GetData1(); ?>">
      <input name="posnetData2" type="hidden" id="posnetData2" value="<? echo $posnetOOS->GetData2(); ?>">
      <input name="mid" type="hidden" id="mid" value="<? echo $mid; ?>">
      <input name="posnetID" type="hidden" id="posnetID" value="<? echo $posnetid; ?>">
      <input name="digest" type="hidden" id="sign" value="<? echo $posnetOOS->GetSign(); ?>">
      <input name="vftCode" type="hidden" id="vftCode" value="<? echo $vftCode; ?>">
      <input name="merchantReturnURL" type="hidden" id="merchantReturnURL" value="http://kaan_oztemir_xp/php/oos_tds_prog/kk_provizyon.php">
      <!-- <input name="koiCode" type="hidden" id="koiCode" value="2"> -->
      
      <!-- Static Parameters -->
      <input name="lang" type="hidden" id="lang" value="tr">
      <input name="url" type="hidden" id="url" value="">
      <input name="openANewWindow" type="hidden" id="openANewWindow" value="0">
      </font></p>
    <p>
      <input name="imageField" type="image" onClick="submitFormEx(formName, <? echo $openANewWindow; ?>, 'YKBWindow');this.disabled=true;" SRC="images/button_odeme_yap.gif"  width="67" height="20" border="0">
      &nbsp;<A HREF="javascript:formName.submit()" onClick="submitFormEx(formName, <? echo $openANewWindow; ?>, 'YKBWindow');this.disabled=true;"><FONT FACE="Geneva, Arial, Helvetica, sans-serif"><STRONG>Ödeme Yap</STRONG></FONT></A> <FONT SIZE="2">
      &nbsp;<input type="submit" name="Submit" value="Ödeme Yap" onClick="submitFormEx(formName, <? echo $openANewWindow; ?>, 'YKBWindow');this.disabled=true;">
      </FONT></p>
  </div>
  <div align="center"> <font size="2"> 
    <input type="button" name="Back" value="Vazgeç" onClick="history.back()">
    </font></div>

</form>
</body>
</html>