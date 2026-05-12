<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ASB_Elementor_Widget extends \Elementor\Widget_Base {
    public function get_name() { return 'asb_booking_widget'; }
    public function get_title() { return 'ASB Booking Builder'; }
    public function get_icon() { return 'eicon-form-horizontal'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section('section_style', ['label' => 'Style', 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
        $this->add_control('primary_color', ['label' => 'Primary Color', 'type' => \Elementor\Controls_Manager::COLOR, 'selectors' => ['{{WRAPPER}} .asb-btn-primary' => 'background-color: {{VALUE}}']]);
        $this->end_controls_section();
    }

    protected function render() {
        echo do_shortcode('[advanced_service_booking]');
    }
}
