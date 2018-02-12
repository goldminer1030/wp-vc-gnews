<?php
/**
 * component container layout
 *
 * @package : Gnews-VC
 * @version Gnews-VC 1.0
 */


// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Class Gnews_VC_Component_Container_Layout
 */
class Gnews_VC_Component_Container_Layout extends Gnews_VC_Component {

	/**
	 * Constructor
	 */
	function __construct() {
		add_action( 'init', array( $this, 'container_mapping' ) );
		add_shortcode( 'gnews_vc_container_layout', array( $this, 'container_func' ) );
	}

	/**
	 * Add shortcode to Visual Composer content element list
	 */
	public function container_mapping() {
		vc_map( array(
			'name'                    => esc_html__( 'News Block1', 'gnews-vc' ),
			'base'                    => 'gnews_vc_container_layout',
			'icon'                    => GNEWS_VC_PLUGIN_URL_VC . 'assets/images/blog_list.png',
			'is_container'            => true,
			'as_parent'               => array(
				'except' => 'gnews_vc_container_layout'
			),
			'content_element'         => true,
			'show_settings_on_create' => false,
			'category'                => esc_html__( 'By Gnews-VC', 'gnews-vc' ),
			'description'             => esc_html__( 'Gnews-VC News Block1', 'gnews-vc' ),
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Widget title', 'gnews-vc' ),
					'param_name'  => 'title',
					'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'gnews-vc' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'gnews-vc' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gnews-vc' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'CSS box', 'gnews-vc' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design Options', 'gnews-vc' ),
				),
			),
			'js_view'                 => 'VcColumnView',
		) );
	}

	/**
	 * Shortcode mapper
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public function container_func( $atts = array(), $content = '' ) {

		// default attributes
		extract( shortcode_atts( array(
			'title'    => '',
			'el_class' => '',
			'css'      => '',
		), $atts ) );

		$css = isset( $atts['css'] ) ? $atts['css'] : '';

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );

		$html = '';

		if ( isset( $atts['title'] ) && strlen( $atts['title'] ) ) {
			$html = '<h2>' . esc_html( $atts['title'] ) . '</h2>';
		}

		$html .= '<div class="container' . esc_attr( $css_class );

		if ( isset( $atts['el_class'] ) && strlen( $atts['el_class'] ) ) {
			$html .= ' ' . esc_attr( $atts['el_class'] );
		}

		$html .= '">' . do_shortcode( $content ) . '</div>';

		return $html;
	}

}

// Initialize
new Gnews_VC_Component_Container_Layout;

class WPBakeryShortCode_gnews_vc_container_layout extends WPBakeryShortCodesContainer {
}