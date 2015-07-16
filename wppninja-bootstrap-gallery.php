<?php
	/*
		  Plugin Name: WPP Ninja Bootstrap Gallery
		  Plugin URI: http://www.wpplugin.ninja
		  Description: Simple Bootstrap Gallery replacement
		  Author: WP Plugin Ninja
		  Author URI: http://www.wpplugin.ninja/
		  Text Domain: wppninja-bootstrap-gallery
		  Version: 1.0.1

		  Licenced under the GNU GPL:

		  This program is free software; you can redistribute it and/or modify
		  it under the terms of the GNU General Public License as published by
		  the Free Software Foundation; either version 2 of the License, or
		  (at your option) any later version.

		  This program is distributed in the hope that it will be useful,
		  but WITHOUT ANY WARRANTY; without even the implied warranty of
		  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		  GNU General Public License for more details.

		  You should have received a copy of the GNU General Public License
		  along with this program; if not, write to the Free Software
		  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
	*/


	// If this file is called directly, abort.
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	/**
	 * The code that runs during plugin activation.
	 * This action is documented in includes/class-plugin-name-activator.php
	 */
	function activate_wppninja_bootstrap_gallery() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-wppninja-bootstrap-gallery-activator.php';
		Wppninja_Bootstrap_Gallery_Activator::activate();


	}

	/**
	 * The code that runs during plugin deactivation.
	 * This action is documented in includes/class-plugin-name-deactivator.php
	 */
	function deactivate_wppninja_bootstrap_gallery() {
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-wppninja-bootstrap-gallery-deactivator.php';
		Wppninja_Bootstrap_Gallery_Deactivator::deactivate();
	}

	register_activation_hook( __FILE__, 'activate_wppninja_bootstrap_gallery' );
	register_deactivation_hook( __FILE__, 'deactivate_wppninja_bootstrap_gallery' );

	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	require plugin_dir_path( __FILE__ ) . 'includes/class-wppninja-bootstrap-gallery.php';

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_wppninja_bootstrap_gallery() {

		$plugin = new Wppninja_Bootstrap_Gallery();
		$plugin->run();

	}
	run_wppninja_bootstrap_gallery();


?>