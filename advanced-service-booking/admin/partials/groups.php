<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
$table_groups = $wpdb->prefix . 'asb_service_groups';
$table_cats = $wpdb->prefix . 'asb_categories';
$table_tabs = $wpdb->prefix . 'asb_service_tabs';

if ( isset( $_POST['asb_save_group'] ) && check_admin_referer( 'asb_save_group_nonce' ) ) {
    $wpdb->insert( $table_groups, [
        'service_tab_id' => intval($_POST['service_tab_id']),
        'title' => sanitize_text_field($_POST['title']),
        'sort_order' => intval($_POST['sort_order'])
    ]);
}

if ( isset( $_POST['asb_save_cat'] ) && check_admin_referer( 'asb_save_cat_nonce' ) ) {
    $wpdb->insert( $table_cats, [
        'group_id' => intval($_POST['group_id']),
        'title' => sanitize_text_field($_POST['title']),
        'sort_order' => intval($_POST['sort_order'])
    ]);
}

$tabs = $wpdb->get_results("SELECT id, title FROM $table_tabs");
$groups = $wpdb->get_results("SELECT g.*, t.title as tab_title FROM $table_groups g JOIN $table_tabs t ON g.service_tab_id = t.id");
$cats = $wpdb->get_results("SELECT c.*, g.title as group_title FROM $table_cats c JOIN $table_groups g ON c.group_id = g.id");
?>
<div class="wrap">
    <h1>Groups & Categories</h1>
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1; background: #fff; padding: 20px; border: 1px solid #ccd0d4;">
            <h3>Add Group</h3>
            <form method="post">
                <?php wp_nonce_field('asb_save_group_nonce'); ?>
                <p><label>Service Tab</label><br><select name="service_tab_id"><?php foreach($tabs as $t) echo "<option value='{$t->id}'>{$t->title}</option>"; ?></select></p>
                <p><label>Group Title</label><br><input type="text" name="title" required class="large-text"></p>
                <p><label>Sort Order</label><br><input type="number" name="sort_order" value="0"></p>
                <input type="submit" name="asb_save_group" class="button" value="Save Group">
            </form>
            <hr>
            <h3>Add Category</h3>
            <form method="post">
                <?php wp_nonce_field('asb_save_cat_nonce'); ?>
                <p><label>Group</label><br><select name="group_id"><?php foreach($groups as $g) echo "<option value='{$g->id}'>{$g->title}</option>"; ?></select></p>
                <p><label>Category Title</label><br><input type="text" name="title" required class="large-text"></p>
                <p><label>Sort Order</label><br><input type="number" name="sort_order" value="0"></p>
                <input type="submit" name="asb_save_cat" class="button" value="Save Category">
            </form>
        </div>
        <div style="flex: 2;">
            <h3>Groups</h3>
            <table class="wp-list-table widefat fixed striped">
                <thead><tr><th>Title</th><th>Tab</th></tr></thead>
                <tbody>
                    <?php foreach($groups as $g): ?><tr><td><?php echo esc_html($g->title); ?></td><td><?php echo esc_html($g->tab_title); ?></td></tr><?php endforeach; ?>
                </tbody>
            </table>
            <h3>Categories</h3>
            <table class="wp-list-table widefat fixed striped">
                <thead><tr><th>Title</th><th>Group</th></tr></thead>
                <tbody>
                    <?php foreach($cats as $c): ?><tr><td><?php echo esc_html($c->title); ?></td><td><?php echo esc_html($c->group_title); ?></td></tr><?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
