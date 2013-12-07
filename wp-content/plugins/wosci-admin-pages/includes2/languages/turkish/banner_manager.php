<?php
/*
  $Id: banner_manager.php,v 1.17 05/11/2007 22:10

  osicommerce bir osCommerce Açık Kaynak E-Ticaret Çözümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('HEADING_TITLE', 'Reklam Yöneticisi');

define('TABLE_HEADING_BANNERS', 'Reklamlar');
define('TABLE_HEADING_GROUPS', 'Gruplar');
define('TABLE_HEADING_STATISTICS', 'Gösterim / Tıklama');
define('TABLE_HEADING_STATUS', 'Durum');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_BANNERS_TITLE', 'Reklam Başlığı:');
define('TEXT_BANNERS_URL', 'Reklam URL:');
define('TEXT_BANNERS_GROUP', 'Reklam Grubu:');
define('TEXT_BANNERS_NEW_GROUP', ', veya aşağıya yeni bir reklam grubu giriniz');
define('TEXT_BANNERS_IMAGE', 'Resim:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', veya aşağıya yerel dosyayı giriniz');
define('TEXT_BANNERS_IMAGE_TARGET', 'Resim Hedefi (Kaydet):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_EXPIRES_ON', 'Bitiş Tarihi:');
define('TEXT_BANNERS_OR_AT', ', veya ');
define('TEXT_BANNERS_IMPRESSIONS', 'tıklama/görme.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Başlama Tarihi:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Reklam Notları:</b><ul><li>Reklam için resim veya HTML texti kullanın - ikisini beraber kullanmayın.</li><li>HTML Textin resme göre önceliği vardır.</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Resim Notları:</b><ul><li>Geri yükleme dizinlerinin uygun kullanıcı(yazma) izinleri ayarlanmalı!</li><li>Eğer web sunucusuna resim yüklemiyorsanız \'Kaydet\' boşluğunu doldurmayınız (örneğin yerel (sunucu taraflı) resim kullanımında).</li><li> \'Kaydet\' boşluğuna girdiğiniz değer var olan bir dizini göstermeli ve sonunda bölü işareti olmalı (örneğin, reklamlar/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Bitiş Tarihi Notları:</b><ul><li>İki boşluktan sadece biri dolu olmalı</li><li>Eğer reklam süresi otamatik olarak dolmayacaksa, bu boşlukları boş bırakınız.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Başlama Tarihi Notları:</b><ul><li>Eğer başlama tarihini ayarladıysanız, reklam o tarihte aktif olacaktır.</li><li>Başlangıç tarihleri ayarlanmış tüm reklamlar o gün gelene kadar aktif olarak gözükmezler. Başlama tarihine gelenler ise aktif olarak gözükür.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Eklenme Tarihi:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Başlama Tarihi: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Bitiş Tarihi: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Bitiş Tarihi: <b>%s</b> gösterim');
define('TEXT_BANNERS_STATUS_CHANGE', 'Durum Değişimi: %s');

define('TEXT_BANNERS_DATA', 'B<br>İ<br>L<br>G<br>İ');
define('TEXT_BANNERS_LAST_3_DAYS', 'Son 3 Gün');
define('TEXT_BANNERS_BANNER_VIEWS', 'Reklam Gösterim');
define('TEXT_BANNERS_BANNER_CLICKS', 'Reklam Tıklama');

define('TEXT_INFO_DELETE_INTRO', 'Reklamı silmeye istediğinize emin misiniz?');
define('TEXT_INFO_DELETE_IMAGE', 'Reklam resmini sil');

define('SUCCESS_BANNER_INSERTED', 'Başarılı: Reklam eklendi.');
define('SUCCESS_BANNER_UPDATED', 'Başarılı: Reklam güncellendi.');
define('SUCCESS_BANNER_REMOVED', 'Başarılı: Reklam kaldırıldı.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Başarılı: Reklam durumu güncellendi.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Hata: Reklam başlığı gereklidir.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Hata: Reklam grubu gereklidir.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Hata: Hedef dizini bulunamadı.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Hata: Hedef dizinine yazılamıyor.');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Hata: Resim bulunamıyor.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Hata: Resim kaldırılamıyor.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Hata: Bilinmeyen durum işareti.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Hata: Graphs dizini bulunamadı. Lütfen  \'images\' dizini içinde bir \'graphs\' dizini oluşturunuz.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Hata: Graphs dizini yazılabilir değil.');
?>