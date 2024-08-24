<?php //print_r($args); ?>

<div class="issue-card">

    <figure class="issue-card-icon-wrapper">
        <img class="issue-card-icon-image" 
        src="<?php echo get_template_directory_uri() . '/images/issue-card-icon.png'; ?>" 
        alt=" issue card icon image">
    </figure>

    <h2 class="issue-card-title"><?php echo $args->name; ?></h2>
    <p class="front-about-us-inner-p"><?php echo $args->description; ?></p>

    <div class="issue-card-plus-icon-wrapper">
        <span class="icon-plus-out-line"></span>
    </div>
    
</div>