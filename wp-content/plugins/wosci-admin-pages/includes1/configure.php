<?php

	$rootdomain = substr( get_site_url(), 0, strrpos(get_site_url(),'/') );
	$folder = substr( get_site_url(), strrpos(get_site_url(),'/') + 1 );
	$dir = plugin_dir_path( __FILE__ );
	$wordpress_path = substr($dir, 0, strpos($dir, 'wp-content'));
	
	define('HTTP_SERVER', $rootdomain );
	define('HTTPS_SERVER', $rootdomain );
	$rootcookiedomain = str_replace('http://','', $rootdomain);
	define('HTTP_COOKIE_DOMAIN', $rootcookiedomain );
	define('HTTPS_COOKIE_DOMAIN', $rootcookiedomain );
  
	define('HTTP_COOKIE_PATH', '/' . $folder . '/');
	define('HTTPS_COOKIE_PATH', '/' . $folder . '/');
	define('DIR_WS_HTTP_CATALOG', '/' . $folder . '/');
	define('DIR_WS_HTTPS_CATALOG', '/' . $folder . '/');
  
	define('DIR_WS_IMAGES', 'images/');
	define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
	define('DIR_WS_INCLUDES', 'includes1/');
	define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
	define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
	define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
	define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
	define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

	define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
	define('DIR_FS_CATALOG', $wordpress_path );
	define('DIR_FS_CATALOG_MODULES', $dir . 'modules/');
	define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
	define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

	define('DB_SERVER', DB_HOST);
	define('DB_SERVER_USERNAME', DB_USER);
	define('DB_SERVER_PASSWORD', DB_PASSWORD);
	define('DB_DATABASE', DB_NAME);
	define('USE_PCONNECT', 'false');
	define('STORE_SESSIONS', 'mysql');


?>