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
   <form method="post" action="<?php echo get_bloginfo( 'wpurl' ) . '/wp-admin/upload.php?page=wprm-options' ?>">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="image_urls"><?php echo ucwords( __( 'IMAGE URLS:', 'artiss-transient-cleaner' ) ); ?><?php echo _e( '<br>(Enter Urls separated by "," or "|")', 'wp_remote_media_upload' ); ?></label></th>

                <td><textarea name="image_urls" id="image_urls" cols="100" placeholder="Enter Image Urls" required="required" rows="8" ></textarea></td>
            </tr>
        </table>
        <?php wp_nonce_field( 'wp-remote-media-upload-options', 'wp_remote_media_upload_options_nonce', true, true ); ?>
        <input type="submit" name="Options" class="button-primary" value="<?php echo _e( 'Upload Images', 'wp_remote_media_upload' ); ?>"/>
   </form>

</div>