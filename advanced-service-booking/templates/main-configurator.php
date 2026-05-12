<?php
/**
 * Main Configurator Template
 */
global $wpdb;
$tabs = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}asb_service_tabs WHERE status = 'active'");
?>
<div class="asb-wrapper">
    <div class="asb-tabs">
        <?php foreach($tabs as $tab): ?>
            <div class="asb-tab" data-id="<?php echo $tab->id; ?>"><?php echo esc_html($tab->title); ?></div>
        <?php endforeach; ?>
    </div>
    <div class="asb-container">
        <div class="asb-main">
            <div id="asb-services-container">Select a tab to see services.</div>
            <form id="asb-form" class="asb-form">
                <input type="hidden" name="button_type" value="quote">
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="notes" placeholder="Notes"></textarea>
                <button type="submit">Submit Request</button>
            </form>
        </div>
        <div class="asb-sidebar">
            <div id="asb-summary-content">Your selections will appear here.</div>
        </div>
    </div>
</div>
