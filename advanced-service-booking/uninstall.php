<?php
/**
 * Fired when the plugin is uninstalled.
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

$tables = [
    'asb_service_tabs',
    'asb_packages',
    'asb_service_groups',
    'asb_categories',
    'asb_sub_services',
    'asb_requests',
    'asb_request_items'
];

foreach ( $tables as $table ) {
    $wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . $table );
}

delete_option( 'asb_settings' );
