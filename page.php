<?php get_header(); ?>
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
	<?php if ( !dynamic_sidebar('Sidebar') ) : ?>
	   <div class="page-sidebar">
	<?php
	//http://wordpress.org/support/topic/2-or-3-column-categories-in-sidebar?replies=39
	$get_cats = wp_list_categories( 'echo=0&title_li=&depth=1&hide_empty=0' );
	// Get cats 

	$cat_array = explode('</li>',$get_cats);
	// Split into array items

	$columns = 2;
	// How many columns (virtual)

	$cats_shown = 0;
	// Don't touch this, this is just a counter (used below)

	echo '<h2 class="widgettitle">Categories</h2><ul style="display:inline;">';

	foreach($cat_array as $category) {
		$cats_shown++;

		// The 2 lines below can be removed if you apply the style definitions to the classes (ie. cat-item, cat-item a etc..)
		// This was just quicker and easier for me to use whilst testing the code.
		$category = str_replace('<li','<li style="display:inline"',$category);
		$category = str_replace('<a href','<a style="width:160px;display:block;float:left" href',$category);

		if($cats_shown % $columns == 0) {
			// If the counter is a multiple of the columns to show
			print $category.'</li></ul><br /><ul style="display:inline;">';
		}
		else {
			// Else just a regular item
			print $category.'</li>';
		}
	}
	echo '</ul>';
	?>
	<?php endif; ?>
	</div>
<div style="clear:left;"></div>
<?php get_footer(); ?>
