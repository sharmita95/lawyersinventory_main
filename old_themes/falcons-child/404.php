<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage falcons
 * @since falcons
 */

$current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
$current_url = str_replace(home_url(),"",$current_url);
$current_url = explode("?",$current_url);
$current_url = explode("/",str_replace("/lawyersinventory/","",$_SERVER['REQUEST_URI']));

if (in_array("location", $current_url)) { //location page

    get_template_part( 'template-parts/custom', 'location-temp', $current_url);

} elseif (in_array("practice", $current_url)) { //practice page

    get_template_part( 'template-parts/custom', 'practice-temp', $current_url);

} elseif (in_array("add-meta", $current_url) || strpos($_SERVER['REQUEST_URI'], '/add-meta?') !== false ) { //practice & lawyers meta add

    get_template_part( 'template-parts/custom', 'meta-temp', $current_url);

} else {  //404 Page

get_header(); ?>

  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'falcons' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'falcons' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

			</div>
		</div>
	</div>
</div><!-- .content-area -->

<?php }

get_footer(); ?>
