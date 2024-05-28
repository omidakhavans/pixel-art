<?php
/**
 * Plugin initializer.
 *
 * @package   pixel Art
 * @copyright 2024 RBL
 * @license   GNU General Public License 3.0
 */
namespace RBL\Pixel_Art;

use RBL\Pixel_Art\Interfaces\Initializer;
use RBL\Pixel_Art\Block\PixelArt;

/**
 * Class Plugin.
 *
 * @since 1.0
 */
class Plugin {
	/**
	 * List of initializer.
	 *
	 * The initializer array contains a map of <identifier> => <initializer name>
	 * associations.
	 *
	 * @since 1.0
	 *
	 * @var array<mixed>
	 */
	const INITIALIZER = array(
		'pixel.art.block' => PixelArt::class,
	);

	/**
	 * Get the list of initializer to register.
	 *
	 * @since 1.0
	 *
	 * @return array<string> Associative array of identifiers mapped to fully qualified class names.
	 */
	protected static function get_initializer_classes() {
		return self::INITIALIZER;
	}

	/**
	 * Load initializer.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public static function load_initializer() : void {
		foreach ( self::get_initializer_classes() as $service ) {
			$class = new $service();
			if ( $class instanceof Initializer ) {
				$class->load_hooks();
			}
		}
	}

}
