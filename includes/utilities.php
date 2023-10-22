<?php

if (!defined('ABSPATH')) {
    die('Not allowed!');
}

function create_plugin_settings_page() {
    // Add the menu item and page
    $pluginName = MY_PLUGIN_DATA['Plugin Name'];
    $menu_title = MY_PLUGIN_DATA['Plugin Name'].' '.MY_PLUGIN_DATA['Version'];
    $capability = 'manage_options';
    $slug = MY_PLUGIN_DATA['Text Domain'];
    $callback = 'plugin_settings_page_content';
    $icon = MY_PLUGIN_URL.'images/my-plugin.png'; // $icon = 'dashicons-admin-plugins';
    $position = 100;

    add_menu_page( 
        $pluginName, 
        $menu_title, 
        $capability, 
        $slug, 
        $callback, 
        $icon, 
        $position 
    );
}

function plugin_settings_page_content() {

    wp_enqueue_script( 'my-plugin', MY_PLUGIN_URL . 'includes/js/my-plugin.js' );

    wp_enqueue_style( 'my-plugin', MY_PLUGIN_URL . 'includes/css/my-plugin.css' );

    $my_plugin_submission = (isset($_POST['my_plugin_submission']))?sanitize_text_field( $_POST['my_plugin_submission'] ):'';
    if( $my_plugin_submission){
        handle_form($my_plugin_submission);
    }
    include (MY_PLUGIN_PATH.'includes/templates/settings-page.php'); 
}

function handle_form($my_plugin_submission) {
    if( ! $my_plugin_submission || ! wp_verify_nonce( $my_plugin_submission, 'my_plugin_update' ) ){ ?>
        <div class="error">
            <p>Sorry, your nonce was not correct. Please try again.</p>
        </div><?php
        exit;
    } else {
        
        $my_plugin_custom_field = (isset($_POST['my_plugin_custom_field']))?sanitize_text_field( $_POST['my_plugin_custom_field'] ):'';

        update_option( 'my_plugin_custom_field', $my_plugin_custom_field );
    }
}