<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $post_id = get_queried_object_id(); ?>


    Single Lawyers: <?php $title = get_the_title();
    // print_r(get_post_meta($post_id, 'address', true));
    // echo get_post_meta($post_id, 'phone_number', true);
    // echo get_post_meta($post_id, 'gmb_link', $gmb_link, true);
    // echo get_post_meta($post_id, 'gmb_description', $gmb_description, true);
    // echo get_post_meta($post_id, 'rating_count', $rating_count, true);
    // echo get_post_meta($post_id, 'total_rating', $total_ratings, true);
    // echo get_post_meta($post_id, 'user_url', $website, true);
    // echo get_post_meta($post_id, 'city', $city_name, true);
    // echo get_post_meta($post_id, 'description', wp_filter_post_kses($business_description), true);

    $myvals = get_post_meta($post_id);

    foreach($myvals as $key=>$val)
    {
        echo $key . ' : ' . $val[0] . '<br/>';
    }

    $img_url = get_the_post_thumbnail_url($post_id,'lawyers-list-thumbnail'); 
    if(!$img_url) $img_url= get_template_directory_uri() . '/images/lawyer-details-image.jpg';
    ?>


    <section class="lawyers-common-banner-sec">
        <div class="container mx-auto">
            <div class="lawyers-c-b-inner">
                <div class="l-c-b-title-wrapper">
                    <h2 class="l-c-b-title">
                        Best Lawyers In US
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="lawyers-details-sec">
        <div class="container mx-auto">
            <div class="lawyers-d-c">
                <div class="lawyers-d-c-image-sec">
                    <div class="lawyers-d-c-image-card">
                        <figure class="l-d-c-image-c-figure">
                            <img class="image-responsive" 
                            src="<?php echo $img_url; ?>" alt="<?php echo $title; ?>" class="l-d-c-image-c-img">
                        </figure>
                        <div class="lawyers-d-f-c-content-card">
                            <div class="lawyers-d-f-c-content-card-left-icon-bar">
                                <span class="left-icon-bar-separator-line"></span>
                                <span class="left-icon-bar-separator-line"></span>
                            </div>

                            <div class="lawyers-d-f-c-content-card-content-sec">
                                <h4 class="lawyers-d-f-c-content-card-common-text lawyers-d-f-c-content-card-email ">
                                    info@crarybuchanan.com 
                                </h4>

                                <h4 class="lawyers-d-f-c-content-card-common-text lawyers-d-f-c-content-card-phone">
                                    <span>
                                        877 123 0223
                                    </span>
                                    <span>
                                        877 123 0224
                                    </span>
                                </h4>

                                <h4 class="lawyers-d-f-c-content-card-common-text lawyers-d-f-c-content-card-location">
                                    Mark Anthony, Quai Henri IV, 75004 Paris, Ile-de-France France
                                </h4>

                            </div>
                        </div>
                    </div>



                </div>

                <div class="lawyers-d-c-wrapper">
                    <div class="lawyers-d-c-title-sec">
                        <div class="lawyers-d-c-title-content">
                            <h3 class="lawyers-d-c-title">
                                <?php echo $title; ?>
                            </h3>
                            <p class="lawyers-d-c-designation">
                                criminal lawyer
                            </p>
                        </div>

                        <div class="lawyers-d-c-rating-sec">
                            <div class="lawyers-d-c-rating-wrapper">
                                <div class="lawyers-d-c-rating-card">
                                    <span class="icon-ster"></span>
                                </div>

                                <div class="lawyers-d-c-rating-card">
                                    <span class="icon-ster"></span>
                                </div>

                                <div class="lawyers-d-c-rating-card">
                                    <span class="icon-ster"></span>
                                </div>

                                <div class="lawyers-d-c-rating-card">
                                    <span class="icon-ster"></span>
                                </div>

                                <div class="lawyers-d-c-rating-card">
                                    <span class="icon-hulf-ster"></span>
                                </div>
                            </div>
                            <p class="lawyers-d-c-rating-date">
                                4.5/5
                            </p>
                        </div>
                    </div>

                    <div class="lawyers-d-c-social-media-sec">
                        <div class="l-d-c-social-media">
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-facebook"></span>
                            </a>
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-instagram"></span>
                            </a>
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-linkedin"></span>
                            </a>
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-Twitter-x"></span>
                            </a>
                        </div>
                    </div>

                    <div class="join join-vertical w-full">
                        <div class="collapse collapse-arrow join-item border-t !rounded-0">
                            <input type="radio" name="my-accordion-4" checked="checked" />
                            <div class="collapse-title text-xl font-medium">Profile Description</div>
                            <div class="collapse-content">
                                <p>Houston Accident and Injury Lawyer Joe Stephens has been chosen as one of the few Houston Texas Super Lawyers and one of the few Houston accident lawyers who is Double Board Certified. A book author, he has been asked to many times to speak on T.V. about his victories in Houston, Texas for personal injury victims. His colleagues at the Harris County Courthouse in downtown Houston respect him, and treat his accident clients fairly when discussing injury settlements. If they don’t, this Texas Super Lawyer has no problem with filing suit in one of Houston, Texas 26 District Courts of Harris County, Texas.</p>
                            </div>
                        </div>
                        <div class="collapse collapse-arrow join-item border-t rounded-0">
                            <input type="radio" name="my-accordion-4" />
                            <div class="collapse-title text-xl font-medium">Qualifications</div>
                            <div class="collapse-content">
                                <p>Houston Accident and Injury Lawyer Joe Stephens has been chosen as one of the few Houston Texas Super Lawyers and one of the few Houston accident lawyers who is Double Board Certified. A book author, he has been asked to many times to speak on T.V. about his victories in Houston, Texas for personal injury victims. His colleagues at the Harris County Courthouse in downtown Houston respect him, and treat his accident clients fairly when discussing injury settlements. If they don’t, this Texas Super Lawyer has no problem with filing suit in one of Houston, Texas 26 District Courts of Harris County, Texas.</p>
                            </div>
                        </div>
                        <div class="collapse collapse-arrow join-item border-t rounded-0">
                            <input type="radio" name="my-accordion-4" />
                            <div class="collapse-title text-xl font-medium">Legal Issues</div>
                            <div class="collapse-content">
                                <p>Houston Accident and Injury Lawyer Joe Stephens has been chosen as one of the few Houston Texas Super Lawyers and one of the few Houston accident lawyers who is Double Board Certified. A book author, he has been asked to many times to speak on T.V. about his victories in Houston, Texas for personal injury victims. His colleagues at the Harris County Courthouse in downtown Houston respect him, and treat his accident clients fairly when discussing injury settlements. If they don’t, this Texas Super Lawyer has no problem with filing suit in one of Houston, Texas 26 District Courts of Harris County, Texas.</p>
                            </div>
                        </div>
                        <div class="collapse collapse-arrow join-item border-y rounded-0">
                            <input type="radio" name="my-accordion-4" />
                            <div class="collapse-title text-xl font-medium">Cost & Availability</div>
                            <div class="collapse-content">
                                <p>Houston Accident and Injury Lawyer Joe Stephens has been chosen as one of the few Houston Texas Super Lawyers and one of the few Houston accident lawyers who is Double Board Certified. A book author, he has been asked to many times to speak on T.V. about his victories in Houston, Texas for personal injury victims. His colleagues at the Harris County Courthouse in downtown Houston respect him, and treat his accident clients fairly when discussing injury settlements. If they don’t, this Texas Super Lawyer has no problem with filing suit in one of Houston, Texas 26 District Courts of Harris County, Texas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>


    <?php endwhile; ?>

<?php get_footer(); ?>