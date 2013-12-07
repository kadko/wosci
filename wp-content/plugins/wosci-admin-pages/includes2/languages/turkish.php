<?php
/*
  $Id: turkish.php,v 1 05/11/2007 22:10

  osicommerce bir osCommerce Açık Kaynak E-Ticaret Çözümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'tr_TR.UTF-8');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="tr"');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// page title
define('TITLE', 'osCommerce Online Merchant Yönetim Aracı');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Yönetim');
define('HEADER_TITLE_SUPPORT_SITE', 'Destek Sitesi');
define('HEADER_TITLE_ONLINE_CATALOG', 'Online Katalog');
define('HEADER_TITLE_ADMINISTRATION', 'Yönetim');

// text for gender
define('MALE', 'Erkek');
define('FEMALE', 'Kadın');

// text for date of birth example
define('DOB_FORMAT_STRING', 'gün/ay/yıl');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Ayarlar');
define('BOX_CONFIGURATION_MYSTORE', 'Mağazam');
define('BOX_CONFIGURATION_LOGGING', 'Günlük');
define('BOX_CONFIGURATION_CACHE', 'Önbellek');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Yöneticiler');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modüller');
define('BOX_MODULES_PAYMENT', 'Ödeme');
define('BOX_MODULES_SHIPPING', 'Taşıma');
define('BOX_MODULES_ORDER_TOTAL', 'Toplam Sipariş');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategoriler/Ürünler');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Ürün Özellikleri');
define('BOX_CATALOG_MANUFACTURERS', 'Üreticiler');
define('BOX_CATALOG_REVIEWS', 'Yorumlar');
define('BOX_CATALOG_SPECIALS', 'İndirimdekiler');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Beklenen Ürünler');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Müşteriler');
define('BOX_CUSTOMERS_CUSTOMERS', 'Müşteriler');
define('BOX_CUSTOMERS_ORDERS', 'Siparişler');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Şehirler / Vergiler');
define('BOX_TAXES_COUNTRIES', 'Ülkeler');
define('BOX_TAXES_ZONES', 'Şehirler(Bölgeler)');
define('BOX_TAXES_GEO_ZONES', 'Vergi Bölgeleri');
define('BOX_TAXES_TAX_CLASSES', 'Vergi Türleri');
define('BOX_TAXES_TAX_RATES', 'Vergi Oranları');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Raporlar');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Ürün ziyaret sayıları');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Satılan ürünler');
define('BOX_REPORTS_ORDERS_TOTAL', 'Müşteri Sipariş-Toplamları');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Araçlar');
define('BOX_TOOLS_BACKUP', 'Veritabanı Yedekleme');
define('BOX_TOOLS_BANNER_MANAGER', 'Reklam Yönetimi');
define('BOX_TOOLS_CACHE', 'Önbellek Yönetimi');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Dilleri Düzenle');
define('BOX_TOOLS_FILE_MANAGER', 'Dosya Yöneticisi');
define('BOX_TOOLS_MAIL', 'Eposta Gönder');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Posta Yönetimi');
define('BOX_TOOLS_SERVER_INFO', 'Sunucu Bilgisi');
define('BOX_TOOLS_WHOS_ONLINE', 'Kimler Siteye Bağlı');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Yerelleştirme');
define('BOX_LOCALIZATION_CURRENCIES', 'Para Birimleri');
define('BOX_LOCALIZATION_LANGUAGES', 'Diller');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Sipariş Durumları');

// javascript messages
define('JS_ERROR', 'Formun işlenmesinde hatalar oluştu!\nLütfen belirtilen düzeltmeleri yapınız:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Yeni ürün özelliğine fiyat değeri girmelisiniz\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Yeni ürün özelliklerine fiyat öneki eklemelisiniz\n');

define('JS_PRODUCTS_NAME', '* Yeni ürüne bir isim vermelisiniz\n');
define('JS_PRODUCTS_DESCRIPTION', '* Yeni ürüne için açıklama yazmalısınız\n');
define('JS_PRODUCTS_PRICE', '* Yeni ürün için fiyat değeri girmelisiniz\n');
define('JS_PRODUCTS_WEIGHT', '* Yeni ürün için ağırlık değeri girmelisiniz\n');
define('JS_PRODUCTS_QUANTITY', '* Yeni ürünün miktarını girmelisiniz\n');
define('JS_PRODUCTS_MODEL', '* Yeni ürün için bir model değeri yazmalısınız\n');
define('JS_PRODUCTS_IMAGE', '* Yeni ürün için resim değeri yazmalısınız\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Kaydetmek için bu ürüne yeni bir fiyat belirtmelisiniz.\n');

define('JS_GENDER', '* \'Cinsiyet\' seçeneğini boş bırakmamalısınız.\n');
define('JS_FIRST_NAME', '* \'İsminiz\' en az ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter olmalıdır.\n');
define('JS_LAST_NAME', '* \'Soy Isminiz\' en az ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter olamlıdır.\n');
define('JS_DOB', '* \'Doğum Tarihiniz\'  xx/xx/xxxx (gün/ay/yil) seklinde olmalıdır.\n');
define('JS_EMAIL_ADDRESS', '* \'E-Mail Adresiniz\' en az ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter olmalıdır.\n');
define('JS_ADDRESS', '* \'Adresiniz\' en az ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter olmalıdır.\n');
define('JS_POST_CODE', '* \'Posta Kodu\' en az ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter olmalıdır.\n');
define('JS_CITY', '* \'İlçe\' en az ' . ENTRY_CITY_MIN_LENGTH . ' karakter olmalıdır.\n');
define('JS_STATE', '* \'Şehir\'\'inizi  seçmek zorundasiniz.\n');
define('JS_STATE_SELECT', '-- Yukarıdan Seçiniz --');
define('JS_ZONE', '* \'Şehir\' seçenegini bu ülke için gösterilen listeden seçmek zorundasınız.');
define('JS_COUNTRY', '* \'Ülke\' seçenegini boş bırakmamalısınız.');
define('JS_TELEPHONE', '* \'Telefon Numarasi\' en az ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakter olmalıdır.\n');
define('JS_PASSWORD', '* \'Şifre\' ve \'Dogrulama\' seçenekleri birbirini dogrulamalı ve en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter olmalıdır.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Sipariş numarası %s yok!');

define('CATEGORY_PERSONAL', 'Kişisel');
define('CATEGORY_ADDRESS', 'Adres');
define('CATEGORY_CONTACT', 'İletişim');
define('CATEGORY_COMPANY', 'Şirket');
define('CATEGORY_OPTIONS', 'Seçenekler');

define('ENTRY_GENDER', 'Cinsiyet:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">gerekli</span>');
define('ENTRY_FIRST_NAME', 'İsim:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter</span>');
define('ENTRY_LAST_NAME', 'Soy İsim:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter</span>');
define('ENTRY_DATE_OF_BIRTH', 'Doğum Tarihi:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 22/02/1981)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresi:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Bu e-mail adresi geçerli formatta değil!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Bu e-mail adresi zaten kullanımda!</span>');
define('ENTRY_COMPANY', 'Şirket İsmi:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Adres:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter</span>');
define('ENTRY_SUBURB', 'Semt:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Posta Kodu:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter</span>');
define('ENTRY_CITY', 'İlçe');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_CITY_MIN_LENGTH . ' karakter</span>');
define('ENTRY_STATE', 'Şehir:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">gerekli</span>');
define('ENTRY_COUNTRY', 'Ülke:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon Numarası:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">minimum ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakter</span>');
define('ENTRY_FAX_NUMBER', 'Fax Numarası:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Haber Postası:');
define('ENTRY_NEWSLETTER_YES', 'Üye');
define('ENTRY_NEWSLETTER_NO', 'Üye Değil');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'E-Mail Gönder');
define('IMAGE_BACK', 'Geri');
define('IMAGE_BACKUP', 'Yedekle');
define('IMAGE_CANCEL', 'İptal');
define('IMAGE_CONFIRM', 'Doğrula');
define('IMAGE_COPY', 'Kopyala');
define('IMAGE_COPY_TO', 'Kopyalanacak Dizin');
define('IMAGE_DETAILS', 'Ayrıntılar');
define('IMAGE_DELETE', 'Sil');
define('IMAGE_EDIT', 'Düzenle');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Dosya Yöneticisi');
define('IMAGE_ICON_STATUS_GREEN', 'Aktif');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktif Et');
define('IMAGE_ICON_STATUS_RED', 'Aktif değil');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deaktif et');
define('IMAGE_ICON_INFO', 'Bilgi');
define('IMAGE_INSERT', 'Ekle');
define('IMAGE_LOCK', 'Kilit');
define('IMAGE_MODULE_INSTALL', 'Modülü Yükle'); 
define('IMAGE_MODULE_REMOVE', 'Modülü Kaldır');
define('IMAGE_MOVE', 'Taşı');
define('IMAGE_NEW_BANNER', 'Yeni Reklam');
define('IMAGE_NEW_CATEGORY', 'Yeni Kategori');
define('IMAGE_NEW_COUNTRY', 'Yeni Ülke');
define('IMAGE_NEW_CURRENCY', 'Yeni Para Birimi');
define('IMAGE_NEW_FILE', 'Yeni Dosya');
define('IMAGE_NEW_FOLDER', 'Yeni Dizin');
define('IMAGE_NEW_LANGUAGE', 'Yeni Dil');
define('IMAGE_NEW_NEWSLETTER', 'Yeni Haber Postası');
define('IMAGE_NEW_PRODUCT', 'Yeni Ürün');
define('IMAGE_NEW_TAX_CLASS', 'Yeni Vergi Türü');
define('IMAGE_NEW_TAX_RATE', 'Yeni Vergi Oranı');
define('IMAGE_NEW_TAX_ZONE', 'Yeni Vergi Bölgesi');
define('IMAGE_NEW_ZONE', 'Yeni Bölge');
define('IMAGE_ORDERS', 'Siparişler');
define('IMAGE_ORDERS_INVOICE', 'Fatura');
define('IMAGE_ORDERS_PACKINGSLIP', 'İrsaliye');
define('IMAGE_PREVIEW', 'Önizleme');
define('IMAGE_RESTORE', 'Geri Al');
define('IMAGE_RESET', 'Ayarla');
define('IMAGE_SAVE', 'Kaydet');
define('IMAGE_SEARCH', 'Ara');
define('IMAGE_SELECT', 'Seç');
define('IMAGE_SEND', 'Gönder');
define('IMAGE_SEND_EMAIL', 'Send Email');
define('IMAGE_UNLOCK', 'Aç');
define('IMAGE_UPDATE', 'Güncelle');
define('IMAGE_UPDATE_CURRENCIES', 'Para Birimini Güncelle'); 
define('IMAGE_UPLOAD', 'Yükle');

define('ICON_CROSS', 'Yanlış');
define('ICON_CURRENT_FOLDER', 'Geçerli Dizin');
define('ICON_DELETE', 'Sil');
define('ICON_ERROR', 'Hata');
define('ICON_FILE', 'Dosya');
define('ICON_FILE_DOWNLOAD', 'Yükle');
define('ICON_FOLDER', 'Dizin');
define('ICON_LOCKED', 'Kilitli');
define('ICON_PREVIOUS_LEVEL', 'Önceki Seviye');
define('ICON_PREVIEW', 'Önizleme');
define('ICON_STATISTICS', 'İstatistik');
define('ICON_SUCCESS', 'Başarılı');
define('ICON_TICK', 'Doğru');
define('ICON_UNLOCKED', 'Açıldı');
define('ICON_WARNING', 'Uyarı');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Sayfa %s / %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> reklam)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ülke)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> müşteri)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> para birimi)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> dil)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> üretici)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> haber postası');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipariş)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipariş durumu)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ürün)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> beklenen ürün)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ürün yorumu)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> özel ürün)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi cinsi)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi bölgesi)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> vergi oranı)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> şehir/bölge)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'Varsayılan');
define('TEXT_SET_DEFAULT', 'Varsayılan yap');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Gerekli</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Hata: Varsayılan para birimi şu anda ayarlanmamış. Lütfen şu yolu takip edin: Yönetim Araçları->Yerelleştirme->Para Birimleri');

define('TEXT_CACHE_CATEGORIES', 'Kategoriler Kutusu');
define('TEXT_CACHE_MANUFACTURERS', 'Üreticiler Kutusu');
define('TEXT_CACHE_ALSO_PURCHASED', 'Aynı Zamanda Satılanlar Modülü');

define('TEXT_NONE', '--boş--');
define('TEXT_TOP', '--Lütfen Seçiniz--');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Hata: Hedef bulunamadı.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Hata: Hedef yazılabilir değil.');
define('ERROR_FILE_NOT_SAVED', 'Hata: Dosya yükleme kaydedilemedi.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Hata: Yüklenen dosya tipi gecersiz.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Başarılı: Dosya yükleme başarılı.');
define('WARNING_NO_FILE_UPLOADED', 'Uyarı: Dosya yüklemesi yok.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Uyarı: php.ini içinde dosya yükleme yetkisi tanımlanmamış.');
/*** Begin Header Tags SEO ***/
// header_tags_seo text in includes/boxes/header_tags_seo.php
define('BOX_HEADING_HEADER_TAGS_SEO', 'SEO Sayfa Etiketleri');
define('BOX_HEADER_TAGS_ADD_A_PAGE', 'SEO Sayfa Denetimi');
define('BOX_HEADER_TAGS_SILO', 'Silo Denetimi');
define('BOX_HEADER_TAGS_FILL_TAGS', 'Etiket Doldur');
define('BOX_HEADER_TAGS_TEST', 'Test');
/*** End Header Tags SEO ***/
// BOF Separate Pricing Per Customer
define('ENTRY_CUSTOMERS_GROUP_NAME', 'Customer Group:');
define('BOX_CUSTOMERS_GROUPS', 'Customers Groups');
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_REQUEST_AUTHENTICATION', 'Switch off alert for authentication:');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alert off');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alert on');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
// EOF Separate Pricing Per Customer
?>