<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/humanswitch/wordpress-consentcookie
 * @since      1.0.0
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/public
 * @author     Ramon Rockx <ramon@humanswitch.io>
 */
class ConsentCookie_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $consentcookie    The ID of this plugin.
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
	
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = $options;

	}
	
	private function getInlineScript() {
		$inlineStr =  "window.ConsentCookie.init(" . html_entity_decode( $this->options['consentcookie-widget-ccc'] ) . ");\r\n";
		if ( ! empty( $this->options['consentcookie-widget-customscript'] ) ) {
		    $inlineStr .= html_entity_decode( stripslashes( $this->options['consentcookie-widget-customscript'] ) ) .";";
        } 
        
        return $inlineStr; 
	}
	
	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ConsentCookie_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ConsentCookie_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

	    wp_enqueue_script( $this->plugin_name, CONSENTCOOKIE_JS, array( 'jquery' ), null, false );
	    wp_add_inline_script( $this->plugin_name, $this->getInlineScript() );
	
	}
	
}
