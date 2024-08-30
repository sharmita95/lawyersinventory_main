<?php $postid = get_the_ID();
$practice_arr = get_the_terms( $postid, 'lawyers-category' ); ?>

<div class="lawyers-card">
    <figure class="lawyers-card-figure">
        <?php $img_url = get_the_post_thumbnail_url($postid,'lawyers-list-thumbnail'); 
        if(!$img_url) $img_url= get_template_directory_uri() . '/images/Lawyers-5.png'; ?>
        <img class="image-responsive" src="<?php echo $img_url; ?>" alt="lawyers image">
    </figure>

    <div class="lawyers-card-content">
        <div class="lawyers-card-title-button-wrapper">
            <div class="lawyers-card-title-wrapper">
                <h2 class="lawyers-card-title"><?php the_title(); ?></h2>
                <p class="lawyers-card-subtitle">
                    <?php echo $practice_arr[0]->name; ?>
                </p>
            </div>
            <button class="lawyers-card-button">
                <a href="<?php echo get_the_permalink($postid); ?>">
                    <span class="icon-arrow-right2"></span>
                </a>
            </button>
        </div>
        <!-- <div class="lawyers-card-social-wrapper">
            <div class="lawyers-card-social-inner-wrapper">
                <a class="lawyers-card-social-icon" href="">
                    <span class="icon-instagram"></span>
                </a>
                <a class="lawyers-card-social-icon" href="">
                    <span class="icon-facebook"></span>
                </a>
                <a class="lawyers-card-social-icon" href="">
                    <span class="icon-linkedin"></span>
                </a>
                <a class="lawyers-card-social-icon" href="">
                    <span class="icon-Twitter-x"></span>
                </a>
            </div>
        </div> -->
    </div>
</div>