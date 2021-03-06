<?php
class WpProQuiz_Controller_Front {
		
	/**
	 * @var WpProQuiz_Model_GlobalSettings
	 */
	private $_settings = null;
	
	public function __construct() {
		$this->loadSettings();
				
		add_action('wp_enqueue_scripts', array($this, 'loadDefaultScripts'));
		add_shortcode('WpProQuiz', array($this, 'shortcode'));
		add_shortcode('WpProQuiz_toplist', array($this, 'shortcodeToplist'));
	}
	
	public function loadDefaultScripts() {
		wp_enqueue_script('jquery');
		
		wp_enqueue_style(
			'wpProQuiz_front_style', 
			WPPROQUIZ_FILE.'css/wpProQuiz_front'.(WPPROQUIZ_DEV ? '' : '.min').'.css',
			array(),
			WPPROQUIZ_VERSION
		);
		
		if($this->_settings->isJsLoadInHead()) {
			$this->loadJsScripts(false, true, true);
		}
	}
	
	private function loadJsScripts($footer = true, $quiz = true, $toplist = false) {
		if($quiz) {
			wp_enqueue_script(
				'wpProQuiz_front_javascript',
				WPPROQUIZ_FILE.'js/wpProQuiz_front'.(WPPROQUIZ_DEV ? '' : '.min').'.js',
				array('jquery-ui-sortable'),
				WPPROQUIZ_VERSION,
				$footer
			);
			
			wp_localize_script('wpProQuiz_front_javascript', 'WpProQuizGlobal', array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'loadData' => __('Loading', 'wp-pro-quiz')
			));
		}
		
		if($toplist) {
			wp_enqueue_script(
				'wpProQuiz_front_javascript_toplist',
				WPPROQUIZ_FILE.'js/wpProQuiz_toplist'.(WPPROQUIZ_DEV ? '' : '.min').'.js',
				array('jquery-ui-sortable'),
				WPPROQUIZ_VERSION,
				$footer
			);
			
			if(!wp_script_is('wpProQuiz_front_javascript'))
				wp_localize_script('wpProQuiz_front_javascript_toplist', 'WpProQuizGlobal', array(
					'ajaxurl' => admin_url('admin-ajax.php'),
					'loadData' => __('Loading', 'wp-pro-quiz')
				));
		}
		
		if(!$this->_settings->isTouchLibraryDeactivate()) {
			wp_enqueue_script(
				'jquery-ui-touch-punch',
				WPPROQUIZ_FILE.'js/jquery.ui.touch-punch.min.js',
				array('jquery-ui-sortable'),
				'0.2.2',
				$footer
			);
		}
	}
	
	public function shortcode($attr) {
		$id = $attr[0];
		$content = '';
		
		if(!$this->_settings->isJsLoadInHead()) {
			$this->loadJsScripts();
		}

		if(is_numeric($id)) {
			ob_start();
			
			$this->handleShortCode($id);
			
			$content = ob_get_contents();
			
			ob_end_clean();
		}

		if($this->_settings->isAddRawShortcode()) {
			return '[raw]'.$content.'[/raw]';
		} 
		
		return $content;
	}
	
	public function handleShortCode($id) {
		$view = new WpProQuiz_View_FrontQuiz();
		
		$quizMapper = new WpProQuiz_Model_QuizMapper();
		$questionMapper = new WpProQuiz_Model_QuestionMapper();
		$categoryMapper = new WpProQuiz_Model_CategoryMapper();
		
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
		
		if(empty($quiz) || empty($question)) {			
			echo '';
			
			return;
		}
		
		$view->quiz = $quiz;
		$view->question = $question;
		$view->category = $categoryMapper->fetchByQuiz($quiz->getId());
		
		$view->show();		
	}
	
	public function shortcodeToplist($attr) {
		$id = $attr[0];
		$content = '';

		if(!$this->_settings->isJsLoadInHead()) {
			$this->loadJsScripts(true, false, true);
		}
		
		if(is_numeric($id)) {
			ob_start();
			
			$this->handleShortCodeToplist($id, isset($attr['q']));
				
			$content = ob_get_contents();
				
			ob_end_clean();
		}
		
		if($this->_settings->isAddRawShortcode() && !isset($attr['q'])) {
			return '[raw]'.$content.'[/raw]';
		}
		
		return $content;
	}
	
	private function handleShortCodeToplist($quizId, $inQuiz = false) {
		$quizMapper = new WpProQuiz_Model_QuizMapper();
		$view = new WpProQuiz_View_FrontToplist();
		
		$quiz = $quizMapper->fetch($quizId);
		
		if($quiz->getId() <= 0 || !$quiz->isToplistActivated()) {
			echo '';
			return;
		}
		
		$view->quiz = $quiz;
		$view->points = $quizMapper->sumQuestionPoints($quizId);
		$view->inQuiz = $inQuiz;
		$view->show();
	}
	
	private function loadSettings() {
		$mapper = new WpProQuiz_Model_GlobalSettingsMapper();
		
		$this->_settings = $mapper->fetchAll();
	}
}
