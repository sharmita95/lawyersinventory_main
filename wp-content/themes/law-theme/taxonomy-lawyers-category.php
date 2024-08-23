<?php
get_header();
?>

<h2>Practice Area Listing page</h2>
Get all Sub practice areas<br>
Get the Lawyers and lawfirm depending on the practice area / issue.


<?php

$archive_object = get_queried_object();

$args = array(
    'post_type'         => array('lawyers', 'law-firms'),
    'post_status'       => 'publish',
    'orderby'           => 'date',
    //'paged'             => $paged,
    'order'             => 'DESC',
    'posts_per_page'    => -1,
    'tax_query' => array(
        'taxonomy' => 'lawyers-category',
        'field' => 'slug',
        'terms' => 'zasdsadasd',
    )
);


$gen_posts = new WP_Query($args);

echo '<pre>';
print_r($gen_posts->posts);
echo '</pre>';


get_footer();