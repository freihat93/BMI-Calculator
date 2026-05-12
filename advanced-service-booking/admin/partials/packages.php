<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$table_name = $wpdb->prefix . 'asb_packages';
$tabs_table = $wpdb->prefix . 'asb_service_tabs';

if ( isset( $_POST['asb_save_package'] ) && check_admin_referer( 'asb_save_package_nonce' ) ) {
    $data = [
        'service_tab_id' => intval( $_POST['service_tab_id'] ),
        'title'          => sanitize_text_field( $_POST['title'] ),
        'price'          => floatval( $_POST['price'] ),
        'description'    => sanitize_textarea_field( $_POST['description'] ),
        'status'         => 'active',
    ];
    $wpdb->insert( $table_name, $data );
}

$packages = $wpdb->get_results( "SELECT p.*, t.title as tab_title FROM $table_name p JOIN $tabs_table t ON p.service_tab_id = t.id" );
$tabs = $wpdb->get_results( "SELECT id, title FROM $tabs_table" );
?>
<div class="wrap">
    <h1>Packages</h1>
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1; background: #fff; padding: 20px; border: 1px solid #ccd0d4;">
            <form method="post">
                <?php wp_nonce_field( 'asb_save_package_nonce' ); ?>
                <p><label>Tab</label><br><select name="service_tab_id"><?php foreach($tabs as $t) echo "<option value='{$t->id}'>{$t->title}</option>"; ?></select></p>
                <p><label>Title</label><br><input type="text" name="title" required class="large-text"></p>
                <p><label>Price</label><br><input type="number" step="0.01" name="price" required></p>
                <p><label>Description</label><br><textarea name="description" class="large-text"></textarea></p>
                <input type="submit" name="asb_save_package" class="button button-primary" value="Save Package">
            </form>
        </div>
        <div style="flex: 2;">
            <table class="wp-list-table widefat fixed striped">
                <thead><tr><th>Title</th><th>Tab</th><th>Price</th></tr></thead>
                <tbody>
                    <?php foreach($packages as $pkg): ?>
                    <tr><td><?php echo esc_html($pkg->title); ?></td><td><?php echo esc_html($pkg->tab_title); ?></td><td>$<?php echo $pkg->price; ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
