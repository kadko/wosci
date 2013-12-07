<?php
/*
  $Id: customers.php,v 1.12 05/11/2007 22:10

  osicommerce bir osCommerce Açık Kaynak E-Ticaret Çözümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('HEADING_TITLE', 'Müşteriler');
define('HEADING_TITLE_SEARCH', 'Ara:');

define('TABLE_HEADING_FIRSTNAME', 'İsim');
define('TABLE_HEADING_LASTNAME', 'Soy İsim');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Üyelik Tarihi');
define('TABLE_HEADING_ACTION', 'Hareket');

define('TEXT_DATE_ACCOUNT_CREATED', 'Üyelik Tarihi:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Son Güncelleme:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Son Giriş:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Giriş Sayısı:');
define('TEXT_INFO_COUNTRY', 'Ülke:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Yorum Sayısı:');
define('TEXT_DELETE_INTRO', 'Bu müşteriyi silmek istediğinize emin misiniz?');
define('TEXT_DELETE_REVIEWS', ' %s yorum(lar)ı Sil');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Müşteriyi Sil');
define('TYPE_BELOW', 'Aşağıya Yaz');
define('PLEASE_SELECT', 'Birisini Seç');
// BOF Separate Pricing Per Customer
define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Customer&#160;Group');
define('TABLE_HEADING_REQUEST_AUTHENTICATION', 'RA');
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Set payment modules for the customer');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'If you choose <b><i>Set payment modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Set shipping modules for the customer');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'If you choose <b><i>Set shipping modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
define('ENTRY_CUSTOMERS_ORDER_TOTAL_SET', 'Set order total modules for the customer');
define('ENTRY_CUSTOMERS_ORDER_TOTAL_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_ORDER_TOTAL_SET_EXPLAIN', 'If you choose <b><i>Set order total modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');

define('HEADING_TITLE_CUSTOMERS_TAX_RATES_EXEMPT', 'Exempt Customer from Specific Tax Rates');
define('ENTRY_CUSTOMERS_TAX_RATES_EXEMPT', 'Exempt tax rates from the customer');
define('ENTRY_CUSTOMERS_TAX_RATES_DEFAULT', 'Use settings from Group or Configuration (zone based)');
define('ENTRY_CUSTOMERS_TAX_RATES_EXEMPT_EXPLAIN', 'If you choose <b><i>Exempt tax rates from the customer</i></b> but do not check any of the boxes, default settings (Group or zone based Configuration settings) will still be used.<br />If this customer is in a group that is "Tax Exempt", none of these settings will have any effect.');
define('SORT_BY_COMPANYNAME', 'Sort by Company Name --> A-B-C From Top ');
define('SORT_BY_COMPANYNAME_DESC', 'Sort by Company Name --> Z-X-Y From Top ');
define('SORT_BY_FIRSTNAME', 'Sort by First Name ascending --> A-B-C From Top ');
define('SORT_BY_FIRSTNAME_DESC', 'Sort by First Name descending --> Z-X-Y From Top ');
define('SORT_BY_LASTNAME', 'Sort by Last Name ascending --> A-B-C From Top ');
define('SORT_BY_LASTNAME_DESC', 'Sort by Last Name descending --> Z-Y-X From Top ');
define('SORT_BY_CUSTOMER_GROUP', 'Sort by Customer Group ascending --> A-B-C From Top ');
define('SORT_BY_CUSTOMER_GROUP_DESC', 'Sort by Customer Group descending --> Z-X-Y From Top ');
define('SORT_BY_ACCOUNT_CREATED', 'Sort by Account Created ascending  --> 1-2-3 From Top ');
define('SORT_BY_ACCOUNT_CREATED_DESC', 'Sort by Account Created descending  --> 3-2-1 From Top ');
define('SORT_BY_RA', 'Sort by Request Authorization --> RA first (to Top) ');
define('SORT_BY_RA_DESC', 'Sort by Request Authorization --> RA last (to Bottom) ');
// EOF Separate Pricing Per Customer

?>
