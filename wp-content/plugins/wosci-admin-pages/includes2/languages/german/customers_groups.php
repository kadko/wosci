<?php
/*
   for Separate Pricing Per Customer v4.2.1 2008/04/12
*/

define('HEADING_TITLE', 'Gruppen');
define('HEADING_TITLE_SEARCH', 'Suche::');

define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_ACTION', 'Aktion');

define('ENTRY_GROUPS_NAME', 'Gruppenname:');
define('ENTRY_GROUP_NAME_MAX_LENGTH', '&#160;&#160;Maximum L&auml;nge: 32 Zeichen');
define('ENTRY_GROUP_SHOW_TAX', 'Zeige&#160;Preise&#160;mit/ohne&#160;Steuer:');
define('ENTRY_GROUP_SHOW_TAX_EXPLAIN_1', '&#160;&#160;Diese Einstellung wirkt nur wann \'Zeige Preise mit Steuer\'');
define('ENTRY_GROUP_SHOW_TAX_EXPLAIN_2', 'auf Wahr gesetzt worden ist in die Konfigurierung f&uuml;r Ihr Laden und Steuerbefreit (unten) zu \'Nein\'.');
define('ENTRY_GROUP_SHOW_TAX_YES', 'Zeige Preise mit Steuer');
define('ENTRY_GROUP_SHOW_TAX_NO', 'Zeige Preise ohne Steuer');

define('ENTRY_GROUP_TAX_EXEMPT', 'Steuerbefreit:');
define('ENTRY_GROUP_TAX_EXEMPT_YES', 'Ja');
define('ENTRY_GROUP_TAX_EXEMPT_NO', 'Nein');

define('ENTRY_GROUP_PAYMENT_SET', 'Zahlungsmodule für die Kundengruppe definieren');
define('ENTRY_GROUP_PAYMENT_DEFAULT', 'Benütze die Einstellungen der Grundeinstellung');
define('ENTRY_PAYMENT_SET_EXPLAIN', 'Wenn <b><i>Zahlungsmodule für die Kundengruppe definieren</i></b> gew&auml;hlt wird aber keine Checkbox gesetzt ist, werden die Grundeinstellungen ben&uuml;tzt.');

define('ENTRY_GROUP_SHIPPING_SET', 'Versandarten für die Kundengruppe definieren');
define('ENTRY_GROUP_SHIPPING_DEFAULT', 'Benütze die Einstellungen der Grundeinstellung');
define('ENTRY_SHIPPING_SET_EXPLAIN', 'Wenn <b><i>Versandarten für die Kundengruppe definieren</i></b> gew&auml;hlt wird aber keine Checkbox gesetzt ist, werden die Grundeinstellungen ben&uuml;tzt.');

define('ENTRY_GROUP_ORDER_TOTAL_SET', 'Zusammenfassung für die Kundengruppe definieren');
define('ENTRY_GROUP_ORDER_TOTAL_DEFAULT', 'Benütze die Einstellungen der Grundeinstellung');
define('ENTRY_ORDER_TOTAL_SET_EXPLAIN', 'Wenn <b><i>Zusammenfassung für die Kundengruppe definieren</i></b> gew&auml;hlt wird aber keine Checkbox gesetzt ist, werden die Grundeinstellungen ben&uuml;tzt.');

define('TEXT_DELETE_INTRO', 'Soll diese Gruppe wirklich gel&ouml;sch werden?');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS_GROUPS', 'Kundengruppe <b>%d</b> bis <b>%d</b> (von <b>%d</b>)');
define('TEXT_INFO_HEADING_DELETE_GROUP', 'Gruppe l&ouml;schen');

define('ERROR_CUSTOMERS_GROUP_NAME', 'Bitte einen Gruppennamen eingeben');

define('HEADING_TITLE_GROUP_TAX_RATES_EXEMPT', 'Exempt Group from Specific Tax Rates');
define('ENTRY_GROUP_TAX_RATES_EXEMPT', 'Exempt tax rates from the customer group');
define('ENTRY_GROUP_TAX_RATES_DEFAULT', 'Benütze die Einstellungen der Grundeinstellung (Zone basiert)');
define('ENTRY_TAX_RATES_EXEMPT_EXPLAIN', 'Wenn <b><i>Exempt tax rates from the customer group</i></b> gew&auml;hlt wird aber keine Checkbox gesetzt ist, werden die Grundeinstellungen (Zone basiert) ben&uuml;tzt.<br />If you have set this group to Steuerbefreit "Ja" above, none of these settings will have any effect.');
?>
