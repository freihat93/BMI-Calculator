<?php
global $wpdb;
$settings = get_option('asb_settings');
if ( isset( $_POST['asb_save_settings'] ) && check_admin_referer('asb_save_settings_nonce') ) {
    $settings['auto_discount_value'] = floatval($_POST['auto_discount_value']);
    update_option('asb_settings', $settings);
}
?>
<div class="wrap">
    <h1>Settings</h1>
    <form method="post">
        <?php wp_nonce_field('asb_save_settings_nonce'); ?>
        <p><label>Auto Discount (%)</label><br><input type="number" name="auto_discount_value" value="<?php echo $settings['auto_discount_value'] ?? 10; ?>"></p>
        <input type="submit" name="asb_save_settings" value="Save Settings">
    </form>
</div>
