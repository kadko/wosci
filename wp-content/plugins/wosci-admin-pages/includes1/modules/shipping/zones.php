<?php
/*

  $Id: zones.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

  USAGE
  By default, the module comes with support for 1 zone.  This can be
  easily changed by editing the line below in the zones constructor 
  that defines $this->num_zones.

  Next, you will want to activate the module by going to the Admin screen,
  clicking on Modules, then clicking on Shipping.  A list of all shipping
  modules should appear.  Click on the green dot next to the one labeled 
  zones.php.  A list of settings will appear to the right.  Click on the
  Edit button. 

  PLEASE NOTE THAT YOU WILL LOSE YOUR CURRENT SHIPPING RATES AND OTHER 
  SETTINGS IF YOU TURN OFF THIS SHIPPING METHOD.  Make sure you keep a 
  backup of your shipping settings somewhere at all times.

  If you want an additional handling charge applied to orders that use this
  method, set the Handling Fee field.

  Next, you will need to define which countries are in each zone.  Determining
  this might take some time and effort.  You should group a set of countries
  that has similar shipping charges for the same weight.  For instance, when
  shipping from the US, the countries of Japan, Australia, New Zealand, and 
  Singapore have similar shipping rates.  As an example, one of my customers
  is using this set of zones:
    1: USA
    2: Canada
    3: Austria, Belgium, Great Britain, France, Germany, Greenland, Iceland,
       Ireland, Italy, Norway, Holland/Netherlands, Denmark, Poland, Spain,
       Sweden, Switzerland, Finland, Portugal, Israel, Greece
    4: Japan, Australia, New Zealand, Singapore
    5: Taiwan, China, Hong Kong

  When you enter these country lists, enter them into the Zone X Countries
  fields, where "X" is the number of the zone.  They should be entered as
  two character ISO country codes in all capital letters.  They should be
  separated by commas with no spaces or other punctuation. For example:
    1: US
    2: CA
    3: AT,BE,GB,FR,DE,GL,IS,IE,IT,NO,NL,DK,PL,ES,SE,CH,FI,PT,IL,GR
    4: JP,AU,NZ,SG
    5: TW,CN,HK

  Now you need to set up the shipping rate tables for each zone.  Again,
  some time and effort will go into setting the appropriate rates.  You
  will define a set of weight ranges and the shipping price for each
  range.  For instance, you might want an order than weighs more than 0
  and less than or equal to 3 to cost 5.50 to ship to a certain zone.  
  This would be defined by this:  3:5.5

  You should combine a bunch of these rates together in a comma delimited
  list and enter them into the "Zone X Shipping Table" fields where "X" 
  is the zone number.  For example, this might be used for Zone 1:
    1:3.5,2:3.95,3:5.2,4:6.45,5:7.7,6:10.4,7:11.85, 8:13.3,9:14.75,10:16.2,11:17.65,
    12:19.1,13:20.55,14:22,15:23.45

  The above example includes weights over 0 and up to 15.  Note that
  units are not specified in this explanation since they should be
  specific to your locale.

  CAVEATS
  At this time, it does not deal with weights that are above the highest amount
  defined.  This will probably be the next area to be improved with the
  module.  For now, you could have one last very high range with a very
  high shipping rate to discourage orders of that magnitude.  For 
  instance:  999:1000

  If you want to be able to ship to any country in the world, you will 
  need to enter every country code into the Country fields. For most
  shops, you will not want to enter every country.  This is often 
  because of too much fraud from certain places. If a country is not
  listed, then the module will add a $0.00 shipping charge and will
  indicate that shipping is not available to that destination.  
  PLEASE NOTE THAT THE ORDER CAN STILL BE COMPLETED AND PROCESSED!

  It appears that the osC shipping system automatically rounds the 
  shipping weight up to the nearest whole unit.  This makes it more
  difficult to design precise shipping tables.  If you want to, you 
  can hack the shipping.php file to get rid of the rounding.

  Lastly, there is a limit of 255 characters on each of the Zone
  Shipping Tables and Zone Countries. 

*/

  class zones {
    var $code, $title, $description, $enabled, $num_zones;

// class constructor
    function zones() {
      $this->code = 'zones';
      $this->title = __('Zone Rates', 'wosci-translation');
      $this->description = __('Zone Based Rates', 'wosci-translation');
      $this->sort_order = MODULE_SHIPPING_ZONES_SORT_ORDER;
      $this->icon = '';
      $this->tax_class = MODULE_SHIPPING_ZONES_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_ZONES_STATUS == 'True') ? true : false);

      // CUSTOMIZE THIS SETTING FOR THE NUMBER OF ZONES NEEDED
      $this->num_zones = 5;
    }

// class methods
    function quote($method = '') {
      global $order, $shipping_weight, $shipping_num_boxes;

      $dest_country = $order->delivery['zone_id'];
      $dest_zone = 0;
      $error = false;

      for ($i=1; $i<=$this->num_zones; $i++) {
        $countries_table = constant('MODULE_SHIPPING_ZONES_COUNTRIES_' . $i);
        $country_zones = split("[,]", $countries_table);
        if (in_array($dest_country, $country_zones)) {
          $dest_zone = $i;
          break;
        }
      }

      if ($dest_zone == 0) {
        $error = true;
      } else {
        $shipping = -1;
        $zones_cost = constant('MODULE_SHIPPING_ZONES_COST_' . $dest_zone);

        $zones_table = split("[:,]" , $zones_cost);
        $size = sizeof($zones_table);
        for ($i=0; $i<$size; $i+=2) {
          if ($shipping_weight <= $zones_table[$i]) {
            $shipping = $zones_table[$i+1];
            $shipping_method = __('Shipping to', 'wosci-translation') . ' ' . $order->delivery['state']. ' : ' . $shipping_weight . ' ' . __('lb(s)', 'wosci-translation');
            break;
          }
        }

        if ($shipping == -1) {
          $shipping_cost = 0;
          $shipping_method = __('The shipping rate cannot be determined at this time', 'wosci-translation');
        } else {
          $shipping_cost = ($shipping * $shipping_num_boxes) + constant('MODULE_SHIPPING_ZONES_HANDLING_' . $dest_zone);
        }
      }

      $this->quotes = array('id' => $this->code,
                            'module' => __('Zone Rates','wosci-translation'),
                            'methods' => array(array('id' => $this->code,
                                                     'title' => $shipping_method,
                                                     'cost' => $shipping_cost)));

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      if ($error == true) $this->quotes['error'] = __('No shipping available to the selected country', 'wosci-translation');

      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_ZONES_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Şehir Bazında Tablo Oranları - (Bölge Şehirleri Bazında, Türkiye ve Dünya Geneli)', 'MODULE_SHIPPING_ZONES_STATUS', 'True', 'Bölge şehirleri bazında kargo etkinleştirilsin mi?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Vergi', 'MODULE_SHIPPING_ZONES_TAX_CLASS', '0', 'Kargo fiyatına aşağıdaki vergiyi ekle.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sıralama Düzeni', 'MODULE_SHIPPING_ZONES_SORT_ORDER', '0', 'Görüntüleme için sıralama düzeni.', '6', '0', now())");
      for ($i = 1; $i <= $this->num_zones; $i++) {
        $default_countries = '';
        if ($i == 1) {
          $default_countries = '192,193,237';
        }
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bolge " . $i ." Sehirleri', 'MODULE_SHIPPING_ZONES_COUNTRIES_" . $i ."', '" . $default_countries . "', 'Virgullerle ayrilmis bolge sehirleri. Her numara sehir ID sini temsil etmektedir. Sehir ID leri Sehirler/Bolgeler kismindan kontrol edilebilir. Bolge - " . $i . ".', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bolge " . $i ." e ait fiyat tablosu', 'MODULE_SHIPPING_ZONES_COST_" . $i ."', '1:4.09,2:4.11,3:4.58,4:5.07,5:5.66,6:6.35,7:7.03,8:7.76,9:8.51,10:9.27', 'Bu fiyat tablosu Bolge " . $i . " sehirlerine uygulanacak fiyatlari gosterir. Maksimum siparis agirligina gore hesaplanir. Ornek yazim: 3:8.50,7:10.50,... Bu ornekte 3 ve altindaki siparis agirliklari 8.5 olarak fiyatlandirilir. Bolge - " . $i . " sehirleri icindir.', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bolge " . $i ." siparis hazirlik ucreti', 'MODULE_SHIPPING_ZONES_HANDLING_" . $i."', '0', 'Siparis hazirlama ucreti varsa giriniz', '6', '0', now())");
      }
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array('MODULE_SHIPPING_ZONES_STATUS', 'MODULE_SHIPPING_ZONES_TAX_CLASS', 'MODULE_SHIPPING_ZONES_SORT_ORDER');

      for ($i=1; $i<=$this->num_zones; $i++) {
        $keys[] = 'MODULE_SHIPPING_ZONES_COUNTRIES_' . $i;
        $keys[] = 'MODULE_SHIPPING_ZONES_COST_' . $i;
        $keys[] = 'MODULE_SHIPPING_ZONES_HANDLING_' . $i;
      }

      return $keys;
    }
  }
?>
