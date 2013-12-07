<?php
/*
  $Id: cc.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_CC_TEXT_TITLE', 'Kredi Kartı');
  define('MODULE_PAYMENT_CC_TEXT_PUBLIC_TITLE', 'Kredi Kartı');
  define('MODULE_PAYMENT_CC_TEXT_DESCRIPTION', 'Tüm bankalar için kredi kartı modülü');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER', 'Kart Sahibi Ad Soyad:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER', 'Kredi Kartı Numarası:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES', 'Geçerlilik ve CVV Kodu:');
  define('MODULE_PAYMENT_CC_TEXT_ERROR', 'Kedi Kartı Hatası!');
  define('CVV_NOTE', 'Kartın arkasındaki son üç rakam');
  define('CVV_NUMBER', 'Kart Güvenlik Kodu');
  define('MODULE_FIXED_PAYMENT_CHG_TITLE', 'Ödeme Tipine Göre Tutar Ekle');
  define('VADE_FARKI', 'Taksit Vade Farkı');

  //js  
  define('MODULE_PAYMENT_FINANSBANK_TEXT_JS_CC_OWNER', 'Kart Sahibi Ad Soyad\n');
  define('MODULE_PAYMENT_FINANSBANK_TEXT_JS_CC_NUMBER', 'Kredi Kartı Numarası\n');
  define('MODULE_PAYMENT_FINANSBANK_TEXT_JS_CVVNUMBER', 'Kart Güvenlik Kodu\n');

  //Taksitler
  define('MODULE_PAYMENT_62_KEY', '1:0,2:3,3:4.5,4:6,5:7.75,6:9,7:10,8:11,9:12,10:13,11:14,12:15');//Garanti
  define('MODULE_PAYMENT_111_KEY', '1:0,2:3,3:4.5,4:6,5:7.75,6:9,7:10,8:11,9:12,10:13,11:14,12:15');//Finansbank
  define('MODULE_PAYMENT_67_KEY', '1:0,2:3,3:4.5,4:6,5:7.75,6:9,7:10,8:11,9:12,10:13,11:14,12:15');//YKB  

  //websitesinde aktif olarak kullanılan sanal posların banka kodları
  define('BANKALAR', '62,67,111');//Garanti

?>