<?php
if (!defined('LYI_DIR')) define('LYI_DIR', get_template_directory());
if (!defined('LYI_URI')) define('LYI_URI', get_template_directory_uri());


//---------- Importing files
if (file_exists(get_template_directory() . '/setup/includes.php')) {
	require_once(get_template_directory() . '/setup/includes.php');
}
if (file_exists(get_template_directory() . '/setup/form-hooks.php')) {
	require_once(get_template_directory() . '/setup/form-hooks.php');
}
if (file_exists(get_template_directory() . '/setup/data-import.php')) {
	require_once(get_template_directory() . '/setup/data-import.php');
}
if (file_exists(get_template_directory() . '/setup/theme-functions.php')) {
	require_once(get_template_directory() . '/setup/theme-functions.php');
}


add_action('wp_enqueue_scripts', 'lyi_enqueue_files');
function lyi_enqueue_files()
{
    $ver = '5.8.4';
    wp_enqueue_script('jquery.min', get_template_directory_uri() . '/js/jquery-3.7.1.min.js', array('jquery'), $ver, true);
    // wp_enqueue_script('owl.carousel.min', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), $ver, true);
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/ThemeScript.js', array('jquery'), $ver, true);
    // wp_enqueue_script('swiper-bundle.js.min', get_template_directory_uri() . '/js/swiper-bundle.min.js', array('jquery'), $ver, true);

    // wp_enqueue_style('owl.carousel.min', get_template_directory_uri() . '/css/owl.carousel.min.css', $ver, 'all');
    // wp_enqueue_style('swiper-bundle.css.min', get_template_directory_uri() . '/css/swiper-bundle.min.css', $ver, 'all');
    wp_enqueue_style('style', get_stylesheet_uri(), false, $ver, 'all');

    wp_enqueue_script( 'jquery' );    
    wp_enqueue_script('custom-js', LYI_URI. '/js/custom.js', array('jquery'), $ver, true);
	$jsData = [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'test' => '123',
        'test1' => 'world',
    ];

    wp_localize_script('custom-js', 'Front', $jsData);
    
}

add_action( 'after_setup_theme', 'custom_theme_setup' );
if(!function_exists('custom_theme_setup'))
{
	function custom_theme_setup()
	{
		load_theme_textdomain( 'custom_theme' );
		add_theme_support( 'automatic-feed-links' );		
		add_theme_support( 'title-tag' );		
		add_theme_support( 'custom-logo');		
		add_theme_support( 'post-thumbnails');
		add_theme_support('html5', array('comment-form','comment-list','script', 'style') );

		$GLOBALS['content_width'] = 900;
		
		set_post_thumbnail_size( 1200, 9999 );

        //Add Image Size
		add_image_size('breed-hero-thumbnail', 830, 503, true);
		add_image_size('lawyers-list-thumbnail', 475, 643, true);

		add_image_size('single-page-thumbnail', 1920, 600, true);
		add_image_size('related-posts-thumbnail', 475, 404, true);

        //Add Role
		// if (!(wp_roles()->is_role('pet-vet'))){
		// 	add_role( 'pet-vet', 'Veterinarians', get_role( 'author' )->capabilities);
		// }

        //Show Admin bar on Login as per Role
		$allowed_roles = array('administrator', 'editor', 'author');
		if(!count(array_intersect($allowed_roles, wp_get_current_user()->roles))) {
			show_admin_bar(false);
		} else {
			show_admin_bar(true);
		}
	}
}