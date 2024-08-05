<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://api.fontshare.com/v2/css?f%5B%5D=supreme@1,2&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


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
                                <?php if (function_exists('logo_url')) {
                                    if (is_file(realpath($_SERVER["DOCUMENT_ROOT"]) . parse_url(logo_url())['path'])) {
                                        echo '<img class="w-full h-full object-cover" src="' . logo_url() . '" alt="logo" />';
                                    } else {
                                        echo '<span class="w-full h-full object-cover">' . get_bloginfo('name') . '</span>';
                                    }
                                } else {
                                    echo '<span class="w-full h-full object-cover">' . get_bloginfo('name') . '</span>';
                                } ?>
                            </figure>
                        </a>
                    </div>

                    <div class="c-navbar-center">
                        <ul class="center-nav-bar-menu ">
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="">Find a Lawyer</a>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="">Write for Us</a>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="">About Us</a>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="">Contact Us</a>
                            </li>
                            <li class="center-nav-bar-menu-li">
                                <a class="center-nav-bar-menu-a" href="">
                                    <span>
                                        Blogs
                                    </span>
                                    <span class="icon-arow-down">
                                    </span>
                                </a>

                                <ul class="center-nav-bar-menu-dropdown">
                                    <li class="cnb-menu-dropdown-li">
                                        <a href="">Submenu 1</a>
                                    </li>
                                    <li>
                                        <a href="">Submenu 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="navbar-end ">
                        <button class="search-btn" onclick="document.getElementById('deskTopSearchModal').style.visibility='visible'" aria-label="search-button">
                            <span class="like-search-button">
                                <span class="icon-search text-primary"></span>
                            </span>
                        </button>

                        <button class="like-user-button" aria-label=" nav bar user button">
                            <span class="icon-user text-primary"></span>
                        </button>

                        <a class="nab-cta hidden lg:flex">
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

    <?php // get_template_part('template-parts/hamburger', 'modal'); 
    ?>

    <main>