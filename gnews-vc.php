<?php 
/*
Plugin Name: GNews Addon ( Visual Composer Elements )
Description: Visual Composer Elements Addon for Janah Wordpress Theme
Author: Gold Miner
Version: 1.0.0
*/

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

// check jannah theme activated
// if ( get_template() != 'jannah' ) {
// 	return;
// }

// include settings
require_once( plugin_dir_path( __FILE__ ) . 'settings.php' );

// include addons
require_once( GNEWS_VC_PLUGIN_MODULE_VC . 'vc.php' );
