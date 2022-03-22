<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
    <div class="sub_content">
        <div class="content">
	<div id="slider"><?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>
	<span id="bl">This site is under construction...</span></div><!--slider End-->
	<div id="artical">	
            <?php $pid = array("ap","bp","cp","dp","ep","fp","gp","hp");$index=0; if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
			<?php if ( in_category('Artical') ) { ?>
                           <?php echo "<div class=\"pbox\" id=\"".$pid[$index]."\">"; ?>
                               <div class="articleDetails"> <h2 class="articleHeading"> <?php the_title()?> </h2>                             
                                <?php the_excerpt(); ?></div>
                                    <div class="more"><a href="<?php echo get_permalink(); $index++; ?>"> Read More..</a></div>
                            </div>
			<?php }?>
               <?php
                endwhile;
                endif;
                ?>
		<!--<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p><?php the_content('Read more...'); ?></p>
		<?php link_pages('<p>', '</p>', 'number', '', '', 'page %'); ?>
		<?php endwhile; ?>
		<?php else : ?>
		<h3><?php _e('404 Error&#58; Not Found'); ?></h3>
		<?php endif; ?>-->
	</div><!--artical End-->	
	</div><!--content End-->
<?php get_sidebar( 'right' ); ?>
<?php get_footer(); ?>

