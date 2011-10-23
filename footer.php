<?php global $dnet; ?>
</div><!--end wrapper-->
</div><!--end content-background-->
<div id="footer">
	<div class="wrapper clear">
		<div id="footer-recent" class="footer-column">
		<h2>Recente Berichten</h2>
		<ul><?php wp_get_archives('title_li=&type=postbypost&limit=10'); ?></ul>
		</div>
		
		<div id="footer-flickr" class="footer-column">
			<?php if ($dnet->flickrState() == 'true') : ?>
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
				<h2><?php _e('Flickr', 'dnet'); ?></h2>
				<?php
					if ($dnet->flickrLink() != '') :
						$url = $dnet->flickrLink();
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
			<?php /*<h2><?php _e('Search', 'dnet'); ?></h2>
			<?php if (is_file(STYLESHEETPATH . '/searchform.php')) include (STYLESHEETPATH . '/searchform.php'); else include(TEMPLATEPATH . '/searchform.php'); ?>
		</div> */ ?>
		<h2><?php _e('laatste werk', 'dnet'); ?></h2>
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
			<?php echo $dnet->contactDetails(); ?>
		</div>
		<!-- <div id="footer-bottom-right" class="footer-column">
			<p>To Be determined</p>
		</div> -->
		<div id="follow" class="footer-column">
			<dl>
	          <dt><?php _e('Follow:', 'dnet') ?></dt>
				 <?php if ($dnet->twitterToggle() == 'true') : else : ?>
	              <dd><a class="twitter" href="<?php if ($dnet->twitter() !== '') echo $dnet->twitter(); else echo "#"; ?>">
				  <?php _e('', 'dnet') ?></a></dd>
				<?php endif; ?> 
	           
	            <?php if ($dnet->emailToggle() == 'true') : else : ?>
	              <dd><a class="email" href="<?php if ($dnet->feedEmail() !== '') echo $dnet->feedEmail(); else echo "#"; ?>"><?php _e('', 'dnet') ?></a></dd>
	            <?php endif; ?>

				 <dd><a class="rss" href="<?php bloginfo('rss2_url'); ?>">
				 <?php _e('', 'dnet') ?></a></dd>	
	            
				<?php if ($dnet->facebookToggle() == 'true') : else : ?>
	              <dd><a class="facebook" href="<?php if ($dnet->facebook() !== '') echo $dnet->facebook(); else echo "#"; ?>">
				  <?php _e('', 'dnet') ?></a></dd>
	            <?php endif; ?> 
	        </dl>
		</div>
		<div id="copyright">
			<p class="copyright-notice"><?php _e('Copyright', 'dnet'); ?> &copy; <?php echo date('Y'); ?> <?php echo $dnet->copyrightName(); ?>. <a href="http://themes.doede.net/"> DNET Theme</a> door <a href="http://doede.net">Doede.net www-Services</a>.  <a href="<?php bloginfo( 'url'); ?>/algemene-voorwaarden/algemene-voorwaarden-doedenet.pdf" class="av">Algemene Voorwaarden</a></p>
		</div><!--end copyright-->
	</div><!--end wrapper-->
</div><!--end footer-->
<?php wp_footer(); ?>
<?php
	if ($dnet->statsCode() != '') {
		echo $dnet->statsCode();
	}
?>
</body>
</html>