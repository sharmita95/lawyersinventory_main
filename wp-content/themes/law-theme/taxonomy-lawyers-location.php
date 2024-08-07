<?php get_header(); 
global $wp_query;
$archive_object = get_queried_object();
$term_slug = get_queried_object()->slug;
$parent_id = $archive_object->parent;
$grand_parent_id = (!empty($parent_id)) ? get_term($parent_id)->parent : '';

// $form_country = (!isset($_POST['find-doctor-submit'])) ? '' : esc_sql($_POST['country']);
// $form_state = (!isset($_POST['find-doctor-submit'])) ? '' : esc_sql($_POST['state']);
// $form_city = (!isset($_POST['find-doctor-submit'])) ? '' : esc_sql($_POST['city']);

$choosed_issue = $_GET['issue'];

$lawyers_posts = new WP_Query(array(
    'post_type'        => 'lawyers',
    'post_status'       => 'publish',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => 'lawyers-location',
            'field' => 'slug',
            'terms' => array('india', 'howrah')
        )
    )
));

?>
<?php //echo wp_strip_all_tags(single_cat_title()); 
echo "Lawyers<br>";


if(empty($grand_parent_id) && empty($parent_id)) { //Country
    echo "It's a Country</br>";
    echo get_queried_object()->name;

} elseif(empty($grand_parent_id) && (!empty($parent_id))) {
    echo "It's a State</br>";
    echo get_term( $parent_id )->name . ' > ' .get_queried_object()->name;
} else {
    echo "It's a city</br>";
    echo get_term($grand_parent_id)->name . ' > ' . get_term( $parent_id )->name . '>' .get_queried_object()->name;
}


$countryList = get_terms(array(
    'taxonomy' => 'lawyers-location',
    'parent' => 0,
    'hide_empty' => false
));

$issuesArr = array(
   array('term_id' => 2, 'slug' => 'family', 'name' => 'Family'),
   array('term_id' => 8, 'slug' => 'land', 'name' => 'Land'),
   array('term_id' => 26, 'slug' => 'accident', 'name' => 'Accident')
)
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
                <input class="lawyers-filter-search-from-input" type="text" placeholder="Search.." name="search">
                <button class="lawyers-filter-search-from-button" type="submit">
                    <span class="icon-search"></span>
                </button>
            </form>
        </div>

        <div class="lawyers-filter-submit-from-whapper">
            <form id="find-lawyers-by-location" action="" method="POST" class="lawyers-filter-submit-from">
                <div class="lawyers-filter-left-sec">
                    <div class="lawyers-filter-select-option-wrapper">
                        <select x class="lawyers-filter-select-option" name="issue" id="issue">
                            <option value="" selected>lawyers Type</option >
                            <?php foreach($issuesArr as $issueData) { ?>
                                <option value="<?php echo $issueData['term_id']; ?>" 
                                    <?php if($issueData['slug'] === $choosed_issue) { echo "selected"; } ?> 
                                    slug="<?php echo $issueData['slug']; ?>"><?php echo $issueData['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="country" id="country" x class="lawyers-filter-select-option">
                            <option value="">Choose Country</option>
                            <?php foreach($countryList as $country) { ?>
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
                <a class="pagination-btn p-b-active" href="#">1</a>
                <a class="pagination-btn" href="#">2</a>
                <a class="pagination-btn" href="#">3</a>
                <a class="pagination-btn" href="#">4</a>
                <a class="pagination-btn" href="#">5</a>
                <a class="pagination-btn" href="#">6</a>
                <a class="pagination-btn-next" href="#">Next</a>
            </div>

        </div>

    </div>
</section>

<?php
get_footer();