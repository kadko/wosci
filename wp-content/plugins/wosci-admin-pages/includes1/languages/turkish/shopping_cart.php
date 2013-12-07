<?php
/*
  $Id: shopping_cart.php,v 1.13 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('NAVBAR_TITLE', 'Sepetin İçindekiler');
define('HEADING_TITLE', 'Sepetimde Neler Var?');
define('TABLE_HEADING_REMOVE', 'Kaldır');
define('TABLE_HEADING_QUANTITY', 'Miktar');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Ürün(ler)');
define('TABLE_HEADING_TOTAL', 'Toplam');
define('TEXT_CART_EMPTY', 'Alışveriş Sepetiniz boş!');
define('SUB_TITLE_SUB_TOTAL', 'Ara-toplam:');
define('SUB_TITLE_TOTAL', 'Toplam:');

define('OUT_OF_STOCK_CANT_CHECKOUT', STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' ile işaretli ürünler istenilen miktarda stoklarımızda bulunmamaktadır.<br>Lütfen  (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ') işaretli ürün miktarını değiştirerek tekrar deneyiniz, teşekkür ederiz.');
define('OUT_OF_STOCK_CAN_CHECKOUT', STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' ile işaretli ürünler istenilen miktarda stoklarımızda bulunmamaktadir.<br>Sipariş işleminde hemen dağıtım için stoklarımızda bulunan miktar kadarını kontrol ederek yinede hepsini alabilirsiniz.');
?>