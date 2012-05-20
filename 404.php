<?php get_header(); ?>
<div class="content-background">
	<div class="contentwrapper">
		<div class="notice"></div>
		<div id="content">
	<h1 class="pagetitle"><?php _e( '404: Page Not Found', 'img' ); ?></h1>
	<div class="entry page">
		<p><?php _e( 'We are terribly sorry, but the URL you typed no longer exists. It might have been moved or deleted, or perhaps you mistyped it. We suggest searching the site:', 'img' ); ?></p>
		<?php if (is_file(STYLESHEETPATH . '/searchform.php')) include (STYLESHEETPATH . '/searchform.php'); else include(TEMPLATEPATH . '/searchform.php'); ?>
	</div><!--end entry-->
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>