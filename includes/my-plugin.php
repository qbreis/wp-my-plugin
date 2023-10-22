<?php

if (!defined('ABSPATH')) {
      die('You cannot be here');
}

add_shortcode('my-plugin', 'my_plugin');

function my_plugin()
{

    wp_enqueue_style( 'my-plugin', MY_PLUGIN_URL . 'css/my-plugin.css' );
    
    wp_enqueue_script( 'my-plugin', MY_PLUGIN_URL . 'js/my-plugin.js' );

    return '<div class="my-plugin">my plugin: <br />my_plugin_custom_field: '.get_option('my_plugin_custom_field').'</div>';
}