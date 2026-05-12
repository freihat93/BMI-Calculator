<?php
/**
 * The plugin bootstrap file
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'ASB_VERSION', '1.0.0' );
define( 'ASB_PATH', plugin_dir_path( __FILE__ ) );
define( 'ASB_URL', plugin_dir_url( __FILE__ ) );

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
