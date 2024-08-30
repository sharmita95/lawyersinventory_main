<?php
// Define the arguments for WP_Query
$recent_posts = array(
    'post_type'      => 'post',
    'posts_per_page' => 4, 
    'post_status'    => 'publish', 
    'order'          => 'DESC', 
    'orderby'        => 'date' // Order by date - for recent post
);

$facebook_url = get_option('facebook_url');
$twitter_url = get_option('twitter_url');
$linkedin_url = get_option('linkedin_url');
$instagram_url = get_option('instagram_url');

?>
<div class="side-bar-sec">
    <div class="side-bar">
        <div class="side-bar-inner">
            <?php if (is_singular()) {
                    // Include the publisher card if not on an author archive page
                    get_template_part('template-parts/publisher', 'card');
                }?>

            <!--- Search --->
            <div class="side-search-card">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="side-search-from">
                    <input class="side-search-input" type="text" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>">
                    <button type="submit" class="side-search-from-button">
                        <span class="icon-search"></span>
                    </button>
                </form>
            </div>

            <!---- Side Bar Social Share Post ---->
            <div class="side-bar-social-sec">

                <h2 class="side-bar-title">
                    Keep in Touch
                </h2>

                <div class="side-bar-social-card-wrapper">
                    <?php if(!empty($facebook_url)) { ?>
                        <a href="<?php echo $facebook_url; ?>" target="_blank" rel="noopener noreferrer nofollow">
                            <button class="side-bar-social-card" >
                                <span class="icon-facebook"></span>
                            </button>
                        </a>
                    <?php } if(!empty($instagram_url)) { ?>
                        <a href="<?php echo $instagram_url; ?>" target="_blank" rel="noopener noreferrer nofollow">
                            <button class="side-bar-social-card" >
                                <span class="icon-instagram"></span>
                            </button>
                        </a>
                    <?php } if(!empty($twitter_url)) { ?>
                        <a href="<?php echo $twitter_url; ?>" target="_blank" rel="noopener noreferrer nofollow">
                            <button class="side-bar-social-card" >
                                <span class="icon-Twitter-x"></span>
                            </button>
                        </a>
                    <?php } if(!empty($linkedin_url)) { ?>
                        <a href="<?php echo $linkedin_url; ?>" target="_blank" rel="noopener noreferrer nofollow">
                            <button class="side-bar-social-card" >
                                <span class="icon-linkedin"></span>
                            </button>
                        </a>
                    <?php } ?>
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