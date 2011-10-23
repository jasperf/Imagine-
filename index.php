<?php get_header(); ?>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-header">
			<div class="date"><?php the_time(__( 'M j', 'dnet')); ?> <span><?php the_time( 'y' ); ?></span></div>
			<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="author"><?php printf(__( 'by %s', 'dnet'), get_the_author()); ?></div>
		</div><!--end post header-->
		<div class="entry clear">
			<div class="alignleft">
			<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail( array(80,80));//, array( 'class' => ' alignleft border:5px' )); ?>
			</div>
			<?php /*<div class="alignleft"> */ ?>
			<div>
			<?php the_content(__( 'read more...', 'dnet')); ?>
			<?php edit_post_link(__( 'Edit', 'dnet')); ?>
				<?php the_meta(); ?>
				<?php 
				 $technologiesarrary = get_post_meta($post->ID, "_mcf_technologie", false);
				 $clientname = get_post_meta($post->ID, "_mcf_client", true);

				?>
				<?php if( !empty($clientname ) ) // || && empty(get_post_meta($post->ID, "_mcf_technologie", false) ) {
				{ ?>
					<div class = "clientname">	
						<?php echo $clientname; ?> 
						<?php
						
						$tecnologies = $technologiesarrary[0];
						if (isset($tecnologies)) {
						foreach ($tecnologies as $technology ){
								echo "<br>".$technology;
							}
						}

					//	print_r( 		get_post_meta($post->ID, "_mcf_technologie", false) ) 
						?>
					</div>
				<?php } ?>
			</div>
			<?php wp_link_pages(); ?>
		</div><!--end entry-->
		<div class="post-footer">
			<div class="comments"><?php comments_popup_link(__( 'Leave a comment', 'dnet'), __( '1 Comment', 'dnet'), __ngettext ( '% Comment', '% Comments', get_comments_number (),'dnet')); ?></div>
		</div><!--end post footer-->
	</div><!--end post-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
	<div class="navigation index">
		<div class="alignleft"><?php next_posts_link(__( '&laquo; Oudere berichten', 'dnet')); ?></div>
		<div class="alignright"><?php previous_posts_link(__( 'Recentere berichten &raquo;', 'dnet')); ?></div>
	</div><!--end navigation-->
	<?php else : ?>
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>