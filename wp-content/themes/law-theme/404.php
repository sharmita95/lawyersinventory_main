<?php get_header(); ?>

<section class="error-four-zero">
    <div class="container mx-auto h-full relative">
        <div class="error-four-zero-inner">

            <figure class="error-four-zero-image-controller">
                <img class="error-four-zero-image" src="<?php echo get_template_directory_uri() . '/images/svg/error-page-image.svg'; ?>" alt="lawyers image">
            </figure>

            <div class="error-four-zero-title">
                Page Not Found
            </div>

            <div class="error-four-zero-btn-wrapper">
                <a class="error-four-zero-btn" href="<?php echo home_url(); ?>">
                    <span class="icon-left-mid-arrow"></span>
                    <span>
                        Go Back To Home Page
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>