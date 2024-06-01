<?php
/**
 * Register custom block.
 *
 * @package   Country_Card
 * @copyright 2024 XWP
 * @license   GNU General Public License 3.0
 */

namespace RBL\Pixel_Art\Block;

use RBL\Pixel_Art\Interfaces\Initializer;

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
		add_action( 'init', array( __CLASS__, 'register_block' ) );
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
				'render_callback' => array( __CLASS__, 'render' ),
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
	 * @param array $attributes Block attributes.
	 * @return string Rendered block content.
	 */
	public static function render( array $attributes ): string {
		$pixels = get_option( 'pad_pixel_art', array_fill( 0, 256, 'transparent' ) );

		// Ensure $attributes['size'] is set, otherwise fallback to default value.
		$size = isset( $attributes['size'] ) ? $attributes['size'] : 128;

		$svg       = '<svg width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '" viewBox="0 0 320 320">';
		$pixelSize = 20;

		foreach ( json_decode( $pixels, true ) as $index => $color ) {
			$x    = ( $index % 16 ) * $pixelSize;
			$y    = floor( $index / 16 ) * $pixelSize;
			$svg .= '<rect width="' . $pixelSize . '" height="' . $pixelSize . '" x="' . $x . '" y="' . $y . '" fill="' . esc_attr( $color ) . '"/>';
		}

		$svg .= '</svg>';

		return $svg;
	}
}
