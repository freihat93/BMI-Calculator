<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$table_subs = $wpdb->prefix . 'asb_sub_services';
$table_cats = $wpdb->prefix . 'asb_categories';

if ( isset( $_POST['asb_save_sub'] ) && check_admin_referer( 'asb_save_sub_nonce' ) ) {
    $wpdb->insert( $table_subs, [
        'category_id' => intval($_POST['category_id']),
        'title' => sanitize_text_field($_POST['title']),
        'type' => sanitize_text_field($_POST['type']),
        'price' => floatval($_POST['price']),
        'sort_order' => intval($_POST['sort_order'])
    ]);
}

$cats = $wpdb->get_results("SELECT id, title FROM $table_cats");
$subs = $wpdb->get_results("SELECT s.*, c.title as cat_title FROM $table_subs s JOIN $table_cats c ON s.category_id = c.id");
?>
<div class="wrap">
    <h1>Sub Services</h1>
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1; background: #fff; padding: 20px; border: 1px solid #ccd0d4;">
            <form method="post">
                <?php wp_nonce_field('asb_save_sub_nonce'); ?>
                <p><label>Category</label><br><select name="category_id"><?php foreach($cats as $c) echo "<option value='{$c->id}'>{$c->title}</option>"; ?></select></p>
                <p><label>Title</label><br><input type="text" name="title" required class="large-text"></p>
                <p><label>Type</label><br><select name="type"><option value="checkbox">Checkbox</option><option value="quantity">Quantity</option></select></p>
                <p><label>Price</label><br><input type="number" step="0.01" name="price" required></p>
                <p><label>Sort Order</label><br><input type="number" name="sort_order" value="0"></p>
                <input type="submit" name="asb_save_sub" class="button button-primary" value="Save Sub Service">
            </form>
        </div>
        <div style="flex: 2;">
            <table class="wp-list-table widefat fixed striped">
                <thead><tr><th>Title</th><th>Category</th><th>Price</th></tr></thead>
                <tbody>
                    <?php foreach($subs as $s): ?><tr><td><?php echo esc_html($s->title); ?></td><td><?php echo esc_html($s->cat_title); ?></td><td>$<?php echo $s->price; ?></td></tr><?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
