<?php
/**
 * Plugin initializer.
 *
 * @package   pixel Art
 * @copyright 2024 RBL
 * @license   GNU General Public License 3.0
 */

namespace RBL\Pixel_Art\Block;

use RBL\Pixel_Art\Interfaces\Initializer;
use RBL\Pixel_Art\CacheHandler;

/**
 * Block module.
 */
class PixelArt implements Initializer {

	/**
	 * Register the service.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function load_hooks(): void {
		add_action( 'init', array( $this, 'register_block' ) );
	}

	/**
	 * Register block.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public static function register_block(): void {
		register_block_type_from_metadata(
			PIXEL_ART_PATH . '/build/block/',
			array(
				'render_callback' => array( self::class, 'render' ),
				'attributes'      => array(
					'size' => array(
						'type'    => 'number',
						'default' => 128,
					),
				),
			)
		);
	}

	/**
	 * Render block content.
	 *
	 * @since 1.0
	 *
 	 * @param array<string,mixed> $attributes Block attributes.
	 * @return string Rendered block content.
	 */
	public static function render( array $attributes ): string {
		$cache_handler = new CacheHandler( 'pixel_art_option' );
		$pixels        = $cache_handler->get( 'pad_pixel_art', array_fill( 0, 256, 'transparent' ) );

		if ( ! is_array( $pixels ) ) {
			$decoded_pixels = json_decode( (string) $pixels, true );
			if ( json_last_error() === JSON_ERROR_NONE && is_array( $decoded_pixels ) ) {
				$pixels = $decoded_pixels;
			} else {
				$pixels = array_fill( 0, 256, 'transparent' );
			}
		}

		// Ensure $attributes['size'] is set, otherwise fallback to default value.
		$size = isset( $attributes['size'] ) ? (int) $attributes['size'] : 128;

		$svg        = '<svg width="' . esc_attr( (string) $size ) . '" height="' . esc_attr( (string) $size ) . '" viewBox="0 0 320 320">';
		$pixel_size = 20;

		foreach ( $pixels as $index => $color ) {
			$x    = ( $index % 16 ) * $pixel_size;
			$y    = floor( $index / 16 ) * $pixel_size;
			$svg .= '<rect width="' . esc_attr( (string) $pixel_size ) . '" height="' . esc_attr( (string) $pixel_size ) . '" x="' . esc_attr( (string) $x ) . '" y="' . esc_attr( (string) $y ) . '" fill="' . esc_attr( (string) $color ) . '"/>';
		}

		$svg .= '</svg>';

		return $svg;
	}
}
