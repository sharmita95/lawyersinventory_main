<div class="side-bar-horizontal-card">
  <figure class="side-bar-h-c-image-ctrl">
    <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('side-bar-thumb', array('class' => 'image-responsive', 'alt' => get_the_title())); ?>
      <?php else: ?>
        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/side-bar-c-img.png'; ?>" alt="side bar image">
      <?php endif; ?>
    </figure>

  <div class="side-bar-h-c-content-sec">
    <h2 class="side-bar-h-c-title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
    <p class="side-bar-h-c-publish-date">
    <?php echo get_the_date(); ?>
    </p>
  </div>
</div>

<!-- side-bar-c-img -->