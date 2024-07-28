<!doctype html>
<html <?php language_attributes(); ?> >

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $falcons_option_data =get_option('falcons_option_data'); ?>

    <!--<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">-->
    <!--<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Open+Sans:wght@300&display=swap" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Open+Sans:wght@300&display=swap" rel="stylesheet">

  <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
  <?php wp_head(); ?>
  
  <?php /*if(!is_front_page()) { ?>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9502972669695969"
     crossorigin="anonymous"></script>
  <?php }*/ ?>
  
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-721FR4P887"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-721FR4P887');
    </script>
     
</head>

<body <?php body_class(); ?> >
 <div class="uou-block-11a mobileMenu">
    <!--<h5 class="title"><?php esc_html_e( 'Menu', 'falcons' ); ?></h5>-->
    <a href="#" class="mobile-sidebar-close"><?php esc_html_e( 'X', 'falcons' ); ?> </a>
      <?php get_template_part('templates/header','menuMobile'); ?>
    <hr>

    <?php
     // get_search_form();
     ?>
</div>

<div id="main-wrapper">
  <div class="toolbar">
        <?php //get_template_part('templates/topS/header','topbarChoose'); ?>
        <?php //get_template_part('templates/headerS/header','choose'); ?>
        <?php get_template_part('templates/headerS/header','choose'); ?>
        <?php
		$template_name= get_page_template_slug();					
        if ( $template_name!='templates/home.php') {
			get_template_part('templates/breadcrumbs/header','crumbChoose');
		}
         ?>

    </div>

