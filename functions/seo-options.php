<?php

/*
Plugin Name: Custom Meta tags
Plugin URI: http://imagewize.com
Description: Allows Meta data to be added to the header meta description and meta keywords
Version: 1.0
License: This code is licensed under the GPL v2.0 http://www.opensource.org/licenses/gpl-2.0.php
Author: Jasper Frumau
Based on http://sltaylor.co.uk/blog/control-your-own-wordpress-custom-fields/ and http://wefunction.com/2009/10/revisited-creating-custom-write-panels-in-wordpress/
/* ----------------------------------------------*/
if ( !class_exists('mySeoOptions') ) {

        class mySeoFields {
	
                /**
                * @var  string  $prefix  The prefix for storing custom fields in the postmeta table
                */
                var $prefix = '_img_';
                /**
                * @var  array  $seoFields  Defines the custom fields available and stores them in an array
                */
				var $postTypes = array( "page", "post" ); 
				
                var $seoFields =     array(
                        array(
                                "name"                  => "meta-keywords",
                                "title"                 => "Meta Keywords",
                                "description"   		=> "Voeg Meta sleutelwoorden hier in",
                                "type"                  => "text",
                                "scope"                 =>      array( "page","post" ),
                                "capability"    		=> "edit_pages"
                        ),
  						array(
								"name"                  => "meta-description",
                                "title"         		=> "Meta Description",
                                "description"   		=> "Voeg de meta beschrijving hier toe",
                                "type"          		=> "text",
                                "scope"                 =>      array( "page","post" ),
                                "capability"    		=> "edit_pages"
                        )
);

			/**
			* PHP 4 Compatible Constructor 
			*/
			function mySeoFields() { $this->__construct(); }
			/**
			* PHP 5 Constructor to be initiated for any object
			*/
		function __construct() {
        add_action( 'admin_menu', array( &$this, 'createSeoFields' ) );
        add_action( 'save_post', array( &$this, 'saveSeoFields' ), 1, 2 );
        // Comment this line out if you want to keep default custom fields meta box
        add_action( 'do_meta_boxes', array( &$this, 'removeDefaultSeoFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function removeDefaultSeoFields( $type, $context, $post ) {
        foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
                remove_meta_box( 'postcustom', 'post', $context );
                remove_meta_box( 'postcustom', 'page', $context );
         //Use the line below instead of the line above for WP versions older than 2.9.1
         //remove_meta_box( 'pagecustomdiv', 'page', $context );
        	}
	}
	/**
	* Create the new SEO Options meta box
	*/
	function createSeoFields() {
        if ( function_exists( 'add_meta_box' ) ) {
 
				//SEO Options Custom Fields Container added
				add_meta_box( 'my-seo-fields', 'SEO Opties', array( &$this, 'displaySeoFields' ), 'post', 'normal', 'high' );
                add_meta_box( 'my-seo-fields', 'SEO Opties', array( &$this, 'displaySeoFields' ), 'page', 'normal', 	'high' );
        }
}

 /**
    * Display the new SEO Fields meta box
    */
    function displaySeoFields() {
            global $post;
            ?>
            <div class="form-wrap">
                    <?php
                    wp_nonce_field( 'my-seo-fields', 'my-seo-fields_wpnonce', false, true );
                    foreach ( $this->seoFields as $seoField ) {
                            // Check scope
                            $scope = $seoField[ 'scope' ];
                            $output = false;
                            foreach ( $scope as $scopeItem ) {
                                    switch ( $scopeItem ) {
                                            case "post": {
                                                    // Output on any post screen
                                                   if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || 											$post->post_type=="post" )
                                                           $output = true;
                                                    break;
                                           }
                                                    case "portfolio": {
                                                            // Output on any portfolio page
                                                            if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="portfolio" )
                                                                    $output = true;
                                                            break;
                                                    }
                                            case "page": {
                                                    // Output on any page screen
                                                    if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="page-new.php" || $post->post_type=="page" )
                                                            $output = true;
                                                    break;
                                            }
                                           
                                    }
                                    if ( $output ) break;
                            }
                            // Check capability
                            if ( !current_user_can( $seoField['capability'], $post->ID ) )
                                    $output = false;
                            // Output if allowed
                            if ( $output ) { ?>
                                    <div class="form-field form-required">
                                            <?php
                                            switch ( $seoField[ 'type' ] ) {
                                                    case "checkbox": {
                                                            // Checkbox
                                                            echo '<label for="' . $this->prefix . $seoField[ 'name' ] .'" style="display:inline;"><b>' . $seoField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
                                                            echo '<input type="checkbox" name="' . $this->prefix . $seoField['name'] . '" id="' . $this->prefix . $seoField['name'] . '" value="yes"';
                                                            if( get_post_meta( $post->ID, $this->prefix . $seoField['name'], true ) == "yes" )
                                                                    echo ' checked="checked"';
                                                            echo '" style="width: auto;" />';
                                                            break;
                                                    }
                                                    case "checkboxes": {
                                                     // Checkboxes Technology  technologie

													echo '<label for="' . $this->prefix . $seoField[ 'name' ] .'" style="display:inline;"><b>' . $seoField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
                                                    $posted_values = get_post_meta( $post->ID, $this->prefix . $seoField['name'], true);
													foreach($seoField[ 'options' ] as $value){
                                                            echo  '<input style="width: auto;margin:0 5px;" type="checkbox" value="'. $value . '" name="' .  $this->prefix .$seoField['name'] . '[]"';

																if(is_array($posted_values)){
																	if(in_array($value, $posted_values)){
																		echo ' checked="checked"';
																	}
																}

                                                    echo  '>' .$value . '</input>'."\n";};
                                                    break;
                                                     }
                                           
                                                    case "textarea": {
                                                            // Text area
                                                            echo '<label for="' . $this->prefix . $seoField[ 'name' ] .'"><b>' . $seoField[ 'title' ] . '</b></label>';
                                                            echo '<textarea name="' . $this->prefix . $seoField[ 'name' ] . '" id="' . $this->prefix . $seoField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $seoField[ 'name' ], true ) ) . '</textarea>';
                                                            break;
                                                    }
                                                    case "dropdown": {
                                                    // Dropdown for online or offline website indication
                                                    echo '<label for="' . $this->prefix . $seoField[ 'name' ] .'"><b>' . $seoField[ 'title' ] . '</b></label>';
                                                    echo '<select name="' . $this->prefix . $seoField[ 'name' ] . '"><option value="0">Choose site status</option>';
                                                    foreach($seoField[ 'options' ] as $value){        

                                                    if ( get_post_meta( $post->ID, $this->prefix . $seoField['name'], true ) == $value ) $selected = "selected=\"selected\"";
													else $selected ="";

                                                    echo  '<option value="'.$value.'"'.$selected.'">' .$value . '</option>'."\n";}
                                                    echo "</select>";
                                                            break;
                                                    }
                                                    default: {
                                                            // Plain text field
                                                            echo '<label for="' . $this->prefix . $seoField[ 'name' ] .'"><b>' . $seoField[ 'title' ] . '</b></label>';
                                                            echo '<input type="text" name="' . $this->prefix . $seoField[ 'name' ] . '" id="' . $this->prefix . $seoField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $seoField[ 'name' ], true ) ) . '" />';
                                                            break;
                                                    }
                                            }
                                                   
                                            ?>
                                            <?php if ( $seoField[ 'description' ] ) echo '<p>' . $seoField[ 'description' ] . '</p>'; ?>
                                    </div>
                            <?php
                            }
                    } ?>
            </div>
            <?php
    }
    /**
    * Save the new Custom Fields values
    */
    function saveSeoFields( $post_id, $post ) {
            if ( !wp_verify_nonce( $_POST[ 'my-seo-fields_wpnonce' ], 'my-seo-fields' ) )
                    return;
            if ( !current_user_can( 'edit_post', $post_id ) )
                    return;
            if ( $post->post_type != 'page' && $post->post_type != 'post' && $post->post_type != 'portfolio' )
                    return;
				
				
		
				foreach ( $this->seoFields as $seoField ) {
				
				
					if ( current_user_can( $seoField['capability'], $post_id ) ) {
					    //&& trim( $_POST[ $this->prefix . $seoField['name'] ]
						if ( isset( $_POST[ $this->prefix . $seoField['name'] ] )  ) {
							update_post_meta( $post_id, $this->prefix . $seoField[ 'name' ], $_POST[ $this->prefix . $seoField['name'] ] );

						} else {
							delete_post_meta( $post_id, $this->prefix . $seoField[ 'name' ] );

						}
					}
			
				}
    }

} // End Class

} // End if class exists statement


// Instantiate the class
if ( class_exists('mySeoFields') ) {
$mySeoFields_var = new mySeoFields();
}


// End SEO
?>