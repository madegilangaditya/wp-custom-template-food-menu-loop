<?php
/**
 * Theme functions and definitions
 *
 * @package zoiecafe
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', time() );
}


/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function zoiecafe_enqueue_scripts() {
	wp_enqueue_style( 'zoiecafe', get_stylesheet_directory_uri() . '/style.css', ['hello-elementor-theme-style'], _S_VERSION );

	wp_enqueue_script( 'zoiecafe', get_stylesheet_directory_uri() . '/script.js', array( 'jquery' ), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'zoiecafe_enqueue_scripts', 20 );

/**
 * Load Elementor Custom
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'elementor/elementor.php' ) ) {
	require_once( get_stylesheet_directory() . '/includes/elementor/widgets.php' );
}