<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/


get_header();

$history_query_raw = "select o.orders_id, o.date_purchased, o.delivery_name, o.billing_name, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$current_user->ID . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1' order by orders_id DESC";
    $history_split = new splitPageResults($history_query_raw, MAX_DISPLAY_ORDER_HISTORY);
    $history_query = tep_db_query($history_split->sql_query);

    while ($history = tep_db_fetch_array($history_query)) {
      $products_query = tep_db_query("select products_id from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$history['orders_id'] . "'");
      
	while ( $products = tep_db_fetch_array($products_query) ) {
	$productsid[] = $products['products_id'];
	}

   }

?>
<div class="well">
<div class="col-18 col-lg-12">

  <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8"><h3 class="assistive-text" style=""><?php echo __( 'Your Products', 'wosci-language' ); ?></h3></div>
  <div class="col-xs-6 col-md-4" style="text-align:right;"></div>
</div>
<hr>

<div id="tumbs">
<div class="row">
<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			// get_template_part( 'loop', 'index' );
	


	// ürün listelemesinde s?ralama düzeni için http://codex.wordpress.org/Template_Tags/query_posts#Order_Parameters
	global $current_user;
	
	$loopcustom = new WP_Query( array( 'posts_per_page' => 180, 'post_type' => 'product' , 'post__in'=> $productsid ) );
	if( count($productsid) > 0 ){
	while ( $loopcustom->have_posts() ) : $loopcustom->the_post();
	$c = get_post_custom_values('Currency');
	$f = get_post_custom_values('Price');
	$t = get_post_custom_values('Tax');
	$b = get_post_custom_values('Badge');
	$product_terms = wp_get_post_terms($post->ID,'product_category');
	$pr_arr[] = $f[0];
?>

     
        <div class="col-sm-2" id="thumbnail<?php echo get_the_ID(); ?>">
           <div class="margin-top"></div> <div class="thumbnail">
            <a href="<?php echo get_permalink(); ?>"><?php echo the_post_thumbnail(array('116','200'), array('class' => 'img-responsive')); ?></a>
            <div class="caption">
              <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php echo $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0])); ?></p>
              
            </div>
          </div>
        </div>
        
        


<?php endwhile; ?>
<?php } ?>


<?php if( count($productsid) == 0  ){ ?>

<div class="alert alert-warning" id="cart-empty"><?php echo __( 'You are not yet purchased any product!', 'wosci-language' ); ?></div>

<?php } ?>
</div><!-- .row -->


<div id="pagenavifirst" class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6"></div>
          </div>

</div><!-- #tumbs -->





	
</div><!-- .col-18 .col-lg-12 -->
</div><!--.well-->
<?php get_footer(); ?>