<?php

if (!defined('ABSPATH')) {
    die('Not allowed!');
}

?>
<div class="wrap">
        
    <h1 class="wp-heading-inline" style="margin-bottom: 10px;">
        <?=MY_PLUGIN_DATA['Plugin Name']?> (v<?=MY_PLUGIN_DATA['Version']?>) 
        <a href="admin.php?page=carte-interactive&action=new" class="page-title-action">
            Ajouter
        </a>
    </h1>
    <?php
    $my_plugin_submission = (isset($_POST['my_plugin_submission']))?sanitize_text_field( $_POST['my_plugin_submission'] ):'';
    if( $my_plugin_submission){
    ?>
        <div class="updated">
            <p>Your fields were saved!</p>
        </div>
    <?php
    }
    ?>
    <?php //wp_editor( 'zxczc', 'test-wp-editor-2' ); ?>
    <form method="POST">
        <?php wp_nonce_field( 'my_plugin_update', 'my_plugin_submission' ); ?>
        <label for="my_plugin_custom_field">
            <?php _e('My plugin custom field');?>
        </label>
        <input 
            name="my_plugin_custom_field" 
            id="my_plugin_custom_field" 
            type="text" 
            value="<?php echo get_option('my_plugin_custom_field'); ?>" 
            class="regular-text" 
            />
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save' )?>">
            </p>
    </form>
    

</div><!-- .wrap -->