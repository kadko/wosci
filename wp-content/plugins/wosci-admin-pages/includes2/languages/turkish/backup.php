<?php
/*
  $Id: backup.php,v 1.13 05/11/2007 22:10

  osicommerce bir osCommerce Açık Kaynak E-Ticaret Çözümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('HEADING_TITLE', 'Veritabanı Yedekleme Yöneticisi');

define('TABLE_HEADING_TITLE', 'Başlık');
define('TABLE_HEADING_FILE_DATE', 'Tarih');
define('TABLE_HEADING_FILE_SIZE', 'Boyut');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Yeni Yedekleme');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Yerelden Geri Yükle');
define('TEXT_INFO_NEW_BACKUP', 'Yedekleme işlemi birkaç dakika alabileceğinden işlemi yarıda kesmeyiniz.');
define('TEXT_INFO_UNPACK', '<br><br>(arşivden dosyayı çıkardıktan sonra)');
define('TEXT_INFO_RESTORE', 'Geri yükleme işlemini yarıda kesmeyiniz.<br><br>Yedeğin boyutuna göre işlem süresi uzamaktadır!<br><br>Eğer mümkünse mysql istemcisi kullanın.<br><br>Örneğin:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Geri yükleme işlemini yarıda kesmeyiniz.<br><br>Bu işlem yedeklemeden daha fazla zaman almaktadır!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Geri yüklenecek dosya sql (text) dosyası olmalı.');
define('TEXT_INFO_DATE', 'Tarih:');
define('TEXT_INFO_SIZE', 'Boyut:');
define('TEXT_INFO_COMPRESSION', 'Sıkıştırma:');
define('TEXT_INFO_USE_GZIP', 'GZIP Kullan');
define('TEXT_INFO_USE_ZIP', 'ZIP Kullan');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sıkıştırma Yok (Sadece SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Sadece Yükle (sunucu tarafında depolama)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'En iyisi HTTPS bağlantısıyla yapmak');
define('TEXT_DELETE_INTRO', 'Bu yedeklemeyi silmek istiyor musunuz?');
define('TEXT_NO_EXTENSION', 'Hiçbiri');
define('TEXT_BACKUP_DIRECTORY', 'Yedekleme  Dizini:');
define('TEXT_LAST_RESTORATION', 'Son Geri Yükleme:');
define('TEXT_FORGET', '(<u>unut</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Hata: Yedekleme dizini yok. Lütfen configure.php dosyası içerisinden bunu ayarlayın.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Hata: Yedekleme dizinine yazma hakkı tanınmamış.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Hata: Yükleme bağlantısı kabul edilmiyor.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Başarılı: Son geri alma tarihi temizlendi.');
define('SUCCESS_DATABASE_SAVED', 'Başarılı: Veritabanı kaydedildi.');
define('SUCCESS_DATABASE_RESTORED', 'Başarılı: Veritabanı yeniden yüklendi.');
define('SUCCESS_BACKUP_DELETED', 'Başarılı: Yedekleme kaldırıldı.');
?>