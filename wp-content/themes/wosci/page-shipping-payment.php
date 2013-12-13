<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/


//require('/includes/application_top.php');




//$check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id, customers_group_id, customers_specific_taxes_exempt from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($current_user->user_email) . "'");
  
//$check_customer = tep_db_fetch_array($check_customer_query);
$cdai = get_user_meta($current_user->ID, 'customer_default_address_id');
$customer_default_address_id = $cdai[0]; //$check_customer['customers_default_address_id'];


tep_session_register('customer_default_address_id');


// if the customer is not logged on, redirect them to the login page
  if ($current_user->ID =='0') {
//    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, 'redirect_to=shipping-payment', 'SSL'));
  }

 
   if ( empty($customer_default_address_id) ) {
    tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'returnto=checkout_shipping.php', 'SSL'));
  }
 


// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link('cart'));
  }

// if no shipping destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('sendto')) {
    tep_session_register('sendto');
    $sendto = $customer_default_address_id;

  } else {
// verify the selected shipping address
    if ( (is_array($sendto) && empty($sendto)) || is_numeric($sendto) ) {
      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$current_user->ID . "' and address_book_id = '" . (int)$sendto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $sendto = $customer_default_address_id;
        if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');
      }
    }
  }



 
  $order = new order;

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!tep_session_is_registered('cartID')) tep_session_register('cartID');
  $cartID = $cart->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
  if ($order->content_type == 'virtual') {
    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
    $shipping = false;
    $sendto = false;
    //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// load all enabled shipping modules

  $shipping_modules = new shipping;

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
  
 
if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');
// process the selected shipping method
  if ( isset($_POST['action']) && ($_POST['action'] == 'process') ) {}
    if (!tep_session_is_registered('osc_comments')) tep_session_register('osc_comments');
    if (tep_not_null($_POST['osc_comments'])) {
      $osc_comments = tep_db_prepare_input($_POST['osc_comments']);
    }

    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');

    if ( (tep_count_shipping_modules() > 0) || ($free_shipping == true) ) {
      if ( (isset($_POST['shipping'])) && (strpos($_POST['shipping'], '_')) ) {
        $shipping = $_POST['shipping'];

        list($module, $method) = explode('_', $shipping);
        if ( is_object($$module) || ($shipping == 'free_free') ) {
          if ($shipping == 'free_free') {
            $quote[0]['methods'][0]['title'] = __('Free Shipping', 'wosci-language');
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          if (isset($quote['error'])) {
            tep_session_unregister('shipping');
          } else {
            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
              $shipping = array('id' => $shipping,
                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                'cost' => $quote[0]['methods'][0]['cost']);

              //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
      }
    } else {
      $shipping = false;
                
     // tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }    
  

// get all available shipping quotes
  $quotes = $shipping_modules->quote();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled
  if ( !tep_session_is_registered('shipping') || ( tep_session_is_registered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) ) $shipping = $shipping_modules->cheapest();

//P
  if ($current_user->ID =='0') {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link('cart'));
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    //tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      //tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (tep_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
        tep_redirect(tep_href_link('cart'));
        break;
      }
    }
  }

// if no billing destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('billto')) {
    tep_session_register('billto');
    $billto = $customer_default_address_id;
  } else {
// verify the selected billing address
    if ( (is_array($billto) && empty($billto)) || is_numeric($billto) ) {
      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$current_user->ID . "' and address_book_id = '" . (int)$billto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $billto = $customer_default_address_id;
        if (tep_session_is_registered('payment')) tep_session_unregister('payment');
      }
    }
  }
  if (!tep_session_is_registered('sendto')) {
    //  tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }
  



  if (!tep_session_is_registered('osc_comments')) tep_session_register('osc_comments');
  if (isset($_POST['osc_comments']) && tep_not_null($_POST['osc_comments'])) {
    $osc_comments = tep_db_prepare_input($_POST['osc_comments']);
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// load all enabled payment modules

  $payment_modules = new payment;

//P

get_header();


?>
<script src="<?php echo get_bloginfo('template_url');?>/jquery.easing.1.3.js"></script>
<script src="<?php echo get_bloginfo('template_url');?>/jquery.easing.compatibility.js"></script>


<script src="<?php echo get_bloginfo('template_url');?>/jquery.keypad.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url');?>/jquery.keypad.css">

<script type="text/javascript">
jQuery(document).ready(function(){

jQuery('#yeni_adres_ekle').click(function () {

	jQuery('#myModal .modal-body').append('<img id="loading-line" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">');
	jQuery('#newSAddress  #loading-line').remove(); 

    });

jQuery('#edit_shipping_address').click(function () {

	//jQuery('#myModal2 .modal-body').append('<img id="loading-line" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">');
	
	var spins = [
"■.",
"◢◣◤◥",
"▉▍▎▊",
"+ + +",
    "◐ ◓ ◑ ◒",
    "◡◡ ⊙⊙ ◠◠",
    ".oOo"
];

    var spin = spins[0],
        title = jQuery('#myModal2 .modal-body'),
        i=0;

    var aaa = setInterval(function() {
        i = i==spin.length-1 ? 0 : ++i;
        title.text( spin[i] );
    },50);
	
	jQuery('#editSAddress  #loading-line').remove();// üstteki yükleniyoru sonradan yüklenen modalde kalinti olmamasi için sildik
	
	var addrID2 =jQuery('#edit_shipping_address').attr("href");
	jQuery("#myModal2").modal({
	        remote: addrID2,
	        refresh: true
	});
	

	var target = addrID2;
	
	jQuery("#myModal2").load(target, function() { 
	jQuery("#myModal2").modal("show"); 
	
	});

});

jQuery('#new_payment_address').click(function () {

	jQuery('#myModal4 .modal-body').append('<img id="loading-line" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">');
	jQuery('#newPAddress  #loading-line').remove();

    });

jQuery('#edit_payment_address').click(function () {
	
	jQuery('#myModal3 .modal-body').append('<img id="loading-line" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">');
	jQuery('#editSAddress  #loading-line').remove();

    });




jQuery('.shipping_row').live( "click", function() {

	jQuery('.shipping_row').css('background-color', '');
	jQuery('#selectedshipment').css('background-color', '');
	jQuery('.shipping_row h5').css('font-weight', 'normal');
	jQuery("input", this).prop('checked', true);
 	jQuery(this).css('background-color', '#f5f5f7');
	jQuery("h5", this).css('font-weight', 'bold');
 
 });


jQuery('.paymenttable tr').click(function () {

	jQuery('.moduleRowP').hide();
	//jQuery('.moduleRowP',this).toggle();
	jQuery('.moduleRowP',this).show();
	jQuery('.moduleRowP').css("height","");
	
	
	
	jQuery('.moduleRowP',this).animate({height:190}, {duration: 500, easing: 'easeOutBack'}).animate({height:190}, {duration: 0, easing: 'easeOutElastic'});


	
	jQuery(this).find('input').prop('checked', true);
	jQuery('.moduletitle').css('font-weight', '');
	jQuery('.moduletitle',this).css('font-weight', 'bold');
	jQuery('.paymenttable tr').css('background-color', '');
	jQuery(this).css('background-color', '#f5f5f7');

});

jQuery('#edit_payment_address').click(function () {

	//jQuery('#myModal3 .modal-body').append('<img id="loading-line" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">');
	jQuery('#editPAddress  #loading-line').remove();// üstteki yükleniyoru sonradan yüklenen modalde kalinti olmamasi için sildik
	
		var spins = [
"■.",
"◢◣◤◥",
"▉▍▎▊",
"+ + +",
    "◐ ◓ ◑ ◒",
    "◡◡ ⊙⊙ ◠◠",
    ".oOo"
];

    var spin = spins[0],
        title = jQuery('#myModal3 .modal-body'),
        i=0;

    var aaa = setInterval(function() {
        i = i==spin.length-1 ? 0 : ++i;
        title.text( spin[i] );
    },50);
	
	var addrID2 =jQuery('#edit_payment_address').attr("href");
	jQuery("#myModal3").modal({
	        remote: addrID2,
	        refresh: true
	});
	

	var target = addrID2;
	
	jQuery("#myModal3").load(target, function() { 
		jQuery("#myModal3").modal("show"); 
	});
});




});



</script>

<?php
	if( in_array('cc.php', $payment_modules->modules) ){	include('ccJS.php');	}
?>

		<?php include( 'inc/checkout-shipping-inc.php' ); ?>    		
		

<?php get_footer(); ?>