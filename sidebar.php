<?php global $img; ?>

<div id="sidebar">
	<?php //if ($img->sideboxState() != 'true' ) ?>
	<?php if ( is_active_sidebar( 'normal_sidebar' )) echo "<ul>" ?>
	<?php if ( !function_exists( 'dynamic_sidebar')|| !dynamic_sidebar( 'normal_sidebar' )) : ?>
	<?php if(!is_front_page()) : ?>
		<ul>
			<li class="widget widget_recent_entries">
			<h2 class="widgettitle"><?php _e( 'Interessante Links', 'img'); ?></h2>
			<?php
			// Array opsplitsen in lostaande elementen
			$bookm = explode("<br />",wp_list_bookmarks('title_li=&category_before=&category_after='));
			$bookm_n = count($bookm) - 1;
			// for loop + intitialize counter and limit things
			for ($i=0;$i<$bookm_n;$i++):
			if ($i<$bookm_n/2):
			$bookm_left = $bookm_left.'<li>'.$bookm[$i].'</li>';
			elseif ($i>=$bookm_n/2):
			$bookm_right = $bookm_right.'<li>'.$bookm[$i].'</li>';
			endif;
			endfor;
			?>
			<ul class="col-left">
			<?php echo $bookm_left;?>
			</ul>
			<ul class="col-right">
			<?php echo $bookm_right;?>
			</ul>
				
			</li>
			<?php endif; ?>
			<li class="widget widget_categories">
				<h2 class="widgettitle"><?php _e( 'Categories', 'img'); ?></h2>
				<?php
				// Array opsplitsen in lostaande elementen
				$cats = explode("<br />",wp_list_categories('title_li=&echo=0&depth=1&style=none'));
				$cat_n = count($cats) - 1;
				// for loop + intitialize counter and limit things
				for ($i=0;$i<$cat_n;$i++):
				if ($i<$cat_n/2):
				$cat_left = $cat_left.'<li>'.$cats[$i].'</li>';
				elseif ($i>=$cat_n/2):
				$cat_right = $cat_right.'<li>'.$cats[$i].'</li>';
				endif;
				endfor;
				?>
				<ul class="col-left">
				<?php echo $cat_left;?>
				</ul>
				<ul class="col-right">
				<?php echo $cat_right;?>
				</ul>
				
			</li>
		</ul> 
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'normal_sidebar' )) echo "</ul>"; ?>
</div><!--end sidebar-->
