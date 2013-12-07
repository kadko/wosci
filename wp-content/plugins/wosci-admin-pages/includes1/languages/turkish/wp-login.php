<?php
/*
  $Id: login.php,v 1.14 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('NAVBAR_TITLE', 'Giriş');
define('HEADING_TITLE', 'Hoş Geldiniz, İçeri Buyurun!');

define('HEADING_NEW_CUSTOMER', 'Yeni Müşteri');
define('TEXT_NEW_CUSTOMER', 'Yeni bir müşteriyim.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Hızlı ve güvenli alışveriş yapmak için  <b>' . STORE_NAME . '</b>\'da bir hesap açın, Böylece siparişlerinizi takip edebilir, yeni ürünlerimiz ve kampanyalarımız hakkinda bilgi edinebilirsiniz.');

define('HEADING_RETURNING_CUSTOMER', 'Üye Girişi');
define('TEXT_RETURNING_CUSTOMER', 'Bu mağazaya üyeyim.');

define('TEXT_PASSWORD_FORGOTTEN', 'Şifrenizi mi unuttunuz? Buraya tıklayınız.');

define('TEXT_LOGIN_ERROR', 'Hata: E-Posta Adresiniz ile Şifreniz uyuşmamaktadır. Lütfen kontrol edip tekrar deneyiniz.');
define('TEXT_VISITORS_CART', 'Not: &quot;Ziyaretçi Sepeti&quot;nizin içeriği giriş yapınca &quot;Üye Sepeti&quot;nizin içeriğiyle birleşecektir. <a href="javascript:session_win();">[Daha Fazla Bilgi]</a>');
// BOF Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', 'root@localhost');
// **TIP:** The above root@localhost entry should be replaced with the site Admin's email address. This enables him to log-in as a member of each group for testing purposes. This email address must be defined in the osC Admin section called Configuration. 
//EOF Separate Pricing Per Customer
?>