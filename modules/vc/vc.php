<?php
/**
 * reset visual composer for Gnews-VC
 */


// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

	if ( ! class_exists( 'Gnews_VC_VC' ) ) {

		/**
		 * Visual Composer plugins for Gnews-VC
		 */
		class Gnews_VC_VC {

			/**
			 * construct
			 */
			function __construct() {

				// initialize visual composer
				add_action( 'vc_before_init', array( $this, 'init' ) );

				return;
			}

			/**
			 * vc_before_init hook
			 */
			function init() {

				$this->load_dependencies();
				$this->reset_vc();
				$this->addons();

				return;
			}

			/**
			 * Load dependence files
			 */
			private function load_dependencies() {
				require_once( GNEWS_VC_PLUGIN_MODULE_VC . 'inc/class-components.php' );
			}

			/**
			 * enable/reset visual composer
			 */
			public function reset_vc() {

				// reset visual composer editor type
				vc_set_default_editor_post_types( array(
					'page',
					'post'
				) );

				// Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
				vc_set_as_theme();

				return;
			}

			/**
			 * enable addons on vc_before_init hook
			 */
			public function addons() {
				$gnews_vc_addons = array(
					'news-block1'
				);

				foreach ( $gnews_vc_addons as $addon_name ) {
					if ( file_exists( GNEWS_VC_PLUGIN_MODULE_VC_COMPONENTS_CLASSES . 'class-component-' . $addon_name . '.php' ) ) {
						require_once( GNEWS_VC_PLUGIN_MODULE_VC_COMPONENTS_CLASSES . 'class-component-' . $addon_name . '.php' );
					}
				}

				return;
			}
		}
	}

	// start visual composer
	new Gnews_VC_VC;
}
