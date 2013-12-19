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
<script>

jQuery(function() {

jQuery(".removewishlist").live('click', function( event ){
var pID =  jQuery( this ).data( "id" );
jQuery( '*[data-id="'+pID+'"]' ).prop('disabled', true);
jQuery.ajax({
         type : "post",
         dataType : "json",
         url : myAjax.ajaxurl,
         data : {action: "remove_from_wishlist", pID: pID},
         success: function(response) {
       
	jQuery( '#thumbnail'+pID ).remove();

        
        if(response.emptytext != "") {
        jQuery(".alert-warning").show();
	jQuery(".alert-warning").text(response.emptytext);
	}
        console.log(response.uswl);
         if(response.text != "") {
	 //jQuery( '*[data-id="'+pID+'"] small'  ).text(response.text);
	 }
        
         if(response.type == "success") {

	} else {
         //      alert("error")
	}
	}
      })

});
});
</script>
<div class="well">
<div class="col-18 col-lg-12">

  <div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8"><h3 class="assistive-text" style=""><?php echo __( 'Your Wishlist', 'wosci-language' ); ?></h3></div>
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
	$user_wishlist = get_user_meta( $current_user->ID, 'customer_wishlist' ); 
	$btnclass = 'btn-default';
	
	$disable = ''; $alerttext =''; $notretieve='';
	$uswl = unserialize($user_wishlist[0]);

	if(empty($user_wishlist[0]) || count(unserialize($user_wishlist[0])) == 0 ){
		$notretieve = 'NOT';
		$alerttext = __( 'Your wishlist empty.', 'wosci-language' ); 
	}else{
	
	$btnclass = 'btn-danger';
	$wltext = __( 'Remove from list', 'wosci-language' ); 
	
	
	}
	$loopcustom = new WP_Query( array( 'posts_per_page' => 180, 'post_type' => 'product'.$notretieve , 'post__in'=> $uswl ) );

	while ( $loopcustom->have_posts() ) : $loopcustom->the_post();
	$c = get_post_custom_values('Currency');
	$f = get_post_custom_values('Price');
	$t = get_post_custom_values('Tax');
	$b = get_post_custom_values('Badge');
	$product_terms = wp_get_post_terms($post->ID,'product_category');
	$pr_arr[] = $f[0];

	
	
	
	
if( $alerttext == '' ){
?><?php } ?>

     
        <div class="col-sm-2" id="thumbnail<?php echo get_the_ID(); ?>">
           <div class="margin-top"></div> <div class="thumbnail">
            <a href="<?php echo get_permalink(); ?>"><?php echo the_post_thumbnail(array('116','200'), array('class' => 'img-responsive')); ?></a>
            <div class="caption">
              <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php echo $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0])); ?></p>
              <p><button data-id="<?php echo get_the_ID(); ?>" <?php echo $disable; ?> class="btn <?php echo $btnclass; ?> btn-xs removewishlist"><small><?php echo $wltext; ?></small></button></p>
            </div>
          </div>
        </div>
        
        


<?php endwhile; ?>


<?php if( $alerttext != '' ){ ?>

<div class="alert alert-warning" id="cart-empty"><?php echo $alerttext;?></div>

<?php } ?>
<div class="alert alert-warning" id="cart-empty" style="display:none;"><?php echo $alerttext;?></div>
</div><!-- .row -->


<div id="pagenavifirst" class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6"></div>
          </div>

</div><!-- #tumbs -->





	
</div><!-- .col-18 .col-lg-12 -->
</div><!--.well-->
<?php get_footer(); ?>