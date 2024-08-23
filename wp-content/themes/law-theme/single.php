<?php get_header(); 

$id = get_the_ID();
$category_detalis = get_the_category($id)[0];
$category_id = $category_detalis->term_id;
$relatable_posts = array(
    'posts_per_page' => 6, // Adjust number of posts as needed
    'post_status'    => 'publish',
    'post__not_in' => array($id),
    'cat'            =>$category_id,
);
while (have_posts()) : the_post();

?>
<!--  featured image -->
<?php if (has_post_thumbnail()): ?>
    <section class="single-banner-sec">
        <figure class="single-banner-ctrl">
        <?php the_post_thumbnail('single-page-thumbnail', ['class' => 'image-responsive']); ?>
        </figure>
    </section>
<?php endif; ?>


<section class="single-page-content-sec">
    <div class="container mx-auto">
        <div class="content-sec-wrapper">
            <div class="left-content-sec">
                <div class="single-post-content">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); 
                    endwhile; ?>

                    <!--------Tags ------>
                    <?php
                        $post_tags = get_the_tags();
                        if ($post_tags) :?>
                        <div class="tag-sec">
                            <div class="tag-title-sec">
                                <span class="content-common-title">
                                    Tags
                                </span>
                            </div>
                            <div class="tags-wrapper">
                                    <?php
                                        $counter = 0;
                                        foreach ($post_tags as $tag) {
                                            if ($counter < 8) { // Limit to 8 tags
                                                echo '<a class="tag-chip" href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                                                $counter++;
                                            }
                                        }?>
                            </div>
                        </div>
                    <?php endif;?>

                    <!-- Comment form -->
                    <?php comment_form(); ?>
                   
                    <!----------Comment Section  ---------->
                    <?php
                        // Fetch comments for the current post
                        $comments = get_comments(array(
                            'post_id' => get_the_ID(), // Get comments for the current post
                            'status'  => 'approve',    // Only approved comments
                            'parent' => 0,
                        ));
                        $total_comments = count($comments);
                    ?>
                    <div class="comment-replay-sec">
                        <h2 class="comment-replay-title">
                           <?php echo $total_comments;?> Reply
                        </h2>
                        <?php
                            if ($comments) {
                                display_comments_recursive($comments);
                            } else {
                                echo '<p>No comments yet.</p>';
                            }
                        ?>
                    </div>

                </div>
            </div>

            <!---------- Side Bar  --------------->
            <?php echo  get_template_part('template-parts/side', 'bar'); ?>

        </div>

        <!----------- Related Posts --------->
        <div class="single-page-related-sec">
            <div class="single-related-title-sec">
                <h2 class="single-related-title">related post</h2>
            </div>

            <div class="single-related-grid">
                <?php display_custom_card_posts($relatable_posts,'blog');?>
            </div>
        </div>

    </div>
</section>



<?php get_footer(); ?>