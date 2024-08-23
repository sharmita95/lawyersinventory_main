<?php /* Template Name: Find Law Firms */
get_header();

$my_service = "law-firms";
$tax = "lawfirms-location";
$countriesArr = get_country($my_service);

$search_param = !empty($_GET['find']) ? $_GET['find'] : '';
$choosed_issue = !empty($_GET['issue']) ? $_GET['issue'] : '';
$paged = (isset($_GET['pagination'])) ? $_GET['pagination'] : 1;
// $post_per_page = get_option('posts_per_page');
$post_per_page = 9;

$args = array(
    'post_type'        => $my_service,
    'post_status'       => 'publish',
    'orderby'           => 'date',
    'paged'             => $paged,
    'order'             => 'DESC',
    'posts_per_page'    => $post_per_page
);

if(!empty($choosed_issue)) { //Not working
    $args['tax_query'] = array(
        [
            'taxonomy' => 'lawyers-category',
            'field' => 'slug',
            'terms' => $choosed_issue
        ]
    );
}

if(!empty($search_param)) { //Not working
    $args['s'] =  $search_param;
    
}

$lawyers_posts = new WP_Query($args);
$page_count = $lawyers_posts->max_num_pages;
$post_count = $lawyers_posts->found_posts;

// echo '<pre>';
// print_r($lawyers_posts->posts);
// print_r($args);
// echo '</pre>';

$issuesArr = get_practice_area();
?>

<section class="lawyers-common-banner-sec">
    <div class="container mx-auto">
        <div class="lawyers-c-b-inner">
            <div class="l-c-b-title-wrapper">
                <h2 class="l-c-b-title">
                    Best Lawyers firm
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="best-lawyers-in-us">
    <div class="container mx-auto">
        <div class="lawyers-filter-search-wrapper">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="lawyers-filter-search-from">
                <input class="lawyers-filter-search-from-input" type="text" placeholder="Search.." name="find">
                <button class="lawyers-filter-search-from-button" type="submit">
                    <span class="icon-search"></span>
                </button>
            </form>
        </div>

        <div class="lawyers-filter-submit-from-whapper">
            <form id="find-firms-by-location" action="" method="POST" class="lawyers-filter-submit-from" name="lawyers-filter-from">
                
                <input type="hidden" name="type" value="<?php echo $my_service; ?>" id="type"/>
                <input type="hidden" name="tax_name" value="<?php echo $tax; ?>" id="tax-type"/>

                <div class="lawyers-filter-left-sec">
                    <div class="lawyers-filter-select-option-wrapper">
                        <select x class="lawyers-filter-select-option" name="issue" id="issue">
                            <option value="" selected>lawyers Type</option >
                            <?php foreach($issuesArr as $issueData) { ?>
                                <option value="<?php echo $issueData->term_id; ?>" 
                                    <?php if($issueData->slug === $choosed_issue) { echo "selected"; } ?> 
                                    slug="<?php echo $issueData->slug; ?>"><?php echo $issueData->name; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="country" id="country" x class="lawyers-filter-select-option">
                            <option value="">Choose Country</option>
                            <?php foreach($countriesArr as $country) { ?>
                                <option value="<?php echo $country->term_id; ?>" slug="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="state" id="state" x class="lawyers-filter-select-option">
                            <option value="">Choose State</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="city" id="city" x class="lawyers-filter-select-option">
                            <option value="">Choose City</option>
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

        <div class="lawyers-firm-card-grid-wrapper">
            <div class="lawyers-firm-card-grid">
                <?php if ($lawyers_posts->have_posts()) :
                    while ($lawyers_posts->have_posts()) : $lawyers_posts->the_post();
                        get_template_part('template-parts/lawyersfirm', 'card');
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

    </div>
</section>

<?php
get_footer();
?>