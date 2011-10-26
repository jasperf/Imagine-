<?php
/*
*Plugin: SEO Central
*Inspiration http://andrewferguson.net/2008/09/26/using-add_meta_box/
*/


//add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
add_meta_box('seo-sidebox-1', //Id
			__('Say Hello', 'seocentral'), //Title
			 array(&$this, 'on_sidebox_1_content'), // Callback
			'seocentral', // Page
			'side',
			'core');
add_meta_box('seo-sidebox-2', //Id
			__('Say dfa', 'seocentral'), //Title
			array(&$this, 'on_sidebox_2_content'), //callback
			'seocentral', //page
			'side', //context
			'core'); // Piority: low, high, core or default
									
//do_meta_boxes('page', 'context', 'object') ?>
<div class="wrap">
	<div id="post-stuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
<div id="side-info-column" class="inner-sidebar">
	<?php
	do_meta_boxes('seocentral', // page or name box as defined
				'side', //context side
				null); // object??
				?>
				</div>
				</div>
<div class="metabox-holder has-right-sidebar">
<div id="side-info-column" class="inner-sidebar">
	<?php
	do_meta_boxes('seocentral', // page
				'side', //context
				null); // object??
				?>
				</div>

			</div>
<?php
			
//Content inside box called using callback
	function seocentral_helloworld_meta_box(){
	?>
		Hello, world!
		<?php
		}

		//Content inside box called using callback
			function on_sidebox_1_content(){
			?>
				Hello, world!
				<?php
				}
?>