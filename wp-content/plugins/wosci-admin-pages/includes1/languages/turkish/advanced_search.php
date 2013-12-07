<?php
/*
  $Id: advanced_search.php,v 1.14 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('NAVBAR_TITLE_1', 'Gelişmiş Arama');
define('NAVBAR_TITLE_2', 'Arama Sonuçları');

define('HEADING_TITLE_1', 'Gelişmiş Arama');
define('HEADING_TITLE_2', 'Arama kriterlerine uyan ürünler');

define('HEADING_SEARCH_CRITERIA', 'Arama Kriterleri');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Ürün Açıklamaları İçinde Ara');
define('ENTRY_CATEGORIES', 'Kategoriler:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Alt Kategorileri Dahil Et');
define('ENTRY_MANUFACTURERS', 'Üreticiler:');
define('ENTRY_PRICE_FROM', 'Fiyat En Az:');
define('ENTRY_PRICE_TO', 'Fiyat En Fazla:');
define('ENTRY_DATE_FROM', 'Eklenme Tarihinden:');
define('ENTRY_DATE_TO', 'Eklenme Tarihine:');

define('TEXT_SEARCH_HELP_LINK', '<u>Arama Yardımı</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Tüm Kategoriler');
define('TEXT_ALL_MANUFACTURERS', 'Tüm Üreticiler');

define('HEADING_SEARCH_HELP', 'Arama Yardımı');
define('TEXT_SEARCH_HELP', 'Arama sonuçlarını daha fazla kontrol edebilmeniz için; aradığınız kelimeleri AND ve/veya OR kelimelerini kullanarak bulmayı deneyebilirsiniz.<br><br>Örneğin, <u>Microsoft AND mouse</u> araması her iki kelimeyi içeren sayfaları sonuç olarak bulacakktır. Diğer taraftan, <u>Electrolux OR Ariston</u> araması her iki kelimeden herhangi birini içeren tüm sayfaları sonuç olarak bulacaktır.<br><br>Tam sözcük karşılaştırması yapmak için aranan kelime çift tırnak içinde yazılmalıdır.<br><br>Örneğin, <u> "dizüstü bilgisayar"</u> sadece tırnak içinde verilmiş olan dizilimi verildiği şekilde bütün olarak içeren sayfaları bulacaktır.<br><br>Parantezler daha detaylı aramalar için kullanılabilir.<br><br>Örneğin, <u>Microsoft and (klavye or mouse or "visual basic")</u>.');
define('TEXT_CLOSE_WINDOW', '<u>Pencereyi Kapat</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Ürün İsmi');
define('TABLE_HEADING_MANUFACTURER', 'Üretici');
define('TABLE_HEADING_QUANTITY', 'Miktar');
define('TABLE_HEADING_PRICE', 'Fiyat');
define('TABLE_HEADING_WEIGHT', 'Ağırlık');
define('TABLE_HEADING_BUY_NOW', 'Hemen Al');

define('TEXT_NO_PRODUCTS', 'Arama kriterlerine uyan bir ürün bulunamadı.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Arama formunda en azından bir alanı doldurmalısınız.');
define('ERROR_INVALID_FROM_DATE', 'Geçersiz Tarih Başlangıcı.');
define('ERROR_INVALID_TO_DATE', 'Geçersiz Tarih Bitişi.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Başlangıç Tarihi Bitiş Tarihinden büyük veya aynı olmalıdır.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Fiyat En Az alanı bir sayı olmalıdır.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Fiyat En Fazla alanı bir sayı olmalıdır.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Fiyat En Fazla alanı, Fiyat En az alanında daha büyük veya aynı olmalıdır.');
define('ERROR_INVALID_KEYWORDS', 'Geçersiz anahtar kelimeler.');
?>