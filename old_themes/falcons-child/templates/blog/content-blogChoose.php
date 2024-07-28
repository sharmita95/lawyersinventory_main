<?php $falcons_option_data =get_option('falcons_option_data');
?>


<?php if(isset($falcons_option_data['falcons-blog-switch']) && ($falcons_option_data['falcons-blog-switch']==1)){?>

<?php if(isset($falcons_option_data['falcons-multi-blog-image'])&&($falcons_option_data['falcons-multi-blog-image']==1)){?>
<?php get_header(); ?>


  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
                <?php get_template_part( 'templates/blog/content-list', get_post_format() ); ?>
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'falcons' ); ?></h5>
            <?php endif; ?>

  <?php if (function_exists("wp_pagination")) {
    wp_pagination();
} ?>


        </div> <!--  end blog-single -->

<!--  Start Sidebar ** -->

         <!-- SIDEBAR : begin -->  

        <div class="col-md-3">
          <div class="uou-sidebar">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
                  
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
                  
            <?php else : ?>
              <div class="alert alert-message">
              
                <p><?php esc_html_e("Please activate some Widgets","falcons"); ?></p>
              
                </div>

            <?php endif; ?>

             </div>
            </div>
          <!-- SIDEBAR : end -->
<!--  End Sidebar ** -->
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
      <?php } ?>


<?php if(isset($falcons_option_data['falcons-multi-blog-image'])&&($falcons_option_data['falcons-multi-blog-image']==2)){?>
<?php get_header(); ?>
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
           <div class="row"> 

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
              <div class = "col-sm-4">
                
                <?php get_template_part( 'templates/blog/content-grid', get_post_format()); ?> 
              </div>
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'falcons' ); ?></h5>
            <?php endif; ?>

    </div>
<!--  start pagination * -->
  <?php if (function_exists("wp_pagination")) {
    wp_pagination();
} ?>
<!--  End of pagination * -->

        </div> <!--  end blog-single -->

<!--  Start Sidebar ** -->

         <!-- SIDEBAR : begin -->  

        <div class="col-md-3">
          <div class="uou-sidebar">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
            <?php else : ?>
              <div class="alert alert-message">
                <p><?php esc_html_e("Please activate some Widgets","falcons"); ?></p>
                </div>
            <?php endif; ?>
             </div>
            </div>
          <!-- SIDEBAR : end -->
<!--  End Sidebar ** -->
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
<?php } ?>

<?php if(isset($falcons_option_data['falcons-multi-blog-image'])&&($falcons_option_data['falcons-multi-blog-image']==3)){?>
<?php get_header(); ?>
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
                
                <?php get_template_part( 'templates/blog/content-listNS', get_post_format()); ?>
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'falcons' ); ?></h5>
            <?php endif; ?>

      <!--  start pagination * -->
        <?php if (function_exists("wp_pagination")) {
          wp_pagination();
      } ?>
      <!--  End of pagination * -->
        </div> <!--  end blog-single -->
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
<?php } ?>

<?php if(isset($falcons_option_data['falcons-multi-blog-image'])&&($falcons_option_data['falcons-multi-blog-image']==4)){?>
<?php get_header(); ?>
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
          
        <div class="col-md-9">
            
          <?php if(is_author()) {
          
          $author_id = get_the_author_meta('ID');
          $author_fname = get_the_author_meta('first_name', $author_id);
          $author_lname = get_the_author_meta('last_name', $author_id);
          ?>
            
          <div class="archive-banner">
            <div class="row">
                <div class="col-md-12">
                  <?php
                  if (!empty($author_fname)) {
                        echo '<h1 class="page-title"> Author: '.$author_fname . ' ' . $author_lname.'</h1>';
                  } else {
                        echo '<h1 class="page-title"> Author: '.get_the_author().'</h1>';
                  } ?>
                  <div class="archive-sec">
                    <img src="<?php echo esc_url(get_avatar_url($author_id)); ?>" alt="" />                      
                    <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
                  </div>
              
                </div>
            </div>
          </div>
          
          <?php } ?>
          
          <div class="row">
              
              

            <?php if(have_posts()) : while(have_posts()): the_post(); ?>
            <div class = "col-sm-6">
              <?php get_template_part( 'templates/blog/content-gridNS', get_post_format()); ?> 
            </div> 
                
            <?php endwhile; else : ?>
                <h5><?php esc_html_e( 'Sorry ! no blog post found ', 'falcons' ); ?></h5>
            <?php endif; ?>
          </div>

      <!--  start pagination * -->
        <?php if (function_exists("wp_pagination")) {
          wp_pagination();
      } ?>
      <!--  End of pagination * -->
        </div> <!--  end blog-single -->
        
        
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
        
      </div> <!-- end of row -->
  </div> <!-- end container -->
</div> <!-- end blog-content -->
<!-- ********* end of Blog - post  -->
<?php get_footer(); ?>
<?php } ?>

<?php } ?>