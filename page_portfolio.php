<?php
/*
Template Name: Portfolio page
*/
?>
	<?php get_header(); ?>
	<?php query_posts('post_type=portfolio&posts_per_page=3'); ?>
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<!--<h1 class="pagetitle"><?php the_title(); ?></h1>-->
			<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div id="port-images">
				<?php  
			   if(get_post_meta($post->ID, "_mcf_large-image", $single = true) != "") :  
			   ?>
				<img src="<?php echo get_post_meta($post->ID, "_mcf_large-image", $single = true); ?>" alt="<?php the_title(); ?>" />
			<?php endif; ?>
				<?php  
			   if(get_post_meta($post->ID, "_mcf_small-image-1", $single = true) != "") :  
			   ?>
				<img src="<?php echo get_post_meta($post->ID, "_mcf_small-image-1", $single = true); ?>" alt="<?php the_title(); ?>" />
			<?php endif; ?>
				<?php  
			   if(get_post_meta($post->ID, "_mcf_small-image-2", $single = true) != "") :  
			   ?>
				<img src="<?php echo get_post_meta($post->ID, "_mcf_small-image-2", $single = true); ?>" alt="<?php the_title(); ?>" />
			<?php endif; ?>
			</div>
			<div style="clear:both;"></div>
			<div class="entry page clear">
				<?php the_content(); ?>
			<div style="clear:both;"></div>
				<?php edit_post_link(__( 'Edit', 'dnet')); ?>
				<?php wp_link_pages(); ?>
			</div><!--end entry-->
		<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<?php comments_template( '', true); ?>
		<?php else : ?>
		<?php endif; ?>
	</div><!--end content-->
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>