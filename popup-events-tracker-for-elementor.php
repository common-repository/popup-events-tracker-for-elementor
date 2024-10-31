<?php
/**
 * Plugin Name: Popup Events Tracker for Elementor
 * Description: Track Elementor Popup events in Google Analytics.
 * Version: 1.0.0
 * Author: Paras Shah
 * Author URI https://pixify.net/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: popup-events-tracker-for-elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The main class that initiates and runs the plugin.
 */
final class Popup_Events_Tracker_For_Elementor {

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		// Plugin Directory URL.
		define( 'PETFE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		define( 'PETFE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

		// Bail if Elementor Pro does not exists or is less than 2.7.0 (which is required for the popup events API)
		if ( ! function_exists( 'elementor_pro_load_plugin' ) || 0 < version_compare( '2.7.0', ELEMENTOR_PRO_VERSION ) ) {
            return;
        }

		require_once PETFE_PLUGIN_PATH . 'init.php';
	}
}

Popup_Events_Tracker_For_Elementor::instance();
