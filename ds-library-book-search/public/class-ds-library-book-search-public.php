<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/public
 * @author     Your Name <email@example.com>
 */
if (!class_exists('Ds_library_book_search_Public')) {

    class Ds_library_book_search_Public {

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
         * @param      string    $ds_library_book_search       The name of the plugin.
         * @param      string    $version    The version of this plugin.
         */
        public function __construct($ds_library_book_search, $version) {

            $this->ds_library_book_search = $ds_library_book_search;
            $this->version = $version;


            // add shortcode
            add_shortcode('Library-book-search', array($this, 'Ds_library_book_search_shortcode'));
        }

        /**
         * Register the stylesheets for the public-facing side of the site.
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
            wp_enqueue_style('jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), $this->version, 'all');
            // Checking if bootstrap css is already including otherwise, include. 
            global $wp_styles;

            $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src'));
            if (in_array('bootstrap.min.css', $srcs) || in_array('bootstrap.css', $srcs)) {
                /* 'bootstrap.css registered'; */
            } else {
                //var_dump(debug_backtrace());
                wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.css');
            }


            wp_enqueue_style($this->ds_library_book_search, plugin_dir_url(__FILE__) . 'css/ds-library-book-search-public.css', array(), $this->version, 'all');
        }

        /**
         * Register the JavaScript for the public-facing side of the site.
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
            wp_enqueue_script($this->ds_library_book_search, plugin_dir_url(__FILE__) . 'js/ds-library-book-search-public.js', array('jquery'), $this->version, true);
            wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '1.12.1');
            wp_enqueue_script('jquery-blockUI', 'http://malsup.github.io/jquery.blockUI.js', array('jquery'), '1.12.1');


            // Checking if bootstrap js is already including otherwise, include. 
            global $wp_scripts;

            $srcs = array_map('basename', (array) wp_list_pluck($wp_scripts->registered, 'src'));
            if (in_array('bootstrap.min.js', $srcs) || in_array('bootstrap.js', $srcs)) {
                /* 'bootstrap.js registered'; */
            } else {
                wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__) . 'js/bootstrap.js', array('jquery'), $this->version, false);
            }

            // code to declare the URL to the file handling the AJAX request also declaring plugins path etc for reference on front end</p>
            wp_localize_script($this->ds_library_book_search, 'DSlbsAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'pluginDirurl' => plugin_dir_url(__FILE__)));
        }

        public function Ds_library_book_search_shortcode() {
            //die("is there");
            //require_once plugin_dir_path( __FILE__ ) . 'partials/ds-library-book-search-public-display.php';

            ob_start();
            include plugin_dir_path(__FILE__) . 'partials/ds-library-book-search-public-display.php';
            $output = ob_get_clean();
            return $output;
        }

        /**
          General functions for use in frontend.
         */
        public static
                function Ds_library_book_search_rating($filledrating) {
            switch ($filledrating) {
                case "1":
                    return '<div class="star-rating"><span class="dashicons dashicons-star-filled" data-rating="1"></span><span class="dashicons dashicons-star-empty" data-rating="2"></span><span class="dashicons dashicons-star-empty" data-rating="3"></span><span class="dashicons dashicons-star-empty" data-rating="4"></span>
        <span class="dashicons dashicons-star-empty" data-rating="5"></span></div>';
                    break;
                case "2":
                    return '<div class="star-rating"><span class="dashicons dashicons-star-filled" data-rating="1"></span><span class="dashicons dashicons-star-filled" data-rating="2"></span><span class="dashicons dashicons-star-empty" data-rating="3"></span><span class="dashicons dashicons-star-empty" data-rating="4"></span>
        <span class="dashicons dashicons-star-empty" data-rating="5"></span></div>';
                    break;
                case "3":
                    return '<div class="star-rating"><span class="dashicons dashicons-star-filled" data-rating="1"></span><span class="dashicons dashicons-star-filled" data-rating="2"></span><span class="dashicons dashicons-star-filled" data-rating="3"></span><span class="dashicons dashicons-star-empty" data-rating="4"></span>
        <span class="dashicons dashicons-star-empty" data-rating="5"></span></div>';
                    break;
                case "4":
                    return '<div class="star-rating"><span class="dashicons dashicons-star-filled" data-rating="1"></span><span class="dashicons dashicons-star-filled" data-rating="2"></span><span class="dashicons dashicons-star-filled" data-rating="3"></span><span class="dashicons dashicons-star-filled" data-rating="4"></span>
        <span class="dashicons dashicons-star-empty" data-rating="5"></span></div>';
                    break;
                case "5":
                    return '<div class="star-rating"><span class="dashicons dashicons-star-filled" data-rating="1"></span><span class="dashicons dashicons-star-filled" data-rating="2"></span><span class="dashicons dashicons-star-filled" data-rating="3"></span><span class="dashicons dashicons-star-filled" data-rating="4"></span>
        <span class="dashicons dashicons-star-filled" data-rating="5"></span></div>';
                    break;
                default:
                    return "  No rating yet. ";
            }
        }

        function the_content_filter($content) {

            $sr = '';
            $output = '';

            $output .= '<div class="header row">
    <div class="cell col-sm-2">Book Name</div>
    <div class="cell col-sm-1">Price</div>
    <div class="cell col-sm-3">Authors</div>
    <div class="cell col-sm-3">Publishers</div>
    <div class="cell col-sm-2">Rating</div>
  </div>';
            ob_start();
            include plugin_dir_path(__FILE__) . 'partials/comman-row-loop.php';
            $output .= ob_get_clean();


            return $output . '<b>Description:</b>' . $content;



            //return $content;
        }

    }

}