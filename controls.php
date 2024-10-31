<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'elementor/element/popup/popup_layout/after_section_end', function( $element, $args ) {

	$element->start_controls_section(
		'popup_ga_tracking_section',
		[
			'label' => __( 'GA Tracking', 'popup-events-tracker-for-elementor' ),
			'tab'   => \Elementor\Controls_Manager::TAB_SETTINGS,
		]
	);

	$element->add_control(
		'popup_ga_tracking_enable',
		[
			'label'              => __( 'Enable GA Tracking?', 'popup-events-tracker-for-elementor' ),
			'type'               => \Elementor\Controls_Manager::SWITCHER,
			'frontend_available' => true,
		]
	);

	$element->add_control(
		'popup_ga_tracking_category',
		[
			'label'              => __( 'Category', 'popup-events-tracker-for-elementor' ),
			'type'               => \Elementor\Controls_Manager::TEXT,
			'placeholder'        => __( 'Eg: Popup', 'popup-events-tracker-for-elementor' ),
			'default'            => __( 'Popup', 'popup-events-tracker-for-elementor' ),
			'frontend_available' => true,
			'condition'          => [
				'popup_ga_tracking_enable' => 'yes',
			],
		]
	);

	$element->add_control(
		'popup_ga_tracking_label',
		[
			'label'              => __( 'Label', 'popup-events-tracker-for-elementor' ),
			'type'               => \Elementor\Controls_Manager::TEXT,
			'placeholder'        => __( 'Eg: Fall Campaign', 'popup-events-tracker-for-elementor' ),
			'frontend_available' => true,
			'condition'          => [
				'popup_ga_tracking_enable' => 'yes',
			],
		]
	);

	$element->end_controls_section();

}, 10, 2);
