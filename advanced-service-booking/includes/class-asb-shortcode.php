<?php
class ASB_Shortcode {
	public function render() {
		ob_start();
        include ASB_PATH . 'templates/main-configurator.php';
        return ob_get_clean();
	}
}
