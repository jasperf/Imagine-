<?php get_header(); ?>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<?php //echo add_smartsharing();?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<div class="entry clear">
			<iframe src="http://www.facebook.com/plugins/like.php?&locale=en_US&href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=standard&amp;show_faces=false&amp;width=350&amp;action=recommend&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:350px; height:25px"></iframe>
			<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
			   <a href="http://twitter.com/share" class="twitter-share-button"
			      data-url="<?php the_permalink(); ?>"
			      data-via="jasperfrumau"
			      data-text="<?php the_title(); ?>"
			      data-count="horizontal">Tweet</a>
					<div class="post-header">
						<div class="tags"><?php the_tags( '<span>Tags</span> <p>', ', ', '</p>'); ?></div>
						<h1><?php the_title(); ?></h1>

					</div><!--end post header-->
				<div id = "featureimage">
				<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail( array(250,9999), array( 'class' => ' alignleft' )); ?>
				</div>
				
				<?php the_content(__( 'read more...', 'img')); 
						// $content = get_the_content(); 
						// _e( $content );
				?>
				<div id = "singlecontent" class ="alignleft" >
					
				
					<div class="author" >
					
					<strong> <?php   printf(__( 'Published By %s', 'img'), get_the_author()); ?></strong> op <strong><?php the_time(__( 'l j F   Y', 'img')); ?></strong>
					<br>
					<?php the_author_description();?>
					</div>
					<!-- <div class="postauthor "><?php echo get_the_author().'::'; the_author_description(); ?></div> -->

					<?php wp_link_pages(); ?>
				</div>
			</div><!--end entry-->
			<div class="meta clear">
				<p><?php _e( 'From', 'img' ); ?> &rarr; <?php the_category( ', '); ?></p>
			</div><!--end meta-->
		</div><!--end post-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<?php comments_template( '', true); ?>
	<?php else : ?>
	<?php endif; ?>
</div><!--end content-->
<?php get_footer(); ?>