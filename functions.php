<?php
/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}
/* 
 * Turns off the default options panel from Twenty Eleven
 */
 
add_action('after_setup_theme','remove_twentyeleven_options', 100);

function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}


//Set language folder and load textdomain
if (file_exists(STYLESHEETPATH . '/languages'))
	$language_folder = (STYLESHEETPATH . '/languages');
else
	$language_folder = (TEMPLATEPATH . '/languages');
load_theme_textdomain( 'img', $language_folder);

//Add support for post thumbnails
if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );
//	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );


// Dynamic Sidebars

if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'Sidebar', 'img'),
				'id' => 'normal_sidebar',
				'before_widget' => '<div class="page-sidebar"><li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
		));

    if ( function_exists( 'register_sidebar_widget' ))
    		register_sidebar(array(
    				'name'=> __( 'Footer Left', 'img'),
    				'id' => 'footer_left',
    				'before_widget' => '<li id="%1$s" class="widget %2$s">',
    				'after_widget' => '</li>',
    				'before_title' => '<h2>',
    				'after_title' => '</h2>',
    		));


    if ( function_exists( 'register_sidebar_widget' ))
    		register_sidebar(array(
    				'name'=> __( 'Footer Center', 'img'),
    				'id' => 'footer_center',
    				'before_widget' => '<li id="%1$s" class="widget %2$s">',
    				'after_widget' => '</li>',
    				'before_title' => '<h2>',
    				'after_title' => '</h2>',
    		));

if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'Footer Right', 'img'),
				'id' => 'footer_right',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h2>',
				'after_title' => '</h2>',
		));

// Homepage widgets
	

if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'Webdesign', 'img'),
				'id' => 'home_webdesign',
				'before_widget' => '<div id="webdesign-home-box"><li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li></div>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
		));		


if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'Tweets', 'img'),
				'id' => 'home_tweets',
				'before_widget' => '<div id="tweets-home-box"><li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li></div>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			));
							
// custom post type + menu item for it

//add dynamic menus
//Code http://www.1stwebdesigner.com/wordpress/how-to-add-backwards-compatible-wordpress-3-0-features-to-your-theme/

if (function_exists('wp_nav_menu')) {
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
register_nav_menus(
array(
'primary-menu' => __( 'Primary Menu' ),
'secondary-menu' => __('Secondary Menu'),
)
);
}
}

/*----------------------------------------
Slider Custom Post Type 
---------------------------------------------*/

add_action( 'init', 'create_slider' );
function create_slider() {
	register_post_type( 'img_slideshow',
		array(
			'labels' => array(
				'name' => __( 'Slides' ),
				'singular_name' => __( 'Slide' )
			),
		'public' => true,
		'show_ui' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'rewrite' => false,
    	'query_var' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		)
	);
}

/************************************************
Custom Header Image Code
Source: http://clark-technet.com/2012/04/wordpress-custom-headers-update-for-3-4
*************************************************/
add_action( 'after_setup_theme', 'theme_setup' );
 
function theme_setup() {
global $wp_version;
//Compare wp_version to know which way to add custom header support
if (version_compare($wp_version, '3.4' , '>=')){
add_theme_support( 'custom-header', array(
// Header image default
'default-image'	 => get_template_directory_uri() . '/images/headers/header.jpg',
// Header text display default
'header-text'	 => false,
// Header text color default
'default-text-color'	 => '000',
// Header image width (in pixels)
'width'	 => '1000',
// Header flex width changes width into suggested width
'flex-width' => true,
// Header image height (in pixels)
'height'	 => '200',
// Header flex height changes height into suggested height
'flex-height' => true,
// Header image random rotation default
'random-default'	 => true,
// Template header style callback
'wp-head-callback'	 => 'theme_header_style',
// Admin header style callback
'admin-head-callback'	 => 'theme_admin_header_style',
// Admin preview style callback
'admin-preview-callback'	=> 'theme_admin_header_image'
) );
} else {
add_theme_support( 'custom-header', array( 'random-default' => true ) );
//WP Custom Header - random rotation by default
define( 'HEADER_TEXTCOLOR', '' );
define( 'HEADER_IMAGE', '' );
define( 'HEADER_IMAGE_HEIGHT', '200' );
define( 'HEADER_IMAGE_WIDTH', '1000' );
define('NO_HEADER_TEXT', true );
add_custom_image_header( 'theme_header_style', 'theme_admin_header_style', 'theme_admin_header_image' );
}
register_default_headers( array(
'header' => array(
'url' => '%s/images/headers/header.jpg',
'thumbnail_url' => '%s/images/headers/header-thumbnail.jpg',
'description' => 'Header Image 1'
)
) );
}

//http://codex.wordpress.org/Adding_Administration_Menus
//<?php add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
add_action( 'admin_menu'  , 'my_plugin_menu' );

function my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

// Register Custom Navigation Walker
//https://github.com/twittem/wp-bootstrap-navwalker
//require_once('inc/twitter_bootstrap_nav_walker.php');
?>