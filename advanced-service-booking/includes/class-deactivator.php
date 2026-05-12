<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Deactivator {
    public static function deactivate() {
        // No heavy tasks for now
        flush_rewrite_rules();
    }
}
