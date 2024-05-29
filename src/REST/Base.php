<?php
namespace RBL\Pixel_Art\REST;

use WP_REST_Controller;
use RBL\Pixel_Art\Interfaces\Initializer;

/**
 * Class Base
 */
abstract class Base extends WP_REST_Controller implements Initializer {

	/**
	 * Name Space.
	 *
	 * @var string
	 */
	protected $namespace = 'pad/v1';

	/**
	 * Register the service.
	 *
	 * @since 1.0
	 */
	public function load_hooks(): void {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

}
