<?php
if (!defined('LYI_DIR')) define('LYI_DIR', get_template_directory());
if (!defined('LYI_URI')) define('LYI_URI', get_template_directory_uri());


//---------- Importing files
if (file_exists(get_template_directory() . '/includes.php')) {
	require_once(get_template_directory() . '/includes.php');
}
if (file_exists(get_template_directory() . '/form-hooks.php')) {
	require_once(get_template_directory() . '/form-hooks.php');
}
if (file_exists(get_template_directory() . '/data-import.php')) {
	require_once(get_template_directory() . '/data-import.php');
}

/*
* Creating a function to create our CPT
*/
  
add_action( 'init', 'custom_post_type', 0 );
function custom_post_type() {
  
    // Lawyers
    $labels = array(
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
        
    $args = array(
        'label'               => __( 'lawyers', 'lyi' ),
        'description'         => __( 'Movie news and reviews', 'lyi' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', ),
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
    register_post_type( 'lawyers', $args );

    //Law Firms
    $labels = array(
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
        
    $args = array(
        'label'               => __( 'law-firms', 'lyi' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', ),
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
    register_post_type( 'law-firms', $args );
    
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



function add_post_type_to_taxonomy_url() {

    $taxonomy_slug="lawyers-location";
     $post_type_slug="lawyers";
         
    
    add_rewrite_rule(         "{$post_type_slug}/{$taxonomy_slug}/([^/]+)/?$",         'index.php?post_type=' . $post_type_slug . '&' . $taxonomy_slug . '=$matches[1]',         'top' );

    $posst_type_slug="law-firms";

    add_rewrite_rule(         "{$posst_type_slug}/{$taxonomy_slug}/([^/]+)/?$",         'index.php?post_type=' . $posst_type_slug . '&' . $taxonomy_slug . '=$matches[1]',         'top' );
    
    flush_rewrite_rules(); }


         
// add_action( 'init', 'add_post_type_to_taxonomy_url');



// add_filter( 'request', 'service_remove_tax_slugs', 1, 1 );
function service_remove_tax_slugs( $query_vars ) {
    $tax_slugs = array('lawyers-location');
    if ( isset( $query_vars['attachment'] ) ? $query_vars['attachment'] : null ) :
        $include_children = true;
        $name             = $query_vars['attachment'];
    else :
        if ( isset( $query_vars['name'] ) ? $query_vars['name'] : null ) {
            $include_children = false;
            $name             = $query_vars['name'];
        }
    endif;
    if ( isset( $name ) ) :
        foreach ( $tax_slugs as $slug ) {
            $term = get_term_by( 'slug', $name, $slug.'s' );
            if ( $term && ! is_wp_error( $term ) ) :
                if ( $include_children ) {
                    unset( $query_vars['attachment'] );
                    $parent = $term->parent;
                    while ( $parent ) {
                        $parent_term = get_term( $parent, $slug.'s' );
                        $name        = $parent_term->slug . '/' . $name;
                        $parent      = $parent_term->parent;
                    }
                } else {
                    unset( $query_vars['name'] );
                }
                $query_vars[ $slug.'s' ] = $slug.'s/'.$name;
            endif;
        }
    endif;
 
    return $query_vars;
}