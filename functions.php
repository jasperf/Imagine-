<?php
if ( !function_exists( 'optionsframework_init' ) ) {

/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
} else {
	define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
}

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>

<?php
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

?>