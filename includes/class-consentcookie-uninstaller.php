<?php

/**
 * Fired during plugin uninstall
 *
 * @link       https://github.com/humanswitch/wordpress-consentcookie
 * @since      1.0.0
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/includes
 */

/**
 * Fired during plugin uninstall.
 *
 * This class defines all code necessary to run during the plugin's uninstall.
 *
 * @since      1.0.0
 * @package    ConsentCookie
 * @subpackage ConsentCookie/includes
 * @author     Ramon Rockx <ramon@humanswitch.io>
 */
class ConsentCookie_Uninstaller {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {
	    delete_option( "consentcookie-options" );
	}

}
