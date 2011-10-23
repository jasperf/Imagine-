<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
			<h1 class="pagetitle"><?php printf(__ ( 'Posts from the  &#8216;%s&#8217; Category', 'dnet'), single_cat_title('', false)); ?></h1>
			<?php /* If this is a tag archive */ } elseif ( is_tag() ) { ?>
			<h1 class="pagetitle"><?php printf(__ ( 'Posts tagged &#8216;%s&#8217;', 'dnet'), single_tag_title('', false)); ?></h1>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h1 class="pagetitle"><?php _e( 'Archive for', 'dnet' ); ?> <?php the_time(__ ( 'F jS, Y', 'dnet')); ?></h1>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h1 class="pagetitle"><?php _e( 'Archive for', 'dnet' ); ?> <?php the_time(__ ( 'F, Y', 'dnet')); ?></h1>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1 class="pagetitle"><?php _e( 'Archive for', 'dnet' ); ?> <?php the_time(__ ( 'Y', 'dnet')); ?></h1>
			<?php /* If this is an author archive */ } elseif (is_author()) { if (isset($_GET['author_name'])) $current_author = get_userdatabylogin($author_name); else $current_author = get_userdata(intval($author));?>
			<h1 class="pagetitle"><?php printf(__ ( 'Posts by %s', 'dnet'), $current_author->nickname); ?></h1>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1 class="pagetitle"><?php _e( 'Blog Archives', 'dnet' ); ?></h1>
		<?php } ?>
	<?php while (have_posts()) : the_post(); ?>
		<div class="entries">
			<ul>
				<li><span><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php printf(__ ( '%s on', 'dnet'), get_the_title()); ?></a> <?php the_time(__ ( 'F jS, Y', 'dnet')); ?></span></li>
			</ul>
		</div><!--end entries-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__ ( '&laquo; Older Entries', 'dnet')); ?></div>
			<div class="alignright"><?php previous_posts_link(__ ( 'Newer Entries &raquo;', 'dnet')); ?></div>
		</div><!--end navigation-->
	<?php else : ?>
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
