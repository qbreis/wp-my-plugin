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

if( !defined('ABSPATH') )
{
      die('You cannot be here');
}

if( !class_exists('MyPlugin') )
{
    class MyPlugin
    {
        
        public function __construct()
        {
            define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

            define( 'MY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

            define( 'MY_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

            define(
                'MY_PLUGIN_DATA', 
                get_file_data(
                    __FILE__, 
                    array(
                        'Version' => 'Version', 
                        'Plugin Name' => 'Plugin Name',
                        'Text Domain' => 'Text Domain',
                        'Menu admin icon' => 'Menu admin icon',
                        'Title admin icon' => 'Title admin icon',
                    ), 
                    false
                )
            );
        }

        public function initialize()
        {
            include_once MY_PLUGIN_PATH . 'includes/utilities.php';

            // Add shortcut capabilities
            add_shortcode('my-plugin', 'my_plugin_shortcode');

            // Add admin menu item.
            add_action('admin_menu', 'create_plugin_settings_page');

            // Define the locale for this plugin for internationalization.
            add_action('plugins_loaded', 'my_plugin_load_textdomain');


            //include_once MY_PLUGIN_PATH . 'public/my-plugin-public.php';
        }
    }
    $myPlugin = new MyPlugin;
    $myPlugin->initialize();
}