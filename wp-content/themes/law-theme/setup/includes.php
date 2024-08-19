<?php 

add_action('init', 'add_custom_user_role');
function add_custom_user_role() {
    remove_role( 'Basic' );
    add_role( // For Profile Listing
        'basic',
        'Basic',
        get_role( 'author' )->capabilities
        // array( 'read' => true, 'edit_posts' => true, 'publish_posts' => true, 'upload_files' => true,)
    );
    add_role( // For About Us
        'sliver',
        'Silver',
        get_role( 'author' )->capabilities
    );
    add_role( // For Featured Listing
        'platinum',
        'Platinum',
        get_role( 'author' )->capabilities
        // 'delete_posts' => true,        
    );
}


//Create Practice Areas
add_action( 'init', 'create_custom_taxonomies');
function create_custom_taxonomies() {

    $labels = array(
        'name'              => _x( 'Practice', 'taxonomy general name', 'lyi' ),
        'singular_name'     => _x( 'Practice', 'taxonomy singular name', 'lyi' ),
        'search_items'      => __( 'Search Practice', 'lyi' ),
        'all_items'         => __( 'All Practice', 'lyi' ),
        'parent_item'       => __( 'Year of publication', 'lyi' ),
        'parent_item_colon' => __( 'Year of publication:', 'lyi' ),
        'edit_item'         => __( 'Edit Practice', 'lyi' ),
        'update_item'       => __( 'Update Practice', 'lyi' ),
        'add_new_item'      => __( 'Add new Practice', 'lyi' ),
        'new_item_name'     => __( 'New Practice', 'lyi' ),
        'menu_name'         => __( 'Practice', 'lyi' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'public' => true,
        'has_archive' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 
            'slug' => 'practice', 
            'hierarchical' => true,
            'with_front'    => true 
        ),
    );

    register_taxonomy( 'lawyers-category', array( 'lawyers','law-firms' ), $args );
}


add_action( 'init', 'custom_post_type', 0 );
function custom_post_type() {
  
    // Lawyers
    $labels_lawyers = array(
        'name'                => _x( 'Lawyers', 'Post Type General Name', 'lyi' ),
        'singular_name'       => _x( 'Lawyers', 'Post Type Singular Name', 'lyi' ),
        'menu_name'           => __( 'Lawyers', 'lyi' ),
        'parent_item_colon'   => __( 'Parent Lawyers', 'lyi' ),
        'all_items'           => __( 'All Lawyers', 'lyi' ),
        'view_item'           => __( 'View Lawyers', 'lyi' ),
        'add_new_item'        => __( 'Add New Lawyers', 'lyi' ),
        'add_new'             => __( 'Add New', 'lyi' ),
        'edit_item'           => __( 'Edit Lawyers', 'lyi' ),
        'update_item'         => __( 'Update Lawyers', 'lyi' ),
        'search_items'        => __( 'Search Lawyers', 'lyi' ),
        'not_found'           => __( 'Not Found', 'lyi' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'lyi' ),
    );
        
    $args_lawyers = array(
        'label'               => __( 'lawyers', 'lyi' ),
        'description'         => __( 'Movie news and reviews', 'lyi' ),
        'labels'              => $labels_lawyers,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields' ),
        // 'taxonomies'          => array( 'genres' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    
    );
    register_post_type( 'lawyers', $args_lawyers );

    //Law Firms
    $labels_firms = array(
        'name'                => _x( 'Law Firms', 'Post Type General Name', 'lyi' ),
        'singular_name'       => _x( 'Law Firms', 'Post Type Singular Name', 'lyi' ),
        'menu_name'           => __( 'Law Firms', 'lyi' ),
        'parent_item_colon'   => __( 'Parent Law Firms', 'lyi' ),
        'all_items'           => __( 'All Law Firms', 'lyi' ),
        'view_item'           => __( 'View Law Firms', 'lyi' ),
        'add_new_item'        => __( 'Add New Law Firms', 'lyi' ),
        'add_new'             => __( 'Add New', 'lyi' ),
        'edit_item'           => __( 'Edit Law Firms', 'lyi' ),
        'update_item'         => __( 'Update Law Firms', 'lyi' ),
        'search_items'        => __( 'Search Law Firms', 'lyi' ),
        'not_found'           => __( 'Not Found', 'lyi' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'lyi' ),
    );
        
    $args_firms = array(
        'label'               => __( 'law-firms', 'lyi' ),
        'labels'              => $labels_firms,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', ),
        // 'taxonomies'          => array( 'genres' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    
    );
    register_post_type( 'law-firms', $args_firms );
    
}








add_action( 'init', 'create_lawyers_location');
function create_lawyers_location() {

    $labels = array(
        'name'              => _x( 'Location', 'taxonomy general name', 'lyi' ),
        'singular_name'     => _x( 'Location', 'taxonomy singular name', 'lyi' ),
        'search_items'      => __( 'Search location', 'lyi' ),
        'all_items'         => __( 'All Location', 'lyi' ),
        'parent_item'       => __( 'Year of publication', 'lyi' ),
        'parent_item_colon' => __( 'Year of publication:', 'lyi' ),
        'edit_item'         => __( 'Edit Location', 'lyi' ),
        'update_item'       => __( 'Update Location', 'lyi' ),
        'add_new_item'      => __( 'Add new Location', 'lyi' ),
        'new_item_name'     => __( 'New Location', 'lyi' ),
        'menu_name'         => __( 'Location', 'lyi' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'public' => true,
        'has_archive' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 
            'slug' => 'find-lawfirms', 
            'hierarchical' => true,
            'with_front'    => true 
        ),
    );

    register_taxonomy( 'lawfirms-location', array( 'law-firms' ), $args );

    //OLD
    $labels = array(
        'name'              => _x( 'Location', 'taxonomy general name', 'lyi' ),
        'singular_name'     => _x( 'Location', 'taxonomy singular name', 'lyi' ),
        'search_items'      => __( 'Search location', 'lyi' ),
        'all_items'         => __( 'All Location', 'lyi' ),
        'parent_item'       => __( 'Year of publication', 'lyi' ),
        'parent_item_colon' => __( 'Year of publication:', 'lyi' ),
        'edit_item'         => __( 'Edit Location', 'lyi' ),
        'update_item'       => __( 'Update Location', 'lyi' ),
        'add_new_item'      => __( 'Add new Location', 'lyi' ),
        'new_item_name'     => __( 'New Location', 'lyi' ),
        'menu_name'         => __( 'Location', 'lyi' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'public' => true,
        'has_archive' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 
            'slug' => 'find-lawyers', 
            'hierarchical' => true,
            'with_front'    => true 
        ),
    );

    register_taxonomy( 'lawyers-location', array( 'lawyers' ), $args );
}










// Theme Settings
function social() {  
	add_settings_section(  
		'social_links', // Section ID 
		'Social Links', // Section Title
		'social_callback', // Callback
		'general' // What Page?  This makes the section show up on the General Settings Page
	);
		

    $socials = array('facebook', 'twitter', 'linkedin', 'instagram');

    foreach($socials as $social) {
        add_settings_field(
            $social,
            ucwords(str_replace('_',' ',$social)), 
            'url_callback', 
            'general', 
            'social_links', 
            array(
                $social
            )  
        ); 
    }
    
	foreach($socials as $social){
		add_settings_field($social, ucwords(str_replace('_',' ',$social)).' Link', 'social_content_callback', 'theme_menu', 'footer_settings',$social);
		register_setting('general',$social, 'esc_attr');
	}

    add_settings_field('footer_text', 'Footer Text', 'footer_text_callback', 'theme_menu', 'footer_settings','footer_text');
	register_setting('theme_menu','footer_text', 'esc_attr');
		
}
add_action('admin_init', 'social'); //Enable Social Links Under Settings

function social_callback() { // Section Callback
	echo '<p>Add Your Social Media Links Below</p>';  
}
	
function url_callback($args) {  // Textbox Callback
	$option = get_option($args[0]);
	echo '<input type="url" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}



// Add Custom Field in General Settings for Footer Content 
function footer_content() {  
	add_settings_section(  
		'footer_content', // Section ID 
		'Footer Content', // Section Title
		'footer_content_callback', // Callback
		'general' // What Page?  This makes the section show up on the General Settings Page
	);
		
	add_settings_field( // Option 1
		'text', // Option ID
		'Text', // Label
		'text_callback', // !important - This is where the args go!
		'general', // Page it will be displayed (General Settings)
		'footer_content', // Name of our section
		array( // The $args
			'text' // Should match Option ID
		)  
	);
		
	register_setting('general','text', 'esc_attr');

}
add_action('admin_init', 'footer_content'); //Enable Footer Text in Pages

function footer_content_callback() { // Section Callback
	echo '<p>Add Your Footer Text Below</p>';  
}
	
function text_callback($argu) {  // Textbox Callback
	$text = get_option($argu[0]);
	echo '<textarea rows="4" cols="50" type="text" name="'. $argu[0] .'" id="'. $argu[0] .'">' . $text . '</textarea>';
}

