<?php /* Template Name: Contact Us Page */
get_header();

 
$contact_address = get_option('contact_address');
$mail_id = get_option('contact_mail_id');
$primary_phone = get_option('contact_primary_phone');
$secondary_phone = get_option('contact_secondary_phone');
 
?>
 
<section class="contact-us-page-sec">
    <div class="container mx-auto">
        <div class="contact-us-page-inner">
 
            <div class="contact-us-left-side">
                <div class="contact-us-title-sec">
                    <h2 class="contact-us-title">
                        <?php the_title(); ?>
                    </h2>
                    <span class="contact-us-title-span"></span>
                </div>
 
                <div class="contact-d-f-c-content-card">
                    <div class="contact-d-f-c-content-card-left-icon-bar">
                        <span class="contact-left-icon-bar-separator-line"></span>
                        <span class="contact-left-icon-bar-separator-line-tow"></span>
                    </div>
                    <div class="contact-d-f-c-content-card-content-sec">
                        <?php if(!empty($mail_id))  { ?>
                            <h4 class="contact-d-f-c-content-card-common-text contact-d-f-c-content-card-email ">
                                <?php echo $mail_id; ?>
                            </h4>
                        <?php } ?>
 
                        <h4 class="contact-d-f-c-content-card-common-text contact-d-f-c-content-card-phone">
                            <?php if(!empty($primary_phone)) { ?>
                                <span><?php echo $primary_phone; ?></span>
                            <?php }
                            if(!empty($secondary_phone)) { ?>
                                <span><?php echo $secondary_phone; ?></span>
                            <?php } ?>
                        </h4>

                        <?php if(!empty($contact_address)) { ?> 
                        <h4 class="contact-d-f-c-content-card-common-text contact-d-f-c-content-card-location">
                            <?php echo $contact_address; ?>
                        </h4>
                        <?php } ?>

                    </div>
                </div>
            </div>
 
 
            <div class="contact-us-right-side">
                <?php the_content(); ?> 
            </div>
 
        </div>
    </div>
</section>

<?php get_footer(); ?>