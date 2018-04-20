<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/humanswitch/wordpress-consentcookie
 * @since             1.0.0
 * @package           Consent_Cookie
 *
 * @wordpress-plugin
 * Plugin Name:       ConsentCookie
 * Plugin URI:        https://github.com/humanswitch/wordpress-consentcookie
 * Description:       ConsentCookie is an open source solution for collecting GDPR compliant data on your website.
 * Version:           1.0.0
 * Author:            HumanSwitch
 * Author URI:        https://www.humanswitch.io
 * License:           Apache License Version 2.0
 * License URI:       http://www.apache.org/licenses/
 * Text Domain:       consentcookie
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'CONSENTCOOKIE_VERSION', '1.0.0' );
define( 'CONSENTCOOKIE_CONFIGURATOR_PATH', 'https://www.consentcookie.nl/configurator/static/' );
define( 'CONSENTCOOKIE_JS', 'https://www.consentcookie.nl/consentcookie/latest/consentcookie.min.js');


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-consentcookie.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_consentcookie() {

	$plugin = new ConsentCookie();
	$plugin->run();

}

run_consentcookie();