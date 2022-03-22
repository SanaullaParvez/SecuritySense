<?php
/*
Plugin Name: Children\'s Online Safety
Plugin URI: http://jamesbruce.me/
Description: Child Online Safety Menu
Author: TSPBD
Version: 1
Author URI: http://www.facebook.com/nasir.ict07/
*/
class Widget_ChildOnlineSafety extends WP_Widget {

	function Widget_ChildOnlineSafety() {
		$widget_ops = array('classname' => 'ChildOnlineSafety', 'description' =>'A simle menu of Child Online Safety');
		$this->WP_Widget('ChildOnlineSafety','Children\'s Online Safety', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Children\'s Online Safety' : $instance['title'], $instance, $this->id_base);
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		?>		
		<?php if (has_nav_menu('child-online-safety-menu', 'securitysence')) { ?>
	        <?php wp_nav_menu(array(
					'fallback_cb'	  =>  false,
					'menu_class'      => 'menu',
					'theme_location'  => 'child-online-safety-menu'
					)
					); 
				?>
        <?php } ?>
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
