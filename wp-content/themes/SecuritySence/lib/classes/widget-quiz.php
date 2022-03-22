<?php
/*
Plugin Name: Quiz Test
Plugin URI: http://jamesbruce.me/
Description: Quiz Widget
Author: Abu Sufian
Version: 1
Author URI: http://www.facebook.com/sufina.ict07/
*/
class Widget_Quiz extends WP_Widget {

	function Widget_Quiz() {
		$widget_ops = array('classname' => 'Quiz', 'description' =>'A Quiz that dispaly Quiz test');
		$this->WP_Widget('Quiz','Quiz Test', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		add_filter('quiz_texts', 'do_shortcode');
		$text = apply_filters( 'quiz_texts','[WpProQuiz 1]', $instance );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		?><?php echo $text; ?><?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		//if ( current_user_can('unfiltered_html') )
		//	$instance['text'] =  $new_instance['text'];
		//else
		//	$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		//$text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<!--textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea-->

<?php
	}
}
?>

