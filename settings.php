<?php
/**
 * Settings for Gnews-VC plugin
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

define( 'GNEWS_VC_THEME_NAME', 'Gnews-VC-Wordpress-theme' );

// plugin url
define( 'GNEWS_VC_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'GNEWS_VC_PLUGIN_URL_VC', GNEWS_VC_PLUGIN_URL . 'modules/vc/' );

// plugin path
define( 'GNEWS_VC_PLUGIN', plugin_dir_path( __FILE__ ) );

// plugin info
define( 'GNEWS_VC_PLUGIN_ID', 'gnews-vc' );
define( 'GNEWS_VC_PLUGIN_PARENT_THEME', 'wp-theme-jannah' );

define( 'GNEWS_VC_PLUGIN_SLUG', plugin_basename( GNEWS_VC_PLUGIN . GNEWS_VC_PLUGIN_ID . '.php' ) );

// plugin modules
define( 'GNEWS_VC_PLUGIN_MODULES', GNEWS_VC_PLUGIN . 'modules/' );
define( 'GNEWS_VC_PLUGIN_MODULE_VC', GNEWS_VC_PLUGIN_MODULES . 'vc/' );
define( 'GNEWS_VC_PLUGIN_MODULE_VC_COMPONENTS_CLASSES', GNEWS_VC_PLUGIN_MODULE_VC . 'inc/class-components/' );
