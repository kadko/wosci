<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

<link href="" type="text/css" rel="stylesheet">
    
<script type='text/javascript' src='<?php echo esc_url( home_url( '/' ) ); ?>wp-includes/js/jquery/jquery.js?ver=1.10.2'></script>
<script type='text/javascript' src='<?php echo esc_url( home_url( '/' ) ); ?>wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>	

	<script src="<?php echo get_bloginfo('template_url');?>/jquery.cookies.2.2.0.min.js"></script>
	
	
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/dist/css/tweak.css">
	
	<script src="<?php echo get_bloginfo('template_url');?>/dist/js/bootstrap.js"></script>
	<script src="<?php echo get_bloginfo('template_url');?>/dist/js/tweak.js"></script>
	
	<?php if(is_archive()){ ?>
	<script src="<?php echo get_bloginfo('template_url');?>/ui/jquery-ui.js"></script>
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/themes/base/jquery.ui.all.css">
	<script src="<?php echo get_bloginfo('template_url');?>/ui/jquery.ui.accordion.js"></script>
	<script src="<?php echo get_bloginfo('template_url');?>/ui/jquery.ui.core.js"></script>
	<script src="<?php echo get_bloginfo('template_url');?>/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo get_bloginfo('template_url');?>/ui/jquery.ui.mouse.js"></script>
	<script src="<?php echo get_bloginfo('template_url');?>/ui/jquery.ui.slider.js"></script>
	<?php } ?>
	<?php if(is_single()){ ?>
<script type="text/javascript">

function changeImage(imageUrl,fullimageUrl,title,resnum,w,h) 
							{
jQuery(".smallthumb").css({'border' : '2px solid #eee', 'color' : '#009900'});	
jQuery("#img"+resnum).css({'border' : '2px solid orange', 'color' : '#009900'});

document.getElementById('fullimage_link1').innerHTML='<a class="highslide" onclick="return hs.expand(this)" style="border:0px;" href="'+fullimageUrl+'"><img style="border:0px;" src="'+imageUrl+'" class="" width="'+w+'" height="'+h+'" alt="'+title+'"/><\/a>';


								//document.getElementById('fullimage_link2').innerHTML='<span style="cursor:pointer; cursor:hand;" onclick="window.open(\''+fullimageUrl+'\',\'_blank\'); return false;"  ><img src="images/infobox/zum.gif" width="40" height="40" alt="orjinal boyut"/><\/span>';
							}
							
function removeborder(resnum){					
}
</script>	
	<?php } ?>
	<script src="<?php echo get_bloginfo('template_url');?>/js/jquery.form.min.js"></script>

	<?php if(is_page('cart')){ ?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/jquery.highlightFade.js"></script>
	<?php } ?>

	
</head>

<body <?php body_class(); ?>>
<div class="container">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<div class="page-header">
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<small><?php bloginfo( 'description' ); ?></small>
			</h1></div>
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<!--<h3 class="menu-toggle"><?php _e( 'Menu', 'wosci' ); ?></h3>-->
			<!--<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'wosci' ); ?>"><?php _e( 'Skip to content', 'wosci' ); ?></a>-->
			<?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>



<?php $fixtop = ' navbar-fixed-top'; ?>
<nav class="navbar navbar-default <?php //echo $fixtop; ?>" role="navigation" style="margin-bottom:-4px;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only"><?php _e( 'Toggle navigation', 'textdomain' ); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php bloginfo( 'url' ); ?>">
                <?php bloginfo( 'name' ); ?>
            </a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'depth'          => 2,
                        'container'      => false,
                        'menu_class'     => 'nav navbar-nav',
                        'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
                        'walker'         => new wp_bootstrap_navwalker()
                    )
                );
            ?>
            <form method="get" class="navbar-form navbar-left" action="<?php echo esc_url( home_url( '/' ) ); ?>product/" role="search">
                <label for="navbar-search" class="sr-only"><?php _e( 'Search:', 'wosci-language' ); ?></label>
                <div class="form-group">
                    <input type="text" class="form-control" name="search" id="s" />
                </div>
                <!--<button type="submit" class="btn btn-default"><?php _e( 'Search', 'wosci-language' ); ?></button>-->
            </form>
            
            
            
            
            
    <ul class="nav navbar-nav navbar-right"> 
      <li><a id="popoverId" href="#"><?php echo __('Shopping Cart' ,'wosci-language' ); ?> <span class="badge"><small id="cartcount"><?php global $cart; echo $cart->count_contents();?></small></span></a></li> 
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Account','wosci-language'); ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>account-history"><?php echo __('Order History','wosci-language'); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wp-admin/profile.php"><?php echo  __('Profile','wosci-language'); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>address-book"><?php echo __('Address Book','wosci-language'); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>wish-list"><?php echo __('Wish List','wosci-language'); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>your-products"><?php echo __('Your Products','wosci-language'); ?></a></li>
          <li class="divider"></li>
          <li><a href=" <?php echo wp_logout_url(  ); ?> "><?php echo __('Log Out','wosci-language'); ?></a></li>
        </ul>
      </li>
    </ul>
            
            
            
        </div>
    </div>
</nav>


<?php
	global $cart, $currencies;
	$products = $cart->get_products();
	for ($i=0, $n=sizeof($products); $i<$n; $i++) 
	{
	
	$products[$i]['name'] = substr($products[$i]['name'], 0, 26 );
	$popovercart .= '<small>'.$products[$i]['quantity'] . ' ' . __('x') . ' <a href="'.get_permalink( $products[$i]['id'] ).'">' . $products[$i]['name'] . '</a> — ' . $currencies->display_price($products[$i]['currency'], tep_add_tax( $products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id'])) * $products[$i]['quantity'], '') .'</small><br>';

	}
	
	
	if ($cart->count_contents() < 1) {
	$popovercart .= __('Your shopping cart is empty.' ,'wosci-language' );
	}else{
	$popovercart .='<br><div class="btn-group">                 

<a href="'. esc_url( home_url( '/' ) ).'cart" class="btn btn-primary btn-xs">' . __('Edit Cart','wosci-language') . '</a><a  href="'. esc_url( home_url( '/' ) ).'shipping-payment" class="btn btn-success btn-xs" style="float:right;">' . __('Checkout','wosci-language') . '</a>

</div>
';
	}
?>

<div id="popoverContent" class="hide"><?php echo ''.$popovercart; ?></div>


<?php /* ?>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </div>

        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>

<?php */ ?>




<script>
jQuery(document).ready(function() {

jQuery(".alert").each(function(){
		var alertid = jQuery(this).attr("id");
		var checkalert = jQuery.cookies.get( alertid );
		
		if(checkalert == 'closed')
		{
			jQuery("#"+alertid).hide();
		}

		});

jQuery(".alert .close").click(function () {
	var alertid = jQuery(this).parent().attr("id");
	jQuery.cookies.set( alertid, 'closed');
});



});

</script>

<?php  if( is_page('order-confirmation')  ) { ?>
 <script type="text/javascript">   
jQuery(document).ready(function() {
jQuery('.btn-success').prop('disabled', true);
jQuery(".btn-success").click(function () {
setTimeout(function() { jQuery('.btn-success').prop('disabled', true); }, 10);
});


jQuery("#ruaglabel").click(function () {
if( jQuery('#ruagcheck').is(":checked") ) {
jQuery('.btn-success').prop('disabled', false);
} else {
jQuery('.btn-success').prop('disabled', true);
}
});

});
</script>
<?php } ?>
<?php
if( is_home() || is_single() || is_archive()   ) {
if( is_home()) { $m = '-2px'; }else{  $m = '20px'; } 
$wt = get_option('widget_text');
for($i;$i<5;$i++){
if($wt[$i]['title'] != '' ){
/*echo "
<div id=\"alert".$i."\" style=\"margin:-12px 0 ". $m ." 0;\" class=\"alert alert-warning alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
<strong>".$wt[$i]['title']."</strong> ".$wt[$i]['text']."
</div>
";*/
}
}
}
?>


<?php if( is_page('shipping-payment') || is_page('cart') || is_page('order-confirmation')   ) { ?>	


<?php
$steps = array(0 => 'cart', 1 => 'shipping-payment', 2 => 'order-confirmation', 3 => 'success');
$current = $post->post_name;
$key = array_search($current, $steps);
?>
<div class="fuelux" style="margin-top:10px; " >

  <div class="wizard">
    <ul class="steps">
      <li data-target="#step1" <?php if($key > 0 ){ echo ' class="complete"'; } ?><?php if($key == 0 ){ echo ' class="active"'; } ?>><span class="badge<?php if($key > 0 ){ echo ' badge-success'; } ?><?php if($key == 0 ){ echo ' badge-info'; } ?>">1</span><a href="<?php echo esc_url( home_url( '/' ) ); ?>cart"><?php echo __( 'Shopping Cart', 'wosci-language' ); ?></a><span class="chevron"></span></li>
      <li data-target="#step2"<?php if($key > 1 ){ echo ' class="complete"'; } ?><?php if($key == 1 ){ echo ' class="active"'; } ?>><span class="badge<?php if($key > 1 ){ echo ' badge-success'; } ?><?php if($key == 1 ){ echo ' badge-info'; } ?>">2</span><a href="<?php echo esc_url( home_url( '/' ) ); ?>shipping-payment"><?php echo __( 'Shipping and Payment', 'wosci-language' ); ?></a><span class="chevron"></span></li>
      <li data-target="#step3"<?php if($key > 2 ){ echo ' class="complete"'; } ?><?php if($key == 2 ){ echo ' class="active"'; } ?>><span class="badge<?php if($key > 2 ){ echo ' badge-success'; } ?><?php if($key == 2 ){ echo ' badge-info'; } ?>">3</span><?php echo __( 'Confirmation', 'wosci-language' ); ?><span class="chevron"></span></li>
      <li data-target="#step4"<?php if($key > 3 ){ echo ' class="complete"'; } ?><?php if($key == 3 ){ echo ' class="active"'; } ?>><span class="badge<?php if($key > 3 ){ echo ' badge-success'; } ?><?php if($key == 3 ){ echo ' badge-info'; } ?>">4</span><?php echo __( 'Finished!', 'wosci-language' ); ?><span class="chevron"></span></li>
    </ul>

  </div>

</div><!-- .fuelux -->

<?php
}else if( !is_home() ){ ?>		
   <div>
      <ul class="breadcrumb">
         <small><?php
	if( function_exists('bcn_display') )
	{
        bcn_display();
	}
	?>
      </small></ul>
   </div>		
<?php } ?>	





		
		<div class="margin-top2"></div> 
		 
		
		
		</nav><!-- #site-navigation -->

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
	