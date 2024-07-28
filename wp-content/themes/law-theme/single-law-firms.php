<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $post_id = get_queried_object_id(); ?>


    Single Law Firm: <?php the_title(); ?>



    <?php endwhile; ?>

<?php get_footer(); ?>