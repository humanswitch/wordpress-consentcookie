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
 * Version:           1.2.1
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
define( 'PLUGIN_VERSION', '1.2.1' );

// ConsentCookie
define( 'CC_VERSION', '1.0.0');
define( 'CC_PATH', 'cc/' . CC_VERSION . '/' );
define( 'CC_CDN_PATH', 'https://cdn.humanswitch.services/cc/consentcookie/app/1/');

// ConsentCookie Configurator
define( 'CCC_CDN_PATH', 'https://cdn.humanswitch.services/cc/configurator/app/2/' );
define( 'CCC_VERSION', '2.0.1' );
define( 'CCC_PATH', 'ccc/' . CCC_VERSION . "/" );

// Options
define( 'OPT_VERSION', 'version' );
define( 'OPT_CCC_CDN', 'ccc-cdn' );
define( 'OPT_CC_ENABLED', 'consentcookie-enabled' );
define( 'OPT_CC_CDN', 'cc-cdn' );
define( 'OPT_CC_WIDGET_CC', 'consentcookie-widget-ccc' );
define( 'OPT_CC_WIDGET_CUSTOMSCRIPT', 'consentcookie-widget-customscript' );
define( 'OPT_CC_CUSTOM_PATH', 'cc-custom-path' );
define( 'OPT_CCC_CUSTOM_PATH', 'ccc-custom-path' );

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
