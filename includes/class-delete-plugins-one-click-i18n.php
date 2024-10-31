<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.swimordiesoftware.com
 * @since      1.0.0
 *
 * @package    Delete_Plugins_One_Click
 * @subpackage Delete_Plugins_One_Click/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Delete_Plugins_One_Click
 * @subpackage Delete_Plugins_One_Click/includes
 * @author     Mike de Libero <mikede@mde-dev.com>
 */
class Delete_Plugins_One_Click_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'delete-plugins-one-click',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
