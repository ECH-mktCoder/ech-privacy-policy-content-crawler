<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://echealthcare.com/
 * @since             1.0.0
 * @package           Ech_Privacy_Policy_Content_Crawler
 *
 * @wordpress-plugin
 * Plugin Name:       ECH Privacy Policy Content Crawler
 * Plugin URI:        https://echealthcare.com/
 * Description:       This plugin is used to retrieve the ECH privacy policy content via API, enabling the synchronization of the privacy policy content across all brands.
 * Version:           1.0.0
 * Author:            Toby Wong
 * Author URI:        https://echealthcare.com//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ech-privacy-policy-content-crawler
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
define( 'ECH_PRIVACY_POLICY_CONTENT_CRAWLER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ech-privacy-policy-content-crawler-activator.php
 */
function activate_ech_privacy_policy_content_crawler() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ech-privacy-policy-content-crawler-activator.php';
	Ech_Privacy_Policy_Content_Crawler_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ech-privacy-policy-content-crawler-deactivator.php
 */
function deactivate_ech_privacy_policy_content_crawler() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ech-privacy-policy-content-crawler-deactivator.php';
	Ech_Privacy_Policy_Content_Crawler_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ech_privacy_policy_content_crawler' );
register_deactivation_hook( __FILE__, 'deactivate_ech_privacy_policy_content_crawler' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ech-privacy-policy-content-crawler.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ech_privacy_policy_content_crawler() {

	$plugin = new Ech_Privacy_Policy_Content_Crawler();
	$plugin->run();

}
run_ech_privacy_policy_content_crawler();
