<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       		http://www.wpplugin.ninja
 * @since      		1.0.0
 *
 * @package    	Wppninja_Bootstrap_Gallery
 * @subpackage 	Wppninja_Bootstrap_Gallery/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    	Wppninja_Responsive_Gallery
 * @subpackage 	Wppninja_Responsive_Gallery/public
 * @author     	Stuart Shields <info@wpplugin.ninja>
 */
class Wppninja_Bootstrap_Gallery_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $wppninja_bootstrap_gallery;

	private $wppninja_gallery_gallery_shortcode;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wppninja_bootstrap_gallery, $version ) {

		$this->wppninja_bootstrap_gallery = $wppninja_bootstrap_gallery;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wppninja_Responsive_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wppninja_Responsive_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'css-magnific-popup', plugin_dir_url( __FILE__ ) . 'css/magnific-popup.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->wppninja_bootstrap_gallery, plugin_dir_url( __FILE__ ) . 'css/wppninja-bootstrap-gallery.css', array(), $this->version, 'all' );
	}

	/**
	* Register the stylesheets for the public-facing side of the site.
	*
	* @since    1.0.0
	*/
	public function enqueue_scripts() {

		/**
		 * This function calls all of the required js files
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wppninja_Responsive_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wppninja_Responsive_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'jquery-magnific-popup', plugin_dir_url( __FILE__ ) . 'js/jquery.magnific-popup.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->wppninja_bootstrap_gallery, plugin_dir_url( __FILE__ ) . 'js/wppninja-bootstrap-gallery-public.js', array( 'jquery' ), $this->version, false );



	}

	/**
	* Registers all shortcodes at once
	*
	* @return [type] [description]
	*/
	public function register_gallery_shortcodes() {

		/* de-register gallery shortcode */
		remove_shortcode('gallery', 'gallery_shortcode');
		/*re-register gallery code*/
		add_shortcode( 'gallery', array( $this, 'wppninja_bootstrap_gallery_shortcode' ) );

	}

	/**
	* Processes Black tie bootstrap gallery shortcode
	*
	* @param   array	$atts		The attributes from the shortcode
	*
	* @uses	get_option
	* @uses	get_layout
	*
	* @return	mixed	$output		Output of the buffer
	*/
	public function wppninja_bootstrap_gallery_shortcode( $attr ) {
		static $instance = 0;
		 $instance++;

		if(isset($attr['columns'])):
			$columns = $attr['columns'];
			if($columns == 2):
				$column = 6;
			elseif($columns == 3):
				$column = 4;
			elseif($columns == 4):
				$column = 3;
			elseif($columns == 6):
				$column = 2;
			endif;
		else:
			$columns = 3;
			$column = 4;
		endif;

		if(isset($attr['size'])):
			$size = $attr['size'];
		elseif ( function_exists( 'add_image_size' ) ):
			$size = "wppninja-bootstrap-image";
		else:
			$size = "thumbnail";
		endif;

		if(isset($attr['orderby'])):
			$orderby = $attr['orderby'];
		endif;

		$ids = explode(',', $attr['ids']);

		if(isset($orderby)):

			$ids = $this->shuffle_gallery($ids);
		endif;

		$output = '';

		$output .= "<div id='wppninja-gallery-".$instance."' class='wppninja-gallery'>\n";
			$output .= "<div class='row'>\n";
			$current_row = 0;
			foreach($ids as $id) {
				if($current_row % $columns == 0) {
					$output .="<div class='clearfix'></div>\n";
					$output .= "</div>\n";
					$output .= "<div class='row wppninja-spacing'>\n";
				}
				$thumbnail = wp_get_attachment_image_src($id, $size);
				$large = wp_get_attachment_image_src($id, 'large');
				$thumbnail_info = get_post( $id );
				$has_caption = $thumbnail_info->post_excerpt;

				$output .= "<div class='col-md-".$column." col-sm-".$column." col-xs-".$column."'>\n";
					$output .= "<a href='".$large[0]."' title='".$thumbnail_info->post_excerpt."' class='thumbnail'>\n";
						$output .= "<img src='".$thumbnail[0]."' class='img-responsive' >\n";
						if(!empty($has_caption)):
							$output .= "<div class='caption'>\n";
								$output .= $thumbnail_info->post_excerpt;
							$output .= "</div>";
						endif;
					$output .= "</a>\n";
				$output .= "</div>\n";

				$current_row++;
			}

			$output .= "</div>\n";

		$output .= "</div>\n";

		return $output;
	}

	/**
	* Shuffle gallery
	*
	* @param   array	$atts		The attributes from the shortcode
	*
	* @uses	get_option
	* @uses	get_layout
	*
	* @return	mixed	$output		Output of the buffer
	*/
	private function shuffle_gallery($list) {
		if (!is_array($list)) return $list;

			$keys = array_keys($list);
			shuffle($keys);
			$random = array();
			foreach ($keys as $key) {
			$random[$key] = $list[$key];
			}
			return $random;
		}
	}