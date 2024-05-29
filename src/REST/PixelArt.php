<?php

namespace RBL\Pixel_Art\REST;

use WP_REST_Server;
use WP_REST_Request;
use RBL\Pixel_Art\REST\Base;

/**
 * Class PixelArt
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
				)
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
		$pixels = $request->get_json_params();
		update_option( 'pad_pixel_art', $pixels );
		return rest_ensure_response( __( 'Pixel art saved', 'rbl-pixel-art' ) );
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
		$pixels = get_option( 'pad_pixel_art', array_fill( 0, 256, 'transparent' ) );
		write_log($pixels);
		return rest_ensure_response( $pixels, 200 );
	}

	/**
	 * Retrieves the params for endpoint.
	 *
	 * @since 1.0
	 *
	 * @return array parameters.
	 */
	public function get_collection_params(): array {
		$query_params = array();

		$query_params['code'] = array(
			'description'       => __( 'Code.', 'rbl-pixel-art' ),
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
