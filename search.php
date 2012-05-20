<?php get_header(); ?>
<div class="content-background">
	<div class="contentwrapper">
		<div class="notice"></div>
		<div id="content">
	<?php if (have_posts()) : ?>
		<h1 class="pagetitle"><?php printf(__ ("Search results for '%s'", "img"), attribute_escape(get_search_query())); ?></h1>
	<?php while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="post-header">
				<div class="date"><?php the_time(__ ( 'M j', 'img')); ?> <span><?php the_time( 'y' ); ?></div>
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="author"><?php printf(__ ( 'by %s', 'img'), get_the_author()); ?></div>
			</div><!--end post header-->
			<div class="entry clear">
				<?php the_excerpt(__( 'read more...', 'img')); ?>
				<?php edit_post_link(__( 'Edit', 'img')); ?>
			</div><!--end entry-->
			<div class="post-footer">
				<div class="comments"><?php comments_popup_link(__ ( 'Leave a comment', 'img'), __ ( '1 Comment', 'img'), __ngettext ( '% Comment', '% Comments', get_comments_number (),'img')); ?></div>
			</div><!--end post footer-->
		</div><!--end post-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<div class="navigation index">
			<div class="alignleft"><?php next_posts_link( '&laquo; Older Entries' ); ?></div>
			<div class="alignright"><?php previous_posts_link( 'Newer Entries &raquo;' ); ?></div>
		</div><!--end navigation-->
	<?php else : ?>
		<h1 class="pagetitle"><?php printf(__ ("Search results for '%s'", "img"), attribute_escape(get_search_query())); ?></h1>
		<div class="entry page">
			<p><?php printf(__ ( 'Sorry your search for "%s" did not turn up any results. Please try again.', 'img'), attribute_escape(get_search_query())); ?></p>
			<?php if (is_file(STYLESHEETPATH . '/searchform.php')) include (STYLESHEETPATH . '/searchform.php'); else include (TEMPLATEPATH . '/searchform.php'); ?>
		</div><!--end entry-->
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
