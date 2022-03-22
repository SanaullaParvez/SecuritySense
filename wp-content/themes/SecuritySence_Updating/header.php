<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php wp_title('&laquo;', true,'right');?><?php bloginfo('name');?></title>
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
        <?php if ( is_singular() ) wp_enqueue_script( 'common-reply' ); ?>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon" />
        <?php wp_head(); ?>
	</head>
<body>
<div id="wrap">
<div id="header">
	<div class="header_banner">
	<!--a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.gif"></a-->
		<?php lm_display_logo(); ?>
	</div>
	<?php if (has_nav_menu('header-menu', 'securitysence')) { ?>
	        <?php wp_nav_menu(array(
				    'container'       => 'div',
					'container_class'	=> 'header_menu',
					'fallback_cb'	  =>  false,
					'menu_class'      => 'menu',
					'theme_location'  => 'header-menu'
					)
					); 
				?>
        <?php } ?>
</div>
