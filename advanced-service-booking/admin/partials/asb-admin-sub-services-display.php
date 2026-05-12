<?php
global $wpdb;
$table_subs = $wpdb->prefix . 'asb_sub_services';
$table_cats = $wpdb->prefix . 'asb_categories';

if ( isset( $_POST['asb_save_sub'] ) && check_admin_referer( 'asb_save_sub_nonce' ) ) {
    $wpdb->insert( $table_subs, [
        'category_id' => intval($_POST['category_id']),
        'title' => sanitize_text_field($_POST['title']),
        'type' => sanitize_text_field($_POST['type']),
        'price' => floatval($_POST['price'])
    ]);
}

$cats = $wpdb->get_results("SELECT id, title FROM $table_cats");
?>
<div class="wrap">
    <h1>Sub Services</h1>
    <div style="background: #fff; padding: 20px; max-width: 500px;">
        <form method="post">
            <?php wp_nonce_field('asb_save_sub_nonce'); ?>
            <p><select name="category_id"><?php foreach($cats as $c) echo "<option value='{$c->id}'>{$c->title}</option>"; ?></select></p>
            <p><input type="text" name="title" placeholder="Service Title" required class="large-text"></p>
            <p><select name="type"><option value="checkbox">Checkbox</option><option value="quantity">Quantity</option></select></p>
            <p><input type="number" step="0.01" name="price" placeholder="Price" required></p>
            <input type="submit" name="asb_save_sub" value="Save Sub Service">
        </form>
    </div>
</div>
