<?php get_header();

$post_per_page = get_option('posts_per_page');
$paged = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
$args = array(
    's' => get_search_query(),
    'post_type' => 'post',
    'paged'  => $paged,
    'posts_per_page' => $post_per_page,
    'order'      =>'DESC',
    'post_status' => 'publish',
);

$search_arr = new WP_Query($args);
$page_count = $search_arr->max_num_pages;
$post_count = $search_arr->found_posts;
?>

<section class="lawyers-common-banner-sec">
    <div class="container mx-auto">
        <div class="lawyers-c-b-inner">
            <div class="l-c-b-title-wrapper">
                <h2 class="l-c-b-title">
                    Search: <?php echo get_search_query(); ?>
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="blog-listing-sec">
    <div class="container mx-auto">

        <!-- all Posts -->
        <div class="lawyers-card-grid-wrapper">
            <div id = "posts-container" class="lawyers-card-grid">
                
                <?php
                if ( $search_arr->have_posts() ) : 
                    while ( $search_arr->have_posts() ) : $search_arr->the_post();

                        get_template_part('template-parts/blog-card', 'card'); 

                    endwhile;
                endif; ?>

            </div>
        </div>

        <!---- Pagination ---->      
        <!-- <div id="pagination-container">
            <div class="pagination-wrapper">
                <?php /*the_posts_pagination(
                    array(
                        'mid_size' => 1,
                        'prev_text' => __( '<<', 'lyi' ),
                        'next_text' => __( '>>', 'lyi' ),
                    )
                );*/ ?>
            </div>
        </div> -->

        <div id="pagination-container">
            <?php echo custom_pagination(array(
                'base'    => get_permalink(),
                'current' => $paged,
                'total'   => $page_count,
                'mid_size' => 2,
                'end_size' => 1,
                'prev_text' => '&laquo; prev',
                'next_text' => 'Next &raquo;'
            )); ?>
        </div>

    </div>
</section>



<?php get_footer(); ?>