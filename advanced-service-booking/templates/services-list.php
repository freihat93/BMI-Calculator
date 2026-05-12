<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $wpdb;
// $packages and $groups are passed from AJAX handler
?>
<div class="asb-services-container">
    <?php if ( $packages ) : ?>
        <section class="asb-section">
            <h4>Select a Package</h4>
            <div class="asb-packages-grid">
                <?php foreach ( $packages as $pkg ) : ?>
                    <div class="asb-package-item" data-id="<?php echo $pkg->id; ?>" data-price="<?php echo $pkg->price; ?>">
                        <h4><?php echo esc_html( $pkg->title ); ?></h4>
                        <p><?php echo esc_html( $pkg->description ); ?></p>
                        <div class="asb-price">$<?php echo number_format( $pkg->price, 2 ); ?></div>
                        <button type="button" class="asb-add-pkg">Select</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php foreach ( $groups as $group ) : ?>
        <section class="asb-section asb-group">
            <h4><?php echo esc_html( $group->title ); ?></h4>
            <?php
            $cats = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}asb_categories WHERE group_id = %d ORDER BY sort_order ASC", $group->id ) );
            foreach ( $cats as $cat ) :
            ?>
                <div class="asb-category">
                    <h5><?php echo esc_html( $cat->title ); ?></h5>
                    <div class="asb-subs-list">
                        <?php
                        $subs = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}asb_sub_services WHERE category_id = %d ORDER BY sort_order ASC", $cat->id ) );
                        foreach ( $subs as $sub ) :
                        ?>
                            <div class="asb-sub-item" data-id="<?php echo $sub->id; ?>" data-price="<?php echo $sub->price; ?>" data-title="<?php echo esc_attr($sub->title); ?>">
                                <div class="asb-sub-info">
                                    <span><?php echo esc_html( $sub->title ); ?></span>
                                    <span>+$<?php echo number_format( $sub->price, 2 ); ?></span>
                                </div>
                                <div class="asb-sub-action">
                                    <?php if ( $sub->type === 'quantity' ) : ?>
                                        <input type="number" class="asb-service-qty" value="0" min="0" step="1">
                                    <?php else : ?>
                                        <input type="checkbox" class="asb-service-check">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>
</div>
