<?php
/*

 Template Name: Wosci - Shopping Cart Page

*/
get_header();
global $payment_modules;

?>

<script language="javascript">

jQuery(document).ready(function(){

jQuery('.trashcan').mouseover(function() {
jQuery(this).attr("src","<?php echo get_bloginfo('template_url'); ?>/trashO.png");

});

jQuery('.trashcan').mouseout(function() {
jQuery(this).attr("src","<?php echo get_bloginfo('template_url'); ?>/trash.png");
});

});

</script>

	<?php include( 'inc/shopping-cart-inc.php' ); ?>    		
		

<?php get_footer(); ?>