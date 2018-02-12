<?php
/**
 * component class for Gnews-VC
 */


// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Class Gnews_VC_Component
 */
class Gnews_VC_Component {

	/**
	 * Constructor
	 */
	function __construct() {
		add_filter( 'vc_iconpicker-type-simpleline', array( $this, 'vc_iconpicker_type_simpleline' ) );
		$this->register_vc_params();
		
		return;
	}

	// return converted html
	public function html() {
		return true;
	}

	/**
	 * register visual composer params
	 */
	public function register_vc_params() {
		$this->add_vc_shortcode_param( 'gnews_vc_number', array( $this, 'number_input_param' ) );
	}

	/**
	 * @param      $name
	 * @param      $form_field_callback
	 * @param      $script_url
	 */
	public function add_vc_shortcode_param( $name, $form_field_callback, $script_url = null ) {
		if ( defined( 'WPB_VC_VERSION' ) && version_compare( WPB_VC_VERSION, 4.4 ) >= 0 ) {
			if ( function_exists( 'vc_add_shortcode_param' ) ) {
				vc_add_shortcode_param( $name, $form_field_callback, $script_url );
			}
		} else {
			if ( function_exists( 'add_shortcode_param' ) ) {
				add_shortcode_param( $name, $form_field_callback, $script_url );
			}
		}
	}

	public function number_input_param( $settings, $value ) {
		return '<div class="gnews-vc-number-input-block">'
		       . '<input name="' . esc_attr( $settings[ 'param_name' ] ) . '"
		                 class="wpb_vc_param_value wpb-textinput ' . esc_attr( $settings[ 'param_name' ] ) . ' ' . esc_attr( $settings[ 'type' ] ) . '_field"
		                 type="number" value="' . esc_attr( $value ) . '"
		                 ' . ( empty( $settings[ 'min' ] ) ? '' : 'min="' . esc_attr( $settings[ 'min' ] ) . '"' ) . '
		                 ' . ( empty( $settings[ 'max' ] ) ? '' : 'max="' . esc_attr( $settings[ 'max' ] ) . '"' ) . '
		                 style="height: 36px;"/>' .
		       '</div>';
	}

	// Add array of your fonts so they can be displayed in the font selector
	public function vc_iconpicker_type_simpleline( $icons ) {
		// Add custom icons to array
		$icons['Simpleline'] = array(
			array( 'icon-user icons' => 'user' ),
			array( 'icon-people icons' => 'people' ),
			array( 'icon-user-female icons' => 'user-female' ),
			array( 'icon-user-follow icons' => 'user-follow' ),
			array( 'icon-user-following icons' => 'user-following' ),
			array( 'icon-user-unfollow icons' => 'user-unfollow' ),
			array( 'icon-login icons' => 'login' ),
			array( 'icon-logout icons' => 'logout' ),
			array( 'icon-emotsmile icons' => 'emotsmile' ),
			array( 'icon-phone icons' => 'phone' ),
			array( 'icon-call-end icons' => 'call-end' ),
			array( 'icon-call-in icons' => 'call-in' ),
			array( 'icon-call-out icons' => 'call-out' ),
			array( 'icon-map icons' => 'map' ),
			array( 'icon-location-pin icons' => 'location-pin' ),
			array( 'icon-direction icons' => 'direction' ),
			array( 'icon-directions icons' => 'directions' ),
			array( 'icon-compass icons' => 'compass' ),
			array( 'icon-layers icons' => 'layers' ),
			array( 'icon-menu icons' => 'menu' ),
			array( 'icon-list icons' => 'list' ),
			array( 'icon-options-vertical icons' => 'options-vertical' ),
			array( 'icon-options icons' => 'options' ),
			array( 'icon-arrow-down icons' => 'arrow-down' ),
			array( 'icon-arrow-left icons' => 'arrow-left' ),
			array( 'icon-arrow-right icons' => 'arrow-right' ),
			array( 'icon-arrow-up icons' => 'arrow-up' ),
			array( 'icon-arrow-up-circle icons' => 'arrow-up-circle' ),
			array( 'icon-arrow-left-circle icons' => 'arrow-left-circle' ),
			array( 'icon-arrow-right-circle icons' => 'arrow-right-circle' ),
			array( 'icon-arrow-down-circle icons' => 'arrow-down-circle' ),
			array( 'icon-check icons' => 'check' ),
			array( 'icon-clock icons' => 'clock' ),
			array( 'icon-plus icons' => 'plus' ),
			array( 'icon-minus icons' => 'minus' ),
			array( 'icon-close icons' => 'close' ),
			array( 'icon-event icons' => 'event' ),
			array( 'icon-exclamation icons' => 'exclamation' ),
			array( 'icon-organization icons' => 'organization' ),
			array( 'icon-trophy icons' => 'trophy' ),
			array( 'icon-screen-smartphone icons' => 'screen-smartphone' ),
			array( 'icon-screen-desktop icons' => 'screen-desktop' ),
			array( 'icon-plane icons' => 'plane' ),
			array( 'icon-notebook icons' => 'notebook' ),
			array( 'icon-mustache icons' => 'mustache' ),
			array( 'icon-mouse icons' => 'mouse' ),
			array( 'icon-magnet icons' => 'magnet' ),
			array( 'icon-energy icons' => 'energy' ),
			array( 'icon-disc icons' => 'disc' ),
			array( 'icon-cursor icons' => 'cursor' ),
			array( 'icon-cursor-move icons' => 'cursor-move' ),
			array( 'icon-crop icons' => 'crop' ),
			array( 'icon-chemistry icons' => 'chemistry' ),
			array( 'icon-speedometer icons' => 'speedometer' ),
			array( 'icon-shield icons' => 'shield' ),
			array( 'icon-screen-tablet icons' => 'screen-tablet' ),
			array( 'icon-magic-wand icons' => 'magic-wand' ),
			array( 'icon-hourglass icons' => 'hourglass' ),
			array( 'icon-graduation icons' => 'graduation' ),
			array( 'icon-ghost icons' => 'ghost' ),
			array( 'icon-game-controller icons' => 'game-controller' ),
			array( 'icon-fire icons' => 'fire' ),
			array( 'icon-eyeglass icons' => 'eyeglass' ),
			array( 'icon-envelope-open icons' => 'envelope-open' ),
			array( 'icon-envelope-letter icons' => 'envelope-letter' ),
			array( 'icon-bell icons' => 'bell' ),
			array( 'icon-badge icons' => 'badge' ),
			array( 'icon-anchor icons' => 'anchor' ),
			array( 'icon-wallet icons' => 'wallet' ),
			array( 'icon-vector icons' => 'vector' ),
			array( 'icon-speech icons' => 'speech' ),
			array( 'icon-puzzle icons' => 'puzzle' ),
			array( 'icon-printer icons' => 'printer' ),
			array( 'icon-present icons' => 'present' ),
			array( 'icon-playlist icons' => 'playlist' ),
			array( 'icon-pin icons' => 'pin' ),
			array( 'icon-picture icons' => 'picture' ),
			array( 'icon-handbag icons' => 'handbag' ),
			array( 'icon-globe-alt icons' => 'globe-alt' ),
			array( 'icon-globe icons' => 'globe' ),
			array( 'icon-folder-alt icons' => 'folder-alt' ),
			array( 'icon-folder icons' => 'folder' ),
			array( 'icon-film icons' => 'film' ),
			array( 'icon-feed icons' => 'feed' ),
			array( 'icon-drop icons' => 'drop' ),
			array( 'icon-drawer icons' => 'drawer' ),
			array( 'icon-docs icons' => 'docs' ),
			array( 'icon-doc icons' => 'doc' ),
			array( 'icon-diamond icons' => 'diamond' ),
			array( 'icon-cup icons' => 'cup' ),
			array( 'icon-calculator icons' => 'calculator' ),
			array( 'icon-bubbles icons' => 'bubbles' ),
			array( 'icon-briefcase icons' => 'briefcase' ),
			array( 'icon-book-open icons' => 'book-open' ),
			array( 'icon-basket-loaded icons' => 'basket-loaded' ),
			array( 'icon-basket icons' => 'basket' ),
			array( 'icon-bag icons' => 'bag' ),
			array( 'icon-action-undo icons' => 'action-undo' ),
			array( 'icon-action-redo icons' => 'action-redo' ),
			array( 'icon-wrench icons' => 'wrench' ),
			array( 'icon-umbrella icons' => 'umbrella' ),
			array( 'icon-trash icons' => 'trash' ),
			array( 'icon-tag icons' => 'tag' ),
			array( 'icon-support icons' => 'support' ),
			array( 'icon-frame icons' => 'frame' ),
			array( 'icon-size-fullscreen icons' => 'size-fullscreen' ),
			array( 'icon-size-actual icons' => 'size-actual' ),
			array( 'icon-shuffle icons' => 'shuffle' ),
			array( 'icon-share-alt icons' => 'share-alt' ),
			array( 'icon-share icons' => 'share' ),
			array( 'icon-rocket icons' => 'rocket' ),
			array( 'icon-question icons' => 'question' ),
			array( 'icon-pie-chart icons' => 'pie-chart' ),
			array( 'icon-pencil icons' => 'pencil' ),
			array( 'icon-note icons' => 'note' ),
			array( 'icon-loop icons' => 'loop' ),
			array( 'icon-home icons' => 'home' ),
			array( 'icon-grid icons' => 'grid' ),
			array( 'icon-graph icons' => 'graph' ),
			array( 'icon-microphone icons' => 'microphone' ),
			array( 'icon-music-tone-alt icons' => 'music-tone-alt' ),
			array( 'icon-music-tone icons' => 'music-tone' ),
			array( 'icon-earphones-alt icons' => 'earphones-alt' ),
			array( 'icon-earphones icons' => 'earphones' ),
			array( 'icon-equalizer icons' => 'equalizer' ),
			array( 'icon-like icons' => 'like' ),
			array( 'icon-dislike icons' => 'dislike' ),
			array( 'icon-control-start icons' => 'control-start' ),
			array( 'icon-control-rewind icons' => 'control-rewind' ),
			array( 'icon-control-play icons' => 'control-play' ),
			array( 'icon-control-pause icons' => 'control-pause' ),
			array( 'icon-control-forward icons' => 'control-forward' ),
			array( 'icon-control-end icons' => 'control-end' ),
			array( 'icon-volume-1 icons' => 'volume-1' ),
			array( 'icon-volume-2 icons' => 'volume-2' ),
			array( 'icon-volume-off icons' => 'volume-off' ),
			array( 'icon-calendar icons' => 'calendar' ),
			array( 'icon-bulb icons' => 'bulb' ),
			array( 'icon-chart icons' => 'chart' ),
			array( 'icon-ban icons' => 'ban' ),
			array( 'icon-bubble icons' => 'bubble' ),
			array( 'icon-camrecorder icons' => 'camrecorder' ),
			array( 'icon-camera icons' => 'camera' ),
			array( 'icon-cloud-download icons' => 'cloud-download' ),
			array( 'icon-cloud-upload icons' => 'cloud-upload' ),
			array( 'icon-envelope icons' => 'envelope' ),
			array( 'icon-eye icons' => 'eye' ),
			array( 'icon-flag icons' => 'flag' ),
			array( 'icon-heart icons' => 'heart' ),
			array( 'icon-info icons' => 'info' ),
			array( 'icon-key icons' => 'key' ),
			array( 'icon-link icons' => 'link' ),
			array( 'icon-lock icons' => 'lock' ),
			array( 'icon-lock-open icons' => 'lock-open' ),
			array( 'icon-magnifier icons' => 'magnifier' ),
			array( 'icon-magnifier-add icons' => 'magnifier-add' ),
			array( 'icon-magnifier-remove icons' => 'magnifier-remove' ),
			array( 'icon-paper-clip icons' => 'paper-clip' ),
			array( 'icon-paper-plane icons' => 'paper-plane' ),
			array( 'icon-power icons' => 'power' ),
			array( 'icon-refresh icons' => 'refresh' ),
			array( 'icon-reload icons' => 'reload' ),
			array( 'icon-settings icons' => 'settings' ),
			array( 'icon-star icons' => 'star' ),
			array( 'icon-symbol-female icons' => 'symbol-female' ),
			array( 'icon-symbol-male icons' => 'symbol-male' ),
			array( 'icon-target icons' => 'target' ),
			array( 'icon-credit-card icons' => 'credit-card' ),
			array( 'icon-paypal icons' => 'paypal' ),
			array( 'icon-social-tumblr icons' => 'social-tumblr' ),
			array( 'icon-social-twitter icons' => 'social-twitter' ),
			array( 'icon-social-facebook icons' => 'social-facebook' ),
			array( 'icon-social-instagram icons' => 'social-instagram' ),
			array( 'icon-social-linkedin icons' => 'social-linkedin' ),
			array( 'icon-social-pinterest icons' => 'social-pinterest' ),
			array( 'icon-social-github icons' => 'social-github' ),
			array( 'icon-social-google icons' => 'social-google' ),
			array( 'icon-social-reddit icons' => 'social-reddit' ),
			array( 'icon-social-skype icons' => 'social-skype' ),
			array( 'icon-social-dribbble icons' => 'social-dribbble' ),
			array( 'icon-social-behance icons' => 'social-behance' ),
			array( 'icon-social-foursqare icons' => 'social-foursqare' ),
			array( 'icon-social-soundcloud icons' => 'social-soundcloud' ),
			array( 'icon-social-spotify icons' => 'social-spotify' ),
			array( 'icon-social-stumbleupon icons' => 'social-stumbleupon' ),
			array( 'icon-social-youtube icons' => 'social-youtube' ),
			array( 'icon-social-dropbox icons' => 'social-dropbox' ),
			array( 'icon-social-vkontakte icons' => 'social-vkontakte' ),
			array( 'icon-social-steam icons' => 'social-steam' ),
		);

		// Return icons
		return $icons;
	}
}
