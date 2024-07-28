
<?php get_header(); ?>


  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
            
          <?php if (have_posts()) : ?>

            <div class="archive-banner">
                <h1><?php printf( esc_html__( 'Category Archives: %s', 'falcons' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
                
                <?php if ( category_description() ) : // Show an optional category description ?>
                    <div class="archive-sec">
                        <?php echo category_description(); ?>
                    </div>
                <?php endif; ?>
            
            </div>
                    
            <div class="row">
                
                  <?php while ( have_posts() ) : the_post();
                  $featured_meta = get_post_meta($post->ID, '_featured_post', true); ?>
                
                    <div class="col-sm-6 col-md-6">
                      	<!--<article <?php //post_class( 'uou-block-7f blog-post-content'); ?> id="post-<?php //the_ID(); ?>" >-->
                      	<article class="uou-block-7g" id="post-<?php the_ID(); ?>" >
            	          	<?php if ( has_post_thumbnail() ) {
                                $image_id =  get_post_thumbnail_id( get_the_ID() );
                                $large_image = wp_get_attachment_url( $image_id ,'full');  
                                $resize = falcons_aq_resize( $large_image, true );
                               ?>
                              <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"  class="featured">
                            <?php } else {
                                $resize = get_stylesheet_directory_uri().'/img/default-blog-bg.jpg'; ?>
                                <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"  class="featured">
                            <?php } ?>
                            <?php if($featured_meta == 'yes') {
                                echo '<span class="badge" style="background-color: rgb(255, 0, 153);">Featured</span>';
                            } ?>
                	        <!--<span class="badge" style="background-color: rgb(255, 0, 153);">In The Lab</span>-->
                	        <div class="content">
                	            <div class="avatar-wrapper ">
                                    <img src="<?php echo home_url(); ?>/wp-content/themes/falcons/assets/img/falcons-logo.png" alt="avatar-fav" width="70" height="70">
                                </div>
                			    
                			    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h3>
                			    <span class="date"><?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?> </span> 
                			    <?php /* if(has_category()): ?>
                                  <span class="category">
                                    <?php the_category('&nbsp;,&nbsp;'); ?>
                                  </span>
                                <?php endif; */ ?>
                				<?php the_excerpt();  ?> <a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
                                
                			</div>
            		    </article>
                    </div>
               
                      <?php 
                      /* if ( has_post_thumbnail() ) {
                        $image_id =  get_post_thumbnail_id( get_the_ID() );
                        $large_image = wp_get_attachment_url( $image_id ,'full');  
                        $resize = falcons_aq_resize( $large_image, true );
                       ?>
                      <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>">
                      <?php } ?>


                      <div class="meta">
                         <span class="time-ago"> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></span>
                        <?php if(has_category()): ?>
                          <span class="category">
                            <?php the_category('&nbsp;,&nbsp;'); ?>
                          </span>
                        <?php endif; ?>
                        
                      </div>

                     <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h1>

                      <?php */ endwhile; else : ?>
                        <?php esc_html_e('No post have found!', 'falcons'); ?> 
                      <?php endif; ?>

            </div> <!-- end .blog-list -->

            <!--  start pagination * -->
              <?php if (function_exists("wp_pagination")) {
                wp_pagination();
            } ?>
            <!--  End of pagination * -->
            

</div>
<!-- ************************** Start Sidebar **************************** -->


            <div class="col-md-3">
                <div class="uou-sidebar">
    
                    <?php if ( is_active_sidebar( 'blogsidebar' ) ) : ?>
                      <?php dynamic_sidebar( 'blogsidebar' ); ?>
                    <?php else : ?>
                      <div class="alert alert-message">
                        <?php esc_html_e("Please activate some Widgets","falcons"); ?>
                      </div>
                    <?php endif; ?>
    
                </div>
            </div>

<!-- ************************** End Sidebar **************************** -->
    
      </div> 
    </div>
  </div> <!-- end .page-content -->



<?php get_footer(); ?>