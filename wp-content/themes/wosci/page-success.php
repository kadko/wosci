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
<p>Please check your <b>email inbox</b> for more details about your order. Don't forget to check <b>spam</b> folder!</p>
<div style="margin-top:20px;"></div>	
	
</div><!--.well-->
<?php get_footer(); ?>