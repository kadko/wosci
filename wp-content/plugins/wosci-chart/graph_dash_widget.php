<?php
/*
Plugin Name: Sales Chart With Daily Order Details
Plugin URI: http://wosci.com
Description: Daily sales graphical chart with order datails on same screen.
Author: Kadir Korkmaz
Version: 1.1
Author URI: http://wosci.com/
*/


function hschart () {


include ('grafik_data.php');

}


function my_wp_dashboard_test() {

hschart();

//echo 'Test Add Dashboard-Widget';
}
 
/**
 * add Dashboard Widget via function wp_add_dashboard_widget()
 */
function my_wp_dashboard_setup() {
if ( current_user_can('manage_categories') )
	wp_add_dashboard_widget( 'my_wp_dashboard_test', __('Monthly Sales Chart','wosci-language'), 'my_wp_dashboard_test' );
}
 
/**
 * use hook, to integrate new widget
 */
add_action('wp_dashboard_setup', 'my_wp_dashboard_setup');

?>