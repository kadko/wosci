<?php
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */


function toggle_plugin() {
$dir = plugin_dir_path( __FILE__ );
$wordpress_path = substr($dir, 0, strpos($dir, 'wp-content'));
//$wordpress_path = "/path/to/my/wordpress/install";    
require_once( $wordpress_path . '/wp-load.php' ); //not sure if this line is needed
//activate_plugin() is here:
require_once(  $wordpress_path . '/wp-admin/includes/plugin.php');
$plugins = array("custom-post-type-ui/custom-post-type-ui", "wosci-widgets/wosci-widgets", "wosci-install/wosci-install", "wosci-admin-pages/wosci-admin-pages", "breadcrumb-navxt/breadcrumb_navxt_admin","wp-pagenavi/wp-pagenavi","wosci-chart/graph_dash_widget");

foreach ($plugins as $plugin){
$plugin_path = $wordpress_path.'wp-content/plugins/'.$plugin.'.php';


if(!is_plugin_active($plugin_path) && is_plugin_active('wosci-install/wosci-install.php')) {
 activate_plugin($plugin_path);
}
 


}
		
}

toggle_plugin() ;





add_action('init', 'do_output_buffer');
function do_output_buffer() {
        ob_start();
}
 
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
 
 
function mySearchFilter($query) {
	
	$post_type = 'product';
	if (!$post_type) {
		$post_type = 'any';
	}
    if ($query->is_search || $query->is_author) {
        $query->set('post_type', $post_type);
    };
    return $query;
}

add_filter('pre_get_posts','mySearchFilter');
  
function wosci_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'wosci' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wosci', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'wosci' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'wosci_setup' );

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Returns the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function wosci_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'wosci' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		 this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'wosci' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'wosci-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	$font_url = wosci_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'wosci-fonts', esc_url_raw( $font_url ), array(), null );

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'wosci-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'wosci-ie', get_template_directory_uri() . '/css/ie.css', array( 'wosci-style' ), '20121010' );
	$wp_styles->add_data( 'wosci-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'wosci_scripts_styles' );

/**
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses wosci_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string
 */
function wosci_mce_css( $mce_css ) {
	$font_url = wosci_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'wosci_mce_css' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function wosci_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'wosci' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wosci_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wosci_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'wosci' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'wosci' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'wosci' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'wosci' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'wosci' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'wosci' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'wosci_widgets_init' );

if ( ! function_exists( 'wosci_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'wosci' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older products', 'wosci' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer products <span class="meta-nav">&rarr;</span>', 'wosci' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'wosci_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wosci_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'wosci' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'wosci' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Product author', 'wosci' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'wosci' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wosci' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'wosci' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wosci' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'wosci_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own wosci_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'wosci' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'wosci' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all products by %s', 'wosci' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This product was created in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'wosci' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This product was created in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'wosci' );
	} else {
		$utility_text = __( 'This product was created on %3$s<span class="by-author"> by %4$s</span>.', 'wosci' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function wosci_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'wosci-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'wosci_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'wosci_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function wosci_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wosci_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function wosci_customize_preview_js() {
	wp_enqueue_script( 'wosci-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'wosci_customize_preview_js' );













add_action( 'wp_ajax_nopriv_myajax-submit', 'myajax_submit' );
add_action( 'wp_ajax_myajax-submit', 'myajax_submit' );

// this hook is fired if the current viewer is not logged in
//do_action( 'wp_ajax_nopriv_myajax-submit' . $_REQUEST['action'] );
// if logged in:
//do_action( 'wp_ajax_myajax-submit' . $_POST['action'] );

function myajax_submit() {
global $current_user, $currencies;
	$nonce = $_POST['postCommentNonce'];

	// check to see if the submitted nonce matches with the
	// generated nonce we created earlier
	/**/
	if ( ! wp_verify_nonce( $nonce, 'myajax-post-comment-nonce' ) )
		{
	//	die ( 'Busted!');
		}

	// get the submitted parameters
	$postID = $_POST['postID'];

	// generate the response
	$response = json_encode( array( 'success' => true ) );

	// response output
	//header( "Content-Type: application/json" );
	?>
	
	


<div class="row"> 

        <?php 
      
	// $pfrom_to = ''; $pfrom_to = "".($_REQUEST["price_from"]).','.$_REQUEST["price_to"]."";
        $pfrom_to = array($_REQUEST["price_from"],$_REQUEST["price_to"]);
        $price_qry = array('meta_compare' => 'BETWEEN', 'meta_type' => 'NUMERIC', 'meta_value' => $pfrom_to);

if($_POST['meta_key'] =='Price'){    
        query_posts(
        
        array('order' => $_POST['order'], 'orderby' => $_POST['orderby'], 'paged' => $_POST['paged'], 'post_type' => 'product','meta_key' => $_POST['meta_key'], 'meta_compare' => 'BETWEEN', 'meta_type' => 'NUMERIC', 'meta_value' => $pfrom_to)

        );
}else{
        query_posts(
        
        array('order' => $_POST['order'], 'orderby' => $_POST['orderby'], 'paged' => $_POST['paged'], 'post_type' => 'product','meta_key' => '', 'meta_value' => $_POST['meta_value'], 'meta_compare' => 'IN')

        );

}
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			// get_template_part( 'loop', 'index' );
function my_get_posts( $query ) {
			
				$query->set( 'post_type', array(  'product' ) );
				return $query;
			
				}		

add_filter( 'pre_get_posts', 'my_get_posts' );
?>
        <?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			// get_template_part( 'loop', 'index' );
/**/	


//echo change_to_letters("8");


//echo $_REQUEST['price_from'].'-'.$_REQUEST['price_to'];
//echo $_POST['meta_key'];

// ürün listelemesinde s?ralama düzeni için http://codex.wordpress.org/Template_Tags/query_posts#Order_Parameters
/*if($_POST['meta_key'] =='Price'){    
$loop = new WP_Query( array('order' => $_POST['order'], 'orderby' => $_POST['orderby'], 'paged' => $_POST['paged'], 'post_type' => 'product','meta_key' => $_POST['meta_key'], 'meta_compare' => 'BETWEEN', 'meta_type' => 'NUMERIC', 'meta_value' => $pfrom_to) );
}else{
$loop = new WP_Query( array('order' => $_POST['order'], 'orderby' => $_POST['orderby'], 'paged' => $_POST['paged'], 'post_type' => 'product','meta_key' => '', 'meta_value' => $_POST['meta_value'], 'meta_compare' => 'IN') );

}*/

$rgb = str_replace ('rgb(','',$_REQUEST['rgb']);
$rgb = str_replace (')','',$rgb );
$rgb_a = explode(',',$rgb);
$ratiojoin = $_REQUEST['mratio'].$_REQUEST['mratio'].$_REQUEST['mratio'];
global $wpdb;
 $querystr = "
    SELECT $wpdb->posts.* , HexColorDistance('".$rgb_a[0]."', '".$rgb_a[1]."', '".$rgb_a[2]."', SUBSTRING($wpdb->postmeta.meta_value,1,3), SUBSTRING($wpdb->postmeta.meta_value,5,3), SUBSTRING($wpdb->postmeta.meta_value,9,3),SUBSTRING($wpdb->postmeta.meta_value,13,3), SUBSTRING($wpdb->postmeta.meta_value,17,3), SUBSTRING($wpdb->postmeta.meta_value,21,3), SUBSTRING($wpdb->postmeta.meta_value,25,3), SUBSTRING($wpdb->postmeta.meta_value,29,3), SUBSTRING($wpdb->postmeta.meta_value,33,3)) as name
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
    AND $wpdb->postmeta.meta_key = 'rgb_' 
   AND (HexColorDistanceone('".$rgb_a[0]."', '".$rgb_a[1]."', '".$rgb_a[2]."', SUBSTRING($wpdb->postmeta.meta_value,1,3), SUBSTRING($wpdb->postmeta.meta_value,5,3), SUBSTRING($wpdb->postmeta.meta_value,9,3)) > ".$_REQUEST['mratio']."
   OR HexColorDistanceone('".$rgb_a[0]."', '".$rgb_a[1]."', '".$rgb_a[2]."', SUBSTRING($wpdb->postmeta.meta_value,13,3), SUBSTRING($wpdb->postmeta.meta_value,17,3), SUBSTRING($wpdb->postmeta.meta_value,21,3)) > ".$_REQUEST['mratio']."
   OR HexColorDistanceone('".$rgb_a[0]."', '".$rgb_a[1]."', '".$rgb_a[2]."', SUBSTRING($wpdb->postmeta.meta_value,25,3), SUBSTRING($wpdb->postmeta.meta_value,29,3), SUBSTRING($wpdb->postmeta.meta_value,33,3)) > ".$_REQUEST['mratio'].")
    AND $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = 'product'
    AND $wpdb->posts.post_date < NOW()
    ORDER BY name DESC
 ";

 $pageposts = $wpdb->get_results($querystr, OBJECT);


for( $pi=0; $pi < count($pageposts); $pi++ )
	{
	$post_in[] = $pageposts[$pi]->ID;
	}
if( count($pageposts) == 0 ){ $post_in = array(0); }



/*
$args = array(
	'post__not_in' => $not_in
	);
*/
//'post__not_in' => $not_in,
/*    'posts_per_page' => '1'     kullanıcı tanımlı sayfadaki ürün sayısı 'posts_per_page' => $_POST['posts_per_page'] şeklinde yap */
if(empty($rgb_a[0]) && empty($rgb_a[1]) && empty($rgb_a[2])){
if(!empty($_POST['orderby'])){ $orderby = $_POST['orderby']; }else{ $orderby = 'name'; }

$post_in = '';
}else{
$orderby = 'post__in';
}

$args = array(
	's'=> $_POST['search'], 'author_name'=> $_POST['author'], 'post_type' => 'product','meta_key' => 'Price', 'posts_per_page' => $_POST['posts_per_page'], 'product_category' => $_POST['product_category'], 
	'post__in' => $post_in,
	'orderby' => $orderby,    
	'meta_query' => array(
		
			array	(
			'key' => 'Price',
			'value' => $pfrom_to,
			'type' => 'NUMERIC',
			'compare' => 'BETWEEN'
			)
	),
	
	'order' => $_POST['order'], 'paged' => $_POST['paged']
 );
 
$control = str_replace(' ','',$_POST['meta_value']);
if( strlen($control) > 0 ){
	$args['meta_query'][] =	array(
			'key' => '',
			'value' => $_POST['meta_value'],
			'compare' => 'IN'//'NOT LIKE'
			);
}

if($_POST['orderby'] == 'meta_value_num' ){ /**/ }
//$args['meta_key'] = 'Price';


$loop = new WP_Query( $args );
$ids[] = '';

//  $loop->posts[0] ='';$loop->posts[1] ='';$loop->posts[2] ='';$loop->posts[3] ='';$loop->posts[4] ='';$loop->posts[5] ='';$loop->posts[6] ='';$loop->posts[7] ='';$loop->posts[7] ='';$loop->posts[8] ='';

if($loop->post_count ==0){
echo '<div class="col-lg-12"><div class="margin-top"></div><div class="alert alert-warning">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Warning!</strong> Please try filtering by more general criteria.</div></div>';
};


while ( $loop->have_posts() ) : $loop->the_post();

//if(!in_array(get_the_ID(),$ids)){
//echo get_the_ID().'-';
$ids[] = get_the_ID();

$c = get_post_custom_values('Currency'); $f = get_post_custom_values('Price'); $b = get_post_custom_values('Badge'); $product_terms = wp_get_post_terms(get_the_ID(),'product_category');

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


<?php endwhile;  ?>



</div><!-- .row -->

























<?php if( $loop->post_count !== 0 ){ ?>
<div id="pagenaviloaded" class="row">
            <div class="col-lg-6"><?php wp_pagenavi($loop); ?></div>
            <div class="col-lg-6"></div>
          </div>
<?php } ?>


<?php global $post; // required
$args2 = array('post_type' => 'product'); // exclude category 9
$custom_posts = get_posts($args2);
foreach($custom_posts as $post) : setup_postdata($post);

$custom_posts2 = get_posts($args);
foreach($custom_posts2 as $post) : setup_postdata($post);

$keys[] = array_keys(@get_post_meta($post->ID));
$keys2[] = @get_post_meta($post->ID);

if($br != 'y'){ $m = get_post_custom_values('Price'); }

endforeach;

endforeach;


for ($ap=0;$ap < count($allpost);$ap++){
/*$ids[] = $allpost[$ap]->ID;
$keys[] = array_keys(get_post_meta($allpost[$ap]->ID));
$keys2[] = get_post_meta($allpost[$ap]->ID);
if($br != 'y'){ $m = get_post_custom_values('Price');}
$br = 'y';*/
}
for($ii=0;$ii<count($keys);$ii++){

for($i=0;$i<count($keys[$ii]);$i++){
if(substr($keys[$ii][$i],0,1) !='_'){
$all_keys[] = $keys[$ii][$i];

}
}

}
if( is_array($all_keys) ){
$all_keys = array_values(array_unique($all_keys));

for ($iii=0;$iii <count($all_keys);$iii++){
$w_html .='<li class=\"meta_key_filter\">'.$all_keys[$iii].'</li>';
}

for($i2=0;$i2<count($keys2);$i2++){
for($ii2=0;$ii2<count($all_keys);$ii2++){

for($iii2=0;$iii2<count($keys2[$ii2]);$iii2++){
//echo $keys2[$i2][$all_keys[$ii2]][$iii2]; //all values
if($keys2[$i2][$all_keys[$ii2]][$iii2] !='' && ($all_keys[$ii2] != 'Price' &&  $all_keys[$ii2] != 'Currency')){
//if(is_array($all[$all_keys[$ii2]])){

if( !@in_array( $keys2[$i2][$all_keys[$ii2]][$iii2], $all[$all_keys[$ii2]]) ){ $all[$all_keys[$ii2]][] = $keys2[$i2][$all_keys[$ii2]][$iii2];


}
//}
}

}

}
}
for($a=0;$a < count($all_keys);$a++){
$last = substr($all_keys[$a], -1); 
if($all_keys[$a] != 'Price' &&  $all_keys[$a] != 'Currency' && $last != '_'){
$meta_key_html .= '<h3>'.$all_keys[$a].'</h3><div class="meta_value btn-group" style="padding:12px;width:100%;" > ';
for($b=0;$b < count($all[$all_keys[$a]]);$b++){
$meta_key_html .= '<label class="btn btn-default btn-xs" for="'.$all_keys[$a].$b.'"><input style="vertical-align: middle;margin:0;padding:0;" class="'.$all_keys[$a].' meta_key_filter" name="'.$all_keys[$a].$b.'" type="checkbox" id="'.$all_keys[$a].$b.'" value="'.$all[$all_keys[$a]][$b].'" /> '.$all[$all_keys[$a]][$b].'</label>';

}
$meta_key_html .= '</div>';
}


}
//echo '**'.$meta_key_html.$_POST['meta_value'].'**';
}
?>






<?php
	// IMPORTANT: don't forget to "exit"
	exit;
}



/*PALETTE FUNCTIONS*/
function colorPalette($imageFile, $numColors, $granularity = 5) 
{

	
$remote_file = $imageFile;
$headers = get_headers($remote_file, 1);

switch ($headers['Content-Type'])
{
    case 'image/jpeg':
        $img = imagecreatefromjpeg($remote_file);
    break;
    case 'image/gif':
        $img = imagecreatefromgif($remote_file);
    break;
    case 'image/png':
        $img = imagecreatefrompng($remote_file);
    break;
    default:
        die('Invalid image type');
}
   $granularity = max(1, abs((int)$granularity)); 
   $colors = array(); 
   $size = @getimagesize($imageFile); 
   if($size === false) 
   { 
      user_error("Unable to get image size data"); 
      return false; 
   } 
   //$img = @imagecreatefrompng($imageFile);
   // Andres mentioned in the comments the above line only loads jpegs, 
   // and suggests that to load any file type you can use this:
   // $img = @imagecreatefromstring(file_get_contents($imageFile)); 

   if(!$img) 
   { 
      user_error("Unable to open image file"); 
      return false; 
   } 
   for($x = 0; $x < $size[0]; $x += $granularity) 
   { 
      for($y = 0; $y < $size[1]; $y += $granularity) 
      { 
         $thisColor = imagecolorat($img, $x, $y); 
         $rgb = imagecolorsforindex($img, $thisColor); 
         $red = round(round(($rgb['red'] / 0x33)) * 0x33); 
         $green = round(round(($rgb['green'] / 0x33)) * 0x33); 
         $blue = round(round(($rgb['blue'] / 0x33)) * 0x33); 
         $thisRGB = sprintf('%02X%02X%02X', $red, $green, $blue); 
         if(array_key_exists($thisRGB, $colors)) 
         { 
            $colors[$thisRGB]++; 
         } 
         else 
         { 
            $colors[$thisRGB] = 1; 
         } 
      } 
   } 
   arsort($colors); 
   return array_slice(array_keys($colors), 0, $numColors); 
}

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    if(strlen($rgbArray['red'])==1){ $rgbArray['red'] = '  '.$rgbArray['red']; }
    if(strlen($rgbArray['red'])==2){ $rgbArray['red'] = ' '.$rgbArray['red']; }
    if(strlen($rgbArray['green'])==1){ $rgbArray['green'] = '  '.$rgbArray['green']; }
    if(strlen($rgbArray['green'])==2){ $rgbArray['green'] = ' '.$rgbArray['green']; }
    if(strlen($rgbArray['blue'])==1){ $rgbArray['blue'] = '  '.$rgbArray['blue']; }
    if(strlen($rgbArray['blue'])==2){ $rgbArray['blue'] = ' '.$rgbArray['blue']; }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

function HexColorDistance( $color1, $color2 )
{
$color1 = str_replace("#","",$color1);
$color2 = str_replace("#","",$color2);
$C1 = array_values(hex2RGB($color1)); 
$C2 = array_values(hex2RGB($color2)); 

for ($i=0;$i<3;$i++){
//if($C1[$i]>$C2[$i]){
$tot[] = 1-(abs((($C1[$i]/255)) - abs(($C2[$i]/255))));
//}else{
//$tot[] = 1-(abs((($C2[$i]/255)) - abs(($C1[$i]/255))));
//}
}
return (array_sum($tot)/3)*100;
}
/*PALET FUNCTIONS END*/


add_action( 'added_post_meta', 'thumb_palet', 10, 4 );
add_action( 'updated_post_meta', 'thumb_palet', 10, 4 );
function thumb_palet( $meta_id, $post_id, $meta_key, $meta_value )
{

	if ( '_thumbnail_id' == $meta_key ) {
	$thumb_url = wp_get_attachment_image_src($meta_value,'thumbnail-size', true);
	
	$palette = colorPalette($thumb_url[0], 3, 4); 
	
	foreach($palette as $color) 
	{ 
	   $rgbdata .= hex2RGB($color,true,'.').','; 
	}

$numItems = count($palette);
$i = 0;
$rgbdata =''; 
foreach($palette as $color) {
  if(++$i === $numItems) {
    $rgbdata .= hex2RGB($color,true,'.'); 
  }else{
  $rgbdata .= hex2RGB($color,true,'.').','; 
  }
}


        update_post_meta($post_id, 'rgb_', $rgbdata);
    }
}


add_action('after_setup_theme', 'language_files');
function language_files(){
    load_theme_textdomain('wosci-language', get_template_directory() . '/languages');
}



/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}