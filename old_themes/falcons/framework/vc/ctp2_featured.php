<?php //Featured lawyers(front page)

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}

$feature_post_ids=array();

//All package
$package_names = iPayment_package();

$title=(isset($atts['cpt2_featured_title'])?$atts['cpt2_featured_title']:'Featured Lawyer');
$banner_subtitle=(isset($atts['cpt2_featured_sub_title'])?$atts['cpt2_featured_sub_title']:'With over 3000 advocate offeres across 20 countries Falcons is the right place to find your closest law service provider thal will help you in court');

$backg_image=(isset($atts['cpt2_featured_image'])?$atts['cpt2_featured_image']:'');
if($backg_image==''){
 $backg_image=falcons_IMAGE.'feature-cpt2.jpg';
}else{
 $backg_image=wp_get_attachment_url($backg_image);
}

if(!isset($atts['cpt2_featured_ids']) OR $atts['cpt2_featured_ids']==''){
	$args = array(
		'post_type' => $directory_url_2, // enter your custom post type
		'post_status' => 'publish',
		'showposts'=>'8',
		'orderby' => 'date',
		'order' => 'DESC'

	);
	$the_feature = new WP_Query( $args );
		 if ( $the_feature->have_posts() ) :
			while ( $the_feature->have_posts() ) : $the_feature->the_post();
						$id = get_the_ID();
						$feature_post_ids[]=$id;
			endwhile;
	 endif;
}else{
		$feature_post_ids = explode(",", $atts['cpt2_featured_ids']);
}
?>
<!--<div class="doctor-feature-content pt50 pb50 home-shortcodes lawyers-feature-content" style="background: url(<?php echo $backg_image;?>) top center no-repeat;background-size: cover;position: relative;padding-top: 30px;">-->
<div class="doctor-feature-content pt50 pb50 home-shortcodes lawyers-feature-content" style="background: #fff;background-size: cover;position: relative;padding-top: 30px;">	
    <div class="container">

		<div class="row">
			<div class="col-md-12 ">
    			<div class="row">
					<h2 class="home-title" style="text-align: center;"><strong> <?php echo $title;?> </strong></h2>
                    <p class="home-subtitle"><?php echo $banner_subtitle;?></p>	
    				<div class="categories-imgs text-center">
    
						<?php
						foreach($feature_post_ids as $fpost){

							 $id =$fpost;
							 $post = get_post($id);

							 if($post!=''){
								$feature_img='';
								if(has_post_thumbnail($id)){
									$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
									if($feature_image[0]!=""){
										$feature_img =$feature_image[0];
									}
								}else{
									$feature_img= wp_iv_directories_URLPATH."/assets/images/default-lawyer.png";

								}

								$currentCategory=wp_get_object_terms( $id, $directory_url_2.'-category');
								$cat_link='';$cat_name='';$cat_slug='';
								if(isset($currentCategory[0]->slug)){
									$cat_slug = $currentCategory[0]->slug;
									$cat_name = $currentCategory[0]->name;

									$cat_link= get_term_link($currentCategory[0], $directory_url_2.'-category');

								}
								
								/************************* Profile Status Checking ******************/
                                $post_author_id = $post->post_author;
                                $user_meta = get_userdata($post_author_id);
                                $user_roles = $user_meta->roles;
                                
                                $payment_status= get_user_meta($post_author_id, 'iv_directories_payment_status', true);
							?>

							<div class="col-md-3 col-sm-6">

    							<a href="<?php echo get_post_permalink($id); ?>" style="color:#000000;">
    								<div class="f-doctore-single">
    								    
    								    <?php if(in_array($user_roles[0],$package_names) && $user_roles[0] != 'Basic' && $payment_status == 'success') { ?>
    								    <span class="featured-tag">Featured</span>
    								    <?php 
    								        $featuredclass = "custom-featured-post";
    								    } else {
    								        $featuredclass ="";
    								    } ?>
    								    
    									<div class="image-wrapper-content <?php echo $featuredclass; ?>">
    										<img src="<?php echo $feature_img; ?>" class="home-category-img" alt="home category">
    										<div class="categories-wrap-shadow"></div>
    										<div class="inner-meta "> <i class="fa fa-link"></i> </div>
    									</div>
        								<span style="font-size:15px; padding-bottom: 0;"><?php echo $post->post_title;  ?></span>
        								<!--<p class="f-doctor-subtitle"><?php echo $cat_name.'&nbsp;'; ?></p>-->
        								<span class="f-doctor-profile">View Profile</span>
        								<!--<p class="short-description"></p>-->
    								</div>
    							</a>
    							
							</div>

						<?php
							}

						}
    
    				?>
    			</div>
    			
    			</div>
    	    </div>
	    </div>
	
	
	    <div class="wpb_column vc_column_container vc_col-sm-12">
	        <div class="vc_column-inner">
	            <div class="wpb_wrapper">
	                <div class="vc_btn3-container vc_btn3-center">
	                   <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-icon-right vc_btn3-color-orange" href="<?php echo home_url('/lawyers/'); ?>" title="">
	                       View All <i class="vc_btn3-icon fa fa-arrow-right"></i>
	                   </a>
	               </div>
	           </div>
	       </div>
	   </div>
	
	</div>
</div>
