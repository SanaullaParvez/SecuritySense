<?php
/*
Template Name: Sign In
*/

/* This example is for a child theme of Twenty Thirteen: 
*  You'll need to adapt it the HTML structure of your own theme.
*/

get_header(); ?>
<?php get_sidebar( 'left' ); ?>
    <div class="sub_content">
        <div class="content">
	<div id="artical">	
            <?php wp_loginout(); ?>
	</div><!--artical End-->	
	</div><!--content End-->
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>

