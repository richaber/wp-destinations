<?php
/**
 * Admin Meta Box class file..
 *
 * @package WP_Destinations
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WP_Destinations_Admin_Meta_Box
 */
class WP_Destinations_Admin_Meta_Box {

	/**
	 * The address input field name/id.
	 *
	 * @var string
	 */
	protected $id_input_address = 'wp-destinations-address';

	/**
	 * The longitude input field name/id.
	 *
	 * @var string
	 */
	protected $id_input_longitude = 'wp-destinations-longitude';

	/**
	 * The latitude input field name/id.
	 *
	 * @var string
	 */
	protected $id_input_latitude = 'wp-destinations-latitude';

	/**
	 * The ID of the container for our map.
	 *
	 * @var string
	 */
	protected $id_map = 'admin-map';

	/**
	 * The address meta key.
	 *
	 * @var string
	 */
	protected $meta_key_address = 'geo_address';

	/**
	 * The latitude meta key.
	 *
	 * @var string
	 */
	protected $meta_key_latitude = 'geo_latitude';

	/**
	 * The longitude meta key.
	 *
	 * @var string
	 */
	protected $meta_key_longitude = 'geo_longitude';

	/**
	 * The name for our metabox nonce.
	 *
	 * @var string
	 */
	protected $nonce_name = 'wpdestmb_nonce';

	/**
	 * The action for our metabox nonce.
	 *
	 * @var string
	 */
	protected $nonce_action = 'wpdestmb_save';

	/**
	 * Add our location meta box to post edit screen.
	 *
	 * @param $post_type
	 */
	public function add_meta_boxes( $post_type ) {

		/**
		 * Only add metabox to posts.
		 */
		if ( 'post' !== $post_type ) {
			return;
		}

		add_meta_box(
			'wp-destinations',
			esc_html__( 'WP Destinations', 'wp-destinations' ),
			array( $this, 'the_meta_box' ),
			'post',
			'normal',
			'high'
		);
	}

	/**
	 * Display the meta box.
	 *
	 * @param \WP_Post $post
	 */
	public function the_meta_box( $post ) {

		wp_nonce_field( $this->get_nonce_action(), $this->get_nonce_name() );

		$address = get_post_meta( $post->ID, $this->get_meta_key_address(), true );

		$latitude = get_post_meta( $post->ID, $this->get_meta_key_latitude(), true );

		$longitude = get_post_meta( $post->ID, $this->get_meta_key_longitude(), true );

		?>

		<p>

			<label for='wp-destinations-address'>
				<?php esc_html_e( 'Add a location address', 'wp-destinations' ); ?>
			</label>

			<br/>

			<input class='widefat'
				   name='<?php echo esc_attr( $this->get_id_input_address() ); ?>'
				   id='<?php echo esc_attr( $this->get_id_input_address() ); ?>'
				   value='<?php echo esc_attr( $address ); ?>'
				   size='30'/>

			<a id="get-coords" class="button widefat button-primary button-large" style="margin: 10px 0 10px 0;"
			   onclick="getWPDestinationCoords();">
				<?php esc_html_e( 'Get the Coordinates', 'wp-destinations' ); ?>
			</a>

			<label for='<?php echo esc_attr( $this->get_id_input_latitude() ); ?>'>
				<?php esc_html_e( 'Latitude', 'wp-destinations' ); ?>
			</label>

			<br/>

			<input name='<?php echo esc_attr( $this->get_id_input_latitude() ); ?>'
				   id='<?php echo esc_attr( $this->get_id_input_latitude() ); ?>'
				   value='<?php echo esc_attr( $latitude ); ?>'
				   size='30'/>
			<br/>

			<label for='<?php echo esc_attr( $this->get_id_input_longitude() ); ?>'>
				<?php esc_html_e( 'Longitude', 'wp-destinations' ); ?>
			</label>

			<br/>

			<input name='<?php echo esc_attr( $this->get_id_input_longitude() ); ?>'
				   id='<?php echo esc_attr( $this->get_id_input_longitude() ); ?>'
				   value='<?php echo esc_attr( $longitude ); ?>' size='30'/>

		</p>

		<div id='<?php echo esc_attr( $this->get_id_map() ); ?>' style='height: 300px; width: 100%;'></div>

		<?php
	}

	/**
	 * Save post geo meta.
	 *
	 * @param $post_id
	 * @param $post
	 *
	 * @return mixed
	 */
	public function save_post( $post_id, $post ) {

		$nonce = filter_input( INPUT_POST, $this->get_nonce_name(), FILTER_SANITIZE_SPECIAL_CHARS );

		$address = filter_input( INPUT_POST, $this->get_id_input_address(), FILTER_SANITIZE_SPECIAL_CHARS );

		$latitude = filter_input( INPUT_POST, $this->get_id_input_latitude(), FILTER_SANITIZE_SPECIAL_CHARS );

		$longitude = filter_input( INPUT_POST, $this->get_id_input_longitude(), FILTER_SANITIZE_SPECIAL_CHARS );

		if ( empty( $nonce ) ) {
			return $post_id;
		}

		// Verify the nonce before proceeding.
		if ( ! wp_verify_nonce( $nonce, $this->get_nonce_action() ) ) {
			return $post_id;
		}

		// Get the post type object.
		$post_type = get_post_type_object( $post->post_type );

		// Check if the current user has permission to edit the post.
		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		if ( empty( $address ) && empty( $latitude ) && empty( $longitude ) ) {

			delete_post_meta( $post_id, $this->get_meta_key_address() );
			delete_post_meta( $post_id, $this->get_meta_key_latitude() );
			delete_post_meta( $post_id, $this->get_meta_key_longitude() );

			return $post_id;
		}

		update_post_meta( $post_id, $this->get_meta_key_address(), $address );
		update_post_meta( $post_id, $this->get_meta_key_latitude(), $latitude );
		update_post_meta( $post_id, $this->get_meta_key_longitude(), $longitude );

		return $post_id;
	}

	public function get_id_input_address() {
		return $this->id_input_address;
	}

	public function get_id_input_longitude() {
		return $this->id_input_longitude;
	}

	public function get_id_input_latitude() {
		return $this->id_input_latitude;
	}

	public function get_id_map() {
		return $this->id_map;
	}

	public function get_meta_key_address() {
		return $this->meta_key_address;
	}

	public function get_meta_key_latitude() {
		return $this->meta_key_latitude;
	}

	public function get_meta_key_longitude() {
		return $this->meta_key_longitude;
	}

	public function get_nonce_name() {
		return $this->nonce_name;
	}

	public function get_nonce_action() {
		return $this->nonce_action;
	}
}
