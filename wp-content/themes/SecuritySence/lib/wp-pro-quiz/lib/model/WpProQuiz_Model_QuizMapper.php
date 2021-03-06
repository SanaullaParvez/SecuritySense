<?php
class WpProQuiz_Model_QuizMapper extends WpProQuiz_Model_Mapper
{
	protected $_table; 
	
	function __construct() {
		parent::__construct();
		
		$this->_table = $this->_prefix."master";
	}
	
	public function delete($id) {
		$this->_wpdb->delete($this->_table, array(
				'id' => $id),
				array('%d'));
	}
	
	public function exists($id) {
		return $this->_wpdb->get_var($this->_wpdb->prepare("SELECT COUNT(*) FROM {$this->_table} WHERE id = %d", $id));
	}
	
	public function fetch($id) {
		$results = $this->_wpdb->get_row(
					$this->_wpdb->prepare(
								"SELECT 
									* 
								FROM
									{$this->_table}
								WHERE
									id = %d",
								$id),
								ARRAY_A
					);
		
		if($results['result_grade_enabled'])
			$results['result_text'] = unserialize($results['result_text']);
		
		return new WpProQuiz_Model_Quiz($results);
	}
	
	public function fetchAll() {
		$r = array();
		
		$results = $this->_wpdb->get_results("SELECT * FROM {$this->_table}", ARRAY_A);

		foreach ($results as $row) {
			
			if($row['result_grade_enabled'])
				$row['result_text'] = unserialize($row['result_text']);
			
			$r[] =  new WpProQuiz_Model_Quiz($row);
		}
		
		return $r;
	}
	
	public function save(WpProQuiz_Model_Quiz $data) {
		
		if($data->isResultGradeEnabled()) {
			$resultText = serialize($data->getResultText());
		} else {
			$resultText = $data->getResultText();
		}
		
		$set = array(
			'name' => $data->getName(),
			'text' => $data->getText(),
			'result_text' => $resultText,
			'title_hidden' => (int)$data->isTitleHidden(),
			'btn_restart_quiz_hidden' => (int)$data->isBtnRestartQuizHidden(),
			'btn_view_question_hidden' => (int)$data->isBtnViewQuestionHidden(),
			'question_random' => (int)$data->isQuestionRandom(),
			'answer_random' => (int)$data->isAnswerRandom(),
			'time_limit' => (int)$data->getTimeLimit(),
			'statistics_on' => (int)$data->isStatisticsOn(),
			'statistics_ip_lock' => (int)$data->getStatisticsIpLock(),
			'result_grade_enabled' => (int)$data->isResultGradeEnabled(),
			'show_points' => (int)$data->isShowPoints(),
			'quiz_run_once' => (int)$data->isQuizRunOnce(),
			'quiz_run_once_type' => $data->getQuizRunOnceType(),
			'quiz_run_once_cookie' => (int)$data->isQuizRunOnceCookie(),
			'quiz_run_once_time' => (int)$data->getQuizRunOnceTime(),
			'numbered_answer' => (int)$data->isNumberedAnswer(),
			'hide_answer_message_box' => (int)$data->isHideAnswerMessageBox(),
			'disabled_answer_mark' => (int)$data->isDisabledAnswerMark(),
			'show_max_question' => (int)$data->isShowMaxQuestion(),
			'show_max_question_value' => (int)$data->getShowMaxQuestionValue(),
			'show_max_question_percent' => (int)$data->isShowMaxQuestionPercent(),
			'toplist_activated' => (int)$data->isToplistActivated(),
			'toplist_data' => $data->getToplistData(),
			'show_average_result' => (int)$data->isShowAverageResult(),
			'prerequisite' => (int)$data->isPrerequisite(),
			'quiz_modus' => (int)$data->getQuizModus(),
			'show_review_question' => (int)$data->isShowReviewQuestion(),
			'quiz_summary_hide' => (int)$data->isQuizSummaryHide(),
			'skip_question_disabled' => (int)$data->isSkipQuestionDisabled(),
			'email_notification' => $data->getEmailNotification(),
			'user_email_notification' => (int)$data->isUserEmailNotification(),
			'show_category_score' => (int)$data->isShowCategoryScore(),
			'hide_result_correct_question' => (int)$data->isHideResultCorrectQuestion(),
			'hide_result_quiz_time' => (int)$data->isHideResultQuizTime(),
			'hide_result_points' => (int)$data->isHideResultPoints()
		);
		
		if($data->getId() != 0) {
			$result = $this->_wpdb->update($this->_table,
					$set,
					array(
							'id' => $data->getId()
					),
					array('%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d'),
					array('%d'));
		} else {
			
			$result = $this->_wpdb->insert($this->_table,
						$set,
						array('%s', '%s', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%s', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d', '%d'));

			$data->setId($this->_wpdb->insert_id);
		}
		
		if($result === false) {
			return null;
		}
		
		return $data;
	}
	
	public function sumQuestionPoints($id) {
		return $this->_wpdb->get_var($this->_wpdb->prepare("SELECT SUM(points) FROM {$this->_tableQuestion} WHERE quiz_id = %d", $id));
	}
	
	public function countQuestion($id) {
		return $this->_wpdb->get_var($this->_wpdb->prepare("SELECT COUNT(*) FROM {$this->_tableQuestion} WHERE quiz_id = %d", $id));
	}
	
	public function fetchAllAsArray($list, $outIds = array()) {
		$where = ' 1 ';
		
		if(!empty($outIds)) {
			$where .= ' AND id NOT IN('.implode(', ', array_map('intval', (array)$outIds)).') ';
		}
		
		return $this->_wpdb->get_results(
			"SELECT ".implode(', ', (array)$list)." FROM {$this->_tableMaster} WHERE $where ORDER BY name",
			ARRAY_A
		);
	}
	
	public function fetchCol($ids, $col) {
		$ids = implode(', ', array_map('intval', (array)$ids));
		
		return $this->_wpdb->get_col("SELECT {$col} FROM {$this->_tableMaster} WHERE id IN({$ids})");
	}
	
	public function activateStatitic($quizIds, $lockIpTime) {
		$quizIds = implode(', ', array_map('intval', (array)$quizIds));
		
		return $this->_wpdb->query($this->_wpdb->prepare(
			"UPDATE {$this->_tableMaster} 
			SET `statistics_on` = 1, `statistics_ip_lock` = %d 
			WHERE `statistics_on` = 0 AND id IN(".$quizIds.")"
			, $lockIpTime));
	}
}