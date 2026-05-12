<?php
class ASB_Loader {
	protected $actions = [];
	protected $shortcodes = [];
	public function add_action($hook, $comp, $callback) { $this->actions[] = ['hook'=>$hook, 'comp'=>$comp, 'callback'=>$callback]; }
	public function add_shortcode($tag, $comp, $callback) { $this->shortcodes[] = ['tag'=>$tag, 'comp'=>$comp, 'callback'=>$callback]; }
	public function run() {
		foreach($this->actions as $a) add_action($a['hook'], [$a['comp'], $a['callback']]);
		foreach($this->shortcodes as $s) add_shortcode($s['tag'], [$s['comp'], $s['callback']]);
	}
}
