<?php
class WpProQuiz_Controller_Preview extends WpProQuiz_Controller_Controller {
	
	public function route() {
		
		wp_enqueue_script(
			'wpProQuiz_front_javascript', 
			WPPROQUIZ_FILE.'js/wpProQuiz_front'.(WPPROQUIZ_DEV ? '' : '.min').'.js',
			array('jquery', 'jquery-ui-sortable'),
			WPPROQUIZ_VERSION
		);
		
		wp_localize_script('wpProQuiz_front_javascript', 'WpProQuizGlobal', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'loadData' => __('Loading', 'wp-pro-quiz')
		));
		
		wp_enqueue_style(
			'wpProQuiz_front_style', 
			WPPROQUIZ_FILE.'css/wpProQuiz_front'.(WPPROQUIZ_DEV ? '' : '.min').'.css',
			array(),
			WPPROQUIZ_VERSION
		);
		
		$this->showAction($_GET['id']);
	}
	
	public function showAction($id) {
		$view = new WpProQuiz_View_FrontQuiz();
		
		$quizMapper = new WpProQuiz_Model_QuizMapper();
		$questionMapper = new WpProQuiz_Model_QuestionMapper();
		
		$quiz = $quizMapper->fetch($id);
		
		if($quiz->isShowMaxQuestion() && $quiz->getShowMaxQuestionValue() > 0) {
				
			$value = $quiz->getShowMaxQuestionValue();
				
			if($quiz->isShowMaxQuestionPercent()) {
				$count = $questionMapper->count($id);
		
				$value = ceil($count * $value / 100);
			}
				
			$question = $questionMapper->fetchAll($id, true, $value);
				
		} else {
			$question = $questionMapper->fetchAll($id);
		}
		
		$view->quiz = $quiz;
		$view->question = $question;
		$view->show(true);
	}
}
