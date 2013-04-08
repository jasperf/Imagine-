<?php global $img; ?>
</div><!--end wrapper-->
</div><!--end content-background-->
<div id="footer">
	<div class="wrapper clear">
		<div id="footer-recent" class="footer-column">
		<?php if ( !dynamic_sidebar('footer_left') ) : ?>
		<h2>Recente Berichten</h2>
		<ul><?php wp_get_archives('title_li=&type=postbypost&limit=10'); ?></ul>
		<?php endif; ?>
		</div>  <!-- footer Recent -->
		  <div id="footer-bookmarks" class="footer-column">
		  <?php if ( !dynamic_sidebar('footer_center') ) : ?>
  		<h2>Interesting Links</h2>
  		<ul><?php wp_list_bookmarks('title_li=&categorize=0'); ?></ul>
  		<?php endif; ?>
  		</div>  <!-- footer bookmarks -->
  		<div id="footer-get-connected" class="footer-column">
  		  <?php if ( !dynamic_sidebar('footer_right') ) : ?>
           <h2>Get Connected</h2>
       		<ul>
       		<li>Twitter</li>
       		<li><a href="http://www.facebook.com/Imagewize">Facebook</a></li></ul>
        <?php endif; ?>
  		</div>  <!-- footer connect -->
		</div>  <!-- end wrapper -->
		</div> <!-- end footer -->
		<!-- Bootstrap Javascripts -->
		  <?php
         /* Always have wp_footer() just before the closing </body>
          * tag of your theme, or you will break many plugins, which
          * generally use this hook to reference JavaScript files.
          */
          wp_footer();
      ?>    
</body>
</html>