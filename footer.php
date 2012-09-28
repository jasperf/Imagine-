<?php global $img; ?>
</div><!--end wrapper-->
</div><!--end content-background-->
<div id="footer">
	<div class="wrapper clear">
		<div id="footer-recent" class="footer-column">
		<h2>Recente Berichten</h2>
		<ul><?php wp_get_archives('title_li=&type=postbypost&limit=10'); ?></ul>
		</div>  <!-- footer Recent -->
		  <div id="footer-bookmarks" class="footer-column">
  		<h2>Interesting Links</h2>
  		<ul><?php wp_list_bookmarks('title_li=&categorize=0'); ?></ul>
  		</div>  <!-- footer bookmarks -->
  		<div id="footer-get-connected" class="footer-column">
  		<h2>Get Connected</h2>
  		<ul>
  		<li>Twitter</li>
  		<li><a href="http://www.facebook.com/Imagewize">Facebook</a></li></ul>
  		</div>  <!-- footer connect -->
		</div>  <!-- end wrapper -->
		</div> <!-- end footer -->
</body>
</html>