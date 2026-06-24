<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$orders = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}asb_requests ORDER BY created_at DESC LIMIT 50");
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
                <th>Type</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($orders) : foreach ($orders as $o) : ?>
                <tr>
                    <td>#<?php echo $o->id; ?></td>
                    <td><strong><?php echo esc_html($o->full_name); ?></strong></td>
                    <td><?php echo esc_html($o->email); ?></td>
                    <td>$<?php echo number_format($o->total_price, 2); ?></td>
                    <td><?php echo esc_html($o->button_type); ?></td>
                    <td><span class="status-<?php echo $o->status; ?>"><?php echo esc_html(ucfirst($o->status)); ?></span></td>
                    <td><?php echo $o->created_at; ?></td>
                </tr>
            <?php endforeach; else : ?>
                <tr><td colspan="7">No orders found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
