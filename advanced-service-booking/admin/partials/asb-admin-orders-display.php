<?php
global $wpdb;
$orders = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}asb_requests ORDER BY created_at DESC");
?>
<div class="wrap">
    <h1>Orders / Quotation Requests</h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $o): ?>
            <tr>
                <td><?php echo $o->id; ?></td>
                <td><?php echo esc_html($o->full_name); ?></td>
                <td><?php echo esc_html($o->email); ?></td>
                <td>$<?php echo $o->total_price; ?></td>
                <td><?php echo esc_html($o->status); ?></td>
                <td><?php echo $o->created_at; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
