<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
    <div class="sub_content">
        <div class="content">
	<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
		<?php comments_template(); ?>
		<?php endwhile; ?>
		<?php else : ?>
		<h3><?php _e('404 Error&#58; Not Found'); ?></h3>
	<?php endif; ?>
</div><!--content End-->
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>


