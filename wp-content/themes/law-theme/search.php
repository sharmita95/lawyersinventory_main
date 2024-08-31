<?php get_header(); ?>

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
                if ( have_posts() ) : 
                    while ( have_posts() ) : the_post();

                        get_template_part('template-parts/blog-card', 'card'); 

                    endwhile;
                endif; ?>

            </div>
        </div>

        <!---- Pagination ---->      
        <div id="pagination-container">
            <div class="pagination-wrapper">
                <?php the_posts_pagination(
                    array(
                        'mid_size' => 1,
                        'prev_text' => __( '<<', 'lyi' ),
                        'next_text' => __( '>>', 'lyi' ),
                    )
                ); ?>
            </div>
        </div>

    </div>
</section>



<?php get_footer(); ?>