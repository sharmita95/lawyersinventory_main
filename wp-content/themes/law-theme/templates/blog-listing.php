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
// echo '<pre>';
// print_r($category_id);
// echo '</pre>';
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
<!--  Content  -->
<section class="single-page-content-sec">
    <div class="container mx-auto">
        <div class="content-sec-wrapper">
            <div class="left-content-sec">
                <div class="single-post-content">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); 
                endwhile; ?>

<!-- -------------------------------------Tags ------------------------------------------------------------------------- -->
                    <div class="tag-sec">
                        <div class="tag-title-sec">
                            <span class="content-common-title">
                                Tags
                            </span>
                        </div>
                        <div class="tags-wrapper">
                            <?php
                                $post_tags = get_the_tags();
                                if ($post_tags) {
                                    $counter = 0;
                                    foreach ($post_tags as $tag) {
                                        if ($counter < 8) { // Limit to 8 tags
                                            echo '<a class="tag-chip" href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                                            $counter++;
                                        }
                                    }
                                } else {
                                    echo '<p>No tags available.</p>';
                                }
                            ?>
                            
                        </div>
                    </div>
<!-- -------------------------------------------Comment form (pending) --------------------------------------------- -->
                    <div class="comment-from-sec">
                        <span class="content-common-title">
                            Leave a reply
                        </span>

                        <p class="comment-from-dsc">
                            Your email address will not be published. Required fields are marked *
                        </p>

                        <form class="comment-from">
                            <div class="comment-from-first-row">
                                <label class="comment-from-half" for="text">
                                    <input class="comment-from-common-input" type="text" placeholder="Name*">
                                </label>

                                <label class="comment-from-half" for="email">
                                    <input class="comment-from-common-input" type="email" placeholder="Email*">
                                </label>
                            </div>

                            <label class="comment-from-second-row" for="comment">
                                <textarea class="comment-from-common-textarea" rows="3" name="comment" id="" placeholder="Comment"></textarea>
                            </label>

                            <div class="comment-from-checkbox-wrapper">
                                <label class="comment-from-checkbox">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>

                                <p>
                                    Save my name, email, and website in this browser for the next time I comment.
                                </p>
                            </div>

                            <div class="comment-from-submit-wrapper">
                                <button class="l-d-r-f-btn">
                                    Submit
                                </button>
                            </div>

                        </form>

                    </div>
<!-- ------------------------------------------Comment Section  (pending) ------------------------------------------ -->
                    <div class="comment-replay-sec">
                        <h2 class="comment-replay-title">
                            1 Reply
                        </h2>


                        <div>
                            <figure>
                                <img src="" alt="">
                            </figure>
                            <div class="comment-replay-content">
                                <h2>
                                    Mashum Mollah
                                </h2>

                                <p>
                                    April 26, 2023 at 12:00 am
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--------------------------------- Side Bar  ---------------------------------------------------------->
            <?php echo  get_template_part('template-parts/side', 'bar'); ?>

        </div>

<!--------------------------------- Related Posts ---------------------------------------------------------->
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