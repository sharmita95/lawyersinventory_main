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