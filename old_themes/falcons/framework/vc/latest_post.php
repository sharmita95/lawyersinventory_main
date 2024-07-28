<?php


wp_enqueue_style('blog-latest-post', falcons_CSS . 'latest-post.css',array(), $ver = false, $media = 'all');

$title=(isset($atts['latest_post_title'])?$atts['latest_post_title']:'Latest Posts');
$banner_subtitle=(isset($atts['latest_post_sub_title'])?$atts['latest_post_sub_title']:'With over 3000 advocate offeres across 20 countries Falcons is the right place to find your closest law service provider thal will help you in court');

$feature_post_ids= array();
if(!isset($atts['latest_post_ids']) OR $atts['latest_post_ids']==''){
	$args = array(
		'post_type' => 'post', // enter your custom post type
		'post_status' => 'publish',
		'showposts'=>'3',		
		//'orderby' => 'rand',
		'orderby' => 'DESC',
	);
	$the_latest= new WP_Query( $args );
		 if ( $the_latest->have_posts() ) :
			while ( $the_latest->have_posts() ) : $the_latest->the_post();
						$id = get_the_ID();
						$feature_post_ids[]=$id;
			endwhile;
	 endif;
}else{
		$feature_post_ids = explode(",", $atts['latest_post_ids']);
}

?>
			
    <div class="latest-post-area blog-content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="latest-post-header">
                        <h2 class="section-title">	<?php echo $title;?></h2>
                        <p><?php echo $banner_subtitle;?></p>
                    </div>
                </div>
            </div>
            <div class="row">				
				<?php foreach($feature_post_ids as $fpost){
						$id =$fpost;
						$post = get_post($id);
						// echo'<pre>';
						//print_r($post);
						if($post!=''){
							$feature_img='';
							if(has_post_thumbnail($id)){
								$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
								if($feature_image[0]!=""){
									$feature_img =$feature_image[0];
								}
							} else {
								$feature_img= falcons_IMAGE."post2.jpg";
							}
						
						$featured_meta = get_post_meta($post->ID, '_featured_post', true);	
						?>
						
						<div class="col-md-4 col-sm-6 col-xs-12">
						    <article <?php post_class( 'uou-block-7g blog'); ?> id="post-<?php the_ID(); ?>" data-badge-color="ff0099" >
                                <?php
                                $image_id 		= get_post_thumbnail_id( $id );
                                if ( !empty($image_id) && $image_id!= 0 ) {
                                    $large_image 	= wp_get_attachment_url( $image_id ,'full');  
                                    $resize 		= falcons_aq_resize( $large_image, 250, 200, true ); ?>
                                    <img class="image featured" src= "<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>">
                                <?php } else {
                                    $resize = home_url().'/wp-content/uploads/2021/06/black-wallpaper-with-motion-lines-background_1017-30151.jpg'; ?>
                                    <img src="<?php echo $resize; ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"  class="featured">
                                <?php } 
                                if($featured_meta == 'yes') {
                                    echo '<span class="badge">Featured</span>';
                                } ?>
                                <!--<span class="badge">In The Lab</span>-->
                                <div class="content">
                                    <div class="avatar-wrapper ">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/falcons-logo.png" alt="avatar-fav" width="70" height="70">
                                    </div>
                            	    
                            	    <h3><a href="<?php echo get_the_permalink($id);?>"><?php  echo $post->post_title;?></a></h3>
                            	    <!-- <span><?php //echo date('d M Y',strtotime($post->post_date));?></span> -->
                            		<!-- <p> <?php //echo substr(strip_tags($post->post_content), 0, 180); ?>... </p> -->
                            		<p><?php echo substr(strip_tags($post->post_content), 0, 400); ?></p>
                            		<a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
                            	</div>
                            </article>
						</div>

					<?php
					}
				} ?>
            </div>
        </div>
    </div>
    <!-- latest-post-area-end -->
