<?php query_posts( 
        
        array('order' => $_GET['order'], 'orderby' => $_GET['orderby'], 'paged' => $_GET['paged'], 'post_type' => 'product','meta_key' => 'Price', 'product_category' => $c_terms->slug)
        
        );

        ?>
        
        <?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			// get_template_part( 'loop', 'index' );
/*function my_get_posts( $query ) {
			
				$query->set( 'post_type', array(  'product' ) );
				return $query;
			
				}		

add_filter( 'pre_get_posts', 'my_get_posts' );*/
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<?php
global $currencies, $customer_group_id,  $languages_id;  

$pieces = explode(",", $vitrin_ids);


  
  
  

     



	$k = 0;
	while ( $k < count($pieces) ) {
$c_terms = get_term_by( 'id', $pieces[$k], 'product_category', $output, $filter );
?>
<tr><td>

<div style="font-size:1.4em;margin:0 0 0 0px;color: #e47911;padding-top:10px;"><a href="?product_category=<?php echo $c_terms->slug; ?>"><?php echo $c_terms->name;?></a></div>
<ul class="featured_column" style="margin-top:0px;">
				

 
<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			// get_template_part( 'loop', 'index' );
	





global $current_user;
// ürün listelemesinde sıralama düzeni için http://codex.wordpress.org/Template_Tags/query_posts#Order_Parameters
$loopv = new WP_Query( array( 'order' => $_GET['order'], 'orderby' => $_GET['orderby'], 'paged' => $paged, 'post_type' => 'product','meta_key' => '', '' => '', 'meta_value' => '', 'product_category' => $c_terms->slug) );
$i=0;
while ( $loopv->have_posts() ) : $loopv->the_post();

$c = get_post_custom_values('Currency'); $f = get_post_custom_values('Price'); $b = get_post_custom_values('Badge'); $t = get_post_custom_values('Tax'); $product_terms = wp_get_post_terms($loopv->posts[$i]->ID,'product_category');


 $max_p[] = $f[0]; 
 


?>
	<li class="grid"> 
            
        
        <div style="background-color:#ffffff;border:solid #ccc 1px;position:relative;" class="block listing_block">
        
             <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(array('160','145'), array('class' => 'alignleft')); ?></a>
             
             <?php if( $b[0] == 'love' ){ ?><a href="<?php the_permalink(); ?>" class="" style="position: absolute; top: -6px; right: -6px;"><img style="background-color:transparent;" src="<?php echo get_bloginfo('template_url');?>/images/love.png" width="38" height="38" alt=""></a><?php } ?>
             <?php if( $b[0] == 'buy' ){ ?><a href="<?php the_permalink(); ?>" class="" style="position: absolute; top: -6px; right: -6px;"><img style="background-color:transparent;" src="<?php echo get_bloginfo('template_url');?>/images/buy.png" width="38" height="38" alt=""></a><?php } ?>            
             <?php if( $b[0] == 'avatar' ){ ?><a href="<?php the_permalink(); ?>" class="" style="position: absolute; top: -6px; right: -6px;"><?php echo get_avatar( get_the_author_ID(), 38 ); ?></a><?php } ?>
              <?php if( $b[0] == 'lotd' ){ ?><a href="<?php the_permalink(); ?>" class="" style="position: absolute; top: -1px; right: -1px;"><img style="background-color:transparent;" src="<?php echo get_bloginfo('template_url');?>/images/lotd.png" width="112" height="112" alt=""></a><?php } ?>
              <?php if( $b[0] == 'sold' ){ ?><a href="<?php the_permalink(); ?>" class="" style="position: absolute; top: -1px; right: -1px;"><img style="background-color:transparent;" src="<?php echo get_bloginfo('template_url');?>/images/sold.png" width="112" height="112" alt=""></a><?php } ?>
             
                 <a style="padding:10px 10px 0 0;font-size:12px;position:absolute;" href="<?php the_permalink(); ?>"><?php //echo $product_terms['0']->name; ?><?php the_title(); ?></a> 
                <p class="main-price"></p> <p style="font-size:12px;position:absolute;bottom:0;padding-bottom:10px;"><?php echo $f[0].$c[0];/*$currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0]));*/ ?><?php //echo $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0]));?><!--&nbsp;<a id="smbutton" class="sm ui-state-default ui-corner-all" href="<?php echo tep_href_link('product_info_popup.php', 'products_id='. $loopv->posts[$i]->ID);?>" onclick="return hs.htmlExpand(this, { objectType: \'ajax\'} )">İncele</a>--></p>
         
<?php 

$plugins = get_option('active_plugins');
$required_plugin = 'vote-it-up/voteitup.php';
$debug_queries_on = FALSE;
if ($current_user->ID === 0){ $user_ID = md5($_SERVER['REMOTE_ADDR']); }else{ $user_ID = $current_user->ID; }
	$debug_queries_on = TRUE; // Example for yes, it's active

if ( in_array( $required_plugin , $plugins ) ) { ?>

<div class="voting<?php echo $loopv->posts[$i]->ID; ?>" id="promo-<?php echo $loopv->posts[$i]->ID; ?>" style="float:right;position:absolute;padding:0 0 10px 98px;bottom:0;width:100%"><span style="" id="votecount<?php echo $loopv->posts[$i]->ID; ?>"><?php echo GetVotes($loopv->posts[$i]->ID);?></span><!---->

<?php if(!UserVoted($loopv->posts[$i]->ID,$user_ID)) {   ?>

<a id="votelink<?php echo $loopv->posts[$i]->ID; ?>" class="status promote" style="color:#000;" href="javascript:vote('votecount<?php echo $loopv->posts[$i]->ID; ?>','voteid<?php echo $loopv->posts[$i]->ID; ?>','<?php echo get_option('voteiu_aftervotetext'); ?>',<?php echo $loopv->posts[$i]->ID; ?>,<?php echo $current_user->ID; ?>,'<?php echo VoteItUp_ExtPath(); ?>');"><?php _e('Like'); ?></a>
<?php }else{ ?>
<span id="likes" style="color:#777;">Likes</span>
<?php } ?>
</div>
<?php } ?>     
         
            <div style="padding:16px;"></div></div>
        
        
        </li>
        <?php $i++; ?>
     <?php endwhile; ?>   
        
        
        
        
        </ul></td></tr>
        <?php $k ++; } ?></table>
        
        