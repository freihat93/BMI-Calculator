<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$plugin_name = 'Advanced Service Booking & Quotation Builder';
$description = 'A premium SaaS-style service quotation and booking builder for WordPress.';
$version = ASB_VERSION;
?>
<div class="wrap">
    <h1><?php echo $plugin_name; ?> Dashboard</h1>
    <div class="welcome-panel">
        <div class="welcome-panel-content">
            <h2>Welcome to ASB v<?php echo $version; ?></h2>
            <p class="about-description"><?php echo $description; ?></p>
        </div>
    </div>

    <div class="asb-stats" style="display: flex; gap: 20px; margin-top: 20px;">
        <div class="postbox" style="flex: 1; padding: 20px;">
            <h3>Total Orders</h3>
            <p style="font-size: 2em; font-weight: bold;">
                <?php
                global $wpdb;
                echo $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}asb_requests");
                ?>
            </p>
        </div>
        <div class="postbox" style="flex: 1; padding: 20px;">
            <h3>Active Service Tabs</h3>
            <p style="font-size: 2em; font-weight: bold;">
                <?php
                echo $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}asb_service_tabs WHERE status = 'active'");
                ?>
            </p>
        </div>
    </div>
</div>
