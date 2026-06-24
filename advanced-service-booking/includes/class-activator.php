<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Activator {
    public static function activate() {
        require_once ASB_PATH . 'includes/class-asb-database.php';
        ASB_Database::create_tables();

        // Set default settings
        if ( ! get_option( 'asb_settings' ) ) {
            update_option( 'asb_settings', [
                'hide_prices_globally'  => 'no',
                'auto_discount_enabled' => 'yes',
                'auto_discount_value'   => 10,
            ]);
        }
    }
}
