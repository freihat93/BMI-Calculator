<?php
class ASB_Ajax {
	public function get_services() {
		check_ajax_referer('asb_nonce', 'nonce');
		$tab_id = intval($_POST['tab_id']);
        global $wpdb;
        $packages = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_packages WHERE service_tab_id = %d AND status = 'active'", $tab_id));

        $html = '<div class="asb-packages">';
        foreach($packages as $pkg) {
            $html .= '<div class="asb-package" data-id="'.$pkg->id.'" data-price="'.$pkg->price.'"><h3>'.esc_html($pkg->title).'</h3><p>'.esc_html($pkg->description).'</p><span>$'.$pkg->price.'</span></div>';
        }
        $html .= '</div>';

		wp_send_json_success(['html' => $html]);
	}
	public function submit_request() {
		check_ajax_referer('asb_nonce', 'nonce');
		global $wpdb;
		$wpdb->insert($wpdb->prefix.'asb_requests', [
			'full_name' => sanitize_text_field($_POST['full_name']),
			'email' => sanitize_email($_POST['email']),
			'notes' => sanitize_textarea_field($_POST['notes']),
			'button_type' => sanitize_text_field($_POST['button_type']),
			'total_price' => floatval($_POST['total_price'])
		]);
        $request_id = $wpdb->insert_id;
        // require_once ASB_PATH . 'includes/class-asb-emails.php';
        // ASB_Emails::send_quotation($request_id);
		wp_send_json_success(['message' => 'Request submitted!']);
	}
}
