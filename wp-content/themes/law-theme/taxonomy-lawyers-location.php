<?php get_header(); 
global $wp_query;
$archive_object = get_queried_object();
$term_slug = get_queried_object()->slug;
$parent_id = $archive_object->parent;
$grand_parent_id = (!empty($parent_id)) ? get_term($parent_id)->parent : '';

// $form_country = (!isset($_POST['find-doctor-submit'])) ? '' : esc_sql($_POST['country']);
// $form_state = (!isset($_POST['find-doctor-submit'])) ? '' : esc_sql($_POST['state']);
// $form_city = (!isset($_POST['find-doctor-submit'])) ? '' : esc_sql($_POST['city']);

// $choosed_issue = $_GET['issue'];


$url_taxonomy = get_queried_object();
$services = array('lawyers', 'law-firms');
$my_service = "lawyers";
// $form_service = (!isset($_POST['lawyers-filter-from'])) ? str_replace('find', 'pet', $url_taxonomy->post_name) : esc_sql($_POST['service']);
$form_country = (!isset($_POST['lawyers-filter-from'])) ? '' : esc_sql($_POST['country']);
$form_state = (!isset($_POST['lawyers-filter-from'])) ? '' : esc_sql($_POST['state']);
$form_city = (!isset($_POST['lawyers-filter-from'])) ? '' : esc_sql($_POST['city']);
$countries = get_country($my_service);
$states = (!empty($form_state)) ? get_state($form_state, 'state') : '';
$cities = (!empty($form_city)) ? get_city($form_city, 'city') : '';
$paged = (isset($_GET['pagination'])) ? $_GET['pagination'] : 1;
// $post_per_page = get_option('posts_per_page');
$post_per_page = 4;
$lawyers_posts = new WP_Query(array(
    'post_type'        => 'lawyers',
    'post_status'       => 'publish',
    'orderby'           => 'date',
    'paged'             => $paged,
    'order'             => 'DESC',
    'posts_per_page'    => $post_per_page,
    'tax_query' => array(
        array(
            'taxonomy' => 'lawyers-location',
            'field' => 'slug',
            'terms' => array('india', 'howrah')
        )
    )
));
$page_count = $lawyers_posts->max_num_pages;
$post_count = $lawyers_posts->found_posts;


echo '<pre>';
print_r($lawyers_posts->posts);
echo '</pre>';

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
            <form id="find-lawyers-by-location" action="" method="POST" class="lawyers-filter-submit-from" name="lawyers-filter-from"> 
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

        <?php 
        if (!($post_count <= $post_per_page)) :
            echo '
            <div class="pagination-wrapper">
                <div class="pagination">';
                    $prev = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M0.492115 11.1885L8.81142 19.5079C9.46757 20.164 10.5318 20.164 11.1879 19.5079C11.8441 18.8517 11.8441 17.7875 11.1879 17.1314L4.05762 10.0011L11.1879 2.87091C11.8441 2.21476 11.8441 1.15058 11.1879 0.494421C10.5318 -0.161734 9.46757 -0.161734 8.81142 0.494421L0.492115 8.81372C-0.16404 9.46825 -0.16404 10.5324 0.492115 11.1885ZM10.4951 11.6923L17.0999 18.6535C17.7636 19.3521 18.8386 19.3521 19.5022 18.6535C20.1659 17.9549 20.1659 16.8216 19.5022 16.1222L14.0981 10.4266L19.5022 4.73111C20.1659 4.03248 20.1659 2.8984 19.5022 2.19976C18.8386 1.50112 17.7636 1.50112 17.0999 2.19976L10.4951 9.16097C9.83145 9.85957 9.83145 10.9929 10.4951 11.6923Z" fill="#FFA500" />
                                    </svg>';
                    $next = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M19.5079 8.81145L11.1886 0.492116C10.5324 -0.164039 9.46824 -0.164039 8.81209 0.492116C8.15593 1.14827 8.15593 2.21245 8.81209 2.86861L15.9424 9.99886L8.81209 17.1291C8.15593 17.7852 8.15593 18.8494 8.81209 19.5056C9.46824 20.1617 10.5324 20.1617 11.1886 19.5056L19.5079 11.1863C20.164 10.5318 20.164 9.46761 19.5079 8.81145ZM9.50488 8.30768L2.90006 1.34647C2.23639 0.647863 1.16142 0.647863 0.497753 1.34647C-0.165918 2.04507 -0.165918 3.17837 0.497753 3.87782L5.90186 9.57335L0.497753 15.2689C-0.165918 15.9675 -0.165918 17.1016 0.497753 17.8002C1.16142 18.4989 2.23639 18.4989 2.90006 17.8002L9.50488 10.839C10.1685 10.1404 10.1685 9.00713 9.50488 8.30768Z" fill="#FFA500" />
                                </svg>';
                    echo custom_pagination(array(
                        'base'    => $url_taxonomy->guid,
                        'current'   => $paged,
                        'total'     => ceil($post_count / $post_per_page),
                        'mid_size'  => 2,
                        'end_size'  => 2,
                        'prev_text' => $prev,
                        'next_text' => $next
                    ));
                echo '</div>
            </div>';
        endif; ?>

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