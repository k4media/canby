<?php

/**
 * Plugin Name: Canby Publications
 * Plugin URI:  http://canbypublications.com
 * Description: Canby Publications web site functionality
 * Author:      Robert Starkweather
 * Author URI:  http://www.k4media.com
 * Version:     0.0.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
* include our Canby custom post types
*/
require_once( plugin_dir_path( __FILE__ ) . 'includes/canby-post-types.php');

//add_action( 'wp_enqueue_scripts', 'canby_plugin_enqueue_scripts' );
function canby_plugin_enqueue_scripts() {
	/*
	* plugin styles
	*/
	//wp_enqueue_style( 'swiam', plugins_url('css/canby.css', __FILE__) );
}


?>