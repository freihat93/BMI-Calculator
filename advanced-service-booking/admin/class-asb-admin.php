<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Admin {
    public function add_menu() {
        add_menu_page(
            'Service Booking',
            'Service Booking',
            'manage_options',
            'asb-dashboard',
            [ $this, 'display_dashboard' ],
            'dashicons-calendar-alt',
            25
        );

        add_submenu_page( 'asb-dashboard', 'Dashboard', 'Dashboard', 'manage_options', 'asb-dashboard', [ $this, 'display_dashboard' ] );
        add_submenu_page( 'asb-dashboard', 'Service Tabs', 'Service Tabs', 'manage_options', 'asb-service-tabs', [ $this, 'display_tabs' ] );
        add_submenu_page( 'asb-dashboard', 'Packages', 'Packages', 'manage_options', 'asb-packages', [ $this, 'display_packages' ] );
        add_submenu_page( 'asb-dashboard', 'Groups & Cats', 'Groups & Cats', 'manage_options', 'asb-groups', [ $this, 'display_groups' ] );
        add_submenu_page( 'asb-dashboard', 'Sub Services', 'Sub Services', 'manage_options', 'asb-subs', [ $this, 'display_subs' ] );
        add_submenu_page( 'asb-dashboard', 'Orders', 'Orders', 'manage_options', 'asb-orders', [ $this, 'display_orders' ] );
        add_submenu_page( 'asb-dashboard', 'Settings', 'Settings', 'manage_options', 'asb-settings', [ $this, 'display_settings' ] );
    }

    public function enqueue_assets( $hook ) {
        if ( strpos( $hook, 'asb-' ) === false ) return;
        wp_enqueue_style( 'asb-admin-style', ASB_URL . 'admin/css/admin.css', [], ASB_VERSION );
    }

    public function display_dashboard() { include ASB_PATH . 'admin/partials/dashboard.php'; }
    public function display_tabs() { include ASB_PATH . 'admin/partials/tabs.php'; }
    public function display_packages() { include ASB_PATH . 'admin/partials/packages.php'; }
    public function display_groups() { include ASB_PATH . 'admin/partials/groups.php'; }
    public function display_subs() { include ASB_PATH . 'admin/partials/subs.php'; }
    public function display_orders() { include ASB_PATH . 'admin/partials/orders.php'; }
    public function display_settings() { include ASB_PATH . 'admin/partials/settings.php'; }
}
