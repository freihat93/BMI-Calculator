<?php
class ASB_Admin {
	public function add_plugin_admin_menu() {
		add_menu_page('Service Booking', 'Service Booking', 'manage_options', 'asb-dashboard', [$this, 'display_dashboard'], 'dashicons-calendar-alt', 25);
        add_submenu_page('asb-dashboard', 'Dashboard', 'Dashboard', 'manage_options', 'asb-dashboard', [$this, 'display_dashboard']);
        add_submenu_page('asb-dashboard', 'Service Tabs', 'Service Tabs', 'manage_options', 'asb-service-tabs', [$this, 'display_service_tabs']);
        add_submenu_page('asb-dashboard', 'Packages', 'Packages', 'manage_options', 'asb-packages', [$this, 'display_packages']);
        add_submenu_page('asb-dashboard', 'Groups & Categories', 'Groups', 'manage_options', 'asb-groups', [$this, 'display_groups']);
        add_submenu_page('asb-dashboard', 'Sub Services', 'Sub Services', 'manage_options', 'asb-sub-services', [$this, 'display_subs']);
        add_submenu_page('asb-dashboard', 'Orders', 'Orders', 'manage_options', 'asb-orders', [$this, 'display_orders']);
        add_submenu_page('asb-dashboard', 'Settings', 'Settings', 'manage_options', 'asb-settings', [$this, 'display_settings']);
	}
	public function display_dashboard() { include ASB_PATH . 'admin/partials/asb-admin-dashboard-display.php'; }
    public function display_service_tabs() { include ASB_PATH . 'admin/partials/asb-admin-service-tabs-display.php'; }
    public function display_packages() { include ASB_PATH . 'admin/partials/asb-admin-packages-display.php'; }
    public function display_groups() { include ASB_PATH . 'admin/partials/asb-admin-groups-categories-display.php'; }
    public function display_subs() { include ASB_PATH . 'admin/partials/asb-admin-sub-services-display.php'; }
    public function display_orders() { include ASB_PATH . 'admin/partials/asb-admin-orders-display.php'; }
    public function display_settings() { include ASB_PATH . 'admin/partials/asb-admin-settings-display.php'; }
}
