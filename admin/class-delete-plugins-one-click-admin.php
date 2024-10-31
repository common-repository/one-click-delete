<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.swimordiesoftware.com
 * @since      1.0.0
 *
 * @package    Delete_Plugins_One_Click
 * @subpackage Delete_Plugins_One_Click/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Delete_Plugins_One_Click
 * @subpackage Delete_Plugins_One_Click/admin
 * @author     Mike de Libero <mikede@mde-dev.com>
 */
class Delete_Plugins_One_Click_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/delete-plugins-one-click-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/delete-plugins-one-click-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Changes the deactivate link text from "deactivate" to "deactivate and delete".
	 *
	 * @param  array $actions      The actions we can change.
	 * @param  string $plugin_file The current plugin file we are changing the text for.
	 * @param  string $plugin_data Information about the plugin.
	 * @param  object $context     The context we are in.
	 * @return array               The text is changed.
	 */
	public function change_deactivate_link_text($actions, $plugin_file, $plugin_data, $context) {
		if ( isset( $actions['deactivate'] ) ) {
			$first_greater = strpos($actions['deactivate'], ">");
			$next_less_than = strpos($actions['deactivate'], "<", $first_greater);

			if ( $next_less_than > $first_greater ) {
				$actions['deactivate'] = substr($actions['deactivate'], 0, $first_greater + 1) . 
					__( 'Deactivate and Delete', 'delete-plugins-one-click' ) . 
					substr( $actions['deactivate'], $next_less_than );
			}
		}
		return $actions;
	}

	public function change_bulk_action_text( $actions ) {
		$actions['deactivate-selected'] = __( 'Deactivate and Delete', 'delete-plugins-one-click' );
		return $actions;
	}

	public function change_network_bulk_action_text( $actions ) {
		$actions['deactivate-selected'] = __( 'Network Deactivate and Delete', 'delete-plugins-one-click' );
		return $actions;	
	}

	/**
	 * Deletes the plugin after it has been deactivated.
	 *
	 * @param  string $plugin               Path to the plugin file relative to the plugins directory.
	 * @param  bool   $network_deactivating Whether the plugin is deactivated for all sites in the network or just the current site. Multisite only. Default false.
	 */
	public function handle_deactivated_plugin($plugin, $network_deactivating) {
		if ( !is_multisite() || $network_deactivating ) {
			delete_plugins( array( $plugin ) );
		}
	}
}
