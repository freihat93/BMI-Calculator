<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( isset( $_POST['asb_save_settings'] ) && check_admin_referer( 'asb_save_settings_nonce' ) ) {
    $settings = [
        'hide_prices_globally'  => sanitize_text_field( $_POST['hide_prices_globally'] ),
        'auto_discount_enabled' => sanitize_text_field( $_POST['auto_discount_enabled'] ),
        'auto_discount_value'   => floatval( $_POST['auto_discount_value'] ),
    ];
    update_option( 'asb_settings', $settings );
    echo '<div class="updated"><p>Settings saved!</p></div>';
}

$settings = get_option( 'asb_settings', [] );
?>
<div class="wrap">
    <h1>Settings</h1>
    <form method="post">
        <?php wp_nonce_field( 'asb_save_settings_nonce' ); ?>
        <table class="form-table">
            <tr>
                <th>Hide Prices Globally</th>
                <td><select name="hide_prices_globally"><option value="no" <?php selected($settings['hide_prices_globally'] ?? 'no', 'no'); ?>>No</option><option value="yes" <?php selected($settings['hide_prices_globally'] ?? 'no', 'yes'); ?>>Yes</option></select></td>
            </tr>
            <tr>
                <th>Enable Auto Discount</th>
                <td><select name="auto_discount_enabled"><option value="yes" <?php selected($settings['auto_discount_enabled'] ?? 'yes', 'yes'); ?>>Yes</option><option value="no" <?php selected($settings['auto_discount_enabled'] ?? 'yes', 'no'); ?>>No</option></select></td>
            </tr>
            <tr>
                <th>Discount Value (%)</th>
                <td><input type="number" name="auto_discount_value" value="<?php echo esc_attr($settings['auto_discount_value'] ?? 10); ?>"></td>
            </tr>
        </table>
        <input type="submit" name="asb_save_settings" class="button button-primary" value="Save Settings">
    </form>
</div>
