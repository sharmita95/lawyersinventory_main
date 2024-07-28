<?php
/**
 * Template Name: falcons Blog Grid with sidebar
 *
 * @package WordPress
 * @subpackage falcons
 * @since 1.0
 */

$featured_meta = get_post_meta($post->ID, '_featured_post', true);
?>
<article <?php post_class( 'uou-block-7g blog'); ?> id="post-<?php the_ID(); ?>" data-badge-color="ff0099" >
      <?php 
      if ( has_post_thumbnail() ) {
        $image_id 		= get_post_thumbnail_id( get_the_ID() );
        $large_image 	= wp_get_attachment_url( $image_id ,'full');  
        $resize 		= falcons_aq_resize( $large_image, 250, 200, true );
       ?>
    <img class="image featured" src= "<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>">
    <?php } else { 
        $resize = get_stylesheet_directory_uri().'/img/default-blog-bg.jpg'; ?>
        <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"  class="featured">
    <?php } 
    if($featured_meta == 'yes') {
        echo '<span class="badge">Featured</span>';
    } ?>
    <!--<span class="badge">In The Lab</span>-->
    <div class="content">
        <div class="avatar-wrapper ">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/falcons-logo.png" alt="avatar-fav" width="70" height="70">
        </div>
	    
	    <h3><a href= "<?php the_permalink(); ?>" > <?php echo get_the_title(); //esc_attr(falcons_ShortenText(get_the_title())); ?></a></h3>
	    <!-- <span class="date"><?php //echo get_the_date(); //echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?> </span> -->
		<?php the_excerpt();  ?> <a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
	</div>
</article>