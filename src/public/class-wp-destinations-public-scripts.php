<?php
/**
 * Public facing scripts.
 *
 * @package WP_Destinations
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WP_Destinations_Public_Scripts
 */
class WP_Destinations_Public_Scripts {

	/**
	 * Enqueue scripts and styles for public facing usage.
	 */
	public function wp_enqueue_scripts() {

		$map_utility = new WP_Destinations_Maps_Utility();

		wp_enqueue_script(
			'wp-destinations-google-maps',
			$map_utility->get_google_maps_src_url(),
			array(),
			null,
			true
		);

		wp_enqueue_script(
			'wp-destinations-marker-clusterer',
			WPDESTINATIONS_PLUGIN_URL . 'js/markerclusterer.js',
			array( 'wp-destinations-google-maps' ),
			'1.0.1',
			true
		);

		wp_enqueue_script(
			'wp-destinations-map-init',
			WPDESTINATIONS_PLUGIN_URL . 'js/init.js',
			array( 'wp-destinations-google-maps', 'wp-destinations-marker-clusterer' ),
			'1.0.0',
			true
		);

		wp_enqueue_style(
			'wp-destinations-styles',
			WPDESTINATIONS_PLUGIN_URL . 'css/wp-destinations-style.css',
			array(),
			'1.0.0'
		);
	}
}
