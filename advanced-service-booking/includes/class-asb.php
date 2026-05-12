<?php
class ASB {
	protected $loader;
	public function __construct() {
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}
	private function load_dependencies() {
		require_once ASB_PATH . 'includes/class-asb-loader.php';
		require_once ASB_PATH . 'admin/class-asb-admin.php';
		require_once ASB_PATH . 'public/class-asb-public.php';
		require_once ASB_PATH . 'includes/class-asb-ajax.php';
		require_once ASB_PATH . 'includes/class-asb-shortcode.php';
		$this->loader = new ASB_Loader();
	}
	private function define_admin_hooks() {
		$admin = new ASB_Admin();
		$this->loader->add_action('admin_menu', $admin, 'add_plugin_admin_menu');
	}
	private function define_public_hooks() {
		$public = new ASB_Public();
		$this->loader->add_action('wp_enqueue_scripts', $public, 'enqueue_assets');
		$ajax = new ASB_Ajax();
		$this->loader->add_action('wp_ajax_asb_get_services', $ajax, 'get_services');
		$this->loader->add_action('wp_ajax_nopriv_asb_get_services', $ajax, 'get_services');
		$this->loader->add_action('wp_ajax_asb_submit_request', $ajax, 'submit_request');
		$this->loader->add_action('wp_ajax_nopriv_asb_submit_request', $ajax, 'submit_request');
		$shortcode = new ASB_Shortcode();
		$this->loader->add_shortcode('advanced_service_booking', $shortcode, 'render');
	}
	public function run() { $this->loader->run(); }
}
