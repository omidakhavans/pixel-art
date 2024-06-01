<?php
namespace RBL\Pixel_Art\REST;

use WP_REST_Controller;
use RBL\Pixel_Art\Interfaces\Initializer;
use RBL\Pixel_Art\CacheHandler;

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
     * Cache handler instance.
     *
     * @var CacheHandler
     */
    protected CacheHandler $cache_handler;

    /**
     * Constructor.
     *
     * @param CacheHandler $cache_handler Cache handler instance.
     */
    public function __construct( CacheHandler $cache_handler ) {
		parent::__construct();
        $this->cache_handler = $cache_handler;
    }

	/**
	 * Register the service.
	 *
	 * @since 1.0
	 */
	public function load_hooks(): void {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

}
