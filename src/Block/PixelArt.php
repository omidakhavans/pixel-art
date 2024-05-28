<?php
/**
 * Register custom block
 *
 * @package   Country_Card
 * @copyright 2024 XWP
 * @license   GNU General Public License 3.0
 */

namespace RBL\Pixel_Art\Block;

use RBL\Pixel_Art\Interfaces\Initializer;

/**
 * Block module
 */
class PixelArt implements Initializer {
	/**
	 * Register the service.
	 *
	 * @since 1.0
	 */
	public function load_hooks(): void {
		add_action( 'init', array( __CLASS__, 'register_block' ) );
	}

	/**
	 * Register block
	 *
	 * @return void
	 */
	public static function register_block(): void {
		register_block_type( PIXEL_ART_PATH . '/build/Modules/Block' );
	}
}
