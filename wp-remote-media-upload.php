<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://stacklearners.org/wp-remote-media-upload-uri/
 * @since             1.0.0
 * @package           WP_Remote_Media_Upload
 *
 * @wordpress-plugin
 * Plugin Name:       WP Remote Media Upload
 * Plugin URI:        https://stacklearners.org/wp-remote-media-upload-uri/
 * Description:       Upload Images From Remote URL Directly.
 * Version:           1.0.0
 * Author:            Md Rashedul Islam
 * Author URI:        https://rashedul.co/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_remote_media_upload
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_REMOTE_MEDIA_UPLOAD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-remote-media-upload-activator.php
 */
function activate_wp_remote_media_upload() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-remote-media-upload-activator.php';
	WP_Remote_Media_Upload_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-remote-media-upload-deactivator.php
 */
function deactivate_wp_remote_media_upload() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-remote-media-upload-deactivator.php';
	WP_Remote_Media_Upload_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_remote_media_upload' );
register_deactivation_hook( __FILE__, 'deactivate_wp_remote_media_upload' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-remote-media-upload.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_remote_media_upload() {

	$plugin = new WP_Remote_Media_Upload();
	$plugin->run();

}
run_wp_remote_media_upload();
