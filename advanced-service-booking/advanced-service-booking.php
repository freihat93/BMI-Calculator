<?php
/**
 * Plugin Name:       Advanced Service Booking & Quotation Builder
 * Plugin URI:        https://example.com/plugins/advanced-service-booking/
 * Description:       A premium SaaS-style service quotation and booking builder for WordPress.
 * Version:           1.1.0
 * Author:            Jules
 * Author URI:        https://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       advanced-service-booking
 * Domain Path:       /languages
 * Requires PHP:      8.0
 * Requires at least: 5.8
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'ASB_VERSION', '1.1.0' );
define( 'ASB_PATH', plugin_dir_path( __FILE__ ) );
define( 'ASB_URL', plugin_dir_url( __FILE__ ) );
define( 'ASB_BASENAME', plugin_basename( __FILE__ ) );

function activate_asb() {
	require_once ASB_PATH . 'includes/class-activator.php';
	ASB_Activator::activate();
}

function deactivate_asb() {
	require_once ASB_PATH . 'includes/class-deactivator.php';
	ASB_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_asb' );
register_deactivation_hook( __FILE__, 'deactivate_asb' );

require_once ASB_PATH . 'includes/class-plugin.php';

function asb_init() {
    $plugin = ASB_Plugin::get_instance();
    $plugin->run();
}
add_action( 'plugins_loaded', 'asb_init' );
