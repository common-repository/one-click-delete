<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.swimordiesoftware.com
 * @since             1.0.0
 * @package           Delete_Plugins_One_Click
 *
 * @wordpress-plugin
 * Plugin Name:       One Click Delete
 * Plugin URI:        https://www.swimordiesoftware.com/
 * Description:       Deletes plugins automatically after they become deactivated.
 * Version:           1.0.0
 * Author:            Swim or Die Software
 * Author URI:        https://www.swimordiesoftware.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       delete-plugins-one-click
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DELETE_PLUGINS_ONE_CLICK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-delete-plugins-one-click-activator.php
 */
function activate_delete_plugins_one_click() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-delete-plugins-one-click-activator.php';
	Delete_Plugins_One_Click_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-delete-plugins-one-click-deactivator.php
 */
function deactivate_delete_plugins_one_click() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-delete-plugins-one-click-deactivator.php';
	Delete_Plugins_One_Click_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_delete_plugins_one_click' );
register_deactivation_hook( __FILE__, 'deactivate_delete_plugins_one_click' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-delete-plugins-one-click.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_delete_plugins_one_click() {

	$plugin = new Delete_Plugins_One_Click();
	$plugin->run();

}
run_delete_plugins_one_click();
