<?php
/*
Template Name: Thuis
*/
?>

<?php get_header(); ?>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<h1 class="pagetitle"><?php the_title(); ?></h1>
		<div class="entry page clear">
			<?php the_content(); ?>
			<?php edit_post_link(__( 'Edit', 'dnet')); ?>
			<?php wp_link_pages(); ?>
		</div><!--end entry-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	<?php else : ?>
	<?php endif; ?>
</div><!--end content-->
<?php //get_sidebar(); ?>
<?php // Two rows with three widgets ?>
<div id="contact-us-box">
<h2>Vraag een offerte aan!</h2>
<p>Vragen of meteen een offerte aanvragen?</p>
<p>Neem dan contact met ons op.</p>
<p>Tel: 020 8943632</p>
<p><a href="<?php bloginfo('url'); ?>/contact">Email ons</a></p>
</div>
<div style="clear:left;"></div>
<?php get_sidebar('home'); ?>
	
<?php get_footer(); ?>