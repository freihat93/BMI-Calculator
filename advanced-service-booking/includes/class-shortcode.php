<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Shortcode {
    public function render( $atts ) {
        global $wpdb;
        $tabs = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}asb_service_tabs WHERE status = 'active' ORDER BY sort_order ASC" );

        ob_start();
        include ASB_PATH . 'templates/booking-builder.php';
        return ob_get_clean();
    }
}
