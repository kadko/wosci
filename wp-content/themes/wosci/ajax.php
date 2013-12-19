<?php
header('Content-type: text/javascript');
?>

function equalheights()
		{
		jQuery(".thumbnail h5").each(function(){
			var currentTallest = 0;
			jQuery(this).each(function(i){
				if (jQuery(this).height() > currentTallest) { currentTallest = jQuery(this).height(); }
			});
			jQuery(".thumbnail h5").css({'min-height': currentTallest}); 
			
		});
		
		jQuery(".thumbnail img").each(function(){
			var currentTallest = 0;
			jQuery(this).each(function(i){
				if (jQuery(this).height() > currentTallest) { currentTallest = jQuery(this).height(); }
			});
			
			jQuery(".thumbnail img").css({'height': currentTallest}); 
		});
		}
		

jQuery(document).ready(function() {



jQuery(".test").click(function () {

jQuery(".product_34").remove();

}); 


	




jQuery(".pagenavipage2").live('click', function() {

jQuery("#loading").css( {"display":"inline"});
jQuery( "#tumbs .row" ).css( {"background-color":"#ffffff","opacity":0.50});
		
checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values == null){cv3 = '';}

if(checked_values != null){
for(i=0;i< checked_values.length;i++){

if(i == 0){ cv3 = checked_values[i];}else{ } 
cv3 = checked_values[i] + " " + cv3;

}
}

var str = jQuery(this).find("a").attr("id");

var clicked_page = str.replace("goto", "");

jQuery( "#goto"+clicked_page ).css( {"background-color":"#000","border":"solid 1px #000","color":"#ffffff","font-weight":"bold"});
jQuery("#tumbs").css( {"opacity":"1"});
var price_from = jQuery( "#slider-range" ).slider( "values", 0 );//jQuery("#price_range1").text();
var price_to = jQuery( "#slider-range" ).slider( "values", 1 )//jQuery("#price_range2").text();

	var orb = jQuery.cookies.get( 'sel_orderby' );
	var or = jQuery.cookies.get( 'sel_order' );
	var meta_key = jQuery.cookies.get( 'meta_key' );
if(or == '+') { or = 'ASC' ;}else{or = 'DESC' ;}


	var map = jQuery( "#slider-range" ).slider( "values", 0 );
	var mip = jQuery( "#slider-range" ).slider( "values", 1 );



 var meta_key = jQuery.cookies.get( 'meta_key' ); 
var anychecked = 'false';
jQuery(".meta_key_filter").each(function(index) {
var ischecked = jQuery(this).attr("checked");
if(ischecked == true ){ anychecked = 'true';}
});

if(anychecked == 'true'){meta_key = '';}else{meta_key = 'Price';}
//alert(meta_key);

var ppp = jQuery.cookies.get( 'popepa' );
selrgb = jQuery.cookies.get( 'selectedrgb' );
maratio = jQuery.cookies.get( 'matchratio' );


jQuery.post(
	MyAjax.ajaxurl,
	{
		action : 'myajax-submit',
		postID : MyAjax.postID,
		meta_key : meta_key,
		meta_value : cv3,
		orderby : orb,
		order : or,
		paged : clicked_page,
		search : jQuery.cookies.get( 'search' ),
		author : jQuery.cookies.get( 'author' ),		
		posts_per_page:ppp,
		rgb:selrgb,
		mratio:maratio,
		product_category: MyAjax.product_category,		
		page_id: MyAjax.page_id,
		price_from: price_from,
		price_to: price_to,
		// send the nonce along with the request
		postCommentNonce : MyAjax.postCommentNonce
	},
	function( response ) {
		//alert( response );
		jQuery("#tumbs .row").replaceWith("");
		jQuery("#pagenavifirst").remove();
		

		jQuery("#pagenavifirst2").remove();
		jQuery("#tumbs").append(response);
		jQuery("#tumbs").css( {"opacity":"1"});
		jQuery("#loading").css( {"display":"none"});
			
		equalheights();
		
		
		
	}
	
);

}); 











jQuery(document).on('click', '.color', function(){
	var rgb = jQuery(this).css("background-color");
	var colormatchratio = jQuery( "#colormatch" ).slider( "value" );

        var ppp = jQuery("#filterid").val();
 	jQuery.cookies.set( 'selectedrgb', rgb);
 	jQuery.cookies.set( 'matchratio', colormatchratio);
 	jQuery.cookies.set( 'popepa', ppp);
 
 
 
 jQuery("#tumbs").css( {"opacity":"1"});
checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values == null){cv4 = '';}
if(checked_values != null){
for(i=0;i< checked_values.length;i++){

if(i == 0){ cv4 = checked_values[i];}else{ } 
cv4 = checked_values[i] + " " + cv4;

}
}
jQuery("#loading").css( {"display":"inline"});
var price_from = jQuery( "#slider-range" ).slider( "values", 0 );//jQuery("#price_range1").text();
var price_to = jQuery( "#slider-range" ).slider( "values", 1 )//jQuery("#price_range2").text();

var order_by = jQuery( this ).attr('id');
var prc_frm = jQuery( "#min" ).text();
var prc_to = jQuery( "#max" ).text();
var order = jQuery("#"+order_by + "order").text();
var orderv = ''; var orderc = '';

jQuery(".ajax_filter").removeClass("selected");
jQuery(this).addClass("selected");

var s_orderby = jQuery(".selected").attr("id");
if( order == '-'  ){ orderc = '+' }
if( order == '+'  ){ orderc = '-' }

jQuery.cookies.set( 'sel_orderby', order_by);
jQuery.cookies.set( 'sel_order', orderc);

if( order == '-'  ){ jQuery("#"+order_by + "order").text("+"); orderv = 'ASC'; }else{jQuery("#"+order_by + "order").text("-"); orderv = 'DESC';}

 
        
        
        jQuery.post(
	MyAjax.ajaxurl,
	{
		action : 'myajax-submit',
		postID : MyAjax.postID,
		meta_key : 'Price',
		meta_value : cv4,		
		orderby : order_by,
		order : orderv,
		paged : '',
		search : jQuery.cookies.get( 'search' ),
		author : jQuery.cookies.get( 'author' ),
		posts_per_page:ppp,
		rgb:rgb,
		mratio:colormatchratio,
		price_from: price_from,
		price_to: price_to,
		product_category: MyAjax.product_category,		
		page_id: MyAjax.page_id,
		// send the nonce along with the request
		postCommentNonce : MyAjax.postCommentNonce
	},
	function( response ) {
		//alert( response );
		jQuery("#tumbs .row").replaceWith("");
		jQuery("#tumbs").append(response);
		jQuery("#tumbs").css( {"opacity":"1"});
		jQuery("#loading").css( {"display":"none"});
		
		equalheights();
		
		
	}
	
);
        
        
        
    
});














jQuery("#filterid").live('keypress', function(e) {
    if(e.which == 13) {
       
      
        var ppp = jQuery("#filterid").val();
 	jQuery.cookies.set( 'popepa', ppp);
 
 
 
 
 
 
 
 
 
 
 
 
 
 jQuery("#tumbs").css( {"opacity":"1"});
checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values == null){cv4 = '';}
if(checked_values != null){
for(i=0;i< checked_values.length;i++){

if(i == 0){ cv4 = checked_values[i];}else{ } 
cv4 = checked_values[i] + " " + cv4;

}
}
jQuery("#loading").css( {"display":"inline"});
var price_from = jQuery( "#slider-range" ).slider( "values", 0 );//jQuery("#price_range1").text();
var price_to = jQuery( "#slider-range" ).slider( "values", 1 )//jQuery("#price_range2").text();

var order_by = jQuery( this ).attr('id');
var prc_frm = jQuery( "#min" ).text();
var prc_to = jQuery( "#max" ).text();
var order = jQuery("#"+order_by + "order").text();
var orderv = ''; var orderc = '';

jQuery(".ajax_filter").removeClass("selected");
jQuery(this).addClass("selected");

var s_orderby = jQuery(".selected").attr("id");
if( order == '-'  ){ orderc = '+' }
if( order == '+'  ){ orderc = '-' }

jQuery.cookies.set( 'sel_orderby', order_by);
jQuery.cookies.set( 'sel_order', orderc);

if( order == '-'  ){ jQuery("#"+order_by + "order").text("+"); orderv = 'ASC'; }else{jQuery("#"+order_by + "order").text("-"); orderv = 'DESC';}

 
 
 
 
 
selrgb = jQuery.cookies.get( 'selectedrgb' );
maratio = jQuery.cookies.get( 'matchratio' ); 
 
        
        
        jQuery.post(
	MyAjax.ajaxurl,
	{
		action : 'myajax-submit',
		postID : MyAjax.postID,
		meta_key : 'Price',
		meta_value : cv4,		
		orderby : order_by,
		order : orderv,
		paged : '',
		search : jQuery.cookies.get( 'search' ),
		author : jQuery.cookies.get( 'author' ),
		posts_per_page:ppp,
		rgb:selrgb,
		mratio:maratio,
		price_from: price_from,
		price_to: price_to,
		product_category: MyAjax.product_category,		
		page_id: MyAjax.page_id,
		// send the nonce along with the request
		postCommentNonce : MyAjax.postCommentNonce
	},
	function( response ) {
		//alert( response );
		jQuery("#tumbs .row").replaceWith("");
		jQuery("#tumbs").append(response);
		jQuery("#tumbs").css( {"opacity":"1"});
		jQuery("#loading").css( {"display":"none"});
		
		equalheights();
	}
	
);
        
        
        
    }
});

jQuery(".ajax_filter").live('click', function() {
jQuery("#tumbs").css( {"opacity":"1"});
checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values == null){cv4 = '';}
if(checked_values != null){
for(i=0;i< checked_values.length;i++){

if(i == 0){ cv4 = checked_values[i];}else{ } 
cv4 = checked_values[i] + " " + cv4;

}
}
jQuery("#loading").css( {"display":"inline"});
var price_from = jQuery( "#slider-range" ).slider( "values", 0 );//jQuery("#price_range1").text();
var price_to = jQuery( "#slider-range" ).slider( "values", 1 )//jQuery("#price_range2").text();

var order_by = jQuery( this ).attr('id');
var prc_frm = jQuery( "#min" ).text();
var prc_to = jQuery( "#max" ).text();
var order = jQuery("#"+order_by + "order").text();
var orderv = ''; var orderc = '';

jQuery(".ajax_filter").removeClass("selected");
jQuery(this).addClass("selected");

var s_orderby = jQuery(".selected").attr("id");
if( order == '-'  ){ orderc = '+' }
if( order == '+'  ){ orderc = '-' }

jQuery.cookies.set( 'sel_orderby', order_by);
jQuery.cookies.set( 'sel_order', orderc);

if( order == '-'  ){ jQuery("#"+order_by + "order").text("+"); orderv = 'ASC'; }else{jQuery("#"+order_by + "order").text("-"); orderv = 'DESC';}


//alert(jQuery( this || "#order" ).text());
//alert(order_by);

var ppp = jQuery.cookies.get( 'popepa' );

jQuery.post(
	MyAjax.ajaxurl,
	{
		action : 'myajax-submit',
		postID : MyAjax.postID,
		meta_key : 'Price',
		meta_value : cv4,		
		orderby : order_by,
		order : orderv,
		paged : '',
		search : jQuery.cookies.get( 'search' ),
		author : jQuery.cookies.get( 'author' ),
		posts_per_page:ppp,
		price_from: price_from,
		price_to: price_to,
		product_category: MyAjax.product_category,		
		page_id: MyAjax.page_id,
		// send the nonce along with the request
		postCommentNonce : MyAjax.postCommentNonce
	},
	function( response ) {
		//alert( response );
		jQuery("#tumbs .row").replaceWith("");
		jQuery("#tumbs").append(response);
		jQuery("#tumbs").css( {"opacity":"1"});
		jQuery("#loading").css( {"display":"none"});
		
		equalheights();
	}
	
);
}); 


var checked_values = [];
jQuery(".meta_key_filter").live('click', function() {

jQuery("#loading").css( {"display":"inline"});
var order_by = jQuery( this ).attr('id');
var checked = jQuery( this ).attr('checked');
var prc_frm = jQuery( "#min" ).text();
var prc_to = jQuery( "#max" ).text();
var order = jQuery("#"+order_by + "order").text();
var mk = jQuery(this).attr("class");

	var orb2 = jQuery.cookies.get( 'sel_orderby' );
	var or2 = jQuery.cookies.get( 'sel_order' );

var cv = ''; var comma = '';
if(checked == "checked"){
var meta_key = mk.replace(" meta_key_filter", "");
var meta_value = jQuery( this ).val();

checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values == null){ var checked_values = []; }
if(meta_value != null || meta_value != ''){ checked_values.push(meta_value); jQuery.cookies.set( 'checked_mvs', checked_values); }


if(checked_values != null){
for(i=0;i< checked_values.length;i++){

if(checked_values[i] != meta_value){}

if(i == 0){ cv = checked_values[i];}else{ } 
cv = checked_values[i] + " " + cv;

}
}


jQuery.cookies.set( 'checked_mv', checked);
jQuery.cookies.set( 'checked_mk', meta_key);
 


}else{

checked_values = jQuery.cookies.get( 'checked_mvs' );

var meta_value = jQuery( this ).val();
for(i=0;i< checked_values.length;i++){
if(checked_values[i] == meta_value){
checked_values[i] = '';
}

jQuery.cookies.set( 'checked_mvs', checked_values);
checked_values = jQuery.cookies.get( 'checked_mvs' );
if(checked_values[i] != ''){
jQuery.cookies.set( 'checked_mvs', checked_values);
checked_values = jQuery.cookies.get( 'checked_mvs' );
cv = checked_values[i]+" "+cv;

}


}
}



if(checked_values == null || checked_values == '') { checked_values = []; }else{   checked_values = jQuery.cookies.get( 'checked_mvs' ); }







//jQuery(".meta_key_filter").removeClass("selected");
//jQuery(this).addClass("selected");

var price_from = jQuery( "#slider-range" ).slider( "values", 0 );//jQuery("#price_range1").text();
var price_to = jQuery( "#slider-range" ).slider( "values", 1 );//jQuery("#price_range2").text();

jQuery.cookies.set( 'meta_key', meta_key);


if( order == '-'  ){ jQuery("#"+order_by + "order").text("+"); order = 'DESC'; }else{jQuery("#"+order_by + "order").text("-"); order = 'ASC';}


var anychecked = 'false';
jQuery(".meta_key_filter").each(function(index) {
var ischecked = jQuery(this).attr("checked");
if(ischecked == true ){ anychecked = 'true';}
});
jQuery("#tumbs").css( {"opacity":"1"});
if(anychecked == 'true'){meta_key = '';}else{meta_key = 'Price';}
//alert(anychecked);

var ppp = jQuery.cookies.get( 'popepa' );

jQuery.post(
	MyAjax.ajaxurl,
	{
		action : 'myajax-submit',
		postID : MyAjax.postID,
		meta_key : meta_key,
		meta_value: cv,
		orderby : orb2,
		order : or2,
		paged : '',
		search : jQuery.cookies.get( 'search' ),
		author : jQuery.cookies.get( 'author' ),
		posts_per_page:ppp,
		price_from: price_from,
		price_to: price_to,
		product_category: MyAjax.product_category,		
		page_id: MyAjax.page_id,
		// send the nonce along with the request
		postCommentNonce : MyAjax.postCommentNonce
	},
	function( response ) {
		//alert( response );
		jQuery("#tumbs .row").replaceWith("");
		jQuery("#tumbs").append(response);
		jQuery("#tumbs").css( {"opacity":"1"});
		jQuery("#loading").css( {"display":"none"});
		
		equalheights();
	}
	
);
}); 











 });