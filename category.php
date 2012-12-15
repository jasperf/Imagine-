<?php get_header(); ?>
<div class="content-background">
	<div class="contentwrapper">
		<div class="notice"></div>
		<div id="content">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<div class="entry page clear">
<h1 class="pagetitle">
<?php printf(__ ( 'Posts from the  &#8216;%s&#8217; Category', 'img'), single_cat_title('', false)); ?></h1>		</div><!--end entry-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	<?php else : ?>
	<?php endif; ?>
</div><!--end content-->	  
<div style="clear:left;"></div>
<?php get_footer(); ?>