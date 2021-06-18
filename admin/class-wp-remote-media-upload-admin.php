<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_Remote_Media_Upload
 * @subpackage WP_Remote_Media_Upload/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Remote_Media_Upload
 * @subpackage WP_Remote_Media_Upload/admin
 * @author     Your Name <email@example.com>
 */
class WP_Remote_Media_Upload_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp_remote_media_upload    The ID of this plugin.
	 */
	private $wp_remote_media_upload;

    /**
	 * Image Upload class variable
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp_remote_media_upload    The ID of this plugin.
	 */
	private $wp_download_remote_image;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wp_remote_media_upload       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wp_remote_media_upload, $version ) {

		$this->wp_remote_media_upload = $wp_remote_media_upload;
		$this->version = $version;
        $this->load_dependencies();
	}

    private function load_dependencies() {
		require_once plugin_dir_path( __FILE__ ) . '/partials/upload-remote-image-wordpress.php';
	}

    /**
	 * Register the hooks for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function wp_media_upload_admin_menu() {

		add_submenu_page(
            'upload.php',
            __( 'Upload Remote Media', 'wp_remote_media_upload' ),
            __( 'Remote Media', 'wp_remote_media_upload' ),
            'manage_options',
            'wprm-options',
            [$this, 'wprm_settings_page']);

	}


    /**
    * Include options screen
    *
    * XHTML screen to prompt and update settings
    *
    * @since	1.0.0
    */

    public function wprm_settings_page() {
        include_once( plugin_dir_path( __FILE__ ) . '/partials/wprm-settings-page.php' );
    }

    /**
	 * Add settings link in plugins list
	 *
	 * @since    1.0.0
	 */

    public function wp_media_upload_settings_link( $links ) {
        $settings_link = '<a href="upload.php?page=wprm-options">' . __( 'Settings' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

    /**
	 * Upload form response hook function
	 *
	 * @since    1.0.0
	 */

    public function wp_media_upload_form_response() {
        check_ajax_referer( 'wp_remote_media_upload_nonce' );
        $url = esc_url($_POST['url']);
        $attachment_id = "";
        $this->wp_download_remote_image = new WP_Download_Remote_Image($url);
        $attachment_id = $this->wp_download_remote_image->download();
        wp_send_json( $attachment_id );   
    }

    
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->wp_remote_media_upload, plugin_dir_url( __FILE__ ) . 'css/wp-remote-media-upload-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( "wp_remote_media_upload_sweatalert", plugin_dir_url( __FILE__ ) . 'js/sweetalert.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->wp_remote_media_upload, plugin_dir_url( __FILE__ ) . 'js/wp-remote-media-upload-admin.js', array( 'jquery' ), $this->version, false );

        wp_localize_script( $this->wp_remote_media_upload, 'wp_remote_media_upload_localize',
            array( 
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce('wp_remote_media_upload_nonce'),
                'action' => "wp_media_upload_form_response",
            )
        );

	}

}
