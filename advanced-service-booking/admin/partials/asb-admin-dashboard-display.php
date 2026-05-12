<?php
/**
 * Dashboard template
 */
?>
<div class="wrap">
    <h1>Advanced Service Booking Dashboard</h1>
    <p>Welcome to the Service Booking & Quotation Builder. Use the menu on the left to manage your services, packages, and view orders.</p>

    <div class="asb-stats-cards" style="display: flex; gap: 20px; margin-top: 20px;">
        <div class="asb-card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); flex: 1;">
            <h3>Total Orders</h3>
            <p style="font-size: 24px; font-weight: bold;">
                <?php
                global $wpdb;
                $table_name = $wpdb->prefix . 'asb_requests';
                echo $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
                ?>
            </p>
        </div>
        <div class="asb-card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); flex: 1;">
            <h3>Active Service Tabs</h3>
            <p style="font-size: 24px; font-weight: bold;">
                <?php
                $table_name = $wpdb->prefix . 'asb_service_tabs';
                echo $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'active'");
                ?>
            </p>
        </div>
    </div>
</div>
