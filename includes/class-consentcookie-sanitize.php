<?php

/**
 * Sanitize anything
 *
 * @since      1.0.0
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/includes
 */

class ConsentCookie_Sanitize {

	/**
	 * The data to be sanitized
	 *
	 * @access 	private
	 * @since 	0.1
	 * @var 	string
	 */
	private $data = '';

	/**
	 * The type of data
	 *
	 * @access 	private
	 * @since 	0.1
	 * @var 	string
	 */
	private $type = '';

	/**
	 * Constructor
	 */
	public function __construct() {

		// Nothing to see here...

	} // __construct()

	/**
	 * Cleans the data
	 *
	 * @access 	public
	 * @since 	0.1
	 *
	 * @uses 	sanitize_email()
	 * @uses 	sanitize_phone()
	 * @uses 	esc_textarea()
	 * @uses 	sanitize_text_field()
	 * @uses 	esc_url()
	 *
	 * @return  mixed         The sanitized data
	 */
	public function clean() {

		$sanitized = '';

		/**
		 * Add additional santization before the default sanitization
		 */
		do_action( 'slushman_pre_sanitize', $sanitized );

		switch ( $this->type ) {
            case 'color':
            case 'radio':
            case 'select':
                $sanitized = $this->sanitize_random($this->data);
                break;
            
            case 'date':
            case 'datetime':
            case 'datetime-local':
            case 'time':
            case 'week':
                $sanitized = strtotime($this->data);
                break;
            
            case 'number':
            case 'range':
                $sanitized = intval($this->data);
                break;
            
            case 'hidden':
            case 'month':
            case 'text':
                $sanitized = sanitize_text_field($this->data);
                break;
            
            case 'checkbox':
                $sanitized = (isset($this->data) ? 1 : 0);
                break;
            case 'editor':
                $sanitized = wp_kses_post($this->data);
                break;
            case 'email':
                $sanitized = sanitize_email($this->data);
                break;
            case 'file':
                $sanitized = sanitize_file_name($this->data);
                break;
            case 'textarea':
                $sanitized = wp_check_invalid_utf8(get_magic_quotes_gpc() ? stripslashes($this->data) : $this->data, true);
                break;
            case 'url':
                $sanitized = esc_url($this->data);
                break;

		} // switch

		/**
		 * Add additional santization after the default .
		 */
		do_action( 'slushman_post_sanitize', $sanitized );

		return $sanitized;

	} // clean()

	/**
	 * Checks a date against a format to ensure its validity
	 *
	 * @link 	http://www.php.net/manual/en/function.checkdate.php
	 *
	 * @param  	string 		$date   		The date as collected from the form field
	 * @param  	string 		$format 		The format to check the date against
	 * @return 	string 		A validated, formatted date
	 */
	private function validate_date( $date, $format = 'Y-m-d H:i:s' ) {

		$version = explode( '.', phpversion() );

		if ( ( (int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17 ) ) {

			$d = DateTime::createFromFormat( $format, $date );

		} else {

			$d = new DateTime( date( $format, strtotime( $date ) ) );

		}

		return $d && $d->format( $format ) == $date;

	} // validate_date()

	/**
	 * Performs general cleaning functions on data
	 *
	 * @param 	mixed 	$input 		Data to be cleaned
	 * @return 	mixed 	$return 	The cleaned data
	 */
	private function sanitize_random( $input ) {

			$one	= trim( $input );
			$two	= stripslashes( $one );
			$return	= htmlspecialchars( $two );

		return $return;

	} // sanitize_random()

	/**
	 * Sets the data class variable
	 *
	 * @param 	mixed 		$data			The data to sanitize
	 */
	public function set_data( $data ) {

		$this->data = $data;

	} // set_data()

	/**
	 * Sets the type class variable
	 *
	 * @param 	string 		$type			The field type for this data
	 */
	public function set_type( $type ) {

		$check = '';

		if ( empty( $type ) ) {

			$check = new WP_Error( 'forgot_type', __( 'Specify the data type to sanitize.', 'consentcookie' ) );

		}

		if ( is_wp_error( $check ) ) {

			wp_die( $check->get_error_message(), __( 'Forgot data type', 'consentcookie' ) );

		}

		$this->type = $type;

	} // set_type()

} // class