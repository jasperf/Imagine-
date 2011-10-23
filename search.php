<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<h1 class="pagetitle"><?php printf(__ ("Search results for '%s'", "dnet"), attribute_escape(get_search_query())); ?></h1>
	<?php while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="post-header">
				<div class="date"><?php the_time(__ ( 'M j', 'dnet')); ?> <span><?php the_time( 'y' ); ?></div>
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="author"><?php printf(__ ( 'by %s', 'dnet'), get_the_author()); ?></div>
			</div><!--end post header-->
			<div class="entry clear">
				<?php the_excerpt(__( 'read more...', 'dnet')); ?>
				<?php edit_post_link(__( 'Edit', 'dnet')); ?>
			</div><!--end entry-->
			<div class="post-footer">
				<div class="comments"><?php comments_popup_link(__ ( 'Leave a comment', 'dnet'), __ ( '1 Comment', 'dnet'), __ngettext ( '% Comment', '% Comments', get_comments_number (),'dnet')); ?></div>
			</div><!--end post footer-->
		</div><!--end post-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<div class="navigation index">
			<div class="alignleft"><?php next_posts_link( '&laquo; Older Entries' ); ?></div>
			<div class="alignright"><?php previous_posts_link( 'Newer Entries &raquo;' ); ?></div>
		</div><!--end navigation-->
	<?php else : ?>
		<h1 class="pagetitle"><?php printf(__ ("Search results for '%s'", "dnet"), attribute_escape(get_search_query())); ?></h1>
		<div class="entry page">
			<p><?php printf(__ ( 'Sorry your search for "%s" did not turn up any results. Please try again.', 'dnet'), attribute_escape(get_search_query())); ?></p>
			<?php if (is_file(STYLESHEETPATH . '/searchform.php')) include (STYLESHEETPATH . '/searchform.php'); else include (TEMPLATEPATH . '/searchform.php'); ?>
		</div><!--end entry-->
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
