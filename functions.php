<?php


define('TEMPLATEPATH', dirname(__FILE__ ) );

require_once( TEMPLATEPATH . '/functions/seo-options.php');
require_once( TEMPLATEPATH . '/functions/img-options.php');
require_once( TEMPLATEPATH . '/functions/meta-boxes.php');
require_once( TEMPLATEPATH . '/functions/custom-posts.php');

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

//Redirect to theme options page on activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect( 'themes.php?page=img-admin.php');

// Required functions
if (is_file(STYLESHEETPATH . '/functions/comments.php'))
	require_once(STYLESHEETPATH . '/functions/comments.php');
else
	require_once(TEMPLATEPATH . '/functions/comments.php');


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
				'name'=> __( 'Footer', 'img'),
				'id' => 'footer_sidebar',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h2 class="widgettitle">',
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
				'name'=> __( 'CMS', 'img'),
				'id' => 'home_cms',
				'before_widget' => '<div id="cms-home-box"><li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li></div>',
				'before_title' => '<h2 class="widgettitle">',
					'after_title' => '</h2>',
		));

if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'SEO', 'img'),
				'id' => 'home_seo',
				'before_widget' => '<div id="seo-home-box"><li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li></div>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
			));			
if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'Referenties', 'img'),
				'id' => 'home_referenties',
				'before_widget' => '<div id="referenties-home-box"><li id="%1$s" class="widget %2$s">',
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

// Fire this during init
sd_register_post_type('portfolio', array(
	'label' => __('Portfolio'),
	'singular_label' => __('Portfolio'),
	'rewrite' => true,
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,

	'query_var' => false,
	'supports' => array('title', 'editor', 'author' )
));


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



?>