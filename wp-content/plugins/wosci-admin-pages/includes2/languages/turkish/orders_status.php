<?php
/*
  $Id: orders_status.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Sipariş Durumları');

define('TABLE_HEADING_ORDERS_STATUS', 'Sipariş Durumu');
define('TABLE_HEADING_PUBLIC_STATUS', 'Müşteriyede Görüntülensin');
define('TABLE_HEADING_DOWNLOADS_STATUS', 'İndirme Durumu');
define('TABLE_HEADING_ACTION', 'İşlem');

define('TEXT_INFO_EDIT_INTRO', 'Gerekli Değişiklikleri Yapınız');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Sipariş Durumu:');
define('TEXT_INFO_INSERT_INTRO', 'Lütfen yeni sipariş durumlarını ve onlara ait bilgileri giriniz.');
define('TEXT_INFO_DELETE_INTRO', 'Bu sipariş durumunu silmek istediğinizden eminmisiniz?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Yeni Sipariş Durumu');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Sipariş Durumunu Düzenle');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Sipariş Durumunu Sil');

define('TEXT_SET_PUBLIC_STATUS', 'Bu sipariş durumundayken müşteriye siparişi göster');
define('TEXT_SET_DOWNLOADS_STATUS', 'Bu sipariş durumundayken sanal ürünler için indirmelere izin ver');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Hata: varsayılan sipariş durumu silinemez. Lütfen başka bir sipariş durumunu varsayılan yapıp tekrar deneyin.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Hata: Bu sipariş durumu siparişlerde kullanılıyor.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Hata: Bu sipariş durumu müşterilerin sipariş geçmişi kayıtlarında kullanılıyor.');
?>