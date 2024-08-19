<?php /* Template Name: Practice Area Page */
get_header();

// echo do_shortcode('[LYI_practice_area_form]');
// $my_service = () ?  'lawyers';
$tax = "lawyers-category";

$paged = (isset($_GET['pagination'])) ? $_GET['pagination'] : 1;
// $post_per_page = get_option('posts_per_page');
$post_per_page = 3;


$lawyers_posts = new WP_Query(array(
    'post_type'         => array('lawyers', 'law-firms'),
    'post_status'       => 'publish',
    'orderby'           => 'date',
    'paged'             => $paged,
    'order'             => 'DESC',
    'posts_per_page'    => $post_per_page,
    // 'tax_query' => array(
    //     array(
    //         'taxonomy' => $tax,
    //         'field' => 'slug',
    //         'terms' => array($desired_slug)
    //     )
    // )
));
$page_count = $lawyers_posts->max_num_pages;
$post_count = $lawyers_posts->found_posts;


$taxonomies = get_terms( array(
    'taxonomy' => $tax,
    'hide_empty' => false
) );

?>

<section class="lawyers-common-banner-sec">
    <div class="container mx-auto">
        <div class="lawyers-c-b-inner">
            <div class="l-c-b-title-wrapper">
                <h2 class="l-c-b-title">
                    Best Lawyers
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="best-lawyers-in-us">
    <div class="container mx-auto">
        <div class="lawyers-filter-search-wrapper">
            <!-- <form action="" class="lawyers-filter-search-from">
                <input class="lawyers-filter-search-from-input" type="text" 
                    placeholder="Search.." name="search">
                <button class="lawyers-filter-search-from-button" type="submit">
                    <span class="icon-search"></span>
                </button>
            </form> -->
        </div>

        <div class="lawyers-filter-submit-from-whapper">
            <form id="find-by-issue" action="" method="POST" class="lawyers-filter-submit-from" name="find-by-issue-form">

                <div class="lawyers-filter-left-sec">

                    <div class="lawyers-filter-select-option-wrapper">
                        <select x class="lawyers-filter-select-option" name="type" id="type">
                            <option value="">Choose</option>
                            <option value="lawyers" slug="lawyers" selected>Lawyers</option>
                            <option value="lawfirms" slug="law-firms">Law Firms</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select x class="lawyers-filter-select-option" name="issue" id="issue">
                            <option value="">Choose Practice Area</option>
                            <?php foreach($taxonomies as $tax) { ?>
                                <option value="<?php echo $tax->term_id; ?>" slug="<?php echo $tax->slug; ?>"><?php echo $tax->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="lawyers-filter-right-sec">
                    <button class="lawyers-filter-select-button" type="submit">
                        Submit
                    </button>
                </div>
            </form>

        </div>

        <div class="lawyers-card-grid-wrapper">
            <div class="lawyers-card-grid">
                <?php 
                if ($lawyers_posts->have_posts()) :
                    while ($lawyers_posts->have_posts()) : $lawyers_posts->the_post();
                        get_template_part('template-parts/lawyers', 'card');
                    endwhile; ?>
                <?php else : ?>
                    <p>No data available</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="pagination-wrapper">
            <div class="pagination">
                <?php 
                $big = 999999999;

                $pagination_args = array(
                    'base' => add_query_arg('pagination', '%#%'),
                    'format' => '',
                    'current' => max(1, $paged),
                    'total' => $lawyers_posts->max_num_pages,
                    'prev_text' => __('« Prev'),
                    'next_text' => __('Next »'),
                );

                // Add additional query parameters to pagination
                if ($paged) {
                    $pagination_args['add_args'] = array('pagination' => $paged);
                }
            
                $pagination = paginate_links($pagination_args);
            
                if ($pagination) {
                    echo '<div>' . $pagination . '</div>';
                }
                ?>
            </div>
        </div>

        <!-- <div class="pagination-wrapper">
            <div class="pagination">
                <a class="pagination-btn p-b-active" href="#">1</a>
                <a class="pagination-btn" href="#">2</a>
                <a class="pagination-btn" href="#">3</a>
                <a class="pagination-btn" href="#">4</a>
                <a class="pagination-btn" href="#">5</a>
                <a class="pagination-btn" href="#">6</a>
                <a class="pagination-btn-next" href="#">Next</a>
            </div>
        </div> -->

    </div>
</section>

<?php
get_footer();
?>