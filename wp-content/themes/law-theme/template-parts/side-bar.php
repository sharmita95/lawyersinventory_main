<?php
    // Define the arguments for WP_Query
    $recent_posts = array(
        'post_type'      => 'post',
        'posts_per_page' => 4, 
        'post_status'    => 'publish', 
        'order'          => 'DESC', 
        'orderby'        => 'date' // Order by date - for recent post
    );

?>
<div class="side-bar-sec">
    <div class="side-bar">
        <div class="side-bar-inner">
       <?php if (!is_author()) {
                // Include the publisher card if not on an author archive page
                get_template_part('template-parts/publisher', 'card');
            }?>
<!---------------------------------- Sidebar search  ------------------------------------------------->
            <div class="side-search-card">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="side-search-from">
                    <input class="side-search-input" type="text" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>">
                    <button type="submit" class="side-search-from-button">
                        <span class="icon-search"></span>
                    </button>
                </form>
            </div>

<!---------------------------------------Side Bar Social Share Post  ------------------------------------>
            <div class="side-bar-social-sec">

                <h2 class="side-bar-title">
                    Keep in Touch
                </h2>

                <div class="side-bar-social-card-wrapper">
                    <button class="side-bar-social-card" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href), '_blank')">
                        <span class="icon-facebook"></span>
                    </button>
                    <button class="side-bar-social-card" onclick="window.open('https://www.instagram.com/?url='+encodeURIComponent(window.location.href), '_blank')">
                        <span class="icon-instagram"></span>
                    </button>
                    <button class="side-bar-social-card" onclick="window.open('https://x.com/intent/tweet?url='+encodeURIComponent(window.location.href), '_blank')">
                        <span class="icon-Twitter-x"></span>
                    </button>
                    <button class="side-bar-social-card" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(window.location.href), '_blank')">
                        <span class="icon-linkedin"></span>
                    </button>
                </div>

            </div>

            <div class="side-bar-recent-post-sec">
                <h2 class="side-bar-title">
                    Keep in Touch
                </h2>

                <div class="side-bar-card-wrapper">
                    <?php
                    display_custom_card_posts($recent_posts,'horizontal');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>