<?php
/**
 * Plugin Name: icebearclub
 * Plugin URI:  http://icebearclub.com/
 * Description: Ice Bear Club
 * Version:     0.1.0
 * Author:      chasewoith
 * Author URI:  https://profiles.wordpress.org/chasewoith/
 * Text Domain: 
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html

 * icebearclub is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 
 * icebearclub is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 
 * You should have received a copy of the GNU General Public License
 * along with icebearclub. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

defined('ABSPATH') or die('Ah ah ahhhhhh. No cheating.');
include 'icebear_options.php';

if (!class_exists('DiceRoller')) {

	class DiceRoller {

		/**
		 * Set up the plugin.
		 */
		function __construct() {
			add_shortcode('dice', [$this, 'shortcode']);
		}

		/**
		 * Set up the shortcode.
		 *
		 * @param	array	$atts		Attributes
		 * @param	string 	$content	Content passed in to the shortcode
		 * @return	string				Shortcode output
		 */
		function shortcode($atts, $content = null) {
			$this->enqueue_js();
			ob_start();
			require_once('form/form.html');
			$html = ob_get_clean();
			return $html; 
		}

		/**
		 * Register scripts with WordPress.
		 */
		function enqueue_js() {
			if (!wp_script_is('dice', 'enqueued')) {
				wp_register_script(
					'dice',
					plugin_dir_url(__FILE__) . 'js/dice.js'
				);
				wp_enqueue_script('dice');
				// Set Ice Vars
				$ice_vars = array( 'difficulty' => esc_attr(get_option( 'icebear_difficulty' )) );
				wp_localize_script( 'dice', 'ice_vars', $ice_vars);
			}
		}

	} // End class

} // End if(!class_exists)

if (class_exists('DiceRoller')) {
	new DiceRoller();
}
