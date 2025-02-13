<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://echealthcare.com/
 * @since      1.0.0
 *
 * @package    Ech_Privacy_Policy_Content_Crawler
 * @subpackage Ech_Privacy_Policy_Content_Crawler/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ech_Privacy_Policy_Content_Crawler
 * @subpackage Ech_Privacy_Policy_Content_Crawler/public
 * @author     Toby Wong <tobywong@prohaba.com>
 */
class Ech_Privacy_Policy_Content_Crawler_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ech-privacy-policy-content-crawler-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ech-privacy-policy-content-crawler-public.js', array( 'jquery' ), $this->version, false );

	}

	public function ech_get_privacy_policy_content_func() {
		$output = '';
		$api_link = get_option('ech_pp_api_link');
		if (empty($api_link)) {
			$output .= '<p style="color:red">API Link cannot be empty.</p>';
			return $output;
		}

		$get_content_json = $this->ECHPPCC_wp_remote_get_privacy_policy_content_json($api_link);
		$json_arr = json_decode($get_content_json, true);


		if (($json_arr['data']['status'] ?? null) === 401) {
			$output .= '<p style="color:red">Settings are incorrect.</p>';
			return $output;
		}

		$output .= '<div class="privacy_policy_container">';
			$output .= $this->ECHPPCC_echolang([ $json_arr['content_en'], $json_arr['content_zh'], $json_arr['content_sc'] ]);
		$output .= '</div>';

		return $output;
	}

	public function ECHPPCC_wp_remote_get_privacy_policy_content_json($api_link)
    {
        $getBearerToken = get_option('ech_pp_bearer_token');
        $api_headers = array(
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $getBearerToken,
        );

        $response = wp_remote_get($api_link, array(
            'headers' => $api_headers,
        ));

        if (is_wp_error($response)) {
            return 'Error: ' . $response->get_error_message();
        }

        $result = wp_remote_retrieve_body($response);

        return $result;
    }


	/****************************************
     * DISPLAY SPECIFIC LANGUAGE
     ****************************************/
    public function ECHPPCC_echolang($stringArr)
    {
        global $TRP_LANGUAGE;

        switch ($TRP_LANGUAGE) {
            case 'zh_HK':
                $langString = $stringArr[1];
                break;
            case 'zh_CN':
                $langString = $stringArr[2];
                break;
            default:
                $langString = $stringArr[0];
        }

        if (empty($langString) || $langString == '' || $langString == null) {
            $langString = $stringArr[1]; //zh_HK
        }

        return $langString;
    }
    /********** (END)DISPLAY SPECIFIC LANGUAGE **********/

}
