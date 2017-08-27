<?php
/**
 * WP Destinations plugin main bootstrap file.
 *
 * @package WP_Destinations
 *
 * @wordpress-plugin
 * Plugin Name: WP Destinations
 * Plugin URI: http://www.jessewollin.com/uptownvine
 * Description: WP Destinations gives you the ability to create a map on the front of the site with the ability to see the posts through using modals.
 * Version: 1.0.0
 * Author: Jesse Wollin
 * Author URI: http://www.jessewollin.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wp-destinations
 * Domain Path: /languages
 * Requires at least: 4.8
 * Tested up to: 4.8.1
 *
 * Copyright 2016 Jesse Wollin
 * email: jessewollin@gmail.com
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The bootstrap file name of this plugin without extension.
 *
 * Note that this string should be both the directory name, and this bootstrap file's name.
 *
 * @var string WPDESTINATIONS_PLUGIN_NAME
 */
define( 'WPDESTINATIONS_PLUGIN_NAME', 'wp-destinations' );

/**
 * The plugin version.
 *
 * This should match the version string in the plugin bootstrap header.
 *
 * @var string WPDESTINATIONS_PLUGIN_VERSION
 */
define( 'WPDESTINATIONS_PLUGIN_VERSION', '1.0.0' );

/**
 * The full path and filename of this plugin file with symlinks resolved.
 *
 * @var string WPDESTINATIONS_PLUGIN_FILE
 */
define( 'WPDESTINATIONS_PLUGIN_FILE', __FILE__ );

/**
 * The full path to the parent directory of this plugin file with symlinks resolved.
 *
 * @var string WPDESTINATIONS_PLUGIN_DIR
 */
define( 'WPDESTINATIONS_PLUGIN_DIR', dirname( WPDESTINATIONS_PLUGIN_FILE ) . '/' );

/**
 * The URL of the plugin directory, with trailing slash.
 *
 * Example: https://example.dev/wp-content/plugins/wp-destinations/
 *
 * @const string WPDESTINATIONS_PLUGIN_URL
 */
define( 'WPDESTINATIONS_PLUGIN_URL', plugins_url( '/', WPDESTINATIONS_PLUGIN_FILE ) );

/**
 * Autoload plugin classes.
 */
require WPDESTINATIONS_PLUGIN_DIR . 'vendor/autoload_52.php';

/**
 * Run the plugin.
 *
 * All these action hooks could be broken out into another class just for handling actions/filters.
 */
function wp_destinations_run() {

	$admin_settings = new WP_Destinations_Admin_Settings();
	add_action( 'admin_init', array( $admin_settings, 'admin_init' ) );

	$public_scripts = new WP_Destinations_Public_Scripts();
	add_action( 'wp_enqueue_scripts', array( $public_scripts, 'wp_enqueue_scripts' ) );

	$admin_scripts = new WP_Destinations_Admin_Scripts();
	add_action( 'admin_enqueue_scripts',  array( $admin_scripts, 'admin_enqueue_scripts' ) );

	$admin_metabox = new WP_Destinations_Admin_Meta_Box();
	add_action( 'add_meta_boxes', array( $admin_metabox, 'add_meta_boxes' ) );
	add_action( 'save_post', array( $admin_metabox, 'save_post' ), 10, 2 );
}

add_action( 'plugins_loaded', 'wp_destinations_run' );
