<?php
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
$groups = $wpdb->get_results("SELECT * FROM $table_groups");
?>
<div class="wrap">
    <h1>Groups & Categories</h1>
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1; background: #fff; padding: 20px;">
            <h3>Add Group</h3>
            <form method="post">
                <?php wp_nonce_field('asb_save_group_nonce'); ?>
                <p><select name="service_tab_id"><?php foreach($tabs as $t) echo "<option value='{$t->id}'>{$t->title}</option>"; ?></select></p>
                <p><input type="text" name="title" placeholder="Group Title" required></p>
                <input type="submit" name="asb_save_group" value="Save Group">
            </form>
            <hr>
            <h3>Add Category</h3>
            <form method="post">
                <?php wp_nonce_field('asb_save_cat_nonce'); ?>
                <p><select name="group_id"><?php foreach($groups as $g) echo "<option value='{$g->id}'>{$g->title}</option>"; ?></select></p>
                <p><input type="text" name="title" placeholder="Category Title" required></p>
                <input type="submit" name="asb_save_cat" value="Save Category">
            </form>
        </div>
    </div>
</div>
