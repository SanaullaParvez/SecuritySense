<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<div class="sub_content">
        <div class="content">
	<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
	<h2><?php the_title(); ?></a></h2>
<?php $args = array(
	'before'           => '<div class="pagination">',
	'after'            => '</div>',
	'link_before'      => ' ',
	'link_after'       => ' ',
	'next_or_number'   => 'next',
	'nextpagelink'     => __('<div style="float:right;">Next »</div>'),
	'previouspagelink' => __('« Previous'),
	'pagelink'         => '%',
	'echo'             => 1
); ?>

		<p><?php the_content(); ?></p>
		<div class="pagination"><?php wp_pagenavi( array( 'type' => 'multipart' ) ); ?></div>
		<!--?php wp_link_pages($args); ?-->
		<?php endwhile; ?>
		<?php else : ?>
		<h3><?php _e('404 Error&#58; Not Found'); ?></h3>
	<?php endif; ?>
</div><!--content End-->
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>
