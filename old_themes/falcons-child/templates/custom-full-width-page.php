<?php 
/**
 * Template Name: Custom Full Width Page
 *
 */
 ?>
<?php get_header(); ?>

    <?php
    $banner_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

 <?php if(!empty($banner_url)) { ?>
 
        <div class="breadcrumb-content">
			<img  src="<?php echo $banner_url;?>" alt="<?php the_title(); ?>-<?php esc_html_e( 'banner', 'falcons' ); ?>">
			<div class="container">
				<h3><?php the_title(); ?></h3>
			</div>
		</div>
      
    <?php }
		/*$top_breadcrumb_image= falcons_IMAGE."banner-breadcrumb.jpg";
        if(isset($falcons_option_data['falcons-banner-breadcrumb']['url']) AND $falcons_option_data['falcons-banner-breadcrumb']['url']!=""):
			$top_breadcrumb_image=esc_url($falcons_option_data['falcons-banner-breadcrumb']['url']);
         endif;
         
         $falcons_breadcrumb_value='1';
         if(isset($falcons_option_data['falcons-breadcrumb']) AND $falcons_option_data['falcons-breadcrumb']!=""):
			$falcons_breadcrumb_value=$falcons_option_data['falcons-breadcrumb'];
         endif;
         
         
         if($falcons_breadcrumb_value=='1'){ 
		?>
		 	
		<?php
			} */
		?>
  <div class="blog-content pt60">	
    <div class="container"> 
		<?php if(empty($banner_url)) { ?><h2> <?php the_title(); ?></h2><?php } ?>
		<div class="row">
			<div class="col-md-12">
				<?php echo apply_filters('the_content',$post->post_content); ?>
			</div> <!--  end blog-single -->
		</div>
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
    </div> <!-- end container -->


<?php get_footer();
