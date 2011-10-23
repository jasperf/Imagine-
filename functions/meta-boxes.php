<?php

/*
Plugin Name: Custom Write Panel
Plugin URI: http://imagewize.net
Description: Allows custom fields to be added to a WordPress Post, Page or Custom Post Type
Version: 1.1
License: This code is licensed under the GPL v2.0 http://www.opensource.org/licenses/gpl-2.0.php
Author: Jasper Frumau
Based on http://sltaylor.co.uk/blog/control-your-own-wordpress-custom-fields/ and http://wefunction.com/2009/10/revisited-creating-custom-write-panels-in-wordpress/
/* ----------------------------------------------*/

if ( !class_exists('myCustomFields') ) {

        class myCustomFields {
	
                /**
                * @var  string  $prefix  The prefix for storing custom fields in the postmeta table
                */
                var $prefix = '_mcf_';
                /**
                * @var  array  $customFields  Defines the custom fields available
                */
                var $customFields =     array(
                        array(
                                "name"                  => "large-image",
                                "title"                 => "Eerste grote afbeelding (afmeting 325x200)",
                                "description"   		=> "Voeg de afbeelding toe via de media uploader en plaats hier de link",
                                "type"                  => "text",
                                "scope"                 =>      array( "portfolio","post" ),
                                "capability"    		=> "edit_pages"
                        ),
					array(
                            "name"                  => "small-image-1",
                            "title"                 => "Eerste kleine afbeelding (afmeting 100x75)",
                            "description"   => "Voeg de afbeelding toe via de media uploader en plaats hier de link",
                            "type"                  => "text",
                            "scope"                 =>      array( "portfolio","post" ),
                            "capability"    => "edit_pages"
                    ),
				array(
                        "name"                  => "small-image-2",
                        "title"                 => "Tweede kleine afbeelding (afmeting 100x75)",
                        "description"   => "Voeg de afbeelding toe via de media uploader en plaats hier de link",
                        "type"                  => "text",
                        "scope"                 =>      array( "portfolio","post" ),
                        "capability"    => "edit_pages"
                ),
                        /*array(
                                "name"                  => "block-of-text",
                                "title"                 => "A block of text",
                                "description"   => "",
                                "type"                  => "textarea",
                                "scope"                 =>      array( "page" ),
                                "capability"    => "edit_pages"
                        ), */
                        array(
                                "name"                  => "checkbox",
                                "title"                 => "Checkbox",
                                "description"   => "",
                                "type"                  => "checkbox",
                                "scope"                 =>      array( "post","page" ),
                                "capability"    => "manage_options"
                        ), 
                        array(
                                "name"                  => "client",
                                "title"                 => "Naam client",
                                "description"   => "De naam van de client",
                                "type"                  =>      "text",
                                "scope"                 =>      array( "portfolio" ,"post" ),
                                "capability"    => "edit_posts"
                                ),
                        array(
                                "name"                  => "technologie",
                                "title"                 => "Technologie",
                                "description"   => "Welke technologie of technieken en eventuele CMS zijn gebruikt bij het ontwerpen van dit projects",
                                "options"               => array("XHTML", "CSS", "JavaScript", "Jquery", "Flash", "Joomla", "Wordpress", "Magento"),
                                "type"                  =>      "checkboxes",
                                "scope"                 =>      array( "portfolio", "post" ),
                                "capability"    => "edit_posts"
                        ),
               
                        array(
                                "name"                  => "online",
                                "title"                 => "Online of Offline",
                                "description"   => "Is de website online en actief?",
                                "type"                  =>      "dropdown",
                                "options"               => array( "online", "offline"),
                                "scope"                 =>      array( "portfolio", "post" ),
                                "capability"    => "edit_posts"
                                )
                               
                );
                /**
                * PHP 4 Compatible Constructor
                */
                function myCustomFields() { $this->__construct(); }
                /**
                * PHP 5 Constructor
                */
                function __construct() {
                        add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
                        add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );
                        // Comment this line out if you want to keep default custom fields meta box
                        add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
                }
                /**
                * Remove the default Custom Fields meta box
                */
                function removeDefaultCustomFields( $type, $context, $post ) {
                        foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
                                remove_meta_box( 'postcustom', 'post', $context );
                                remove_meta_box( 'postcustom', 'page', $context );
                                //Use the line below instead of the line above for WP versions older than 2.9.1
                                //remove_meta_box( 'pagecustomdiv', 'page', $context );
                        }
                }
                /**
                * Create the new Custom Fields meta box
                */
                function createCustomFields() {
                        if ( function_exists( 'add_meta_box' ) ) {
                                //add_meta_box( 'my-custom-fields', 'Portfolio', array( &$this, 'displayCustomFields' ), 'page', 'normal', 'high' );
                               // add_meta_box( 'my-custom-fields', 'Portfolio', array( &$this, 'displayCustomFields' ), 'post', 	'normal', 'high' );
								//SEO Options Custom Fields Container added
								//add_meta_box( 'my-seo-options', 'SEO Options', array( &$this, 'displaySeoOptions' ), 'post', 'normal', 'high' );
                                add_meta_box( 'my-custom-fields', 'Portfolio Details', array( &$this, 'displayCustomFields' ), 'portfolio', 'normal', 'high' );
                        }
                }
                /**
                * Display the new Custom Fields meta box
                */
                function displayCustomFields() {
                        global $post;
                        ?>
                        <div class="form-wrap">
                                <?php
                                wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
                                foreach ( $this->customFields as $customField ) {
                                        // Check scope
                                        $scope = $customField[ 'scope' ];
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
                                        if ( !current_user_can( $customField['capability'], $post->ID ) )
                                                $output = false;
                                        // Output if allowed
                                        if ( $output ) { ?>
                                                <div class="form-field form-required">
                                                        <?php
                                                        switch ( $customField[ 'type' ] ) {
                                                                case "checkbox": {
                                                                        // Checkbox
                                                                        echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
                                                                        echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
                                                                        if( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
                                                                                echo ' checked="checked"';
                                                                        echo '" style="width: auto;" />';
                                                                        break;
                                                                }
                                                                case "checkboxes": {
                                                                 // Checkboxes Technology  technologie

																echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
                                                                $posted_values = get_post_meta( $post->ID, $this->prefix . $customField['name'], true);
																foreach($customField[ 'options' ] as $value){
                                                                        echo  '<input style="width: auto;margin:0 5px;" type="checkbox" value="'. $value . '" name="' .  $this->prefix .$customField['name'] . '[]"';

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
                                                                        echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                                                        echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
                                                                        break;
                                                                }
                                                                case "dropdown": {
                                                                // Dropdown for online or offline website indication
                                                                echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                                                echo '<select name="' . $this->prefix . $customField[ 'name' ] . '"><option value="0">Choose site status</option>';
                                                                foreach($customField[ 'options' ] as $value){        
 
                                                                if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == $value ) $selected = "selected=\"selected\"";
																else $selected ="";
 
                                                                echo  '<option value="'.$value.'"'.$selected.'">' .$value . '</option>'."\n";}
                                                                echo "</select>";
                                                                        break;
                                                                }
                                                                default: {
                                                                        // Plain text field
                                                                        echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                                                        echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
                                                                        break;
                                                                }
                                                        }
                                                               
                                                        ?>
                                                        <?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
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
                function saveCustomFields( $post_id, $post ) {
                        if ( !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
                                return;
                        if ( !current_user_can( 'edit_post', $post_id ) )
                                return;
                        if ( $post->post_type != 'page' && $post->post_type != 'post' && $post->post_type != 'portfolio' )
                                return;
							
							
					
							foreach ( $this->customFields as $customField ) {
							
							
								if ( current_user_can( $customField['capability'], $post_id ) ) {
								    //&& trim( $_POST[ $this->prefix . $customField['name'] ]
									if ( isset( $_POST[ $this->prefix . $customField['name'] ] )  ) {
										update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $_POST[ $this->prefix . $customField['name'] ] );

									} else {
										delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );

									}
								}
						
							}
                }
 
        } // End Class
 
} // End if class exists statement


// Instantiate the class
if ( class_exists('myCustomFields') ) {
	$myCustomFields_var = new myCustomFields();
}


// End Custom write panel
?>