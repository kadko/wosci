<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 * DEPRECATED in WOSCI Template
 */

global $currencies;
$c = get_post_custom_values('Currency');
$f = get_post_custom_values('Price');
$b = get_post_custom_values('Badge');
?>
        <div class="col-xs-2">
           <div class="margin-top"></div> <div class="thumbnail">
            <a href="<?php echo get_permalink(); ?>"><?php echo the_post_thumbnail(array('200','140'), array('class' => 'img-responsive')); ?></a>
            <div class="caption">
              <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php echo $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0])); ?></p>
              <p><a href="#" class="btn btn-primary btn-xs">Action</a> <a href="#" class="btn btn-default btn-xs">Action</a></p>
            </div>
          </div>
        </div>
