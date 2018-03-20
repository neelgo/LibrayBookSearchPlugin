<?php

/**
 * 
 * @since             0.0.1
 * @package           ds_library_book_search
 *
 * @wordpress-plugin
 * Plugin Name:       library book search
 * Plugin URI:        http://example.com/ds_library_book_search-uri/
 * Description:       A search plugin for books in library i.e book is only custom post type for which this plugin works. This plugin and its code, In case neelesh may want to extend this plugin for any number of post type with any number of attributes/ fields / taxonomy all configurable from admin.
 * Version:           0.0.1 beta
 * Author:            Neelesh Gothania
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ds_library_book_search
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.1 and use SemVer - https://semver.org
 * Rename this plugin if neelesh gets time and we releases next version.
 */
if (!defined('DS_LIBRARY_BOOK_SEARCH_VERSION'))
    define('DS_LIBRARY_BOOK_SEARCH_VERSION', '0.0.1');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ds-library-book-search-activator.php
 */
function activate_ds_library_book_search() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-ds-library-book-search-activator.php';
    Ds_library_book_search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ds-library-book-search-deactivator.php
 */
function deactivate_ds_library_book_search() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-ds-library-book-search-deactivator.php';
    Ds_library_book_search_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_ds_library_book_search');
register_deactivation_hook(__FILE__, 'deactivate_ds_library_book_search');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-ds-library-book-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_ds_library_book_search() {

    $plugin = new Ds_library_book_search();
    $plugin->run();
}

run_ds_library_book_search();
