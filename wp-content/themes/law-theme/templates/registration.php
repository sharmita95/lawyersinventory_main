<?php /* Template Name: Registation */
get_header(); ?>


<section class="register-sec">
    <div class="container mx-auto ">

        <div class="register-sec-inner">
            <div class="register-left-sec">
                <h2 class="register-content-head">Let’s Create Something Great Together</h2>
                <p class="register-subcontent">We love to help! Drop us a note and we will get <br>back to you very soon.</p>
            </div>
            
            <?php echo do_shortcode('[LYI_registration_form]'); ?>    
            
        </div>

    </div>
</section>

<?php
get_footer();
?>