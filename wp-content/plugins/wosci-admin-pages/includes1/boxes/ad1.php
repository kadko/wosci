<?php
/*
  $Id: ad1.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

?>
<!-- ad1 //--><?php if ($category_depth == 'products' || isset($HTTP_GET_VARS['manufacturers_id'])) {}else{?>
<?php
  if ($banner = tep_banner_exists('dynamic', 'bir')) {
?>

<div class="boxround bxpb box2 ui-corner-all ui-widget-content">
       
    <div id="ad1"> 
        
       <?php echo tep_display_banner('static', $banner); ?>
        
    </div>
</div>

           
<?php
  }}
?>
<!-- ad1_eof //-->
