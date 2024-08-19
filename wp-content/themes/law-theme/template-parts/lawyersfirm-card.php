<?php $postid = get_the_ID(); ?>

<div class="lawyers-firm-card">
    <figure class="lawyers-firm-c-img-ctrl">
    <?php $img_url = get_the_post_thumbnail_url($postid,'lawyers-list-thumbnail'); 
        if(!$img_url) $img_url= get_template_directory_uri() . '/images/lawyers-firm-3.png'; ?>
        <img class="image-responsive" src="<?php echo $img_url; ?>" alt="lawyers firm card image">
    </figure>

    <div class="lawyers-firm-card-content-wrapper">
        <!-- <div class="l-f-c-social-sec">
            <a class="l-f-c-social-card" href="">
                <span class="icon-facebook"></span>
            </a>

            <a class="l-f-c-social-card" href="">
                <span class="icon-linkedin"></span>
            </a>

            <a class="l-f-c-social-card" href="">
                <span class="icon-instagram"></span>
            </a>

            <a class="l-f-c-social-card" href="">
                <span class="icon-Twitter-x"></span>
            </a>

        </div> -->

        <h3 class="l-f-c-title">
            <?php the_title(); ?>
        </h3>

        <div class="l-f-c-icon-sec">
            <a href="<?php echo get_the_permalink($postid); ?>">
                <span class="icon-plus-out-line"></span>
            </a>
        </div>
    </div>
</div>