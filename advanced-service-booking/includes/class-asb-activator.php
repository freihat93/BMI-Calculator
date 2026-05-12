<?php
class ASB_Activator {
	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$tables = array(
			'asb_service_tabs' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, title varchar(255) NOT NULL, icon varchar(255), description text, badge varchar(255), sort_order int(11) DEFAULT 0, status varchar(20) DEFAULT 'active', created_at datetime DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))",
			'asb_packages' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, service_tab_id mediumint(9) NOT NULL, title varchar(255) NOT NULL, image_url varchar(255), icon varchar(255), description text, price decimal(10,2) DEFAULT 0.00, badge varchar(255), conditional_logic text, status varchar(20) DEFAULT 'active', created_at datetime DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))",
			'asb_service_groups' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, service_tab_id mediumint(9) NOT NULL, title varchar(255) NOT NULL, sort_order int(11) DEFAULT 0, PRIMARY KEY (id))",
			'asb_categories' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, group_id mediumint(9) NOT NULL, title varchar(255) NOT NULL, sort_order int(11) DEFAULT 0, PRIMARY KEY (id))",
			'asb_sub_services' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, category_id mediumint(9) NOT NULL, title varchar(255) NOT NULL, type varchar(20) DEFAULT 'checkbox', price decimal(10,2) DEFAULT 0.00, min_qty int(11) DEFAULT 0, max_qty int(11) DEFAULT 0, conditional_logic text, sort_order int(11) DEFAULT 0, PRIMARY KEY (id))",
			'asb_requests' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, full_name varchar(255) NOT NULL, email varchar(255) NOT NULL, phone varchar(50), company_name varchar(255), notes text, file_url varchar(255), total_price decimal(10,2) DEFAULT 0.00, discount_amount decimal(10,2) DEFAULT 0.00, button_type varchar(20), status varchar(20) DEFAULT 'pending', created_at datetime DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))",
			'asb_request_items' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, request_id mediumint(9) NOT NULL, service_tab_title varchar(255), item_type varchar(50), item_title varchar(255), quantity int(11) DEFAULT 1, price decimal(10,2) DEFAULT 0.00, PRIMARY KEY (id))",
			'asb_discounts' => "(id mediumint(9) NOT NULL AUTO_INCREMENT, title varchar(255) NOT NULL, type varchar(20) DEFAULT 'percentage', value decimal(10,2) DEFAULT 0.00, conditions text, status varchar(20) DEFAULT 'active', PRIMARY KEY (id))",
		);

		foreach($tables as $name => $fields) {
			$table_name = $wpdb->prefix . $name;
			dbDelta("CREATE TABLE $table_name $fields $charset_collate;");
		}
	}
}
