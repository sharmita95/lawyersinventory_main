<?php get_header(); 
global $wp_query;
$my_service = "lawyers";
$tax = "lawyers-location";
$archive_object = get_queried_object();
// print_r($archive_object);
$term_slug = get_queried_object()->slug;
$parent_id = $archive_object->parent;
$grand_parent_id = (!empty($parent_id)) ? get_term($parent_id)->parent : '';

$choosed_issue = !empty($_GET['issue']) ? $_GET['issue'] : '';
$paged = (isset($_GET['pagination'])) ? $_GET['pagination'] : 1;
$post_per_page = 9;

//When Country is available
if(empty($grand_parent_id) && empty($parent_id)) { 

    // echo get_queried_object()->slug;
    $from_country = get_queried_object()->slug;

    $desired_slug = get_queried_object()->slug;

    // $states_html = get_state($my_service, get_queried_object()->term_id); //get states

    // print_r($states_html);

} 
//When State is available
elseif(empty($grand_parent_id) && (!empty($parent_id))) {

    // echo get_term( $parent_id )->slug . ' > ' .get_queried_object()->slug;
    $from_country = get_term( $parent_id )->slug;
    $from_state = get_queried_object()->slug;

    $desired_slug = get_queried_object()->slug;

    // $cities_html = get_city($my_service, get_queried_object()->term_id); //get cities

} 
//When City is available
else { 

    // echo get_term($grand_parent_id)->slug . ' > ' . get_term( $parent_id )->slug . '>' .get_queried_object()->slug;
    $from_country = get_term($grand_parent_id)->slug;
    $from_state = get_term( $parent_id )->slug;
    $from_city = get_queried_object()->slug;

    $desired_slug = get_queried_object()->slug;
}
// $from_country = (!empty($from_country)) ? $from_country : '';
// $from_state = (!empty($form_state)) ? $form_state : '';
// $from_city = (!empty($from_city)) ? $from_city : '';

$issuesArr = get_practice_area();
// $countryList = get_country($my_service);
// $stateList = get_state($my_service);


// print_r($stateList);

$statesList = (!empty($from_country)) ? get_state($my_service, $from_country) : '';
$citiesList = (!empty($from_state)) ? get_city($my_service, $from_state) : '';


if(!empty($desired_slug)) {
    $tax_query[0] = array(
        'taxonomy' => $tax,
        'field' => 'slug',
        'terms' => array($desired_slug)
    );
}
if(!empty($choosed_issue)) {
    $tax_query[1] = array(
        'taxonomy' => 'lawyers-category',
        'field' => 'slug',
        'terms' => $choosed_issue
    );
}
$query = array(
    'post_type'        => $my_service,
    'post_status'       => 'publish',
    'orderby'           => 'date',
    'paged'             => $paged,
    'order'             => 'DESC',
    'posts_per_page'    => $post_per_page,
    'tax_query' => array(
        'relation' => 'AND',
        $tax_query
    )       
);

$lawyers_posts = new WP_Query($query);
$page_count = $lawyers_posts->max_num_pages;
$post_count = $lawyers_posts->found_posts;






$countriesArr = get_country($my_service);
// if(!empty($form_state)) {
//     $category = get_term_by('name', $form_state, $tax);
//     print_r($category);
//     // get_state($form_state, '') : '';
// }

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
            <form action="/action_page.php" class="lawyers-filter-search-from">
                <input class="lawyers-filter-search-from-input" type="text" placeholder="Search.." 
                name="search">
                <button class="lawyers-filter-search-from-button" type="submit">
                    <span class="icon-search"></span>
                </button>
            </form>
        </div>

        <div class="lawyers-filter-submit-from-whapper">
            <form id="find-lawyers-by-location" action="" method="POST" class="lawyers-filter-submit-from" name="lawyers-filter-from"> 
                
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
                                <option value="<?php echo $country->term_id; ?>" 
                                slug="<?php echo $country->slug; ?>" 
                                <?php if(!empty($from_country) && $from_country === $country->slug) {
                                    echo "selected"; } ?>>
                                    <?php echo $country->name; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="state" id="state" x class="lawyers-filter-select-option">
                            <?php
                             if (!empty($statesList)) {
                                echo '<option value="">Pick State</option>';
                                foreach ($statesList as $state) {
                                    
                                    echo $selected = ($state->slug === $from_state) ? 'selected' : '';
                                    echo '<option slug="'.$state->slug.'" value="' . $state->term_id . '" ' . $selected . '>' . $state->name . '</option>';
                                }
                            } else {
                                echo '<option value="">Pick State</option>';
                            } 
                            ?>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="city" id="city" x class="lawyers-filter-select-option">
                        <?php 
                             if (!empty($citiesList)) {
                                echo '<option value="">Pick City</option>';
                                foreach ($citiesList as $city) {
                                    
                                    echo $selected = ($city->slug === $from_city) ? 'selected' : '';
                                    echo '<option slug="'.$city->slug.'" value="' . $city->term_id . '" ' . $selected . '>' . $city->name . '</option>';
                                }
                            } else {
                                echo '<option value="">Pick City</option>';
                            } 
                            ?>
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