<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/


get_header();

?>
  <div class="well">
<?php /* Template Name: Wosci - Order Success Page*/ ?>
<div style="margin-top:20px;"></div>	
<div class="alert alert-success">
<h3><span class="glyphicon glyphicon-ok"></span>     <?php _e('Your order has been successfully placed. Thank you!', 'wosci-language');?></h3></div>	
<div style="margin-top:10px;"></div>	
<p><?php _e('We sent order confirmation to your email, please check your <b>email inbox</b> for more details about your order.', 'wosci-language');?></p>
<p><?php _e('If confirmation email not arrived to your inbox don\'t forget to check <b>spam</b> folder.', 'wosci-language');?></p>
<div style="margin-top:20px;"></div>	
	
</div><!--.well-->
<?php get_footer(); ?>