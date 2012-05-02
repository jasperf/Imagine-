<?php
/*
Template Name: Thuis
*/
?>
<?php wp_enqueue_script('jquery'); ?>
<?php get_header(); ?>
<!-- Include the Nivo Slider CSS file -->
    <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/scripts/nivoslider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/scripts/nivoslider/nivo-slider.css" type="text/css" media="screen" />
<!-- Include the Nivo Slider JS file -->
<script src="<?php bloginfo("template_url"); ?>/scripts/nivoslider/jquery.nivo.slider.pack.js" type="text/javascript"></script>
<!-- Set up the Nivo Slider -->
<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#slider').nivoSlider({
		effect: 'fade', // Specify sets like: 'fold,fade,sliceDown,slideInRight,sliceUpLeft'
		animSpeed: 500, // Slide transition speed
		pauseTime: 6000, // How long each slide will show
		});
});
</script>

	<div id="slider" class="slider-wrapper theme-default">
		<img src="<?php bloginfo("template_url"); ?>/images/slide_1.jpg" alt="" />
		<img src="<?php bloginfo("template_url"); ?>/images/slide_2.jpg" alt="" />
		<img src="<?php bloginfo("template_url"); ?>/images/slide_3.jpg" alt="" title="This is an example of a caption" />
		<img src="<?php bloginfo("template_url"); ?>/images/slide_4.jpg" alt="" />
	</div>
	
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<h1 class="pagetitle"><?php the_title(); ?></h1>
		<div class="entry page clear">
			<?php the_content(); ?>
			<?php edit_post_link(__( 'Edit', 'img')); ?>
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