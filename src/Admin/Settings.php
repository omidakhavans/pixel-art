<?php
/**
 * Admin Initializer.
 *
 * @package   Pixel_Art
 * @copyright 2024 RBL
 * @license   GNU General Public License 3.0
 */

namespace RBL\Pixel_Art\Admin;

use RBL\Pixel_Art\Interfaces\Initializer;

/**
 * Class Settings.
 *
 * Handles admin settings and functionality.
 *
 * @since 1.0
 */
final class Settings implements Initializer {
	/**
	 * Register the service.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function load_hooks(): void {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
	}

	/**
	 * Enqueue admin scripts and styles.
	 *
	 * @since 1.0
	 *
	 * @param string $hook The current admin page.
	 *
	 * @return void
	 */
	public static function enqueue_admin_scripts( $hook ): void {
		if ( 'toplevel_page_pixel-art-drawing' !== $hook ) {
			return;
		}

		wp_enqueue_script( 'pixel-art-admin-script', PIXEL_ART_URL . 'build/admin/index.js', array( 'wp-api-fetch', 'wp-element', 'wp-url' ), null, true );
		wp_enqueue_style( 'pixel-art-admin-style', PIXEL_ART_URL . 'build/admin.css' );
	}

	/**
	 * Add admin menu page.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function add_admin_menu(): void {
		add_menu_page( 'Pixel Art Drawing', 'Pixel Art Drawing', 'manage_options', 'pixel-art-drawing', array( $this, 'render_admin_page' ) );
	}

	/**
	 * Render admin page.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function render_admin_page(): void {
		echo '<div id="pixel-art-admin-app"></div>';
	}
}
