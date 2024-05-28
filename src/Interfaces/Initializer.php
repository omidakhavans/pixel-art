<?php
/**
 * Interface dedicated for Modules
 *
 * @package   pixel Art
 * @copyright 2024 RBL
 * @license   GNU General Public License 3.0
 */

namespace RBL\Pixel_Art\Interfaces;

interface Initializer {

	/**
	 * Load hooks.
	 *
	 * @since 1.0
	 */
	public function load_hooks(): void;

}

