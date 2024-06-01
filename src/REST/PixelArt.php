<?php
/**
 * Pixel Art REST Routes.
 *
 * @package   pixel Art
 * @copyright 2024 RBL
 * @license   GNU General Public License 3.0
 */

namespace RBL\Pixel_Art\REST;

use WP_REST_Server;
use WP_REST_Request;
use WP_Error;
use RBL\Pixel_Art\REST\Base;

/**
 * Class PixelArt
 *
 * Handles the REST API routes for the Pixel Art plugin.
 *
 * @package RBL\Pixel_Art\REST
 * @since 1.0
 */
class PixelArt extends Base {

	/**
	 * Rest base name.
	 *
	 * @since 1.0
	 *
	 * @var string
	 */
	protected $rest_base = 'pixel-art';

	/**
	 * Registers route.
	 *
	 * @since 1.0
	 *
	 * @see register_rest_route()
	 *
	 * @return void
	 */
	public function register_routes(): void {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'save_pixel_art' ),
					'args'                => $this->get_collection_params(),
					'permission_callback' => array( $this, 'permissions_check' ),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);

		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_pixel_art' ),
					'permission_callback' => array( $this, 'permissions_check' ),
				),
			)
		);
	}

	/**
	 * Save pixel art data to the database.
	 *
	 * @since 1.0
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
	public function save_pixel_art( $request ) {
		$pixels = $request->get_param( 'option' );

		if ( ! $pixels ) {
			return new WP_Error( 'invalid_payload', __( 'Invalid payload', 'rbl-pixel-art' ), array( 'status' => 400 ) );
		}

		if ( ! is_string( $pixels ) ) {
			$pixels = json_encode( $pixels );
		}

		if ( false === $pixels ) {
			return new WP_Error( 'invalid_pixel_art_data', __( 'Error encoding option to JSON.', 'rbl-pixel-art' ), array( 'status' => 400 ) );
		}

		$this->cache_handler->set( 'pad_pixel_art', $pixels );

		return rest_ensure_response( __( 'Pixel art saved', 'rbl-pixel-art' ), 200 );
	}

	/**
	 * Get pixel art data from the database.
	 *
	 * @since 1.0
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_REST_Response REST response.
	 */
	public function get_pixel_art( $request ) {
		$pixels = $this->cache_handler->get( 'pad_pixel_art', array_fill( 0, 256, 'transparent' ) );

		// Check if the retrieved data is a JSON string.
		if ( ! is_string( $pixels ) || ! json_decode( $pixels ) ) {
			$pixels = json_encode( $pixels );
		}

		if ( $pixels === false ) {
			return new WP_Error( 'invalid_pixel_art_data', __( 'Error encoding data to JSON.', 'rbl-pixel-art' ), array( 'status' => 400 ) );
		}

		return rest_ensure_response( $pixels, 200 );
	}

	/**
	 * Retrieves the params for endpoint.
	 *
	 * @since 1.0
	 *
	 * @return array Parameters.
	 */
	public function get_collection_params(): array {
		$query_params = array();

		$query_params['option'] = array(
			'description'       => __( 'option.', 'rbl-pixel-art' ),
			'required'          => true,
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
		);

		return $query_params;
	}

	/**
	 * Permission check.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 *
	 * @since 1.0
	 *
	 * @return true|WP_Error
	 */
	public function permissions_check(
		WP_REST_Request $request
	) {
		if ( current_user_can( 'manage_options' ) ) {
			return true;
		}

		return new WP_Error( 'rest_invalid_permission', __( 'You don\'t have the permission', 'rbl-pixel-art' ), array( 'status' => 400 ) );
	}

}
