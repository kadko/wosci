<?php

//S
// load all enabled shipping modules
	if ($current_user->ID =='0') {
		wp_redirect( esc_url( home_url( '/' ) ).'wp-login.php?redirect_to=shipping-payment');
	}

	if (empty($_POST['shipping'])) {
		wp_redirect('shipping-payment?error_message=' . urlencode(__( 'Please select a shipping method for your order.', 'wosci-language' )));
	}
	
	update_user_meta($current_user->ID, 'shipping_method', $_POST['shipping']);
	$shipping_a = get_user_meta($current_user->ID, 'shipping_method');
	$shipping = $shipping_a[0];

	
	$cdai = get_user_meta($current_user->ID, 'customer_default_address_id');
	$customer_default_address_id = $cdai[0]; 
	
	$bill_to = get_user_meta($current_user->ID, 'billto');
	$send_to = get_user_meta($current_user->ID, 'sendto');

	
	tep_session_register('billto');
	tep_session_register('sendto');
	if ( !empty( $bill_to[0] ) ) { $billto = $bill_to[0]; }else{ wp_redirect(esc_url( home_url( '/' ) ).'wp-login.php?redirect_to=shipping-payment'); }
	if ( !empty( $send_to[0] ) ) { $sendto = $send_to[0]; }else{ wp_redirect(esc_url( home_url( '/' ) ).'wp-login.php?redirect_to=shipping-payment'); }
	$shipping_modules = new shipping;
	$total_weight = $cart->show_weight();
	$total_count = $cart->count_contents();

    
    if ( (tep_count_shipping_modules() > 0) || ($free_shipping == true) ) {
      if ( (isset($_POST['shipping'])) && (strpos($_POST['shipping'], '_')) ) {
        $shipping_a = get_user_meta($current_user->ID, 'shipping_method');
	$shipping = $shipping_a[0];
        list($module, $method) = explode('_', $shipping);
        
        
        if ( is_object($$module) || ($shipping == 'free_free') ) {
          if ($shipping == 'free_free') {
            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          
          
          if (isset($quote['error'])) {
            tep_session_unregister('shipping');
          } else {
            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
              $shipping = array('id' => $shipping,
                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module']. ' ' . $quote[0]['methods'][0]['title'] . ''),
                                'cost' => $quote[0]['methods'][0]['cost']);

	update_user_meta($current_user->ID, 'shipping', serialize($shipping));
            
            
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
      }
    } else {
      $shipping = false;
                
      //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }   
	$payment_modules = new payment($_POST['payment']);

$order = new order;	
  
 

// get all available shipping quotes
//  $quotes = $shipping_modules->quote();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled


//<S


//P

//<P

//C
  if ($current_user->ID =='0') {
    wp_redirect(esc_url( home_url( '/' ) ).'wp-login.php?redirect_to=order-confirmation');
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    wp_redirect('cart');
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      wp_redirect('shipping-payment');
    }
  }



	if ( count($shipping) < 1 ) {
	    wp_redirect('shipping-payment');
	}

	if (!tep_session_is_registered('payment')) tep_session_register('payment');
	if (isset($_POST['payment'])) $payment = $_POST['payment'];

	if (!tep_session_is_registered('osc_comments')) tep_session_register('osc_comments');
	
	if (tep_not_null($_POST['osc_comments'])) {
	$osc_comments = tep_db_prepare_input($_POST['osc_comments']);
	}

	// load the selected payment module



	$payment_modules->update_status();

    
	if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
	    wp_redirect('shipping-payment?error_message=' . urlencode(__( 'Please select a payment method for your order.', 'wosci-language' )));
	}
	
	if (is_array($payment_modules->modules)) {
	    $payment_modules->pre_confirmation_check();
	}

// load the selected shipping module



	$order_total_modules = new order_total;
	$order_total_modules->process();

// Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = true;
      }
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
      wp_redirect('cart');
    }
  }


get_header();


?>
<script type="text/javascript">

jQuery(document).ready(function(){

jQuery('#ruag').click(function () {
	
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
	
	var addrID2 = "<?php echo esc_url( home_url( '/' ) ); ?>agreement";
	jQuery("#myModal2").modal({
	        remote: addrID2,
	        refresh: true
	});
	

	var target = addrID2;
	
	jQuery("#myModal2").load(target, function() { 
	jQuery("#myModal2").modal("show"); 
	
	});

});
});
</script>
<?php include( 'inc/checkout-confirmation-inc.php' ); ?>   

<?php get_footer(); ?>