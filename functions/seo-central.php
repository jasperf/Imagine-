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
        'seo-options' // On what Page?
    );
    add_meta_box(
        'myplugin_sectionid',
        __( 'My Post Section Title', 'seocentral_textdomain' ), 
        'seocentral_inner_custom_box',
        'seo-options'
    );
}

/* Prints the box content */
function seocentral_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'seocentral_noncename' );

  // The actual fields for data entry
  echo '<label for="seocentral_new_field">';
       _e("Description for this field", 'seocentral_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="seocentral_new_field" name="seocentral_new_field" value="whatever" size="25" />';
}

/* When the post is saved, saves our custom data */
function seocentral_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['seocentral_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data

  $mydata = $_POST['seocentral_new_field'];

  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}
?>