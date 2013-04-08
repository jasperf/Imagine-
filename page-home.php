<?php
/*
Template Name: Thuis
*/
?>
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

<div id="slider-wrapper" class="visible-desktop">
  <div class="slider-wrapper theme-default">
              <div class="ribbon"></div>
              <div id="slider" class="nivoSlider">
  				<?php $pj_slider = new WP_Query('post_type=img_slideshow&showposts=4'); while($pj_slider->have_posts()) : $pj_slider->the_post(); ?>

      <?php $pj_slider_caption = '#slider-caption-'.get_the_ID(); ?>

          <?php if(has_post_thumbnail() ) { ?>

              <?php the_post_thumbnail('slider', array('title' => ''.$pj_slider_caption.'')); ?>
          <?php } ?>
      <?php endwhile; wp_reset_query(); ?>
              </div>
             <?php $pj_slider_caption = new WP_Query('post_type=img_slideshow&showposts=4'); 
      while($pj_slider_caption->have_posts()) : $pj_slider_caption->the_post(); ?>

          <div id="slider-caption-<?php the_ID(); ?>" class="nivo-html-caption">

              <span class="nivo-caption-title"><?php the_title(); ?></span>

              <?php $pj_nivo_caption_content = get_the_excerpt(); ?>

              <span class="nivo-caption-content"><?php echo $pj_nivo_caption_content; ?></span>

      <span class="nivo-caption-link"><a href="<?php the_permalink(); ?>">Read more about this feature &raquo;</a></span>
          </div><!-- // nivo-html-caption -->
      <?php endwhile; wp_reset_query(); ?>

  </div>
  
	</div> <!-- end slider wrapper -->
	</div> <!-- end header -->
	<div class="content-background">
		<div class="boxes">
			<?php 
			if (! is_active_sidebar ('left-home-box')
			  && ! is_active_sidebar( 'center-home-box' )
			  && ! is_active_sidebar( 'right-home-box' )
			  )
			  echo
		'<div id="left-home-box"></div>
		<div id="center-home-box"></div>
		<div id="right-home-box"></div>'
		;?>

    <?php if ( is_active_sidebar('left-
    home-box') ) : ?>
          <?php dynamic_sidebar( 'left-home-box' ); ?>
    		<?php endif; ?>
    
    <?php if ( is_active_sidebar('center-
        home-box') ) : ?>
              <?php dynamic_sidebar( 'center-home-box' ); ?>
        		<?php endif; ?>
    
    <?php if ( is_active_sidebar('right-
            home-box') ) : ?>
                  <?php dynamic_sidebar( 'right-home-box' ); ?>
            		<?php endif; ?>
		
		</div>

		<div id="container">
				
			<div id="content">	
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
<?php // Two rows with three widgets ?>
<div id="contact-us-box" class="visible-desktop">
<h2>Vraag een offerte aan!</h2>
<p>Vragen of meteen een offerte aanvragen?</p>
<p>Neem dan contact met ons op.</p>
<p>Tel: 020 8943632</p>
<p><a href="<?php bloginfo('url'); ?>/contact">Email ons</a></p>
</div>
<div style="clear:left;"></div>
<?php get_footer('home'); ?>
	
<?php get_footer(); ?>