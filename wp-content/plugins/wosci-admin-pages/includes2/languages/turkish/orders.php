<?php
/*
  $Id: orders.php,v 1.24 05/11/2007 22:10

  osicommerce bir osCommerce Açık Kaynak E-Ticaret Çözümüdür
  http://www.osicommerce.com

  Copyright (c) 2008 osicommerce

  GNU Genel Kamu Lisansı (GPL) altında sunulmuştur
*/

define('HEADING_TITLE', 'Siparişler');
define('HEADING_TITLE_SEARCH', 'Sipariş ID:');
define('HEADING_TITLE_STATUS', 'Durum:');

define('TABLE_HEADING_COMMENTS', 'Yorumlar');
define('TABLE_HEADING_CUSTOMERS', 'Müşteriler');
define('TABLE_HEADING_ORDER_TOTAL', 'Sipariş Toplamı');
define('TABLE_HEADING_DATE_PURCHASED', 'Satış Tarihi');
define('TABLE_HEADING_STATUS', 'Durum');
define('TABLE_HEADING_ACTION', 'Hareket');
define('TABLE_HEADING_QUANTITY', 'Miktar');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Ürünler');
define('TABLE_HEADING_TAX', 'KDV');
define('TABLE_HEADING_TOTAL', 'Toplam');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Fiyat (hariç)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Fiyat (dahil)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Toplam (hariç)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Toplam (dahil)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Müşteriye Bildiri Yollandı');
define('TABLE_HEADING_DATE_ADDED', 'Eklenme Tarihi');

define('ENTRY_CUSTOMER', 'Müşteri:');
define('ENTRY_SOLD_TO', 'Fatura Adresi:');
define('ENTRY_DELIVERY_TO', 'Dağıtım Adresi:');
define('ENTRY_SHIP_TO', 'Gönderi Adresi:');
define('ENTRY_SHIPPING_ADDRESS', 'Taşıma Adresi:');
define('ENTRY_BILLING_ADDRESS', 'Fatura Adresi:');
define('ENTRY_PAYMENT_METHOD', 'Ödeme Metodu:');
define('ENTRY_CREDIT_CARD_TYPE', 'Kredi Kartı Türü:');
define('ENTRY_CREDIT_CARD_OWNER', 'Kredi Kartı Sahibi:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kredi Kartı Numarası:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Kredi Kartı son Kullanma Tarihi:');
define('ENTRY_SUB_TOTAL', 'Ara-Toplam:');
define('ENTRY_TAX', 'Vergi:');
define('ENTRY_SHIPPING', 'Nakliye:');
define('ENTRY_TOTAL', 'Toplam:');
define('ENTRY_DATE_PURCHASED', 'Satış Tarihi:');
define('ENTRY_STATUS', 'Durum:');
define('ENTRY_DATE_LAST_UPDATED', 'Son Güncellenme Tarihi:');
define('ENTRY_NOTIFY_CUSTOMER', 'Müşteri Bildirimi:');
define('ENTRY_NOTIFY_COMMENTS', 'Açıklamları Ekle:');
define('ENTRY_PRINTABLE', 'Fatura Yazdır');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Siparişi Sil');
define('TEXT_INFO_DELETE_INTRO', 'Bu siparişi silmek istediğinize emin misiniz?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Ürün miktarını stoğa geri ekle');
define('TEXT_DATE_ORDER_CREATED', 'Oluşturulma Tarihi:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Son Güncelleme:');
define('TEXT_INFO_PAYMENT_METHOD', 'Ödeme Metodu:');

define('TEXT_ALL_ORDERS', 'Tüm Siparişler');
define('TEXT_NO_ORDER_HISTORY', 'Geçmiş Siparişlere Ulaşılamıyor');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Sipariş Güncelle');
define('EMAIL_TEXT_ORDER_NUMBER', 'Sipariş Numarası:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaylı Fatura:');
define('EMAIL_TEXT_DATE_ORDERED', 'Sipariş Tarihi:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Sipariş durumunuz belirtilen duruma güncellendi.' . "\n\n" . 'Yeni durum: %s' . "\n\n" . 'Lütfen herhangi bir sorunuz olursa bu postayı cevaplayınız.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Siparişiniz hakkındaki görüşler' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Hata: Sipariş bulunamıyor.');
define('SUCCESS_ORDER_UPDATED', 'Başarılı: Sipariş başarıyla güncellendi.');
define('WARNING_ORDER_NOT_UPDATED', 'Uyarı: Hiçbir şey değişmedi. Şipariş güncenlenmedi.');
// BOF Separate Pricing Per Customer
define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Customer Group');
// EOF Separate Pricing Per Customer
?>