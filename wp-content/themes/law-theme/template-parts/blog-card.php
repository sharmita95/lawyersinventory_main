<div class="blog-card">
    <figure class="blog-card-image-ctrl">
        <?php
            // Display the post thumbnail if available
            if (has_post_thumbnail()) {
                the_post_thumbnail('related-posts-thumbnail', array('class' => 'image-responsive'));
            } else {
                // Default image if no thumbnail is set
                echo '<img class="image-responsive" src="' . get_template_directory_uri() . '/images/lawyers-firm-3.png" alt="blog card image">';
            }
        ?>
        
    </figure>

    <div class="blog-card-content-sec">
        <div class="blog-card-c-date-publisher-sec">
            <span class="blog-card-c-date-publisher-text">
                <?php echo get_the_date('d F Y'); ?>
            </span>
            <span class="blog-card-c-date-publisher-text">
                -
            </span>
            <span class="blog-card-c-date-publisher-text">
                By <?php echo get_the_author(); ?>
            </span>
        </div>

        <h3 class="blog-card-title">
            <?php the_title(); ?>
        </h3>

        <a class="blog-card-c-read-more-cta" href="<?php the_permalink(); ?>">
            <span>
                Read More
            </span>
            
            <span class="icon-left-mid-arrow"></span>
        </a>
    </div>
</div>