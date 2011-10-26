<?php
function seocentral(){
?>
Hello, world!<br />
Hello, world!<br />
Hello, world!
<?php
}
//add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
add_meta_box("seocentralid", __('Say Hello', 'yourplugin'), "seocentral", "yourplugin");
do_meta_boxes('yourplugin','advanced',null);
?>

<script type=javascript>
jQuery(document).ready( function($) {
	// close postboxes that should be closed
	jQuery('.if-js-closed').removeClass('if-js-closed').addClass('closed');

	// postboxes
	<?php
	global $wp_version;
	if(version_compare($wp_version,"2.7-alpha", "<")){
		echo "add_postbox_toggles('yourplugin_helloworld_meta_box');"; //For WP2.6 and below
	}
	else{
		echo "postboxes.add_postbox_toggles('seocentral');"; //For WP2.7 and above
	}
	?>

});
</script>
