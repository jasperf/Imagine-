<?php global $img; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
		<title><?php wp_title($sep = ''); ?> | <?php bloginfo( 'name');?></title>
	<!-- Basic Meta Data -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php if ( (is_home()) || (is_front_page()) ) {
	    echo ('Your main description goes here');
	} elseif(is_category()) {
 	   echo category_description();
	} elseif(is_tag()) {
 	   echo '-tag archive page for this blog' . single_tag_title();
	} elseif(is_month()) {
	    echo 'archive page for this blog' . the_time('F, Y');
	} else {
		echo get_post_meta($post->ID, "_img_meta-description", true);}?>"/>
	<meta name="Copyright" content="Design is copyright 2011 - <?php echo date('Y'); ?> Imagewize.net" />
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type'); ?>; charset=<?php bloginfo( 'charset'); ?>" />
	<?php if ((is_single() || is_category() || is_page() || is_home()) && (!is_paged())){} else { ?>
		<meta name="robots" content="noindex,follow" />
	<?php } ?>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory'); ?>/images/favicon.ico" />

	<!--Stylesheets-->
	<link href="<?php bloginfo( 'stylesheet_url'); ?>" type="text/css" media="screen" rel="stylesheet" />

	<style type="text/css">
	div#title {
		
		background-image: url(<?php echo $backgroundlogo ?> );
	}
	</style>
	<!--WordPress-->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name'); ?> RSS Feed" href="<?php bloginfo( 'rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url'); ?>" />
  <?php wp_enqueue_script("jquery"); ?>
	<!--WP Hook  Threaded Comments-->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="skip-content"><a href="#content">Skip to content</a></div>
	<div id="social-header"><div id="hireme"><a href="<?php echo of_get_option('voorbeeld_teksts_kleintje_pils'); ?>">F</a></div></div>
	<div id="header" class="clear">
		
			      		<?php
                		// Check to see if the header image has been removed
                		$header_image = get_header_image();
                		if (empty( $header_image )): ?>
                		<div class="header-top">
                <div id="title"><h1><a href="<?php bloginfo( 'url'); ?>"><?php bloginfo( 'description'); ?></a></h1></div>
                	<?php else: ?>
                	<div class="header-top-with-image">	
                <div id="title"><a href="<?php bloginfo( 'url'); ?>"><h1><img src="<?php header_image(); ?>" alt="" /></h1>
                </a></div>
                <?php endif;?>
            	</div>
			        <div class="navbar navbar-inverse">
                  <div class="navbar-inner">
                    <div class="container">
                      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </a>
                      <a class="brand hidden-desktop" href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a>
                      <div class="nav-collapse collapse">
                        <ul class="nav">

                            <?php wp_list_pages(array('title_li' => '', 'exclude' => 4)); ?>

                        </ul>
                      </div><!--/.nav-collapse -->
                    </div>
                  </div>
                </div>
      <?php /*
      <div id="menuwrapper">
      <?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
      			  <?php wp_nav_menu(array('theme_location' => 'primary-menu', 'container_id' => 'navigation', 'menu_class' => 'nav')); ?>
      		<?php } 
      			 else { ?>
      				<div id="navigation">
      				<ul class="nav">
      				<?php wp_list_pages( 'title_li=' ); ?>
      					</ul></div><!--end navigation-->

      		<?php	} ?>
      		<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>
      					  <?php wp_nav_menu(array('theme_location' => 'secondary-menu', 'container_id' => 'subnavigation', 'menu_class' => 'nav')); ?>
      				<?php } 
      					 else { ?>

      				<?php	} ?>
      			</div> <!-- End Menu wrapper -->
      			*/?>
			
		</div><!--end Header Top-->