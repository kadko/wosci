<?php
/*
   for Separate Pricing Per Customer v4.2.1 2008/04/12
*/
  
define('HEADING_TITLE', 'Grupos');
define('HEADING_TITLE_SEARCH', 'Buscar:');

define('TABLE_HEADING_NAME', 'Nombre');
define('TABLE_HEADING_ACTION', 'Acción');

define('ENTRY_GROUPS_NAME', 'Nombre&#160;grupo:');
define('ENTRY_GROUP_NAME_MAX_LENGTH', '&#160;&#160;Maximum length: 32 characters');
define('ENTRY_GROUP_SHOW_TAX', 'Enseñar&#160;precios&#160;con/sin&#160;impuesto:');
define('ENTRY_GROUP_SHOW_TAX_EXPLAIN_1', '&#160;&#160;This Setting only works when \'Display Prices with Tax\'');
define('ENTRY_GROUP_SHOW_TAX_EXPLAIN_2', 'is set to true in the Configuration for your store and \'Exempto de impuesto\' (below) to \'No\'.');
define('ENTRY_GROUP_SHOW_TAX_YES', 'Enseñar precios con impuesto');
define('ENTRY_GROUP_SHOW_TAX_NO', 'Enseñar precios sin impuesto');

define('ENTRY_GROUP_TAX_EXEMPT', 'Exempto de impuesto:'); 
define('ENTRY_GROUP_TAX_EXEMPT_YES', 'Si'); 
define('ENTRY_GROUP_TAX_EXEMPT_NO', 'No'); 

define('ENTRY_GROUP_PAYMENT_SET', 'Configurar modulos de pago para el Grupo de Clientes');
define('ENTRY_GROUP_PAYMENT_DEFAULT', 'Usar configuraciones desde la Configuració general');
define('ENTRY_PAYMENT_SET_EXPLAIN', 'Si escoges <b><i>Configurar modulos de pago para el Grupo de Clientes</i></b> la configuracion por defecto estará todavia en uso.');

define('ENTRY_GROUP_SHIPPING_SET', 'Configurar modulos de envío para el Grupo de Clientes');
define('ENTRY_GROUP_SHIPPING_DEFAULT', 'Usar configuraciones desde la Configuració general');
define('ENTRY_SHIPPING_SET_EXPLAIN', 'Si escoges <b><i>Configurar modulos de envío para el Grupo de Clientes</i></b> la configuracion por defecto estará todavia en uso.');

define('ENTRY_GROUP_ORDER_TOTAL_SET', 'Set order total modules for the customer group');
define('ENTRY_GROUP_ORDER_TOTAL_DEFAULT', 'Use settings from Configuration');
define('ENTRY_ORDER_TOTAL_SET_EXPLAIN', 'Si escoges <b><i>Set order total modules for the customer group</i></b> la configuracion por defecto estará todavia en uso.');

define('TEXT_DELETE_INTRO', 'Estás seguro de querer borrar este Grupo de Clientes?');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS_GROUPS', 'Enseñando <b>%d</b> a <b>%d</b> (de <b>%d</b> Grupos de Clientes)');
define('TEXT_INFO_HEADING_DELETE_GROUP', 'Borrar Grupo');

define('ERROR_CUSTOMERS_GROUP_NAME', 'Porfavor pon un nombre al Grupo');

define('HEADING_TITLE_GROUP_TAX_RATES_EXEMPT', 'Exempt Group from Specific Tax Rates');
define('ENTRY_GROUP_TAX_RATES_EXEMPT', 'Exempt tax rates from the customer group');
define('ENTRY_GROUP_TAX_RATES_DEFAULT', 'Use settings from Configuration (zone based)');
define('ENTRY_TAX_RATES_EXEMPT_EXPLAIN', 'If you choose <b><i>Exempt tax rates from the customer group</i></b> but do not check any of the boxes, default settings (zone based) will still be used.<br />If you have set this group to Exempto de impuesto "Si" above, none of these settings will have any effect.');
?>
