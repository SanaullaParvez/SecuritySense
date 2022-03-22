<?php
/*
Plugin Name: Password Strength Checking
Plugin URI: http://jamesbruce.me/
Description: Password Strength Checking Widget
Author: Md. Nasir
Version: 1
Author URI: http://www.facebook.com/nasir.ict07/
*/
class Widget_passStrength extends WP_Widget {

	function Widget_passStrength() {
		$widget_ops = array('classname' => 'passStrength', 'description' =>'A passStrength that dispaly the Strength of any Password');
		$this->WP_Widget('passStrength','Password Strength Checking', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);	
		$title = apply_filters('widget_title', empty($instance['title']) ? $initial : $instance['title'], $instance, $this->id_base);
		$text = apply_filters( 'widget_text','[WpProQuiz 1]', $instance );
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		else
		echo "<img class='size-full wp-image-149 aligncenter' alt=quiz src=\"".get_template_directory_uri()."/images/pass.png\" width=207 height=50 />";
		?>
		<form id="register">
		<label for="password">Enter Password :</label>
		<input name="password" id="password" type="password"/>
		<div id="result"></div>
		</form>
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
