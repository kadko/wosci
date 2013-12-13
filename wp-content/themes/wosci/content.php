<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 * DEPRECATED in WOSCI Template
 */
?>
<?php

// place inside loop
$args = array(
	'post_type' => 'attachment',
	'numberposts' => 16,
	'post_status' => null,
	'post_parent' => get_the_ID()
); 
$attachments = get_posts($args);

//print_r($attachments);
if ($attachments) {
	foreach ($attachments as $attachment) {
		//echo apply_filters('the_title', $attachment->post_title);
		// the_attachment_link($attachment->ID, false);
		$prattachments[] = wp_get_attachment_image($attachment->ID);
		$img_links['link'][] = $attachment->guid;
		echo  $attachment->guid;
		$mo = $attachment->menu_order;
		if( 0 == $mo ){ $img_order['mo'][] = $attachment->guid; } else { $img_order['mo'][$mo] = $attachment->guid; }//menu_order 0 ise (sýralama yapýlmadýðýnda olur) otomatik sýralama ekliyoruz.
	}
}
if(count($img_order['mo'])>0){
ksort($img_order['mo']);
$img_reorder = array_values($img_order['mo']);
}


 ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'wosci' ); ?>
		</div>
		<?php endif; ?>
		<header class="entry-header">
			
			
<?php $c = get_post_custom_values('Currency'); $f = get_post_custom_values('Price'); $t = get_post_custom_values('Tax'); $qty = get_post_custom_values('Quantity'); global $currencies;  
?>

<div class="row">
   <div class="col-xs-6 col-md-4">

  
  <div id="fullimage_link1"><?php $iwidth = 400; the_post_thumbnail(array($iwidth, 1000), array('class' => 'img-responsive')); ?></div>

<?php 
if( count($prattachments) > 1 ){
for( $res = 0; $res < count($prattachments); $res++ ){

$img_orders[] = $img_reorder[$res];
$gis = getimagesize($img_orders[$res]);
$imgh = round( $gis[1] / ( $gis[0] / $iwidth ) );
$default_attr = array(
			'src'	=> $img_orders[$res],
			'id'	=> 'img'.$res,
			'class'	=> 'img-responsive',
			'style' => "border: 2px solid #eee;",
			'alt'	=> '',
			'title'	=> '',
			//'onmouseout' => 'removeborder("' . $res . '")',
			'onmouseover' =>  'changeImage("' . $img_orders[$res] . '" , "' . $img_orders[$res] . '" , "' . get_the_title() . '", "' . $res . '", '.$iwidth.', '.$imgh.')'
		);


echo the_post_thumbnail( array( 60, 60 ), $default_attr );

}
}


?>
  
  
  
  </div><!-- .col-xs-6 col-lg-3 -->


    <div class="col-xs-9 col-md-6">

  
  <?php if ( is_single() ) : ?>
			<h3 class="entry-title"><?php the_title(); ?></h3>
			<small><?php echo __('Price', 'wosci-language') . ':</small> <div style="display:inline;font-weight:bold;font-size:16px;">' . $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0])); ?></div> <?php if(tep_get_tax_rate($t[0]) > 0 ){ ?><small>( <?php echo tep_get_tax_rate($t[0]); ?>% <?php echo __('Tax Included', 'wosci-language'); ?> )</small> <?php } ?>
			

<?php if($qty[0] > 0 ){ $stock = 'in'; $stocktext= __('In Stock','wosci-language'); }else{ $stock = 'outof'; $stocktext= __('Out of Stock', 'wosci-language'); } ?>
<div class="<?php echo $stock;?>stock"><?php echo $stocktext; ?></div>			





<?php $languages_id=1; 
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$post->ID . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
?>



  
<?php
      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$post->ID . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
$bo_o = '';
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {

$bo_o .=  '<div style="font-weight:normal;font-size:13px;margin-top:12px;">Select '.$products_options_name['products_options_name'].'</div>'.'<div class="btn-group" data-toggle="buttons" data-name="'.'id[' . $products_options_name['products_options_id'] . ']'.'" data-title="'.$products_options_name['products_options_name'].'">';
	
//	$chf ='first'; //NOPRE
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$post->ID . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {

	 // if(  $chf == 'first'  ){ $ch = 'active'; } else { $ch = ''; } /* we decided to force user to select options insead pre-select ref:NOPRE*/
	   
	  $bo_o .= '<label class="btn btn-sm btn-primary">'; // '.$ch.' //NOPRE
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          $bo_o .= '<input data-opid="'.$products_options_name['products_options_id'].'" type="radio" name="'.'id[' . $products_options_name['products_options_id'] . ']'.'" value="'.$products_options['products_options_values_id'].'" id="'.$products_options['products_options_values_id'].'" >'. $products_options['products_options_values_name'];
          
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($c[0], $products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          $bo_o .=  ' (' . $products_options['price_prefix'] . $currencies->display_price($c[0], $products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';     
          }

$bo_o .= '</label>';
$chf ='notfirst'; //NOPRE
        }

    

        if (is_string($post->ID) && isset($cart->contents[$post->ID]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }

$bo_o .= '</div><!--.btn-group --> ';
?>
      <strong><?php //echo $products_options_name['products_options_name'] . ':'; ?></strong><?php //echo tep_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute); ?>
 
<?php
      }
?>

<?php
echo $bo_o;
    }
?>






			<?php //the_excerpt(); ?>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			
			<?php endif; // is_single() ?></div><!-- .col-xs-6 col-lg-7 -->
  <div class="col-xs-3 col-md-2">
   <div class="well" align="center">
  <?php echo tep_draw_form('cart_quantity', get_bloginfo('template_url').'/shopping_cart_ajax.php','post','id="myForm1"'); /*tep_session_name().'='.tep_session_id()*/ ?>
<input name="products_id" type="hidden" id="p_i_d" value="<?php echo get_the_ID(); ?>" />

<?php  $nonce = wp_create_nonce("add_to_cart_nonce"); ?>

  <button style="white-space:normal;" type="button" id="fat-btn"  data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post->ID; ?>" data-loading-text="Loading..." class="btn btn-warning  ">
        Add to Cart
      </button>
   <div class="margin-top">
	<small><?php echo 'Quantity'; ?></small>
        <input name="quantity" type="number" step="1" min="1" id="quantity" value="1" class="btn btn-default btn-sm" style="width:50px;">
   
   
    
 
 </form>
 </div>
 
 
 
 
 
 </div> <!-- .col-xs-6 col-lg-2 -->
</div> <!-- .row -->
	
		

			

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Products In Your Shopping Cart</h4>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>cart">Go to Shopping Cart</a>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


    

			
			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php //comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'wosci' ) . '</span>', __( '1 Reply', 'wosci' ), __( '% Replies', 'wosci' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<br><?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wosci' ) ); ?>
			<br><?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wosci' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wosci_author_bio_avatar_size', 68 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'wosci' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wosci' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->