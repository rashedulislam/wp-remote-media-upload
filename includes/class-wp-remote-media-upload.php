<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_Remote_Media_Upload
 * @subpackage WP_Remote_Media_Upload/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WP_Remote_Media_Upload
 * @subpackage WP_Remote_Media_Upload/includes
 * @author     Your Name <email@example.com>
 */
class WP_Remote_Media_Upload {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WP_Remote_Media_Upload_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $wp_remote_media_upload    The string used to uniquely identify this plugin.
	 */
	protected $wp_remote_media_upload;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WP_REMOTE_MEDIA_UPLOAD_VERSION' ) ) {
			$this->version = WP_REMOTE_MEDIA_UPLOAD_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->wp_remote_media_upload = 'wp-remote-media-upload';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WP_Remote_Media_Upload_Loader. Orchestrates the hooks of the plugin.
	 * - WP_Remote_Media_Upload_i18n. Defines internationalization functionality.
	 * - WP_Remote_Media_Upload_Admin. Defines all hooks for the admin area.
	 * - WP_Remote_Media_Upload_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-remote-media-upload-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-remote-media-upload-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-remote-media-upload-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-remote-media-upload-public.php';

		$this->loader = new WP_Remote_Media_Upload_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WP_Remote_Media_Upload_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$wp_remote_media_upload_i18n = new WP_Remote_Media_Upload_i18n();

		$this->loader->add_action( 'plugins_loaded', $wp_remote_media_upload_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$wp_remote_media_upload_admin = new WP_Remote_Media_Upload_Admin( $this->get_wp_remote_media_upload(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $wp_remote_media_upload_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $wp_remote_media_upload_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $wp_remote_media_upload_admin, 'wp_media_upload_admin_menu' );
		$this->loader->add_filter( 'plugin_action_links_' . WP_REMOTE_MEDIA_UPLOAD_PLUGIN_BASENAME, $wp_remote_media_upload_admin, 'wp_media_upload_settings_link' );
        $this->loader->add_action( 'wp_ajax_wp_media_upload_form_response', $wp_remote_media_upload_admin, 'wp_media_upload_form_response');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new WP_Remote_Media_Upload_Public( $this->get_wp_remote_media_upload(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_wp_remote_media_upload() {
		return $this->wp_remote_media_upload;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WP_Remote_Media_Upload_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
