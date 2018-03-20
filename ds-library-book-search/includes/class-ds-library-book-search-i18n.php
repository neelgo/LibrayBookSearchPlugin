<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.0.1
 * @package    Ds_library_book_search
 * @subpackage Ds_library_book_search/includes
 * @author     Neelesh Gothania <mr.neelesh.gothania@gmail.com>
 */
class Ds_library_book_search_i18n {

    /**
     * Load the plugin text domain for translation.
     *
     * @since    0.0.1
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
                'ds-library-book-search', false, dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }

}
