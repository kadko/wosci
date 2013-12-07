<?php
/*
  $Id: ot_loworderfee.php.tortoise.removed,v 1.1 2008/12/26 13:10:22 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class ot_loworderfee {
    var $title, $output;

    function ot_loworderfee() {
      $this->code = 'ot_loworderfee';
      $this->title = MODULE_ORDER_TOTAL_LOWORDERFEE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_LOWORDERFEE_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;

      if (MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE == 'true') {
        switch (MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION) {
          case 'national':
            if ($order->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;
          case 'international':
            if ($order->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;
          case 'both':
            $pass = true; break;
          default:
            $pass = false; break;
        }

        if ( ($pass == true) && ( ($order->info['total'] - $order->info['shipping_cost']) < MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER) ) {
          $tax = tep_get_tax_rate(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
          $tax_description = tep_get_tax_description(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);

          $order->info['tax'] += tep_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);
          $order->info['tax_groups']["$tax_description"] += tep_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);
          $order->info['total'] += MODULE_ORDER_TOTAL_LOWORDERFEE_FEE + tep_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);

          $this->output[] = array('title' => $this->title . ':',
                                  'text' => $currencies->format(tep_add_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax), true, $order->info['currency'], $order->info['currency_value']),
                                  'value' => tep_add_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax));
        }
      }
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Düşük sipariş marjını göster', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', 'Düşük siparişler için ilave marj gösterilsin mi?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sıralama Düzeni', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '4', 'Sıralama Düzeni.', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Düşük Sipariş Marjını Aktif Et', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', 'Düşük Sipariş Marjini Aktif Etmek İstiyormusunuz?', '6', '3', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('Bu Miktarı Geçmeyen Siparişler İçin İlave Marj', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', 'Bu tutarın altındaki siparişler için ilave marj ekle.', '6', '4', 'currencies->format', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('Sipariş Ek Marj', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', 'Düşük Sipariş Ücreti.', '6', '5', 'currencies->format', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Düşük Sipariş Marjını Yalnız Şuralar İçin Göster', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', 'Düşük sipariş marjı hangi muşteri bölgeleri için aktif olsun.', '6', '6', 'tep_cfg_select_option(array(\'national\', \'international\', \'both\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Vergi', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', 'İlave marj için aşağıdaki vergi oranını kullan.', '6', '7', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>
