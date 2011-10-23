<?php global $img; ?>
</div><!--end wrapper-->
</div><!--end content-background-->
<div id="footer">
	<div class="wrapper clear">
		<div id="footer-recent" class="footer-column">
		<h2>Recente Berichten</h2>
		<ul><?php wp_get_archives('title_li=&type=postbypost&limit=10'); ?></ul>
		</div>
		
		<div id="footer-flickr" class="footer-column">
			<?php if ($img->flickrState() == 'true') : ?>
				<ul>
					<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('footer_sidebar') ) : ?>
						<li class="widget widget_categories">
							<h2 class="widgettitle"><?php _e('Categories'); ?></h2>
							<ul>
								<?php wp_list_cats('sort_column=name&hierarchical=0'); ?>
							</ul>
						</li>
					<?php endif; ?>
				</ul>
			<?php else : ?>
				<h2><?php _e('Flickr', 'img'); ?></h2>
				<?php
					if ($img->flickrLink() != '') :
						$url = $img->flickrLink();
					else :
						$url = "http://www.flickr.com/badge_code_v2.gne?count=6&display=popular&size=s&layout=x&source=all_tag&tag=nature";
					endif;
				?>
				<?php
					$html = file_get_contents($url);
					preg_match_all("/<div.*div>/", $html, $matches);
						foreach($matches[0] as $div) {
							echo str_replace("></a>", "/></a>", $div);
						}
				?>
			<?php endif; ?>
		</div>
		<div id="footer-latest" class="footer-column">
			<?php /*<h2><?php _e('Search', 'img'); ?></h2>
			<?php if (is_file(STYLESHEETPATH . '/searchform.php')) include (STYLESHEETPATH . '/searchform.php'); else include(TEMPLATEPATH . '/searchform.php'); ?>
		</div> */ ?>
		<h2><?php _e('laatste werk', 'img'); ?></h2>
		<?php query_posts('cat=44&showposts=5'); ?>
		<?php while (have_posts()) : the_post(); ?>
		        <ul><li><a href="<?php the_permalink(); ?>">
		          <?php the_title(); ?>
		          </a>  </li></ul>
		        <?php endwhile; ?>
		</div>
	</div><!--end wrapper-->
</div><!--end footer-->


<div id="footer-bottom"> <!-- Footer Bottom -->
	<div class="wrapper footer-bottom-line clear">
		
		
		<div id="footer-bottom-center" class="footer-column">
			<p>Contact :</p>
			<?php echo $img->contactDetails(); ?>
		</div>
		<!-- <div id="footer-bottom-right" class="footer-column">
			<p>To Be determined</p>
		</div> -->
		<div id="follow" class="footer-column">
			<dl>
	          <dt><?php _e('Follow:', 'img') ?></dt>
				 <?php if ($img->twitterToggle() == 'true') : else : ?>
	              <dd><a class="twitter" href="<?php if ($img->twitter() !== '') echo $img->twitter(); else echo "#"; ?>">
				  <?php _e('', 'img') ?></a></dd>
				<?php endif; ?> 
	           
	            <?php if ($img->emailToggle() == 'true') : else : ?>
	              <dd><a class="email" href="<?php if ($img->feedEmail() !== '') echo $img->feedEmail(); else echo "#"; ?>"><?php _e('', 'img') ?></a></dd>
	            <?php endif; ?>

				 <dd><a class="rss" href="<?php bloginfo('rss2_url'); ?>">
				 <?php _e('', 'img') ?></a></dd>	
	            
				<?php if ($img->facebookToggle() == 'true') : else : ?>
	              <dd><a class="facebook" href="<?php if ($img->facebook() !== '') echo $img->facebook(); else echo "#"; ?>">
				  <?php _e('', 'img') ?></a></dd>
	            <?php endif; ?> 
	        </dl>
		</div>
		<div id="copyright">
			<p class="copyright-notice"><?php _e('Copyright', 'img'); ?> &copy; <?php echo date('Y'); ?> <?php echo $img->copyrightName(); ?>. <a href="http://themes.doede.net/"> img Theme</a> door <a href="http://doede.net">Doede.net www-Services</a>.  <a href="<?php bloginfo( 'url'); ?>/algemene-voorwaarden/algemene-voorwaarden-doedenet.pdf" class="av">Algemene Voorwaarden</a></p>
		</div><!--end copyright-->
	</div><!--end wrapper-->
</div><!--end footer-->
<?php wp_footer(); ?>
<?php
	if ($img->statsCode() != '') {
		echo $img->statsCode();
	}
?>
</body>
</html>