<?php
// embed the javascript file that makes the AJAX request
wp_enqueue_script( 'my-ajax-request', get_bloginfo("template_url").'/ajax.php', array( 'jquery' ) );
// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) , 'postCommentNonce' => wp_create_nonce( 'myajax-post-comment-nonce' )
 ) );

get_header();

?>

<?php

//$allpost = $wpdb->get_results('SELECT SQL_CALC_FOUND_ROWS wp_posts.* FROM wp_posts WHERE 1=1 AND wp_posts.post_type = "product" AND (wp_posts.post_status = "publish" OR wp_posts.post_status = "private") ORDER BY wp_posts.post_date ASC LIMIT 0, 8');
$loopmain0 = new WP_Query( array( 'post_type' => 'product') );
/*revised from $p=1*/
for($p=0;$p < $loopmain0->max_num_pages+1;$p++){
$loopmain_0 = new WP_Query( array( 'post_type' => 'product', 'meta_key' => 'Price', 'meta_type' => 'NUMERIC', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'posts_per_page'=>-1,'product_category' => $term) );
while ( $loopmain_0->have_posts() ) : $loopmain_0->the_post();
//$keys[] = array_keys(@get_post_meta($post->ID));
$keys2[] = @get_post_meta($post->ID);

if($br != 'y'){ $m = get_post_custom_values('Price'); }
//$br = 'y';

endwhile;
}


 function group_by_key ($array) {
       $result = array();
       
       foreach ($array as $sub) {
         foreach ($sub as $k => $v) {
         if(substr($k, 0, 1) !='_' && substr($k, -1) !='_' && $k !='Price' && $k !='Currency' && $k !='Quantity' && $k !='Weight' &&  $k !='products_ordered'  && $k !='Tax' &&  !@in_array($v, $result[$k])){
       
         if( count( $v ) > 0 ){ for( $i=0; $i < count($v); $i++ ){  $result[$k][] = $v[$i]; } }
         
	 $result[$k] = array_unique($result[$k]);

         }
         }
       }
       return $result;
     }

  
function group_by_keyo ($array) {       

  foreach ($array as $k => $v) {
 	$out .= '<h3>'.$k.'</h3>';
 
 	foreach ($v as $k2 => $v2) {
	$querycf = new WP_Query( array('post_status' => array( 'publish'), 'post_type'=> 'product', 'meta_key' => $k, 'meta_value' =>$v2 ) );
 	$out2 .= '<label class="btn btn-default btn-xs" for="'.$k.$k2.'"><input style="vertical-align: middle;margin:0;padding:0;" class="'.$all_keys[$a].' meta_key_filter" name="'.$k.$k2.'" type="checkbox" id="'.$k.$k2.'" value="'.$v2.'" /> '.$v2. ' (' . $querycf->post_count . ')</label>';
 	}
 
 	$out .= '<div class="meta_value btn-group" style="padding:12px;width:100%;" >'.$out2.'</div>';
 	$out2 ='';
 
  }
 
 	return $out;
}
     




?>
<script>


equalheights();
jQuery(function() {

equalheights();
<?php if(!empty($_GET['search'])){ 
?><?php
  } ?>
jQuery.cookies.set( 'search', '<?php echo $_GET['search']; ?>');
jQuery.cookies.set( 'author', '<?php echo $_GET['author']; ?>');


jQuery.cookies.del('matchratio');
jQuery.cookies.del('selectedrgb');
jQuery("#pickedcolor").css("display","none");

selrgb = jQuery.cookies.get( 'selectedrgb' );
maratio = jQuery.cookies.get( 'matchratio' ); 
if(selrgb != null){


    var parts = selrgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(0\.\d+))?\)$/);
    
    var inv_r = 255-parts[1];
    var inv_g = 255-parts[2];
    var inv_b = 255-parts[3];
    var inv_rgb = 'rgb('+inv_r+', '+inv_g+', '+inv_b+')';
jQuery("#pickedcolor").css("display","inline");
jQuery("#pickedcolor").css("background-color",selrgb);
jQuery("#pickedcolor").css("color",inv_rgb);
}else{
jQuery("#pickedcolor").css("display","none");
}



//jQuery("#filter_keys").append("<?php echo $meta_key_html;?>");


	var pricef =  jQuery.cookies.get( 'pricefrom' );
	var pricet = jQuery.cookies.get( 'priceto' );	
	if( pricef != null ){ var mip = pricef; }else{ var mip = 0; }
	if( pricet != null ){ var map = pricet; }else{ var map = jQuery("#max").text(); }



var map2 = jQuery("#max").text();

var sliderTooltip = function(event, ui) {

if(typeof ui.values == 'undefined' ){

var curValue0 = mip;
var curValue1 =  map;


}else{

var curValue0 = ui.values[0] ;
var curValue1 = ui.values[1];

}


    var tooltip0 = '<div class="tooltipsl"><div class="tooltipsl-inner">' + curValue0 + '</div><div class="tooltipsl-arrow"></div></div>';
    var tooltip1 = '<div class="tooltipsl"><div class="tooltipsl-inner">' + curValue1 + '</div><div class="tooltipsl-arrow"></div></div>';

    jQuery('.ui-slider-handle').eq(0).html(tooltip0);
    jQuery('.ui-slider-handle').eq(1).html(tooltip1);

}
		jQuery( "#slider-range" ).slider({
			range: true,
			create: sliderTooltip,
			slide: sliderTooltip,
			min: 0,
			stop: function(event, ui) { sliderstoped(); },
			max: map2,
			values: [ mip , map ]
		});
		
		






function sliderstoped() {
jQuery("#loading").css( {"display":"inline"});
//jQuery( "#amount" ).css( {"background-color":"#000","border":"solid 0px #000","color":"#ffffff"});
jQuery("#tumbs").css( {"opacity":"1"});
checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values == null){cv2 = '';}
if(checked_values != null){
for(i=0;i< checked_values.length;i++){

if(i == 0){ cv2 = checked_values[i];}else{ } 
cv2 = checked_values[i] + " " + cv2;

}
}

	var price_from = jQuery( "#slider-range" ).slider( "values", 0 );//jQuery("#price_range1").text();
	var price_to = jQuery( "#slider-range" ).slider( "values", 1 )//jQuery("#price_range2").text();

	jQuery.cookies.set( 'pricefrom', price_from);
	jQuery.cookies.set( 'priceto', price_to);

	var orb = jQuery.cookies.get( 'sel_orderby' );
	var or = jQuery.cookies.get( 'sel_order' );

	if(or == '+') { or = 'ASC' ;}else{or = 'DESC' ;}




var anychecked = 'false';
jQuery(".meta_key_filter").each(function(index) {
var ischecked = jQuery(this).attr("checked");
if(ischecked == true ){ anychecked = 'true';}
});

if(anychecked == 'true'){meta_key = '';}else{meta_key = 'Price';}
//alert(meta_key);
var ppp = jQuery.cookies.get( 'popepa' );

jQuery.post(
	MyAjax.ajaxurl,
	{
		action : 'myajax-submit',
		postID : MyAjax.postID,
		meta_key : meta_key,
		meta_value : cv2,
		orderby : orb,
		search : '<?php echo $_GET['search']; ?>',
		order : or,
		paged : '',
		posts_per_page:ppp,
		product_category: MyAjax.product_category,
		page_id: MyAjax.page_id,
		price_from: price_from,
		price_to: price_to,
		// send the nonce along with the request
		postCommentNonce : MyAjax.postCommentNonce
	},
	function( response ) {
		//alert( response );
		//jQuery( "#amount" ).css( {"background-color":"#ffffff","color":"#000000","border":"solid 0px #000"});
		jQuery("#loading").css( {"display":"none"});
		jQuery("#tumbs .row").replaceWith("");
		jQuery("#tumbs").append(response);
		jQuery("#tumbs").css( {"opacity":"1"});
		
		equalheights();
		
	}
	
);
}



		
		jQuery( "#amount" ).val( "" + jQuery( "#slider-range" ).slider( "values", 0 ) +
			" - " + jQuery( "#slider-range" ).slider( "values", 1 ) );


	var orb = jQuery.cookies.get( 'sel_orderby' );
	var or = jQuery.cookies.get( 'sel_order' );


jQuery("#"+orb + "order").text(or);
	if(or == '+') { or = 'ASC' ;}else{or = 'DESC' ;}
	
	jQuery("#"+orb).addClass("selected");

checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values == null){cvh = '';}

if(checked_values != null){
for(i=0;i< checked_values.length;i++){

if(i == 0){ cvh = checked_values[i];}else{ } 
cvh = checked_values[i] + " " + cvh;


jQuery(".meta_value").each(function(index) {
var ischecked = checked_values[i];
var clicked_box = ischecked.replace(" ", "");

jQuery('input[value="' + clicked_box + '"]').attr('checked', true);
});

}
}


if ( ( orb != null || cvh != '' ) || (pricef != null && pricet != null) ){

	selrgb = jQuery.cookies.get( 'selectedrgb' );
	maratio = jQuery.cookies.get( 'matchratio' );
if(orb == null){ orb = 'date';  or = 'ASC';  }
var ppp = jQuery.cookies.get( 'popepa' );

jQuery.post(
	MyAjax.ajaxurl,
	{
		action : 'myajax-submit',
		postID : MyAjax.postID,
		meta_key : '',
		meta_value : cvh,
		orderby : orb,
		order : or,
		search : '<?php echo $_GET['search']; ?>',
		paged : '',
		posts_per_page:ppp,
		rgb:selrgb,
		mratio:maratio,
		product_category: MyAjax.product_category,		
		price_from: mip,
		price_to: map,
		page_id: MyAjax.page_id,
		// send the nonce along with the request
		postCommentNonce : MyAjax.postCommentNonce
	},
	function( response ) {
		//alert(response);
		jQuery("#tumbs .row").replaceWith("");
		jQuery("#tumbs").append(response);
		
		equalheights();
	}
	
);
}//end if









	});



  
  
jQuery(document).ready(function() {


    
    jQuery( "#accordion" ).accordion({ 
    
    
    
     collapsible:true,
     heightStyle: "content",

    beforeActivate: function(event, ui) {
         // The accordion believes a panel is being opened
        if (ui.newHeader[0]) {
            var currHeader  = ui.newHeader;
            var currContent = currHeader.next('.ui-accordion-content');
         // The accordion believes a panel is being closed
        } else {
            var currHeader  = ui.oldHeader;
            var currContent = currHeader.next('.ui-accordion-content');
        }
         // Since we've changed the default behavior, this detects the actual status
        var isPanelSelected = currHeader.attr('aria-selected') == 'true';

         // Toggle the panel's header
        currHeader.toggleClass('ui-corner-all',isPanelSelected).toggleClass('accordion-header-active ui-state-active ui-corner-top',!isPanelSelected).attr('aria-selected',((!isPanelSelected).toString()));

        // Toggle the panel's icon
        currHeader.children('.ui-icon').toggleClass('ui-icon-triangle-1-e',isPanelSelected).toggleClass('ui-icon-triangle-1-s',!isPanelSelected);

         // Toggle the panel's content
        currContent.toggleClass('accordion-content-active',!isPanelSelected)    
        if (isPanelSelected) { currContent.slideUp(); }  else { currContent.slideDown(); }

        return false; // Cancel the default action
    }
  
    
    
     });
     
      jQuery("h3[aria-selected='false']").click();
     
var maxValue = 100,
    slider = jQuery('<div id=\'colormatch\'>').slider({
        range: "max",
        max: maxValue,
        min: 0,
        value: 92,
        slide: refreshSwatch,
	change: refreshSwatch
    });
function refreshSwatch (){
var colormatchratio = jQuery( "#colormatch" ).slider( "value" );
jQuery( "#cmp" ).empty();
jQuery( "#cmp" ).append( colormatchratio );

}




jQuery('#pover2')
    .popover({
        trigger: 'manual'
    })
    .click(function() {
        var this2 = jQuery(this);
        
        if (jQuery(this).toggleClass('active').hasClass('active')) {

            jQuery(this).popover('show');
            jQuery('.popover-content')
                
                .append(slider);
        } else {
            slider.detach();
            jQuery(this).popover('hide');
        }
    });



function handler1() {
jQuery("#shfilter").removeAttr("class");
jQuery("#shfilter").attr("class", "btn btn-default btn-sm");

jQuery("#filters").hide();
jQuery("#listingrow").removeAttr("class");
jQuery("#listingrow").attr("class", "col-18 col-lg-12");
jQuery(this).one("click", handler2);
}

function handler2() {

jQuery("#shfilter").removeAttr("class");
jQuery("#shfilter").attr("class", "btn btn-success btn-sm");

jQuery("#filters").show();
jQuery("#listingrow").removeAttr("class");
jQuery("#listingrow").attr("class", "col-12 col-lg-10");
jQuery(this).one("click", handler1);
}
jQuery("#shfilter").one("click", handler1);

});


</script>

<div id="loading"></div>

<?php
if(is_archive()){
?>

<?php 
/*
query_posts( 
        
        array('order' => $_GET['order'], 'orderby' => $_GET['orderby'], 'paged' => $_GET['paged'], 'post_type' => 'product','meta_key' => 'Price')
        
        );
*/
        ?>





<?php $c_terms = get_term_by( 'slug', $term, 'product_category', $output, $filter ); ?>
<div class="well">



<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8"><h3 class="assistive-text" style=""><?php print_r($c_terms->name); ?></h3></div>
  <div class="col-xs-6 col-md-4" style="text-align:right;"><button id="shfilter" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-filter"></span> Filters</button></div>
</div>
<hr>

<div class="row">
        <div class="col-12 col-lg-10" id="listingrow">
<div id="tumbs">
<div class="row">
<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			// get_template_part( 'loop', 'index' );
	


	// ürün listelemesinde s?ralama düzeni için http://codex.wordpress.org/Template_Tags/query_posts#Order_Parameters
	$loopmain = new WP_Query( array( 's'=> $_GET['search'], 'order' => 'ASC'/*'ASC'*/,'product_category' => $term, 'orderby' => 'date', 'paged' => $paged, 'post_type' => 'product','meta_key' => 'Price', 'meta_compare' => 'BETWEEN', 'meta_value' => '') );
	
	while ( $loopmain->have_posts() ) : $loopmain->the_post();
	$c = get_post_custom_values('Currency');
	$f = get_post_custom_values('Price');
	$t = get_post_custom_values('Tax');
	$b = get_post_custom_values('Badge');
	$product_terms = wp_get_post_terms($post->ID,'product_category');
	$pr_arr[] = $f[0];
?>

     
        <div class="col-sm-2">
           <div class="margin-top"></div> <div class="thumbnail">
            <a href="<?php echo get_permalink(); ?>"><?php echo the_post_thumbnail(array('116','200'), array('class' => 'img-responsive')); ?></a>
            <div class="caption">
              <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php echo $currencies->display_price($c[0], $f[0], tep_get_tax_rate($t[0])); ?></p>
              <p><a href="#" class="btn btn-primary btn-xs">Action</a> <a href="#" class="btn btn-default btn-xs">Action</a></p>
            </div>
          </div>
        </div>

<?php endwhile; ?>

</div><!-- .row -->


<div id="pagenavifirst" class="row">
            <div class="col-lg-6"><?php wp_pagenavi($loopmain); ?></div>
            <div class="col-lg-6"></div>
          </div>

</div><!-- #tumbs -->


</div><!-- .col-12 .col-lg-9 -->

<div class="col-6 col-lg-2" id="filters">
<div class="margin-top"></div>
	<?php get_sidebar(); ?>
	
<div class="margin-top"></div>



<div id="accordion">
<?php echo group_by_keyo(group_by_key($keys2)); ?>
</div>
</div><!-- .col-6 .col-lg-2 -->


</div><!-- .row -->
</div><!-- .well -->
      

<div id="max" style="display:none;"><?php echo $m[0]; ?></div>
<div id="min" style="display:none;"><?php echo min($pr_arr);?></div>

<?php } ?>



<?php get_footer(); ?>