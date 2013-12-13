<?php

	$dir = plugin_dir_path( __FILE__ );
	$wordpress_path = substr($dir, 0, strpos($dir, 'wp-content'));

	define('DIR_FS_CATALOG', $wordpress_path);
	define('DIR_WS_IMAGES', 'images/');
	define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
	define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
	define('DIR_WS_INCLUDES', 'includes2/');
	define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
	define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
	define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
	define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
	define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
	define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'wp-content/plugins/wosci-admin-pages/includes1/languages/');
	define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'wp-content/plugins/wosci-admin-pages/includes1/languages/');
	define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
	define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'wp-content/plugins/wosci-admin-pages/includes1/modules/');
	define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');

?>