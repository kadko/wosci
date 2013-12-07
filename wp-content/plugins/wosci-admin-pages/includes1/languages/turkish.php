<?php
/*
  $Id: turkish.php,v 1 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'tr_TR.UTF-8');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%d %B %Y, %A'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format dd/mm/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'TRL');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="tr"');

// charset for web pages and emails
define('CHARSET', 'UTF-8');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Hesap Aç');
define('HEADER_TITLE_MY_ACCOUNT', 'Hesabım');
define('HEADER_TITLE_CART_CONTENTS', 'Sepetim');
define('HEADER_TITLE_CHECKOUT', 'Ödeme');
define('HEADER_TITLE_TOP', 'Ana Sayfa');
define('HEADER_TITLE_CATALOG', 'Katalog');
define('HEADER_TITLE_LOGOFF', 'Çıkış');
define('HEADER_TITLE_LOGIN', 'Giriş');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'kişi, açılış tarihi');

// text for gender
define('MALE', 'Bay');
define('FEMALE', 'Bayan');
define('MALE_ADDRESS', 'Sayın');
define('FEMALE_ADDRESS', 'Sayın');

// text for date of birth example
define('DOB_FORMAT_STRING', 'gün/ay/yıl');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Kategoriler');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Üreticiler');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Yeni Ürünler');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Heman Bul');
define('BOX_SEARCH_TEXT', 'Aradığınız ürünü bulmak için lütfen anahtar kelime giriniz.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Gelişmiş Arama');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'İndirimdeki Ürünler');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Yorumlar');
define('BOX_REVIEWS_WRITE_REVIEW', 'Bu ürün hakkindaki fikirlerinizi paylaşın!');
define('BOX_REVIEWS_NO_REVIEWS', 'Şu anda herhangi bir ürün yorumu yok.');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '5 üzerinden %s yıldız!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Sepetim');
define('BOX_SHOPPING_CART_EMPTY', '0 ürün');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Geçmiş Siparişler');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Çok Satanlar');
define('BOX_HEADING_BESTSELLERS_IN', 'Çok Satanlar<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Bildirimler');
define('BOX_NOTIFICATIONS_NOTIFY', 'Erken uyarı: <b>%s</b> hakkındaki güncellemeleri bildir.');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', '<b>%s</b> hakkındaki güncellemeleri bildirme.');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Üretici Bigisi');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Ana Sayfası');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Diğer Ürünleri');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Diller');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Kurlar');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Müşteri Hizmetleri');
define('BOX_INFORMATION_PRIVACY', 'Gizlilik Bildirimi');
define('BOX_INFORMATION_CONDITIONS', 'Kullanım Şartları');
define('BOX_INFORMATION_SHIPPING', 'Kargo & İade');
define('BOX_INFORMATION_CONTACT', 'Bize Ulaşın');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Tavsiye Edin');
define('BOX_TELL_A_FRIEND_TEXT', 'Ürün bilgilerini arkadaşınıza göndermek ister misiniz?');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Kargo Bilgileri');
define('CHECKOUT_BAR_PAYMENT', 'Ödeme Bilgileri');
define('CHECKOUT_BAR_CONFIRMATION', 'Onaylama');
define('CHECKOUT_BAR_FINISHED', 'Tamamlandı!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Lütfen Seçiniz');
define('TYPE_BELOW', 'Aşağıya Yazın');

// javascript messages
define('JS_ERROR', 'Doldurduğunuz formda bazı hatalar mevcut!\nLütfen aşağıdaki kısımları tekrar gözden geçirin:\n\n');

define('JS_REVIEW_TEXT', '* \'Yorum Alanı\' en az ' . REVIEW_TEXT_MIN_LENGTH . ' karakterden oluşmalı.\n');
define('JS_REVIEW_RATING', '* Ürüne bir puan vermeniz gerekmektedir.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Lütfen, Siparişiniz için bir ödeme şekli seçiniz.\n');

define('JS_ERROR_SUBMITTED', 'Bu formu zaten gönderimişsiniz. Lütfen Tamam tuşuna basarak işlemin bitmesini bekleyiniz.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Lütfen, Siparişiniz için bir ödeme şekli seçiniz.');

define('CATEGORY_COMPANY', 'Firma Bilgileri');
define('CATEGORY_PERSONAL', 'Kişisel Bilgiler');
define('CATEGORY_ADDRESS', 'Adres');
define('CATEGORY_CONTACT', 'İrtibat');
define('CATEGORY_OPTIONS', 'Seçenekler');
define('CATEGORY_PASSWORD', 'Şifre');

define('ENTRY_COMPANY', 'Firma Adı:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Cinsiyet:');
define('ENTRY_GENDER_ERROR', 'Lütfen cinsiyet seçiniz.');
define('ENTRY_GENDER_TEXT', '');
define('ENTRY_FIRST_NAME', 'İsim:');
define('ENTRY_FIRST_NAME_ERROR', 'İsim alanı en az ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_FIRST_NAME_TEXT', '');
define('ENTRY_LAST_NAME', 'Soy İsim:');
define('ENTRY_LAST_NAME_ERROR', 'Soy İsim alanı en az ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_LAST_NAME_TEXT', '');
define('ENTRY_DATE_OF_BIRTH', 'Doğum Tarihi:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Doğum tarihiniz şu biçimde olmalıdır: GÜN/AY/YIL (örn. 22/02/1981)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (örn. 22/02/1981)');
define('ENTRY_EMAIL_ADDRESS', 'E-Posta Adresi:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Posta adresiniz en az ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'E-Posta adresininizde bir hata var - Lütfen kontrol edip gerekli değişikliği yapınız.</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'E-Posta adresiniz kayıtlarımızda var - Lütfen e-posta adresinizle giriş yapmayı deneyiniz yada farklı bir adres ile bir hesap açınız.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '');
define('ENTRY_STREET_ADDRESS', 'Adres:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Adres alanı en az ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_STREET_ADDRESS_TEXT', '');
define('ENTRY_SUBURB', 'Semt:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Posta Kodu:');
define('ENTRY_POST_CODE_ERROR', 'Posta Kodu alanı en az ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_POST_CODE_TEXT', '');
define('ENTRY_CITY', 'İlçe:');
define('ENTRY_CITY_ERROR', 'İlçe alanı en az ' . ENTRY_CITY_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_CITY_TEXT', '');
define('ENTRY_STATE', 'Şehir:');
define('ENTRY_STATE_ERROR', 'Şehir alanı en az ' . ENTRY_STATE_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_STATE_ERROR_SELECT', 'Lütfen şehirler kutusundan bir şehir seçiniz.');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'Ülke:');
define('ENTRY_COUNTRY_ERROR', 'Lütfen ülkeler kutusundan bir ülke seçiniz.');
define('ENTRY_COUNTRY_TEXT', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon numarası:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefon numarası alanı en az ' . ENTRY_TELEPHONE_MIN_LENGTH . ' rakam içermelidir.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '');
define('ENTRY_FAX_NUMBER', 'Faks Numarası:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Haber listesi:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Abone ol');
define('ENTRY_NEWSLETTER_NO', 'Abone olma');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Şifre:');
define('ENTRY_PASSWORD_ERROR', 'Şifre alanı en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Şifre onayı alanı şifre alanı ile aynı olmalıdır.');
define('ENTRY_PASSWORD_TEXT', '');
define('ENTRY_PASSWORD_CONFIRMATION', 'Şifre Onayı:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '');
define('ENTRY_PASSWORD_CURRENT', 'Eski Şifre:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Şifre alanı en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_PASSWORD_NEW', 'Yeni Şifre:');
define('ENTRY_PASSWORD_NEW_TEXT', '');
define('ENTRY_PASSWORD_NEW_ERROR', 'Yeni Şifre alanı en az ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakter içermelidir.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Şifre onayı alanı şifre alanı ile aynı olmalıdır.');
define('PASSWORD_HIDDEN', '--GIZLI--');

define('FORM_REQUIRED_INFORMATION', '* Gerekli bilgi');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Sonuç Sayfaları:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> ürün)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> sipariş)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> yorum)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> yeni ürün)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Görüntülenen <b>%d</b> - <b>%d</b> (toplam <b>%d</b> indirimdeki ürün)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'İlk Sayfa');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Önceki Sayfa');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Sonraki Sayfa');
define('PREVNEXT_TITLE_LAST_PAGE', 'Son Sayfa');
define('PREVNEXT_TITLE_PAGE_NO', 'Sayfa %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Önceki %d Sayfaları');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Sonraki %d Sayfaları');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;İLK');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Önceki]');
define('PREVNEXT_BUTTON_NEXT', '[Sonraki&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'SON&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Başka Adresler Eklemek için tıklayınız.');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adres Defterinize ulaşmak için tıklayınız.');
define('IMAGE_BUTTON_ADDRESS_BOOK_MENU', 'Adres Defteri');
define('IMAGE_BUTTON_BACK', 'Geri Gitmek için tıklayınız.');
define('IMAGE_BUTTON_BUY_NOW', 'Şimdi satınalmak için tıklayınız.');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adresi Değitirmek için tıklayınız.');
define('IMAGE_BUTTON_CHECKOUT', 'Ödeme Yapmak için tıklayınız.');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Siparişinizi Onaylamak için tıklayınız.');
define('IMAGE_BUTTON_CONTINUE', 'Devam Etmek için tıklayınız.');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Alişverişe Devam Etmek için tıklayınız.');
define('IMAGE_BUTTON_DELETE', 'Silmek için tıklayınız.');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Hesap Bilgilerinizini Düzenlemek için tıklayınız.');
define('IMAGE_BUTTON_HISTORY', 'Geçmiş Siparişlerinizi görmek için tıklayınız.');
define('IMAGE_BUTTON_LOGIN', 'Mağazamıza giriş yapmak için tıklayınız.');
define('IMAGE_BUTTON_IN_CART', 'Ürünü Sepete Atmak için tıklayınız.');
define('IMAGE_BUTTON_NOTIFICATIONS', 'İndirim Bildirileri almak için tıklayınız.');
define('IMAGE_BUTTON_QUICK_FIND', 'Hemen Bulmak için tıklayınız.');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Indirim Bildirilerini Kaldırmak için tıklayınız.');
define('IMAGE_BUTTON_REVIEWS', 'Yorumları görmek/eklemek için tıklayınız.');
define('IMAGE_BUTTON_SEARCH', 'Aradığınız Ürünü bulmak için tıklayınız.');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Kargo seçeneklerini görmek için tıklayınız.');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Ürün bilgilerini Arkadaşınıza Göndermek için tıklayınız.');
define('IMAGE_BUTTON_UPDATE', 'Güncellemek için tıklayınız.');
define('IMAGE_BUTTON_UPDATE_CART', 'Alışveriş Sepetinizi Güncellemek için tıklayınız.');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Ürünler hakkındaki düşüncelerinizi paylaşmak için tıklayınız.');

define('SMALL_IMAGE_BUTTON_DELETE', 'Sil');
define('SMALL_IMAGE_BUTTON_EDIT', 'Düzenle');
define('SMALL_IMAGE_BUTTON_VIEW', 'Göster');

define('ICON_ARROW_RIGHT', 'daha fazlası için tıklayınız.');
define('ICON_CART', 'Ürünü Alışveriş Sepetinize Atmak için tıklayınız.');
define('ICON_ERROR', 'Hata');
define('ICON_SUCCESS', 'Başarılı');
define('ICON_WARNING', 'Uyarı');

define('TEXT_GREETING_PERSONAL', 'Sn. <span class="greetUser">%s</span>  Mağazamıza tekrar hoş geldiniz! Hangi <a href="%s"><u>yeni ürünlerimizin</u></a> satışa sunulduğunu görmek ister misiniz?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Eğer %s değilseniz, lütfen kendi hesap bilgileriniz ile <a href="%s"><u>giriş yapmak için tıklayın</u></a>.</small>');
define('TEXT_GREETING_GUEST', 'Sn. <span class="greetUser">Ziyaretçi</span> mağazamıza hoş geldiniz! Üye hesabınız varsa <a href="%s"><u>üye girişi</u></a> yapabilir veya yeni bir <a href="%s"><u>hesap açabilirsiniz</u></a>.');

define('TEXT_SORT_PRODUCTS', 'Ürün Sıralama');
define('TEXT_DESCENDINGLY', 'azalan');
define('TEXT_ASCENDINGLY', 'artan');
define('TEXT_BY', ' ile ');

define('TEXT_REVIEW_BY', 'Sayın %s');
define('TEXT_REVIEW_WORD_COUNT', '%s kelime');
define('TEXT_REVIEW_RATING', 'Oran: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Tarih: %s');
define('TEXT_NO_REVIEWS', 'Henuz bir ürün yorumu bulunmamaktadir.');

define('TEXT_NO_NEW_PRODUCTS', 'Henüz yeni bir ürün bulunmamaktadir.');

define('TEXT_UNKNOWN_TAX_RATE', 'Bilinmiyen vergi oranı');

define('TEXT_REQUIRED', '<span class="errorText">Gerekli</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>HATA VAR:</small> Belirtilen SMTP sunucusundan email yollanamıyor. Lütfen php.ini dosyanızdaki ayarları kontrol ediniz ve gerekiyorsa SMTP sunucu ayarını düzeltiniz.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Uyarı: Kurulum dizini: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install dizininde bulunuyor. Lütfen güvenlik nedeniyle bu dizini kaldırınız.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Uyarı: Ayar dosyası yazılabilir hakları taşıyor: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Bu durum potansiyel bir güvenlik riski oluşturuyor - lütfen bu dosyaya doğru kullanıcı hakları veriniz.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Uyarı: Oturum (sessions) dizini yok: ' . tep_session_save_path() . '. Bu dizi oluşturulmadıkça oturumlar (sessions) çalışmayacaktır.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Uyarı: Oturum (sessions) dizini yazılabilir değil: ' . tep_session_save_path() . '. Doğru kullanıcı hakları ayarlanmadıkça oturumlar (sessions) çalışmayacak.');
define('WARNING_SESSION_AUTO_START', 'Uyarı: session.auto_start etkinleştirilmiş - lütfen php.ini içindeki bu php özelliğini etkinsizleştirin ve web sunucusunu tekrar başlatın.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Uyarı: İndirilebilir (downloadable) ürünler dizini oluşturulmamış: ' . DIR_FS_DOWNLOAD . '. Bu dizin tanımlanmadıkça indirilebilr ürünler çalışmayacaktır.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Kredi Kartınızın son kullanma tarihi gecerli değildir.<br>Lütfen \'Son Kullanma Tarihi\'ni kontrol edip tekrar deneyiniz.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Kredi Kartınızın numarası geçersizdir.<br>Lürfen \'Kart numarasını\' kontrol edip tekrar deneyiniz.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'K.Kartınızın ilk 4 numarasını kontrol ediniz : %s<br>Eğer numaranız doğru ise, Bu K.Kart tipi mağazamızda kullanılmamaktadır.<br>Eğer yanlış ise, lütfen tekrar deneyiniz.');

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br>Powered by <a href="http://www.osCommerce.com" target="_blank">osCommerce</a>');
/*** Begin Header Tags SEO ***/ 
define('TEXT_SEE_MORE', 'Devamı');
/*** End Header Tags SEO ***/ 
// BOF Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Firma V.D. No:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
// EOF Separate Pricing Per Customer
define('ENTRY_CHANGE_PASSWORD', 'Şifre Değiştir');
define('HEADER_EDIT_MY_ACCOUNT', 'Bilgilerimi Değiştir');
define('ENTRY_NEWSLETTER2', 'Mail Ayarı');
define('BOX_HEADING_CUST_SERV', 'Müşteri Hizmetleri');
define('BOX_HEADING_COMPANY', 'Yardım Sayfaları');
define('IN_STOCK', 'Stokta Var');
define('OUT_OF_STOCK', 'Stokta Yok');
define('SKU', 'Stok Kodu#');
define('INC_TAX', 'KDV Dahil');
define('EX_TAX', 'KDV Hariç');
 
?>