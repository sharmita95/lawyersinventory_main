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
    $ver = '6.1.'.rand();
    wp_enqueue_script('jquery.min', LYI_URI . '/js/jquery-3.7.1.min.js', array('jquery'), $ver, true);
    wp_enqueue_script('custom-script', LYI_URI . '/js/ThemeScript.js', array('jquery'), $ver, true);
    wp_enqueue_script('swiper-bundle.js.min', LYI_URI . '/js/swiper-bundle.min.js', array('jquery'), $ver, true);

    wp_enqueue_style('swiper-bundle.css.min', LYI_URI . '/css/swiper-bundle.min.css', $ver, 'all');
    wp_enqueue_style('style', get_stylesheet_uri(), false, '', 'all');

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

		add_image_size('about-us-thumbnail', 1390, 647, true);
        add_image_size('write-for-us-thumbnail', 1412, 538, true);

        add_image_size('side-bar-thumb', 100, 100, true);

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

        add_post_type_support( 'page', 'excerpt' );

	}
}




///////////////////////////////////////
// function display_custom_card_posts($query_args, $card_type, $before_card = "", $after_card = "") {
//     $custom_query = new WP_Query($query_args);

//     if ($custom_query->have_posts()) :
//         while ($custom_query->have_posts()) : $custom_query->the_post();
//             if(!empty($before_card)) echo $before_card;
//             get_template_part('/template-parts/'.$card_type, 'card');
//             if(!empty($after_card)) echo $after_card;
//         endwhile;
//         wp_reset_postdata();
//     else :
//         echo '<p>No posts found.</p>';
//     endif;
// }


add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');
if(!function_exists('filter_posts'))
{
	function filter_posts() {
		$category = isset($_POST['category']) ? intval($_POST['category']) : '';
		$date_sort = isset($_POST['date_sort']) ? sanitize_text_field($_POST['date_sort']) : 'DESC';
		$search_query = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : '';
		$paged = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => get_option('posts_per_page'),
			'order' => $date_sort,
			'paged' => $paged,
			'orderby' => 'date',
			's' => $search_query,
		);
		if ($category) {
			$args['cat'] = $category;
		}
		$custom_query = new WP_Query($args);
		display_custom_card_posts($args, 'blog');
        die();
	}
	
}




function custom_pagination($args = ''){
    global $wp_query;
    $format = 'page/';
    $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	$current = isset($_POST['paged']) ? (int)$_POST['paged'] : 1;
    $defaults = array('base'    => get_permalink(),
                    'current'   => $current,
                    'total'     => $total,
                    'mid_size'  => 0,
                    'end_size'  => 0,
                    'prev_text' => '<<',
                    'next_text' => '>>',
    );
    $args = wp_parse_args( $args, $defaults );

    //Other Button Structure
    function get_custom_pagination($num,$args,$format){
        if($num==1){
            return '<a class="pagination-btn" href="'.$args['base'].'">'.$num.'</a>';
        }else{
            return '<a class="pagination-btn" href="'.$args['base'].$format.$num.'">'.$num.'</a>';    
        }
    }

    //Current Pagination
    $output = '<span aria-current="page" class="pagination-btn p-b-active">'.$args['current'].'</span>';

    //Prev Mid Buttons
    if(!empty($args['mid_size']) && !empty($args['current'])){
        $total = $args['current']-1;
        if(!empty($args['end_size'])){
            if(($args['end_size']+$args['mid_size'])<=$total){
                $round = $args['mid_size'];
            }else{
                $round = $total-$args['end_size'];
            }
        }else{
            $round = ($args['mid_size']>=$total)?$total:$args['mid_size'];
        }
        if($round>=1){
            for($x = ($args['current']-$round); $x <= $total; $x++){
                $output = get_custom_pagination($x,$args,$format).$output;
            }
        }
    }

    //Prev End Buttons
    if(!empty($args['end_size']) && !empty($args['current'])){
        $total = $args['current']-1;
        $round = ($args['end_size']>=$total)?$total:$args['end_size'];
        for($x = 1; $x <= $round; $x++){
            $output = get_custom_pagination($x,$args,$format).$output;
        }
    }

    //Prev Button
    if(!empty($args['current']) && $args['current']>=2){
        if($args['current']==2) $prev_button = '<a class="pagination-btn-next pagination-btn" href="'.$args['base'].'">'.$args['prev_text'].'</a>';
        else $prev_button = '<a class="pagination-btn-next pagination-btn" href="'.$args['base'].$format.($args['current']-1).'">'.$args['prev_text'].'</a>';
        $output = $prev_button.$output;
    }

    //Next Mid Buttons
    if(!empty($args['mid_size']) && !empty($args['current'])){
        $total = $args['total']-$args['current'];
        if(!empty($args['end_size'])){
            if(($args['end_size']+$args['mid_size'])<=$total){
                $round = $args['mid_size'];
            }else{
                $round = $total-$args['end_size'];
            }
        }else{
            $round = ($total<=$args['mid_size'])?$total:$args['mid_size'];
        }
        if($round>=1){
            for($x = ($args['current']+1); $x <= $args['current']+$round; $x++){
                $output .= get_custom_pagination($x,$args,$format);
            }
        }
    }

    //Next End Buttons
    if(!empty($args['end_size']) && !empty($args['current'])){
        $total = $args['total']-$args['current'];
        $round = ($total<=$args['end_size'])?$total:$args['end_size'];
        for($x = ($args['total']-($round-1)); $x <= $args['total']; $x++){
            $output .= get_custom_pagination($x,$args,$format);
        }
    }

    //Next Button
    if(!empty($args['current']) && $args['current']<=($args['total']-1)){
        $output .= '<a class="pagination-btn-next pagination-btn" href="'.$args['base'].$format.($args['current']+1).'">'.$args['next_text'].'</a>';
    }
    return '<form class="pagination-wrapper" name="blog-pagination-form" method="POST" action"">
    <input type="hidden" name="input_category" value="">
    <input type="hidden" name="input_order" value="">
    <input type="hidden" name="input_search" value="">
    <div class="pagination">'.$output.'</div></form>';
}


//------------- Custom comment form-----------------//

function custom_comment_form_defaults($defaults) {
    // print_r($defaults);
    // Title for the comment form
    $defaults['title_reply_before'] = '<span id="reply-title" class="content-common-title">';
    $defaults['title_reply'] = 'Leave A Reply';
    $defaults['title_reply_after'] = '</span>';

    $defaults['class_form'] = 'comment-from';

    // Custom submit button
    $submit_button = '<div class="comment-from-submit-wrapper">
                                <button class="l-d-r-f-btn">
                                    Submit
                                </button>
                            </div>';

    $defaults['submit_button'] = $submit_button;
 
    return $defaults;
}
add_filter( 'comment_form_fields', 'mo_comment_fields_custom_order' );
add_filter('comment_form_defaults', 'custom_comment_form_defaults');

function mo_comment_fields_custom_order( $fields ) {
    $cookies = $fields['cookies'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );
    unset( $fields['cookies'] );
    $fields['wrapper-open'] = '<div class="comment-from-first-row">';
    $fields['author'] = '<label class="comment-from-half" for="text">
                                    <input class="comment-from-common-input" type="text" name="author" placeholder="Name*">
                                </label>';
    $fields['email'] = '<label class="comment-from-half" for="email">
                                    <input class="comment-from-common-input" type="email" name="email" placeholder="Email*">
                                </label>';
    $fields['wrapper-close'] = '</div>';
    $fields['comment'] = '<label class="comment-from-second-row" for="comment">
                                <textarea class="comment-from-common-textarea" rows="3" name="comment" id="" placeholder="Comment"></textarea>
                            </label>';
    $fields['cookies'] = $cookies;
    return $fields;
}


//------------------- Comment Section ------------//

function display_comments_recursive($comments, $parent_id = 0) {
    foreach ($comments as $comment) {
        if ($comment->comment_parent == $parent_id) {
            // Display the comment
            ?>
            <div class="<?php if (!$comment->comment_parent) echo 'with-out-'; ?>border-replay-card">
                <div class="replay-user-and-edit">
                    <div class="flex w-fit gap-[20px]">
                        <figure class="replay-user-image-ctrl">
                        <?php
                            // pls check this line
                            echo get_avatar($comment, 96, get_template_directory_uri() . '/images/internal-one.png', 'author-img', array('class' => 'image-responsive'));
                            ?>
                            <!-- <img class="image-responsive" src="<?php// echo get_template_directory_uri(); ?>/images/Lawyers-1.png" alt="author-img" /> -->
                        </figure>
                        <div class="comment-replay-card-title-sec">
                            <h2 class="comment-replay-card-title"><?php echo esc_html($comment->comment_author); ?></h2>
                            <p class="comment-replay-card-publish-date">
                            <?php echo esc_html(date('F j, Y \a\t g:i a', strtotime($comment->comment_date))); ?></p>
                            
                        </div>                    
                    </div>

                    <!-- <a class="c-r-replay-edit-btn" href="">Edit</a> -->
                </div>

                <div class="c-r-replay-comment-sec ">
                    <p class="c-r-replay-card-comment"><?php echo esc_html($comment->comment_content); ?></p>
                    <a href="<?php echo get_permalink(); ?>?replytocom=<?php echo $comment->comment_ID; ?>#respond" data-commentid="<?php echo $comment->comment_ID; ?>" data-postid="<?php echo get_the_ID(); ?>" class=".c-r-replay-edit-btn">Reply</a>
                </div>   
            </div> 
            <?php
            // Fetch child comments
            $child_comments = get_comments(array(
                'parent' => $comment->comment_ID,
                'status' => 'approve'
            ));
            if ($child_comments) {
                ?>
                <!-- <div class="comment-child"> -->
                    <?php display_comments_recursive($child_comments, $comment->comment_ID); ?>
                <!-- </div> -->
                <?php
            }
        }
    }
}


//Rating
if(!function_exists('get_rating_star_func'))
{
	function get_rating_star_func($rating) {
        
        $r = 1;
        for($r = 1; $r<=round($rating); $r++) {
            if($rating > $r-1 && $rating <$r ) {
                echo '<div class="lawyers-d-c-rating-card">
                        <span class="icon-half-star"></span>
                    </div>';    
            } else {

            echo '<div class="lawyers-d-c-rating-card">
                    <span class="icon-star"></span>
                </div>';
            }
        } 

    }

}