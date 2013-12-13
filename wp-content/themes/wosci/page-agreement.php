<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
<style>
.modal-dialog p{ padding:8px 0 8px 0; } 
</style>
  <title></title>
</head>
<body>
 
 <div class="modal-dialog">
        <div class="modal-content">
            <!--<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title"><?php echo __('Sales And Purchase Agreement', 'wosci-language'); ?></h4>
            </div>-->
            <div class="modal-body">
            

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
<?php endwhile; endif; ?>

            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __('Close', 'wosci-language'); ?></button>
            </div>
        </div>
        <!-- .modal-content -->
    </div>
    <!-- .modal-dialog -->

</body>


</html>
