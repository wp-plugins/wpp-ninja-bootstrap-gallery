<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       		http://www.wpplugin.ninja
 * @since      		1.0.0
 *
 * @package    	Wppninja_Bootstrap_Gallery
 * @subpackage 	Wppninja_Bootstrap_Gallery/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    	Wppninja_Bootstrap_Gallery
 * @subpackage 	Wppninja_Bootstrap_Gallery/admin
 * @author     	Stuart Shields <info@wpplugin.ninja>
 */
class Wppninja_Bootstrap_Gallery_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    	1.0.0
	 * @access   	private
	 * @var      	string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    	1.0.0
	 * @access   	private
	 * @var      	string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    	 1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wppninja_Bootstrap_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wppninja_Bootstrap_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wppninja-bootstrap-gallery-admin.js', array( 'media-views' ), $this->version, true );
	}

	/**
	* Register the Media action in the media area.
	*
	* @since    1.0.0
	*/
	public function register_gallery_image_sizes() {
		add_image_size( 'wppninja-bootstrap-image', 350, 350, true );

	}

	/**
	*	Register filter actions for the media upload.
	*
	* @since 1.0.0
	*/

	public function register_gallery_filter_actions() {
		add_filter( 'media_view_settings', array( $this, 'wppninja_bootstrap_gallery_filter_view_settings'));
		add_filter( 'image_size_names_choose', array( $this, 'wppninja_bootstrap_gallery_sizes'));
	}

	/**
	* Set defaults inside of gallery
	*
	* @since 1.0.0
	*/

	public function wppninja_bootstrap_gallery_filter_view_settings($settings) {

		$settings['galleryDefaults']['link'] = 'file';
		$settings['galleryDefaults']['columns'] = '3';

		return $settings;
	}

	/**
	* Set default image inside of gallery
	*
	* @since 1.0.0
	*/

	public function wppninja_bootstrap_gallery_sizes($sizes) {
		$addsizes = array(
			"wppninja-bootstrap-image" => __( "WP Plugin Ninja Bootstrap Image")
		);

		$newsizes = array_merge($sizes, $addsizes);
		return $newsizes;
	}


}
