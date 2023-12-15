<?php
/*
Plugin Name: Slider Revolution Transitionpack Add-On
Plugin URI: http://www.themepunch.com/
Description: Create beautiful WebGL Transitions in Slider Revolution
Author: ThemePunch
Version: 1.0.6
Author URI: http://themepunch.com
*/

/*

SCRIPT HANDLES:
	
	'rs-transitionpack-admin'
	'rs-transitionpack-front'

*/

// If this file is called directly, abort.
if(!defined('WPINC')) die;

define('RS_TRANSITIONPACK_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('RS_TRANSITIONPACK_PLUGIN_URL', str_replace('index.php', '', plugins_url( 'index.php', __FILE__)));

require_once(RS_TRANSITIONPACK_PLUGIN_PATH . 'includes/base.class.php');

/**
* handle everyting by calling the following function *
**/
function rs_transitionpack_init(){

	new RsTransitionpackBase();
	
}

/**
* call all needed functions on plugins loaded *
**/
add_action('plugins_loaded', 'rs_transitionpack_init');
register_activation_hook( __FILE__, 'rs_transitionpack_init');

//build js global var for activation
add_filter( 'revslider_activate_addon', array('RsAddOnTransitionpackBase','get_data'),10,2);

// get help definitions on-demand.  merges AddOn definitions with core revslider definitions
add_filter( 'revslider_help_directory', array('RsAddOnTransitionpackBase','get_help'),10,1);

?>