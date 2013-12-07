<?php
/*
  $Id: currencies.php,v 1.12 05/11/2007 22:10

  osicommerce bir osCommerce Açık Kaynak E-Ticaret Çözümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('HEADING_TITLE', 'Para Birimleri');

define('TABLE_HEADING_CURRENCY_NAME', 'Para Birimi');
define('TABLE_HEADING_CURRENCY_CODES', 'Kod');
define('TABLE_HEADING_CURRENCY_VALUE', 'Değer');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_INFO_EDIT_INTRO', 'Lütfen gerekli değişiklikleri yapın');
define('TEXT_INFO_CURRENCY_TITLE', 'Başlık:');
define('TEXT_INFO_CURRENCY_CODE', 'Kod:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Sol Taraf Sembolü :');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Sağ Taraf Sembolü:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Ondalık Noktası:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Binler Noktası:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Ondalık Yerleri:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Son Güncelleme:');
define('TEXT_INFO_CURRENCY_VALUE', 'Değer:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Örnek Çıktı:');
define('TEXT_INFO_INSERT_INTRO', 'Lütfen yeni para birimini gereken bilgileriyle birlikte giriniz.');
define('TEXT_INFO_DELETE_INTRO', 'Bu para birimini silmek istediğinize emin misiniz?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Yeni Para Birimi');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Para Birimi Güncelle');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Para Birimi Sil');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (bu para birimini sizin güncellemeniz gerekecek)');
define('TEXT_INFO_CURRENCY_UPDATED', '%s (%s) için kur değeri %s ile başarılı bir şekilde güncellenmiştir.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Hata: Varsayılan para birimini kaldıramazsınız. Lütfen başka bir para birimini varsayılan yapınız ve tekrar deneyiniz.');
define('ERROR_CURRENCY_INVALID', 'Hata: %s (%s) için kur değeri %s ile güncellenemedi. Geçerli bir para kodu girdiniz mi?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Uyarı: Birinci para oranı değiştirme sunucusu (%s) arızalı %s (%s) - diğer para oranı değiştirme sunucusu deneyiniz.');
?>
