<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once PETFE_PLUGIN_PATH . 'controls.php';

/**
 * Todo: include script only when a popup is present on the page
 */
add_action(
	'wp_enqueue_scripts',
	function() {

		if ( is_user_logged_in() ) {
			return;
		}

		wp_enqueue_script(
			'gatep-frontend',
			PETFE_PLUGIN_URL . 'frontend.js',
			[ 'elementor-pro-frontend' ],
			'1.0.0',
			true
		);
	}
);
