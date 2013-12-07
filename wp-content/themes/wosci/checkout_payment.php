<?php
/*
  $Id: checkout_payment.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

//  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if ($current_user->ID =='0') {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (tep_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
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
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }
  

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  if (!tep_session_is_registered('osc_comments')) tep_session_register('osc_comments');
  if (isset($HTTP_POST_VARS['osc_comments']) && tep_not_null($HTTP_POST_VARS['osc_comments'])) {
    $osc_comments = tep_db_prepare_input($HTTP_POST_VARS['osc_comments']);
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// load all enabled payment modules
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Ödeme Tipi ve Fatura Adresi</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">    
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		
<?php wp_head(); ?>
<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/jquery-1.7.2.min.js"></script>
<script src="<?php echo get_bloginfo('template_url');?>/jquery.keypad.js"></script>
<link href="<?php echo get_bloginfo('template_url');?>/busisky_css/bootstrap.min.css" rel="stylesheet">      
		<link href="<?php echo get_bloginfo('template_url');?>/busisky_css/bootstrap-responsive.min.css" rel="stylesheet">          
		<link href="<?php echo get_bloginfo('template_url');?>/busisky_css/paralax.css" rel="stylesheet">
		<link href="<?php echo get_bloginfo('template_url');?>/busisky_css/main.css" rel="stylesheet"/>		
		<!--[if lt IE 9]>
			<link href="<?php echo get_bloginfo('template_url');?>/busisky_css/ie.css" rel="stylesheet"/>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>		
			<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/css3-mediaqueries.js"></script>
		<![endif]-->
		<!--<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/jquery-1.7.2.min.js"></script>-->
		<!--<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/bootstrap.min.js"></script>-->




		<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/superfish.js"></script>
		<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/jquery.scrolltotop.js"></script>





<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url');?>/jquery.keypad.css">
<script language="javascript"><!--
var selected;

function selectRowEffect(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

// one button is not an array
  if (document.checkout_payment.payment[0]) {
    document.checkout_payment.payment[buttonSelect].checked=true;
  } else {
    document.checkout_payment.payment.checked=true;
  }
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script>

<SCRIPT TYPE="text/javascript">
<!--

 $(document).ready(function(){

$('input[name="cc_number"],input[name="cc_checkcode"]').keypad({keypadOnly: false});

	$('input[type="text"], select').live('click', function() {
	
	var name = $(this).attr('name')
	
	//$('input[CHECKED]').removeAttr('CHECKED');
	if(name !='ykboos_cc_taksit'){
	document.checkout_payment.payment[0].checked=true;
	
	$('#havale, #havale5, #havale6, #havale3, #havale2, #cod2, #defaultSelected, #ykboos').removeClass('moduleRowSelected');
	//$('input[value="cc"]').attr('CHECKED', 'CHECKED');
	$('tr[class="moduleRow"]:last').addClass('moduleRowSelected');
	$('input[value="cc"]').attr('CHECKED', 'CHECKED');
	
	
	var con2 = $('.moduleRowSelected input').val();
	}
	
	if(name =='ykboos_cc_taksit'){
	//document.checkout_payment.payment[8].checked=true;
	$('#havale, #havale5, #havale6, #havale3, #havale2, #cod2, #defaultSelected,#cc').removeClass('moduleRowSelected');
	//$('input[value="cc"]').attr('CHECKED', 'CHECKED');
	$('#ykboos').addClass('moduleRowSelected');
	
	var con2 = $('.moduleRowSelected input').val();
	}
	});




	$('select[name="bonuskart_cc_taksit"]').hide();
	$('select[name="finansbank_cc_taksit"]').hide();
	$('select[name="ykb_cc_taksit"]').hide();

	$('#bonus_taksit').hide();
	$('#cardfinans_taksit').hide();
	$('#ykb_taksit').hide();

	$('.finans_taksit_not').hide();
	$('.bonus_taksit_not').hide();
	$('.ykb_taksit_not').hide();
	
		
	
function dojob(bk,ba)
{
//alert("Welcome " + bk + ", the " + ba);
$('#bankaadi').text(ba);	
	if(bk !=''){
	
		$('select[name="bonuskart_cc_taksit"]').hide();
		$('select[name="finansbank_cc_taksit"]').hide();
		$('select[name="ykb_cc_taksit"]').hide();
	}
	jQuery('input[name="bankaADI"]').val(ba);	
	if(bk==62)
	{
	//jQuery('select[name="taksit'+bk+'"]').show();
	jQuery('select[name="bonuskart_cc_taksit"]').show();
	jQuery('#cardfinans_taksit').show();
	jQuery('#bonus_taksit').show();
	jQuery('.bonus_taksit_not').show();
	jQuery('input[name="bankaID"]').val("62");	
	}

	if(bk==111)
	{
	//jQuery('select[name="taksit'+bk+'"]').show();
	jQuery('select[name="finansbank_cc_taksit"]').show();
	jQuery('#cardfinans_taksit').show();
	jQuery('.finans_taksit_not').show();
	jQuery('input[name="bankaID"]').val("111");	
	}

	if(bk==67)
	{
	//jQuery('select[name="taksit'+bk+'"]').show();
	jQuery('select[name="ykb_cc_taksit"]').show();
	jQuery('#cardfinans_taksit').show();
	jQuery('#ykb_taksit').show();
	jQuery('.ykb_taksit_not').show();
	jQuery('input[name="bankaID"]').val("67");	
	}

	if(bk=='')
	{
	$('select[name="bonuskart_cc_taksit"]').hide();
	$('select[name="finansbank_cc_taksit"]').hide();
	$('select[name="ykb_cc_taksit"]').hide();
	$('select[name="bonuskart_cc_taksit"]').val($("#target option:first").val());
	$('select[name="finansbank_cc_taksit"]').val($("#target option:first").val());
	$('select[name="ykb_cc_taksit"]').val($("#target option:first").val());
	
	$('#bonus_taksit').hide();
	$('#cardfinans_taksit').hide();
	$('#ykb_taksit').hide();
	$('.finans_taksit_not').hide();
	$('.bonus_taksit_not').hide();
	$('.ykb_taksit_not').hide();
	}
}





function check (){
var kkn = $('input[name="cc_number"]').val();

if( kkn.length < 6 ){
dojob('','');
}
if( kkn.length > 5 ){
var prx6 = kkn.substring(0,6); 

//alert(prx6);

 $.post("bin-list.php", { "kkprx": prx6 },
 function(data){
//   console.log(data.name); // John
//alert( data.ba + data.bk );
dojob(data.bk,data.ba);
 }, "json");




}
}

$('input[name="cc_number"]').live('click keyup change',function () {
check ();
});
$(window).load(function () {
check ();
});

/* var a = pos.success(function() { alert("second success"); })
    var b = pos.error(function() { alert("error"); })
    var c = pos.complete(function() { alert("complete"); });
alert(a +b +c);*/

});

//-->
</SCRIPT>







<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/highslide/highslide.css" />
<script type="text/javascript">
    // override Highslide settings here
    // instead of editing the highslide.js file
    hs.graphicsDir = '<?php bloginfo('template_url'); ?>/highslide/graphics/';
</script>

<script type="text/javascript">
   hs.dimmingOpacity = 0.75;
   hs.align = 'center';
   hs.height = '670';
   hs.width = '400';
</script>
<style type="text/css">
.highslide-dimming {
	background: gray;
}
</style>























	</head>
    <body>	
		<section class="navbar">
			<div class="navbar-inner main-menu">				
				<a href="./index.php" class="logo pull-left"><img src="<?php echo get_bloginfo('template_url');?>/busisky_img/logo.png" alt=""></a>
				<nav id="menu" class="pull-right">
					<ul>
						<li><a href="./?page_id=2">Tasarımını Yükle<br/><span>Kendi Çalışmalarınız için</span></a></li>
						<li><a href="./?product_category=tum-urunler">HAZIR TASARIMLAR<br/><span>Hazır Şablon Ürünler</span></a>
<?php
//list terms in a given taxonomy (useful as a widget for twentyten)
$taxonomy = 'product_category';
$tax_terms = get_terms($taxonomy);
?>
<ul>
<?php
foreach ($tax_terms as $tax_term) {
echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
}
?>
</ul>
						</li>			
						<li><a href="./?page_id=919">BOS SABLONLAR<br/><span>Bos Sablon İndir</span></a></li>
						
						
						
						
						
					
						
						
				
						
						
						
						
						
						
											
						<li><a href="./?page_id=624" >FIYATLAR<br/><span>Fiyat hesapla</span></a>
						
						
						

						
						
						
						</li>
						<!--<li><a href="?product_category=<?php echo $c_terms->slug; ?>" ><?php echo $c_terms->name;?><br/><span>Portfolio Page</span></a></li>-->						
						<li><a href="./account.php" >BILGILERIM<br/><span>Hesap Bilgileriniz</span></a></li>
						<li><a href="./shopping_cart.php" >SEPET<br/><span>Eklenen Ürünler</span></a></li>
					</ul>
				</nav>
			</div>
		</section>
		
		<!--<div class="bg_slider"></div>-->
		<div class="container-fluid content">
			<div class="row-fluid">
				<div class="span12">					
					
					<div class="row-fluid">
						











<table cellspacing="0" cellpadding="0" id="enalts" class="boxround" style="width:100%;margin: 0 auto;border:solid 0px #ffffff;">
	<tr>

				<?php if ( function_exists('is_sidebar_asctive') && is_sidebar_active('primsary-widget-area')) { ?>
	<td valign="top" class="boxround" style="background-color:#ffffff;"><!-- left_navigation first//-->
			<div style="height:100%;width:170px;">
			<?php dynamic_sidebar('primary-widget-area'); ?>
			</div>
		</td><td style="padding:4px;"></td><!-- left_navigation last //-->	
				<?php } ?>
			
		<td  valign="top" width="100%" class="boxround" style="background-color:#ffffff;"><!-- center_navigation first//-->
		
		
		
		<div id="content" class="widget-container" role="main">
			<?php include( 'inc/checkout-payment-inc.php' ); ?>
		</div>
		
		
			
			</td><!-- center_navigation last//-->
		<?php if ( function_exists('is_sidebsar_active') && is_sidebar_active('secondary-widsget-area')) { ?>
		<td style="padding:4px;"></td><td valign="top" style="background-color:#ffffff;" class="boxround"><!-- right_navigation first//-->
			<div style="width:270px;">
				<?php dynamic_sidebar('secondary-widget-area'); ?>
			</div>
		</td><!-- right_navigation last//-->
		<?php } ?>
	</tr>
</table>
























					</div>
				</div>				
			</div>
		</div>		
		<div class="container-fluid" id="footer-bar">
				<style type="text/css">
	.nav      { margin-bottom:20px; overflow:hidden; }
	.nav li   { width:50%; line-height:1em; float:left; display:inline; }
	.nav li a { line-height:2em; }
	</style>		
	<?php require("footer-menu.php"); ?>
		</div>
		<div class="container-fluid" id="copyright">		
			<span>Copyright 2013 @ Busisky. All right reserved.</span>
		</div>
		<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/modernizr.custom.js"></script>	
		<script src="<?php echo get_bloginfo('template_url');?>/busisky_js/jquery.cslider.js"></script>
		
    </body>
</html>