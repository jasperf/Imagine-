<?php get_header(); ?>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<h1 class="pagetitle"><?php the_title(); ?></h1>
		<div class="entry page clear">
			<?php the_content(); ?>
			<?php edit_post_link(__( 'Edit', 'img')); ?>
			<?php wp_link_pages(); ?>
		</div><!--end entry-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	<?php comments_template( '', true); ?>
	<?php else : ?>
	<?php endif; ?>
</div><!--end content-->
<div style="clear:left;"></div>
<?php get_footer(); ?>
