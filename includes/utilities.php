<?php
// If this file is called directly, abort.
if(!defined('ABSPATH')){
    die('Not allowed!');
}

/**
 * Add admin menu item.
 */
function create_plugin_settings_page(){
    add_menu_page(                                                      // Add the menu item and page
        MY_PLUGIN_DATA['Plugin Name'],                                  // Plugin name
        MY_PLUGIN_DATA['Plugin Name'].' '.MY_PLUGIN_DATA['Version'],    // Plugin title
        'manage_options',                                               // Capability
        MY_PLUGIN_DATA['Text Domain'],                                  // slug
        'plugin_settings_page_content',                                 // Callback
        (MY_PLUGIN_DATA['Menu admin icon'])                             // Icon
            ?
            MY_PLUGIN_URL.MY_PLUGIN_DATA['Menu admin icon']             // ... custom menu icon if it is defined in Plugin Header Fields as 'Menu admin icon'
            :
            'dashicons-admin-generic',                                  // ... default menu icon if custom is not defined
        100                                                             // Position
   );
}

/**
 * 
 * Enqueue the admin-specific stylesheet and JavaScript... among other logic.
 */
function plugin_settings_page_content(){

    // Register all of the hooks related to the admin-specific area functionality --define_admin_hooks()

    // Register the JavaScript for the admin area.
    wp_enqueue_script('my-plugin', MY_PLUGIN_URL.'admin/js/my-plugin.js');

    // Register the stylesheets for the admin area.
    wp_enqueue_style('my-plugin', MY_PLUGIN_URL.'admin/css/my-plugin.css');

    // It sanitize post fields if found.
    $my_plugin_submission = (
        isset($_POST['my_plugin_submission']))
        ?
        sanitize_text_field($_POST['my_plugin_submission'])
        :
        ''
        ;
    
    if($my_plugin_submission){
        handle_form($my_plugin_submission);
    }
    include (MY_PLUGIN_PATH.'admin/settings-page.php'); 
}

function handle_form($my_plugin_submission){
    if(! $my_plugin_submission || ! wp_verify_nonce($my_plugin_submission, 'my_plugin_update')){ ?>
        <div class="error">
            <p>Sorry, your nonce was not correct. Please try again.</p>
        </div><?php
        exit;
    }else{
        
        $my_plugin_custom_field = (isset($_POST['my_plugin_custom_field'])) ? sanitize_text_field($_POST['my_plugin_custom_field']) : '';
        $my_plugin_is_active = (isset($_POST['my_plugin_is_active'])) ? sanitize_text_field($_POST['my_plugin_is_active']) : '';

        update_option('my_plugin_custom_field', $my_plugin_custom_field);
        update_option('my_plugin_is_active', $my_plugin_is_active);
    }
}

/**
 * Load the plugin text domain for translation.
 */
function my_plugin_load_textdomain(){
    load_plugin_textdomain(
        'my-plugin', 
        false,  
        dirname(MY_PLUGIN_BASENAME).'/languages/' 
    );
}

function my_plugin_shortcode(){
    if(!get_option('my_plugin_is_active')){
        return '';
        die();
    }
    
    // Register all of the hooks related to the public-facing functionality --define_public_hooks()
    wp_enqueue_style('my-plugin', MY_PLUGIN_URL.'public/css/my-plugin.css');
    wp_enqueue_script('my-plugin', MY_PLUGIN_URL.'public/js/my-plugin.js');
    ob_start();
    include_once MY_PLUGIN_PATH.'public/my-plugin.php';
    return ob_get_clean();
}

