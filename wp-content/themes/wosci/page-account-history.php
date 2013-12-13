<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  if ( $current_user->ID == '0' ) {
    wp_redirect(tep_href_link(FILENAME_LOGIN, 'redirect_to=account-history', 'SSL'));
  }
  
get_header();

?>
<?php /* Template Name: Wosci - Account Page*/ ?>
<div class="well">

<?php include("inc/account-history-inc.php"); ?>
	
</div><!--.well-->
<?php get_footer(); ?>