<?php get_header(); ?>

	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-header">
				<div class="tags"><?php the_tags( '<span>Tags</span> <p>', ', ', '</p>'); ?></div>
				<h1><?php the_title(); ?></h1>
				<div class="author"><?php printf(__( 'by %s on', 'dnet'), get_the_author()); ?> <?php the_time(__( 'j F   Y', 'dnet')); ?></div>
			</div><!--end post header-->
			<div class="entry clear">
			<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail( array(250,9999), array( 'class' => ' alignleft border' )); ?>
				<?php //the_content(__( 'read more...', 'dnet')); 
					 $content = get_the_content(); 
					 _e( $content );

				?>
				<?php 
				 $technologiesarrary = get_post_meta($post->ID, "_mcf_technologie", false);
				 $clientname = get_post_meta($post->ID, "_mcf_client", true);
				 $online =  get_post_meta($post->ID, "_mcf_online", true); 

				?>
				<?php if( !empty($clientname ) ) // || && empty(get_post_meta($post->ID, "_mcf_technologie", false) ) {
				{ ?>
					<div class = "clientname">	
						<div class = "customfieldhead">
							<?php _e("Client Name");?>
						</div>

						<div class="customfieldcontent"> <?php echo $clientname; ?> </div>
						<div class = "customfieldhead">
							<?php _e("Technology");?>
						</div>

						<div class="customfieldcontent">
							<?php
							
							$tecnologies = $technologiesarrary[0];
							if (isset($tecnologies)) {
							$flag = 0;
							foreach ($tecnologies as $technology ){
								if( $flag==0 ) {echo $technology; $flag = 1;}
								else echo ",".$technology;
								}
							}
							//	print_r( 		get_post_meta($post->ID, "_mcf_technologie", false) ) 
							?>
						</div>

						<div class = "customfieldhead">
							<?php _e("Status");?>
						</div>

						<div class="customfieldcontent"> <?php echo $online; ?> </div>

						
					</div>
				<?php } ?>
				<?php  
						$plugincontent = "";
						$plugincontent = apply_filters('the_content', $plugincontent);
						$plugincontent = str_replace(']]>', ']]&gt;', $plugincontent);
						_e( $plugincontent );


				?>
				<?php edit_post_link(__( 'Edit', 'dnet')); ?>
				<?php wp_link_pages(); ?>
			</div><!--end entry-->
			<div class="meta clear">
				<p><?php _e( 'From', 'dnet' ); ?> &rarr; <?php the_category( ', '); ?>dfgfdh</p>
			</div><!--end meta-->
		</div><!--end post-->
	<?php endwhile; /* rewind or continue if all posts have been fetched */ ?>
		<?php comments_template( '', true); ?>
	<?php else : ?>
	<?php endif; ?>
</div><!--end content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>