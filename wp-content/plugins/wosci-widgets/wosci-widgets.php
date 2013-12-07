<?php
/*

Plugin Name: Wosci Widgets Plugin
Description: Wosci widgets
Plugin URI: http://www.wosci.com/
Version: 1.1
Author: Kadir Korkmaz
Author URI: http://www.wosci.com
License: GPL2
*/

class WP_Widget_Slider extends WP_Widget {

	function __construct() {
		$widget_ops = array('description' => __( "Price Range Slider" ) );
		parent::__construct('slider', __('Slider'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);

		//$title = apply_filters('widget_title', empty($instance['title']) ? __('Price Range') : $instance['title'], $instance, $this->id_base);

		

		if(is_archive()){
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		 ?>
	<div><div id="slider-range" style="width:97%;float:left;margin:3px 0 0 0;"></div></div>
	
	
	
<div style="padding-top:10px;clear:both;"></div> <div id="filter_keys"></div> <div style="padding-top:16px;clear:both;"></div> <?php

echo $after_widget;
}
	}

	function update( $new_instance, $old_instance ) {
		$new_instance = (array) $new_instance;
		$instance = array( 'images' => 0, 'name' => 0, 'description' => 0, 'rating' => 0);
		foreach ( $instance as $field => $val ) {
			if ( isset($new_instance[$field]) )
				$instance[$field] = 1;
		}
		$instance['category'] = intval($new_instance['category']);

		return $instance;
	}

	function form( $instance ) {

		//Defaults

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>

		
<?php
	}
}


class WP_Widget_Sort extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_sort', 'description' => __( 'Product Listing Sorter') );
		parent::__construct('sort', __('Sort'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		//$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Sort by' ) : $instance['title'], $instance, $this->id_base);
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		if ( $sortby == 'menu_order' )
			$sortby = 'menu_order, post_title';

		$out = wp_list_pages( apply_filters('widget_pages_args', array('title_li' => '', 'echo' => 0, 'sort_column' => $sortby, 'exclude' => $exclude) ) );

		if ( !empty( $out ) ) { if(is_archive()){
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
		?>
<div class="content-head">


<!--<li style="font-size:0.88em;"><b><em><?php _e('Sort By');?>:</em></b></li>-->

<div class="ajax_filter btn btn-warning btn-xs" id="meta_value_num"><?php _e('Price');?><span id="meta_value_numorder" class="order">+</span></div>

<!-- <a href="./?meta_key=Price&orderby=meta_value_num&order=<?php echo ($_GET['order']=='' || $_GET['order']=='ASC') ?  'DESC':'ASC' ;?>&page_id=<?php echo $_GET['page_id'];?>" class="on"><em><?php _e('By Price');?> (<?php echo ($_GET['order']=='' || $_GET['order']=='ASC') ?  'Desc':'Asc'?>)</em></a> -->



  
<div class="ajax_filter btn btn-warning btn-xs" id="title"><?php _e('Name');?><span id="titleorder" class="order">+</span></div>

<!-- <a href="./?orderby=title&order=<?php echo ($_GET['order']=='' || $_GET['order']=='ASC') ?  'DESC':'ASC' ;?>&page_id=<?php echo $_GET['page_id'];?>" class="on"><em><?php _e('By Name');?> (<?php echo ($_GET['order']=='' || $_GET['order']=='ASC') ?  'Z-A':'A-Z'?>)</em></a></a>-->



<div class="ajax_filter btn btn-warning btn-xs" id="date"><?php _e('Date');?><span id="dateorder" class="order">+</span></div> <!-- <a href="./?meta_key=Price&orderby=date&order=<?php echo ($_GET['order']=='' || $_GET['order']=='ASC') ?  'DESC':'ASC' ;?>&page_id=<?php echo $_GET['page_id'];?>" class="on"><em><?php _e('By Date');?> (<?php echo ($_GET['order']=='' || $_GET['order']=='ASC') ?  'New to Old':'Old to New'?>)</a></em> -->

 


</div>
		<?php
			echo $after_widget;
		}
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>



<?php
	}

}


class WP_Widget_PPP extends WP_Widget {

	function __construct() {
		$widget_ops = array('description' => __( "Products Per Page" ) );
		parent::__construct('ppp', __('Products Per Page'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);

		//$title = apply_filters('widget_title', empty($instance['title']) ? __('Products Per Page') : $instance['title'], $instance, $this->id_base);

		

		if(is_archive()){
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		 ?>
	<div><div id="slider-range" style="width:97%;float:left;margin:3px 0 0 0;"></div></div>
	
	
	
<div class="margin-top"></div>
	<div class="bs-docs-example tooltip-demo"><a href="#" onclick="return false;" id="pover" class="btn btn-default btn-sm " data-toggle="popover" data-placement="left" data-content="<input type='text' name='filter' id='filterid' class='form-control' placeholder='Write and press Enter'>" title="" >Product Per Page</a></div> <?php

echo $after_widget;
}
	}

	function update( $new_instance, $old_instance ) {
		$new_instance = (array) $new_instance;
		$instance = array( 'images' => 0, 'name' => 0, 'description' => 0, 'rating' => 0);
		foreach ( $instance as $field => $val ) {
			if ( isset($new_instance[$field]) )
				$instance[$field] = 1;
		}
		$instance['category'] = intval($new_instance['category']);

		return $instance;
	}

	function form( $instance ) {

		//Defaults

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>

		
<?php
	}
}



class WP_Widget_Color_Filter extends WP_Widget {

	function __construct() {
		$widget_ops = array('description' => __( "Filter By Color" ) );
		parent::__construct('colorfilter', __('Filter By Color'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);

		//$title = apply_filters('widget_title', empty($instance['title']) ? __('Price Range') : $instance['title'], $instance, $this->id_base);

		

		if(is_archive()){
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		 ?>
	
	
	
	
<div class="margin-top"></div>

<div class="bs-docs-example tooltip-demo"><a href="#" onclick="return false;" id="pover2" class="btn btn-default btn-sm" data-toggle="popover" data-placement="left" data-content="<div class='color-option-content' style='width:180px;'>
<ul class='colors cfix'>
  <li class='color color-0-0'></li>
  <li class='color color-0-1'></li>
  <li class='color color-0-2'></li>
  <li class='color color-0-3'></li>
  <li class='color color-0-4'></li>
  <li class='color color-0-5'></li>
  <li class='color color-0-6'></li>
  <li class='color color-0-7'></li>
  <li class='color color-0-8'></li>
  <li class='color color-0-9'></li>
  <li class='color color-0-10'></li>
  <li class='color color-0-11'></li>
  <li class='color color-1-0'></li>
  <li class='color color-1-1'></li>
  <li class='color color-1-2'></li>
  <li class='color color-1-3'></li>
  <li class='color color-1-4'></li>
  <li class='color color-1-5'></li>
  <li class='color color-1-6'></li>
  <li class='color color-1-7'></li>
  <li class='color color-1-8'></li>
  <li class='color color-1-9'></li>
  <li class='color color-1-10'></li>
  <li class='color color-1-11'></li>
  <li class='color color-2-0'></li>
  <li class='color color-2-1'></li>
  <li class='color color-2-2'></li>
  <li class='color color-2-3'></li>
  <li class='color color-2-4'></li>
  <li class='color color-2-5'></li>
  <li class='color color-2-6'></li>
  <li class='color color-2-7'></li>
  <li class='color color-2-8'></li>
  <li class='color color-2-9'></li>
  <li class='color color-2-10'></li>
  <li class='color color-2-11'></li>
  <li class='color color-3-0'></li>
  <li class='color color-3-1'></li>
  <li class='color color-3-2'></li>
  <li class='color color-3-3'></li>
  <li class='color color-3-4'></li>
  <li class='color color-3-5'></li>
  <li class='color color-3-6'></li>
  <li class='color color-3-7'></li>
  <li class='color color-3-8'></li>
  <li class='color color-3-9'></li>
  <li class='color color-3-10'></li>
  <li class='color color-3-11'></li>
  <li class='color color-4-0'></li>
  <li class='color color-4-1'></li>
  <li class='color color-4-2'></li>
  <li class='color color-4-3'></li>
  <li class='color color-4-4'></li>
  <li class='color color-4-5'></li>
  <li class='color color-4-6'></li>
  <li class='color color-4-7'></li>
  <li class='color color-4-8'></li>
  <li class='color color-4-9'></li>
  <li class='color color-4-10'></li>
  <li class='color color-4-11'></li>
  <li class='color color-5-0'></li>
  <li class='color color-5-1'></li>
  <li class='color color-5-2'></li>
  <li class='color color-5-3'></li>
  <li class='color color-5-4'></li>
  <li class='color color-5-5'></li>
  <li class='color color-5-6'></li>
  <li class='color color-5-7'></li>
  <li class='color color-5-8'></li>
  <li class='color color-5-9'></li>
  <li class='color color-5-10'></li>
  <li class='color color-5-11'></li>
  <li class='color color-6-0'></li>
  <li class='color color-6-1'></li>
  <li class='color color-6-2'></li>
  <li class='color color-6-3'></li>
  <li class='color color-6-4'></li>
  <li class='color color-6-5'></li>
  <li class='color color-6-6'></li>
  <li class='color color-6-7'></li>
  <li class='color color-6-8'></li>
  <li class='color color-6-9'></li>
  <li class='color color-6-10'></li>
  <li class='color color-6-11'></li>
  <li class='color color-7-0'></li>
  <li class='color color-7-1'></li>
  <li class='color color-7-2'></li>
  <li class='color color-7-3'></li>
  <li class='color color-7-4'></li>
  <li class='color color-7-5'></li>
  <li class='color color-7-6'></li>
  <li class='color color-7-7'></li>
  <li class='color color-7-8'></li>
  <li class='color color-7-9'></li>
  <li class='color color-7-10'></li>
  <li class='color color-7-11'></li>
  <li class='color color-8-0'></li>
  <li class='color color-8-1'></li>
  <li class='color color-8-2'></li>
  <li class='color color-8-3'></li>
  <li class='color color-8-4'></li>
  <li class='color color-8-5'></li>
  <li class='color color-8-6'></li>
  <li class='color color-8-7'></li>
  <li class='color color-8-8'></li>
  <li class='color color-8-9'></li>
  <li class='color color-8-10'></li>
  <li class='color color-8-11'></li>
  <li class='color color-9-0'></li>
  <li class='color color-9-1'></li>
  <li class='color color-9-2'></li>
  <li class='color color-9-3'></li>
  <li class='color color-9-4'></li>
  <li class='color color-9-5'></li>
  <li class='color color-9-6'></li>
  <li class='color color-9-7'></li>
  <li class='color color-9-8'></li>
  <li class='color color-9-9'></li>
  <li class='color color-9-10'></li>
  <li class='color color-9-11'></li>
  <li class='color-9-12'></li>
</ul>
<div>Matching <span style='float:right;'>%</span><span style='float:right;' id='cmp'></span></div>
  </div>" title="" >Filter by Color</a>
  
<button type="submit" class="btn btn-default btn-sm" id="pickedcolor" style="border:0px;background-color:#3FAD43;"><span id="removepicked">clear color filter(x)</span></button>
  </div>
<?php

echo $after_widget;
}
	}

	function update( $new_instance, $old_instance ) {
		$new_instance = (array) $new_instance;
		$instance = array( 'images' => 0, 'name' => 0, 'description' => 0, 'rating' => 0);
		foreach ( $instance as $field => $val ) {
			if ( isset($new_instance[$field]) )
				$instance[$field] = 1;
		}
		$instance['category'] = intval($new_instance['category']);

		return $instance;
	}

	function form( $instance ) {

		//Defaults

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>

		
<?php
	}
}

class WP_Widget_Vitrin extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_vitrin', 'description' => __( "Featured Products") );
		parent::__construct('vitrin', __('Featured Categories'), $widget_ops);
	}

function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Featured Products') : $instance['title']);
		$vitrin_ids = empty( $instance['vitrin_ids'] ) ? '' : $instance['vitrin_ids'];
		$slidethumbs = $instance['slidethumbs'];
		echo $before_widget;
		if ( $title )
			//echo $before_title . $title . $after_title; ?>
<?php if( $slidethumbs == 1 ){ ?>		
<script type='text/javascript'>

/* <![CDATA[ */
jQuery(document).ready(function() {
	jQuery('#<?php echo $this->get_field_id('id');?>').carousel({
	interval: 10000
	})
    
    jQuery('#<?php echo $this->get_field_id('id');?>').on('slid.bs.carousel', function() {
    	equalheights();
	});
    
    
function equalheights()
		{
		
		var currentTallest = 0;
		jQuery(".thumbnail h4").each(function(){
			
			jQuery(this).each(function(i){
				if ( jQuery(this).height() > currentTallest ) { currentTallest = jQuery(this).height(); }
			});
			jQuery(".thumbnail h4").css({'min-height': currentTallest}); 
			
		});
		
		jQuery(".thumbnail img").each(function(){
			var currentTallest = 0;
			jQuery(this).each(function(i){
				if (jQuery(this).height() > currentTallest) { currentTallest = jQuery(this).height(); }
			});
			
			jQuery(".thumbnail img").css({'height': currentTallest}); 
		});
		}
equalheights();
    
});

	
/* ]]> */
</script>

<style>
.carousel-control {
  padding-top:10%;
  width:5%;
}
.featuredwell{margin-bottom:6px;}
</style>
<?php } ?>

<div class="well featuredwell" >
<?php echo '<h3 style="margin-bottom:10px;">' . $title . '</h3>'; ?>

	<?php if( $slidethumbs == 1 ){ ?>
<div id="<?php echo $this->get_field_id('id');?>" class="myCarousel carousel slide">
 <div class="carousel-inner">			 
	<?php } ?>

<?php

$input_array = explode( ',' , $vitrin_ids );
$items = array_chunk($input_array, 6);

global $current_user, $currencies;

if( $slidethumbs == 1 ){ $count = count($items); }else{ $count = 1; }

for( $a=0; $a < $count; $a++ ){

if( $slidethumbs == 1 ){ $post__in = $items[$a]; }else{ $post__in = $input_array; }

// ürün listelemesinde s?ralama düzeni için http://codex.wordpress.org/Template_Tags/query_posts#Order_Parameters
$loopv = new WP_Query( array( 'post_type' => 'product', 'post__in' => $post__in ) );
$i=0;
if( $a == 0 ){ $item = 'active'; }else{ $item = ''; }
?>

<?php if( $slidethumbs == 1 ){ ?>
<div class="item <?php echo $item; ?>">
<?php } ?>

<div class="row">
<?php
while ( $loopv->have_posts() ) : $loopv->the_post();

$c = get_post_custom_values('Currency');
$f = get_post_custom_values('Price');
$b = get_post_custom_values('Badge');
$t = get_post_custom_values('Tax');
$product_terms = wp_get_post_terms( $loopv->posts[$i]->ID, 'product_category' );

$max_p[] = $f[0]; 

?>
        
        <div class="col-sm-2">
          <div class="thumbnail">
            <a href="<?php echo get_permalink(); ?>"><?php echo the_post_thumbnail(array('200','150'), array('class' => 'img-responsive')); ?></a>
            <div class="caption">
              <h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
              <p><?php echo $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0])); ?></p>
              <p><a href="#" class="btn btn-primary btn-xs">Action</a> <a href="#" class="btn btn-default btn-xs">Action</a></p>
            </div>
          </div>
        </div>
      
           
        <?php $i++; ?>
     <?php endwhile; ?>   
     
          </div><!-- .row -->
<?php if( $slidethumbs == 1 ){ ?>
</div><!-- .item -->
<?php } ?>

<?php } ?>
<?php if( $slidethumbs == 1 ){ ?> </div><!--/carousel-inner-->
                <a class="left carousel-control" href="#<?php echo $this->get_field_id('id');?>" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#<?php echo $this->get_field_id('id');?>" data-slide="next">›</a>
            </div><!--/myCarousel-->
<?php } ?>
</div><!-- .well -->	

		
<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['vitrin_ids'] = strip_tags( $new_instance['vitrin_ids'] );
		$instance['slidethumbs'] = isset($new_instance['slidethumbs']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		$vitrin_ids = esc_attr( $instance['vitrin_ids'] ); ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			
		<p>
		<label for="<?php echo $this->get_field_id('vitrin_ids'); ?>"><?php _e( 'Featured Categories:' ); ?></label> <input type="text" value="<?php echo $vitrin_ids; ?>" name="<?php echo $this->get_field_name('vitrin_ids'); ?>" id="<?php echo $this->get_field_id('vitrin_ids'); ?>" class="widefat" />
		<br />
		<small><?php _e( 'Category IDs, separated by commas.' ); ?></small>
		</p>
		<p><input id="<?php echo $this->get_field_id('slidethumbs'); ?>" name="<?php echo $this->get_field_name('slidethumbs'); ?>" type="checkbox" <?php checked(isset($instance['slidethumbs']) ? $instance['slidethumbs'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('slidethumbs'); ?>"><?php _e('Show thumbnails in slider caorusel'); ?></label></p>
			
<?php
	}
}





class WP_Widget_Text_2 extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_text_2', 'description' => __('Arbitrary text or HTML 2'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('text', __('Text'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

		$type = $instance['type'];
		$dismissability = $instance['dismissability'];
		$color = $instance['color'];

		echo $before_widget;
		?> 

<?php if ( $type == 'alert'  ) { ?>
<div id="alert<?php echo $this->id; ?>" style="" class="alert alert-<?php echo $color; ?> <?php if( $dismissability == 'dismissable'){ echo ' alert-dismissable';} ?>">
<?php if( $dismissability == 'dismissable'){ ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php } ?>
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
<?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
</div>
<?php } ?>

<?php if ( substr($type, 0, 4) == 'well' ) { ?>
<?php 
if ( $type == 'well_text' ) { $well = 'well'; }
if ( $type == 'well_text_small' ) { $well = 'well-sm'; } 
if ( $type == 'well_text_large' ) { $well = 'well-lg'; } 
?>

<div class="well <?php echo $well; ?>">
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
<?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>

</div>
<?php } ?>
<div style="margin-bottom:-14px;"></div>		
			
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['type'] = $new_instance['type'];
		$instance['dismissability'] = $new_instance['dismissability'];
		$instance['color'] = $new_instance['color'];
		
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']); 
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'type' => '', 'dismissability' => '', 'color' => '') );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
		
		$type = $instance['type'];
		$dismissability = $instance['dismissability'];
		$color = $instance['color'];
		
		
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>






<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type:' ); ?></label>
			<select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>" class="widefat">
				<option value="alert"<?php selected( $instance['type'], 'alert' ); ?>><?php _e('Alert'); ?></option>
				<option value="well_text"<?php selected( $instance['type'], 'well_text' ); ?>><?php _e('Well Text'); ?></option>
				<option value="well_text_large"<?php selected( $instance['type'], 'well_text_large' ); ?>><?php _e('Well Text Large'); ?></option>
				<option value="well_text_small"<?php selected( $instance['type'], 'well_text_small' ); ?>><?php _e('Well Text Small'); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('dismissability'); ?>"><?php _e( 'Dismissability:' ); ?></label>
			<select name="<?php echo $this->get_field_name('dismissability'); ?>" id="<?php echo $this->get_field_id('dismissability'); ?>" class="widefat">
				<option value="dismissable"<?php selected( $instance['dismissability'], 'dismissable' ); ?>><?php _e('Dismissable'); ?></option>
				<option value="not_dismissable"<?php selected( $instance['dismissability'], 'not_dismissable' ); ?>><?php _e('Not Dismissable'); ?></option>
				
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e( 'Color:' ); ?></label>
			<select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
				<option value="warning"<?php selected( $instance['color'], 'warning' ); ?>><?php _e('Warning'); ?></option>
				<option value="danger"<?php selected( $instance['color'], 'danger' ); ?>><?php _e( 'Danger' ); ?></option>
				<option value="success"<?php selected( $instance['color'], 'success' ); ?>><?php _e( 'Success' ); ?></option>
				<option value="info"<?php selected( $instance['color'], 'info' ); ?>><?php _e( 'Info' ); ?></option>
			</select>
		</p>





		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
		

		
<script type='text/javascript'>
/* <![CDATA[ */
	var dropdown2 = document.getElementById("<?php echo $this->get_field_id('type'); ?>");
onCatChange();
if(dropdown2.options[dropdown2.selectedIndex].value != 'alert'){
//dropdown_color.setAttribute("disabled");
}
	
	function onCatChange() {
		var dropdown_color = document.getElementById("<?php echo $this->get_field_id('color'); ?>");
		var dropdown_dismissability = document.getElementById("<?php echo $this->get_field_id('dismissability'); ?>");
		if ( dropdown2.selectedIndex != 0 ) {
		
			var cc = this.selectedIndex;
			
			dropdown_color.setAttribute("disabled");
			dropdown_dismissability.setAttribute("disabled");
			
		}else{
		
		dropdown_color.removeAttribute("disabled");
		dropdown_dismissability.removeAttribute("disabled");
		
		}
		
		
	}
	
	dropdown2.onchange = onCatChange;

	
/* ]]> */
</script>		

<?php
	}
}







// unregister all widgets
 function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Text');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
 }

add_action('widgets_init', 'unregister_default_widgets', 11);

 
// register widget
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Color_Filter");'));
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_PPP");'));
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Slider");'));
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Sort");'));



function myplugin_register_widgets() {
	register_widget( 'WP_Widget_Vitrin' ); register_widget( 'WP_Widget_Text_2' );
}

add_action( 'widgets_init', 'myplugin_register_widgets' );
?>