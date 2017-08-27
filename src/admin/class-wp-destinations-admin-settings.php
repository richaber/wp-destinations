<?php
/**
 * Admin settings / sections / fields.
 *
 * @package WP_Destinations
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WP_Destinations_Admin_Settings
 */
class WP_Destinations_Admin_Settings {

	/**
	 * Add Google Maps API Key / Client ID settings section and fields to the General Settings screen.
	 *
	 * @action admin_init
	 */
	public function admin_init() {

		/**
		 * Add a section to the "General" settings page in WP-Admin.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_settings_section/
		 */
		add_settings_section(
			'wp_destinations_settings',
			'WP Destinations Settings',
			array( $this, 'the_settings_section' ),
			'general'
		);

		/**
		 * Add a Google API Key field to the "WP Destinations Settings" section.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_settings_field/
		 */
		add_settings_field(
			'wp_destinations_google_api_key',
			__( 'Google Maps API Key', 'wp-destinations' ),
			array( $this, 'the_api_key_field' ),
			'general',
			'wp_destinations_settings',
			array(
				'label_for' => 'wp_destinations_google_api_key',
				'class'     => 'wp-destinations-api-key-field',
			)
		);

		/**
		 * Add a Google Cient ID field to the "WP Destinations Settings" section.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_settings_field/
		 */
		add_settings_field(
			'wp_destinations_google_api_client',
			__( 'Google Maps Client ID', 'wp-destinations' ),
			array( $this, 'the_api_client_id_field' ),
			'general',
			'wp_destinations_settings',
			array(
				'label_for' => 'wp_destinations_google_api_client',
				'class'     => 'wp-destinations-api-client-id-field',
			)
		);

		register_setting( 'general', 'wp_destinations_google_api_key', 'esc_attr' );

		register_setting( 'general', 'wp_destinations_google_api_client', 'esc_attr' );
	}

	/**
	 * Print section intro / instructions.
	 */
	public function the_settings_section() {
		?>
		<p>
			<?php esc_html_e( 'Enter your Google Maps JS API Key or Client ID here.', 'wp-destinations' ); ?>
		</p>
		<?php
	}

	/**
	 * Print API Key field.
	 */
	public function the_api_key_field() {

		$value = get_option( 'wp_destinations_google_api_key', '' );

		$url = 'https://developers.google.com/maps/documentation/javascript/get-api-key';

		/* translators: Link to Google Maps JavaScript API Key documentation. */
		$description = __(
			'Enter your Google Maps API Authentication Key. Refer to <a href="%s" target="_blank">Google&rsquo;s Maps JavaScript API documentation</a> to learn more.',
			'wp-destinations'
		);

		?>

		<input type="text"
			   aria-describedby="wp-destinations-google-api-key-description"
			   id="wp_destinations_google_api_key"
			   name="wp_destinations_google_api_key"
			   value="<?php echo esc_attr( $value ); ?>"
			   class="regular-text"/>

		<p class="description" id="wp-destinations-google-api-key-description">
			<?php
			printf(
				wp_kses(
					$description,
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					)
				),
				esc_url( $url )
			);
			?>
		</p>

		<?php
	}

	/**
	 * Print Client ID field.
	 */
	public function the_api_client_id_field() {

		$value = get_option( 'wp_destinations_google_api_client', '' );

		$url = 'https://developers.google.com/maps/documentation/javascript/get-api-key#client-id';

		/* translators: Link to Google Maps JavaScript API Client ID documentation. */
		$description = __(
			'For Google Maps APIs Premium Plan license holders that use the alternative Google Maps API Client ID. Refer to <a href="%s" target="_blank">Google&rsquo;s Maps JavaScript API documentation</a> to learn more.',
			'wp-destinations'
		);

		?>

		<input type="text"
			   aria-describedby="wp-destinations-google-api-client-description"
			   id="wp_destinations_google_api_client"
			   name="wp_destinations_google_api_client"
			   class="regular-text"
			   value="<?php echo esc_attr( $value ); ?>"/>

		<p class="description" id="wp-destinations-google-api-client-description">
			<?php
			printf(
				wp_kses(
					$description,
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					)
				),
				esc_url( $url )
			);
			?>
		</p>

		<?php
	}
}
