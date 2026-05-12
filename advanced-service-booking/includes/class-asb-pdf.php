<?php
// PDF logic using Dompdf
require_once ASB_PATH . 'vendor/autoload.php';
use Dompdf\Dompdf;

class ASB_PDF {
    public function generate($request_id) {
        global $wpdb;
        $order = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_requests WHERE id = %d", $request_id));
        $items = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}asb_request_items WHERE request_id = %d", $request_id));

        $html = '<h1>Quotation #'.$request_id.'</h1>';
        $html .= '<p>Customer: '.$order->full_name.'</p>';
        $html .= '<table><tr><th>Item</th><th>Price</th></tr>';
        foreach($items as $item) {
            $html .= '<tr><td>'.$item->item_title.'</td><td>$'.$item->price.'</td></tr>';
        }
        $html .= '</table><h3>Total: $'.$order->total_price.'</h3>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->output();
    }
}
