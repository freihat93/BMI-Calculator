<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Public {
    public function enqueue_assets() {
        wp_enqueue_style( 'asb-public-style', ASB_URL . 'public/css/style.css', [], ASB_VERSION );
        wp_enqueue_script( 'asb-public-script', ASB_URL . 'public/js/script.js', [ 'jquery' ], ASB_VERSION, true );

        wp_localize_script( 'asb-public-script', 'asb_vars', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'asb_nonce' )
        ]);
    }
}
