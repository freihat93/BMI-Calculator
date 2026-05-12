<?php
class ASB_Public {
	public function enqueue_assets() {
		wp_enqueue_style('asb-css', ASB_URL . 'public/css/style.css');
		wp_enqueue_script('asb-js', ASB_URL . 'public/js/script.js', ['jquery'], '1.0', true);
		wp_localize_script('asb-js', 'asb_vars', ['ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('asb_nonce')]);
	}
}
