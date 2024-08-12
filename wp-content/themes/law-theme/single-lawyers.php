<?php get_header(); ?>

<?php 
    while (have_posts()) : the_post();
        $post_id = get_queried_object_id();
        $title = get_the_title();
        $myvals = get_post_meta($post_id);

        foreach($myvals as $key=>$val)
        {
            echo $key . ' : ' . $val[0] . '<br/>';
            if($key == 'associated_email') $email = $val[0];
            if($key == 'phone_number') $phone = $val[0];
            if($key == 'address') $address = $val[0];
            if($key == 'profile_description') $profile_description  = $val[0];
            if($key == 'qualification') $qualification = $val[0];
            if($key == 'cost') $cost  = $val[0];
            if($key == 'availability') $availability  = $val[0];
            if($key == 'gmb_link') $gmb_link  = $val[0];
            if($key == 'rating') $rating  = $val[0];
            if($key == 'total_rating') $total_rating  = $val[0];
            if($key == 'fb_link') $fb_link  = $val[0];
            if($key == 'insta_link') $insta_link  = $val[0];
            if($key == 'linkedin_url') $linkedin_url  = $val[0];
            if($key == 'twitter_url') $twitter_url  = $val[0];

            // if($key == 'latitude') $lat  = !empty($val[0]) ? '70.999956':'';
            // if($key == 'longitude') $lon  = !empty($val[0]) ? '70.999956':'';
            if($key == 'latitude') $lat  = $val[0];
            if($key == 'longitude') $lon  = $val[0];
        }

        $img_url = get_the_post_thumbnail_url($post_id,'lawyers-list-thumbnail'); 
        if(!$img_url) $img_url= get_template_directory_uri() . '/images/lawyer-details-image.jpg';

        $api_key = '66a802526abcd459524436has4fc924';
        //Generating Lat and Lon
        if (!empty($address)) {
            $original_address = get_the_author_meta('first_name', $post_id).', '.$address;

            //Checking if it exists on the DB. If not generate lat, lon
            if (empty($lat) && empty($lon)) { 
                $new_address = str_replace(" ", "+", $original_address);
                $json = file_get_contents("https://geocode.maps.co/search?q=$new_address&api_key=$api_key");
                $json = json_decode($json);
                if (!empty($json)) {
                    $lat = $json[0]->lat;
                    $lon = $json[0]->lon;
                    update_post_meta($post_id, 'latitude', $lat);
                    update_post_meta($post_id, 'longitude', $lon);
                    // echo 'ABCD-';
                } else {

                    $new_address = str_replace(" ", "+", $address);
                    $json = file_get_contents("https://geocode.maps.co/search?q=$new_address&api_key=$api_key");
                    $json = json_decode($json);
                    if (!empty($json)) {
                        $lat = $json[0]->lat;
                        $lon = $json[0]->lon;
                        update_post_meta($post_id, 'latitude', $lat);
                        update_post_meta($post_id, 'longitude', $lon);
                    }

                }
            }
        }

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
                                    <?php if(!empty($email)) { ?>
                                        <h4 class="lawyers-d-f-c-content-card-common-text lawyers-d-f-c-content-card-email ">
                                            <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                        </h4>
                                    <?php }
                                    if(!empty($phone)) { ?>
                                        <h4 class="lawyers-d-f-c-content-card-common-text lawyers-d-f-c-content-card-phone">
                                            <span><?php echo $phone; ?></span>
                                        </h4>
                                    <?php }
                                    if(!empty($address)) { ?>
                                        <h4 class="lawyers-d-f-c-content-card-common-text lawyers-d-f-c-content-card-location">
                                            <?php echo $address; ?>
                                        </h4>
                                    <?php } ?>
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
                                <?php if(!empty($rating)) { ?>
                                    <p class="lawyers-d-c-rating-date">
                                        <?php echo $rating; ?>/5
                                    </p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="lawyers-d-c-social-media-sec">
                            <div class="l-d-c-social-media">
                                <?php if(!empty($fb_link)) { ?>
                                    <a href="<?php echo $fb_link; ?>" target="_blank" rel="noopener nofollow noreferrer" class="l-d-c-social-media-card">
                                        <span class="icon-facebook"></span>
                                    </a>
                                <?php }
                                if(!empty($insta_link)) { ?>
                                    <a href="<?php echo $insta_link; ?>" target="_blank" rel="noopener nofollow noreferrer" class="l-d-c-social-media-card">
                                        <span class="icon-instagram"></span>
                                    </a>
                                <?php }
                                if(!empty($linkedin_url)) { ?>
                                    <a href="<?php echo $linkedin_url; ?>" target="_blank" rel="noopener nofollow noreferrer" class="l-d-c-social-media-card">
                                        <span class="icon-linkedin"></span>
                                    </a>
                                <?php }
                                if(!empty($twitter_link)) { ?>
                                    <a href="<?php echo $twitter_link; ?>" target="_blank" rel="noopener nofollow noreferrer" class="l-d-c-social-media-card">
                                        <span class="icon-Twitter-x"></span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="join join-vertical w-full">
                            <?php if(!empty($profile_description)) { ?>
                            <div class="collapse collapse-arrow join-item border-t !rounded-0">
                                <input type="radio" name="my-accordion-4" checked="checked" />
                                <div class="collapse-title text-xl font-medium">Profile Description</div>
                                <div class="collapse-content">
                                    <p><?php echo $profile_description; ?></p>
                                </div>
                            </div>
                            <?php }
                            if(!empty($qualification)) { ?>
                            <div class="collapse collapse-arrow join-item border-t rounded-0">
                                <input type="radio" name="my-accordion-4" />
                                <div class="collapse-title text-xl font-medium">Qualifications</div>
                                <div class="collapse-content">
                                    <p><?php $qualification; ?></p>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="collapse collapse-arrow join-item border-t rounded-0">
                                <input type="radio" name="my-accordion-4" />
                                <div class="collapse-title text-xl font-medium">Legal Issues</div>
                                <div class="collapse-content">
                                    <p>Houston Accident and Injury Lawyer Joe Stephens has been chosen as one of the few Houston Texas Super Lawyers and one of the few Houston accident lawyers who is Double Board Certified. A book author, he has been asked to many times to speak on T.V. about his victories in Houston, Texas for personal injury victims. His colleagues at the Harris County Courthouse in downtown Houston respect him, and treat his accident clients fairly when discussing injury settlements. If they don’t, this Texas Super Lawyer has no problem with filing suit in one of Houston, Texas 26 District Courts of Harris County, Texas.</p>
                                </div>
                            </div>

                            <?php 
                            if(!empty($cost) || !empty($availability)) { ?>
                            <div class="collapse collapse-arrow join-item border-y rounded-0">
                                <input type="radio" name="my-accordion-4" />
                                <div class="collapse-title text-xl font-medium">Cost & Availability</div>
                                <div class="collapse-content">
                                    <?php if(!empty($cost)) { 
                                        echo '<p>'.$cost.'</p>';
                                    } 
                                    if(!empty($availability)) { 
                                        echo '<p>'.$availability.'</p>';
                                    } ?>
                                    
                                </div>
                            </div>
                            <?php } ?>

                            <?php 
                            if(!empty($lan) || !empty($lon)) { ?>
                            <div class="collapse collapse-arrow join-item border-y rounded-0">
                                <input type="radio" name="my-accordion-4" />
                                <div class="collapse-title text-xl font-medium">Map</div>
                                <div class="collapse-content">
                                
                                    <iframe 
                                    width="100%" 
                                    height="200" 
                                    frameborder="0" 
                                    scrolling="no" 
                                    marginheight="0" 
                                    marginwidth="0" 
                                    src="https://maps.google.com/maps?q=<?php echo $lat; ?>,<?php echo $lon; ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" />

                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

            </div>

        </section>

    <?php endwhile; ?>

<?php get_footer(); ?>