<?php

/*

Plugin Name: Wosci Install Plugin 
Description: DEACTIVATE THIS PLUGIN AFTER ACTIVATING
Plugin URI: http://www.wosci.com/
Version: 1.1
Author: Kadir Korkmaz
Author URI: http://www.wosci.com
License: GPL2
*/
$wp_rewrite = new WP_Rewrite();
function wosci_sql_import() {

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (mysqli_connect_errno()) {
	    echo __('Database Connect failed','wosci-translate');
	    exit();
	}
	
	function get_page_by_name($pagename)
	{
	$pages = get_pages();
	foreach ($pages as $page) if ($page->post_name == $pagename) return $page;
	return false;
	}
	
	$checkpost = $mysqli->query("SELECT * FROM wp_posts where post_name='test-product-a'");
	if( $checkpost->num_rows < 1 ){

	$names = array( 'Test Product A', 'Test Product B', 'Test Product C', 'Test Product D', 'Test Product E', 'Test Product F', 'Test Product U', 'Test Product H', 'Test Product I' );
	$filenames = array('446942_2.jpg', '419109.jpg', '334183_2.jpg', '338007_2.jpg', '339027_2.jpg', '340733_2.jpg', '405212_2.jpg', '432826.jpg', 'F10.jpg');
	$names = array_values($names); $filenames = array_values($filenames);
	require_once(ABSPATH . 'wp-admin/admin.php');
	
	$insertterm = $mysqli->query("INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES (NULL, 'My Category', 'my-category', 0)");

	$iid = $mysqli->insert_id;
	$inserttermtax = $mysqli->query("INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES (NULL, '" . $iid . "', 'product_category', 'My Products Category', 0, 0)");
	$ttid = $mysqli->insert_id;
	

	//$cat_id = wp_insert_category($my_cat);	



	for( $i=0; $i < count($names); $i++ ){
	$post = array(
	  'comment_status' => 'open' ,
	  'ping_status'    => 'open' , 
	  'post_author'    => 1 , 
	  'post_content'   => '',
	  'post_parent'    => '',
	  'post_excerpt'   => '', 
	  'post_name'      => sanitize_title_with_dashes($names[$i]), 
	  'post_status'    => 'publish',
	  'post_title'     => $names[$i],
	  'post_type'      => 'product'
	);

	$postdata = get_page_by_name( sanitize_title_with_dashes($names[$i]) );
	if (!$postdata) { }
	$pid = wp_insert_post( $post ); 

	$setcat = $mysqli->query("INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ('" . $pid . "', '" . $ttid . "', 0)");
	
	//$post_categories = array( $iid );//2 kategori ID, 3 yay?nevei ID, 4 yazar ID
	//wp_set_post_terms( $post_id, $tag, $taxonomy );
	//wp_set_post_categories( $pid, $post_categories );
	
	$wp_filetype = wp_check_filetype(basename($filenames[$i]), null );
	$wp_upload_dir = wp_upload_dir();
	$attachment = array(
	     'guid' => $wp_upload_dir['baseurl'] . '/' . basename( $filenames[$i] ), 
	     'post_mime_type' => $wp_filetype['type'],
	     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filenames[$i])),
	     'post_content' => '',
	     'post_status' => 'inherit'
	  );
	$attach_id = wp_insert_attachment( $attachment, $wp_upload_dir['basedir'] . '/' . basename( $filenames[$i], $pid ) );
	// you must first include the image.php file
	// for the function wp_generate_attachment_metadata() to work
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attach_data = wp_generate_attachment_metadata( $attach_id, $wp_upload_dir['basedir'] . '/' . basename( $filenames[$i] ) );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	
	$mysqli->query("INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES (NULL, '" . $attach_id . "', '_wp_attached_file', '" . $wp_upload_dir['subdir'] . '/'.  $filenames[$i] . "')");

	$mysqli->query("INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES (NULL, '" . $pid . "', '_thumbnail_id', '" . $attach_id . "')");
	
	$tarray = array('Travel', 'Science-Fiction','Law','History','Romance','Spirituality','Science-Math','Literature');
	$farray = array('Paperback', 'Hardcover','Board-Book');

	
	update_post_meta($pid, 'Currency', 'USD');
	update_post_meta($pid, 'Price', rand(10,100) );
	update_post_meta($pid, 'Quantity',  rand(30,90) );
	update_post_meta($pid, 'Weight',  rand(1, 11) * 0.1 );
	update_post_meta($pid, 'Type',  $tarray[rand(0, count($tarray)-1)] );
	update_post_meta($pid, 'Format',  $farray[rand(0, count($farray)-1)] );
	
	
	}
	update_user_meta(1, 'customer_default_address_id',  1 );
	}



	

	


	

	$mysqli->multi_query( file_get_contents( dirname( __FILE__ ) .'/sql1.sql') );
	//$checkinstall = $mysqli->query("SELECT * FROM Zones");
/*if(  $checkinstall->num_rows < 1 ){

		

	}*/


/* Create Pages BEGIN */






$post = array(

  'comment_status' =>   'open' ,
  'ping_status'    =>  'open' , 
  'post_author'    => 1 , 
  'post_content'   => '', 
  'post_excerpt'   => '', 
  'post_name'      => 'account', 
  'post_status'    => 'publish',
  'post_title'     => 'Account',
  'post_type'      => 'page'

);  
$page = get_page_by_name('account');
if (!$page) { $post_id = wp_insert_post( $post ); }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_parent'    => $post_id,
  'post_excerpt'   => '', 
  'post_name'      => 'account-history', 
  'post_status'    => 'publish',
  'post_title'     => 'Account History',
  'post_type'      => 'page'

);  

$page = get_page_by_name('account-history');
if (!$page) { $post_id_ah = wp_insert_post( $post );  }



$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_parent'    => $post_id,
  'post_excerpt'   => '', 
  'post_name'      => 'account-history-info', 
  'post_status'    => 'publish',
  'post_title'     => 'Account History Info',
  'post_type'      => 'page'

);  

$page = get_page_by_name('account-history-info');
if (!$page) { $post_id_ahi = wp_insert_post( $post );   }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'address-book', 
  'post_status'    => 'publish',
  'post_title'     => 'Address Book',
  'post_type'      => 'page'

);  

$page = get_page_by_name('address-book');
if (!$page) { $post_id_ab = wp_insert_post( $post );   }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'cart', 
  'post_status'    => 'publish',
  'post_title'     => 'Shoppping Cart',
  'post_type'      => 'page'

);  

$page = get_page_by_name('cart');
if (!$page) { $post_id_sc = wp_insert_post( $post );   }

$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'ccpay', 
  'post_status'    => 'publish',
  'post_title'     => 'CCPay',
  'post_type'      => 'page'

);  

$page = get_page_by_name('ccpay');
if (!$page) { $post_id_ccp = wp_insert_post( $post );   }

$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'checkout-process', 
  'post_status'    => 'publish',
  'post_title'     => 'Checkout Process',
  'post_type'      => 'page'

);  

$page = get_page_by_name('checkout-process');
if (!$page) { $post_id_ccp = wp_insert_post( $post );  }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'edit-shipping-address', 
  'post_status'    => 'publish',
  'post_title'     => 'Edit Shipping Address',
  'post_type'      => 'page'

);  

$page = get_page_by_name('edit-shipping-address');
if (!$page) { $post_id_chpr = wp_insert_post( $post );  }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'new-payment-address', 
  'post_status'    => 'publish',
  'post_title'     => 'New Payment Address',
  'post_type'      => 'page'

);  

$page = get_page_by_name('new-payment-address');
if (!$page) { $post_id_npa = wp_insert_post( $post );  }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'new-shipping-address', 
  'post_status'    => 'publish',
  'post_title'     => 'New Shipping Address',
  'post_type'      => 'page'

);  

$page = get_page_by_name('new-shipping-address');
if (!$page) { $post_id_nsa = wp_insert_post( $post );  }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'order-confirmation', 
  'post_status'    => 'publish',
  'post_title'     => 'Order Confirmation',
  'post_type'      => 'page'

);  

$page = get_page_by_name('order-confirmation');
if (!$page) { $post_id_oc = wp_insert_post( $post );  }

$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'pdf-invoice', 
  'post_status'    => 'publish',
  'post_title'     => 'PDF Invoice',
  'post_type'      => 'page'

);  

$page = get_page_by_name('pdf-invoice');
if (!$page) { $post_id_pi = wp_insert_post( $post );  }


$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'shipping-payment', 
  'post_status'    => 'publish',
  'post_title'     => 'Shipping Payment',
  'post_type'      => 'page'

);  

$page = get_page_by_name('shipping-payment');
if (!$page) { $post_id_sp = wp_insert_post( $post );  }



$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => '',
  'post_excerpt'   => '', 
  'post_name'      => 'success', 
  'post_status'    => 'publish',
  'post_title'     => 'Success',
  'post_type'      => 'page'

);  

$page = get_page_by_name('success');
if (!$page) { $post_id_s = wp_insert_post( $post );  }

$post = array(

  'comment_status' => 'open' ,
  'ping_status'    => 'open' , 
  'post_author'    => 1 , 
  'post_content'   => 'Put your online sale and purchase agreement text here',
  'post_parent'    => $post_id,
  'post_excerpt'   => '', 
  'post_name'      => 'agreement', 
  'post_status'    => 'publish',
  'post_title'     => 'Sales And Purchase Agreement',
  'post_type'      => 'page'

);  

$page = get_page_by_name('agreement');
if (!$page) { $post_id_spa = wp_insert_post( $post );  }


/*Create Pages END*/

}

//wosci_sql_import() ;
add_action( 'plugins_loaded', 'wosci_sql_import' );



?>