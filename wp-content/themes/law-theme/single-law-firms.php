<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $post_id = get_queried_object_id(); ?>

    <section class="lawyers-common-banner-sec">
        <div class="container mx-auto">
            <div class="lawyers-c-b-inner">
                <div class="l-c-b-title-wrapper">
                    <h2 class="l-c-b-title">
                        Law firm
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="lawyers-details-sec">
        <div class="container mx-auto">
            <div class="lawyers-d-c">
                <div class="lawyers-d-c-image-sec">

                    <div class="lawyers-d-f-c-image-card">
                        <figure class="l-d-f-c-image-c-figure">
                            <!-- <img class="image-responsive" 
                            src="<?php //echo get_template_directory_uri() . '/images/featured-law-firm-banner-image.png'; ?>" 
                            alt="lawyers image"> -->
                            <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'image-responsive' ) ); ?>
                        </figure>
                    </div>

                </div>
                <div class="lawyers-d-c-wrapper">
                    <div class="lawyers-d-c-title-sec">
                        <div class="lawyers-d-f-c-title-content">
                            <h3 class="lawyers-d-f-c-title">
                                <?php the_title(); ?>
                            </h3>
                        </div>

                        <div class="lawyers-d-c-rating-sec">
                            <div class="lawyers-d-c-rating-wrapper">
                            </div>
                            <p class="lawyers-d-c-rating-date">
                                4.5/5
                            </p>
                        </div>
                    </div>

                    <div class="lawyers-d-c-social-media-sec">
                        <div class="l-d-c-social-media">
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-fb"></span>
                            </a>
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-instarm"></span>
                            </a>
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-linked-in"></span>
                            </a>
                            <a href="" class="l-d-c-social-media-card">
                                <span class="icon-Vector"></span>
                            </a>
                        </div>
                    </div>


                    <div class="join join-vertical w-full">
                        <div class="collapse collapse-arrow join-item border-t !rounded-0">
                            <input type="radio" name="my-accordion-4" checked="checked" />
                            <div class="collapse-title text-xl font-medium">About Us</div>
                            <div class="collapse-content">
                                <p>
                                    Crary Buchanan, Attorneys At Law, in Stuart, FL, serves clients in a number of ways from personal injury to business transactions. The firm is dedicated to helping clients no matter what their legal issues are. Founded in 1927, the firm has a history and reputation for being strong for the community and clients. Our Services
                                </p>
                            </div>
                        </div>
                        <div class="collapse collapse-arrow join-item border-t rounded-0">
                            <input type="radio" name="my-accordion-4" />
                            <div class="collapse-title text-xl font-medium">Legal Issues</div>
                            <div class="collapse-content">
                                <p>Crary Buchanan, Attorneys At Law, in Stuart, FL, serves clients in a number of ways from personal injury to business transactions. The firm is dedicated to helping clients no matter what their legal issues are. Founded in 1927, the firm has a history and reputation for being strong for the community and clients. Our Services</p>
                            </div>
                        </div>
                        <div class="collapse collapse-arrow join-item border-t rounded-0">
                            <input type="radio" name="my-accordion-4" />
                            <div class="collapse-title text-xl font-medium">Cost & Availability</div>
                            <div class="collapse-content">
                                <p>Crary Buchanan, Attorneys At Law, in Stuart, FL, serves clients in a number of ways from personal injury to business transactions. The firm is dedicated to helping clients no matter what their legal issues are. Founded in 1927, the firm has a history and reputation for being strong for the community and clients. Our Services</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lawyers-d-c-register-sec">
                <div class="l-d-register-content-side">
                    <h2 class="">
                        Get A Consultation!
                    </h2>
                    <p class="">
                        Register with us to schedule a free consultation
                    </p>
                </div>

                <div class="l-d-register-from">

                </div>

            </div>

            <div class="review-rating-sec">
                <div class="r-r-sec-title-wrapper">
                    <h2 class="r-r-sec-title">
                        Review
                    </h2>
                </div>
                <div class="review-rating-card-grid-wrapper">
                    <div class="review-rating-card">


                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endwhile; ?>

<?php get_footer(); ?>