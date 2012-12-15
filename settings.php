 <?php 
 // ------------------------------------------------------------------
 // Add all your sections, fields and settings during admin_init
 // ------------------------------------------------------------------
 //
 
 function img_settings_api_init() {
 	// Add the section to reading settings so we can add our
 	// fields to it
 	//add_settings_section($id, $title, $callback, $page)
 	add_settings_section('img_setting_section',
		'Example settings section in reading',
		'img_setting_section_callback_function',
		'reading');
 	
 	// Add the field with the names and function to use for our new
 	// settings, put it in our new section
 	//add_settings_field($id, $title, $callback, $page, $section = 'default', $args = array())
 	add_settings_field('img_setting_name',
		'Example setting Name',
		'img_setting_callback_function',
		'reading',
		'img_setting_section');
 	
 	// Register our setting so that $_POST handling is done for us and
 	// our callback function just has to echo the <input>
 	register_setting('reading','img_setting_name');
 }// eg_settings_api_init()
 
 add_action('admin_init', 'img_settings_api_init');
 
  
 // ------------------------------------------------------------------
 // Settings section callback function
 // ------------------------------------------------------------------
 //
 // This function is needed if we added a new section. This function 
 // will be run at the start of our section
 //
 
 function img_setting_section_callback_function() {
 	echo '<p>Intro text for our settings section</p>';
 }
 
 // ------------------------------------------------------------------
 // Callback function for our example setting
 // ------------------------------------------------------------------
 //
 // creates a checkbox true/false option. Other types are surely possible
 //
 
 function img_setting_callback_function() {
 	echo '<input name="img_setting_name" id="gv_thumbnails_insert_into_excerpt" type="checkbox" value="1" class="code" ' . checked( 1, get_option('img_setting_name'), false ) . ' /> Explanation text';
 }
?>