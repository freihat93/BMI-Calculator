<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$table_name = $wpdb->prefix . 'asb_service_tabs';

if ( isset( $_POST['asb_save_tab'] ) && check_admin_referer( 'asb_save_tab_nonce' ) ) {
    $data = [
        'title'       => sanitize_text_field( $_POST['title'] ),
        'icon'        => sanitize_text_field( $_POST['icon'] ),
        'description' => sanitize_textarea_field( $_POST['description'] ),
        'badge'       => sanitize_text_field( $_POST['badge'] ),
        'sort_order'  => intval( $_POST['sort_order'] ),
        'status'      => sanitize_text_field( $_POST['status'] ),
    ];
    $wpdb->insert( $table_name, $data );
}

$tabs = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY sort_order ASC" );
?>
<div class="wrap">
    <h1>Service Tabs</h1>
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1; background: #fff; padding: 20px; border: 1px solid #ccd0d4;">
            <h3>Add New Tab</h3>
            <form method="post">
                <?php wp_nonce_field( 'asb_save_tab_nonce' ); ?>
                <p><label>Title</label><br><input type="text" name="title" required class="large-text"></p>
                <p><label>Icon (Dashicon name)</label><br><input type="text" name="icon" class="large-text"></p>
                <p><label>Description</label><br><textarea name="description" class="large-text"></textarea></p>
                <p><label>Badge</label><br><input type="text" name="badge" class="regular-text"></p>
                <p><label>Sort Order</label><br><input type="number" name="sort_order" value="0"></p>
                <p><label>Status</label><br>
                    <select name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </p>
                <input type="submit" name="asb_save_tab" class="button button-primary" value="Save Tab">
            </form>
        </div>
        <div style="flex: 2;">
            <table class="wp-list-table widefat fixed striped">
                <thead><tr><th>Title</th><th>Order</th><th>Status</th></tr></thead>
                <tbody>
                    <?php foreach($tabs as $tab): ?>
                    <tr><td><?php echo esc_html($tab->title); ?></td><td><?php echo $tab->sort_order; ?></td><td><?php echo $tab->status; ?></td></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
