<?php
class Securitysence{

//if ( function_exists( 'register_nav_menu' ) ) {
//	register_nav_menu( 'main-menu', 'Security Menu' );
//}



   function init(){
	self::constants();
	self::functions();
	self::actions();
	
	//$uploadDir = wp_upload_dir();
	//echo get_template_directory();
	//	the_widget('Widget_Quiz');
   }
   function constants(){
	define( 'THEME_LIBRARY', THEME_DIR . '/lib' );
	define( 'THEME_CLASSES', THEME_LIBRARY . '/classes' );
   }
   function functions() {
	require_once(THEME_LIBRARY.'/theme.php');
	require_once(THEME_LIBRARY.'/wp-pro-quiz/wp-pro-quiz.php');
	require_once(THEME_LIBRARY.'/ditty-news-ticker/ditty-news-ticker.php');
	require_once(THEME_LIBRARY.'/content-slide/content_slide.php');
	require_once(THEME_CLASSES.'/logo-uploader.php');
   }
   function actions() {
	add_action( 'wp_enqueue_scripts', 'ss_scripts_method' );
	//add_action( 'wp_footer', 'ss_scripts_add_footer');
	add_action('admin_menu', 'securitysence');	
	add_action( 'init', 'securitysence_menus' );
	add_action( 'widgets_init', 'securitysence_sidebars' );
	add_action( 'widgets_init', 'securitysence_widgets' );
	//add_action('admin_menu', 'lm_menu_link');
   }
}

//function ss_scripts_add_footer() {
//	wp_print_scripts('passwordStrength');
//}
?>
