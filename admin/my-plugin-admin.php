<?php

if (!defined('ABSPATH')) {
    die('Not allowed!');
}

// Hook into the admin menu
add_action('admin_menu', 'create_plugin_settings_page');

// Define the locale for this plugin for internationalization.
add_action('plugins_loaded', 'my_plugin_load_textdomain');
