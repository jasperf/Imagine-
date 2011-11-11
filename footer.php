<?php global $img; ?>
</div><!--end wrapper-->
</div><!--end content-background-->
<div id="footer">
	<div class="wrapper clear">
		<div id="footer-recent" class="footer-column">
		<h2>Recente Berichten</h2>
		<ul><?php wp_get_archives('title_li=&type=postbypost&limit=10'); ?></ul>
		</div>  <!-- footer recent -->
		</div>  <!-- end wrapper -->
		</div> <!-- end footer -->
</body>
</html>