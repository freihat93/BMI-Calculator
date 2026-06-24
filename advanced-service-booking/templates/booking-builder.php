<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="asb-booking-wrapper">
    <div class="asb-tabs-nav">
        <?php foreach ( $tabs as $tab ) : ?>
            <button class="asb-tab-trigger" data-id="<?php echo $tab->id; ?>"><?php echo esc_html( $tab->title ); ?></button>
        <?php endforeach; ?>
    </div>
    <div class="asb-builder-container">
        <div class="asb-main-content">
            <div id="asb-services-load">Select a service to begin.</div>
            <form id="asb-main-form">
                <input type="text" name="full_name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="asb-sidebar">
            <h3>Summary</h3>
            <div id="asb-summary"></div>
        </div>
    </div>
</div>
