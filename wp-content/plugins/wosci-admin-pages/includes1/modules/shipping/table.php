<?php
/*
  $Id: table.php.tortoise.removed,v 1.1 2008/12/26 13:10:22 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class table {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function table() {
      global $order;

      $this->code = 'table';
      $this->title = __('Table Rate', 'wosci-language');
      $this->description = __('Table Rate', 'wosci-language');
      $this->sort_order = MODULE_SHIPPING_TABLE_SORT_ORDER;
      $this->icon = '';
      $this->tax_class = MODULE_SHIPPING_TABLE_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_TABLE_STATUS == 'True') ? true : false);

      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_TABLE_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_TABLE_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

// class methods
    function quote($method = '') {
      global $order, $cart, $shipping_weight, $shipping_num_boxes;

      if (MODULE_SHIPPING_TABLE_MODE == 'price') {
        $order_total = $cart->show_total();
      } else {
        $order_total = $shipping_weight;
      }

      $table_cost = split("[:,]" , MODULE_SHIPPING_TABLE_COST);
      $size = sizeof($table_cost);
      for ($i=0, $n=$size; $i<$n; $i+=2) {
        if ($order_total <= $table_cost[$i]) {
          $shipping = $table_cost[$i+1];
          break;
        }
      }

      if (MODULE_SHIPPING_TABLE_MODE == 'weight') {
        $shipping = $shipping * $shipping_num_boxes;
      }

      $this->quotes = array('id' => $this->code,
                            'module' => __('Table Rate', 'wosci-language'),
                            'methods' => array(array('id' => $this->code,
                                                     'title' => __('Best Way', 'wosci-language'),
                                                     'cost' => $shipping + MODULE_SHIPPING_TABLE_HANDLING)));

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_TABLE_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Tablo Fiyat Oranları', 'MODULE_SHIPPING_TABLE_STATUS', 'True', 'Tablo fiyatından kargo ücreti seçeneği aktif olsun mu?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Tablo Oranı', 'MODULE_SHIPPING_TABLE_COST', '25:8.50,50:5.50,10000:0.00', 'Kargo ücreti ağırlık veya toplam sipariş tutarına göre hesaplanır. Örnek: 25:8.50,50:5.50,vb.. 25\'e 8.5 hesaplar, oradan 50\' ye kadar 5.50 hesaplar, gibi...', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Tablo Oranı', 'MODULE_SHIPPING_TABLE_MODE', 'weight', 'Kargo tutarı ağırlığa göre veya toplam sipariş tutarına göredir.', '6', '0', 'tep_cfg_select_option(array(\'weight\', \'price\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Hazırlık Ücreti', 'MODULE_SHIPPING_TABLE_HANDLING', '0', 'Sipariş hazırlık ücreti.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Vergi (KDV)', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Kargo tutarı için aşağıdaki vergi oranını kullan.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Kargo Bölgesi', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'Kargo bölgesi seçildiğinde bu kargo şekli sadece seçilen bölgede aktif olacaktır.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sıralama Düzeni', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'Görüntüleme için sıralama düzeni.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SHIPPING_TABLE_STATUS', 'MODULE_SHIPPING_TABLE_COST', 'MODULE_SHIPPING_TABLE_MODE', 'MODULE_SHIPPING_TABLE_HANDLING', 'MODULE_SHIPPING_TABLE_TAX_CLASS', 'MODULE_SHIPPING_TABLE_ZONE', 'MODULE_SHIPPING_TABLE_SORT_ORDER');
    }
  }
?>
