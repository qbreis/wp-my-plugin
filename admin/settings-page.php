<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * This file should primarily consist of HTML with a little bit of PHP.
 */
?>

<?php
if (!defined('ABSPATH')) {
    die('Not allowed!');
}
?>
<div class="wrap">
        
    <h1 class="wp-heading-inline" style="margin-bottom: 10px;">
        <?php if(MY_PLUGIN_DATA['Title admin icon']){?>
            <img src="<?=MY_PLUGIN_URL.MY_PLUGIN_DATA['Title admin icon']?>" class="my-plugin-logo" />
        <?php } ?>
        <?=MY_PLUGIN_DATA['Plugin Name']?> (v<?=MY_PLUGIN_DATA['Version']?>)
    </h1>
    <?php
    $my_plugin_submission = (isset($_POST['my_plugin_submission']))?sanitize_text_field( $_POST['my_plugin_submission'] ):'';
    if( $my_plugin_submission){
    ?>
        <div class="updated">
            <p><?=__('Your fields were saved!', 'my-plugin');?></p>
        </div>
    <?php
    }
    ?>
    <?php //wp_editor( 'zxczc', 'test-wp-editor-2' ); ?>
    <form method="POST">
        <?php wp_nonce_field( 'my_plugin_update', 'my_plugin_submission' ); ?>

        <table class="form-table" onclick="showHide( '#my_plugin_is_active', '.my-plugin-active-settings' );">
            <tbody>
                <tr>
                    <th>
                        <label for="my_plugin_is_active">
                        <?=__('Activate my plugin', 'my-plugin');?>
                        </label>
                    </th>
                    <td>
                        <input 
                            name="my_plugin_is_active" 
                            id="my_plugin_is_active" 
                            type="checkbox" 
                            value="1" 
                            class="regular-text"
                            <?php if ( get_option('my_plugin_is_active') ) echo ' checked="checked"';?> 
                            />
                        <label for="my_plugin_is_active"><?= __('Active', 'my-plugin');?></label>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="form-table my-plugin-active-settings hidden">
            <tbody>
                <tr>
                    <th>
                        <label for="my_plugin_custom_field">
                            <?=__('My plugin custom field', 'my-plugin');?>
                        </label>
                    </th>
                    <td>
                        <input 
                            name="my_plugin_custom_field" 
                            id="my_plugin_custom_field" 
                            type="text" 
                            value="<?php echo get_option('my_plugin_custom_field'); ?>" 
                            class="regular-text" 
                            />
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?=__( 'Save' )?>">
        </p>
    </form>
    

</div><!-- .wrap -->