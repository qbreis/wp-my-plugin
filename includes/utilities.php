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
    $icon = 
        (MY_PLUGIN_DATA['Menu admin icon'])
        ?
        MY_PLUGIN_URL.MY_PLUGIN_DATA['Menu admin icon']
        :
        'dashicons-admin-generic'
        ;
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

/**
 * 
 * Enqueue the admin-specific stylesheet and JavaScript.
 */
function plugin_settings_page_content() {

    // Register the JavaScript for the admin area.
    wp_enqueue_script( 'my-plugin', MY_PLUGIN_URL . 'admin/js/my-plugin.js' );

    // Register the stylesheets for the admin area.
    wp_enqueue_style( 'my-plugin', MY_PLUGIN_URL . 'admin/css/my-plugin.css' );

    // It sanitize post fields
    $my_plugin_submission = (
        isset($_POST['my_plugin_submission']))
        ?
        sanitize_text_field( $_POST['my_plugin_submission'] )
        :
        ''
        ;
    
    if( $my_plugin_submission){
        handle_form($my_plugin_submission);
    }
    include (MY_PLUGIN_PATH.'admin/settings-page.php'); 
}

function handle_form($my_plugin_submission) {
    if( ! $my_plugin_submission || ! wp_verify_nonce( $my_plugin_submission, 'my_plugin_update' ) ){ ?>
        <div class="error">
            <p>Sorry, your nonce was not correct. Please try again.</p>
        </div><?php
        exit;
    } else {
        
        $my_plugin_custom_field = (isset($_POST['my_plugin_custom_field']))?sanitize_text_field( $_POST['my_plugin_custom_field'] ):'';
        $my_plugin_is_active = (isset($_POST['my_plugin_is_active']))?sanitize_text_field( $_POST['my_plugin_is_active'] ):'';

        update_option( 'my_plugin_custom_field', $my_plugin_custom_field );
        update_option( 'my_plugin_is_active', $my_plugin_is_active );
    }
}

function my_plugin_load_textdomain() {
    load_plugin_textdomain( 'my-plugin', false,  dirname( MY_PLUGIN_BASENAME ) . '/languages/' );
}