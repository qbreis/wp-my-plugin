<?php
/**
 * 
 * Plugin name: My Plugin
 * Description: My Plugin skeleton getting some points from https://www.youtube.com/watch?v=Bx0oisOOqNg 
 * Author: Enric Gatell
 * Author URI: https://github.com/qbreis
 * Version: 1.0.0
 * Menu admin icon: /admin/images/my-plugin-menu-icon.png
 * Title admin icon: /admin/images/my-plugin-logo.svg
 * 
 * Text Domain: my-plugin
 * Domain Path: /language/
 * 
 */

// If this file is called directly, abort.
if(!defined('ABSPATH')){
    die('You cannot be here');
}

if(!class_exists('MyPlugin')){
    /**
     * The core plugin class.
     * A class definition that includes attributes and functions used across both the
     * public-facing side of the site and the admin area.
     */
    class MyPlugin{

        /**
         * Define the core functionality of the plugin.
         */
        public function __construct(){
            // Define constants for some plugin params.
            define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('MY_PLUGIN_BASENAME', plugin_basename(__FILE__));
            define(
                'MY_PLUGIN_DATA', 
                get_file_data(
                    __FILE__, 
                    array(
                        'Version' => 'Version',                     // Start at version 1.0.0 and use SemVer - https://semver.org
                        'Plugin Name' => 'Plugin Name',
                        'Text Domain' => 'Text Domain',
                        'Menu admin icon' => 'Menu admin icon',
                        'Title admin icon' => 'Title admin icon',
                    ), 
                    false
                )
            );
        }

        /**
         * Define the plugin logic.
         */
        public function initialize(){
            include_once MY_PLUGIN_PATH.'includes/utilities.php';

            // Add shortcut capabilities
            add_shortcode('my-plugin', 'my_plugin_shortcode');

            // Add admin menu item.
            add_action('admin_menu', 'create_plugin_settings_page');

            // Define the locale for this plugin for internationalization.
            add_action('plugins_loaded', 'my_plugin_load_textdomain');
        }
    }
    $myPlugin = new MyPlugin;
    $myPlugin->initialize();
}