<?php
/*
  $Id: password_forgotten.php,v 1.6 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('NAVBAR_TITLE_1', 'Giriş');
define('NAVBAR_TITLE_2', 'Şifre Hatırlatma');

define('HEADING_TITLE', 'Şifremi Unuttum!');

define('TEXT_MAIN', 'Şifrenizi unuttuysanız, aşağıya e-posta adresinizi giriniz. Size yeni şifrenizi içeren e-postayı göndereceğiz');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Hata: Girdiğiniz E-Posta Adresi kayıtlarımızda bulunamadı, lütfen terkrar deneyiniz.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Yeni Şifre');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Yeni şifre talebiniz ' . $REMOTE_ADDR . ' adresinden yapılmıştır.' . "\n\n" . STORE_NAME . ' için yeni şifreniz:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Başarılı: Yeni şifreniz e-posta adresinize gönderilmiştir.');
?>