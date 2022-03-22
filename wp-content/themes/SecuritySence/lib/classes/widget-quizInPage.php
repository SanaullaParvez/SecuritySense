<?php
/*
Plugin Name: Quiz Test In Page
Plugin URI: http://jamesbruce.me/
Description: Quiz Widget
Author: Md. Nasir
Version: 1
Author URI: http://www.facebook.com/nasir.ict07/
*/
class Widget_QuizInPage extends WP_Widget {

	function Widget_QuizInPage() {
		$widget_ops = array('classname' => 'QuizInPage', 'description' =>'A Quiz that dispaly Quiz test in Page');
		$this->WP_Widget('QuizInPage','Quiz Test In Page', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);		
		$title = apply_filters('widget_title', empty($instance['title']) ? $initial : $instance['title'], $instance, $this->id_base);
		$text = apply_filters( 'widget_text','[WpProQuiz 1]', $instance );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		else
		echo "<img alt=quiz src=\"".get_template_directory_uri()."/images/quiz.png\" width=207 height=40 />";
		?>
		<div id="simpleQuiz">
		<a href="<?php echo get_page_link(115); ?>"><span>Start Quiz</span></a>
   		<!--a href="https://localhost/wordpress/?page_id=115"><span>Start Quiz</span></a-->
		</div><br/>
		<?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}
?>
