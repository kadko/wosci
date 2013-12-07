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
  <div class="well">
<?php /* Template Name: Wosci - Create Post Page*/ ?>
<div style="margin-top:20px;"></div>	
<div class="alert alert-success">
<h3><span class="glyphicon glyphicon-ok"></span>     <?php _e('Your order has been successfully placed. Thank you!', 'wosci-language');?></h3></div>	
<div style="margin-top:10px;"></div>	



<?php




$post = array(
//  'ID'             => [ <post id> ] //Are you updating an existing post?
//  'menu_order'     => [ <order> ] //If new post is a page, it sets the order in which it should appear in the tabs.
  'comment_status' =>   'open' , // 'closed' means no comments.
  'ping_status'    =>  'open' , // 'closed' means pingbacks or trackbacks turned off
//  'pinged'         => [ ? ] //?
  'post_author'    => 1 , //The user ID number of the author.
//  'post_category'  => [ array(<category id>, <...>) ] //post_category no longer exists, try wp_set_post_terms() for setting a post's categories
  'post_content'   => $content, //The full text of the post.
//  'post_date'      => [ Y-m-d H:i:s ] //The time post was made.
//  'post_date_gmt'  => [ Y-m-d H:i:s ] //The time post was made, in GMT.
  'post_excerpt'   => $excerpt, //For all your post excerpt needs.
  'post_name'      => $name, // The name (slug) for your post
//  'post_parent'    => [ <post ID> ] //Sets the parent of the new post.
//  'post_password'  => [ ? ] //password for post?
  'post_status'    => 'publish',//[ 'draft' | 'publish' | 'pending'| 'future' | 'private' | 'custom_registered_status' ] //Set the status of the new post.
  'post_title'     => $title, //The title of your post.
  'post_type'      => 'product'//[ 'post' | 'page' | 'link' | 'nav_menu_item' | 'custom_post_type' ] //You may want to insert a regular post, page, link, a menu item or some custom post type
//  'tags_input'     => [ '<tag>, <tag>, <...>' ] //For tags.
//  'to_ping'        => [ ? ] //?
//  'tax_input'      => [ array( 'taxonomy_name' => array( 'term', 'term2', 'term3' ) ) ] // support for custom taxonomies. 
);  

$post_id = wp_insert_post( $post ); 

$post_categories = array(2,3,4);//2 kategori ID, 3 yayınevei ID, 4 yazar ID
//wp_set_post_terms( $post_id, $tag, $taxonomy );
wp_set_post_categories( $post_ID, $post_categories );
  $wp_filetype = wp_check_filetype(basename($filename), null );
  $wp_upload_dir = wp_upload_dir();
  $attachment = array(
     'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ), 
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit'
  );
  $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
  // you must first include the image.php file
  // for the function wp_generate_attachment_metadata() to work
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
  wp_update_attachment_metadata( $attach_id, $attach_data );
?>




<p>Please check your <b>email inbox</b> for more details about your order. Don't forget to check <b>spam</b> folder!</p>
<div style="margin-top:20px;"></div>	
	
</div><!--.well-->
<?php get_footer(); ?>