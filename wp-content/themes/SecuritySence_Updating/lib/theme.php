<?php
if ( !function_exists( 'securitysence' ) ) :
function securitysence()
{
$lin = '/var/www/html/wordpress/wp-content/themes/SecuritySence/lib/classes/logo-uploader.php';//echo __FILE__;
$anotherlin = '/var/www/html/wordpress/wp-content/themes/SecuritySence/lib/content-slide/content_slide.php';//echo __FILE__;
$level = 'level_10';
   add_menu_page("Change Logo", "SecuritySence",$level,$lin, "lm_options_page",THEME_URI.'/images/favicon.png');
   add_submenu_page($lin, "Change Logo","Change Logo",$level,$lin, "lm_options_page");
//function add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
   add_submenu_page($lin,'Content Slide', 'Content Slide', $level,$anotherlin,'wpcs_content_slide_options');
//function add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )
   add_submenu_page($lin, 'Help &amp; Support', 'Help &amp; Support', $level,'wpcs_content_slide_help','wpcs_content_slide_help');
//   add_submenu_page(__FILE__, "Change Logo", "Change Logo", 8, "lm_display_logo", "lm_options_page");
}
endif;
if ( !function_exists( 'ss_scripts_method' ) ) :
function ss_scripts_method() {
	wp_enqueue_style( 'epost',get_bloginfo(template_url).'/css/epost.css');
	wp_enqueue_style( 'verticalMenu',get_bloginfo(template_url).'/css/verticalMenu.css');
	wp_enqueue_style( 'horizontalMenu',get_bloginfo(template_url).'/css/horizontalMenu.css');
	wp_enqueue_style( 'passwordStrength',get_bloginfo(template_url).'/css/passwordStrength.css');
	wp_enqueue_script( 'passwordStrength',get_bloginfo(template_url).'/js/passwordStrength.js',array(jquery));
}
endif;
if ( !function_exists( 'securitysence_menus' ) ) :
function securitysence_menus() {
register_nav_menus(array(
	        'header-menu'      => __('Header Menu', 'securitysence'),
	        'corporate-security-menu'  => __('Corporate Security Menu', 'securitysence'),
		'child-online-safety-menu'      => __('Child\'s Online Safety Menu', 'securitysence'),
	        'social-network-menu'  => __('Social Network & Webmail Security Menu', 'securitysence'),
		'online-threat-menu'      => __('Online Threat & Vulnerabilities Menu', 'securitysence'),
	        'security-for-bank-menu'  => __('Security Awarness Menu', 'securitysence'),
	        'technology-menu'  => __('Technology Menu', 'securitysence')
		    )
	    );
//	register_nav_menu( 'main-menu', 'Security Menu' );
//	register_nav_menu( 'right-menu', 'Right Menu' );
}
endif;

if ( !function_exists( 'securitysence_widgets' ) ) :
/**
 *
 */
function securitysence_widgets() {
	# Load each widget file.
	require_once( THEME_CLASSES . '/widget-quiz.php' );
	require_once( THEME_CLASSES . '/widget-quizInPage.php' );
	require_once( THEME_CLASSES . '/widget-passwordStrength.php' );
	require_once( THEME_CLASSES . '/widget-CorporateSecurity.php' );
	require_once( THEME_CLASSES . '/widget-ChildOnlineSafety.php' );
	require_once( THEME_CLASSES . '/widget-SocialNetworkWebmailSecurity.php' );
	require_once( THEME_CLASSES . '/widget-OnlineThreatVulnerabilities.php' );
	require_once( THEME_CLASSES . '/widget-SecurityforBank.php' );
	require_once( THEME_CLASSES . '/widget-Technology.php' );

	# Register each widget.
	register_widget( 'Widget_Quiz' );
	register_widget( 'Widget_QuizInPage' );
	register_widget( 'Widget_passStrength' );
	register_widget( 'Widget_CorporateSecurity' );
	register_widget( 'Widget_ChildOnlineSafety' );
	register_widget( 'Widget_SocialNetworkWebmailSecurity' );
	register_widget( 'Widget_OnlineThreatVulnerabilities' );
	register_widget( 'Widget_SecurityforBank' );
	register_widget( 'Widget_Technology' );
}
endif;

if ( !function_exists( 'securitysence_sidebars' ) ) :
function securitysence_sidebars() {
	register_sidebar( array(
	'name' => __( 'sidebarLeft', 'securitysence' ),
	'id' => 'left_sidebar',
	'before_widget' => '<div id="anItem">',
	'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
	) );	
	register_sidebar( array(
	'name' => __( 'sidebarRight', 'securitysence' ),
	'id' => 'right_sidebar',
	'before_widget' => '<div id="anItem">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
	) );
	register_sidebar( array(
	'name' => __( 'Copyright', 'securitysence' ),
	'id' => 'copyright',
	'before_widget' => '<div class="footer copyright">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
	) );
}
endif;
?>
