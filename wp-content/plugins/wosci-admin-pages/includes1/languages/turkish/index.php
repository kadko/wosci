<?php
/*
  $Id: index.php,v 1.1 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('TEXT_MAIN', 'Bu osCommerce Online Merchant yazılımının OSIcommerce tarafından revize edilmiş versiyonudur. Gösterilen ürünler gösteri maksatlıdır. <b>Satın alınan herhangi bir ürünün dağıtımı yapılmayacağı gibi müşteriden para tahsilatı da yapılmayacaktır</b>. Gösterilen ürünlerin bilgileri hayali olarak algılanmalıdır.<br>
<br><table border="0" width="100%" cellspacing="5" cellpadding="2"><tr><td class="main" valign="top">' . tep_image(DIR_WS_IMAGES . 'default/1.gif') . '</td>
<td class="main" valign="top"><b>Hata Mesajları</b><br>
  <br>
  Eğer yukarıda herhangi bir hata mesaj(lar)ı görünüyorsa, lütfen ilerlemeden öncelikle  bunları düzeltiniz.<br>
  <br>
  Hata mesajları sayfanın en yukarısında arkaplanı tamamen renkli olarak gösterilmiştir.<br>
  <br>
  Online mağazanızın sağlıklı kurulduğuna emin olmak için çeşitli kontroller gerçekleştirilmiştir - bu kontroller includes/application_top.php dosyasının en altındaki uygun parametreler düzenlenerek etkinsizleştirilebilir.</td>
</tr><td class="main" valign="top">' . tep_image(DIR_WS_IMAGES . 'default/2.gif') . '</td>
<td class="main" valign="top"><b>Sayfa Metinlerini Düzenleme</b><br>
  <br>
  Burada gösterilen metin, herbir  dil için aşağıdaki dosyaya müdahale edilerek düzenlenebilir:<br>
  <br>
  <nobr class="messageStackSuccess">[katalog dizini]/includes/languages/' . $language . '/' . FILENAME_DEFAULT . '</nobr><br>
  <br>
  Bu dosya el ile  veya  Yönetim Araçı <nobr class="messageStackSuccess">Araçlar->Dilleri Düzenle->' . ucfirst($language) . '->Dil Dosyalarını Düzenle</nobr> veya <nobr class="messageStackSuccess">Araçlar->Dosya Yöneticisi</nobr> modülü ile düzenlenebilir.<br>
  <br>
  Metin aşağıdaki tarz ile oluşturulmuştur:<br>
  <br>
  <nobr>define(\'TEXT_MAIN\', \'<span class="messageStackSuccess">Bu  osCommerce projesinin varsayılan kurulumudur...</span>\');</nobr><br>
  <br>
  Yeşil ile renklendirilmiş metin düzenlenebilir -  define() fonksiyonunun TEXT_MAIN anahatarını korumanız önemlidir.  TEXT_MAIN için kullanılan metni tamamen kaldırmak için, aşağıdaki örnekte kullanıldığı gibi sadece iki tek tırnak karakteri bulundurmak yeterlidir:<br>
  <br><nobr>define(\'TEXT_MAIN\', \'\');</nobr><br><br>
  PHP define() fonksiyonu ile ilgili daha fazla bilgi  <a href="http://www.php.net/define" target="_blank"><u>buradan</u></a> okunabilir.</td>
</tr><tr><td class="main" valign="top">' . tep_image(DIR_WS_IMAGES . 'default/3.gif') . '</td>
<td class="main" valign="top"><b>Online Dökümantasyon</b><br>
  <br>
  Online dokümanlara  <a href="http://www.osicommerce.com" target="_blank"><u>osicommerce</u></a> veya <a href="http://www.oscommerce.info" target="_blank"><u>osCommerce İngilizce Bilgi Üssü</u></a> sitesinden erişebilirsiniz.<br>
  <br>
  Destek almak için <a href="http://www.osicommerce.com/forum" target="_blank"><u>osicommerce Destek Sitesini</u></a> veya <a href="http://www.oscommerce.com/support" target="_blank"><u>osCommerce İngilizce Destek Sitesini</u></a> ziyaret edilebilirsiniz.</td>
</tr></table><br>
Bu güçlü mağaza çözümünü indirmek veya  osCommerce projesine katkıda bulunmak için, lütfen <a href="http://www.osicommerce.com" target="_blank"><u>osicommerce Destek Sitesini</u></a> veya <a href="http://www.oscommerce.com" target="_blank"><u>osCommerce İngilizce Destek Sitesini</u></a> ziyaret edin. Bu mağaza <font color="#f0000"><b>' . PROJECT_VERSION . '</b></font> üzerinde çalışmaktadır.');
define('TABLE_HEADING_NEW_PRODUCTS', '%s İçin Yeni Ürünlerimiz');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Gelecek Ürünlerimiz');
define('TABLE_HEADING_DATE_EXPECTED', 'Geliş Tarihi');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Burda Neler Olduğunu Görelim');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Model');
  define('TABLE_HEADING_PRODUCTS', 'Ürün İsmi');
  define('TABLE_HEADING_MANUFACTURER', 'Üretici');
  define('TABLE_HEADING_QUANTITY', 'Miktar');
  define('TABLE_HEADING_PRICE', 'Fiyat');
  define('TABLE_HEADING_WEIGHT', 'Ağırlık');
  define('TABLE_HEADING_BUY_NOW', 'Hemen Al');
  define('TEXT_NO_PRODUCTS', 'Bu kategoride listelenecek herhangi bir ürün bulunmamaktadır.');
  define('TEXT_NO_PRODUCTS2', 'Bu üretici için listelenecek herhangi bir ürün bulunmamaktadır.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Ürün Numaraları: ');
  define('TEXT_SHOW', '<b>Göster:<br></b>');
  define('TEXT_BUY', 'Şimdi 1 adet \'');
  define('TEXT_NOW', '\' satınal');
  define('TEXT_ALL_CATEGORIES', 'Tüm Kategoriler');  
  define('TEXT_ALL_MANUFACTURERS', 'Tüm Üreticiler');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Mağazamızda Neler Yeni?');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Kategoriler');
}
?>