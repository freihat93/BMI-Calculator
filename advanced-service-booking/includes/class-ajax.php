<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Ajax {
    public function get_services() {
        check_ajax_referer( 'asb_nonce', 'nonce' );

        $tab_id = isset( $_POST['tab_id'] ) ? intval( $_POST['tab_id'] ) : 0;
        global $wpdb;

        $packages = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}asb_packages WHERE service_tab_id = %d AND status = 'active'", $tab_id ) );
        $groups = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}asb_service_groups WHERE service_tab_id = %d ORDER BY sort_order ASC", $tab_id ) );

        ob_start();
        include ASB_PATH . 'templates/services-list.php';
        $html = ob_get_clean();

        wp_send_json_success( [ 'html' => $html ] );
    }

    public function submit_request() {
        check_ajax_referer( 'asb_nonce', 'nonce' );

        global $wpdb;
        $data = [
            'full_name' => sanitize_text_field( $_POST['full_name'] ),
            'email'     => sanitize_email( $_POST['email'] ),
            'notes'     => sanitize_textarea_field( $_POST['notes'] ),
            'button_type' => sanitize_text_field( $_POST['button_type'] ),
            'total_price' => floatval( $_POST['total_price'] )
        ];

        $inserted = $wpdb->insert( $wpdb->prefix . 'asb_requests', $data );

        if ( ! $inserted ) {
            error_log( "ASB Error: Failed to insert request. " . $wpdb->last_error );
            wp_send_json_error( [ 'message' => 'Database error.' ] );
        }

        wp_send_json_success( [ 'message' => 'Request submitted!' ] );
    }
}
