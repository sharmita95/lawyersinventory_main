<?php /* Template Name: Front Page Temp */
get_header(); 

$practice_terms = get_terms( 'lawyers-category', array( 'hide_empty' => true, 'parent' => 0 ) ); 
$country_terms = get_terms( 'lawyers-location', array( 'hide_empty' => true, 'parent' => 0 ) );

?>

<!-- when  developer start working need to remove this sec  -->

<!-- banner complicate  sec -->
<section class="front-banner-sec">

    <div class="container mx-auto">
        <div class="front-banner-inner">
            <div class="front-page-banner-from-card-sec order-2 md:order-1 ">
                <div class="front-page-banner-from-card-wrapper">
                    <div class="front-page-banner-from-card">
                        <div class="front-page-banner-from-card-inner">
                            <div class="front-page-banner-from-card-inner-inner">

                                <div class="flex w-full justify-center">
                                    <figure class="banner-from-img-ctrl">
                                        <img src="<?php echo get_template_directory_uri() . '/images/log-type-icon.png'; ?>" 
                                        alt="banner from logo image">
                                    </figure>
                                </div>

                                <div class="flex w-full justify-center">
                                    <h2 class="banner-from-title">
                                        Lawyers Directory
                                    </h2>
                                </div>

                                <div class="banner-subtitles-wrapper">
                                    <h3 class="banner-from-subtitles">
                                        Search For Law Firm & Lawyers on World Wide Basis
                                    </h3>
                                </div>

                                <div class="banner-form-sec" id="home-page-form">
                                    <div class="banner-form-check-box-sec">
                                        <div class="banner-form-check-box-card border-r border-white">
                                            <label class="front-form-label-1" for="lawyers">
                                                Lawyers
                                                <input class="front-input-check" type="radio" id="lawyers" name="type" value="lawyers" required="" checked="checked">
                                            </label>
                                        </div>

                                        <div class="banner-form-check-box-card">
                                            <label class="front-form-label-2" for="lawyersfirm">
                                                Lawyers Firm
                                                <input class="front-input-check" type="radio" id="lawyersfirm" name="type" value="law-firms" required="">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="front-from-select-sec">

                                        <div class="front-from-select-wrapper">
                                            <select class="front-from-select" name="issue" id="issue">
                                                <option value="" selected="">Any issue</option>
                                                <?php foreach($practice_terms as $term) { ?>
                                                    <option slug="<?php echo $term->slug; ?>" value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="front-from-select-wrapper">
                                            <select class="front-from-select" name="country" id="country">
                                                <option value="" selected="">choose a Country</option>                                                
                                                <?php foreach($country_terms as $country) { ?>
                                                    <option slug="<?php echo $country->slug; ?>" value="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <a href="<?php echo home_url('find-lawyers'); ?>" id="service-redirect">
                                        <button class="front-from-button">
                                            FIND
                                            <span class="icon-left-mid-arrow"></span>
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="front-page-banner-left-img-sec order-1 md:order-2">
                <figure class="front-page-banner-img-ctrl">
                    <img class="w-full h-fit mb-[-1px] " src="<?php echo get_template_directory_uri(); ?>/images/banner-image.png" alt=" banner image file ">
                </figure>
            </div>
        </div>
    </div>

    <!-- <img src="<?php // echo get_template_directory_uri() . '/images/log-type-icon.png'; 
                    ?>" alt="banner from logo image"> -->
</section>

<!-- Top Legal Issues -->
<section class="front-top-legal-issues-sec">
    <div class=" container mx-auto">
        <div class="front-common-title-wrapper">
            <h2 class="front-common-title">
                Top Legal Issues
            </h2>
        </div>

        <div class="swiper issueSwiper">
            <div class="swiper-wrapper">

                <?php                
                foreach( $practice_terms as $term ) { ?>

                    <div class="swiper-slide">
                        <?php get_template_part('template-parts/issue', 'card', $term); ?>
                    </div>                    
                
                    <?php
                } 
                ?>

            </div>
            <div class="swiper-button-next" style="right: 0px !important;"></div>
            <div class="swiper-button-prev" style="left: 0px !important;"></div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="view-all-btn-wrapper">
            <a class="view-all-btn" href="<?php echo home_url('/practice'); ?>">
                View all
                <span class="icon-left-mid-arrow"></span>
            </a>
        </div>

    </div>
    </div>
</section>


<!-- Featured Lawyers -->
<section>
    <div class=" container mx-auto">

    </div>

</section>


<!-- About Us -->
<section class="front-Lawyers-sec">
    <div class="container mx-auto">
        <div class="front-common-title-wrapper">
            <h2 class="front-common-title ">
                Featured Lawyers
            </h2>
        </div>
        <div class="">
            <div class="swiper LawfirmSwiper ">
                <div class="swiper-wrapper">
                   
                <?php
                $args_lawyer = array(
                'post_type'=> 'lawyers',
                'orderby'    => 'date',
                'post_status' => 'publish',
                'order'    => 'DESC',
                'posts_per_page' => 4 // this will retrive all the post that is published 
                );
                $result_lawyer = new WP_Query( $args_lawyer );
                
                if ( $result_lawyer-> have_posts() ) : 
                    while ( $result_lawyer->have_posts() ) : $result_lawyer->the_post(); ?>

                        <div class="swiper-slide">
                            <?php get_template_part('template-parts/lawyers', 'card'); ?>
                        </div>                    
                    
                        <?php
                    endwhile; 
                endif; 
                wp_reset_postdata(); ?>

                </div>
                <div class="swiper-button-next" style="right: 0px !important;"></div>
                <div class="swiper-button-prev" style="left: 0px !important;"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="view-all-btn-wrapper">
            <a class="view-all-btn" href="<?php echo home_url('/find-lawyers'); ?>">
                View all
                <span class="icon-left-mid-arrow"></span>
            </a>
        </div>
    </div>
</section>


<!-- Featured Lawfirm-->

<section class="front-Lawfirm-sec">
    <div class="container mx-auto">
        <div class="front-common-title-wrapper">
            <h2 class="front-common-title ">
                Featured Lawfirm
            </h2>
        </div>

        <div class="front-Lawfirm-slider-wrapper">
            <img class="front-Lawfirm-element-left" src="<?php echo get_template_directory_uri(); ?>/images/left-element.png" alt="front Lawfirm element left">
            <div class="swiper LawyersSwiper">
                <div class="swiper-wrapper">

                <?php
                $args_firm = array(
                    'post_type'=> 'law-firms',
                    'orderby'    => 'date',
                    'post_status' => 'publish',
                    'order'    => 'DESC',
                    'posts_per_page' => 4 // this will retrive all the post that is published 
                    );
                    $result_firm = new WP_Query( $args_firm );
                    if ( $result_firm-> have_posts() ) : 
                        while ( $result_firm->have_posts() ) : $result_firm->the_post(); ?>
                            <div class="swiper-slide">
                                <?php get_template_part('template-parts/lawyersfirm', 'card'); ?>
                            </div>

                        <?php endwhile; 
                    endif; 
                    wp_reset_postdata(); ?>


                    <?php
                    /*$ ?>
                            <div class="swiper-slide">
                                <?php get_template_part('template-parts/lawyersfirm', 'card'); ?>
                            </div>
                            ?>
                        </div>
                        <?php
                         */ ?>
                    
                </div>
                <div class="swiper-button-next" style="right: 0px !important;"></div>
                <div class="swiper-button-prev" style="left: 0px !important;"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="view-all-btn-wrapper">
            <a class="view-all-btn" href="<?php echo home_url('/find-lawfirms'); ?>">
                View all
                <span class="icon-left-mid-arrow"></span>
            </a>
        </div>
    </div>
    <img class="front-Lawfirm-element-bottom" src="<?php echo get_template_directory_uri(); ?>/images/down-element.png" alt="front Lawfirm element bottom">
</section>

<!-- Our Latest Posts -->
<section class="about-and-latest-post-sec">
    <div class="container mx-auto ">
        <div class="front-about-us-sec">

            <div class="front-common-title-wrapper">
                <h2 class="front-common-title ">
                    About Us
                </h2>
            </div>

            <div class="front-about-us-inner">
                <?php 
                $page_slug = 'about-us'; // Replace with your desired slug
                $page = get_page_by_path($page_slug);
                if ($page_slug) {
                    $about_excerpt = $page->post_excerpt;
                    echo $about_excerpt;
                } ?>

                <div class="front-latest-button-wrapper">
                    <a href="<?php echo home_url('/about-us'); ?>" class="common-load-more-button">
                        know more <span class="icon-left-mid-arrow"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="front-latest-post-sec">

            <div class="front-common-title-wrapper">
                <h2 class="front-common-title ">
                    Our Latest Posts
                </h2>
            </div>

            <div class="front-latest-grid-sec">
                <?php
                $args2 = array(
                'post_type'=> 'post',
                'orderby'    => 'date',
                'post_status' => 'publish',
                'order'    => 'DESC',
                'posts_per_page' => 3 // this will retrive all the post that is published 
                );
                $result2 = new WP_Query( $args2 );
                if ( $result2-> have_posts() ) : 
                    while ( $result2->have_posts() ) : $result2->the_post();
                            get_template_part('template-parts/blog', 'card');
                    endwhile; 
                endif; 
                wp_reset_postdata(); ?>

            </div>

            <div class="front-latest-button-wrapper">
                <a class="common-load-more-button" href="<?php echo home_url('/blogs'); ?>">
                    View all <span class="icon-left-mid-arrow"></span>
                </a>
            </div>

        </div>
    </div>
</section>


<?php get_footer() ?>