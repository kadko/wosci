<?php
/*
Plugin Name: Wosci PageNavi
Version: 2.73
Description: Adds a more advanced paging navigation to your Wosci shop
Author: Lester 'GaMerZ' Chan & scribu
Plugin URI: 
Text Domain: wp-pagenavi
Domain Path: /lang


Copyright 2009  Lester Chan  ( email : lesterchan@gmail.com )

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
( at your option ) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

require dirname( __FILE__ ) . '/scb/load.php';

function _pagenavi_init() {
	//load_plugin_textdomain( 'wp-pagenavi', '', dirname( plugin_basename( __FILE__ ) ) . '/lang' );

	require_once dirname( __FILE__ ) . '/core.php';

	$options = new scbOptions( 'pagenavi_options', __FILE__, array(
		'pages_text'    => __( 'Page %CURRENT_PAGE% of %TOTAL_PAGES%', 'wosci-language' ),
		'current_text'  => '%PAGE_NUMBER%',
		'page_text'     => '%PAGE_NUMBER%',
		'first_text'    => __( '&laquo; First', 'wosci-language' ),
		'last_text'     => __( 'Last &raquo;', 'wosci-language' ),
		'prev_text'     => __( '&laquo;', 'wosci-language' ),
		'next_text'     => __( '&raquo;', 'wosci-language' ),
		'dotleft_text'  => __( '...', 'wosci-language' ),
		'dotright_text' => __( '...', 'wosci-language' ),
		'num_pages' => 5,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'always_show' => false,
		'use_pagenavi_css' => true,
		'style' => 1,
	) );

	PageNavi_Core::init( $options );

	if ( is_admin() ) {
		require_once dirname( __FILE__ ) . '/admin.php';
		new PageNavi_Options_Page( __FILE__, $options );
	}
}
scb_init( '_pagenavi_init' );

