<?php /* Template Name: Write For Us Temp  */ ?>

<?php get_header(); ?>

<section>
    <div class="container mx-auto">
        <div class="about-container-inner">

            <h2 class="write-us-title"><?php the_title(); ?></h2>
                <?php if (has_post_thumbnail()) { 
                    echo '<figure class="write-banner-image">';
                            the_post_thumbnail('write-for-us-thumbnail');
                    echo '</figure>';
                    }
                ?>

            <div class="write-content-sec">
                <?php
                    the_content();
                ?> 
            </div>

        </div>

    </div>
</section>

<?php get_footer(); ?>