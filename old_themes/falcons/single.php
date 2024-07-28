<?php get_header(); ?>
<?php
$falcons_option_data =get_option('falcons_option_data'); 

?>

<!-- SIngle page code **************************************************************************** -->

  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

                <?php if (have_posts()) :while ( have_posts() ) : the_post();
                
                    subh_set_post_view(get_the_ID()); ?>

                    <article <?php post_class( 'uou-block-7f blog-post-content'); ?> id="post-<?php the_ID(); ?>" >
                      
                      <h1 class = "blog-title-heading"><?php the_title(); ?></h1>
                      <?php
                      if ( has_post_thumbnail() ) {
                        $image_id =  get_post_thumbnail_id( get_the_ID() );
                        $large_image = wp_get_attachment_url( $image_id ,'full');
                        $resize = falcons_aq_resize( $large_image, true );
                       ?>
                        <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>" class="blog-featured-img">
                      <?php } ?>
                    
                      <div class="meta">
                        <span class="time-ago"><a href = "<?php the_permalink(); ?>" ><i class="fa fa-clock-o"></i> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></a></span>
                        <span class="category">
                        <?php if(has_category()): ?>

                            <i class="fa fa-sitemap"></i>
                            <?php the_category('&nbsp;,&nbsp;'); ?>

                        <?php endif; ?>
                        </span>
                        <span class="author">
                          <i class="fa fa-user"></i>
                          <?php esc_url(the_author_posts_link()); ?>
                        </span>
                        <span class="comments">
                          <i class="fa fa-comments"></i>
                          <?php
                            if(comments_open() && !post_password_required()){
                              comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
                            }
                          ?>
                        </span>
                      </div>

                     
                      <div class = "content-show"> <?php the_content(); ?> </div>
                      <div class = "meta">
                        <?php if(has_tag()) { ?>
                          <span class="category">
                            <i class="fa fa-tags"></i>
                            <?php the_tags( 'Tags: &nbsp; ', ', ', '<br />' ); ?>
                          </span>
                        <?php } /*else { ?> <i class="fa fa-tags"></i> <?php esc_html_e('No Tag have Found!', 'falcons'); } */ ?>
                      </div>
						<?php
						if ( is_singular( 'post' ) ) {							
								?>
								<nav class="navigation post-navigation" role="navigation">
								    <h4 class="screen-reader-text"> <?php esc_html_e( 'Post navigation', 'falcons' ) ?></h4>
    								<div class="nav-links">
        								<div class="nav-previous">
        								    <?php previous_post_link('%link', '<i class="fa fa-angle-double-left"></i> %title', TRUE); ?>
        								</div>
        								<div class="nav-next">
        								    <?php next_post_link( '%link', '%title <i class="fa fa-angle-double-right"></i>', TRUE ); ?> 
        								</div>
									</div>
								</nav>
							<?php	
							}
						  ?> 
                      <?php endwhile; else : ?>
                        <?php esc_html_e('No post have found!', 'falcons'); ?>
                      <?php endif; ?>


                      <div class="uou-share-story clearfix">
                        <div class="row">
                          <div class="col-sm-3">
                            <h5 class="sidebar-title"><?php esc_html_e('Share This Story', 'falcons');?></h5>
                          </div>


                            <div class="col-sm-9 ">
                              <div class="social-widget">
                                <div class="uou-block-4b">

                                <!-- Start Post-Share -->
                                <?php if(isset($falcons_option_data['falcons-share-button']) && $falcons_option_data['falcons-share-button'] == 1) : ?>
                                  <ul class="social-icons">
                                    <?php if(isset($falcons_option_data['falcons-share-button-facebook']) && $falcons_option_data['falcons-share-button-facebook'] == 1) : ?>
                                    <li><a  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?> "><i class="fa fa-facebook"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($falcons_option_data['falcons-share-button-twitter']) && $falcons_option_data['falcons-share-button-twitter'] == 1) : ?>
                                    <li><a  href="http://twitthis.com/twit?url=<?php echo get_permalink(); ?>"><i class="fa fa-twitter"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($falcons_option_data['falcons-share-button-linkedin']) && $falcons_option_data['falcons-share-button-linkedin'] == 1) : ?>
                                    <li><a href="http://www.linkedin.com/shareArticle??url=<?php echo get_permalink(); ?>"><i class="fa fa-linkedin"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($falcons_option_data['falcons-share-button-pinterest']) && $falcons_option_data['falcons-share-button-pinterest'] == 1) : ?>
                                    <li><a href="http://www.pinterest.com/shareArticle??url=<?php echo get_permalink(); ?>"><i class="fa fa-pinterest"></i></a></li>
                                    <?php endif; ?>
                                    <?php if(isset($falcons_option_data['falcons-share-button-envelope']) && $falcons_option_data['falcons-share-button-envelope'] == 1) : ?>
                                    <li><a href="http://www.envelopes.com//shareArticle??url=<?php echo get_permalink(); ?>"><i class="fa fa-envelope"></i></a></li>
                                    <?php endif; ?>
                                  </ul>

                                <?php endif; ?>

                                </div> <!-- end .uou-block-4b -->
                              </div> <!-- end social widget -->
                            </div>
                          </div>
                        </div>
                          <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary "><?php esc_html_e('Back To Home', 'falcons');?> </a>
                  </article>
                  
                  <?php $author_id = get_the_author_meta('ID');
                    $author_fname = get_the_author_meta('first_name', $author_id);
                    $author_lname = get_the_author_meta('last_name', $author_id); ?>

                  <section class="single-post-author">
                    <div class="author-sec">
                    <div class="row">
                        <div class="col-md-2 author-img-container">
                            <div class="author-img">
                                <img src="<?php echo esc_url(get_avatar_url($author_id)); ?>" alt="" />
                            </div>
                            
                        </div>                                
                        <div class="col-md-10 author-text-container">
                            <h5 class="author-name">
                                <a href="<?php echo get_author_posts_url($author_id, get_the_author_meta('user_nicename')); ?>">
                                    <?php if (!empty($author_fname)) {
                                        echo $author_fname . ' ' . $author_lname;
                                    } else {
                                        the_author();
                                    } ?>
                                </a>
                            </h5>
                           <div class="author-text">
                              <p><?php the_author_meta('description', $author_id); ?></p>
                           </div>
                        </div>
                    </div>
                    </div>
                </section>

				<?php
				if(comments_open()) {
				?>
				<div class="row">
					<div class="col-md-12">
						<div class="uou-post-comment">
							   <aside class="uou-block-14a">
								  <h5><?php esc_html_e('Comments','comments');?>
								   <?php
									if(comments_open() && !post_password_required()){
									  comments_popup_link( '(0)', '(1)', '(%)', 'article-post-meta' );
									}
									?>

								  </h5>
								   <?php comments_template('', true); ?>
								</aside>
						</div> <!-- end of comment -->
					</div>
				 </div>

				<?php
					}
				?>

                

          </div> <!--  end blog-single -->

            <!-- ************************** Start Sidebar **************************** -->

            <div class="col-md-3">
              <!--<div class="uou-sidebar pt40">-->
              <div class="uou-sidebar">

                <?php if ( is_active_sidebar( 'blogsidebar' ) ) : ?>
    
                  <?php dynamic_sidebar( 'blogsidebar' ); ?>
    
                <?php else : ?>
    				<div class="alert alert-message">
    					<p><?php esc_html_e("Please activate some Widgets","falcons"); ?></p>
                    </div>
    
                <?php endif; ?>

             </div>
            </div>

        <!-- ************************** End Sidebar **************************** -->
        
        </div>
      </div> <!--  end blog-single -->
    </div> <!-- end container -->



<?php get_footer(); ?>
