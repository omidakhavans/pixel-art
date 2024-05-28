<?php
/**
 * Plugin Name:       Pixel Art
 * Description:       Draw and display pixel art on your website.
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Version:           1.0.0
 * Author:            RebelCode
 * Author URI:        https://rebelcode.com
 * Text Domain:       rbl-pixel-art
 *
 * @package           RBL/Pixel_Art
 */

/**
 * Copyright (C) 2024 RBL.
 *
 * Licensed under GNU GPL, Version 3.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * ADDITIONAL TERMS per GNU GPL Section 7 The origin of the Program
 * must not be misrepresented; you must not claim that you wrote
 * the original Program. Altered source versions must be plainly marked
 * as such, and must not be misrepresented as being the original Program.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PIXEL_ART_PATH', plugin_dir_path( __FILE__ ) );
define( 'PIXEL_ART_URL', plugin_dir_url( __FILE__ ) );

// Load the Composer autoloader.
require_once PIXEL_ART_PATH . '/vendor/autoload.php';

/**
 * Initialize modules
 */
RBL\Pixel_Art\Plugin::load_initializer();
