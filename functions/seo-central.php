<?php
/*Sources used: http://andrewferguson.net/2008/09/26/using-add_meta_box/
*/

//add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
add_meta_box("seocentral_helloworld", //Id
    		__('Say Hello', 'yourplugin'), //Title
			 "seocentral_helloworld_meta_box", // Callback
			 "seocentral"); // Page ?
			
//do_meta_boxes('page', 'context', 'object')
do_meta_boxes('seocentral', // page
			'advanced', //context
			null); // object??
			
//Content inside box called using callback
	function seocentral_helloworld_meta_box($gegevens){
	?>
		Hello, world!
		<?php
		}

?>