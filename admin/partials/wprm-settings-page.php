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
   <form method="post" action="" class="wp-remote-media-upload-form">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="image_url"><?php echo ucwords( __( 'Image url:', 'artiss-transient-cleaner' ) ); ?><?php echo _e( '<br>(Enter image url "jpg", "png", "gif", "ico" format)', 'wp_remote_media_upload' ); ?></label></th>

                <td><textarea name="image_url" id="image_url" cols="80" placeholder="Enter Image Url" required="required" rows="3" ></textarea></td>
            </tr>
        </table>
        <input type="submit" name="submit" class="button-primary wprmu-button" value="<?php echo _e( 'Upload Images', 'wp_remote_media_upload' ); ?>"/>
   </form>

</div>