    <?php
    $facebook_url = get_option('facebook_url');
    $twitter_url = get_option('twitter_url');
    $linkedin_url = get_option('linkedin_url');
    $instagram_url = get_option('instagram_url');
    ?>
    
    </main>
        <footer class="footer">
            <div class="container mx-auto ">
                <div class="footer-inner-container">
                    <div class="footer-tree-sec ">
                        <div class="footer-link-sec md:order-1 order-2">
                            <h3 class="footer-link-header relative">IMPORTANT LINKS</h3>
                            <ul class="footer-ul">
                                <li class="footer-ul-li">
                                    <a class="footer-ul-li-link" href="<?php echo home_url('/find-lawyers'); ?>">Find a Lawyer</a>
                                </li>
                                <li class="footer-ul-li">
                                    <a class="footer-ul-li-link" href="<?php echo home_url('/find-lawfirms'); ?>">Find a Lawfirm</a>
                                </li>
                                <li class="footer-ul-li">
                                    <a class="footer-ul-li-link" href="<?php echo home_url('/practice'); ?>">Practice</a>
                                </li>
                                <li class="footer-ul-li">
                                    <a class="footer-ul-li-link" href="<?php echo home_url('/blogs'); ?>">Blogs</a>
                                </li>
                            </ul>
                        </div>

                        <div class="footer-logo-social-email md:order-2 order-1">
                            <div class="footer-logo-sec">
                                <a class="w-fit" href="">
                                    <figure class="footer-logo-controller">
                                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/lawyersinventory-footer-logo.png'; ?>" alt="Lawyers Inventory footer Logo">
                                    </figure>
                                </a>
                            </div>

                            <div class="footer-social-wrapper">
                                <?php if(!empty($facebook_url)) { ?>
                                <a class="footer-social-icon" href="<?php echo $facebook_url; ?>" rel="noopener noreferrer nofollow" target="_blank" aria-label="social_link">
                                    <span class="icon-facebook"></span>
                                </a>
                                <?php } if(!empty($linkedin_url)) { ?>
                                <a class="footer-social-icon" href="<?php echo $linkedin_url; ?>" rel="noopener noreferrer nofollow" target="_blank" aria-label="social_link">
                                    <span class="icon-linkedin"></span>
                                </a>
                                <?php } if(!empty($twitter_url)) { ?>
                                <a class="footer-social-icon" href="<?php echo $twitter_url; ?>" rel="noopener noreferrer nofollow" target="_blank" aria-label="social_link">
                                    <span class="icon-Twitter-x"></span>
                                </a>
                                <?php } if(!empty($instagram_url)) { ?>
                                <a class="footer-social-icon" href="<?php echo $instagram_url; ?>" rel="noopener noreferrer nofollow" target="_blank" aria-label="social_link">
                                    <span class="icon-instagram"></span>
                                </a>
                                <?php } ?>
                            </div>

                            <!-- <div class="footer-subscribe-sec">
                                <h2 class="footer-subscribe-title">
                                    Subscribe to our newsletter
                                </h2>
                                <form action="#" method="post" class="footer-subscribe-form">
                                    <input class="footer-subscribe-input" type="email" name="email" placeholder="Enter your email address">
                                    <button type="submit" class="footer-subscribe-button">
                                        <span class="icon-envelope"></span>
                                    </button>
                                </form>
                            </div> -->

                        </div>

                        <div class="footer-link-sec order-3">
                            <h3 class="footer-link-header relative">USEFUL LINKS</h3>
                            <ul class="footer-ul">
                                <li class="footer-ul-li">
                                    <a class="footer-ul-li-link" href="<?php echo home_url('/about-us'); ?>">About Us</a>
                                </li>
                                <li class="footer-ul-li">
                                    <a class="footer-ul-li-link" href="<?php echo home_url('/contact-us'); ?>">Contact Us</a>
                                </li>
                                <li class="footer-ul-li">
                                    <a class="footer-ul-li-link" href="<?php echo home_url('/write-for-us'); ?>">Write for Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-dcc-sec">
                        <p class="footer-dcc-p">
                            Lawyersinventory is a rating service for outstanding lawyers from all around the world. With our efforts to offer the best, we have attained a high degree of peer and professional achievements. Our selection process includes area searches, individual searches, and evaluations.
                        </p>
                    </div>

                    <div class="footer-copy-right-sec">
                        <p class="footer-copy-right-p">
                            © <?php echo get_the_date('Y'); ?> Lawyersinventory. All rights reserved.
                        </p>

                        <p class="footer-copy-right-p">
                            <a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a>
                        </p>
                    </div>


                </div>
            </div>
        </footer>
        
        <?php wp_footer(); ?>


        <script>
        new Swiper(".issueSwiper", {
            loop: true,
            paginationClickable: true,
            spaceBetween: 30,
            breakpoints: {
                1920: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1536: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                480: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            },
 
            // autoplay: {
            //     delay: 3000,
            //     disableOnInteraction: false,
            // },
 
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
 
        new Swiper(".LawfirmSwiper", {
            loop: true,
            paginationClickable: true,
            spaceBetween: 30,
            breakpoints: {
                1920: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1536: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1280: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                480: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            },
 
            // autoplay: {
            //     delay: 3000,
            //     disableOnInteraction: false,
            // },
 
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
 
 
        new Swiper(".LawyersSwiper", {
            loop: true,
            paginationClickable: true,
            spaceBetween: 30,
            breakpoints: {
                1920: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1536: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                480: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            },
            // autoplay: {
            //     delay: 3000,
            //     disableOnInteraction: false,
            // },
 
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
 
        });
    </script>

    </body>
</html>