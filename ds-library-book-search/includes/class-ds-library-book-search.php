<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/includes
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
 * @since      0.0.1
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/includes
 * @author     Neelesh Gothania <mr.neelesh.gothania@gmail.com>
 */
 if(!class_exists('Ds_library_book_search')){
class Ds_library_book_search {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      Ds_library_book_search_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      string    $ds_library_book_search    The string used to uniquely identify this plugin.
	 */
	protected $ds_library_book_search;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function __construct() {
		if ( defined( 'DS_LIBRARY_BOOK_SEARCH_VERSION' ) ) {
			$this->version = DS_LIBRARY_BOOK_SEARCH_VERSION;
		} else {
			$this->version = '0.0.1';
		}
		$this->ds_library_book_search = 'ds-library-book-search';

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
	 * - Ds_library_book_search_Loader. Orchestrates the hooks of the plugin.
	 * - Ds_library_book_search_i18n. Defines internationalization functionality.
	 * - Ds_library_book_search_Admin. Defines all hooks for the admin area.
	 * - Ds_library_book_search_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    0.0.1
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ds-library-book-search-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ds-library-book-search-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ds-library-book-search-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ds-library-book-search-public.php';
		
		/**
		 * The class responsible for creating custom post type
		 * 
		 */
		 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cpt.php';
		 
		/**
		 * The class responsible for creating Book custom post type using above class
		 * 
		 */
		 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cpt-book.php';

		$this->loader = new Ds_library_book_search_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ds_library_book_search_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    0.0.1
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ds_library_book_search_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ds_library_book_search_Admin( $this->get_ds_library_book_search(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ds_library_book_search_Public( $this->get_ds_library_book_search(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles',99 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts',99 );
		
		
		
  // creating Ajax call for WordPress
	//	$this->loader->add_action( 'wp_ajax_nopriv_MyAjaxFunction', $plugin_public, array(&$this, 'MyAjaxFunction'),10);
	//	$this->loader->add_action( 'wp_ajax_MyAjaxFunction', $plugin_public, array(&$this, 'MyAjaxFunction'),10 );
 add_action( 'wp_ajax_MyAjaxFunction', array( $this, 'MyAjaxFunction' ) ); 
        add_action( 'wp_ajax_nopriv_MyAjaxFunction', array( $this, 'MyAjaxFunction' ) );
   
	}
	
	function MyAjaxFunction(){ 
  
  //get the data from ajax() call
   $GreetingAll = $_POST['GreetingAll '];
   $results = "<h2>".$GreetingAll."</h2>";
  // Return the String
   die($results);
  } 

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.0.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.0.1
	 * @return    string    The name of the plugin.
	 */
	public function get_ds_library_book_search() {
		return $this->ds_library_book_search;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.0.1
	 * @return    Ds_library_book_search_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.0.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
 }