<div class="side-bar-user-card">
    <div class="side-bar-user-card-img-sec">
        <figure class="side-bar-user-card-img-ctrl">
        <?php
            $author_id = get_the_author_meta('ID');
            echo get_avatar($author_id, 96, '', '', array('class' => 'image-responsive'));
            ?>
        </figure>
    </div>

    <div class="side-bar-user-card-content-sec">
        <h2 class="side-bar-user-card-title">
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a>
        </h2>
        <p class="side-bar-user-card-dsc">
        <?php echo esc_html(get_the_author_meta('description', $author_id)); ?>
        </p>

    </div>
</div>