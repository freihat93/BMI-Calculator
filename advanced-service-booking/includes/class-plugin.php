<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Plugin {
    private static $instance = null;

    public static function get_instance() {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->load_dependencies();
        $this->init_hooks();
    }

    private function load_dependencies() {
        require_once ASB_PATH . 'admin/class-asb-admin.php';
        require_once ASB_PATH . 'public/class-asb-public.php';
        require_once ASB_PATH . 'includes/class-ajax.php';
        require_once ASB_PATH . 'includes/class-shortcode.php';

        if ( did_action( 'elementor/loaded' ) ) {
            require_once ASB_PATH . 'includes/class-elementor-widget.php';
        }
    }

    private function init_hooks() {
        $admin = new ASB_Admin();
        add_action( 'admin_menu', [ $admin, 'add_menu' ] );
        add_action( 'admin_enqueue_scripts', [ $admin, 'enqueue_assets' ] );

        $public = new ASB_Public();
        add_action( 'wp_enqueue_scripts', [ $public, 'enqueue_assets' ] );

        $ajax = new ASB_Ajax();
        add_action( 'wp_ajax_asb_get_services', [ $ajax, 'get_services' ] );
        add_action( 'wp_ajax_nopriv_asb_get_services', [ $ajax, 'get_services' ] );
        add_action( 'wp_ajax_asb_submit_request', [ $ajax, 'submit_request' ] );
        add_action( 'wp_ajax_nopriv_asb_submit_request', [ $ajax, 'submit_request' ] );

        $shortcode = new ASB_Shortcode();
        add_shortcode( 'advanced_service_booking', [ $shortcode, 'render' ] );

        if ( did_action( 'elementor/loaded' ) ) {
            add_action( 'elementor/widgets/register', [ $this, 'register_elementor_widget' ] );
        }
    }

    public function register_elementor_widget( $widgets_manager ) {
        $widgets_manager->register( new ASB_Elementor_Widget() );
    }

    public function run() {}
}
