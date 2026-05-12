<?php
class ASB_Emails {
    public static function send_quotation($request_id) {
        global $wpdb;
        $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_requests WHERE id = %d", $request_id));

        $to = $order->email;
        $subject = 'Your Quotation';
        $message = 'Hello ' . $order->full_name . ', please find your quotation attached.';
        $headers = array('Content-Type: text/html; charset=UTF-8');

        // Generate PDF and save temporarily
        require_once ASB_PATH . 'includes/class-asb-pdf.php';
        $pdf_gen = new ASB_PDF();
        $pdf_content = $pdf_gen->generate($request_id);
        $upload_dir = wp_upload_dir();
        $pdf_path = $upload_dir['path'] . '/quotation-' . $request_id . '.pdf';
        file_put_contents($pdf_path, $pdf_content);

        $attachments = array($pdf_path);

        wp_mail($to, $subject, $message, $headers, $attachments);

        // Send to admin too
        $admin_email = get_option('admin_email');
        wp_mail($admin_email, 'New Quotation Request #' . $request_id, $message, $headers, $attachments);

        // Cleanup
        unlink($pdf_path);
    }
}
