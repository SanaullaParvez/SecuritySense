<?php
class WpProQuiz_Controller_StyleManager extends WpProQuiz_Controller_Controller {
	
	public function route() {
		$this->show();
	}
	
	private function show() {
		
		wp_enqueue_style(
			'wpProQuiz_front_style', 
			WPPROQUIZ_FILE.'css/wpProQuiz_front.min.css',
			array(),
			WPPROQUIZ_VERSION
		);
		$view = new WpProQuiz_View_StyleManager();
		
		$view->show();
	}
}
