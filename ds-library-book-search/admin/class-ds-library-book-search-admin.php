<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/admin
 * @author     Your Name <email@example.com>
 */
class Ds_library_book_search_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $ds_library_book_search    The ID of this plugin.
	 */
	private $ds_library_book_search;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $ds_library_book_search       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $ds_library_book_search, $version ) {

		$this->ds_library_book_search = $ds_library_book_search;
		$this->version = $version;
		 
        add_action('admin_menu', array($this,'ds_library_book_search_options_page'));
		
	 // init register post type, I have a class for this in includes in main plugin class please see 
	// add_action( 'init', array($this,'includeclasscpt'),10);
	  // add_action( 'init', array($this,'register_book_type'));
	}
	


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ds_library_book_search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ds_library_book_search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->ds_library_book_search, plugin_dir_url( __FILE__ ) . 'css/ds-library-book-search-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ds_library_book_search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ds_library_book_search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->ds_library_book_search, plugin_dir_url( __FILE__ ) . 'js/ds-library-book-search-admin.js', array( 'jquery' ), $this->version, false );

	}
	
 


 public function ds_library_book_search_options_page()
{
	
    add_menu_page(
        'Book search shortcode',
        'Book search shortcode',
        'manage_options',
        'library_book_search_options',
       array($this,'book_search_options_page_html'),
         'dashicons-search',
        20
    );
	
}

public static function book_search_options_page_html(){
	require_once plugin_dir_path( __FILE__ ) . 'partials/ds-library-book-search-admin-display.php';	
}

}
