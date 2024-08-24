<?php /* Template Name: About Us Template  */ ?>
<?php get_header(); ?>

<section>
    <div class="container mx-auto">
        <div class="about-container-inner">

            <h2 class="about-us-title"><?php the_title(); ?></h2>
            <?php if (has_post_thumbnail()) { 
                    echo '<figure class="banner-image">';
                            the_post_thumbnail('about-us-thumbnail');
                    echo '</figure>';
                    }
            ?>
                
            <div class="about-comtent-sec">
                <?php
                the_content();
                ?>  
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>