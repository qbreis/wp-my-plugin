<?php
/**
 * 
 * Plugin name: My Plugin
 * Description: My Plugin skeleton getting some points from https://www.youtube.com/watch?v=Bx0oisOOqNg 
 * Author: Enric Gatell
 * Author URI: https://github.com/qbreis
 * Version: 1.0.0
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
                    ), 
                    false
                )
            );
        }

        public function initialize()
        {
            include_once MY_PLUGIN_PATH . 'includes/utilities.php';

            include_once MY_PLUGIN_PATH . 'includes/my-plugin-page.php';

            include_once MY_PLUGIN_PATH . 'includes/my-plugin.php';
        }
    }
    $myPlugin = new MyPlugin;
    $myPlugin->initialize();
}