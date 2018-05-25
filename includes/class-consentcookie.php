<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/humanswitch/wordpress-consentcookie
 * @since      1.0.0
 *
 * @package    ConsentCookie
 * @subpackage ConsentCookie/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    ConsentCookie
 * @subpackage ConsentCookie/includes
 * @author     Ramon Rockx <ramon@humanswitch.io>
 */
class ConsentCookie {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      ConsentCookie_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $consentcookie    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	
	/**
	 * Sanitizer for cleaning user input
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      ConsentCookie_Sanitize    $sanitizer    Sanitizes data
	 */
	private $sanitizer;
	
	private $options;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->version = PLUGIN_VERSION;
		$this->plugin_name = 'consentcookie';
		$this->options = get_option( $this->plugin_name . '-options' );
		
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - ConsentCookie_Loader. Orchestrates the hooks of the plugin.
	 * - ConsentCookie_i18n. Defines internationalization functionality.
	 * - ConsentCookie_Admin. Defines all hooks for the admin area.
	 * - ConsentCookie_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-consentcookie-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-consentcookie-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-consentcookie-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-consentcookie-public.php';
		
		/**
		 * The class responsible for sanitizing user input
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-consentcookie-sanitize.php';
		
		$this->loader = new ConsentCookie_Loader();
		$this->sanitizer = new ConsentCookie_Sanitize();
		
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the ConsentCookie_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new ConsentCookie_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
	    if ( is_admin() ) {	    
	        $plugin_admin = new ConsentCookie_Admin( $this->get_consentcookie(), $this->get_version() );
	        
	        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
	        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	        $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu' );
	        $this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
	        $this->loader->add_action( 'admin_init', $plugin_admin, 'register_sections' );
	        $this->loader->add_action( 'admin_init', $plugin_admin, 'register_fields' );
	        $this->loader->add_action( 'admin_notices', $plugin_admin, 'register_update_notice' );
	    }
		
	}
	
	private function is_enabled() {
	    return $this->options[OPT_CC_ENABLED];
	}	

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
	    $plugin_public = new ConsentCookie_Public( $this->get_consentcookie(), $this->get_version(), $this->options );

		if ($this->is_enabled()) {
		    $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_consentcookie() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    ConsentCookie_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public static function deleteOption() {
		delete_option( "consentcookie-options" );
	}

}
