<?php
/**
 * Maps Utility class file.
 *
 * @package WP_Destinations
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WP_Destinations_Maps_Utility
 */
class WP_Destinations_Maps_Utility {

	/**
	 * The Google Maps API version that our plugin uses.
	 *
	 * We are currently using release version 3.
	 *
	 * @link https://developers.google.com/maps/documentation/javascript/versions#version-rollover-and-version-types
	 *
	 * @var string
	 */
	public $google_maps_api_version = '3';

	/**
	 * Get the Google Maps src URL.
	 *
	 * Note that we construct the URL with the API Key OR Client ID from our plugin options/settings.
	 *
	 * @return string
	 */
	public function get_google_maps_src_url() {

		/**
		 * The src URL of the Google Maps JS API script.
		 *
		 * @var string $google_maps_js_api_src
		 */
		$google_maps_js_api_src = 'https://maps.googleapis.com/maps/api/js';

		/**
		 * Setup our Google Maps API information.
		 *
		 * Key would be the API Key.
		 * Client would be the Client ID.
		 * Libraries would be the Google Maps Libraries that we want to use.
		 * Version is the Google Maps API version.
		 * Callback is unused in our case.
		 *
		 * @link https://developers.google.com/maps/documentation/javascript/get-api-key#key
		 * @link https://developers.google.com/maps/documentation/javascript/get-api-key#standard-auth
		 * @link https://developers.google.com/maps/documentation/javascript/libraries
		 * @link https://developers.google.com/maps/documentation/javascript/versions
		 * @link https://developers.google.com/maps/documentation/javascript/tutorial#sync
		 *
		 * @var array $google_api
		 */
		$google_api = array(
			'key'       => get_option( 'wp_destinations_google_api_key' ),
			'client'    => get_option( 'wp_destinations_google_api_client' ),
			'libraries' => 'places',
			'ver'       => $this->google_maps_api_version,
			'callback'  => '',
		);

		/**
		 * We don't have an API Key or Client ID!
		 */
		if ( empty( $google_api['key'] ) && empty( $google_api['client'] ) ) {
			return $google_maps_js_api_src;
		}

		/**
		 * Remove empty API Key.
		 */
		if ( empty( $google_api['key'] ) ) {
			unset( $google_api['key'] );
		}

		/**
		 * Remove empty Client ID.
		 */
		if ( empty( $google_api['client'] ) ) {
			unset( $google_api['client'] );
		}

		/**
		 * You can't pass both an API Key and a Client ID to the Google Maps JS API!
		 *
		 * From the Google Maps API documentation page:
		 * Note: If you were previously using an API key for authentication and are switching to using a client ID,
		 * you must remove the key parameter before loading the API.
		 * The API will fail to load if both a client ID and an API key are included.
		 *
		 * @link https://developers.google.com/maps/documentation/javascript/get-api-key#specifying-a-client-id-when-loading-the-api
		 */
		if ( ! empty( $google_api['key'] ) && ! empty( $google_api['client'] ) ) {
			unset( $google_api['key'] );
		}

		/**
		 * Construct and return the script src url.
		 */
		return add_query_arg( $google_api, $google_maps_js_api_src );
	}
}
