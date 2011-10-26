<?php
/*
*Plugin: SEO Central
*Inspiration http://andrewferguson.net/2008/09/26/using-add_meta_box/
*/

//ensure, that the needed javascripts been loaded to allow drag/drop, expand/collapse and hide/show of boxes
wp_enqueue_script('common');
wp_enqueue_script('wp-lists');
wp_enqueue_script('postbox');

//add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );

add_meta_box('seo-sidebox-zero', //Id
			__('Say Hello', 'seocentral'), //Title
			 array(&$this, 'on_seo_sidebox_3_content'), // Callback to method in img-options
			'seocentral', // Page
			'normal',
			'core');
add_meta_box('seo-sidebox-1', //Id
			__('Say Hello', 'seocentral'), //Title
			 array(&$this, 'on_seo_sidebox_1_content'), // Callback to method in img-options
			'seocentral', // Page
			'side',
			'core');
add_meta_box('seo-sidebox-2', //Id
			__('Say dfa', 'seocentral'), //Title
			array(&$this, 'on_seo_sidebox_2_content'), //callback
			'seocentral', //page
			'side', //context
			'core'); // Piority: low, high, core or default
									
//do_meta_boxes('page', 'context', 'object') ?>
<div class="wrap">
<!-- Main two column box after wrapper -->
	<div id="post-stuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">

<!-- Whole width Column -->
<div id="post-body" class="has-sidebar">
<div id="post-body-content" class="has-sidebar-content">
	<?php
	do_meta_boxes('seocentral', // page or name box as defined
				'normal', //context side
				null); // object??
				?>
				</div>
<div class="has-right-sidebar">
<div id="side-info-column" class="inner-sidebar">
	<?php
	do_meta_boxes('seocentral', // page
				'side', //context
				null); // object??
				?>
				</div>
				</div>
			</div>
			</div>
			<script type="text/javascript">
				//<![CDATA[
				jQuery(document).ready( function($) {
					// close postboxes that should be closed
					$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
					// postboxes setup
					postboxes.add_postbox_toggles('<?php echo 'seocentral'; ?>');
				});
				//]]>
			</script>