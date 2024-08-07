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