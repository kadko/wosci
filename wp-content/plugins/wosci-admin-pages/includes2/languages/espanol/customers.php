<?php
/*
  $Id: customers.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Clientes');
define('HEADING_TITLE_SEARCH', 'Buscar:');

define('TABLE_HEADING_FIRSTNAME', 'Nombre');
define('TABLE_HEADING_LASTNAME', 'Apellido');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Cuenta Creada');
define('TABLE_HEADING_ACTION', 'Acci&oacute;n');

define('TEXT_DATE_ACCOUNT_CREATED', 'Cuenta Creada:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Ultima Modificaci&oacute;n:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Ultima Visita:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'N&uacute;mero de visitas:');
define('TEXT_INFO_COUNTRY', 'Pa&iacute;s:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'N&uacute;mero de Comentarios:');
define('TEXT_DELETE_INTRO', 'Seguro que desea eliminar este cliente?');
define('TEXT_DELETE_REVIEWS', 'Eliminar %s comentario(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Eliminar Cliente');
define('TYPE_BELOW', 'Escriba debajo');
define('PLEASE_SELECT', 'Seleccione');
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
