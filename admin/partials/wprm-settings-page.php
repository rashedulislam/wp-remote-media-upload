<?php
/**
* WP Remote Media Upload General Options Page
*
* Screen for specifying general options for the plugin
*
* @package    WP_Remote_Media_Upload
* @since      1.0.0
*/
?>

<div class="wprmu-main-wrap wrap">

   <h1><?php _e( 'WP Remote Media Upload Settings', 'wp_remote_media_upload' ); ?></h1>
   <form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/tools.php?page=transient-options' ?>">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="upgrade_optimize"><?php echo ucwords( __( 'Image URLS', 'artiss-transient-cleaner' ) ); ?></label></th>

                <td><input type="textarea" name="image_urls" cols="25" placeholder="Enter Image Urls" required="required" rows="8" ></textarea><?php echo _e( '  Enter Urls separated by "," or "|"', 'wp_remote_media_upload' ); ?></td>
            </tr>
        </table>
        <?php wp_nonce_field( 'wp-remote-media-upload-options', 'wp_remote_media_upload_options_nonce', true, true ); ?>
        <input type="submit" name="Options" class="button-primary" value="<?php echo _e( 'Upload Images', 'wp_remote_media_upload' ); ?>"/>
   </form>

</div>