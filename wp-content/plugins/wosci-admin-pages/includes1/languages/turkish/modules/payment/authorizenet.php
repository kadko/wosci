<?php
/*
  $Id: authorizenet.php,v 1.13 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE', 'Authorize.net');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Kredi Kartı Test Bilgisi:<br><br>CC#: 4111111111111111<br>Son Kullanma: sınırsız');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', 'Tür:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER', 'Kredi Kartı Sahibi:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', 'Kredi Kartı Numarası:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', 'Kredi Kartı Son Kullanım Tarihi:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* Kredi Kartı sahibi ismi en az ' . CC_OWNER_MIN_LENGTH . ' karakter olmalıdır.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* Kredi kartı numarası en az ' . CC_NUMBER_MIN_LENGTH . ' karakter olmalıdır.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'Kredi kartınızla yaptığımız işlemde hata oluştu. Lütfen tekrar deneyiniz.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', 'Kredi kartınız reddedildi. Lütfen farklı bir kart deneyin veya daha fazla bilgi için bankanızla iletişim kurunuz.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Kredi Kartı Hatası!');
?>
