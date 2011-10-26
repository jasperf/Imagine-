<?php

//add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
//define custom box

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'seocentral_add_custom_box', 1 );

/* Do something with the data entered */
add_action( 'save_post', 'seocentral_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function seocentral_add_custom_box() {
    add_meta_box( 
        'seocentral_sectionid', // HTML ID
        __( 'My Post Section Title', 'seocentral_textdomain' ), // Title
        'myplugin_inner_custom_box', // call back
        'post' // On what Page?
    );
    add_meta_box(
        'myplugin_sectionid',
        __( 'My Post Section Title', 'seocentral_textdomain' ), 
        'seocentral_inner_custom_box',
        'page'
    );
}
