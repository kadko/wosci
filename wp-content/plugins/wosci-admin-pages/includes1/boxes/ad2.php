<?php
/*
  $Id: ad2.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

?>
<!-- ad2 //-->
<?php if ($category_depth == 'products' || isset($HTTP_GET_VARS['manufacturers_id'])) {}else{?>
<?php
  if ($banner = tep_banner_exists('dynamic', 'iki')) {
?>

<div class="boxround bxpb box2 ui-corner-all ui-widget-content">
       
    
        
       <?php echo tep_display_banner('static', $banner); ?>
        
  
</div>

         
<?php
  }}
?>
<!-- ad2_eof //-->
