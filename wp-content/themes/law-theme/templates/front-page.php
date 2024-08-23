<?php /* Template Name: Front Page Temp */
get_header(); ?>



<!-- when  developer start working need to remove this sec  -->

<!-- banner complicate  sec -->
<section class="front-banner-sec">
    <div class="container mx-auto">
        <div class="front-page-banner">

        </div>
    </div>
</section>

<!-- Top Legal Issues -->
<section class="front-top-legal-issues-sec">
    <div class=" container mx-auto">
        <div class="front-common-title-wrapper">
            <h2 class="front-common-title">
                Top Legal Issues
            </h2>
        </div>

        <div class="swiper issueSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
                <div class="swiper-slide">
                    <?php
                    echo  get_template_part('template-parts/issue', 'card');
                    ?>
                </div>
            </div>
            <div class="swiper-button-next" style="right: 0px !important;"></div>
            <div class="swiper-button-prev" style="left: 0px !important;"></div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="view-all-btn-wrapper">
            <a class="view-all-btn" href="">
                View all
                <span class="icon-left-mid-arrow"></span>
            </a>
        </div>

    </div>
    </div>
</section>


<!-- Featured Lawyers -->
<section>
    <div class=" container mx-auto">

    </div>

</section>



<!-- About Us -->
<section class="front-Lawyers-sec">
    <div class="container mx-auto">
        <div class="front-common-title-wrapper">
            <h2 class="front-common-title ">
                Featured Lawyers
            </h2>
        </div>
        <div class="">
            <div class="swiper LawfirmSwiper ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyers', 'card');
                        ?>
                    </div>
                </div>
                <div class="swiper-button-next" style="right: 0px !important;"></div>
                <div class="swiper-button-prev" style="left: 0px !important;"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="view-all-btn-wrapper">
            <a class="view-all-btn" href="">
                View all
                <span class="icon-left-mid-arrow"></span>
            </a>
        </div>
    </div>
</section>


<!-- Featured Lawfirm-->

<section class="front-Lawfirm-sec">
    <div class="container mx-auto">
        <div class="front-common-title-wrapper">
            <h2 class="front-common-title ">
                Featured Lawfirm
            </h2>
        </div>

        <div class="front-Lawfirm-slider-wrapper">
            <img class="front-Lawfirm-element-left" src="<?php echo get_template_directory_uri(); ?>/images/left-element.png" alt="front Lawfirm element left">
            <div class="swiper LawyersSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                    <div class="swiper-slide">
                        <?php
                        echo  get_template_part('template-parts/lawyersfirm', 'card');
                        ?>
                    </div>
                </div>
                <div class="swiper-button-next" style="right: 0px !important;"></div>
                <div class="swiper-button-prev" style="left: 0px !important;"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="view-all-btn-wrapper">
            <a class="view-all-btn" href="">
                View all
                <span class="icon-left-mid-arrow"></span>
            </a>
        </div>
    </div>
    <img class="front-Lawfirm-element-bottom" src="<?php echo get_template_directory_uri(); ?>/images/down-element.png" alt="front Lawfirm element bottom">
</section>

<!-- Our Latest Posts -->
<section class="about-and-latest-post-sec">
    <div class="container mx-auto ">
        <div class="front-about-us-sec">

            <div class="front-common-title-wrapper">
                <h2 class="front-common-title ">
                    About Us
                </h2>
            </div>

            <div class="front-about-us-inner">
                <p class="front-about-us-inner-p">
                    At Lawyer’s Inventory you get information about lawyers and legal firms.
                    Our mission is to make the United States law accessible and understandable to everyone.
                </p>

                <p class="front-about-us-inner-p">
                    The focus of the Lawyers Inventory is to give the general public (the ones with legal issues) access to the best lawyers and law firms that are willing to help. Whether you are new to the legal world or are well-acquainted with it,
                    you will benefit from this platform either way.
                </p>

                <p class="front-about-us-inner-p">
                    Lawyers Inventory (lawyersinventory.com) contains a wealth of legal information that is easily understandable for everyone.
                    Apart from that, this platform also strives to keep its readers updated with legal tools and up-to-date information.
                    Here, our focus is to connect the general public having legal issues with the right legal professionals.
                </p>

                <p class="front-about-us-inner-p">
                    Lawyers Inventory is fast becoming one of the leading online legal information providers for not only individuals but also businesses as well. Furthermore, this website is also a great platform for lawyers and legal firms to post their information. This way, they can have access to their
                </p>

                <div class="front-latest-button-wrapper">
                    <a href="" class="common-load-more-button">
                        know more <span class="icon-left-mid-arrow"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="front-latest-post-sec">

            <div class="front-common-title-wrapper">
                <h2 class="front-common-title ">
                    Our Latest Posts
                </h2>
            </div>

            <div class="front-latest-grid-sec">
                <?php
                for ($latest_card = 0; $latest_card <= 2; $latest_card++) {
                    echo  get_template_part('template-parts/Blog', 'card');
                }
                ?>
            </div>

            <div class="front-latest-button-wrapper">
                <a class="common-load-more-button" href="">
                    View all <span class="icon-left-mid-arrow"></span>
                </a>
            </div>

        </div>
    </div>
</section>

<section class="my-[50px]">
    <div class="container mx-auto ">
        <ul class="local-ul">
            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/lawyers-in-us/">
                    Lawyers In US
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/lawyers-firm-in-us/">
                    Lawyers frim In US
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/lawyers-details/">
                    lawyer details page
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/featured-lawfirm-details/">
                    Featured Lawfirm Details
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/lawyers-practice/">
                    Lawyers Practice Page
                </a>
            </li>
            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/blog-listing/">
                    blog listing page
                </a>
            </li>
            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/2024/07/31/hello-world/">
                    single page
                </a>
            </li>
            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/author/lawyersinventory/">
                    Author page
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/login/">
                    log in
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/register/">
                    register
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/about-us/">
                    about us
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/write-for-us/">
                    write for us
                </a>
            </li>

            <li class="local-li">
                <a href="http://localhost/projects/lawyersinventory/package/">
                    package
                </a>
            </li>



        </ul>
    </div>
</section>

<?php
get_footer();