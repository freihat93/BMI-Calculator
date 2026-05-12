<?php
/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       Advanced Service Booking & Quotation Builder
 * Plugin URI:        https://example.com/plugins/advanced-service-booking/
 * Description:       A premium SaaS-style service quotation and booking builder for WordPress.
 * Version:           1.0.0
 * Author:            Jules
 * Author URI:        https://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       advanced-service-booking
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'ASB_VERSION', '1.0.0' );
define( 'ASB_PATH', plugin_dir_path( __FILE__ ) );
define( 'ASB_URL', plugin_dir_url( __FILE__ ) );

// Load Composer Autoloader
if ( file_exists( ASB_PATH . 'vendor/autoload.php' ) ) {
    require_once ASB_PATH . 'vendor/autoload.php';
}

function activate_asb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-asb-activator.php';
	ASB_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_asb' );

require plugin_dir_path( __FILE__ ) . 'includes/class-asb.php';

function run_asb() {
	$plugin = new ASB();
	$plugin->run();
}
run_asb();
