<?php
/**
 * Plugin Name: Custom Timeline Widget for Elementor
 * Description: A responsive timeline section with alternating steps.
 * Version: 1.0
 * Author: Muiduzzaman Mahim
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function register_custom_timeline_widget( $widgets_manager ) {

	require_once( __DIR__ . '/timeline-widget.php' );

	$widgets_manager->register( new \Elementor_Custom_Timeline_Widget() );

}
add_action( 'elementor/widgets/register', 'register_custom_timeline_widget' );
