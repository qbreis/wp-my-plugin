<?php

if (!defined('ABSPATH')) {
    die('Not allowed!');
}

// Hook into the admin menu
add_action('admin_menu', 'create_plugin_settings_page');

add_action('plugins_loaded', 'my_plugin_load_textdomain');