<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>
    <header class="relative">
        <nav class="navbar">
            <div class="container mx-auto">
                <div class="navbar-container-inner">
                    <div class="navbar-start">
                        <a href="<?php echo home_url(); ?>">
                            <figure class="nav-logo-controller">
                                <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                
                                if (!empty($image[0])) {
                                    echo '<img class="w-full h-full object-cover" src="' . $image[0] . '" alt="logo" />';
                                } else {
                                    echo '<span class="w-full h-full object-cover">' . get_template_directory_uri() . '/images/lawyersinventory-logo.png' . '</span>';
                                } ?>
                            </figure>
                        </a>
                    </div>

                    <div class="c-navbar-center">
                        <ul class="center-nav-bar-menu ">
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="">
                                    <span>
                                        Find
                                    </span>
                                    <span class="icon-arow-down">
                                    </span>
                                </a>

                                <ul class="center-nav-bar-menu-dropdown">
                                    <li class="cnb-menu-dropdown-li">
                                        <a class="cnb-menu-dropdown-li-a" href="<?php echo home_url('/find-lawyers'); ?>">Find a Lawyer</a>
                                    </li>
                                    <li class="cnb-menu-dropdown-li">
                                        <a class="cnb-menu-dropdown-li-a" href="<?php echo home_url('/find-lawfirms'); ?>">Find a Lawfirm</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="<?php echo home_url('/write-for-us'); ?>">Write for Us</a>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="<?php echo home_url('/about-us'); ?>">About Us</a>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="<?php echo home_url('/contact-us'); ?>">Contact Us</a>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="<?php echo home_url('/blogs'); ?>">Blogs</a>
                            </li>
                        </ul>
                    </div>

                    <div class="navbar-end ">
                        <button class="search-btn" onclick="document.getElementById('myModal').style.display='block'" aria-label="search-button">
                            <span class="like-search-button">
                                <span class="icon-search "></span>
                            </span>
                        </button>

                        <!-- <button class="like-user-button"  aria-label=" nav bar user button">
                            <span class="icon-user"></span>
                        </button> -->

                        <a class="nab-cta hidden lg:flex" href="<?php echo home_url('/registration'); ?>">
                            Get Listed
                        </a>

                        <button class="menu_icon ham-dropdown" aria-label=" phone to tabulate drop down button">
                            <span class="one"></span>
                            <span class="two"></span>
                            <span class="three"></span>
                        </button>

                    </div>
                </div>
            </div>
        </nav>
    </header>


    <!-- Modal start -->
    <?php get_template_part('template-parts/search', 'modal'); ?>
    <!-- Modal End -->

    <main>