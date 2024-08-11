<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $post_id = get_queried_object_id(); ?>


    Single Lawyers: <?php the_title();
    print_r(get_post_meta($post_id, 'address', true));
    echo get_post_meta($post_id, 'phone_number', true);
    echo get_post_meta($post_id, 'gmb_link', $gmb_link, true);
    echo get_post_meta($post_id, 'gmb_description', $gmb_description, true);
    echo get_post_meta($post_id, 'rating_count', $rating_count, true);
    echo get_post_meta($post_id, 'total_rating', $total_ratings, true);
    echo get_post_meta($post_id, 'user_url', $website, true);
    echo get_post_meta($post_id, 'city', $city_name, true);
    echo get_post_meta($post_id, 'description', wp_filter_post_kses($business_description), true);
?>


    <?php endwhile; ?>

<?php get_footer(); ?>