<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://echealthcare.com/
 * @since      1.0.0
 *
 * @package    Ech_Privacy_Policy_Content_Crawler
 * @subpackage Ech_Privacy_Policy_Content_Crawler/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ech_Privacy_Policy_Content_Crawler
 * @subpackage Ech_Privacy_Policy_Content_Crawler/includes
 * @author     Toby Wong <tobywong@prohaba.com>
 */
class Ech_Privacy_Policy_Content_Crawler_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ech-privacy-policy-content-crawler',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
