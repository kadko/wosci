<?php
/*
  $Id: currencies.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
global $currencies,$request_type;
  if (isset($currencies) && is_object($currencies)) {
?>
<!-- currencies //-->
        
<?php


    reset($currencies->currencies);
    $currencies_array = array();
    while (list($key, $value) = each($currencies->currencies)) {
      $currencies_array[] = array('id' => $key, 'text' => $value['title']);
    }

    $hidden_get_variables = '';
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if ( ($key != 'currency') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
        $hidden_get_variables .= tep_draw_hidden_field($key, $value);
      }
    }

    $info_box_contents = array();
    $info_box_contents = tep_draw_form('currencies', tep_href_link(basename($_SERVER['PHP_SELF']), '', $request_type, false), 'get'). tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'onChange="this.form.submit();" style="width: 100%"') . $hidden_get_variables . tep_hide_session_id().'</form>';

   // new infoBox($info_box_contents);
?>


       <?php echo $info_box_contents ?>
        


          
<!-- currencies_eof //-->
<?php
  }
?>
