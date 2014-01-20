<?php
/*
Plugin Name: Wosci Admin Pages
Plugin URI: http://www.wosci.com/
Description: Wosci Admin Pages
Version: 1.1
Author: Kadir Korkmaz
Author URI: http://www.wosci.com
License: GPL2
*/


 

//load_plugin_textdomain('wosci-language', false, basename( dirname( __FILE__ ) ) . '/languages' );
 
 
function theme_name_scripts() {
	 wp_register_style( 'shopcss', plugins_url('stylesheet.css', __FILE__) );
	  wp_enqueue_style( 'shopcss' );
}
add_action( 'admin_menu', 'theme_name_scripts' );

function tt_add_menu_items(){
	add_menu_page('Modules - Payment / Shipping / Order Total', 'Modules', 'activate_plugins', 'modules_menu', 'modules_page','div');
	add_submenu_page( 'modules_menu', 'Payment Modules', 'Payment Modules', 'activate_plugins', 'admin.php?page=modules_menu&set=payment', '' );
	add_submenu_page( 'modules_menu', 'Shipping Modules', 'Shipping Modules', 'activate_plugins', 'admin.php?page=modules_menu&set=shipping', '' );
	add_submenu_page( 'modules_menu', 'Order Total Modules', 'Order Total Modules', 'activate_plugins', 'admin.php?page=modules_menu&set=ordertotal', '' );


}
add_action('admin_menu', 'tt_add_menu_items');






require_once('includes1/application_top.php');

if ( is_admin() ){ 

	include('includes2/languages/english/modules.php');

}


function modules_page(){
      
    ?>
   
        
<?php

  $set = (isset($_GET['set']) ? $_GET['set'] : 'payment');

  if (tep_not_null($set)) {
    switch ($set) {
      case 'shipping':
        $module_type = 'shipping';
        $module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';
        $module_key = 'MODULE_SHIPPING_INSTALLED';
        define('HEADING_TITLE', HEADING_TITLE_MODULES_SHIPPING);
        break;
      case 'ordertotal':
        $module_type = 'order_total';
        $module_directory = DIR_FS_CATALOG_MODULES . 'order_total/';
        $module_key = 'MODULE_ORDER_TOTAL_INSTALLED';
        define('HEADING_TITLE', HEADING_TITLE_MODULES_ORDER_TOTAL);
        break;
      case 'payment':
      default:
        $module_type = 'payment';
        $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
        $module_key = 'MODULE_PAYMENT_INSTALLED';
        define('HEADING_TITLE', HEADING_TITLE_MODULES_PAYMENT);
        break;
    }
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'save':
        while (list($key, $value) = each($_POST['configuration'])) {
          tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . $value . "' where configuration_key = '" . $key . "'");
        }
        wp_redirect('admin.php?page=modules_menu&set=' . $set . '&module=' . $_GET['module']);
        break;
      case 'install':
      case 'remove':
     
        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        $class = basename($_GET['module']);
        if (file_exists($module_directory . $class . '.php')) {
          include($module_directory . $class . '.php'); 
          $module = new $class;
          if ($action == 'install') {
            $module->install();
          } elseif ($action == 'remove') {
            $module->remove();
          }
        }
        wp_redirect('admin.php?page=modules_menu&set=' . $set . '&module=' . $class);
        break;
    }
  }

?>        
<div class="wrap">    <!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><h2><?php echo HEADING_TITLE; ?></h2></td>
            <td class="wrap" align="right"><h2></h2></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              
              
              
              <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
	
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo TABLE_HEADING_MODULES; ?></th>
	<th scope="col" id="name" class="manage-column column-name" style="text-align:right;"><?php echo TABLE_HEADING_SORT_ORDER; ?></th>
	<th scope="col" id="role" class="manage-column column-role" style="text-align:right;"><?php echo TABLE_HEADING_ACTION; ?></th>

	
</tr>
</thead>

<tfoot>
<tr class="thead">
	
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo TABLE_HEADING_MODULES; ?></th>
	<th scope="col" id="name" class="manage-column column-name" style="text-align:right;"><?php echo TABLE_HEADING_SORT_ORDER; ?></th>
	<th scope="col" id="role" class="manage-column column-role" style="text-align:right;"><?php echo TABLE_HEADING_ACTION; ?></th>
	
</tr>
</tfoot>
              
              
              
<?php
  $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
  $directory_array = array();
  if ($dir = @dir($module_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir($module_directory . $file)) {  
        if (substr($file, strrpos($file, '.')) == '.php') {
          $directory_array[] = $file;
        }
      }
    }
    sort($directory_array);
    $dir->close();
  }

  $installed_modules = array();
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];
	$language =  'english';

    include('includes1/languages/' . $language . '/modules/' . $module_type . '/' . $file);
    include($module_directory . $file);

    $class = substr($file, 0, strrpos($file, '.'));
    if (tep_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        if ($module->sort_order > 0) {
          $installed_modules[$module->sort_order] = $file;
        } else {
          $installed_modules[] = $file;
        }
      }

      if ((!isset($_GET['module']) || (isset($_GET['module']) && ($_GET['module'] == $class))) && !isset($mInfo)) {
        $module_info = array('code' => $module->code,
                             'title' => $module->title,
                             'description' => $module->description,
                             'status' => $module->check(),
                             'signature' => (isset($module->signature) ? $module->signature : null));

        $module_keys = $module->keys();

        $keys_extra = array();
        for ($j=0, $k=sizeof($module_keys); $j<$k; $j++) {
          $key_value_query = tep_db_query("select configuration_title, configuration_value, configuration_description, use_function, set_function from " . TABLE_CONFIGURATION . " where configuration_key = '" . $module_keys[$j] . "'");
          $key_value = tep_db_fetch_array($key_value_query);

          $keys_extra[$module_keys[$j]]['title'] = $key_value['configuration_title'];
          $keys_extra[$module_keys[$j]]['value'] = $key_value['configuration_value'];
          $keys_extra[$module_keys[$j]]['description'] = $key_value['configuration_description'];
          $keys_extra[$module_keys[$j]]['use_function'] = $key_value['use_function'];
          $keys_extra[$module_keys[$j]]['set_function'] = $key_value['set_function'];
        }

        $module_info['keys'] = $keys_extra;

        $mInfo = new objectInfo($module_info);
      }

      if (isset($mInfo) && is_object($mInfo) && ($class == $mInfo->code) ) {
        if ($module->check() > 0) {
          echo '              <tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href=\'admin.php?page=modules_menu&set=' . $set . '&module=' . $class . '&action=edit\'">' . "\n";
        } else {
          echo '              <tr id="defaultSelected" class="dataTableRowSelected" _POST>' . "\n";
        }
      } else {
        echo '              <tr class="dataTableRow" _POST onclick="document.location.href=\'admin.php?page=modules_menu&set=' . $set . '&module=' . $class . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $module->title; ?></td>
                <td class="dataTableContent" align="right"><?php if (is_numeric($module->sort_order)) echo $module->sort_order; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($mInfo) && is_object($mInfo) && ($class == $mInfo->code) ) { echo '►'; } else { echo '<a href="admin.php?page=modules_menu&set=' . $set . '&module=' . $class . '">►</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
  }

  ksort($installed_modules);
  $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = '" . $module_key . "'");
  if (tep_db_num_rows($check_query)) {
    $check = tep_db_fetch_array($check_query);
    if ($check['configuration_value'] != implode(';', $installed_modules)) {
      tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . implode(';', $installed_modules) . "', last_modified = now() where configuration_key = '" . $module_key . "'");
    }
  } else {
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Installed Modules', '" . $module_key . "', '" . implode(';', $installed_modules) . "', 'This is automatically updated. No need to edit.', '6', '0', now())");
  }
?>
              <tr>
                <td colspan="3" class="smallText"><?php echo TEXT_MODULE_DIRECTORY . ' ' . $module_directory; ?></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'edit':
      $keys = '';
      reset($mInfo->keys);
      while (list($key, $value) = each($mInfo->keys)) {
        $keys .= '<div class="misc-pub-section"><b>' . $value['title'] . '</b><br>' . $value['description'] . '<br>';

        if ($value['set_function']) {
          eval('$keys .= ' . $value['set_function'] . "'" . $value['value'] . "', '" . $key . "');");
        } else {
          $keys .= tep_draw_input_field('configuration[' . $key . ']', $value['value']);
        }
        $keys .= '<br><br></div>';
      }
     // $keys = substr($keys, 0, strrpos($keys, '<br><br>'));

      $heading[] = array('text' => '<b>' . $mInfo->title . '</b>');

      $contents = array('form' => tep_draw_form('modules', 'admin.php?page=modules_menu'.'&set=' . $set . '&module=' . $_GET['module'] . '&action=save', 'post'));
      $contents[] = array('text' => $keys);
      //$contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update').'" class="button" /> <a class="button" href="' . tep_href_link('wp-admin/admin.php?page=modules_menu'.'&set=' . $set . '&module=' . $_GET['module'], '') . '">'. __('Cancel').'</a>');
      
      $contents[] = array('align' => 'center', 'text' => '<div id="major-publishing-actions">
<div id="delete-action">
<a class="button" href="admin.php?page=modules_menu&set=' . $set . '&module=' . $_GET['module'] . '">'. __('Cancel', 'wosci-language').'</a>
</div>

<div id="publishing-action">
<span class="spinner"></span>
		 <input type="submit" value="'. __('Update').'" class="button" />
		 
		
</div>
<div class="clear"></div>
</div>');
      
      
      break;
    default:
      $heading[] = array('text' => '<b>' . $mInfo->title . '</b>');
      if ($mInfo->status == '1') {
        $keys = '';
        reset($mInfo->keys);
        while (list(, $value) = each($mInfo->keys)) {
          $keys .= '<div class="misc-pub-section">' . $value['title'] . ': ';
          if ($value['use_function']) {
            $use_function = $value['use_function'];
             $use_function = str_replace("-_","->",$use_function);
             if (preg_match('/->/', $use_function)) {
              $class_method = explode('->', $use_function);
              if (!is_object(${$class_method[0]})) {
                include_once (DIR_WS_CLASSES . $class_method[0] . '.php');
                ${$class_method[0]} = new $class_method[0]();
              }
              $keys .= '<b>'.tep_call_function($class_method[1], $value['value'], ${$class_method[0]}).'</b></div>';
            } else {
           
             
              $keys .= '<b>'.tep_call_function($use_function, $value['value']).'</b></div>';
              
              
            }
          } else {
            $keys .= '<b>'.$value['value'].'</b></div>';
          }
          $keys .= '</div>';
        }
        //$keys = substr($keys, 0, strrpos($keys, ''));
        


$buttons = '<div id="major-publishing-actions">
<div id="delete-action">
<a class="button" href="admin.php?page=modules_menu&set=' . $set . '&module=' . $mInfo->code . '&action=remove">'. __('Remove', 'wosci-language').'</a>
</div>

<div id="publishing-action">
<span class="spinner"></span>
		 <a class="button" href="admin.php?page=modules_menu&set=' . $set . '&module=' . $_GET['module'] . '&action=edit">'. __('Edit', 'wosci-language').'</a>
		 
		
</div>
<div class="clear"></div>
</div>';

        //$contents[] = array('align' => 'center', 'text' => '<a class="button" href="' . tep_href_link('wp-admin/admin.php?page=modules_menu'.'&set=' . $set . '&module=' . $mInfo->code . '&action=remove', '') . '">'. __('Remove').'</a> <a class="button" href="' . tep_href_link('wp-admin/admin.php?page=modules_menu'.'&set=' . $set . (isset($_GET['module']) ? '&module=' . $_GET['module'] : '') . '&action=edit', '') . '">'. __('Edit').'</a>');

        if (isset($mInfo->signature) && (list($scode, $smodule, $sversion, $soscversion) = explode('|', $mInfo->signature))) {
         // $contents[] = array('text' => '<br>' . '' . '&nbsp;<b>' . TEXT_INFO_VERSION . '</b> ' . $sversion . ' (<a href="http://sig.oscommerce.com/' . $mInfo->signature . '" target="_blank">' . TEXT_INFO_ONLINE_STATUS . '</a>)');
        }

        $contents[] = array('text' => '<div class="misc-pub-section">' . $mInfo->description . '</div>  '. $keys.'');
        //$contents[] = array('text' => ' : '. $keys.'</div>');
      } else {
        $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=modules_menu&set=' . $set . '&module=' . $mInfo->code . '&action=install">'. __('Install', 'wosci-language').'</a>');

        if (isset($mInfo->signature) && (list($scode, $smodule, $sversion, $soscversion) = explode('|', $mInfo->signature))) {
          //$contents[] = array('text' => '<br>' . '' . '&nbsp;<b>' . TEXT_INFO_VERSION . '</b> ' . $sversion . ' (<a href="http://sig.oscommerce.com/' . $mInfo->signature . '" target="_blank">' . TEXT_INFO_ONLINE_STATUS . '</a>)');
        }
 
        $contents[] = array('text' => '<br>' . $mInfo->description);
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="33%" valign="top">' . "\n";

    $box = new box;
    
   
    
    
    echo $box->infoBox($heading, $contents, $buttons);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //--> 
  </tr>
</table>
        <?php
        /*
        <div id="icon-users" class="icon32"><br/></div>
        <h2>List Table Test</h2>
        
        <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
            <p>This page demonstrates the use of the <tt><a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank" style="text-decoration:none;">WP_List_Table</a></tt> class in plugins.</p> 
            <p>For a detailed explanation of using the <tt><a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank" style="text-decoration:none;">WP_List_Table</a></tt>
            class in your own plugins, you can view this file <a href="/wp-admin/plugin-editor.php?plugin=table-test/table-test.php" style="text-decoration:none;">in the Plugin Editor</a> or simply open <tt style="color:gray;"><?php echo __FILE__ ?></tt> in the PHP editor of your choice.</p>
            <p>Additional class details are available on the <a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank" style="text-decoration:none;">WordPress Codex</a>.</p>
        </div>
        
        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>
        
    </div>
    */
    ?>
    <?php


}

add_action('wp','wosci_admin_pages');
function wosci_admin_pages(){
 if ( is_page('cart') ) {
  // do you thing.
	include(DIR_WS_CLASSES . 'payment.php');
	global $payment_modules;
	$payment_modules = new payment;
	//include(DIR_WS_CLASSES . 'passwordhash.php');
  
 }
 
  if ( is_page('shipping-payment') ) {
  // do you thing.
	require(DIR_WS_CLASSES .'http_client.php');
	require(DIR_WS_CLASSES . 'order.php');
	require(DIR_WS_CLASSES . 'shipping.php');
	require(DIR_WS_CLASSES . 'payment.php');
 }
   if ( is_page('order-confirmation') ) {
  // do you thing.
	require(DIR_WS_CLASSES . 'shipping.php');
	require(DIR_WS_CLASSES . 'payment.php');
	require(DIR_WS_CLASSES . 'order.php');
	require(DIR_WS_CLASSES . 'order_total.php');
	require(DIR_WS_LANGUAGES . 'english' . '/' . FILENAME_CHECKOUT_CONFIRMATION);
 }
 
    if ( is_page('edit-shipping-address') ) {
  // do you thing.
  require(DIR_WS_LANGUAGES . 'english' . '/' . FILENAME_ADDRESS_BOOK_PROCESS);
 }

  if ( is_page('new-shipping-address') ) {
	require(DIR_WS_LANGUAGES . 'english' . '/' . FILENAME_CHECKOUT_SHIPPING_ADDRESS);
	require(DIR_WS_CLASSES . 'order.php');
  }


  if ( is_page('new-payment-address') ) {
	require(DIR_WS_LANGUAGES . 'english' . '/' . FILENAME_CHECKOUT_PAYMENT_ADDRESS);
	require(DIR_WS_CLASSES . 'order.php');
 }


 if ( is_page('checkout-process') ) {

	include(DIR_WS_LANGUAGES . 'english' . '/' . FILENAME_CHECKOUT_PROCESS);
	require(DIR_WS_CLASSES . 'shipping.php');
	require(DIR_WS_CLASSES . 'payment.php');
	require(DIR_WS_CLASSES . 'order.php');  
	require(DIR_WS_CLASSES . 'order_total.php');
 }

 if ( is_page('ccpay') ) {

	require(DIR_WS_CLASSES . 'order.php');
  
 }


 if ( is_page('account-history-info') ) {

	require(DIR_WS_CLASSES . 'order.php');
  
 }

 if ( is_page('pdf-invoice') ) {

	require(DIR_WS_CLASSES . 'order.php');
  
 }
}




add_action("wp_ajax_nopriv_the_cart_add", "the_cart_add");
add_action("wp_ajax_the_cart_add", "the_cart_add");
add_action("wp_ajax_nopriv_my_user_vote", "my_must_login");

function the_cart_add() {
	
	global  $cart, $currencies;

	//$id = array('id' => array(3 => 9, 4 => 4));
	$id = $_REQUEST["id"];
	$cart->add_cart($_REQUEST["post_id"], $cart->get_quantity(tep_get_uprid($_REQUEST["post_id"], $id))+$_REQUEST["qty"], $id);

	if ( !wp_verify_nonce( $_REQUEST['nonce'], "add_to_cart_nonce")) {
		exit("No naughty business please");
	}

//$products_id_string = tep_get_uprid($_REQUEST["post_id"], $id);
   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$result['type'] = "success";
      
      
      
	$products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
// Push all attributes information in an array
      
     $result['cart_text'] .= '<li>'.$products[$i]['quantity'] . ' ' . __('qty.') . ' <a href="'.get_permalink( $products[$i]['id'] ).'">' . $products[$i]['name'] . '</a> — ' . $currencies->display_price($products[$i]['currency'], $products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) .'</li>';
      }
      
    $result['cart_count'] = $cart->count_contents();
    $result['cart_text'] .= '<li style="list-style:none;float:right;">' . __('Cart Total:') . '<b> ' . $currencies->format($cart->show_total()) .'</b></li>';




	$products = $cart->get_products();
	for ($i=0, $n=sizeof($products); $i<$n; $i++) 
	{
	
	$products[$i]['name'] = substr($products[$i]['name'], 0, 32 );
	$result['cpo'] .= '<small>'.$products[$i]['quantity'] . ' ' . __('x') . ' <a href="'.get_permalink( $products[$i]['id'] ).'">' . $products[$i]['name'] . '</a> — ' . $currencies->display_price($products[$i]['currency'], $products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) .'</small><br>';
	
	}
	$result['cpo'] .='<br><div class="btn-group"><a href="'. esc_url( home_url( '/' ) ).'cart" class="btn btn-primary btn-xs">' . __('Edit Cart','wosci-language') . '</a><a  href="'. esc_url( home_url( '/' ) ).'shipping-payment" class="btn btn-success btn-xs" style="float:right;">' . __('Checkout', 'wosci-language') . '</a></div>';


      
      
      $result = json_encode($result);
      echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}

function my_must_login() {
   echo "You must log in to vote";
   die();
}


add_action( 'init', 'my_script_enqueuer' );

function my_script_enqueuer() {
   wp_register_script( "cart_ajax", WP_PLUGIN_URL.'/'.basename( dirname( __FILE__ ) ).'/cart-ajax.js', array('jquery') );
   wp_localize_script( 'cart_ajax', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
   

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'cart_ajax' );
   wp_enqueue_script( 'tax_zone' );
}




add_action("wp_ajax_nopriv_shopping_cart", "shopping_cart");
add_action("wp_ajax_shopping_cart", "shopping_cart");

function shopping_cart(){
global $cart, $currencies;

                              if(isset($_POST['products_id'])) { $cart->remove($_POST['products_id']); }
                              
	$products = $cart->get_products();
	for ($i=0, $n=sizeof($products); $i<$n; $i++) 
	{
	
	$products[$i]['name'] = substr($products[$i]['name'], 0, 30 );
	$popovercart .= '<small>'.$products[$i]['quantity'] . ' ' . __('x') . ' <a href=\"'.get_permalink( $products[$i]['id'] ).'\">' . $products[$i]['name'] . '</a> — ' . $currencies->display_price($products[$i]['currency'], tep_add_tax( $products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id'])) * $products[$i]['quantity'], '') .'</small><br>';
	
	}
	$popovercart .='<br><div class=\"btn-group\"><a href=\"'. esc_url( home_url( '/' ) ).'cart\" class=\"btn btn-primary btn-xs\">' . __('Edit Cart','wosci-language') . '</a><a  href=\"'. esc_url( home_url( '/' ) ).'shipping-payment\" class=\"btn btn-success btn-xs\" style=\"float:right;\">' . __('Checkout','wosci-language') . '</a></div>';

if( $cart->count_contents() == 0 ){ $popovercart = __('Your shopping cart is empty.', 'wosci-language'); }

echo   '{ "type": "success",
	  "durum": "Silindi",
	  "cpo": "'. $popovercart .'" ,
	  "sepetadet": "'. $cart->count_contents() .'" ,
	  "sub_totaljs": "'. $currencies->format($cart->show_total()) .'" ,
	  "product_totaljs": "'.$pt.'" 
	}';

   die();
}



add_action("wp_ajax_nopriv_cart_qty", "cart_qty");
add_action("wp_ajax_cart_qty", "cart_qty");


function cart_qty(){
global $cart, $currencies;

 for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {  /* one product qty change ajax each request */  }

                                 if (in_array($_POST['products_id'], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
                                  $cart->remove($_POST['products_id']);
                                } else {
				
				$parpos = strpos($_POST['f_id'], '{', 0);
				$clean_pid = substr($_POST['f_id'], $parpos); 
			
				$okv = str_replace('}',"|", $clean_pid); $okv = str_replace('{', '|', $okv); $okva = explode('|', $okv);
				     
				for($o2=0;$o2 < count($okva);$o2++){
				if(empty($okva[$o2])){ unset($okva[$o2]); }
				}
				     
				$okva = array_values($okva); $idar = ''; 
				for($o=0; $o < count($okva); $o++){
				if( ($o+1) %2 == 0 ) { $idarray['id'][$okva[$o-1]] = $okva[$o]; }   
				
				}
    				//$idarray['id'] =array(3=>9,5=>10);
				$attributes = ($_POST['id'][$_POST['products_id']]) ? $_POST['id'][$_POST['products_id']] : '';
				$cart->add_cart($_POST['products_id'], $_POST['cart_quantity'], $idarray['id'], false);
    
                                }
                          


	$pt = $currencies->display_price($_POST['currency'], $_POST['final_price'], tep_get_tax_rate($_POST['tax_class_id']), $_POST['cart_quantity'][0]);

       	$products = $cart->get_products();
	for ($i=0, $n=sizeof($products); $i<$n; $i++) 
	{
	
	$products[$i]['name'] = substr($products[$i]['name'], 0, 32 );
	$popovercart .= '<small>'.$products[$i]['quantity'].$products[$i]['quantity'] . ' ' . __('x') . ' <a href=\"'.get_permalink( $products[$i]['id'] ).'\">' . $products[$i]['name'] . '</a> — ' . $currencies->display_price($products[$i]['currency'], $products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) .'</small><br>';
	
	}
	$popovercart .='<br><div class=\"btn-group\"><a href=\"'. esc_url( home_url( '/' ) ).'cart\" class=\"btn btn-primary btn-xs\">' . __('Edit Cart','wosci-language') . '</a><a  href=\"'. esc_url( home_url( '/' ) ).'shipping-payment\" class=\"btn btn-success btn-xs\" style=\"float:right;\">' . __('Checkout','wosci-language') . '</a></div>';


echo   '{ "type": "success",
	  "durum": "Silindi",
	  "sepetadet": "' . $cart->count_contents() . '" ,
	
	  "cpo": "' . $popovercart . '" ,	  
	  "sub_totaljs": "' . $currencies->format($cart->show_total()) . '" ,
	  "product_totaljs": "' . $pt . '" 
	}';

   die();
}

add_action("wp_ajax_nopriv_state_list", "state_list");
add_action("wp_ajax_state_list", "state_list");


function state_list() {
global $cart, $currencies;

$country = $_POST['country'];

$zones_array = array();    
$zones_query = tep_db_query("select zone_name, zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_code");


while ($zones_values = tep_db_fetch_array($zones_query)) {
  $zones_array[] = array('id' => $zones_values['zone_code'], 'text' => $zones_values['zone_name']);
}
//header('Content-type: text/html; charset='.CHARSET);

if ( tep_db_num_rows($zones_query) ) {
$data = tep_draw_pull_down_menu('state', $zones_array, $_POST['city_code'],'class="form-control"'). '&nbsp;' . '<span class="inputRequirement"></span>';
} else {
$data = tep_draw_input_field('state','','class="form-control" style=""') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement"></span>': ''); 
}
echo $data;
//echo   '{ "type": "success","data": "'.json_encode($data).'"}';
  die();
}



add_action("wp_ajax_nopriv_ca_nsa", "ca_nsa");
add_action("wp_ajax_ca_nsa", "ca_nsa");


function ca_nsa() {
global $current_user, $order, $cart, $sendto, $billto;




// if the customer is not logged on, redirect them to the login page
  if ($current_user->ID =='0') {
   // $navigation->set_snapshot();
//    wp_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
//    wp_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

  // needs to be included earlier to set the success message in the messageStack

//  require(DIR_WS_CLASSES . 'order.php');
//  $order = new order;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
  if ($order->content_type == 'virtual') {
    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
    $shipping = false;
    if (!tep_session_is_registered('sendto')) tep_session_register('sendto');
    $sendto = false;
//    wp_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  $error = false;
  $process = false;
  if (isset($_POST['formdata'][9][value]) && ($_POST['formdata'][9][value] == 'submit')) {
// process a new shipping address
    if (tep_not_null($_POST['formdata'][0][value]) && tep_not_null($_POST['formdata'][1][value]) && tep_not_null($_POST['formdata'][3][value])) {
      $process = true;

//      if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($_POST['gender']);
      if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['formdata'][2][value]);
      $firstname = tep_db_prepare_input($_POST['formdata'][0][value]);
      $lastname = tep_db_prepare_input($_POST['formdata'][1][value]);
      $street_address = tep_db_prepare_input($_POST['formdata'][3][value]);
      if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['formdata'][4][value]);
      $postcode = tep_db_prepare_input($_POST['formdata'][5][value]);
      $city = tep_db_prepare_input($_POST['formdata'][6][value]);
      $country = tep_db_prepare_input($_POST['formdata'][8][value]);
      if (ACCOUNT_STATE == 'true') {
        if (isset($_POST['zone_id'])) {
          $zone_id = tep_db_prepare_input($_POST['zone_id']);
        } else {
          $zone_id = false;
        }
        $state = tep_db_prepare_input($_POST['formdata'][7][value]);
      }

      if (ACCOUNT_GENDER == 'true') {
        if ( ($gender != 'm') && ($gender != 'f') ) {
//          $error = true; $error2 = 'true2gender';

          //$messageStack->add('checkout_address', ENTRY_GENDER_ERROR);
        }
      }

      if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $error = true;
        $errorfields .= 'firstname ';

        //$messageStack->add('checkout_address', ENTRY_FIRST_NAME_ERROR);
      }

      if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $error = true;
        $errorfields .= 'lastname ';

        //$messageStack->add('checkout_address', ENTRY_LAST_NAME_ERROR);
      }

      if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;
        $errorfields .= 'street_address ';

        //$messageStack->add('checkout_address', ENTRY_STREET_ADDRESS_ERROR);
      }

      if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;
        $errorfields .= 'postcode ';

        //$messageStack->add('checkout_address', ENTRY_POST_CODE_ERROR);
      }

      if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;
        $errorfields .= 'city ';

        //$messageStack->add('checkout_address', ENTRY_CITY_ERROR);
      }

      if (ACCOUNT_STATE == 'true') {
        $zone_id = 0;
        $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
        $check = tep_db_fetch_array($check_query);
        $entry_state_has_zones = ($check['total'] > 0);
        if ($entry_state_has_zones == true) {
          $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
          if (tep_db_num_rows($zone_query) == 1) {
            $zone = tep_db_fetch_array($zone_query);
            $zone_id = $zone['zone_id'];
          } else {
            $error = true;
            $errorfields .= 'state ';

            //$messageStack->add('checkout_address', ENTRY_STATE_ERROR_SELECT);
          }
        } else {
          if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
            $error = true;
            $errorfields .= 'state ';

            //$messageStack->add('checkout_address', ENTRY_STATE_ERROR);
          }
        }
      }

      if ( (is_numeric($country) == false) || ($country < 1) ) {
        $error = true;
        $errorfields .= 'country ';

        //$messageStack->add('checkout_address', ENTRY_COUNTRY_ERROR);
      }

      if ($error == false) {
      
        $sql_data_array = array('customers_id' => $current_user->ID,
                                'entry_firstname' => $firstname,
                                'entry_lastname' => $lastname,
                                'entry_street_address' => $street_address,
                                'entry_postcode' => $postcode,
                                'entry_city' => $city,
                                'entry_country_id' => $country);

//        if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
        if (ACCOUNT_STATE == 'true') {
          if ($zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $zone_id;
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $state;
          }
        }

        if (!tep_session_is_registered('sendto')) tep_session_register('sendto');

        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

        $address_insert_id = tep_db_insert_id();

        if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');

      //  wp_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      }
// process the selected shipping destination
    } /*elseif (isset($_POST['address'])) {
      $reset_shipping = false;
      if (tep_session_is_registered('sendto')) {
        if ($sendto != $_POST['address']) {
          if (tep_session_is_registered('shipping')) {
            $reset_shipping = true;
          }
        }
      } else {
        tep_session_register('sendto');
      }

      $sendto = $_POST['address'];

      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$current_user->ID . "' and address_book_id = '" . (int)$sendto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] == '1') {
        if ($reset_shipping == true) tep_session_unregister('shipping');
       // wp_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      } else {
        tep_session_unregister('sendto');
      }
    } else {
      if (!tep_session_is_registered('sendto')) tep_session_register('sendto');
      $sendto = $customer_default_address_id;

      //wp_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
    */
  }

// if no shipping destination address was selected, use their own address as default

if( $_POST['s_or_p'] == 's' ){

update_user_meta($current_user->ID, 'sendto', $address_insert_id);

	if (!tep_session_is_registered('sendto')) {
	    tep_session_register('sendto');
	    $sendto =  $address_insert_id;
	} else {
	    $sendto =  $address_insert_id;
	}
$this_is = 'nsa';
}


if( $_POST['s_or_p'] == 'p' ){

update_user_meta($current_user->ID, 'billto', $address_insert_id);

	if (!tep_session_is_registered('billto')) {
	    tep_session_register('billto');
	    $billto = $address_insert_id;
	} else {
	    $billto = $address_insert_id;
	}
$this_is = 'npa';
}


	$addresses_count = tep_count_customer_address_book_entries();

if( $process !== true || $error === true ){
echo '{"message": "Error!", "errorfields": "' . $errorfields . '"}';
}else{
echo '{"message": "tamam", "this_is": "'.$this_is.'", "type": "success",  "address": "' . tep_address_label($current_user->ID, $address_insert_id, true, ' ', ' ') . '", "new": "' .  $address_insert_id . '"}';
}
  die();
}


add_action("wp_ajax_nopriv_ca_esa", "ca_esa");
add_action("wp_ajax_ca_esa", "ca_esa");


function ca_esa() {
global $current_user, $order, $cart, $sendto,  $billto;

  if ($current_user->ID =='0') {
//    $navigation->set_snapshot();
//    wp_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }



// error checking when updating or adding an entry
  $process = false;
  if (isset($_POST['formdata'][9][value]) && (($_POST['formdata'][9][value] == 'process') || ($_POST['formdata'][9][value] == 'update'))) {
    $process = true;
    $error = false;

//    if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($_POST['gender']);
    if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['formdata'][2][value]);
    $firstname = tep_db_prepare_input($_POST['formdata'][0][value]);
    $lastname = tep_db_prepare_input($_POST['formdata'][1][value]);
    $street_address = tep_db_prepare_input($_POST['formdata'][3][value]);
    if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['formdata'][4][value]);
    $postcode = tep_db_prepare_input($_POST['formdata'][5][value]);
    $city = tep_db_prepare_input($_POST['formdata'][6][value]);
    $country = tep_db_prepare_input($_POST['formdata'][8][value]);
    if (ACCOUNT_STATE == 'true') {
      if (isset($_POST['zone_id'])) {
        $zone_id = tep_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
      $state = tep_db_prepare_input($_POST['formdata'][7][value]);
    }
	$errorfields = '';
/*
    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        //$messageStack->add('addressbook', ENTRY_GENDER_ERROR);
 $errorfields .= 'gender ';
      }
    }
*/
    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      //$messageStack->add('addressbook', ENTRY_FIRST_NAME_ERROR);
 $errorfields .= 'firstname ';
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      //$messageStack->add('addressbook', ENTRY_LAST_NAME_ERROR);
 $errorfields .= 'lastname ';
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      //$messageStack->add('addressbook', ENTRY_STREET_ADDRESS_ERROR);
 $errorfields .= 'street_address ';
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      //$messageStack->add('addressbook', ENTRY_POST_CODE_ERROR);
 $errorfields .= 'postcode ';
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      //$messageStack->add('addressbook', ENTRY_CITY_ERROR);
 $errorfields .= 'city ';
    }

    if (!is_numeric($country)) {
      $error = true;

      //$messageStack->add('addressbook', ENTRY_COUNTRY_ERROR);
 $errorfields .= 'country ';
    }

    if (ACCOUNT_STATE == 'true') {

      $zone_id = 0;
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");

      $check = tep_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = tep_db_query("select distinct zone_id, zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
        if (tep_db_num_rows($zone_query) == 1) {
          $zone = tep_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];         
        } else {
          $error = true;

          //$messageStack->add('addressbook', ENTRY_STATE_ERROR_SELECT);
 $errorfields .= 'state ';
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          //$messageStack->add('addressbook', ENTRY_STATE_ERROR);
 $errorfields .= 'state ';
        }
      }
    }

    if ($error == false) {
      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => (int)$country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = (int)$zone_id;
          $sql_data_array['entry_state'] = $state;
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      if ($_POST['formdata'][9][value] == 'update') {
        $check_query = tep_db_query("select address_book_id from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_POST['formdata'][11][value] . "' and customers_id = '" . (int)$current_user->ID . "' limit 1");
        if (tep_db_num_rows($check_query) == 1) {
          tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "address_book_id = '" . (int)$_POST['formdata'][11][value] . "' and customers_id ='" . (int)$current_user->ID . "'");

// reregister session variables
          if ( (isset($_POST['formdata'][13][value]) && ($_POST['formdata'][13][value] == 'on')) || ($_POST['formdata'][11][value] == $customer_default_address_id) ) {
            $customer_first_name = $firstname;
            $customer_country_id = $country;
            $customer_zone_id = (($zone_id > 0) ? (int)$zone_id : '0');
            $customer_default_address_id = (int)$_POST['formdata'][11][value];

            $sql_data_array = array('customers_firstname' => $firstname,
                                    'customers_lastname' => $lastname,
                                    'customers_default_address_id' => (int)$_POST['formdata'][11][value]);

            if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;

            tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$current_user->ID . "'");
            update_user_meta( $current_user->ID, 'customer_default_address_id', $customer_default_address_id );

if( $_POST['s_or_p'] == 's' ){

update_user_meta($current_user->ID, 'sendto', $_POST['formdata'][11][value]);


	if (!tep_session_is_registered('sendto')) {
	    tep_session_register('sendto');
	    $sendto = $_POST['formdata'][11][value];
	} 
}

if( $_POST['s_or_p'] == 'p' ){

update_user_meta($current_user->ID, 'billto', $_POST['formdata'][11][value]);


	if (!tep_session_is_registered('billto')) {
	    tep_session_register('billto');
	    $billto = $_POST['formdata'][11][value];
	} 
}

          }

          //$messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
        }
      } else {
        if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
          $sql_data_array['customers_id'] = (int)$current_user->ID;
          tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

          $new_address_book_id = tep_db_insert_id();

// reregister session variables
          if (isset($_POST['formdata'][13][value]) && ($_POST['formdata'][13][value] == 'on')) {
            $customer_first_name = $firstname;
            $customer_country_id = $country;
            $customer_zone_id = (($zone_id > 0) ? (int)$zone_id : '0');
            if (isset($_POST['formdata'][13][value]) && ($_POST['formdata'][13][value] == 'on')) $customer_default_address_id = $new_address_book_id;

            $sql_data_array = array('customers_firstname' => $firstname,
                                    'customers_lastname' => $lastname);

            if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
            if (isset($_POST['formdata'][13][value]) && ($_POST['formdata'][13][value] == 'on')) $sql_data_array['customers_default_address_id'] = $new_address_book_id;
	
	tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$current_user->ID . "'");
	update_user_meta( $current_user->ID, 'customer_default_address_id', $customer_default_address_id );
        
          }
        }
      }

    }
  }



if(!isset($error) || $error == true)
{
	echo '{ "message": "Error!", "errorfields": "' . $errorfields . '"}';
}else{
	echo '{ "message": "tamam", "this_is": "esa", "address": "' . tep_address_label($current_user->ID, $_POST['formdata'][11][value], true, ' ', ' ') . '", "edit": "' . $_POST['formdata'][11][value] . '"}';
}


die();

}




add_action("wp_ajax_nopriv_set_address", "set_address");
add_action("wp_ajax_set_address", "set_address");

function set_address () {
global $current_user, $total_count, $total_weight, $shipping_weight,$sendto, $billto, $currencies, $order,$cart;
	
	$total_weight = $cart->show_weight();
	$shipping_weight = $shipping_weight;
	$total_count = $cart->count_contents();
if($_POST['register'] == 'shipping')
{
update_user_meta($current_user->ID, 'sendto', $_POST['adrID']);
if (!tep_session_is_registered('sendto')) {
	    tep_session_register('sendto');
	    $sendto = $_POST['adrID'];
	} else {
	    $sendto = $_POST['adrID'];
}


}

if($_POST['register'] == 'payment')
{
update_user_meta($current_user->ID, 'billto', $_POST['adrID']);
if (!tep_session_is_registered('billto')) {
	    tep_session_register('billto');
	    $billto = $_POST['adrID'];
	} else {
	    $billto = $_POST['adrID'];
}

}
$result['type'] = "success";
require(DIR_WS_CLASSES . 'order.php');
require(DIR_WS_CLASSES . 'shipping.php');

$shipping_modules = new shipping;
$order = new order;
$quotes = $shipping_modules->quote();






///////

  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
    $pass = false;

    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
      case 'national':
        if ($order->delivery['country_id'] == STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'international':
        if ($order->delivery['country_id'] != STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'both':
        $pass = true;
        break;
    }

    $free_shipping = false;
    if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
      $free_shipping = true;

     // include(DIR_WS_LANGUAGES . 'english' . '/modules/order_total/ot_shipping.php');
    }
  } else {
    $free_shipping = false;
  }


$result['shipping_modules'] = '<table width="100%">';

  if (tep_count_shipping_modules() > 0) {

     
$result['shipping_modules'] .= '<tr>
        <td><table  width="100%">
          <tr class="infoBoxContents">
            <td><table   class="shippingtable table table-hover table-responsive">';
            
            
            
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {

$result['shipping_modules'] .= '              <thead>
                    <td><h4>'. __('Shipping Methods', 'wosci-language').'</h4></td>
                    <td></td>
                    <td></td>
                  </thead>';

    } elseif ($free_shipping == false) {
$result['shipping_modules'] .='              <tr>
                <td>'. __('Shipping Methods', 'wosci-language').'</td>
              </tr>';

    }

    if ($free_shipping == true) {
$result['shipping_modules'] .='              <tr>
                <td colspan="4" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                   
                    <td class="main" colspan="3"><b>'. __('Free Shipping', 'wosci-language').'</b>&nbsp;'. $quotes[$i]['icon'].'<br><p>'. __('Free Shipping Orders Over', 'wosci-language'). ' '. $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) . tep_draw_hidden_field('shipping', 'free_free').'</p></td>
                    
                    
                  </tr>
                </table></td>
                
              </tr>';

    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
              for ($j2=0, $n2=sizeof($quotes[$i]['methods']); $j2<$n2; $j2++) { if($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j2]['id'] == $shipping['id']){ $result['shipping_modules'] .= '<tr style="background-color:#dff8df;" id="selectedshipment"> ';}else{  $result['shipping_modules'] .= '<tr > '; } }
             
              
               
              $result['shipping_modules'] .=  '<td class="shipping_row" colspan="3"><table  width="100%">';
                  
        if (isset($quotes[$i]['error'])) {

           $result['shipping_modules'] .= '<tr style="border:0px;">
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                    <td class="main" colspan="3">'. $quotes[$i]['error'].'</td>
                    <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                  </tr>';

        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              $result['shipping_modules'] .='                   <tr id="selected_shipping"  >';
            } else {
               $result['shipping_modules'] .= '                  <tr id="selected_shipping"  >';
            }

                 
               $result['shipping_modules'] .='     <td style=" border: none;"  width="100%"><h5>'. $quotes[$i]['module'].'</h5><small>'. $quotes[$i]['methods'][$j]['title'].'</small></td>';

            if ( ($n > 1) || ($n2 > 1) ) {

               $result['shipping_modules'] .= '<td style=" border: none;" >'. $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))).'</td>
                    <td style=" border: none;" >'. tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked ).'</td>';

            } else {

                    $result['shipping_modules'] .= '<td style=" border: none;"  colspan="3"><h5>'. $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']).'</h5></td>';

            }
            
                $result['shipping_modules'] .=   '</tr>';

            $radio_buttons++;
          }
        }

                $result['shipping_modules'] .='</table></td>
                
              </tr>';

      }
    }

          $result['shipping_modules'] .='  </table></td>
          </tr>
        </table></td>
      </tr>';
     

  }

  $result['shipping_modules'] .='</table>'; 
///////
$result['updated'] = __('Shipping methods and costs updated based on your selection', 'wosci-language');
$result['bacb'] = __('Billing Address Chanced', 'wosci-language');


//$result['shipping_modules'] = json_encode($result['shipping_modules']);
$result = json_encode($result);
echo $result;

die();
}



add_action("wp_ajax_nopriv_delete_address", "delete_address");
add_action("wp_ajax_delete_address", "delete_address");

function delete_address () {
global $current_user;

tep_db_query("delete from address_book where address_book_id = '" . (int)$_POST['adrID'] . "' and customers_id = '" . (int)$current_user->ID. "'");

echo '{"type":"success"}';
die();
}


if (!class_exists('PasswordHash') && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php', 'user-new.php', 'user-edit.php' ) )) {
include( 'includes1/classes/passwordhash.php');
}
if (!class_exists('cc') ) {
include( 'includes1/classes/cc_validation.php');
}


function shop_config()
	{

	add_menu_page('Shop Configuration', 'Shop Setting', 'activate_plugins', 'shop_configuration', 'display_config','div');
	add_submenu_page( 'shop_configuration', 'My Store', 'My Store', 'activate_plugins', 'admin.php?page=shop_configuration&gID=2&cID=19', '' );
	add_submenu_page( 'shop_configuration', 'Maximum Values', 'Maximum Values', 'activate_plugins', 'admin.php?page=shop_configuration&gID=3&cID=35', '' );
	add_submenu_page( 'shop_configuration', 'Shipping/Packaging', 'Shipping/Packaging', 'activate_plugins', 'admin.php?page=shop_configuration&gID=7&cID=99', '' );
	add_submenu_page( 'shop_configuration', 'Stock', 'Stock', 'activate_plugins', 'admin.php?page=shop_configuration&gID=9&cID=114', '' );
	add_submenu_page( 'shop_configuration', 'Download', 'Download', 'activate_plugins', 'admin.php?page=shop_configuration&gID=13&cID=114', '' );

	}

function display_config()
{

  $osc_action = (isset($_GET['osc_action']) ? $_GET['osc_action'] : '');

  if (tep_not_null($osc_action)) {
    switch ($osc_action) {
      case 'save':
        $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
        $cID = tep_db_prepare_input($_GET['cID']);

        tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($configuration_value) . "', last_modified = now() where configuration_id = '" . (int)$cID . "'");

        wp_redirect('admin.php?page=shop_configuration&gID=' . $_GET['gID'] . '&cID=' . $cID);
        break;
    }
  }

  $gID = (isset($_GET['gID'])) ? $_GET['gID'] : 1;

  $cfg_group_query = tep_db_query("select configuration_group_title from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = '" . (int)$gID . "'");
  $cfg_group = tep_db_fetch_array($cfg_group_query);

?>


<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php echo $cfg_group['configuration_group_title']; ?></h2></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table class="widefat fixed" cellspacing="0">
<thead><tr class="thead">
	
	
<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Configuration Title','wosci-language'); ?></th>
<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Connfiguration Value','wosci-language'); ?></th>
<th scope="col" id="posts" class="manage-column column-posts num" style=""><?php echo __('Action','wosci-language'); ?></th>

</tr></thead>


<tfoot><tr class="thead">
	
<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Configuration Title','wosci-language'); ?></th>
<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Connfiguration Value','wosci-language'); ?></th>
<th scope="col" id="posts" class="manage-column column-posts num" style=""><?php echo __('Action','wosci-language'); ?></th>

</tr></tfoot>

<?php
  $configuration_query = tep_db_query("select configuration_id, configuration_title, configuration_value, use_function from " . TABLE_CONFIGURATION . " where configuration_group_id = '" . (int)$gID . "' order by sort_order");
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    if (tep_not_null($configuration['use_function'])) {
      $use_function = $configuration['use_function'];
      if (ereg('->', $use_function)) {
        $class_method = explode('->', $use_function);
        if (!is_object(${$class_method[0]})) {
          include(DIR_WS_CLASSES . $class_method[0] . '.php');
          ${$class_method[0]} = new $class_method[0]();
        }
        $cfgValue = tep_call_function($class_method[1], $configuration['configuration_value'], ${$class_method[0]});
      } else {
        $cfgValue = tep_call_function($use_function, $configuration['configuration_value']);
      }
    } else {
      $cfgValue = $configuration['configuration_value'];
    }

    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $configuration['configuration_id']))) && !isset($cInfo) && (substr($osc_action, 0, 3) != 'new')) {
      $cfg_extra_query = tep_db_query("select configuration_key, configuration_description, date_added, last_modified, use_function, set_function from " . TABLE_CONFIGURATION . " where configuration_id = '" . (int)$configuration['configuration_id'] . "'");
      $cfg_extra = tep_db_fetch_array($cfg_extra_query);

      $cInfo_array = array_merge($configuration, $cfg_extra);
      $cInfo = new objectInfo($cInfo_array);
    }

    if ( (isset($cInfo) && is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) {
      echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=shop_configuration&gID=' . $gID . '&cID=' . $cInfo->configuration_id . '&osc_action=edit\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=shop_configuration&gID=' . $gID . '&cID=' . $configuration['configuration_id'] . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $configuration['configuration_title']; ?></td>
                <td class="dataTableContent"><?php echo htmlspecialchars($cfgValue); ?></td>
                <td class="dataTableContent" align="right"><?php if ( (isset($cInfo) && is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) { echo '▶'; } else { echo '<a href="admin.php?page=shop_configuration&gID=' . $gID . '&cID=' . $configuration['configuration_id'] . '">' . '' . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($osc_action) {
    case 'edit':
      $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

      if ($cInfo->set_function) {
        eval('$value_field = ' . $cInfo->set_function . '"' . htmlspecialchars($cInfo->configuration_value) . '");');
      } else {
        $value_field = tep_draw_input_field('configuration_value', $cInfo->configuration_value);
      }

      $contents = array('form' => tep_draw_form('configuration', 'admin.php?page=shop_configuration'.'&gID=' . $gID . '&cID=' . $cInfo->configuration_id . '&osc_action=save', 'post'));
      $contents[] = array('text' => __('Currency Details','wosci-language'));
      $contents[] = array('text' => '<br><b>' . $cInfo->configuration_title . '</b><br>' . $cInfo->configuration_description . '<br>' . $value_field);
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update').'" class="button" />&nbsp;<a class="button" href="admin.php?page=shop_configuration&gID=' . $gID . '&cID=' . $cInfo->configuration_id . '">'. __('Cancel', 'wosci-language').'</a>');
      break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=shop_configuration&gID=' . $gID . '&cID=' . $cInfo->configuration_id . '&osc_action=edit' . '">'. __('Edit', 'wosci-language').'</a>');
        $contents[] = array('text' => '<br>' . $cInfo->configuration_description);
        $contents[] = array('text' => '<br>' . __('Date Added', 'wosci-language') . ': ' . tep_date_short($cInfo->date_added));
        if (tep_not_null($cInfo->last_modified)) $contents[] = array('text' => __('Last Modified','wosci-language') . ': ' . tep_date_short($cInfo->last_modified));
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents,'');

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
}

add_action('admin_menu', 'shop_config');






function ordersmenu()
	{

	add_menu_page('Orders', 'Orders', 'activate_plugins', 'orders', 'orders','div');
	add_submenu_page('', '','', 'activate_plugins', 'invoice', 'invoice','');
	add_submenu_page('', '','', 'activate_plugins', 'packing_slip', 'packing_slip','');
//	add_submenu_page('', '','', 'activate_plugins', 'pdf_invoice', 'pdf_invoice','');
//	add_submenu_page( 'shop_configuration', 'My Store', 'My Store', 'activate_plugins', 'admin.php?page=shop_configuration&gID=2&cID=19', '' );

	}

function packing_slip()
{
//  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $oID = tep_db_prepare_input($_GET['oID']);
  $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");

  include(DIR_WS_CLASSES . 'order.php');
  $order = new order($oID);
?>






<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo nl2br(STORE_NAME_ADDRESS); ?></td>
        <td class="pageHeading" align="right"><img src="<?php echo get_bloginfo( 'template_directory' );?>/images/logo-pdf-invoice.jpg"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2"><?php echo tep_draw_separator(); ?></td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo __('Sold to','wosci-language'); ?>:</b></td>
          </tr>
          <tr>
            <td class="main"><?php echo tep_address_format($order->customer['format_id'], $order->billing, 1, '', '<br>'); ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo $order->customer['telephone']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo '<a href="mailto:' . $order->customer['email_address'] . '"><u>' . $order->customer['email_address'] . '</u></a>'; ?></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo __('Ship to','wosci-language'); ?>:</b></td>
          </tr>
          <tr>
            <td class="main"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><b><?php echo __('Payment Method','wosci-language'); ?>:</b></td>
        <td class="main"><?php echo $order->info['payment_method']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent" colspan="2"><?php echo __('Product','wosci-language'); ?></td>
        <td class="dataTableHeadingContent"><?php echo __('Model','wosci-language'); ?></td>
      </tr>
<?php
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      echo '      <tr class="dataTableRow">' . "\n" .
           '        <td class="dataTableContent" valign="top" align="">'. $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'].'</td>' . "\n" .
           '        <td class="dataTableContent" valign="top">';

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j=0, $k=sizeof($order->products[$i]['attributes']); $j<$k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          echo '</i></small></nobr>';
        }
      }

      echo '        </td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '      </tr>' . "\n";
    }
?>
    </table></td>
  </tr>
</table>

<?php
}


function invoice()
{

  $currencies = new currencies();

  $oID = tep_db_prepare_input($_GET['oID']);
  $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");

  include(DIR_WS_CLASSES . 'order.php');
  $order = new order($oID);
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo nl2br(STORE_NAME_ADDRESS); ?></td>
        <td class="pageHeading" align="right"><img src="<?php echo get_bloginfo( 'template_directory' );?>/images/logo-pdf-invoice.jpg"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2"><?php echo tep_draw_separator(); ?></td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo __('Sold to','wosci-language'); ?>:</b></td>
          </tr>
          <tr>
            <td class="main"><?php echo tep_address_format($order->customer['format_id'], $order->billing, 1, '', '<br>'); ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo $order->customer['telephone']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo '<a href="mailto:' . $order->customer['email_address'] . '"><u>' . $order->customer['email_address'] . '</u></a>'; ?></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo __('Ship to','wosci-language'); ?>:</b></td>
          </tr>
          <tr>
            <td class="main"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><b><?php echo __('Payment Method','wosci-language'); ?>:</b></td>
        <td class="main"><?php echo $order->info['payment_method']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent" colspan="2"><?php echo __('Product','wosci-language'); ?></td>
        <td class="dataTableHeadingContent"><?php echo __('Product Model','wosci-language'); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo __('Tax','wosci-language'); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo __('Tax Excl.','wosci-language'); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo __('Tax Incl.','wosci-language'); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo __('Total Tax Excl.','wosci-language'); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo __('Total Tax Incl.','wosci-language'); ?></td>
      </tr>
<?php
    for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
      echo '      <tr class="dataTableRow">' . "\n" .
           '        <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (($k = sizeof($order->products[$i]['attributes'])) > 0)) {
        for ($j = 0; $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          echo '</i></small></nobr>';
        }
      }

      echo '        </td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n";
      echo '        <td class="dataTableContent" align="right" valign="top">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
           '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax'], true), true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax'], true) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n";
      echo '      </tr>' . "\n";
    }
?>
      <tr>
        <td align="right" colspan="8"><table border="0" cellspacing="0" cellpadding="2">
<?php
  for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
    echo '          <tr>' . "\n" .
         '            <td align="right" class="smallText">' . $order->totals[$i]['title'] . '</td>' . "\n" .
         '            <td align="right" class="smallText">' . $order->totals[$i]['text'] . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
  
  
  
  
  
  
  
  

$tutar =  $order->totals[2]['text'];
  $tutar = str_replace("$","",$tutar);
$tam = intval($tutar);
$basamak = strlen($tutar);
for($b=0;$b<$basamak;$b++)
{
$rak[$b] = substr($tutar, $b, 1);  

}  
  
  
  
$mystring = $tutar;
$findme   = '.';
$pos = strpos($mystring, $findme);
  

  switch($pos){
  
  case 1: //$rak[0] birinci basamak ,$rak[1] nokta , $rak[2] noktadan sonra ilk ,$rak[3] noktadan sonra ikinci
if($rak[0]==1){$yaziya .= 'Bir';}
if($rak[0]==2){$yaziya .= '?ki';}
if($rak[0]==3){$yaziya .= 'Üç';}
if($rak[0]==4){$yaziya .= 'Dört';}
if($rak[0]==5){$yaziya .= 'Be?';}
if($rak[0]==6){$yaziya .= 'Alt?';}
if($rak[0]==7){$yaziya .= 'Yedi';}
if($rak[0]==8){$yaziya .= 'Sekiz';}
if($rak[0]==9){$yaziya .= 'Dokuz';}


if($rak[2] == 0 and $rak[3]==0){}else{
$yaziya .= 'Nokta';
if($rak[2]==1){$yaziya .= 'On';}
if($rak[2]==2){$yaziya .= 'Yirmi';}
if($rak[2]==3){$yaziya .= 'Otuz';}
if($rak[2]==4){$yaziya .= 'K?rk';}
if($rak[2]==5){$yaziya .= 'Elli';}
if($rak[2]==6){$yaziya .= 'Altm??';}
if($rak[2]==7){$yaziya .= 'Yetmi?';}
if($rak[2]==8){$yaziya .= 'Seksen';}
if($rak[2]==9){$yaziya .= 'Doksan';}


if($rak[3]==1){$yaziya .= 'Bir';}
if($rak[3]==2){$yaziya .= '?ki';}
if($rak[3]==3){$yaziya .= 'Üç';}
if($rak[3]==4){$yaziya .= 'Dört';}
if($rak[3]==5){$yaziya .= 'Be?';}
if($rak[3]==6){$yaziya .= 'Alt?';}
if($rak[3]==7){$yaziya .= 'Yedi';}
if($rak[3]==8){$yaziya .= 'Sekiz';}
if($rak[3]==9){$yaziya .= 'Dokuz';}
}

  break; 
  
  case 2: 

if($rak[0]==1){$yaziya .= 'On';}
if($rak[0]==2){$yaziya .= 'Yirmi';}
if($rak[0]==3){$yaziya .= 'Otuz';}
if($rak[0]==4){$yaziya .= 'K?rk';}
if($rak[0]==5){$yaziya .= 'Elli';}
if($rak[0]==6){$yaziya .= 'Altm??';}
if($rak[0]==7){$yaziya .= 'Yetmi?';}
if($rak[0]==8){$yaziya .= 'Seksen';}
if($rak[0]==9){$yaziya .= 'Doksan';}

if($rak[1]==1){$yaziya .= 'Bir';}
if($rak[1]==2){$yaziya .= '?ki';}
if($rak[1]==3){$yaziya .= 'Üç';}
if($rak[1]==4){$yaziya .= 'Dört';}
if($rak[1]==5){$yaziya .= 'Be?';}
if($rak[1]==6){$yaziya .= 'Alt?';}
if($rak[1]==7){$yaziya .= 'Yedi';}
if($rak[1]==8){$yaziya .= 'Sekiz';}
if($rak[1]==9){$yaziya .= 'Dokuz';}


if($rak[3] == 0 and $rak[4]==0){}else{
$yaziya .= 'Nokta';
if($rak[3]==1){$yaziya .= 'On';}
if($rak[3]==2){$yaziya .= 'Yirmi';}
if($rak[3]==3){$yaziya .= 'Otuz';}
if($rak[3]==4){$yaziya .= 'K?rk';}
if($rak[3]==5){$yaziya .= 'Elli';}
if($rak[3]==6){$yaziya .= 'Altm??';}
if($rak[3]==7){$yaziya .= 'Yetmi?';}
if($rak[3]==8){$yaziya .= 'Seksen';}
if($rak[3]==9){$yaziya .= 'Doksan';}


if($rak[4]==1){$yaziya .= 'Bir';}
if($rak[4]==2){$yaziya .= '?ki';}
if($rak[4]==3){$yaziya .= 'Üç';}
if($rak[4]==4){$yaziya .= 'Dört';}
if($rak[4]==5){$yaziya .= 'Be?';}
if($rak[4]==6){$yaziya .= 'Alt?';}
if($rak[4]==7){$yaziya .= 'Yedi';}
if($rak[4]==8){$yaziya .= 'Sekiz';}
if($rak[4]==9){$yaziya .= 'Dokuz';}
}

  break; 
  
  case 3: 
if($rak[0]==1){$yaziya .= 'Yüz';}
if($rak[0]==2){$yaziya .= '?kiyüz';}
if($rak[0]==3){$yaziya .= 'Üçyüz';}
if($rak[0]==4){$yaziya .= 'Dörtyüz';}
if($rak[0]==5){$yaziya .= 'Be?yüz';}
if($rak[0]==6){$yaziya .= 'Alt?yüz';}
if($rak[0]==7){$yaziya .= 'Yediyüz';}
if($rak[0]==8){$yaziya .= 'Sekizyüz';}
if($rak[0]==9){$yaziya .= 'Dokuzyüz';}

if($rak[1]==1){$yaziya .= 'On';}
if($rak[1]==2){$yaziya .= 'Yirmi';}
if($rak[1]==3){$yaziya .= 'Otuz';}
if($rak[1]==4){$yaziya .= 'K?rk';}
if($rak[1]==5){$yaziya .= 'Elli';}
if($rak[1]==6){$yaziya .= 'Altm??';}
if($rak[1]==7){$yaziya .= 'Yetmi?';}
if($rak[1]==8){$yaziya .= 'Seksen';}
if($rak[1]==9){$yaziya .= 'Doksan';}

if($rak[2]==1){$yaziya .= 'Bir';}
if($rak[2]==2){$yaziya .= '?ki';}
if($rak[2]==3){$yaziya .= 'Üç';}
if($rak[2]==4){$yaziya .= 'Dört';}
if($rak[2]==5){$yaziya .= 'Be?';}
if($rak[2]==6){$yaziya .= 'Alt?';}
if($rak[2]==7){$yaziya .= 'Yedi';}
if($rak[2]==8){$yaziya .= 'Sekiz';}
if($rak[2]==9){$yaziya .= 'Dokuz';}


if($rak[4] == 0 and $rak[5]==0){}else{
$yaziya .= 'Nokta';
if($rak[4]==1){$yaziya .= 'On';}
if($rak[4]==2){$yaziya .= 'Yirmi';}
if($rak[4]==3){$yaziya .= 'Otuz';}
if($rak[4]==4){$yaziya .= 'K?rk';}
if($rak[4]==5){$yaziya .= 'Elli';}
if($rak[4]==6){$yaziya .= 'Altm??';}
if($rak[4]==7){$yaziya .= 'Yetmi?';}
if($rak[4]==8){$yaziya .= 'Seksen';}
if($rak[4]==9){$yaziya .= 'Doksan';}


if($rak[5]==1){$yaziya .= 'Bir';}
if($rak[5]==2){$yaziya .= '?ki';}
if($rak[5]==3){$yaziya .= 'Üç';}
if($rak[5]==4){$yaziya .= 'Dört';}
if($rak[5]==5){$yaziya .= 'Be?';}
if($rak[5]==6){$yaziya .= 'Alt?';}
if($rak[5]==7){$yaziya .= 'Yedi';}
if($rak[5]==8){$yaziya .= 'Sekiz';}
if($rak[5]==9){$yaziya .= 'Dokuz';}
}

  break; 
  
  case 4: 

if($rak[0]==1){$yaziya .=  'Bin';}
if($rak[0]==2){$yaziya .= '?kibin';}
if($rak[0]==3){$yaziya .= 'Üçbin';}
if($rak[0]==4){$yaziya .= 'Dörtbin';}
if($rak[0]==5){$yaziya .= 'Be?bin';}
if($rak[0]==6){$yaziya .= 'Alt?bin';}
if($rak[0]==7){$yaziya .= 'Yedibin';}
if($rak[0]==8){$yaziya .= 'Sekizbin';}
if($rak[0]==9){$yaziya .= 'Dokuzbin';}

if($rak[1]==1){$yaziya .= 'Yüz';}
if($rak[1]==2){$yaziya .= '?kiyüz';}
if($rak[1]==3){$yaziya .= 'Üçyüz';}
if($rak[1]==4){$yaziya .= 'Dörtyüz';}
if($rak[1]==5){$yaziya .= 'Be?yüz';}
if($rak[1]==6){$yaziya .= 'Alt?yüz';}
if($rak[1]==7){$yaziya .= 'Yediyüz';}
if($rak[1]==8){$yaziya .= 'Sekizyüz';}
if($rak[1]==9){$yaziya .= 'Dokuzyüz';}

if($rak[2]==1){$yaziya .= 'On';}
if($rak[2]==2){$yaziya .= 'Yirmi';}
if($rak[2]==3){$yaziya .= 'Otuz';}
if($rak[2]==4){$yaziya .= 'K?rk';}
if($rak[2]==5){$yaziya .= 'Elli';}
if($rak[2]==6){$yaziya .= 'Altm??';}
if($rak[2]==7){$yaziya .= 'Yetmi?';}
if($rak[2]==8){$yaziya .= 'Seksen';}
if($rak[2]==9){$yaziya .= 'Doksan';}

if($rak[3]==1){$yaziya .= 'Bir';}
if($rak[3]==2){$yaziya .= '?ki';}
if($rak[3]==3){$yaziya .= 'Üç';}
if($rak[3]==4){$yaziya .= 'Dört';}
if($rak[3]==5){$yaziya .= 'Be?';}
if($rak[3]==6){$yaziya .= 'Alt?';}
if($rak[3]==7){$yaziya .= 'Yedi';}
if($rak[3]==8){$yaziya .= 'Sekiz';}
if($rak[3]==9){$yaziya .= 'Dokuz';}


if($rak[5] == 0 and $rak[6]==0){}else{
$yaziya .= 'Nokta';
if($rak[5]==1){$yaziya .= 'On';}
if($rak[5]==2){$yaziya .= 'Yirmi';}
if($rak[5]==3){$yaziya .= 'Otuz';}
if($rak[5]==4){$yaziya .= 'K?rk';}
if($rak[5]==5){$yaziya .= 'Elli';}
if($rak[5]==6){$yaziya .= 'Altm??';}
if($rak[5]==7){$yaziya .= 'Yetmi?';}
if($rak[5]==8){$yaziya .= 'Seksen';}
if($rak[5]==9){$yaziya .= 'Doksan';}


if($rak[6]==1){$yaziya .= 'Bir';}
if($rak[6]==2){$yaziya .= '?ki';}
if($rak[6]==3){$yaziya .= 'Üç';}
if($rak[6]==4){$yaziya .= 'Dört';}
if($rak[6]==5){$yaziya .= 'Be?';}
if($rak[6]==6){$yaziya .= 'Alt?';}
if($rak[6]==7){$yaziya .= 'Yedi';}
if($rak[6]==8){$yaziya .= 'Sekiz';}
if($rak[6]==9){$yaziya .= 'Dokuz';}
}

  break; 
  
  case 5: 
if($rak[0]==1){$yaziya .= 'On';}
if($rak[0]==2){$yaziya .= 'Yirmi';}
if($rak[0]==3){$yaziya .= 'Otuz';}
if($rak[0]==4){$yaziya .= 'K?rk';}
if($rak[0]==5){$yaziya .= 'Elli';}
if($rak[0]==6){$yaziya .= 'Altm??';}
if($rak[0]==7){$yaziya .= 'Yetmi?';}
if($rak[0]==8){$yaziya .= 'Seksen';}
if($rak[0]==9){$yaziya .= 'Doksan';}

if($rak[1]===0){$yaziya .= 'Bin';}
if($rak[1]==1){$yaziya .= 'Birbin';}
if($rak[1]==2){$yaziya .= '?kibin';}
if($rak[1]==3){$yaziya .= 'Üçbin';}
if($rak[1]==4){$yaziya .= 'Dörtbin';}
if($rak[1]==5){$yaziya .= 'Be?bin';}
if($rak[1]==6){$yaziya .= 'Alt?bin';}
if($rak[1]==7){$yaziya .= 'Yedibin';}
if($rak[1]==8){$yaziya .= 'Sekizbin';}
if($rak[1]==9){$yaziya .= 'Dokuzbin';}

if($rak[2]==1){$yaziya .= 'Yüz';}
if($rak[2]==2){$yaziya .= '?kiyüz';}
if($rak[2]==3){$yaziya .= 'Üçyüz';}
if($rak[2]==4){$yaziya .= 'Dörtyüz';}
if($rak[2]==5){$yaziya .= 'Be?yüz';}
if($rak[2]==6){$yaziya .= 'Alt?yüz';}
if($rak[2]==7){$yaziya .= 'Yediyüz';}
if($rak[2]==8){$yaziya .= 'Sekizyüz';}
if($rak[2]==9){$yaziya .= 'Dokuzyüz';}

if($rak[3]==1){$yaziya .= 'On';}
if($rak[3]==2){$yaziya .= 'Yirmi';}
if($rak[3]==3){$yaziya .= 'Otuz';}
if($rak[3]==4){$yaziya .= 'K?rk';}
if($rak[3]==5){$yaziya .= 'Elli';}
if($rak[3]==6){$yaziya .= 'Altm??';}
if($rak[3]==7){$yaziya .= 'Yetmi?';}
if($rak[3]==8){$yaziya .= 'Seksen';}
if($rak[3]==9){$yaziya .= 'Doksan';}

if($rak[4]==1){$yaziya .= 'Bir';}
if($rak[4]==2){$yaziya .= '?ki';}
if($rak[4]==3){$yaziya .= 'Üç';}
if($rak[4]==4){$yaziya .= 'Dört';}
if($rak[4]==5){$yaziya .= 'Be?';}
if($rak[4]==6){$yaziya .= 'Alt?';}
if($rak[4]==7){$yaziya .= 'Yedi';}
if($rak[4]==8){$yaziya .= 'Sekiz';}
if($rak[4]==9){$yaziya .= 'Dokuz';}


if($rak[6] == 0 and $rak[7] == 0){}else{
$yaziya .= 'Nokta';
if($rak[6]==1){$yaziya .= 'On';}
if($rak[6]==2){$yaziya .= 'Yirmi';}
if($rak[6]==3){$yaziya .= 'Otuz';}
if($rak[6]==4){$yaziya .= 'K?rk';}
if($rak[6]==5){$yaziya .= 'Elli';}
if($rak[6]==6){$yaziya .= 'Altm??';}
if($rak[6]==7){$yaziya .= 'Yetmi?';}
if($rak[6]==8){$yaziya .= 'Seksen';}
if($rak[6]==9){$yaziya .= 'Doksan';}


if($rak[7]==1){$yaziya .= 'Bir';}
if($rak[7]==2){$yaziya .= '?ki';}
if($rak[7]==3){$yaziya .= 'Üç';}
if($rak[7]==4){$yaziya .= 'Dört';}
if($rak[7]==5){$yaziya .= 'Be?';}
if($rak[7]==6){$yaziya .= 'Alt?';}
if($rak[7]==7){$yaziya .= 'Yedi';}
if($rak[7]==8){$yaziya .= 'Sekiz';}
if($rak[7]==9){$yaziya .= 'Dokuz';}
}

  break; 
  
  case 6: 
  echo '6 Haneli rakam yaz? için tan?mlanmad?';
  break; 
  }
  

// echo '<b>'.$yaziya.'</b>';
?>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

<?php
}


function orders()
{


$languages_id = 1;
//  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                               'text' => $orders_status['orders_status_name']);
    $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'update_order':
        $oID = tep_db_prepare_input($_GET['oID']);
        $status = tep_db_prepare_input($_POST['status']);
        $comments = tep_db_prepare_input($_POST['comments']);

        $order_updated = false;
        $check_status_query = tep_db_query("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
        $check_status = tep_db_fetch_array($check_status_query);

        if ( ($check_status['orders_status'] != $status) || tep_not_null($comments)) {
          tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . tep_db_input($status) . "', last_modified = now() where orders_id = '" . (int)$oID . "'");

          $customer_notified = '0';
          if (isset($_POST['notify']) && ($_POST['notify'] == 'on')) {
            $notify_comments = '';
            if (isset($_POST['notify_comments']) && ($_POST['notify_comments'] == 'on')) {
              $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $comments) . "\n\n";
            }

            $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . esc_url( home_url( '/' ) ) .'account-history-info?order_id=' . $oID  . "\n" . __('Printable Invoice URL', 'wosci-language') . ' ' . esc_url( home_url( '/' ) ) .'pdf-invoice?order_id=' . $oID  . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($check_status['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $orders_status_array[$status]);

            tep_mail($check_status['customers_name'], $check_status['customers_email_address'], EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

            $customer_notified = '1';
          }

          tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . (int)$oID . "', '" . tep_db_input($status) . "', now(), '" . tep_db_input($customer_notified) . "', '" . tep_db_input($comments)  . "')");

          $order_updated = true;
        }

        if ($order_updated == true) {
        // $messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
        } else {
        //  $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
        }

        wp_redirect('admin.php?'. tep_get_all_get_params(array('action')) . 'action=edit');
        break;
      case 'deleteconfirm':
        $oID = tep_db_prepare_input($_GET['oID']);

        tep_remove_order($oID, $_POST['restock']);

        wp_redirect('admin.php?page=orders&'. tep_get_all_get_params(array('oID', 'action')));
        break;
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $oID = tep_db_prepare_input($_GET['oID']);

    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!tep_db_num_rows($orders_query)) {
      $order_exists = false;
//      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
  }

  include(DIR_WS_CLASSES . 'order.php');

?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (($action == 'edit') && ($order_exists == true)) {
    $order = new order($oID);
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php _e('Orders','wosci-language'); ?></h2></td>
            <td class="wrap" align="right"><h2><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></h2></td>
            <td class="pageHeading" align="right"><?php echo '<a class="button" href="' . esc_url( home_url( '/' )) .'pdf-invoice/?order_id='.$_GET['oID'] . '" TARGET="_blank">' . __('Printable Invoice', 'wosci-language') . '</a> <a class="button" href="admin.php?page=invoice&oID=' . $_GET['oID'] . '" TARGET="_blank">' . __('Invoice','wosci-language') . '</a> <a class="button" href="admin.php?page=packing_slip&oID=' . $_GET['oID'] . '" TARGET="_blank">' . __('Packing Slip','wosci-language') . '</a> <a class="button" href="admin.php?'. tep_get_all_get_params(array('action')) . '">' . __('Back','wosci-language') . '</a> '; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3"  style="padding-bottom:12px;" ><?php echo tep_draw_separator(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo __('Customer','wosci-language'); ?>:</b></td>
                <td class="main"><?php echo tep_address_format($order->customer['format_id'], $order->customer, 1, '', '<br>'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo __('Phone Number','wosci-language'); ?>:</b></td>
                <td class="main"><?php echo $order->customer['telephone']; ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo __('Email Address','wosci-language'); ?>:</b></td>
                <td class="main"><?php echo '<a href="mailto:' . $order->customer['email_address'] . '"><u>' . $order->customer['email_address'] . '</u></a>'; ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo __('Shipping Address','wosci-language'); ?>:</b></td>
                <td class="main"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'); ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo __('Billing Address','wosci-language'); ?>:</b></td>
                <td class="main"><?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, '', '<br>'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo __('Payment Method','wosci-language'); ?>:</b></td>
            <td class="main"><?php echo $order->info['payment_method']; ?></td>
          </tr>
<?php
    if (tep_not_null($order->info['cc_type']) || tep_not_null($order->info['cc_owner']) || tep_not_null($order->info['cc_number'])) {
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_TYPE; ?></td>
            <td class="main"><?php echo $order->info['cc_type']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_OWNER; ?></td>
            <td class="main"><?php echo $order->info['cc_owner']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_NUMBER; ?></td>
            <td class="main"><?php echo $order->info['cc_number']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_EXPIRES; ?></td>
            <td class="main"><?php echo $order->info['cc_expires']; ?></td>
          </tr>
<?php
    }
?>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td>
          
          
          <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
	<th width="12.5%" scope="col" id="cb" class="manage-column column-username" style=""><?php echo __('Quantity','wosci-language') ; ?></th>
	<th width="12.5%" scope="col" id="cb" class="manage-column column-username" style=""><?php echo __('Products','wosci-language') ; ?></th>
	<th width="12.5%" scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Model','wosci-language') ; ?></th>
	<th width="12.5%" scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Tax','wosci-language') ; ?></th>
	<th width="12.5%" scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Tax Excluded','wosci-language') ; ?></th>
	<th width="12.5%" scope="col" id="role" class="manage-column column-role" style=""><?php echo __('Tax Included','wosci-language') ; ?></th>

	<th width="12.5%" scope="col" id="posts" class="manage-column column-posts num" style=""><?php echo __('Total Excl. Tax','wosci-language') ; ?></th>
	<th width="12.5%" scope="col" id="posts" class="manage-column column-posts num" style=""><?php echo __('Total Incl. Tax','wosci-language') ; ?></th>
</tr>
</thead>
          


      
<?php
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      echo '          <tr class="dataTableRow">' . "\n" .
           '            <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
           '            <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          echo '</i></small></nobr>';
        }
      }

      echo '            </td>' . "\n" .
           '            <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '            <td class="dataTableContent" align="left" valign="top">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
           '            <td class="dataTableContent" align="left" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="left" valign="top"><b>' . $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax'], true), true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax'], true) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n";
      echo '          </tr>' . "\n";
    }
?>
          <tr>
            <td align="right" colspan="8"><table border="0" cellspacing="0" cellpadding="2">
<?php
    for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
      echo '              <tr>' . "\n" .
           '                <td align="right" class="smallText">' . $order->totals[$i]['title'] . '</td>' . "\n" .
           '                <td align="right" class="smallText">' . $order->totals[$i]['text'] . '</td>' . "\n" .
           '              </tr>' . "\n";
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main">
          
          
          <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
	<th scope="col" id="cb" class="manage-column column-username" style=""><b><?php echo __('Notify Date','wosci-language') ; ?></b></th>
	<th scope="col" id="username" class="manage-column column-username" style=""><b><?php echo __('Customer Notify','wosci-language') ; ?></b></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><b><?php echo __('Status','wosci-language') ; ?></b></th>
	<th scope="col" id="email" class="manage-column column-email" style=""><b><?php echo __('Comments','wosci-language') ; ?></b></th>
</tr>
</thead>
          
          
          
<?php
    $orders_history_query = tep_db_query("select orders_status_id, date_added, customer_notified, comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . tep_db_input($oID) . "' order by date_added");
    if (tep_db_num_rows($orders_history_query)) {
      while ($orders_history = tep_db_fetch_array($orders_history_query)) {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" align="">' . tep_datetime_short($orders_history['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="">';
        if ($orders_history['customer_notified'] == '1') {
          echo "&#10004;</td>";
        } else {
          echo "✘</td>";
        }
        echo '            <td class="smallText">' . $orders_status_array[$orders_history['orders_status_id']] . '</td>' . "\n" .
             '            <td class="smallText">' . nl2br(tep_db_output($orders_history['comments'])) . '&nbsp;</td>' . "\n" .
             '          </tr>' . "\n";
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
      <tr>
        <td class="main"><br><b><?php echo __('Comments','wosci-language') ; ?></b></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('status', 'admin.php?'. tep_get_all_get_params(array('action')) . 'action=update_order'); ?>
        <td class="main"><?php echo tep_draw_textarea_field('comments', 'soft', '60', '5'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo __('Select Status','wosci-language') ; ?></b> <?php echo tep_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo __('Notify Customer','wosci-language') ; ?></b> <?php echo tep_draw_checkbox_field('notify', '', true); ?></td>
                <td class="main"><b><?php echo __('Notify With Comments','wosci-language') ; ?></b> <?php echo tep_draw_checkbox_field('notify_comments', '', true); ?></td>
              </tr>
            </table></td>
            <td valign="top"><?php echo '<input type="submit" value="'. __('Update').'" class="button" />'; ?></td>
          </tr>
        </table></td>
      </form></tr>
      <tr>
       <td colspan="2" align="right"><?php echo '<a class="button" href="' .esc_url( home_url( '/' ) ) .'pdf-invoice/?order_id='.$_GET['oID'] . '" TARGET="_blank">' . __('Printable Invoice', 'wosci-language') . '</a> <a class="button" href="admin.php?page=invoice&oID=' . $_GET['oID'] . '" TARGET="_blank">' . __('Invoice','wosci-language') . '</a> <a class="button" href="admin.php?page=packing_slip&oID=' . $_GET['oID'] . '" TARGET="_blank">' . __('Packing Slip','wosci-language') . '</a> <a class="button" href="admin.php?'. tep_get_all_get_params(array('action')) . '">' . __('Back','wosci-language') . '</a> '; ?></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php _e('Orders','wosci-language'); ?></h2></td>
            <td class="wrap" align="right"><h2><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></h2></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr><?php echo tep_draw_form('orders', 'admin.php', 'page=orders', 'get'); ?>
                <td class="smallText" align="right"><?php echo __('Search by Order Number #','wosci-language') . ' ' . tep_draw_input_field('oID', '', 'size="12"') . tep_draw_hidden_field('action', 'edit'). tep_draw_hidden_field('page', 'orders'); ?></td>
              <?php echo tep_hide_session_id(); ?></form></tr>
              <tr><?php echo tep_draw_form('status', 'admin.php', 'page=orders', 'get'). tep_draw_hidden_field('page', 'orders'); ?>
                <td class="smallText" align="right"><?php echo __('Status','wosci-language') . ' ' . tep_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => __('All Orders','wosci-language'))), $orders_statuses), '', 'onChange="this.form.submit();"'); ?></td>
              <?php echo tep_hide_session_id(); ?></form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
                            
              <table class="widefat" cellspacing="0">
<thead>
<tr class="thead">
	<th width="25%" style=""><?php _e('Customers','wosci-language'); ?></th>
	<th width="15%" scope="col" id="username" class="manage-column column-username" style=""><?php _e('Order Total','wosci-language'); ?></th>
	<th width="25%" scope="col" id="name" class="manage-column column-name" style=""><?php _e('Date Purchased','wosci-language'); ?></th>
	<th width="15%" scope="col" id="email" class="manage-column column-email" style=""><?php _e('Status','wosci-language'); ?></th>
	<th width="25%" scope="col" id="role" class="manage-column column-role" style=""><?php _e('Action','wosci-language'); ?></th>

	
</tr>
</thead>

<tfoot>
<tr class="thead">
	<th width="25%" scope="col" id="cb" class="" style=""><?php _e('Customers','wosci-language'); ?></th>
	<th width="15%" scope="col" id="username" class="manage-column column-username" style=""><?php _e('Order Total','wosci-language'); ?></th>
	<th width="25%" scope="col" id="name" class="manage-column column-name" style=""><?php _e('Date Purchased','wosci-language'); ?></th>
	<th width="15%" scope="col" id="email" class="manage-column column-email" style=""><?php _e('Status','wosci-language'); ?></th>
	<th width="20%" scope="col" id="role" class="manage-column column-role" style=""><?php _e('Action','wosci-language'); ?></th>

	
</tr>

</tfoot>
              
              
              
<?php
$languages_id=1;
    if (isset($_GET['cID'])) {
      $cID = tep_db_prepare_input($_GET['cID']);
      $orders_query_raw = "select o.orders_id, o.customers_name, o.customers_id, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$cID . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' order by orders_id DESC";
    } elseif (isset($_GET['status']) && is_numeric($_GET['status']) && ($_GET['status'] > 0)) {
      $status = tep_db_prepare_input($_GET['status']);
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.orders_status_id = '" . (int)$status . "' and ot.class = 'ot_total' order by o.orders_id DESC";
    } else {
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total from orders o left join orders_total ot on (o.orders_id = ot.orders_id), orders_status s where o.orders_status = s.orders_status_id and s.language_id = '1' and ot.class = 'ot_total' order by o.orders_id DESC";
    }
    //$orders_split = new splitPageResults($_GET['pageOSI'], MAX_DISPLAY_SEARCH_RESULTS, $orders_query_raw, $orders_query_numrows);
    $orders_query = tep_db_query($orders_query_raw);
    while ($orders = tep_db_fetch_array($orders_query)) {
    if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders['orders_id']))) && !isset($oInfo)) {
        $oInfo = new objectInfo($orders);
      }

      if (isset($oInfo) && is_object($oInfo) && ($orders['orders_id'] == $oInfo->orders_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" >' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<span style="line-height:32px;text-align:middle;">' . $orders['customers_name']; ?></span></td>
                <td class="dataTableContent"><span style="line-height:32px;text-align:middle;"><?php echo strip_tags($orders['order_total']); ?></span></td>
                <td class="dataTableContent" >&nbsp;<span style="line-height:32px;text-align:middle;"><?php echo tep_datetime_short($orders['date_purchased']); ?></span></td>
                <td class="dataTableContent"><span style="line-height:32px;text-align:middle;"><?php echo $orders['orders_status_name']; ?></span></td>
                <td class="dataTableContent"><span style="line-height:32px;text-align:middle;"><?php if (isset($oInfo) && is_object($oInfo) && ($orders['orders_id'] == $oInfo->orders_id)) { echo '►'; } else { echo '<a class="button" href="admin.php?'. tep_get_all_get_params(array('oID')) . 'oID=' . $orders['orders_id'] . '">'. __('Options','wosci-language').'</a>'; } ?>&nbsp;<?php echo '<a target="_blank" class="button" href="admin.php?'. tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $orders['orders_id'] . '&action=edit' . '">View</a>'; ?></span></td>
              </tr>
<?php
    }
?>
              
            </table><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php //echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['pageOSI'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                    <td class="smallText" align="right"><?php //echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['pageOSI'], tep_get_all_get_params(array('pageOSI', 'oID', 'action'))); ?></td>
                  </tr>
                </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_ORDER . '</b>');

      $contents = array('form' => tep_draw_form('orders', 'admin.php?'. tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=deleteconfirm'));
      $contents[] = array('text' => __('Are you sure you want to delete this order status?','wosci-language') . '<br><br><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('restock') . ' ' . TEXT_INFO_RESTOCK_PRODUCT_QUANTITY);
      $contents[] = array('align' => 'center', 'text' => '<br>' . '<input type="submit" value="'. __('Remove','wosci-language').'" class="button" />' . ' <a class="button" href="admin.php?'. tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading[] = array('text' => '<b>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . tep_datetime_short($oInfo->date_purchased) . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<div style="padding-top:12px;"><a class="button" href="admin.php?'. tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit' . '">'. __('View','wosci-language').'</a> <a class="button" href="admin.php?'. tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete' . '">'. __('Delete','wosci-language').'</a></div>');
        $contents[] = array('align' => 'center', 'text' => '<div style="padding-top:12px;"><a class="button" href="' .esc_url( home_url( '/' ) ).'pdf-invoice/?order_id='.$_GET['oID'] . '" TARGET="_blank">' . __('Printable Invoice','wosci-language') . '</a> <a class="button" href="admin.php?page=invoice&oID=' . $oInfo->orders_id . '" TARGET="_blank">'. __('Invoice','wosci-language').'</a></div><div style="padding-top:12px;"><a class="button" href="admin.php?page=packing_slip&oID=' . $oInfo->orders_id . '" TARGET="_blank">'. __('Packing Slip','wosci-language').'</a></div>');
        
        $contents[] = array('text' => '<br>' . __('Order Created','wosci-language')  . ' ' . tep_date_short($oInfo->date_purchased));
        if (tep_not_null($oInfo->last_modified)) $contents[] = array('text' => TEXT_DATE_ORDER_LAST_MODIFIED . ' ' . tep_date_short($oInfo->last_modified));
        $contents[] = array('text' => '<br>' . __('Payment Method','wosci-language') . ' '  . $oInfo->payment_method);
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents,'');

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table>



<?php
}

add_action('admin_menu', 'ordersmenu');










/* Currencies */

function localization(){

	add_menu_page('Currencies', 'Currencies', 'activate_plugins', 'currencies', 'func_currencies','div');
	add_submenu_page( 'currencies', 'Order Status', 'Order Status', 'activate_plugins', 'order_status', 'func_order_status' );

}

function func_order_status(){

$languages_id = 1;
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['oID'])) $orders_status_id = tep_db_prepare_input($_GET['oID']);

        $languages = tep_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $orders_status_name_array = $_POST['orders_status_name'];
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('orders_status_name' => tep_db_prepare_input($orders_status_name_array[$language_id]),
                                  'public_flag' => ((isset($_POST['public_flag']) && ($_POST['public_flag'] == '1')) ? '1' : '0'),
                                  'downloads_flag' => ((isset($_POST['downloads_flag']) && ($_POST['downloads_flag'] == '1')) ? '1' : '0'));

          if ($action == 'insert') {
            if (empty($orders_status_id)) {
              $next_id_query = tep_db_query("select max(orders_status_id) as orders_status_id from " . TABLE_ORDERS_STATUS . "");
              $next_id = tep_db_fetch_array($next_id_query);
              $orders_status_id = $next_id['orders_status_id'] + 1;
            }

            $insert_sql_data = array('orders_status_id' => $orders_status_id,
                                     'language_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_ORDERS_STATUS, $sql_data_array);
          } elseif ($action == 'save') {
            tep_db_perform(TABLE_ORDERS_STATUS, $sql_data_array, 'update', "orders_status_id = '" . (int)$orders_status_id . "' and language_id = '" . (int)$language_id . "'");
          }
        }

        if (isset($_POST['default']) && ($_POST['default'] == 'on')) {
          tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($orders_status_id) . "' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        }

        wp_redirect('admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $orders_status_id);
        break;
      case 'deleteconfirm':
        $oID = tep_db_prepare_input($_GET['oID']);

        $orders_status_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        $orders_status = tep_db_fetch_array($orders_status_query);

        if ($orders_status['configuration_value'] == $oID) {
          tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
        }

        tep_db_query("delete from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . tep_db_input($oID) . "'");

        wp_redirect('admin.php?page=order_status&pageOSI=' . $_GET['pageOSI']);
        break;
      case 'delete':
        $oID = tep_db_prepare_input($_GET['oID']);

        $status_query = tep_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . (int)$oID . "'");
        $status = tep_db_fetch_array($status_query);

        $remove_status = true;
        if ($oID == DEFAULT_ORDERS_STATUS_ID) {
          $remove_status = false;
   //       $messageStack->add(ERROR_REMOVE_DEFAULT_ORDER_STATUS, 'error');
        } elseif ($status['count'] > 0) {
          $remove_status = false;
//          $messageStack->add(ERROR_STATUS_USED_IN_ORDERS, 'error');
        } else {
          $history_query = tep_db_query("select count(*) as count from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_status_id = '" . (int)$oID . "'");
          $history = tep_db_fetch_array($history_query);
          if ($history['count'] > 0) {
            $remove_status = false;
//            $messageStack->add(ERROR_STATUS_USED_IN_HISTORY, 'error');
          }
        }
        break;
    }
  }

?>


<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php echo __('Order Status','wosci-language'); ?></h2></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              
              
              
              <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
	<th style=""><?php echo __('Order Status','wosci-language'); ?></th>
	<th style=""><?php echo __('Public Status','wosci-language'); ?></th>
	<th style=""><?php echo __('Download Status','wosci-language'); ?></th>
	<th style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</thead>

<tfoot>
<tr class="thead">
	<th style=""><?php echo __('Order Status','wosci-language'); ?></th>
	<th style=""><?php echo __('Public Status','wosci-language'); ?></th>
	<th style=""><?php echo __('Download Status','wosci-language'); ?></th>
	<th style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</tfoot>
              
              
<?php
  $orders_status_query_raw = "select * from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_id";
//  $orders_status_split = new splitPageResults($_GET['pageOSI'], MAX_DISPLAY_SEARCH_RESULTS, $orders_status_query_raw, $orders_status_query_numrows);
  $orders_status_query = tep_db_query($orders_status_query_raw);
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders_status['orders_status_id']))) && !isset($oInfo) && (substr($action, 0, 3) != 'new')) {
      $oInfo = new objectInfo($orders_status);
    }

    if (isset($oInfo) && is_object($oInfo) && ($orders_status['orders_status_id'] == $oInfo->orders_status_id)) {
      echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $oInfo->orders_status_id . '&action=edit' . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $orders_status['orders_status_id'] . '\'">' . "\n";
    }

    if (DEFAULT_ORDERS_STATUS_ID == $orders_status['orders_status_id']) {
      echo '                <td class="dataTableContent"><b>' . $orders_status['orders_status_name'] . ' (' . TEXT_DEFAULT . ')</b></td>' . "\n";
    } else {
      echo '                <td class="dataTableContent">' . $orders_status['orders_status_name'] . '</td>' . "\n";
    }
?>
                <td class="dataTableContent" align="center"><?php echo  (($orders_status['public_flag'] == '1') ? '✔' : '✖'); ?></td>
                <td class="dataTableContent" align="center"><?php echo (($orders_status['downloads_flag'] == '1') ? '✔' : '✖'); ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($oInfo) && is_object($oInfo) && ($orders_status['orders_status_id'] == $oInfo->orders_status_id)) { echo '▶'; } else { echo '<a href="admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $orders_status['orders_status_id'] . '"> </a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              
            </table><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php //echo $orders_status_split->display_count($orders_status_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['pageOSI'], TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS); ?></td>
                    <td class="smallText" align="right"><?php //echo $orders_status_split->display_links($orders_status_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['pageOSI']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="2" align="right"><div style="padding:8px;"></div><?php echo '<a class="button" href="admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&action=new' . '">'. __('Insert', 'wosci-language').'</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . __('New Orders Status','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('status', 'admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&action=insert'));
      $contents[] = array('text' => __('Please enter the new orders status with its related data','wosci-language'));

      $orders_status_inputs_string = '';
      $languages = tep_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $orders_status_inputs_string .= '<br>' ./* tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) .*/ '&nbsp;' . tep_draw_input_field('orders_status_name[' . $languages[$i]['id'] . ']');
      }

      $contents[] = array('text' => '<br>' . __('Orders Status','wosci-language') . $orders_status_inputs_string);
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('public_flag', '1') . ' ' . __('Show the order to the customer at this order status level','wosci-language'));
      $contents[] = array('text' => tep_draw_checkbox_field('downloads_flag', '1') . ' ' . __('Allow downloads of virtual products at this order status level','wosci-language'));
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Insert').'" class="button" /> <a class="button" href="admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . __('Edit Order Status','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('status', 'admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $oInfo->orders_status_id  . '&action=save'));
      $contents[] = array('text' => __('Please enter the new orders status with its related data','wosci-language'));

      $orders_status_inputs_string = '';
      $languages = tep_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $orders_status_inputs_string .= '<br>' . /*tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) .*/ '&nbsp;' . tep_draw_input_field('orders_status_name[' . $languages[$i]['id'] . ']', tep_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']));
      }

      $contents[] = array('text' => '<br>' . __('Orders Status','wosci-language') . $orders_status_inputs_string);
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('public_flag', '1', $oInfo->public_flag) . ' ' . __('Show the order to the customer at this order status level','wosci-language'));
      $contents[] = array('text' => tep_draw_checkbox_field('downloads_flag', '1', $oInfo->downloads_flag) . ' ' . __('Allow downloads of virtual products at this order status level','wosci-language'));
      if (DEFAULT_ORDERS_STATUS_ID != $oInfo->orders_status_id) $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update').'" class="button" /> <a class="button" href="admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $oInfo->orders_status_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . __('Delete Orders Status','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('status', 'wp-admin/admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $oInfo->orders_status_id  . '&action=deleteconfirm'));
      $contents[] = array('text' => __('Are you sure you want to delete this order status?','wosci-language'));
      $contents[] = array('text' => '<br><b>' . $oInfo->orders_status_name . '</b>');
      if ($remove_status) $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Remove','wosci-language').'" class="button" /> <a class="button" href="admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $oInfo->orders_status_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading[] = array('text' => '<b>' . $oInfo->orders_status_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $oInfo->orders_status_id . '&action=edit' . '">'. __('Edit','wosci-language').'</a> <a class="button" href="admin.php?page=order_status&pageOSI=' . $_GET['pageOSI'] . '&oID=' . $oInfo->orders_status_id . '&action=delete' . '">'. __('Delete','wosci-language').'</a>');

        $orders_status_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $orders_status_inputs_string .= '<br>'./* tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) .*/ '&nbsp;' . tep_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']);
        }

        $contents[] = array('text' => $orders_status_inputs_string);
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents,'');

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php


}

function func_currencies(){
global $currencies;
//  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['cID'])) $currency_id = tep_db_prepare_input($_GET['cID']);
        $title = tep_db_prepare_input($_POST['title']);
        $code = tep_db_prepare_input($_POST['code']);
        $symbol_left = tep_db_prepare_input($_POST['symbol_left']);
        $symbol_right = tep_db_prepare_input($_POST['symbol_right']);
        $decimal_point = tep_db_prepare_input($_POST['decimal_point']);
        $thousands_point = tep_db_prepare_input($_POST['thousands_point']);
        $decimal_places = tep_db_prepare_input($_POST['decimal_places']);
        $value = tep_db_prepare_input($_POST['value']);

        $sql_data_array = array('title' => $title,
                                'code' => $code,
                                'symbol_left' => $symbol_left,
                                'symbol_right' => $symbol_right,
                                'decimal_point' => $decimal_point,
                                'thousands_point' => $thousands_point,
                                'decimal_places' => $decimal_places,
                                'value' => $value);

        if ($action == 'insert') {
          tep_db_perform(TABLE_CURRENCIES, $sql_data_array);
          $currency_id = tep_db_insert_id();
        } elseif ($action == 'save') {
          tep_db_perform(TABLE_CURRENCIES, $sql_data_array, 'update', "currencies_id = '" . (int)$currency_id . "'");
        }

        if (isset($_POST['default']) && ($_POST['default'] == 'on')) {
          tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($code) . "' where configuration_key = 'DEFAULT_CURRENCY'");
        }

        wp_redirect('admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $currency_id);
        break;
      case 'deleteconfirm':
        $currencies_id = tep_db_prepare_input($_GET['cID']);

        $currency_query = tep_db_query("select currencies_id from " . TABLE_CURRENCIES . " where code = '" . DEFAULT_CURRENCY . "'");
        $currency = tep_db_fetch_array($currency_query);

        if ($currency['currencies_id'] == $currencies_id) {
          tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'DEFAULT_CURRENCY'");
        }

        tep_db_query("delete from " . TABLE_CURRENCIES . " where currencies_id = '" . (int)$currencies_id . "'");

        wp_redirect('admin.php?page=currencies&pageOSI=' . $_GET['pageOSI']);
        break;
      case 'update':
        $server_used = CURRENCY_SERVER_PRIMARY;

        $currency_query = tep_db_query("select currencies_id, code, title from " . TABLE_CURRENCIES);
        while ($currency = tep_db_fetch_array($currency_query)) {
          $quote_function = 'quote_' . CURRENCY_SERVER_PRIMARY . '_currency';
          $rate = $quote_function($currency['code']);

          if (empty($rate) && (tep_not_null(CURRENCY_SERVER_BACKUP))) {
            $messageStack->add_session(sprintf(WARNING_PRIMARY_SERVER_FAILED, CURRENCY_SERVER_PRIMARY, $currency['title'], $currency['code']), 'warning');

            $quote_function = 'quote_' . CURRENCY_SERVER_BACKUP . '_currency';
            $rate = $quote_function($currency['code']);

            $server_used = CURRENCY_SERVER_BACKUP;
          }

          if (tep_not_null($rate)) {
            tep_db_query("update " . TABLE_CURRENCIES . " set value = '" . $rate . "', last_updated = now() where currencies_id = '" . (int)$currency['currencies_id'] . "'");

            //$messageStack->add_session(sprintf(TEXT_INFO_CURRENCY_UPDATED, $currency['title'], $currency['code'], $server_used), 'success');
          } else {
           // $messageStack->add_session(sprintf(ERROR_CURRENCY_INVALID, $currency['title'], $currency['code'], $server_used), 'error');
          }
        }

        wp_redirect('admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $_GET['cID']);
        break;
      case 'delete':
        $currencies_id = tep_db_prepare_input($_GET['cID']);

        $currency_query = tep_db_query("select code from " . TABLE_CURRENCIES . " where currencies_id = '" . (int)$currencies_id . "'");
        $currency = tep_db_fetch_array($currency_query);

        $remove_currency = true;
        if ($currency['code'] == DEFAULT_CURRENCY) {
          $remove_currency = false;
          $messageStack->add(ERROR_REMOVE_DEFAULT_CURRENCY, 'error');
        }
        break;
    }
  }
?>


<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php echo __('Currencies','wosci-language'); ?></h2></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              
              
              <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">	
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Currency Name','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Currency Code','wosci-language'); ?></th>
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Currency Value','wosci-language'); ?></th>
	<th scope="col" id="role" class="manage-column column-role" style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</thead>

<tfoot>
<tr class="thead">	
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Currency Name','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Currency Code','wosci-language'); ?></th>
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Currency Value','wosci-language'); ?></th>
	<th scope="col" id="role" class="manage-column column-role" style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</tfoot>
              
<?php
  $currency_query_raw = "select currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, last_updated, value from " . TABLE_CURRENCIES . " order by title";
//  $currency_split = new splitPageResults($_GET['pageOSI'], MAX_DISPLAY_SEARCH_RESULTS, $currency_query_raw, $currency_query_numrows);
  $currency_query = tep_db_query($currency_query_raw);
  while ($currency = tep_db_fetch_array($currency_query)) {
    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $currency['currencies_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
      $cInfo = new objectInfo($currency);
    }

    if (isset($cInfo) && is_object($cInfo) && ($currency['currencies_id'] == $cInfo->currencies_id) ) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '&action=edit' . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $currency['currencies_id'] . '\'">' . "\n";
    }

    if (DEFAULT_CURRENCY == $currency['code']) {
      echo '                <td class="dataTableContent"><b>' . $currency['title'] . ' (' . TEXT_DEFAULT . ')</b></td>' . "\n";
    } else {
      echo '                <td class="dataTableContent">' . $currency['title'] . '</td>' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $currency['code']; ?></td>
                <td class="dataTableContent" align="right"><?php echo number_format($currency['value'], 8); ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && is_object($cInfo) && ($currency['currencies_id'] == $cInfo->currencies_id) ) { echo '▶'; } else { echo '<a href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $currency['currencies_id'] . '">' . '' . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              
            </table><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php //echo $currency_split->display_count($currency_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['pageOSI'], TEXT_DISPLAY_NUMBER_OF_CURRENCIES); ?></td>
                    <td class="smallText" align="right"><?php //echo $currency_split->display_links($currency_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['pageOSI']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td><?php if (CURRENCY_SERVER_PRIMARY) { echo '<a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '&action=update' . '">'. __('Update Currencies','wosci-language').'</a>'; } ?></td>
                    <td align="right"><div style="padding:8px;"></div><?php echo '<a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '&action=new' . '">'. __('New Currency','wosci-language').'</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_CURRENCY . '</b>');

      $contents = array('form' => tep_draw_form('currencies', 'admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . (isset($cInfo) ? '&cID=' . $cInfo->currencies_id : '') . '&action=insert'));
      $contents[] = array('text' => __('Please Fill Currency Details','wosci-language'));
      $contents[] = array('text' => '<br>' . __('Title','wosci-language') . '<br>' . tep_draw_input_field('title'));
      $contents[] = array('text' => '<br>' . __('Code','wosci-language') . '<br>' . tep_draw_input_field('code'));
      $contents[] = array('text' => '<br>' . __('Symbol Left','wosci-language') . '<br>' . tep_draw_input_field('symbol_left'));
      $contents[] = array('text' => '<br>' . __('Symbol Right','wosci-language') . '<br>' . tep_draw_input_field('symbol_right'));
      $contents[] = array('text' => '<br>' . __('Decimal Point','wosci-language') . '<br>' . tep_draw_input_field('decimal_point'));
      $contents[] = array('text' => '<br>' . __('Thousand Point','wosci-language') . '<br>' . tep_draw_input_field('thousands_point'));
      $contents[] = array('text' => '<br>' . __('Decimal Places','wosci-language') . '<br>' . tep_draw_input_field('decimal_places'));
      $contents[] = array('text' => '<br>' . __('Value','wosci-language') . '<br>' . tep_draw_input_field('value'));
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('default') . ' ' . __('Set as Default','wosci-language'));
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Insert').'" class="button" /> <a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $_GET['cID'] . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . __('Edit Currency','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('currencies', 'admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '&action=save'));
      $contents[] = array('text' => __('Currency Details','wosci-language'));
      $contents[] = array('text' => '<br>' . __('Title','wosci-language') . '<br>' . tep_draw_input_field('title', $cInfo->title));
      $contents[] = array('text' => '<br>' . __('Code','wosci-language') . '<br>' . tep_draw_input_field('code', $cInfo->code));
      $contents[] = array('text' => '<br>' . __('Symbol Left','wosci-language') . '<br>' . tep_draw_input_field('symbol_left', $cInfo->symbol_left));
      $contents[] = array('text' => '<br>' . __('Symbol Right','wosci-language') . '<br>' . tep_draw_input_field('symbol_right', $cInfo->symbol_right));
      $contents[] = array('text' => '<br>' . __('Decimal Point','wosci-language') . '<br>' . tep_draw_input_field('decimal_point', $cInfo->decimal_point));
      $contents[] = array('text' => '<br>' . __('Thousand Point','wosci-language') . '<br>' . tep_draw_input_field('thousands_point', $cInfo->thousands_point));
      $contents[] = array('text' => '<br>' . __('Decimal Places','wosci-language') . '<br>' . tep_draw_input_field('decimal_places', $cInfo->decimal_places));
      $contents[] = array('text' => '<br>' . __('Value','wosci-language') . '<br>' . tep_draw_input_field('value', $cInfo->value));
      if (DEFAULT_CURRENCY != $cInfo->code) $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('default') . ' ' . __('Set as Default','wosci-language'));
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update').'" class="button" /> <a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CURRENCY . '</b>');

      $contents[] = array('text' => __('Are you sure you want to delete this order status?','wosci-language'));
      $contents[] = array('text' => '<br><b>' . $cInfo->title . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . (($remove_currency) ? '<a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '&action=deleteconfirm' . '">'. __('Delete','wosci-language').'</a>' : '') . ' <a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '&action=edit' . '">'. __('Edit','wosci-language').'</a> <a class="button" href="admin.php?page=currencies&pageOSI=' . $_GET['pageOSI'] . '&cID=' . $cInfo->currencies_id . '&action=delete' . '">'. __('Delete','wosci-language').'</a>');
        $contents[] = array('text' => '<br>' . __('Title','wosci-language') . ' ' . $cInfo->title);
        $contents[] = array('text' => __('Code','wosci-language') . ' ' . $cInfo->code);
        $contents[] = array('text' => '<br>' . __('Symbol Left','wosci-language') . ' ' . $cInfo->symbol_left);
        $contents[] = array('text' => __('Symbol Right','wosci-language') . ' ' . $cInfo->symbol_right);
        $contents[] = array('text' => '<br>' . __('Decimal Point','wosci-language') . ' ' . $cInfo->decimal_point);
        $contents[] = array('text' => __('Thousand Point','wosci-language') . ' ' . $cInfo->thousands_point);
        $contents[] = array('text' => __('Decimal Places','wosci-language') . ' ' . $cInfo->decimal_places);
        $contents[] = array('text' => '<br>' . __('Last Update','wosci-language') . ' ' . tep_date_short($cInfo->last_updated));
        $contents[] = array('text' => __('Value','wosci-language') . ' ' . number_format($cInfo->value, 8));
        $contents[] = array('text' => '<br>' . __('Example','wosci-language') . ':<br>' . $currencies->format('30', false, DEFAULT_CURRENCY) . ' = ' . $currencies->format('30', true, $cInfo->code));
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents, '');

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table>


<?php

}
add_action('admin_menu', 'localization');



/* TAX */

function tax_zones(){

	add_menu_page('Tax Rates', 'Tax Rates', 'activate_plugins', 'tax', 'func_tax_rates','div');
	add_submenu_page( 'tax', 'Tax Classes', 'Tax Classes', 'activate_plugins', 'tax_classes', 'func_tax_classes' );
	add_submenu_page( 'tax', 'Tax Geo Zones', 'Tax Geo Zones', 'activate_plugins', 'tax_zones', 'func_tax_zones' );

}

function func_tax_rates(){

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
        $tax_zone_id = tep_db_prepare_input($_POST['tax_zone_id']);
        $tax_class_id = tep_db_prepare_input($_POST['tax_class_id']);
        $tax_rate = tep_db_prepare_input($_POST['tax_rate']);
        $tax_description = tep_db_prepare_input($_POST['tax_description']);
        $tax_priority = tep_db_prepare_input($_POST['tax_priority']);

        tep_db_query("insert into " . TABLE_TAX_RATES . " (tax_zone_id, tax_class_id, tax_rate, tax_description, tax_priority, date_added) values ('" . (int)$tax_zone_id . "', '" . (int)$tax_class_id . "', '" . tep_db_input($tax_rate) . "', '" . tep_db_input($tax_description) . "', '" . tep_db_input($tax_priority) . "', now())");

        wp_redirect('admin.php?page=tax');
        break;
      case 'save':
        $tax_rates_id = tep_db_prepare_input($_GET['tID']);
        $tax_zone_id = tep_db_prepare_input($_POST['tax_zone_id']);
        $tax_class_id = tep_db_prepare_input($_POST['tax_class_id']);
        $tax_rate = tep_db_prepare_input($_POST['tax_rate']);
        $tax_description = tep_db_prepare_input($_POST['tax_description']);
        $tax_priority = tep_db_prepare_input($_POST['tax_priority']);

        tep_db_query("update " . TABLE_TAX_RATES . " set tax_rates_id = '" . (int)$tax_rates_id . "', tax_zone_id = '" . (int)$tax_zone_id . "', tax_class_id = '" . (int)$tax_class_id . "', tax_rate = '" . tep_db_input($tax_rate) . "', tax_description = '" . tep_db_input($tax_description) . "', tax_priority = '" . tep_db_input($tax_priority) . "', last_modified = now() where tax_rates_id = '" . (int)$tax_rates_id . "'");

        wp_redirect('admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tax_rates_id);
        break;
      case 'deleteconfirm':
        $tax_rates_id = tep_db_prepare_input($_GET['tID']);

        tep_db_query("delete from " . TABLE_TAX_RATES . " where tax_rates_id = '" . (int)$tax_rates_id . "'");

        wp_redirect('wp-admin/admin.php?page=tax&pageOSI=' . $_GET['pageOSI']);
        break;
    }
  }
  
?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php echo __('Tax Rates','wosci-language'); ?></h2></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">             
              
              
              <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Priority','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Tax Class Title','wosci-language'); ?></th>
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Tax Zone','wosci-language'); ?></th>
	<th scope="col" id="role" class="manage-column column-role" style=""><?php echo __('Tax Rate','wosci-language'); ?></th>
	<th scope="col" id="posts" class="manage-column column-posts num" style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</thead>
              
              
<tfoot>
<tr class="thead">
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Priority','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Tax Class Title','wosci-language'); ?></th>
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Tax Zone','wosci-language'); ?></th>
	<th scope="col" id="role" class="manage-column column-role" style=""><?php echo __('Tax Rate','wosci-language'); ?></th>
	<th scope="col" id="posts" class="manage-column column-posts num" style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</tfoot>              
              
<?php
  $rates_query_raw = "select r.tax_rates_id, z.geo_zone_id, z.geo_zone_name, tc.tax_class_title, tc.tax_class_id, r.tax_priority, r.tax_rate, r.tax_description, r.date_added, r.last_modified from " . TABLE_TAX_CLASS . " tc, " . TABLE_TAX_RATES . " r left join " . TABLE_GEO_ZONES . " z on r.tax_zone_id = z.geo_zone_id where r.tax_class_id = tc.tax_class_id";
//  $rates_split = new splitPageResults($_GET['pageOSI'], MAX_DISPLAY_SEARCH_RESULTS, $rates_query_raw, $rates_query_numrows);
  $rates_query = tep_db_query($rates_query_raw);
  while ($rates = tep_db_fetch_array($rates_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $rates['tax_rates_id']))) && !isset($trInfo) && (substr($action, 0, 3) != 'new')) {
      $trInfo = new objectInfo($rates);
    }

    if (isset($trInfo) && is_object($trInfo) && ($rates['tax_rates_id'] == $trInfo->tax_rates_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $trInfo->tax_rates_id . '&action=edit' . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $rates['tax_rates_id'] . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $rates['tax_priority']; ?></td>
                <td class="dataTableContent"><?php echo $rates['tax_class_title']; ?></td>
                <td class="dataTableContent"><?php echo $rates['geo_zone_name']; ?></td>
                <td class="dataTableContent"><?php echo tep_display_tax_value($rates['tax_rate']); ?>%</td>
                <td class="dataTableContent" align="right"><?php if (isset($trInfo) && is_object($trInfo) && ($rates['tax_rates_id'] == $trInfo->tax_rates_id)) { echo '▶'; } else { echo '<a href="admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $rates['tax_rates_id'] . '">' . '' . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
             
            </table><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php //echo $rates_split->display_count($rates_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['pageOSI'], TEXT_DISPLAY_NUMBER_OF_TAX_RATES); ?></td>
                    <td class="smallText" align="right"><?php //echo $rates_split->display_links($rates_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['pageOSI']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="5" align="right"><div style="padding:8px;"></div><?php echo '<a class="button" href="admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&action=new' . '">'. __('New Tax Rate','wosci-language').'</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . __('New Tax Rate','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('rates', 'admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&action=insert'));
      $contents[] = array('text' => __('Please enter the new tax class with its related data','wosci-language'));
      $contents[] = array('text' => '<br>' . __('Tax Class Title','wosci-language') . '<br>' . tep_tax_classes_pull_down('name="tax_class_id" style="font-size:10px"'));
      $contents[] = array('text' => '<br>' . __('Zone','wosci-language') . '<br>' . tep_geo_zones_pull_down('name="tax_zone_id" style="font-size:10px"'));
      $contents[] = array('text' => '<br>' . __('Tax Rate (%)','wosci-language') . '<br>' . tep_draw_input_field('tax_rate'));
      $contents[] = array('text' => '<br>' . __('Description','wosci-language') . '<br>' . tep_draw_input_field('tax_description'));
      $contents[] = array('text' => '<br>' . __('Tax rates at the same priority are added, others are compounded.<br><br>Priority','wosci-language') . '<br>' . tep_draw_input_field('tax_priority'));
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Insert').'" class="button" />&nbsp;<a class="button" href="admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . __('Edit Tax Rate','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('rates', 'admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $trInfo->tax_rates_id  . '&action=save'));
      $contents[] = array('text' => __('Please make any necessary changes','wosci-language'));
      $contents[] = array('text' => '<br>' . __('Tax Class Title','wosci-language') . '<br>' . tep_tax_classes_pull_down('name="tax_class_id" style="font-size:10px"', $trInfo->tax_class_id));
      $contents[] = array('text' => '<br>' . __('Zone','wosci-language') . '<br>' . tep_geo_zones_pull_down('name="tax_zone_id" style="font-size:10px"', $trInfo->geo_zone_id));
      $contents[] = array('text' => '<br>' . __('Tax Rate (%)','wosci-language') . '<br>' . tep_draw_input_field('tax_rate', $trInfo->tax_rate));
      $contents[] = array('text' => '<br>' . __('Description','wosci-language') . '<br>' . tep_draw_input_field('tax_description', $trInfo->tax_description));
      $contents[] = array('text' => '<br>' . __('Tax rates at the same priority are added, others are compounded.<br><br>Priority','wosci-language') . '<br>' . tep_draw_input_field('tax_priority', $trInfo->tax_priority));
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update').'" class="button" />&nbsp;<a class="button" href="admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $trInfo->tax_rates_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . __('Delete Tax Rate','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('rates', 'admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $trInfo->tax_rates_id  . '&action=deleteconfirm'));
      $contents[] = array('text' => __('Are you sure you want to delete this tax rate?','wosci-language'));
      $contents[] = array('text' => '<br><b>' . $trInfo->tax_class_title . ' ' . number_format($trInfo->tax_rate, TAX_DECIMAL_PLACES) . '%</b>');
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Remove').'" class="button" />&nbsp;<a class="button" href="admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $trInfo->tax_rates_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    default:
      if (is_object($trInfo)) {
        $heading[] = array('text' => '<b>' . $trInfo->tax_class_title . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $trInfo->tax_rates_id . '&action=edit' . '">'. __('Edit','wosci-language').'</a> <a class="button" href="admin.php?page=tax&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $trInfo->tax_rates_id . '&action=delete' . '">'. __('Delete','wosci-language').'</a>');
        $contents[] = array('text' => '<br>' . __('Date Added','wosci-language') . ': ' . tep_date_short($trInfo->date_added));
        $contents[] = array('text' => '' . __('Last Modified','wosci-language') . ': ' . tep_date_short($trInfo->last_modified));
        $contents[] = array('text' => '<br>' . __('Description','wosci-language') . ':<br>' . $trInfo->tax_description);
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents,'');

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
}

function func_tax_classes(){

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
        $tax_class_title = tep_db_prepare_input($_POST['tax_class_title']);
        $tax_class_description = tep_db_prepare_input($_POST['tax_class_description']);

        tep_db_query("insert into " . TABLE_TAX_CLASS . " (tax_class_title, tax_class_description, date_added) values ('" . tep_db_input($tax_class_title) . "', '" . tep_db_input($tax_class_description) . "', now())");

        wp_redirect('wp-admin/admin.php?page=tax_classes');
        break;
      case 'save':
        $tax_class_id = tep_db_prepare_input($_GET['tID']);
        $tax_class_title = tep_db_prepare_input($_POST['tax_class_title']);
        $tax_class_description = tep_db_prepare_input($_POST['tax_class_description']);

        tep_db_query("update " . TABLE_TAX_CLASS . " set tax_class_id = '" . (int)$tax_class_id . "', tax_class_title = '" . tep_db_input($tax_class_title) . "', tax_class_description = '" . tep_db_input($tax_class_description) . "', last_modified = now() where tax_class_id = '" . (int)$tax_class_id . "'");

        wp_redirect('admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tax_class_id);
        break;
      case 'deleteconfirm':
        $tax_class_id = tep_db_prepare_input($_GET['tID']);

        tep_db_query("delete from " . TABLE_TAX_CLASS . " where tax_class_id = '" . (int)$tax_class_id . "'");

        wp_redirect('admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI']);
        break;
    }
  }
?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php echo __('Tax Classes','wosci-language'); ?></h2></td>
            <td class="wrap" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              
              
              
              
              <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
	
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Tax Classes','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Action','wosci-language'); ?></th>

</tr>
</thead>
              
<tfoot>
<tr class="thead">
	
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Tax Classes','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Action','wosci-language'); ?></th>

</tr>
</tfoot>              
              
<?php
  $classes_query_raw = "select tax_class_id, tax_class_title, tax_class_description, last_modified, date_added from " . TABLE_TAX_CLASS . " order by tax_class_title";
//  $classes_split = new splitPageResults($_GET['pageOSI'], MAX_DISPLAY_SEARCH_RESULTS, $classes_query_raw, $classes_query_numrows);
  $classes_query = tep_db_query($classes_query_raw);
  while ($classes = tep_db_fetch_array($classes_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $classes['tax_class_id']))) && !isset($tcInfo) && (substr($action, 0, 3) != 'new')) {
      $tcInfo = new objectInfo($classes);
    }

    if (isset($tcInfo) && is_object($tcInfo) && ($classes['tax_class_id'] == $tcInfo->tax_class_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tcInfo->tax_class_id . '&action=edit' . '\'">' . "\n";
    } else {
      echo'              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $classes['tax_class_id'] . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $classes['tax_class_title']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($tcInfo) && is_object($tcInfo) && ($classes['tax_class_id'] == $tcInfo->tax_class_id)) { echo '▶'; } else { echo '<a href="admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $classes['tax_class_id'] . '"></a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              
            </table><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php //echo $classes_split->display_count($classes_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['pageOSI'], TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES); ?></td>
                    <td class="smallText" align="right"><?php //echo $classes_split->display_links($classes_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['pageOSI']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="2" align="right"><div style="padding:8px;"></div><?php echo '<a class="button" href="admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&action=new' . '">'. __('New Tax Class','wosci-language').'</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . __('New Tax Class','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('classes', 'admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&action=insert'));
      $contents[] = array('text' => __('Please enter the new tax class with its related data','wosci-language'));
      $contents[] = array('text' => '<br>' . __('Tax Class Title','wosci-language') . '<br>' . tep_draw_input_field('tax_class_title'));
      $contents[] = array('text' => '<br>' . __('Description','wosci-language') . '<br>' . tep_draw_input_field('tax_class_description'));
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Insert').'" class="button" />&nbsp;<a class="button" href="admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . __('Edit Tax Class','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('classes', 'admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tcInfo->tax_class_id . '&action=save'));
      $contents[] = array('text' => __('Please make any necessary changes','wosci-language'));
      $contents[] = array('text' => '<br>' . __('Tax Class Title','wosci-language') . '<br>' . tep_draw_input_field('tax_class_title', $tcInfo->tax_class_title));
      $contents[] = array('text' => '<br>' . __('Description','wosci-language') . '<br>' . tep_draw_input_field('tax_class_description', $tcInfo->tax_class_description));
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update').'" class="button" />&nbsp;<a class="button" href="admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tcInfo->tax_class_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . __('Delete Tax Class','wosci-language') . '</b>');

      $contents = array('form' => tep_draw_form('classes', 'admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tcInfo->tax_class_id . '&action=deleteconfirm'));
      $contents[] = array('text' => __('Are you sure you want to delete this tax class?','wosci-language'));
      $contents[] = array('text' => '<br><b>' . $tcInfo->tax_class_title . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Remove').'" class="button" />&nbsp;<a class="button" href="admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tcInfo->tax_class_id . '">'. __('Cancel','wosci-language').'</a>');
      break;
    default:
      if (isset($tcInfo) && is_object($tcInfo)) {
        $heading[] = array('text' => '<b>' . $tcInfo->tax_class_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tcInfo->tax_class_id . '&action=edit' . '">'. __('Edit','wosci-language').'</a> <a class="button" href="admin.php?page=tax_classes&pageOSI=' . $_GET['pageOSI'] . '&tID=' . $tcInfo->tax_class_id . '&action=delete' . '">'. __('Delete','wosci-language').'</a>');
        $contents[] = array('text' => '<br>' . __('Date Added','wosci-language') . ': ' . tep_date_short($tcInfo->date_added));
        $contents[] = array('text' => '' . __('Last Modified','wosci-language') . ': ' . tep_date_short($tcInfo->last_modified));
        $contents[] = array('text' => '<br>' . __('Description','wosci-language') . ':<br>' . $tcInfo->tax_class_description);
      }
      break;
  }
  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents, '');

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
}

function func_tax_zones(){
$languages_id = 1;
  $saction = (isset($_GET['saction']) ? $_GET['saction'] : '');

  if (tep_not_null($saction)) {
    switch ($saction) {
      case 'insert_sub':
        $zID = tep_db_prepare_input($_GET['zID']);
        $zone_country_id = tep_db_prepare_input($_POST['zone_country_id']);
        $zone_id = tep_db_prepare_input($_POST['zone_id']);

        tep_db_query("insert into " . TABLE_ZONES_TO_GEO_ZONES . " (zone_country_id, zone_id, geo_zone_id, date_added) values ('" . (int)$zone_country_id . "', '" . (int)$zone_id . "', '" . (int)$zID . "', now())");
        $new_subzone_id = tep_db_insert_id();

        wp_redirect('admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $new_subzone_id);
        break;
      case 'save_sub':
        $sID = tep_db_prepare_input($_GET['sID']);
        $zID = tep_db_prepare_input($_GET['zID']);
        $zone_country_id = tep_db_prepare_input($_POST['zone_country_id']);
        $zone_id = tep_db_prepare_input($_POST['zone_id']);

        tep_db_query("update " . TABLE_ZONES_TO_GEO_ZONES . " set geo_zone_id = '" . (int)$zID . "', zone_country_id = '" . (int)$zone_country_id . "', zone_id = " . (tep_not_null($zone_id) ? "'" . (int)$zone_id . "'" : 'null') . ", last_modified = now() where association_id = '" . (int)$sID . "'");

        wp_redirect('admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $_GET['sID']);
        break;
      case 'deleteconfirm_sub':
        $sID = tep_db_prepare_input($_GET['sID']);

        tep_db_query("delete from " . TABLE_ZONES_TO_GEO_ZONES . " where association_id = '" . (int)$sID . "'");

        wp_redirect('admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage']);
        break;
    }
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert_zone':
        $geo_zone_name = tep_db_prepare_input($_POST['geo_zone_name']);
        $geo_zone_description = tep_db_prepare_input($_POST['geo_zone_description']);

        tep_db_query("insert into " . TABLE_GEO_ZONES . " (geo_zone_name, geo_zone_description, date_added) values ('" . tep_db_input($geo_zone_name) . "', '" . tep_db_input($geo_zone_description) . "', now())");
        $new_zone_id = tep_db_insert_id();

        wp_redirect('admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $new_zone_id);
        break;
      case 'save_zone':
        $zID = tep_db_prepare_input($_GET['zID']);
        $geo_zone_name = tep_db_prepare_input($_POST['geo_zone_name']);
        $geo_zone_description = tep_db_prepare_input($_POST['geo_zone_description']);

        tep_db_query("update " . TABLE_GEO_ZONES . " set geo_zone_name = '" . tep_db_input($geo_zone_name) . "', geo_zone_description = '" . tep_db_input($geo_zone_description) . "', last_modified = now() where geo_zone_id = '" . (int)$zID . "'");

        wp_redirect('admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID']);
        break;
      case 'deleteconfirm_zone':
        $zID = tep_db_prepare_input($_GET['zID']);

        tep_db_query("delete from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$zID . "'");
        tep_db_query("delete from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)$zID . "'");

        wp_redirect('admin.php?page=tax_zones&zpage=' . $_GET['zpage']);
        break;
    }
  }
?>

<?php
  if (isset($_GET['zID']) && (($saction == 'edit') || ($saction == 'new'))) {
?>
<script language="javascript"><!--
function resetZoneSelected(theForm) {
  if (theForm.state.value != '') {
    theForm.zone_id.selectedIndex = '0';
    if (theForm.zone_id.options.length > 0) {
      theForm.state.value = '<?php echo JS_STATE_SELECT; ?>';
    }
  }
}

function update_zone(theForm) {
  var NumState = theForm.zone_id.options.length;
  var SelectedCountry = "";

  while(NumState > 0) {
    NumState--;
    theForm.zone_id.options[NumState] = null;
  }         

  SelectedCountry = theForm.zone_country_id.options[theForm.zone_country_id.selectedIndex].value;

<?php echo tep_js_zone_list('SelectedCountry', 'theForm', 'zone_id'); ?>

}
//--></script>
<?php
  }
?>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="wrap"><div id="icon-edit" class="icon32 icon32-posts-product"><br></div><h2><?php echo __('Tax Zones','wosci-language'); if (isset($_GET['zone'])) echo '<br><span class="smallText">' . tep_get_geo_zone_name($_GET['zone']) . '</span>'; ?></h2></td>
            <td class="wrap" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
<?php
  if ($action == 'list') {
?>
            
              
              
              
              <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">	
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Country','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Country Zone','wosci-language'); ?></th>
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</thead>
           
      <tfoot>
<tr class="thead">
	<th scope="col" id="username" class="manage-column column-username" style=""><?php echo __('Country','wosci-language'); ?></th>
	<th scope="col" id="name" class="manage-column column-name" style=""><?php echo __('Country Zone','wosci-language'); ?></th>
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Action','wosci-language'); ?></th>
</tr>
</tfoot>     
           
              
<?php
    $rows = 0;
    $zones_query_raw = "select a.association_id, a.zone_country_id, c.countries_name, a.zone_id, a.geo_zone_id, a.last_modified, a.date_added, z.zone_name from " . TABLE_ZONES_TO_GEO_ZONES . " a left join " . TABLE_COUNTRIES . " c on a.zone_country_id = c.countries_id left join " . TABLE_ZONES . " z on a.zone_id = z.zone_id where a.geo_zone_id = " . $_GET['zID'] . " order by association_id";
//    $zones_split = new splitPageResults($_GET['spage'], MAX_DISPLAY_SEARCH_RESULTS, $zones_query_raw, $zones_query_numrows);
    $zones_query = tep_db_query($zones_query_raw);
    while ($zones = tep_db_fetch_array($zones_query)) {
      $rows++;
      if ((!isset($_GET['sID']) || (isset($_GET['sID']) && ($_GET['sID'] == $zones['association_id']))) && !isset($sInfo) && (substr($action, 0, 3) != 'new')) {
        $sInfo = new objectInfo($zones);
      }
      if (isset($sInfo) && is_object($sInfo) && ($zones['association_id'] == $sInfo->association_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=edit' . '\'">' . "\n";
      } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $zones['association_id'] . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo (($zones['countries_name']) ? $zones['countries_name'] : __('All Countries','wosci-language')); ?></td>
                <td class="dataTableContent"><?php echo (($zones['zone_id']) ? $zones['zone_name'] : __('All Zones','wosci-language')); ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($sInfo) && is_object($sInfo) && ($zones['association_id'] == $sInfo->association_id)) { echo '▶'; } else { echo '<a href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $zones['association_id'] . '"></a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              </table><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td  valign="top"  align="left"><?php //echo $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['spage'], TEXT_DISPLAY_NUMBER_OF_COUNTRIES); ?></td>
                    <td  align="right"><?php //echo $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['spage'], 'zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list', 'spage'); ?></td>
                  </tr>
                </table>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td></td><td style="padding-top:16px;" align="right"><?php if (empty($saction)) echo '<a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '">'. __('Back','wosci-language').'</a> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&' . (isset($sInfo) ? 'sID=' . $sInfo->association_id . '&' : '') . 'saction=new' . '">'. __('Insert','wosci-language').'</a>'; ?></td>
              </tr>
            </table>
<?php
  } else {
?>
           
              
              
              
              <table class="widefat fixed" cellspacing="0">
<thead>
<tr class="thead">
	
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Tax Zone','wosci-language'); ?></th>
	<th scope="col" id="role" class="manage-column column-role" style=""><?php echo __('Action','wosci-language'); ?></th>

</tr>
</thead>
              
       <tfoot>
<tr class="thead">
	
	<th scope="col" id="email" class="manage-column column-email" style=""><?php echo __('Tax Zone','wosci-language'); ?></th>
	<th scope="col" id="role" class="manage-column column-role" style=""><?php echo __('Action','wosci-language'); ?></th>

</tr>
</tfoot>       
              
<?php
    $zones_query_raw = "select geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added from " . TABLE_GEO_ZONES . " order by geo_zone_name";
//    $zones_split = new splitPageResults($_GET['zpage'], MAX_DISPLAY_SEARCH_RESULTS, $zones_query_raw, $zones_query_numrows);
    $zones_query = tep_db_query($zones_query_raw);
    while ($zones = tep_db_fetch_array($zones_query)) {
      if ((!isset($_GET['zID']) || (isset($_GET['zID']) && ($_GET['zID'] == $zones['geo_zone_id']))) && !isset($zInfo) && (substr($action, 0, 3) != 'new')) {
        $num_zones_query = tep_db_query("select count(*) as num_zones from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)$zones['geo_zone_id'] . "' group by geo_zone_id");
        $num_zones = tep_db_fetch_array($num_zones_query);

        if ($num_zones['num_zones'] > 0) {
          $zones['num_zones'] = $num_zones['num_zones'];
        } else {
          $zones['num_zones'] = 0;
        }

        $zInfo = new objectInfo($zones);
      }
      if (isset($zInfo) && is_object($zInfo) && ($zones['geo_zone_id'] == $zInfo->geo_zone_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=list' . '\'">' . "\n";
      } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zones['geo_zone_id'] . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zones['geo_zone_id'] . '&action=list' . '"><img src="' . WP_PLUGIN_URL .'/'. basename( dirname( __FILE__ ) ) . '/images/folder.png"></a>&nbsp;' . $zones['geo_zone_name']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($zInfo) && is_object($zInfo) && ($zones['geo_zone_id'] == $zInfo->geo_zone_id)) { echo '▶'; } else { echo '<a href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zones['geo_zone_id'] . '"></a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
             
              
            </table><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText"><?php //echo $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['zpage'], TEXT_DISPLAY_NUMBER_OF_TAX_ZONES); ?></td>
                    <td class="smallText" align="right"><?php //echo $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['zpage'], '', 'zpage'); ?></td>
                  </tr><tr>
                <td align="right" colspan="2"><div style="padding:8px;"></div><?php if (!$action) echo '<a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=new_zone' . '">'. __('Insert','wosci-language').'</a>'; ?></td>
              </tr>
                </table>
<?php
  }
?>
            </td>
<?php
  $heading = array();
  $contents = array();

  if ($action == 'list') {
    switch ($saction) {
      case 'new':
        $heading[] = array('text' => '<b>' . __('New Sub Zone','wosci-language') . '</b>');

        $contents = array('form' => tep_draw_form('zones', 'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&' . (isset($_GET['sID']) ? 'sID=' . $_GET['sID'] . '&' : '') . 'saction=insert_sub'));
        $contents[] = array('text' => __('Please enter the new sub zone information','wosci-language'));
        $contents[] = array('text' => '<br>' . __('Country','wosci-language') . '<br>' . tep_draw_pull_down_menu('zone_country_id', tep_get_countries2(__('All Countries','wosci-language')), '', 'onChange="update_zone(this.form);"'));
        $contents[] = array('text' => '<br>' . __('Zone','wosci-language') . '<br>' . tep_draw_pull_down_menu('zone_id', tep_prepare_country_zones_pull_down()));
        $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Insert').'" class="button" /> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&' . (isset($_GET['sID']) ? 'sID=' . $_GET['sID'] : '') . '">'. __('Cancel','wosci-language').'</a>');
        break;
      case 'edit':
        $heading[] = array('text' => '<b>' . __('Edit Sub Zone','wosci-language') . '</b>');

        $contents = array('form' => tep_draw_form('zones', 'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=save_sub'));
        $contents[] = array('text' => __('Please make any necessary changes','wosci-language'));
        $contents[] = array('text' => '<br>' . __('Country','wosci-language') . '<br>' . tep_draw_pull_down_menu('zone_country_id', tep_get_countries2(__('All Countries','wosci-language')), $sInfo->zone_country_id, 'onChange="update_zone(this.form);"'));
        $contents[] = array('text' => '<br>' . __('Zone','wosci-language') . '<br>' . tep_draw_pull_down_menu('zone_id', tep_prepare_country_zones_pull_down($sInfo->zone_country_id), $sInfo->zone_id));
        $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update','wosci-language').'" class="button" /> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '">'. __('Cancel','wosci-language').'</a>');
        break;
      case 'delete':
        $heading[] = array('text' => '<b>' . __('Delete Sub Zone','wosci-language') . '</b>');

        $contents = array('form' => tep_draw_form('zones', 'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=deleteconfirm_sub'));
        $contents[] = array('text' => __('Are you sure you want to delete this sub zone?','wosci-language'));
        $contents[] = array('text' => '<br><b>' . $sInfo->countries_name . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Remove').'" class="button" /> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '">'. __('Cancel','wosci-language').'</a>');
        break;
      default:
        if (isset($sInfo) && is_object($sInfo)) {
          $heading[] = array('text' => '<b>' . $sInfo->countries_name . '</b>');

          $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=edit' . '">'. __('Edit').'</a> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=list&spage=' . $_GET['spage'] . '&sID=' . $sInfo->association_id . '&saction=delete' . '">'. __('Delete').'</a>');
          $contents[] = array('text' => '<br>' . __('Date Added','wosci-language') . ': ' . tep_date_short($sInfo->date_added));
          if (tep_not_null($sInfo->last_modified)) $contents[] = array('text' => __('Last Modified','wosci-language') . ': ' . tep_date_short($sInfo->last_modified));
        }
        break;
    }
  } else {
    switch ($action) {
      case 'new_zone':
        $heading[] = array('text' => '<b>' . __('New Zone','wosci-language') . '</b>');

        $contents = array('form' => tep_draw_form('zones', 'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '&action=insert_zone'));
        $contents[] = array('text' => __('Please enter the new zone information','wosci-language'));
        $contents[] = array('text' => '<br>' . __('Zone Name','wosci-language') . '<br>' . tep_draw_input_field('geo_zone_name'));
        $contents[] = array('text' => '<br>' . __('Description','wosci-language') . '<br>' . tep_draw_input_field('geo_zone_description'));
        $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Insert').'" class="button" /> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $_GET['zID'] . '">'. __('Cancel','wosci-language').'</a>');
        break;
      case 'edit_zone':
        $heading[] = array('text' => '<b>' . __('Edit Zone','wosci-language') . '</b>');

        $contents = array('form' => tep_draw_form('zones', 'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=save_zone'));
        $contents[] = array('text' => __('Please make any necessary changes','wosci-language'));
        $contents[] = array('text' => '<br>' . __('Zone Name','wosci-language') . '<br>' . tep_draw_input_field('geo_zone_name', $zInfo->geo_zone_name));
        $contents[] = array('text' => '<br>' . __('Description','wosci-language') . '<br>' . tep_draw_input_field('geo_zone_description', $zInfo->geo_zone_description));
        $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Update').'" class="button" /> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '">'. __('Cancel','wosci-language').'</a>');
        break;
      case 'delete_zone':
        $heading[] = array('text' => '<b>' . __('Delete Zone','wosci-language') . '</b>');

        $contents = array('form' => tep_draw_form('zones', 'admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=deleteconfirm_zone'));
        $contents[] = array('text' => __('Are you sure you want to delete this zone?','wosci-language'));
        $contents[] = array('text' => '<br><b>' . $zInfo->geo_zone_name . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<br><input type="submit" value="'. __('Remove','wosci-language').'" class="button" /> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '">'. __('Cancel','wosci-language').'</a>');
        break;
      default:
        if (isset($zInfo) && is_object($zInfo)) {
          $heading[] = array('text' => '<b>' . $zInfo->geo_zone_name . '</b>');

          $contents[] = array('align' => 'center', 'text' => '<a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=edit_zone' . '">'. __('Edit').'</a> <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=delete_zone' . '">'. __('Delete').'</a>' . ' <a class="button" href="admin.php?page=tax_zones&zpage=' . $_GET['zpage'] . '&zID=' . $zInfo->geo_zone_id . '&action=list' . '">'. __('Details','wosci-language').'</a>');
          $contents[] = array('text' => '<br>' . __('Number of Zones','wosci-language') . ': ' . $zInfo->num_zones);
          $contents[] = array('text' => '<br>' . __('Date Added','wosci-language') . ': ' . tep_date_short($zInfo->date_added));
          if (tep_not_null($zInfo->last_modified)) $contents[] = array('text' => __('Last Modified','wosci-language') . ': ' . tep_date_short($zInfo->last_modified));
          $contents[] = array('text' => '<br>' . __('Description','wosci-language') . '<br>' . $zInfo->geo_zone_description);
        }
        break;
    }
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents,'');

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
}

add_action('admin_menu', 'tax_zones');






/* PRODUCT ATTRIBUTES */ 

function product_attributes_menu(){
	add_menu_page('Product Attr.', 'Product Attr.', 'activate_plugins', 'product_attributes', 'func_product_attributes','div');
//	add_submenu_page( 'currencies', 'Order Status', 'Order Status', 'activate_plugins', 'order_status', 'func_order_status' );


}

function func_product_attributes(){

  $languages_id =1;

  $languages = tep_get_languages();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $option_page = (isset($_GET['option_page']) && is_numeric($_GET['option_page'])) ? $_GET['option_page'] : 1;
  $value_page = (isset($_GET['value_page']) && is_numeric($_GET['value_page'])) ? $_GET['value_page'] : 1;
  $attribute_page = (isset($_GET['attribute_page']) && is_numeric($_GET['attribute_page'])) ? $_GET['attribute_page'] : 1;

  $page_info = 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page;

  if (tep_not_null($action)) {
    switch ($action) {
      case 'add_product_options':
        $products_options_id = tep_db_prepare_input($_POST['products_options_id']);
        $option_name_array = $_POST['option_name'];

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $option_name = tep_db_prepare_input($option_name_array[$languages[$i]['id']]);

          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, products_options_name, language_id) values ('" . (int)$products_options_id . "', '" . tep_db_input($option_name) . "', '" . (int)$languages[$i]['id'] . "')");
        }
        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'add_product_option_values':
        $value_name_array = $_POST['value_name'];
        $value_id = tep_db_prepare_input($_POST['value_id']);
        $option_id = tep_db_prepare_input($_POST['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $value_name = tep_db_prepare_input($value_name_array[$languages[$i]['id']]);

          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$value_id . "', '" . (int)$languages[$i]['id'] . "', '" . tep_db_input($value_name) . "')");
        }

        tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . (int)$option_id . "', '" . (int)$value_id . "')");

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'add_product_attributes':
        $products_id = tep_db_prepare_input($_POST['products_id']);
        $options_id = tep_db_prepare_input($_POST['options_id']);
        $values_id = tep_db_prepare_input($_POST['values_id']);
        $value_price = tep_db_prepare_input($_POST['value_price']);
        $price_prefix = tep_db_prepare_input($_POST['price_prefix']);

        tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values (null, '" . (int)$products_id . "', '" . (int)$options_id . "', '" . (int)$values_id . "', '" . (float)tep_db_input($value_price) . "', '" . tep_db_input($price_prefix) . "')");

        if (DOWNLOAD_ENABLED == 'true') {
          $products_attributes_id = tep_db_insert_id();

          $products_attributes_filename = tep_db_prepare_input($_POST['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($_POST['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($_POST['products_attributes_maxcount']);

          if (tep_not_null($products_attributes_filename)) {
            tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . (int)$products_attributes_id . ", '" . tep_db_input($products_attributes_filename) . "', '" . tep_db_input($products_attributes_maxdays) . "', '" . tep_db_input($products_attributes_maxcount) . "')");
          }
        }

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'update_option_name':
        $option_name_array = $_POST['option_name'];
        $option_id = tep_db_prepare_input($_POST['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $option_name = tep_db_prepare_input($option_name_array[$languages[$i]['id']]);

          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_name = '" . tep_db_input($option_name) . "' where products_options_id = '" . (int)$option_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
        }

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'update_value':
        $value_name_array = $_POST['value_name'];
        $value_id = tep_db_prepare_input($_POST['value_id']);
        $option_id = tep_db_prepare_input($_POST['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $value_name = tep_db_prepare_input($value_name_array[$languages[$i]['id']]);

          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES . " set products_options_values_name = '" . tep_db_input($value_name) . "' where products_options_values_id = '" . tep_db_input($value_id) . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
        }

        tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " set products_options_id = '" . (int)$option_id . "'  where products_options_values_id = '" . (int)$value_id . "'");

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'update_product_attribute':
        $products_id = tep_db_prepare_input($_POST['products_id']);
        $options_id = tep_db_prepare_input($_POST['options_id']);
        $values_id = tep_db_prepare_input($_POST['values_id']);
        $value_price = tep_db_prepare_input($_POST['value_price']);
        $price_prefix = tep_db_prepare_input($_POST['price_prefix']);
        $attribute_id = tep_db_prepare_input($_POST['attribute_id']);

        tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_id = '" . (int)$products_id . "', options_id = '" . (int)$options_id . "', options_values_id = '" . (int)$values_id . "', options_values_price = '" . (float)tep_db_input($value_price) . "', price_prefix = '" . tep_db_input($price_prefix) . "' where products_attributes_id = '" . (int)$attribute_id . "'");

        if (DOWNLOAD_ENABLED == 'true') {
          $products_attributes_filename = tep_db_prepare_input($_POST['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($_POST['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($_POST['products_attributes_maxcount']);

          if (tep_not_null($products_attributes_filename)) {
            tep_db_query("replace into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " set products_attributes_id = '" . (int)$attribute_id . "', products_attributes_filename = '" . tep_db_input($products_attributes_filename) . "', products_attributes_maxdays = '" . tep_db_input($products_attributes_maxdays) . "', products_attributes_maxcount = '" . tep_db_input($products_attributes_maxcount) . "'");
          }
        }

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'delete_option':
        $option_id = tep_db_prepare_input($_GET['option_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$option_id . "'");

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'delete_value':
        $value_id = tep_db_prepare_input($_GET['value_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$value_id . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$value_id . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_values_id = '" . (int)$value_id . "'");

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
      case 'delete_attribute':
        $attribute_id = tep_db_prepare_input($_GET['attribute_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . (int)$attribute_id . "'");

// added for DOWNLOAD_ENABLED. Always try to remove attributes, even if downloads are no longer enabled
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$attribute_id . "'");

        wp_redirect('admin.php?page=product_attributes&'. $page_info);
        break;
    }
  }
  
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
<!-- options and values//-->
      <tr>
        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- options //-->
<?php
  if ($action == 'delete_product_option') { // delete product option
    $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$_GET['option_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $options_values = tep_db_fetch_array($options);
?>
              <tr>
                <td class="pageHeading">&nbsp;<?php echo $options_values['products_options_name']; ?>&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="3"><hr></td>
                  </tr>
<?php
    $products = tep_db_query("select p.ID, p.post_title, pov.products_options_values_name from wp_posts p, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where p.post_status = 'publish' and p.post_type = 'product' and pov.language_id = '" . (int)$languages_id . "' and pa.products_id = p.ID and pa.options_id='" . (int)$_GET['option_id'] . "' and pov.products_options_values_id = pa.options_values_id order by p.post_title");
    if (tep_db_num_rows($products)) {
?>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo __('ID','wosci-language'); ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo __('Product','wosci-language'); ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo __('Option Value','wosci-language'); ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3"><hr></td>
                  </tr>
<?php
      $rows = 0;
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
?>
                  <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                    <td align="center" class="smallText">&nbsp;<?php echo $products_values['ID']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['post_title']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_options_values_name']; ?>&nbsp;</td>
                  </tr>
<?php
      }
?>
                  <tr>
                    <td colspan="3"><hr></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="main"><br /><?php echo __('This option has products and values linked to it - it is not safe to delete it.','wosci-language'); ?></td>
                  </tr>
                  <tr>
                    <td align="right" colspan="3" class="smallText"><br /><?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. $page_info.'" class="button-secondary">' . __('Back','wosci-language') . '</a>'; ?>&nbsp;</td>
                  </tr>
<?php
    } else {
?>
                  <tr>
                    <td class="main" colspan="3"><br /><?php echo __('This option has no products and values linked to it - it is safe to delete it.','wosci-language'); ?></td>
                  </tr>
                  <tr>
                    <td class="smallText" align="right" colspan="3"><br /><?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. 'action=delete_option&option_id=' . $_GET['option_id'] . '&' . $page_info.'" class="button-secondary">' . __('Delete','wosci-language') . '</a>' . '<a accesskey="c" href="admin.php?page=product_attributes&'. $page_info.'" class="button-secondary">' . __('Cancel','wosci-language') . '</a>'; ?>&nbsp;</td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
<?php
  } else {
?>
              <tr>
                <td colspan="3"><div id="icon-edit" class="icon32 icon32-posts-post"><br></div><h2><?php echo __('Product Options','wosci-language'); ?></h2></td>
              </tr>
              <tr>
                <td colspan="3" class="smallText" align="right">
<?php
    $options = "select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages_id . "' order by products_options_id";
//    $options_split = new splitPageResults($option_page, MAX_ROW_LISTS_OPTIONS, $options, $options_query_numrows);

//    echo $options_split->display_links($options_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $option_page, 'value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'option_page');
?>
                </td>
              </tr>
              <tr>
                <td colspan="3"><hr></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo __('ID','wosci-language'); ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo __('Option Name','wosci-language'); ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo __('Action','wosci-language'); ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><hr></td>
              </tr>
<?php
    $next_id = 1;
    $rows = 0;
    $options = tep_db_query($options);
    while ($options_values = tep_db_fetch_array($options)) {
      $rows++;
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      if (($action == 'update_option') && ($_GET['option_id'] == $options_values['products_options_id'])) {
        echo '<form name="option" action="admin.php?page=product_attributes&'. 'action=update_option_name&' . $page_info . '" method="post">';
        $inputs = '';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $option_name = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $options_values['products_options_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
          $option_name = tep_db_fetch_array($option_name);
          $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="20" value="' . $option_name['products_options_name'] . '">&nbsp;<br />';
        }
?>
                <td align="center" class="smallText">&nbsp;<?php echo $options_values['products_options_id']; ?><input type="hidden" name="option_id" value="<?php echo $options_values['products_options_id']; ?>">&nbsp;</td>
                <td class="smallText"><?php echo $inputs; ?></td>
                <td align="center" class="smallText">&nbsp;<input type="submit" name="" id="doaction" class="button action" value="<?php echo __('Save','wosci-language'); ?>"><?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. $page_info.'" class="button-secondary">' . __('Cancel','wosci-language') . '</a>'; ?>&nbsp;</td>
<?php
        echo '</form>' . "\n";
      } else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo $options_values["products_options_id"]; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $options_values["products_options_name"]; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. 'action=update_option&option_id=' . $options_values['products_options_id'] . '&' . $page_info.'" class="button-secondary">' . __('Edit','wosci-language') . '</a> <a href="admin.php?page=product_attributes&action=delete_product_option&option_id=' . $options_values['products_options_id'] . '&' . $page_info.'" class="button-secondary">' . __('Delete','wosci-language') . '</a>'; ?>&nbsp;</td>
<?php
      }
?>
              </tr>
<?php
      $max_options_id_query = tep_db_query("select max(products_options_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS);
      $max_options_id_values = tep_db_fetch_array($max_options_id_query);
      $next_id = $max_options_id_values['next_id'];
    }
?>
              <tr>
                <td colspan="3"><hr></td>
              </tr>
<?php
    if ($action != 'update_option') {
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      echo '<form name="options" action="admin.php?page=product_attributes&'. 'action=add_product_options&' . $page_info . '" method="post"><input type="hidden" name="products_options_id" value="' . $next_id . '">';
      $inputs = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="20">&nbsp;<br />';
      }
?>
                <td align="center" class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
                <td class="smallText"><?php echo $inputs; ?></td>
                <td align="center" class="smallText">&nbsp;<input type="submit" name="" id="doaction" class="button action" value="<?php echo __('Insert','wosci-language'); ?>">&nbsp;</td>
<?php
      echo '</form>';
?>
              </tr>
              <tr>
                <td colspan="3"><hr></td>
              </tr>
<?php
    }
  }
?>
            </table></td>
<!-- options eof //-->
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- value //-->
<?php
  if ($action == 'delete_option_value') { // delete product option value
    $values = tep_db_query("select products_options_values_id, products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$_GET['value_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $values_values = tep_db_fetch_array($values);
?>
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;<?php echo $values_values['products_options_values_name']; ?>&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="3"><hr></td>
                  </tr>
<?php
    $products = tep_db_query("select p.ID, p.post_title, pov.products_options_values_name from wp_posts p, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where p.post_status = 'publish' and p.post_type = 'product' and pov.language_id = '" . (int)$languages_id . "' and pa.products_id = p.ID and pa.options_id='" . (int)$_GET['option_id'] . "' and pov.products_options_values_id = pa.options_values_id order by p.post_title");
    if (tep_db_num_rows($products)) {
?>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo __('ID','wosci-language'); ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo __('Product','wosci-language'); ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo __('Option Name','wosci-language'); ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3"><hr></td>
                  </tr>
<?php
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
?>
                  <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                    <td align="center" class="smallText">&nbsp;<?php echo $products_values['ID']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['post_title']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_options_name']; ?>&nbsp;</td>
                  </tr>
<?php
      }
?>
                  <tr>
                    <td colspan="3"><hr></td>
                  </tr>
                  <tr>
                    <td class="main" colspan="3"><br /><?php echo __('This option has products and values linked to it - it is not safe to delete it.','wosci-language'); ?></td>
                  </tr>
                  <tr>
                    <td class="smallText" align="right" colspan="3"><br /><?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. $page_info .'" class="button-secondary">' . __('Back','wosci-language') . '</a>'; ?>&nbsp;</td>
                  </tr>
<?php
    } else {
?>
                  <tr>
                    <td class="main" colspan="3"><br /><?php echo __('This option has no products and values linked to it - it is safe to delete it.','wosci-language'); ?></td>
                  </tr>
                  <tr>
                    <td class="smallText" align="right" colspan="3"><br /><?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. 'action=delete_value&value_id=' . $_GET['value_id'] . '&' . $page_info.'" class="button-secondary">' . __('Delete','wosci-language') . '</a> <a accesskey="c" href="admin.php?page=product_attributes&'. $page_info .'" class="button-secondary">' . __('Cancel','wosci-language') . '</a>'; ?>&nbsp;</td>
                  </tr>
<?php
    }
?>
              	</table></td>
              </tr>
<?php
  } else {
?>
              <tr>
                <td colspan="4" class=""><h2><?php echo __('Option Values','wosci-language'); ?></h2></td>
              </tr>
              <tr>
                <td colspan="4" class="smallText" align="right">
<?php
    $values = "select pov.products_options_values_id, pov.products_options_values_name, pov2po.products_options_id from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov left join " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po on pov.products_options_values_id = pov2po.products_options_values_id where pov.language_id = '" . (int)$languages_id . "' order by pov.products_options_values_id";
//    $values_split = new splitPageResults($value_page, MAX_ROW_LISTS_OPTIONS, $values, $values_query_numrows);

//    echo $values_split->display_links($values_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $value_page, 'option_page=' . $option_page . '&attribute_page=' . $attribute_page, 'value_page');
?>
                </td>
              </tr>
              <tr>
                <td colspan="4"><hr></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo __('ID','wosci-language'); ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo __('Option Name','wosci-language'); ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo __('Option Value','wosci-language'); ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo __('Action','wosci-language'); ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><hr></td>
              </tr>
<?php
    $next_id = 1;
    $rows = 0;
    $values = tep_db_query($values);
    while ($values_values = tep_db_fetch_array($values)) {
      $options_name = tep_options_name($values_values['products_options_id']);
      $values_name = $values_values['products_options_values_name'];
      $rows++;
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      if (($action == 'update_option_value') && ($_GET['value_id'] == $values_values['products_options_values_id'])) {
        echo '<form name="values" action="admin.php?page=product_attributes&'. 'action=update_value&' . $page_info . '" method="post">';
        $inputs = '';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $value_name = tep_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_values['products_options_values_id'] . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          $value_name = tep_db_fetch_array($value_name);
          $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15" value="' . $value_name['products_options_values_name'] . '">&nbsp;<br />';
        }
?>
                <td align="center" class="smallText">&nbsp;<?php echo $values_values['products_options_values_id']; ?><input type="hidden" name="value_id" value="<?php echo $values_values['products_options_values_id']; ?>">&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo "\n"; ?><select name="option_id">
<?php
        $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages_id . "' order by products_options_name");
        while ($options_values = tep_db_fetch_array($options)) {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '"';
          if ($values_values['products_options_id'] == $options_values['products_options_id']) { 
            echo ' selected';
          }
          echo '>' . $options_values['products_options_name'] . '</option>';
        } 
?>
                </select>&nbsp;</td>
                <td class="smallText"><?php echo $inputs; ?></td>
                <td align="center" class="smallText">&nbsp;<input type="submit" name="" id="doaction" class="button action" value="<?php echo __('Save','wosci-language'); ?>"><?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. $page_info, 'NONSSL'.'" class="button-secondary">' . __('Cancel','wosci-language') . '</a>'; ?>&nbsp;</td>
<?php
        echo '</form>';
      } else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo $values_values["products_options_values_id"]; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. 'action=update_option_value&value_id=' . $values_values['products_options_values_id'] . '&' . $page_info .'" class="button-secondary">Edit</a> <a accesskey="c" href="admin.php?page=product_attributes&'. 'action=delete_option_value&value_id=' . $values_values['products_options_values_id'] . '&' . $page_info .'" class="button-secondary">' . __('Delete','wosci-language') . '</a>'; ?>&nbsp;</td>
<?php
      }
      $max_values_id_query = tep_db_query("select max(products_options_values_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS_VALUES);
      $max_values_id_values = tep_db_fetch_array($max_values_id_query);
      $next_id = $max_values_id_values['next_id'];
    }
?>
              </tr>
              <tr>
                <td colspan="4"><hr></td>
              </tr>
<?php
    if ($action != 'update_option_value') {
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      echo '<form name="values" action="admin.php?page=product_attributes&'. 'action=add_product_option_values&' . $page_info . '" method="post">';
?>
                <td align="center" class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<select name="option_id">
<?php
      $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while ($options_values = tep_db_fetch_array($options)) {
        echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
      }

      $inputs = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15">&nbsp;<br />';
      }
?>
                </select>&nbsp;</td>
                <td class="smallText"><input type="hidden" name="value_id" value="<?php echo $next_id; ?>"><?php echo $inputs; ?></td>
                <td align="center" class="smallText">&nbsp;<input type="submit" name="" id="doaction" class="button action" value="<?php echo __('Insert','wosci-language'); ?>">&nbsp;</td>
<?php
      echo '</form>';
?>
              </tr>
              <tr>
                <td colspan="4"><hr></td>
              </tr>
<?php
    }
  }
?>
            </table></td>
          </tr>
        </table></td>
<!-- option value eof //-->
      </tr> 
<!-- products_attributes //-->  
      <tr>
        <td class="smallText">&nbsp;</td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class=""><h2><?php echo __('Products Attributes','wosci-language'); ?></h2></td>
          </tr>
        </table></td>
      </tr>
      <tr>
<?php
  if ($action == 'update_attribute') {
    $form_action = 'update_product_attribute';
  } else {
    $form_action = 'add_product_attributes';
  }
?>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText" align="right">
<?php
  $attributes = "select p.ID, p.post_title, pa.* from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join wp_posts p on pa.products_id = p.ID and p.post_status = 'publish' and p.post_type = 'product' order by p.post_title";
//  $attributes_split = new splitPageResults($attribute_page, MAX_ROW_LISTS_OPTIONS, $attributes, $attributes_query_numrows);

 // echo $attributes_split->display_links($attributes_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $attribute_page, 'option_page=' . $option_page . '&value_page=' . $value_page, 'attribute_page');
?>
            </td>
          </tr>
        </table>
        <form name="attributes" action="<?php echo 'admin.php?page=product_attributes&'. 'action=' . $form_action . '&' . $page_info; ?>" method="post"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="7"><hr></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent">&nbsp;<?php echo __('ID','wosci-language'); ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo __('Product','wosci-language'); ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo __('Option Name','wosci-language'); ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo __('Option Value','wosci-language'); ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo __('Option Price','wosci-language'); ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo __('Price Prefix','wosci-language'); ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo __('Action','wosci-language'); ?>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7"><hr></td>
          </tr>
<?php
  $next_id = 1;
  $attributes = tep_db_query($attributes); 
  while ($attributes_values = tep_db_fetch_array($attributes)) {

    $products_name_only = $attributes_values['post_title'];//tep_get_products_name($attributes_values['ID']);
    $options_name = tep_options_name($attributes_values['options_id']);
    $values_name = tep_values_name($attributes_values['options_values_id']);
    $rows++;
?>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
    if (($action == 'update_attribute') && ($_GET['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values['products_attributes_id']; ?><input type="hidden" name="attribute_id" value="<?php echo $attributes_values['products_attributes_id']; ?>">&nbsp;</td>
            <td class="smallText">&nbsp;<select name="products_id">
<?php
      $products = tep_db_query("select p.ID, p.post_title from wp_posts p where p.post_type='product' and p.post_status='publish' order by p.post_title");
      while($products_values = tep_db_fetch_array($products)) {
        if ($attributes_values['products_id'] == $products_values['ID']) {
          echo "\n" . '<option name="' . $products_values['post_title'] . '" value="' . $products_values['ID'] . '" SELECTED>' . $products_values['post_title'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $products_values['post_title'] . '" value="' . $products_values['ID'] . '">' . $products_values['post_title'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
      $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while($options_values = tep_db_fetch_array($options)) {
        if ($attributes_values['options_id'] == $options_values['products_options_id']) {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '" SELECTED>' . $options_values['products_options_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
      $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id ='" . $languages_id . "' order by products_options_values_name");
      while($values_values = tep_db_fetch_array($values)) {
        if ($attributes_values['options_values_id'] == $values_values['products_options_values_id']) {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '" SELECTED>' . $values_values['products_options_values_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
        }
      } 
?>        
            </select>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" value="<?php echo $attributes_values['options_values_price']; ?>" size="6">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="price_prefix" value="<?php echo $attributes_values['price_prefix']; ?>" size="2">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="submit" name="" id="doaction" class="button action" value="<?php echo __('Save','wosci-language'); ?>"><?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. $page_info, 'NONSSL'.'" class="button-secondary">' . __('Cancel','wosci-language') . '</a>'; ?>&nbsp;</td>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $download_query_raw ="select products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount 
                              from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                              where products_attributes_id='" . $attributes_values['products_attributes_id'] . "'";
        $download_query = tep_db_query($download_query_raw);
        if (tep_db_num_rows($download_query) > 0) {
          $download = tep_db_fetch_array($download_query);
          $products_attributes_filename = $download['products_attributes_filename'];
          $products_attributes_maxdays  = $download['products_attributes_maxdays'];
          $products_attributes_maxcount = $download['products_attributes_maxcount'];
        }
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="5">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      }
?>
<?php
    } elseif (($action == 'delete_product_attribute') && ($_GET['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<strong><?php echo $attributes_values["products_attributes_id"]; ?></strong>&nbsp;</td>
            <td class="smallText">&nbsp;<strong><?php echo $products_name_only; ?></strong>&nbsp;</td>
            <td class="smallText">&nbsp;<strong><?php echo $options_name; ?></strong>&nbsp;</td>
            <td class="smallText">&nbsp;<strong><?php echo $values_name; ?></strong>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<strong><?php echo $attributes_values["options_values_price"]; ?></strong>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<strong><?php echo $attributes_values["price_prefix"]; ?></strong>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo '<a accesskey="c" href="admin.php?page=product_attributes&action=delete_attribute&attribute_id=' . $_GET['attribute_id'] . '&' . $page_info . '" class="button-secondary">Delete</a> <a accesskey="c" href="admin.php?page=product_attributes&'. $page_info.'" class="button-secondary">' . __('Cancel','wosci-language') . '</a>'; ?>&nbsp;</td>
<?php
    } else {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values["products_attributes_id"]; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $products_name_only; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo $attributes_values["options_values_price"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["price_prefix"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo '<a accesskey="c" href="admin.php?page=product_attributes&'. 'action=update_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&' . $page_info .'" class="button-secondary">' . __('Edit', 'wosci-language') . '</a> <a accesskey="c" href="admin.php?page=product_attributes&action=delete_product_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&' . $page_info.'" class="button-secondary">' . __('Delete','wosci-language') . '</a>'; ?>&nbsp;</td>
<?php
    }
    $max_attributes_id_query = tep_db_query("select max(products_attributes_id) + 1 as next_id from " . TABLE_PRODUCTS_ATTRIBUTES);
    $max_attributes_id_values = tep_db_fetch_array($max_attributes_id_query);
    $next_id = $max_attributes_id_values['next_id'];
?>
          </tr>
<?php
  }
  if ($action != 'update_attribute') {
?>
          <tr>
            <td colspan="7"><hr></td>
          </tr>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
            <td class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
      	    <td class="smallText">&nbsp;<select name="products_id">
<?php
    $products = tep_db_query("select p.ID, p.post_title from wp_posts p where p.post_type='product' and p.post_status='publish' order by p.post_title");
    while ($products_values = tep_db_fetch_array($products)) {
      echo '<option name="' . $products_values['post_title'] . '" value="' . $products_values['ID'] . '">' . $products_values['post_title'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
    $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
    $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . $languages_id . "' order by products_options_values_name");
    while ($values_values = tep_db_fetch_array($values)) {
      echo '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" size="6">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="price_prefix" size="2" value="+">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="submit" name="" id="doaction" class="button action" value="<?php echo __('Add+','wosci-language'); ?>">&nbsp;</td>
          </tr>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $products_attributes_maxdays  = DOWNLOAD_MAX_DAYS;
        $products_attributes_maxcount = DOWNLOAD_MAX_COUNT;
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="5">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      } // end of DOWNLOAD_ENABLED section
?>
<?php
  }
?>
          <tr>
            <td colspan="7"><hr></td>
          </tr>
        </table></form></td>
      </tr>
    </table>

<?php
}


add_action('admin_menu', 'product_attributes_menu');



function my_delete_user( $user_id ) {
	global $wpdb;

	
        $wpdb->query("delete from address_book where customers_id = '" . (int)$user_id . "'");
//        $wpdb->query("delete from customers where customers_id = '" . (int)$id . "'");
//        $wpdb->query("delete from customers_info where customers_info_id = '" . (int)$id . "'");
        $wpdb->query("delete from customers_basket where customers_id = '" . (int)$user_id . "'");
        $wpdb->query("delete from customers_basket_attributes where customers_id = '" . (int)$user_id . "'");
        $wpdb->query("delete from whos_online where customer_id = '" . (int)$user_id . "'");

}
add_action( 'delete_user', 'my_delete_user' );






add_action( 'user_register', 'my_create_user' );
function my_create_user( $user_id ) {
	global $wpdb;

$sql_data_array = array('customers_id' => $user_id,
                              'entry_firstname' => '---',
                              'entry_lastname' => '---',
                              'entry_street_address' => '---',
                              'entry_postcode' => '---',
                              'entry_city' => '---',
                              'entry_country_id' => '1');
 
      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = '---';
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = '---';
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = '---';
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = '---';
          $sql_data_array['entry_state'] = '---';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = '---';
        }
      }
 
	tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
 
	$address_id = tep_db_insert_id();
	update_user_meta( $user_id, 'customer_default_address_id', $address_id );

}


add_action("wp_ajax_add_to_wishlist", "add_to_wishlist");
add_action("wp_ajax_nopriv_add_to_wishlist", "add_to_wishlist");

function add_to_wishlist () {
global $current_user;

if ( !wp_verify_nonce( $_POST['nonce'], "add_to_wish_list_nonce")) {
		exit("No naughty business please");
	}

$user_wishlist = get_user_meta( $current_user->ID, 'customer_wishlist' ); 

$result['btn'] = 'btn-default';
$result['text'] = '';
if(empty($user_wishlist[0])){
update_user_meta( $current_user->ID, 'customer_wishlist',  serialize(array('0', $_POST['pID'])) );
$result['btn'] = 'btn-success';
$result['text'] = __('Added to wishlist', 'wosci-language');
}else{
$uswl = unserialize($user_wishlist[0]);
if( !in_array($_POST['pID'], $uswl) ){
$uswl[] = $_POST['pID']; 
update_user_meta( $current_user->ID, 'customer_wishlist', serialize($uswl) );
$result['btn'] = 'btn-success';
$result['text'] = __('Added to wishlist', 'wosci-language');
}

}

if ( $current_user->ID == '0') {

$result['btn'] = 'btn-danger';
$result['text'] = __('Please login', 'wosci-language');
}

$result['result'] = __('Success', 'wosci-language');
$result['uswl'] = $uswl;

//$result['shipping_modules'] = json_encode($result['shipping_modules']);
$result = json_encode($result);
echo $result;

die();

}


add_action("wp_ajax_nopriv_remove_from_wishlist", "remove_from_wishlist");
add_action("wp_ajax_remove_from_wishlist", "remove_from_wishlist");


function remove_from_wishlist () {
global $current_user;
$user_wishlist = get_user_meta( $current_user->ID, 'customer_wishlist' ); 

$result['btn'] = 'btn-default';
$result['text'] = '';

$uswl = unserialize($user_wishlist[0]);
if( !is_array($uswl) && count($uswl) == 1 ){ $uswl = array($uswl); }
if( in_array($_POST['pID'], $uswl) ){

$uswl = array_values($uswl);
$key = array_search( $_POST['pID'] , $uswl );
unset($uswl[$key]); 
update_user_meta( $current_user->ID, 'customer_wishlist', serialize($uswl) );


}
$result['emptytext'] = '';
if(count($uswl) == 0){ $result['emptytext'] = __('Your wishlist empty.', 'wosci-language'); }
$result['wl_qty'] = count($uswl);
$result['text'] = __('Product removed from wishlist', 'wosci-language');
$result['uswl'] = $uswl;

//$result['shipping_modules'] = json_encode($result['shipping_modules']);
$result = json_encode($result);
echo $result;

die();

}

add_filter( 'show_admin_bar', '__return_false' );


?>
