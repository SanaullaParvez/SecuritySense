<?php
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_bloginfo(template_url) );
require_once(THEME_DIR.'/framework.php');
Securitysence::init();
//ADD LOGIN LINK TO MENU 
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);

function add_login_logout_link($items, $args) {
	if( $args->theme_location == 'header-menu' ){
	if( is_user_logged_in( ) )
		$link = '<a href="' . wp_logout_url('index.php', false) . '" title="' .  __( 'Logout' ) .'">' . __( 'Logout' ) . '</a>';
	else  $link = '<a href="' . wp_login_url('index.php', false) . '" title="' .  __( 'Login' ) .'">' . __( 'Login' ) . '</a>'.'<li>'. '<a href="https://localhost/wordpress/wp-login.php?action=register">Register</a>' .'</li>';
function add_new_user(){
	$user_id = username_exists( $user_name );
	if ( !$user_id and email_exists($user_email) == false ) {
		$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
		$user_id = wp_create_user( $user_name, $random_password, $user_email );
	} else {
		$random_password = __('User already exists.  Password inherited.');
	  }
}

//		$loginoutlink = wp_loginout('index.php', false);
//		$items .= '<li>'. $loginoutlink .'</li>';
//		$items .= '<li>'. '<a href="https://localhost/wordpress/wp-admin/user-new.php">Registration</a>' .'</li>';
	}
//	return $items;
	return $items.= '<li id="log-in-out-link" class="menu-item menu-type-link">'. $link . '</li>';

}

?>
