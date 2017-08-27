<?php
/**
 * Admin facing scripts.
 *
 * @package WP_Destinations
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WP_Destinations_Admin_Scripts
 */
class WP_Destinations_Admin_Scripts {

	/**
	 * Enqueue scripts and styles for admin facing usage.
	 */
	public function admin_enqueue_scripts( $hook_suffix ) {

		/**
		 * Early return.
		 */
		if ( empty( $hook_suffix ) ) {
			return;
		}

		/**
		 * Only affect post edit screens.
		 */
		if ( 'post.php' !== $hook_suffix && 'post-new.php' !== $hook_suffix ) {
			return;
		}

		/**
		 * Utility class for getting the Google Maps src.
		 *
		 * @var \WP_Destinations_Maps_Utility $map_utility
		 */
		$map_utility = new WP_Destinations_Maps_Utility();

		/**
		 * Enqueue the Google Maps Javascript API script.
		 */
		wp_enqueue_script(
			'wp-destinations-google-maps',
			$map_utility->get_google_maps_src_url(),
			array(),
			null,
			true
		);

		/**
		 * Enqueue our Admin JS for working with the post meta box.
		 */
		wp_enqueue_script(
			'wp-destiantions-admin-map-js',
			WPDESTINATIONS_PLUGIN_URL . 'js/admin-map.js',
			array( 'wp-destinations-google-maps' ),
			null,
			false
		);

		/**
		 * We're really only using this to get the input names, and the map id.
		 *
		 * You could just as easily code those strings directly into $localized_data.
		 * It was just more convenient for me to update the WP_Destinations_Admin_Meta_Box class vars,
		 * and have that reflected in the $localized_data array without editing strings in multiple locations.
		 *
		 * @var \WP_Destinations_Admin_Meta_Box $admin_metabox
		 */
		$admin_metabox = new WP_Destinations_Admin_Meta_Box();

		/**
		 * Data from the PHP side that we want to pass to JS.
		 */
		$localized_data = array(
			'emptyCoordsMessage' => esc_html__( 'You haven’t created latitude and longitude coordinates for your address.', 'wp-destinations' ),
			'idInputAddress'       => $admin_metabox->get_id_input_address(),
			'idInputLongitude'     => $admin_metabox->get_id_input_longitude(),
			'idInputLatitude'      => $admin_metabox->get_id_input_latitude(),
			'idMap'              => $admin_metabox->get_id_map(),
		);

		/**
		 * Although this is mostly intended for use as a way of passing gettext translations for JS messages,
		 * it has the side-effect of allowing us to pass PHP vars to JS as well.
		 */
		wp_localize_script( 'wp-destiantions-admin-map-js', 'WPDestinationsAdminData', $localized_data );
	}
}
