<?php
/**
 * Plugin initializer.
 *
 * @package   pixel Art
 * @copyright 2024 RBL
 * @license   GNU General Public License 3.0
 */
namespace RBL\Pixel_Art\Admin;

use RBL\Pixel_Art\Interfaces\Initializer;

/**
 * Class Plugin.
 *
 * @since 1.0
 */
final class Settings implements Initializer {
	/**
	 * Register the service.
	 *
	 * @since 1.0
	 */
	public function load_hooks(): void {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_scripts' ) );
		add_action( 'admin_menu', array( __CLASS__, 'add_admin_menu' ) );
	}

	/**
	 * Enqueue admin scripts and styles.
	 */
	public static function enqueue_admin_scripts() {
		wp_enqueue_script( 'pixel-art-admin-script', PIXEL_ART_URL . 'build/admin.js', array( 'wp-api-fetch','wp-element', 'wp-url' ), null, true );
		wp_enqueue_style( 'pixel-art-admin-style', PIXEL_ART_URL . 'assets/admin.css' );
	}

	/**
	 * Add admin menu page.
	 */
	public static function add_admin_menu() {
		add_menu_page( 'Pixel Art Drawing', 'Pixel Art Drawing', 'manage_options', 'pixel-art-drawing', array( __CLASS__ ,'render_admin_page') );
	}

	/**
	 * Render admin page.
	 */
	public static function render_admin_page() {
		echo '<div id="pixel-art-admin-app"></div>';
	}
}
