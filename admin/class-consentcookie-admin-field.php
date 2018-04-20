<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/humanswitch/wordpress-consentcookie
 * @since      1.0.0
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/admin
 * @author     Ramon Rockx <ramon@humanswitch.io>
 */
class ConsentCookie_Admin_Field {

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
	
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $options ) {
	    
	    /**
	     * The class responsible for defining all actions that occur in the admin area.
	     */

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = $options;
		
	}
	
	/**
	 * Creates a checkbox field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_checkbox( $args ) {
	    
	    $defaults['class'] 			= '';
	    $defaults['description'] 	= '';
	    $defaults['label'] 			= '';
	    $defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
	    $defaults['value'] 			= 0;
	    
	    apply_filters( $this->plugin_name . '-field-checkbox-options-defaults', $defaults );
	    
	    $atts = wp_parse_args( $args, $defaults );
	    
	    $atts['value'] = ! empty( $this->options[$atts['id']] ) ? $this->options[$atts['id']] : 0;

	    include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-checkbox.php' );
	    
	} // field_checkbox()
	
	/**
	 * Creates an editor field
	 *
	 * NOTE: ID must only be lowercase letter, no spaces, dashes, or underscores.
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_editor( $args ) {
	    
	    $defaults['description'] 	= '';
	    $defaults['settings'] 		= array( 'textarea_name' => $this->plugin_name . '-options[' . $args['id'] . ']' );
	    $defaults['value'] 			= '';
	    
	    apply_filters( $this->plugin_name . '-field-editor-options-defaults', $defaults );
	    
	    $atts = wp_parse_args( $args, $defaults );
	    
	    if ( ! empty( $this->options[$atts['id']] ) ) {
	        
	        $atts['value'] = $this->options[$atts['id']];
	        
	    }
	    
	    include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-editor.php' );
	    
	} // field_editor()
	
	/**
	 * Creates a text field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_text( $args ) {
	    
	    $defaults['class'] 			= 'text widefat';
	    $defaults['description'] 	= '';
	    $defaults['label'] 			= '';
	    $defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
	    $defaults['placeholder'] 	= '';
	    $defaults['type'] 			= 'text';
	    $defaults['value'] 			= '';
	    
	    apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );
	    
	    $atts = wp_parse_args( $args, $defaults );
	    
	    if ( ! empty( $this->options[$atts['id']] ) ) {
	        
	        $atts['value'] = $this->options[$atts['id']];
	        
	    }
	    
	    include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-text.php' );
	    
	} // field_text()
	
	/**
	 * Creates a textarea field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_textarea( $args ) {
	    
	    $defaults['class'] 			= 'large-text';
	    $defaults['cols'] 			= 50;
	    $defaults['context'] 		= '';
	    $defaults['description'] 	= '';
	    $defaults['label'] 			= '';
	    $defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
	    $defaults['rows'] 			= 10;
	    $defaults['value'] 			= '';
	    
	    apply_filters( $this->plugin_name . '-field-textarea-options-defaults', $defaults );
	    
	    $atts = wp_parse_args( $args, $defaults );
	    
	    if ( ! empty( $this->options[$atts['id']] ) ) {
	        
	        $atts['value'] = $this->options[$atts['id']];
	        
	    }
	    
	    include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-textarea.php' );
	    
	} // field_textarea()
	
	/**
	 * Creates a textarea field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_ccc( $args ) {
	    
	    $defaults['class'] 			= 'large-text';
	    $defaults['cols'] 			= 50;
	    $defaults['context'] 		= '';
	    $defaults['description'] 	= '';
	    $defaults['label'] 			= '';
	    $defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
	    $defaults['rows'] 			= 10;
	    $defaults['value'] 			= '';
	    
	    apply_filters( $this->plugin_name . '-field-ccc-options-defaults', $defaults );
	    
	    $atts = wp_parse_args( $args, $defaults );
	    
	    if ( ! empty( $this->options[$atts['id']] ) ) {
	        
	        $atts['value'] = $this->options[$atts['id']];
	        
	    }
	    
	    include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-ccc.php' );
	    
	} // field_textarea()
	
}