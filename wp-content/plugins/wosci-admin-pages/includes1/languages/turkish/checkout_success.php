<?php
/*
  $Id: checkout_success.php,v 1.11 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('NAVBAR_TITLE_1', 'Ödeme');
define('NAVBAR_TITLE_2', 'Başarılı');

define('HEADING_TITLE', 'Siparişiniz Tamamlandı!');

define('TEXT_SUCCESS', 'Siparişiniz başarılı bir şekilde alınmıştır! Satın aldığınız ürün  2-5 çalışma iş günü için de size ulaştırılacaktır.');
define('TEXT_NOTIFY_PRODUCTS', 'Aşağıda seçtiğim ürünler hakkında güncel haberleri bana gönder:');
define('TEXT_SEE_ORDERS', 'Geçmiş siparişlerinizi görmek için <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Hesabım\'</a> sayfasınadan <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Geçmiş\'</a> linkine tıklayınız.');
define('TEXT_CONTACT_STORE_OWNER', 'Herhangi bir sorunuzu doğrudan <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>Mağaza Sahibine</u></a> iletebilirsiniz.');
define('TEXT_THANKS_FOR_SHOPPING', 'Online alış-verişinizi bizimle yaptığınız için Teşlekkür Ederiz!');

define('TABLE_HEADING_COMMENTS', 'Şipariş işleminiz için açıklama giriniz');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Bitiş Tarihi:');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'kalan indirme sayısı');
define('HEADING_DOWNLOAD', 'Ürünü buradan indiriniz:');
define('FOOTER_DOWNLOAD', 'Bu \'%s\' tarihte ürününüzü tekrar indirebilirsiniz.');
?>