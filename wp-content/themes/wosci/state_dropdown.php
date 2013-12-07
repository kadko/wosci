<?php
// Released under the GNU General Public License
require('includes/application_top2.php');
$country = $_POST['country'];

$zones_array = array();    
$zones_query = tep_db_query("select zone_name, zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_code");
while ($zones_values = tep_db_fetch_array($zones_query)) {
  $zones_array[] = array('id' => $zones_values['zone_code'], 'text' => $zones_values['zone_name']);
}
header('Content-type: text/html; charset='.CHARSET);

if ( tep_db_num_rows($zones_query) ) {
  echo tep_draw_pull_down_menu('state', $zones_array, $_POST['city_code'],'class="form-control"'). '&nbsp;' . '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>';
} else {
  echo tep_draw_input_field('state','','class="form-control" style=""') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); 
}
?>