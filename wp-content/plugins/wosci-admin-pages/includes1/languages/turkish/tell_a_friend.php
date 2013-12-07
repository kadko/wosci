<?php
/*
  $Id: tell_a_friend.php,v 1.7 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('NAVBAR_TITLE', 'Arkadaşıma Gönder');

define('HEADING_TITLE', '\'%s\' Arkadaşıma Gönder');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Bilgileriniz');
define('FORM_TITLE_FRIEND_DETAILS', 'Arkadaşınızın Bilgileri');
define('FORM_TITLE_FRIEND_MESSAGE', 'Mesajınız');

define('FORM_FIELD_CUSTOMER_NAME', 'İsminiz:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'E-posta Adresiniz:');
define('FORM_FIELD_FRIEND_NAME', 'Arkadaşınızın İsmi:');
define('FORM_FIELD_FRIEND_EMAIL', 'Arkadaşınızın E-posta Adresi:');

define('TEXT_EMAIL_SUCCESSFUL_SENT', '<b>%s</b> ile ilgili e-postanız arkadaşınız <b>%s</b> başarılı bir şekilde gönderilmiştir.');

define('TEXT_EMAIL_SUBJECT', 'Arkadaşınız %s ilgileneceğinizi düşünerek size %s den önemli bir ürün önermiştir.');
define('TEXT_EMAIL_INTRO', 'Merhaba %s!' . "\n\n" . 'Arkadaşınız, %s, ilgileneceğinizi düşünerek size %s ürününü önermiştir. %s web sayfalarından ürün hakkında ayrıntılı bilgi alabilirsiniz.');
define('TEXT_EMAIL_LINK', 'Ürünü görmek için link\'e tıklayınız yada link\'i kopyala-yapıştır yaparak web tarayıcınızın adres satırına yapıştırınız:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Saygılar,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Hata: Arkadaşınızın ismi boş olmamalıdır.');
define('ERROR_TO_ADDRESS', 'Hata: Arakadaşınızın e-posta adresi geçerli bir e-posta adresi olmalıdır.');
define('ERROR_FROM_NAME', 'Hata: İsminiz boş olmamalıdır.');
define('ERROR_FROM_ADDRESS', 'Hata: E-posta adresiniz geçerli bir e-posta adresi olmalıdır.');
?>