<?php
/*
  $Id: categories.php,v 1.24 05/11/2007 22:10

  osicommerce bir osCommerce Açık Kaynak E-Ticaret Çözümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('HEADING_TITLE', 'Kategoriler / Ürünler');
define('HEADING_TITLE_SEARCH', 'Ara:');
define('HEADING_TITLE_GOTO', 'Git:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategoriler / Ürünler');
define('TABLE_HEADING_ACTION', 'Hareket');
define('TABLE_HEADING_STATUS', 'Durum');

define('TEXT_NEW_PRODUCT', '&quot;%s&quot; kategorisindeki yeni ürünler');
define('TEXT_CATEGORIES', 'Kategoriler:');
define('TEXT_SUBCATEGORIES', 'Alt kategoriler:');
define('TEXT_PRODUCTS', 'Ürünler:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Fiyat:');
define('TEXT_PRODUCTS_PARA_BIRIMI', 'Para Birimi:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Vergi Cinsi:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Ortalama Değerlendirme:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Miktar:');
define('TEXT_DATE_ADDED', 'Eklenme Tarihi:');
define('TEXT_DATE_AVAILABLE', 'Satış Tarihi:');
define('TEXT_LAST_MODIFIED', 'Son Güncellenme:');
define('TEXT_IMAGE_NONEXISTENT', 'RESİM BULUNMUYOR');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Lütfen yeni kategori ya da ürünü bu seviyede oluşturun.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Daha fazla bilgi için bu ürünün <a href="http://%s" target="blank"><u>websitesini</u></a> ziyaret edin.');
define('TEXT_PRODUCT_DATE_ADDED', 'Bu ürün, kataloğumuza %s tarihinde eklendi.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Bu ürün, %s tarihinde stoğumuzda olacak..');

define('TEXT_EDIT_INTRO', 'Lütfen gereken değişiklikleri yapın.');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategori ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategori İsmi:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategori Resmi:');
define('TEXT_EDIT_SORT_ORDER', 'Sıralama:');

define('TEXT_INFO_COPY_TO_INTRO', 'Lütfen bu ürünü kopyalamak istediğiniz kategoriyi seçin');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Şu andaki kategoriler:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Yeni Kategori');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategori Güncelle');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategori Sil');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategoriyi Taşı');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Ürünü Sil');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Ürünü Taşı');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopyala');

define('TEXT_DELETE_CATEGORY_INTRO', 'Bu kategoriyi silmek istediğinize emin misiniz?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Bu ürünü tamamen silmek istediğinize emin misiniz?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>DİKKAT:</b> Bu kategoriye bağlı olan %s adet (alt-)kategori bulunmakta!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>DİKKAT:</b> Bu kategoriye bağlı olan %s adet ürün bulunmakta!');

define('TEXT_MOVE_PRODUCTS_INTRO', '<b>%s</b> ürününü hangi kategori içine koymak istiyorsanız aşağıdan seçiniz');
define('TEXT_MOVE_CATEGORIES_INTRO', '<b>%s</b> kategorisini hangi kategori içine koymak istiyorsanız aşağıdan seçiniz');
define('TEXT_MOVE', '<b>%s</b> hedefe taşı:');

define('TEXT_NEW_CATEGORY_INTRO', 'Lütfen aşağıdaki bilgileri yeni kategori için girin');
define('TEXT_CATEGORIES_NAME', 'Kategori İsmi:');
define('TEXT_CATEGORIES_IMAGE', 'Kategori Resmie:');
define('TEXT_SORT_ORDER', 'Sıralama:');

define('TEXT_PRODUCTS_STATUS', 'Ürünlerin Durumları:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Kullanılabilir Tarih:');
define('TEXT_PRODUCT_AVAILABLE', 'Stokta Mevcut');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Stokta Mevcut Değil');
define('TEXT_PRODUCTS_MANUFACTURER', 'Üreticiler:');
define('TEXT_PRODUCTS_NAME', 'Ürün İsmi:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Ürün Tanıtımı:');
define('TEXT_PRODUCTS_QUANTITY', 'Ürün Miktarı:');
define('TEXT_PRODUCTS_MODEL', 'Ürün Modeli:');
define('TEXT_PRODUCTS_IMAGE', 'Ürün Resmi:');
define('TEXT_PRODUCTS_URL', 'Ürün URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(http:// yazmayın)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Ürün Fiyatı (Net):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Ürün Fiyatı (Brüt):');
define('TEXT_PRODUCTS_WEIGHT', 'Ürün Ağırlığı:');

define('EMPTY_CATEGORY', 'Boş Kategori');

define('TEXT_HOW_TO_COPY', 'Kopya Metodu:');
define('TEXT_COPY_AS_LINK', 'Ürün bağlantısı');
define('TEXT_COPY_AS_DUPLICATE', 'Yinelenen ürün');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Hata: Ürünler aynı kategoriye bağlanamıyor.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Hata: Katalog resim dizini yazılabilir değil: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Hata: Katalog resim dizini bulunamıyor: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Hata: Kategori alt kategoriye taşınamıyor.');
/*** Begin Header Tags SEO ***/
define('TEXT_PRODUCT_METTA_INFO', '<b>Meta Tag Bilgileri</b>');
define('TEXT_PRODUCTS_PAGE_TITLE', 'Sayfa başlık etiketi:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Ürün açıklama etiketi:');
define('TEXT_PRODUCTS_KEYWORDS', 'Ürün anahtar kelime etiketi:');
/*** End Header Tags SEO ***/
// BOF Separate Pricing Per Customer
define('TEXT_CUSTOMERS_GROUPS_NOTE', 'Note that if a field is left empty, no price for that customer group will be inserted in the database.<br />
If a field is filled, but the checkbox is unchecked no price will be inserted either.<br />
If a price is already inserted in the database, but the checkbox unchecked it will be removed from the database.
<div style="font-size:1.2em;padding-top:10px;">Sadece fiyat veya aşağıdaki gibi adet bazında dizi fiyat girebilirsiniz. Örnekte 0 ile 5 adet arasında satın alındığında ürün fiyatı 19 iken 6 ile 10 adet arasında alınırsa fiyat 16 olur.</div>
<div style="font-size:1.4em;">0-5=>19, 6-10=>9, 11-20=>8, 21-30=>7</div>');
// EOF Separate Pricing Per Customer
?>