<?php get_header(); 
global $wp_query;
$archive_object = get_queried_object();
$term_slug = get_queried_object()->slug;
$parent_id = $archive_object->parent;
$grand_parent_id = (!empty($parent_id)) ? get_term($parent_id)->parent : '';

//echo wp_strip_all_tags(single_cat_title()); 
echo "Law Firms<br>";


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


get_footer();