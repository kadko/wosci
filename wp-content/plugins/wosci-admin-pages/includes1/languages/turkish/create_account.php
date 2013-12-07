<?php
/*
  $Id: create_account.php,v 1.10 05/11/2007 22:10

  osicommerce, Bir OsCommerce Açık Kaynak E-Ticaret Çüzümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('NAVBAR_TITLE', 'Hesap Aç');

define('HEADING_TITLE', 'Hesap Bilgilerim');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>NOT:</b></font></small> Mağazamızda bir hesabınız varsa, lütfen giriş sayfasından <a href="%s"><u>üye girişi</u></a> yapınız.');

define('EMAIL_SUBJECT', STORE_NAME . ' - Hoş Geldiniz!');
define('EMAIL_GREET_MR', 'Sayın Bay. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Sayın Bayan. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Sayın %s' . "\n\n");
define('EMAIL_WELCOME', '<b>' . STORE_NAME . ' mağazamıza hoş geldiniz.</b>' . "\n\n");
define('EMAIL_TEXT', 'Size vereceğimiz <b>çeşitli hizmetlerden</b> yararlanmak için ilk adımı attınız. Bu hizmetlerimizden bazıları;' . "\n\n" . '<li><b>Alışveriş Sepeti</b> - Sepetinize eklediğiniz ürünler siz silmedikçe ya da satın almadıkça kaybolmaz.' . "\n" . '<li><b>Adres Defteri</b> - Satın aldığınız ürünleri siz istediğiniz takdirde adresiniz dışında başka adreslere de yollayabiliriz! Bu sayede özel günlerde istediğiniz kişiye hediye yollayabilirsiniz.' . "\n" . '<li><b>Geçmiş Siparişler</b> - Daha önceden yapmış olduğunuz alışverişleri istediğiniz zaman görüntüleyebilirsiniz.' . "\n" . '<li><b>Ürün Yorumları</b> - Ürünler hakkındaki fikirlerinizi paylaşabilir kullanıcılarımızla paylaşabilirsiniz!' . "\n\n");
define('EMAIL_CONTACT', 'Hizmetlerimizle ilgili sorularınızı, lütfen bize yollayın: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Not:</b> Bu e-posta adresi müşterilerimizden birisi tarafından bize verilmiştir. Eğer siz üye olmak için başvurmadıysanız, lütfen ' . STORE_OWNER_EMAIL_ADDRESS . '\'a e-posta gönderiniz.' . "\n\n");
?>