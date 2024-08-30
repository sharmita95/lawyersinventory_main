<?php get_header(); 
// $post_count = $GLOBALS['wp_query']->found_posts;
// $page_count = $GLOBALS['wp_query']->max_num_pages;
// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (is_category()){
    $category = get_queried_object();
    $cat_id = $category->term_id;
    // $cat_id = $author->ID;
}
?>
<section class="author-page-sec">
    <div class="container mx-auto">
        <div class="content-sec-wrapper">
            <div class="left-content-sec">
                <div class="auth-author-card"> 
                    <div class="auth-author-card-content"> 
                        <h2 class="auth-author-card-title"><?php echo strip_tags(single_cat_title()); ?></h2> 
                        <p class="auth-author-card-dsc"><?php category_description(); ?></p> 
                    </div>                   
                </div>
 
                <div class="author-grid-card">
                <?php if (have_posts()) : while (have_posts()) : the_post(); 
                        // Include the post format-specific template for the content.
                        get_template_part( 'template-parts/blog', 'card' );
                        endwhile; else :
                            echo '<p>No data found.</p>';
                    endif;?>
                </div>
 
                <div class="author-page-pagination-sec">
                    <div class="auth-pagination">
                        <!-- <a class="auth-pagination-btn auth-p-b-active" href="#">1</a>
                        <a class="auth-pagination-btn" href="#">2</a>
                        <a class="auth-pagination-btn" href="#">3</a>
                        <a class="auth-pagination-btn" href="#">4</a>
 
                        <a class="auth-pagination-btn-dot" href="#">
                            <span class="auth-pagination-btn-dot-disc"></span>
                            <span class="auth-pagination-btn-dot-disc"></span>
                            <span class="auth-pagination-btn-dot-disc"></span>
                        </a>
 
                        <a class="auth-pagination-btn" href="#">5</a>
                        <a class="auth-pagination-btn" href="#">
                            <span class="icon-left-mid-arrow"></span>
                        </a>
                        -->
                        <?php the_posts_pagination(); ?>
                    </div>
                </div>
            </div>
            <?php echo  get_template_part('template-parts/side', 'bar'); ?>
        </div>
    </div>
</section>

<?php  get_footer();?>