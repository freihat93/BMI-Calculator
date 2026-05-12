<?php
class ASB_Ajax {
	public function get_services() {
		check_ajax_referer('asb_nonce', 'nonce');
		$tab_id = intval($_POST['tab_id']);
        global $wpdb;

        $packages = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_packages WHERE service_tab_id = %d AND status = 'active'", $tab_id));
        $groups = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_service_groups WHERE service_tab_id = %d ORDER BY sort_order ASC", $tab_id));

        ob_start();
        ?>
        <div class="asb-services-grid">
            <?php if($packages): ?>
                <div class="asb-section">
                    <h4>Packages</h4>
                    <div class="asb-packages">
                        <?php foreach($packages as $pkg): ?>
                            <div class="asb-package" data-id="<?php echo $pkg->id; ?>" data-price="<?php echo $pkg->price; ?>">
                                <h3><?php echo esc_html($pkg->title); ?></h3>
                                <p><?php echo esc_html($pkg->description); ?></p>
                                <span>$<?php echo $pkg->price; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php foreach($groups as $group): ?>
                <div class="asb-group">
                    <h4><?php echo esc_html($group->title); ?></h4>
                    <?php
                    $cats = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_categories WHERE group_id = %d ORDER BY sort_order ASC", $group->id));
                    foreach($cats as $cat):
                    ?>
                        <div class="asb-category">
                            <h5><?php echo esc_html($cat->title); ?></h5>
                            <?php
                            $subs = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_sub_services WHERE category_id = %d ORDER BY sort_order ASC", $cat->id));
                            foreach($subs as $sub):
                            ?>
                                <div class="asb-sub-service" data-id="<?php echo $sub->id; ?>" data-price="<?php echo $sub->price; ?>">
                                    <label>
                                        <input type="<?php echo $sub->type === 'quantity' ? 'number' : 'checkbox'; ?>"
                                               class="asb-service-input"
                                               value="<?php echo $sub->type === 'quantity' ? 0 : 1; ?>"
                                               min="0">
                                        <?php echo esc_html($sub->title); ?> (+$<?php echo $sub->price; ?>)
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        $html = ob_get_clean();
		wp_send_json_success(['html' => $html]);
	}

	public function submit_request() {
		check_ajax_referer('asb_nonce', 'nonce');
		global $wpdb;
		$wpdb->insert($wpdb->prefix.'asb_requests', [
			'full_name' => sanitize_text_field($_POST['full_name']),
			'email' => sanitize_email($_POST['email']),
			'notes' => sanitize_textarea_field($_POST['notes']),
			'button_type' => sanitize_text_field($_POST['button_type']),
			'total_price' => floatval($_POST['total_price']),
            'status' => 'pending'
		]);
        $request_id = $wpdb->insert_id;

        // Handle items if sent
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            foreach($_POST['items'] as $item) {
                $wpdb->insert($wpdb->prefix.'asb_request_items', [
                    'request_id' => $request_id,
                    'item_title' => sanitize_text_field($item['title']),
                    'price' => floatval($item['price']),
                    'quantity' => intval($item['qty'] ?? 1)
                ]);
            }
        }

		wp_send_json_success(['message' => 'Thank you! Your request has been submitted successfully.']);
	}
}
