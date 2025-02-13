<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://echealthcare.com/
 * @since      1.0.0
 *
 * @package    Ech_Privacy_Policy_Content_Crawler
 * @subpackage Ech_Privacy_Policy_Content_Crawler/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ech_Privacy_Policy_Content_Crawler
 * @subpackage Ech_Privacy_Policy_Content_Crawler/admin
 * @author     Toby Wong <tobywong@prohaba.com>
 */
class Ech_Privacy_Policy_Content_Crawler_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ech_Privacy_Policy_Content_Crawler_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ech_Privacy_Policy_Content_Crawler_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ech-privacy-policy-content-crawler-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// Apply below files only in this plugin admin page
        if(isset($_GET['page']) && $_GET['page'] == 'reg_ech_privacy_policy_settings') {

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ech-privacy-policy-content-crawler-admin.js', array( 'jquery' ), $this->version, false );
		}
	}


	public function ech_privacy_policy_admin_menu()
    {
        add_menu_page('ECH Privacy Policy Settings', 'ECH Privacy Policy', 'manage_options', 'reg_ech_privacy_policy_settings', array($this, 'ech_privacy_policy_admin_page'), 'dashicons-privacy', 110);
    }
    // return view
    public function ech_privacy_policy_admin_page()
    {
        require_once('partials/ech-privacy-policy-content-crawler-admin-display.php');
    }


	public function reg_ech_privacy_policy_settings() {
		// Register all settings for general setting page
		register_setting('ech_pp_gen_settings', 'ech_pp_bearer_token');
		register_setting('ech_pp_gen_settings', 'ech_pp_api_link');
	}


}
