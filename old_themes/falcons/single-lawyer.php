<?php get_header();
$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

    $directory_url_2=get_option('_iv_directory_url_2');					
    if($directory_url_2==""){$directory_url_2='lawyers';}

	$id = get_the_ID();
	$post_id_1 = get_post($id);
	$post_id_1->post_title;

	$currentCategory=wp_get_object_terms( $id, $directory_url_2.'-category');
	$cat_link='';$cat_name='';$cat_slug='';$lat='';$lng='';
	if(isset($currentCategory[0]->slug)){
		$cat_slug = $currentCategory[0]->slug;
		$cat_name = $currentCategory[0]->name;
		$cat_link= get_term_link($currentCategory[0], $directory_url_2.'-category');
	}
	
	
	$address = get_post_meta($id,'address',true);
	$phone = get_post_meta($id,'phone',true);
	$fax = get_post_meta($id,'fax',true);
	$contact_email = get_post_meta($id,'contact-email',true);
	$contact_web = get_post_meta($id,'contact_web',true);
	
	//$payment_status = get_post_meta($id,'iv_directories_payment_status',true);
	
	// Get latlng from address* START********
	$dir_lat=$lat;
	$dir_lng=$lng;
	$address = get_post_meta($id,'address',true);
	if($address!=''){
		if($dir_lat=='' || $dir_lng==''){
			$latitude='';$longitude='';

			$prepAddr = str_replace(' ','+',$address);
			$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
			$output= json_decode($geocode);
			if(isset( $output->results[0]->geometry->location->lat)){
				$latitude = $output->results[0]->geometry->location->lat;
			}
			if(isset($output->results[0]->geometry->location->lng)){
				$longitude = $output->results[0]->geometry->location->lng;
			}
			if($latitude!=''){
				update_post_meta($id,'latitude',$latitude);
			}
			if($longitude!=''){
				update_post_meta($id,'longitude',$longitude);
			}
			$lat=$latitude;
			$lng=$longitude;
		}
	}
						
    ?>
     <?php
		$top_breadcrumb_image= falcons_IMAGE."banner-breadcrumb.jpg";
        if(isset($falcons_option_data['falcons-banner-breadcrumb']['url']) AND $falcons_option_data['falcons-banner-breadcrumb']['url']!=""):
			$top_breadcrumb_image=esc_url($falcons_option_data['falcons-banner-breadcrumb']['url']);
         endif;
         
         $falcons_breadcrumb_value='1';
         if(isset($falcons_option_data['falcons-breadcrumb']) AND $falcons_option_data['falcons-breadcrumb']!=""):
			$falcons_breadcrumb_value=$falcons_option_data['falcons-breadcrumb'];
         endif;
         
         
        /*if($falcons_breadcrumb_value=='1'){ 
		?>
		 <div class="breadcrumb-content">
			<img   src="<?php echo $top_breadcrumb_image;?>" alt="<?php esc_html_e( 'banner', 'falcons' ); ?>">
			<div class="container">
				<h3> <?php
					 the_title();
					?></h3>
					<h6>
					<?php echo esc_attr($cat_name); ?>
					</h6>
					<?php $total_count=0;
    				$total_count=get_post_meta($id,'_rating_total_count',true);
    				$i=1;$default_fields='';$total_rating_value=0;$avg_rating=0;
    				$field_set=get_option('iv_cpt-2_fields_review' );
    				if($field_set!=""){
    						$default_fields=get_option('iv_cpt-2_fields_review' );
    				}else{
    						$default_fields['Communication']=esc_html__('Communication','falcons'); 
    						$default_fields['Judgment']=esc_html__('Judgment','falcons');'';
    						$default_fields['Analytical']=esc_html__('Analytical','falcons');'';
    						$default_fields['Research-Skills']=esc_html__('Research Skills','falcons');
    						$default_fields['People-Skills']=esc_html__('People Skills','falcons');
    						$default_fields['Perseverance']=esc_html__('Perseverance','falcons');
    						$default_fields['Creativity']=esc_html__('Creativity','falcons');	
    				}
    				
    				if(sizeof($default_fields)>0){
    					foreach ( $default_fields as $field_key => $field_value ) {
    						$field_value_trim=trim($field_value);
    						$total_rating_value=$total_rating_value +get_post_meta($id,$field_key.'_rating',true);
    					}
    				}
    
    				if($total_rating_value>0 AND $total_count>0){
    					$avg_rating=$total_rating_value/$total_count;
    				}
    				
    				?>
				  <div class="stars" style ="z-index: 99;position: relative;">
				  <i class="fa fa-star<?php echo($avg_rating>=1? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=1.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=2.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=3.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=4.5? "":"-o"); ?>"></i>
				  <span>(<?php echo ($total_count==""?0:$total_count); ?>)</span>
				  </div>
			</div>
		</div>	
		<?php
			} */
		?>

  <div class="blog-content pt30">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
   <?php



$wp_iv_directories_URLPATH=wp_iv_directories_URLPATH;

wp_enqueue_style('iv_directories-style-71', wp_iv_directories_URLPATH . 'assets/cube/css/cubeportfolio.css');
wp_enqueue_style('single-cpt2-style', falcons_CSS.'single-cpt2.css', array(), $ver = false, $media = 'all');

$wp_directory= new wp_iv_directories();

 while ( have_posts() ) : the_post();

	if(has_post_thumbnail()){
		$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
		if($feature_image[0]!=""){
			$feature_img =$feature_image[0];
		}
	}else{
		$feature_img= wp_iv_directories_URLPATH."/assets/images/default-lawyer.png";

	}

    /************************* Profile Status Checking ******************/
    $post_author_id = $post_id_1->post_author;
    $user_meta = get_userdata($post_author_id);
    $user_roles = $user_meta->roles;
    
    //$all_meta_for_user = get_user_meta( $post_author_id );
    //print_r( $all_meta_for_user['session_tokens'][0] );
    //$exp_date= get_user_meta($post_author_id, 'iv_directories_exprie_date', true);
    $payment_status= get_user_meta($post_author_id, 'iv_directories_payment_status', true);
    
    //All package
    $package_names = iPayment_package();	
  
	?>


	<div class="single-direcotry-page">
		<div class="row">
			<div class="col-md-9 col-md-push-3">
			    
			    <div class="cpt2-short-bio clearfix content main-bio-sec">
			        
		            <div class="title-content">
			            <div class="row">
			                <div class="col-md-9 col-sm-12 col-xs-12"> <div class="cbp-l-project-details-title"><span><?php the_title(); ?></span></div> </div>
			                <div class="col-md-3 col-sm-12 col-xs-12">
			                    <div class="cbp-l-project-details-title">
    			                    <?php
                    				$total_count=0;
                    				$total_count=get_post_meta($id,'_rating_total_count',true);
                    				$i=1;$default_fields='';$total_rating_value=0;$avg_rating=0;
                    				$field_set=get_option('iv_cpt-2_fields_review' );
                    				if($field_set!=""){
                    						$default_fields=get_option('iv_cpt-2_fields_review' );
                    				}else{
                    						$default_fields['Communication']=esc_html__('Communication','falcons'); 
                    						$default_fields['Judgment']=esc_html__('Judgment','falcons');'';
                    						$default_fields['Analytical']=esc_html__('Analytical','falcons');'';
                    						$default_fields['Research-Skills']=esc_html__('Research Skills','falcons');
                    						$default_fields['People-Skills']=esc_html__('People Skills','falcons');
                    						$default_fields['Perseverance']=esc_html__('Perseverance','falcons');
                    						$default_fields['Creativity']=esc_html__('Creativity','falcons');	
                    				}
                    				
                    				if(sizeof($default_fields)>0){
                    					foreach ( $default_fields as $field_key => $field_value ) {
                    						$field_value_trim=trim($field_value);
                    						 
                    						$total_rating_value= (float)$total_rating_value +(float)get_post_meta($id,$field_key.'_rating',true);
                    					}
                    				}
                    
                    				if($total_rating_value>0 AND $total_count>0){
                    					$avg_rating=$total_rating_value/$total_count;
                    				}
                    				
                    				?>
                				    <div class="stars" style ="z-index: 99;position: relative;">
                    				  <i class="fa fa-star<?php echo($avg_rating>=1? "":"-o"); ?>"></i>
                    				  <i class="fa fa-star<?php echo($avg_rating>=1.5? "":"-o"); ?>"></i>
                    				  <i class="fa fa-star<?php echo($avg_rating>=2.5? "":"-o"); ?>"></i>
                    				  <i class="fa fa-star<?php echo($avg_rating>=3.5? "":"-o"); ?>"></i>
                    				  <i class="fa fa-star<?php echo($avg_rating>=4.5? "":"-o"); ?>"></i>
                    				  <span>(<?php echo ($total_count==""?0:$total_count); ?>)</span>
                				    </div>
    				            </div>
			                </div>
			            </div>
			        </div>
			        
			        <?php if($wp_directory->check_reading_access('contact info',$id)){ ?>
    			    <div class="conten-desc">
        			    
    			        <ul class="left-ul">
			                <?php 
			                if(!empty($address)) {
			                    if(!in_array($user_roles[0],$package_names) || $user_roles[0] == 'Basic') {
								$address = substr($address, 0, 4).'*****';
								} ?>
								<li><strong><?php esc_html_e('Address','falcons'); ?>: </strong>
								    <?php
								    //echo '<a href="http://maps.google.com/maps?saddr=Current+Location&amp;daddr='.$lat.'%2C'.$lng.'" target="_blank"">'.$address.'</a>';
								    echo $address;
                                    ?>
								</li>
							<?php }
							if(!empty($phone)) {
							    if(!in_array($user_roles[0],$package_names) || $user_roles[0] == 'Basic') {
								$phone = substr($phone, 0, 4).'*****';
								} ?>
								<li><strong><?php esc_html_e('Phone','falcons'); ?>: </strong>
									<?php echo '<a  href="tel:'.$phone.'">'.$phone.'</a>' ;?>
								</li>
								
							<?php } if(!empty($fax)) { ?>
						        <li><strong><?php esc_html_e('Fax','falcons'); ?>: </strong>
								<?php echo $fax.'&nbsp;';?>			
							</li>
							<?php } if(!empty($contact_email)) {
							    if(!in_array($user_roles[0],$package_names) || $user_roles[0] == 'Basic') {
								   $contact_email_arr = explode("@",$contact_email);
								   $cemail1 = substr($contact_email_arr[0], 0, 1); // returns "d" 
								   $contact_email = $cemail1.'*****@'.$contact_email_arr[1];
							    }
								?>
							    <li><strong><?php esc_html_e('Email','falcons'); ?>: </strong>
									<?php echo $contact_email.'&nbsp;';?>
									<!--<a style="color: #000;" target="_blank" href="<?php //echo home_url('/our-pricing/'); ?>">Show</a>			-->
								</li>
							<?php
							} if(!empty($contact_web)) {
							    if(!in_array($user_roles[0],$package_names) || $user_roles[0] == 'Basic') {
								   $contact_web_arr = explode(".",$contact_web);
								   $cweb1 = substr($contact_web_arr[0], 0, 1); // returns "d" 
								   $contact_web = $cweb1.'*****'.$contact_web_arr[1];
							    } ?>
							    <li><strong><?php esc_html_e('Website','falcons'); ?>: </strong>
									<?php echo '<a href="'. $contact_web.'" target="_blank" rel="noopener noreferrer nofollow"">'. $contact_web.'&nbsp; </a>';?>
								</li>
                            <?php } ?>
                            
    			        </ul>
    			        
    			        <ul class="right-ul">
    			            <?php if(in_array($user_roles[0],$package_names) && $user_roles[0] != 'Basic') {
    			            if(get_post_meta($id,'facebook',true)!='' || get_post_meta($id,'twitter',true)!='' || get_post_meta($id,'linkedin',true)!=''|| get_post_meta($id,'gplus',true)!='' ) {
                            ?>
                                <?php if(get_post_meta($id,'facebook',true)!=""){ ?>
								    <li>
					   					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Facebook Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'facebook',true);?>" target="_blank">Facebook</a>
					   			    </li>
					   			<?php } if(get_post_meta($id,'twitter',true)!=""){ ?>
					   			    <li>
					   					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Twitter Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'twitter',true);?>" target="_blank">Twitter</a>
					   			    </li>
					   			<?php } if(get_post_meta($id,'linkedin',true)!=""){ ?>
					   			    <li>
					   			        <a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('linkedin Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'linkedin',true);?>" target="_blank">Linkedin</a>
					   				</li>
					   			<?php } /*if(get_post_meta($id,'gplus',true)!=""){ ?>
					   			    <li>
					   					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('google+ Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'gplus',true);?>" target="_blank"><i class="fa fa-google-plus fa-2x"></i> Google Plus</a>
					   				</li>
								<?php }*/ ?>  
						    <?php }
						    } ?>
    			        </ul>
    			        
    			        
				    </div>
				    <?php } ?>
				    
			    </div>
				<div class="cpt2-short-bio clearfix content">
					<div class="title-content">
						<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Profile Description','falcons'); ?></h5></div>
						<span id="fav_dir<?php echo esc_attr($id); ?>" class="fav-button" >
							<?php
								$user_ID = get_current_user_id();
								if($user_ID>0){
									$my_favorite = get_post_meta($id,'_favorites',true);
									$all_users = explode(",", $my_favorite);
									if (in_array($user_ID, $all_users)) { ?>
										<a  data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Added to Favorites','falcons'); ?>" href="javascript:;" onclick="save_unfavorite('<?php echo esc_attr($id); ?>')" >
										<span class="hide-sm"><i class="fa fa-heart-o  red-heart-o fa-lg"></i>&nbsp;&nbsp; </span></a>
									<?php
									}else{ ?>
										<a  data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Add to Favorites','falcons'); ?>" href="javascript:;" onclick="save_favorite('<?php echo esc_attr($id); ?>')" >
										<span class="hide-sm"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp; </span>
										</a>
									<?php
									}
								}else{ ?>
										<a  data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Add to Favorites','falcons'); ?>" href="javascript:;" onclick="save_favorite('<?php echo esc_attr($id); ?>')" >
										<span class="hide-sm"><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp; </span>
										</a>
							<?php
								}
							?>
						</span>
					</div>
					<div class="cbp-l-cpt2-info">
						<div class="cbp-l-cpt2-desc">
						    <?php
							$content = apply_filters( 'the_content', get_the_content() );
							$content = str_replace( ']]>', ']]&gt;', $content );
							echo  $content;
							?>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="title-content">
						<div class="cpt2-cpt1-title"><h5><?php  esc_html_e('Qualifications ','falcons'); ?><?php //the_title(); ?></h5></div>
					</div>

					<div class="conten-desc">
								<?php
								if($wp_directory->check_reading_access('description',$id)){
								?>
									<div class="cbp-l-project-desc-text">
										<?php
										$i=1;
										$default_fields=array();
										$field_set=get_option('iv_directories_fields_lawyer' );
										if($field_set!=""){
												$default_fields=get_option('iv_directories_fields_lawyer' );
										}else{
												$default_fields['Gender']='Gender';	
												$default_fields['lawfirmAffiliations']='Law Office Affiliations';
												$default_fields['ExperienceTranining']='Experience / Tranining';
												$default_fields['Education']='Education';
												$default_fields['Apprenticeships']='Apprenticeships';
												$default_fields['Residency']='Residency';
												$default_fields['PractiseArea']='Practise Area';	
												$default_fields['Certifications']='Certifications';	
												$default_fields['Pre-Law']='Pre-Law';
												$default_fields['Law-School']='Law School';		
												$default_fields['law-degree']='Law Degree';																	
												$default_fields['Bar-Exam']='Bar Exam';	
												$default_fields['Practice-Course']='Practice Course';																
												$default_fields['Languages']='Languages';		
										}
										if(sizeof($default_fields)>0){ 	?>
											<ul class="qualification-list">
											<?php
											foreach ( $default_fields as $field_key => $field_value ) {
												$field_value_trim=trim($field_value);
												if(get_post_meta($id,$field_key,true)!='' ){
												?>
												 <li><strong><?php echo esc_attr($field_value_trim); ?></strong>
													<span><?php echo '  '.get_post_meta($id,$field_key,true); ?></span>
												</li>
											<?php
												}
											}
											?>
										</ul>
										<?php
										}
										?>
									</div>
								<?php
								}else{
										echo get_option('_iv_visibility_login_message');
								}
								?>
							</div>
				</div>

                <!---- Practice area / Legal Issue Start --------->
                <?php $Specialities_arr = get_the_terms( $id, 'lawyers-category' );
				if ( ! empty( $Specialities_arr ) && ! is_wp_error( $Specialities_arr ) ) { ?>
				<div class="content Specialities-list">
					<div class="title-content">
						<div class="cpt2-cpt1-title">
						<h5><?php //esc_html_e('Specialities','falcons'); ?>
						<?php esc_html_e('Legal Issues','falcons'); ?> </h5>
						</div>
					</div>

					<div class="conten-desc specialist-list">
						<?php
						/*$Specialities = get_post_meta($id,'specialtie',true);
						$Specialities_arr= explode(",",$Specialities);
						if(sizeof($Specialities_arr)>0){?>
							<ul class="cbp-l-project-details-list">
    							<?php foreach($Specialities_arr as $sp_one){
    									if(trim($sp_one)!=''){
    									?>
    								<li><?php echo esc_attr($sp_one);?></li>
    							<?php }
    							} ?>
							</ul>
						<?php
						}*/
                        ?>
					    <ul class="cbp-l-project-details-list">
					    	<?php //print_r($sp_one);
					    	foreach($Specialities_arr as $sp_one) {
						    	$term_link = get_term_link( $sp_one );
						    	echo '<li><a href="'.$term_link.'">'.$sp_one->name.'</a></li>';
					    	} ?>
					    </ul>
							
					</div>
				</div>
				<?php } ?>
				
				<!-------------- Cost & Availability -------------------->
				<?php
				$availability = get_post_meta($id,'availability',true);
				$availability_arr= explode(",",$availability);
				if(sizeof($availability_arr)>0) { ?>
				<div class="content Availability-list">
					<div class="title-content">
						<div class="cpt2-cpt1-title">
						<h5><?php esc_html_e('Cost & Availability','falcons'); ?> </h5>
						</div>
					</div>

					<div class="conten-desc availability-list">
						
						<ul class="cbp-l-project-details-list">
						<?php foreach($availability_arr as $sp_one) {
							if(trim($sp_one)!='') { ?>
							    <li><i class="fa fa-check-square-o" aria-hidden="true"></i> <?php echo esc_attr($sp_one);?></li>
						<?php }
						} ?>
						</ul>
							
					</div>
				</div>
				<?php } ?>
				
				<!-------------- Our Office -------------------->
				<div class="content office-content">
					<?php
					if(get_post_meta($id,'_office_location_0',true)!=''){
						?>
						<div class="title-content">
							<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Our Office','falcons'); ?></h5>
							</div>
						</div>

					    <div class="conten-desc award-content">
							<div class="cbp-l-project-desc-text">
							<?php
							   for($j=0;$j<20;$j++) {
								   if(get_post_meta($id,'_office_location_'.$j,true)!='' || get_post_meta($id,'_office_address_'.$j,true) || get_post_meta($id,'_office_ph_'.$j,true) ){?>

									   <div class="cbp-l-inline">
											<div class="">
												<div class="cbp-l-award-title"><?php echo get_post_meta($id,'_office_location_'.$j,true); ?></div>
												<div class="cbp-l-inline-subtitle"><?php echo get_post_meta($id,'_office_address_'.$j,true); ?></div>
												<div class="cbp-l-inline-subtitle"> Ph: <?php echo get_post_meta($id,'_office_ph_'.$j,true); ?> </div>
											</div>
										</div>

									<?php
									}
								}
								?>
						    </div>
					    </div>
					<?php
					}
					?>
				</div>
				<!-------------- Our Office End ---------------->

                <!-------------- Award ---------------->
				<div class="content">
					<?php
					if(get_post_meta($id,'_award_title_0',true)!=''){
						if($wp_directory->check_reading_access('award',$id)){
						?>
							<div class="title-content">
								<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Awards & Certificates','falcons'); ?></h5>
								</div>

							</div>

						    <div class="conten-desc award-content">
								<div class="cbp-l-project-desc-text">

									<?php
									   for($i=0;$i<20;$i++){
										   if(get_post_meta($id,'_award_title_'.$i,true)!='' || get_post_meta($id,'_award_description_'.$i,true) || get_post_meta($id,'_award_year_'.$i,true)|| get_post_meta($id,'_award_image_id_'.$i,true) ){?>

											   <div class="cbp-l-inline">
													<div class="cbp-l-inline-left">
														<?php
															if(get_post_meta($id,'_award_image_id_'.$i,true)!=''){?>
																<img src="<?php echo wp_get_attachment_url( get_post_meta($id,'_award_image_id_'.$i,true) ); ?> " alt="<?php esc_html_e( 'image', 'falcons' ); ?>">
															<?php
															}

														?>

													</div>
													<div class="cbp-l-inline-right-hd">
														<div class="cbp-l-award-title"><?php echo get_post_meta($id,'_award_title_'.$i,true); ?></div>
														<div class="cbp-l-inline-subtitle"><?php echo get_post_meta($id,'_award_year_'.$i,true); ?></div>
														<div class="cbp-l-inline-desc">
																<?php echo get_post_meta($id,'_award_description_'.$i,true); ?>
														</div>
													</div>
												</div>

											<?php
											}
										}
										?>

							    </div>
						    </div>
								<?php
						} else {
							echo get_option('_iv_visibility_login_message');

						}
					}
					?>
				</div>
                <!-------------- Award End ------------->

				<div class="content">
					<?php
					if($wp_directory->check_reading_access('video',$id)){
						?>
					<?php
					 $video_vimeo_id= get_post_meta($id,'vimeo',true);
					 $video_youtube_id=get_post_meta($id,'youtube',true);
					if($video_vimeo_id!='' || $video_youtube_id!=''){
					?>

						<div class="title-content">
							<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Video','falcons'); ?></h5>
							</div>

						</div>

						<div class="conten-desc">
							<div class="cbp-l-project-desc-text">
								<?php
								 $v=0;
								 $video_vimeo_id= get_post_meta($id,'vimeo',true);
								 if($video_vimeo_id!=""){ $v=$v+1; ?>
										<iframe src="https://player.vimeo.com/video/<?php echo esc_attr($video_vimeo_id); ?>" width="100%" height="400px" frameborder="0"></iframe>
								<?php
								 }
								?>
								<br/>
								<?php
								 $video_youtube_id=get_post_meta($id,'youtube',true);
								 if($video_youtube_id!=""){
										echo($v==1?'<hr>':'');
									 ?>

										<iframe width="100%" height="315px" src="https://www.youtube.com/embed/<?php echo esc_attr($video_youtube_id); ?>" frameborder="0" allowfullscreen></iframe>
								<?php
								 }
								?>
							</div>
						</div>
						<?php
						}

					}
					?>
				</div>
				<div class="content">
					<?php
					if(trim(get_post_meta($id, 'booking', true))!="" || trim(get_post_meta($id, 'booking_detail', true))!=""){
					?>
				   <div class="title-content">
				   	<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Appointment','falcons'); ?></h5>
				   	</div>

				   </div>
						<div class="conten-desc">

							<div class="cbp-l-project-desc-text">
								<?php
								if($wp_directory->check_reading_access('booking')){

										if(trim(get_post_meta($id, 'booking', true))!="" || trim(get_post_meta($id, 'booking_detail', true))!=""){

										}

										if(get_post_meta($id, 'booking_detail', true)!=""){
											echo get_post_meta($id, 'booking_detail', true);

										}
										$booking_short_code= get_post_meta($id, 'booking', true);
										$booking_shortcode_main = str_replace("[", '', $booking_short_code);
										$booking_shortcode_main = str_replace("]", '', $booking_shortcode_main);
										if($booking_short_code!=''){
											
											echo do_shortcode($booking_short_code);
											
									}
								}else{
									echo get_option('_iv_visibility_login_message');

								}
								?>

							</div>
						</div>
					<?php
					}
					?>

				</div>
				
				<!------ Review Start ---->
				<div class="content Review-list">
					<div class="title-content">
						<div class="cpt2-cpt1-title">
						<h5><?php esc_html_e('Review','falcons'); ?> </h5>
						</div>
					</div>

					<div class="conten-desc review-list">
									
						<ul class="cbp-l-project-details-list stars">
							<?php
							$i=1;$default_fields=array();
							$field_set=get_option('iv_cpt-2_fields_review' );
							if($field_set!=""){
									$default_fields=get_option('iv_cpt-2_fields_review' );
							}else{
									$default_fields['Communication']=esc_html__('Communication','falcons'); 
									$default_fields['Judgment']=esc_html__('Judgment','falcons');'';
									$default_fields['Analytical']=esc_html__('Analytical','falcons');'';
									$default_fields['Research-Skills']=esc_html__('Research Skills','falcons');
									$default_fields['People-Skills']=esc_html__('People Skills','falcons');
									$default_fields['Perseverance']=esc_html__('Perseverance','falcons');
									$default_fields['Creativity']=esc_html__('Creativity','falcons');	
							}
							if(sizeof($default_fields)>0){
								foreach ( $default_fields as $field_key => $field_value ) {
									$field_value_trim=trim($field_value);
									$old_rating= get_post_meta($id,$field_key.'_rating',true);
									$key_total_count= get_post_meta($id,$field_key.'_count',true);	
									if($key_total_count<1){$key_total_count=1;}
									$old_rating=(int)$old_rating/(int)$key_total_count;
									?>
									 <li><strong><?php echo $field_value_trim; ?></strong>
										  <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','1')" >
										 <i  id="<?php echo $field_key ?>_1" class="uourating fa fa-star<?php echo($old_rating>=1 ? '':'-o'); ?>"></i></a>

										 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','2')" >
										 <i id="<?php echo $field_key ?>_2"  class="uourating fa fa-star<?php echo($old_rating>=2 ? '':'-o'); ?>"></i></a>

										 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','3')" >
										 <i id="<?php echo $field_key ?>_3"  class="uourating fa fa-star<?php echo($old_rating>=3 ? '':'-o'); ?>"></i></a>

										 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;" onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','4')" >
										 <i id="<?php echo $field_key ?>_4"  class="uourating fa fa-star<?php echo($old_rating>=4 ? '':'-o'); ?>"></i></a>

										 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;" onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','5')" >
										 <i id="<?php echo $field_key ?>_5" class="uourating fa fa-star<?php echo($old_rating>=5 ? '':'-o'); ?>"></i></a>
									 
									 
									 </li>
									<?php

									}
							}		
								?>
						</ul>
					</div>
				</div>


			</div><!-- End col-md-9-->
			<div class="col-md-3 col-md-pull-9">
				<div class="falcons-sidebar">
					<div class="cbp-l-member-img">
						<img src="<?php echo esc_attr($feature_img);?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>">
					</div>
                
					<div class="sidebar-content">
						<div class="cbp-l-project-details-title"><span><?php esc_html_e('Contact Info','falcons'); ?></span>
						</div>
						
						<?php 
						//echo $payment_status;
						if(in_array($user_roles[0],$package_names) && $user_roles[0] != 'Basic' && $payment_status == 'success') {
						//print_r($post_id_1->post_title);
						$sendPostId = base64_encode($post_id_1->ID); ?>
						<div class="">	
						    <a class="button button-tiny button-green" href="<?php echo home_url().'/contact-directly?n1='.$sendPostId.'&n2=lawyers'; ?>">
						         Contact <?php echo $post_id_1->post_title; ?>	
						    </a>
                        </div>
                        <?php } ?>
                        
							<?php
							if($wp_directory->check_reading_access('contact info',$id)){
								?>
							<ul class="cbp-l-project-details-list">
    					        <?php /////////////////////////// CUSTOM Location ///////////////////////
    							$l =1;
    							$locationterms = get_the_terms( $id , array( 'lawyers-location') );
    							if(!empty($locationterms)) { ?>
    								<li><strong><?php esc_html_e('Location','falcons'); ?></strong>
    								<?php foreach ( $locationterms as $term ) {
    								    if($l <= 10) {
										 $term_link = get_term_link( $term, array( 'lawyers-location') );
										 if($l>1) { echo ', '; }
										 echo '<a href="'.$term_link.'">'.$term->name.'</a>';
    								    }
									$l++;
									} ?>
    								</li>
    							<?php
    							}
    							///////////////////////// END /////////////////////
    							
    							/*if(!empty($address)) { ?>
								<li><strong><?php esc_html_e('Address','falcons'); ?></strong>
								    <?php
								    echo '<a href="http://maps.google.com/maps?saddr=Current+Location&amp;daddr='.$lat.'%2C'.$lng.'" target="_blank"">'.$address.'</a>';
                                    ?>
								</li>
								<?php } */
								/*if(!empty($phone)) {
								
    								//$phone = substr($phone, 0, 4).'......';
    								?>
    								<li><strong><?php esc_html_e('Phone','falcons'); ?></strong>
    									<?php echo '<a  href="tel:'.$phone.'">'.$phone.'</a>' ;?>
    								</li>
    								
								<?php } if(!empty($fax)) { ?>
							        <li><strong><?php esc_html_e('Fax','falcons'); ?></strong>
									<?php echo $fax.'&nbsp;';?>			
								</li>
								<?php } if(!empty($contact_email)) {
								
    								// $contact_email_arr = explode("@",$contact_email);
    								// $cemail1 = substr($contact_email_arr[0], 0, 1); // returns "d" 
    								// $contact_email = $cemail1.'........@'.$contact_email_arr[1];
								
    								?>
    							    <li><strong><?php esc_html_e('Email','falcons'); ?></strong>
										<?php echo $contact_email.'&nbsp;';?>
										
										<!--<a style="color: #000;" target="_blank" href="<?php echo home_url('/our-pricing/'); ?>">Show</a>			-->
    								</li>
    								
								<?php
								
								} if(!empty($contact_web)) { ?>
							    <li><strong><?php esc_html_e('Website','falcons'); ?></strong>
									<?php echo '<a href="'. $contact_web.'" target="_blank"">'. $contact_web.'&nbsp; </a>';?>
								</li>
                                <?php } */
                                
						   		/* if(get_post_meta($id,'facebook',true)!='' || get_post_meta($id,'twitter',true)!='' || get_post_meta($id,'linkedin',true)!=''|| get_post_meta($id,'gplus',true)!='' ) {

						   		?>
								<li><strong><?php esc_html_e('Social Profile','falcons'); ?></strong>
						   			<?php
					   				if(get_post_meta($id,'facebook',true)!=""){ ?>
					   					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Facebook Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'facebook',true);?>" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
					   				<?php
					   				}
					   				?>
					   				<?php
					   				if(get_post_meta($id,'twitter',true)!=""){ ?>
					   					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Twitter Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'twitter',true);?>" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
					   				<?php
					   				}
					   				?>
					   				<?php
					   				if(get_post_meta($id,'linkedin',true)!=""){ ?>
					   					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('linkedin Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'linkedin',true);?>" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>
					   				<?php
					   				}
					   				?>
					   				<?php
					   				if(get_post_meta($id,'gplus',true)!=""){ ?>
					   					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('google+ Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'gplus',true);?>" target="_blank"><i class="fa fa-google-plus fa-2x"></i></a>
					   				<?php
					   				} ?>
					   				
								  </li>
								  <?php } */ ?>

								   <li><strong><?php esc_html_e('Share','falcons'); ?></strong>
							   			<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On Facebook','falcons'); ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();  ?>"><i class="fa fa-facebook"></i></a>

							   			<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On Twitter','falcons'); ?>" href="https://twitter.com/home?status=<?php the_permalink();  ?>"><i class="fa fa-twitter"></i></a>

							   			<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On linkedin','falcons'); ?>" href="https://www.linkedin.com/shareArticle?mini=true&url=test&title=<?php the_title(); ?>&summary=&source="><i class="fa fa-linkedin"></i></a>

							   			<!--<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php //esc_html_e('Share On google+','falcons'); ?>" href="https://plus.google.com/share?url=<?php the_permalink();  ?>"><i class="fa fa-google-plus"></i></a>-->


								  </li>
							</ul>
							<?php
						}else{
							echo get_option('_iv_visibility_login_message');

						}
						?>
					</div>



					<div class="">
						<?php
						// Get latlng from address* START********
						/*$dir_lat=$lat;
						$dir_lng=$lng;
						$address = get_post_meta($id,'address',true);
						if($address!=''){
							if($dir_lat=='' || $dir_lng==''){
								$latitude='';$longitude='';

								$prepAddr = str_replace(' ','+',$address);
								$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
								$output= json_decode($geocode);
								if(isset( $output->results[0]->geometry->location->lat)){
									$latitude = $output->results[0]->geometry->location->lat;
								}
								if(isset($output->results[0]->geometry->location->lng)){
									$longitude = $output->results[0]->geometry->location->lng;
								}
								if($latitude!=''){
									update_post_meta($id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($id,'longitude',$longitude);
								}
								$lat=$latitude;
								$lng=$longitude;
							}
						} */
						?>

						<iframe class="scroll-no" width="100%" height="290" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo esc_attr($address); ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe><br />
					</div>
                    
					<div class="sidebar-content">
						<?php
							$openin_days =get_post_meta($id ,'_opening_time',true);
							if(!is_array($openin_days)){
								$openin_days_final = array();
								$daysArr = explode( ',', $openin_days );
								foreach( $daysArr as $val ){
								  $tmp = explode( '|', $val );
								  $openin_days_final[ $tmp[0] ] = (isset($tmp[1])?$tmp[1]:'').'|'.(isset($tmp[2])?$tmp[2]:'');
								}
								$openin_days=$openin_days_final;
							} 
							//print_r($openin_days);
							if($openin_days['Monday'] || $openin_days['Tuesday'] || $openin_days['Wednesday'] || $openin_days['Thursday'] || $openin_days['Friday'] || $openin_days['Saturday'] || $openin_days['Sunday']){
								if(is_array($openin_days)){
									if(sizeof($openin_days)>0){
									
									/*if(count($openin_days) && $openin_days == '|') {
									    
									} else { }*/?>

									<div class="cbp-l-project-details-title"><span><?php esc_html_e('Working Time','falcons'); ?></span></div>

									<ul class="cbp-l-project-details-list opening-days">
								    <?php 
								    foreach($openin_days as $key => $item){
										$day_time = explode("|", $item);
										?>
										 <li><span><strong><?php esc_html_e($key,'falcons');  ?></strong><?php echo esc_attr($day_time[0]).' - '.esc_attr($day_time[1]);  ?></span></li>
										<?php
									}
									?>
									</ul>
								<?php }
    							}
    						} ?>
					</div>
					
					
					<?php /* Remove Review 
					<div class="sidebar-content">
									
						<div class="cbp-l-project-details-title"><span><?php esc_html_e('Reviews','falcons'); ?></span></div>
							
						<ul class="cbp-l-project-details-list stars">
						<?php
						$i=1;$default_fields=array();
						$field_set=get_option('iv_cpt-2_fields_review' );
						if($field_set!=""){
								$default_fields=get_option('iv_cpt-2_fields_review' );
						}else{
								$default_fields['Communication']=esc_html__('Communication','falcons'); 
								$default_fields['Judgment']=esc_html__('Judgment','falcons');'';
								$default_fields['Analytical']=esc_html__('Analytical','falcons');'';
								$default_fields['Research-Skills']=esc_html__('Research Skills','falcons');
								$default_fields['People-Skills']=esc_html__('People Skills','falcons');
								$default_fields['Perseverance']=esc_html__('Perseverance','falcons');
								$default_fields['Creativity']=esc_html__('Creativity','falcons');	
						}
						if(sizeof($default_fields)>0){
							foreach ( $default_fields as $field_key => $field_value ) {
								$field_value_trim=trim($field_value);
								$old_rating= get_post_meta($id,$field_key.'_rating',true);
								$key_total_count= get_post_meta($id,$field_key.'_count',true);	
								if($key_total_count<1){$key_total_count=1;}
								$old_rating=(int)$old_rating/(int)$key_total_count;
								?>
								 <li><strong><?php echo $field_value_trim; ?></strong>
									  <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','1')" >
									 <i  id="<?php echo $field_key ?>_1" class="uourating fa fa-star<?php echo($old_rating>=1 ? '':'-o'); ?>"></i></a>

									 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','2')" >
									 <i id="<?php echo $field_key ?>_2"  class="uourating fa fa-star<?php echo($old_rating>=2 ? '':'-o'); ?>"></i></a>

									 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','3')" >
									 <i id="<?php echo $field_key ?>_3"  class="uourating fa fa-star<?php echo($old_rating>=3 ? '':'-o'); ?>"></i></a>

									 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;" onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','4')" >
									 <i id="<?php echo $field_key ?>_4"  class="uourating fa fa-star<?php echo($old_rating>=4 ? '':'-o'); ?>"></i></a>

									 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;" onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','5')" >
									 <i id="<?php echo $field_key ?>_5" class="uourating fa fa-star<?php echo($old_rating>=5 ? '':'-o'); ?>"></i></a>
								 
								 
								 </li>
								<?php

								}
						}		
							?>
						</ul>
							
					</div>
					*/ ?>			

                    <!--- Contcat Me Start ----->
					<div class="sidebar-content">
						<div class="cbp-l-project-details-title"><span><?php esc_html_e('Contact Me','falcons'); ?></span></div>
						<?php
							if($wp_directory->check_reading_access('contact us',$id)){
						?>
							<form action="" id="message-pop" name="message-pop"  method="POST" role="form">
							<div class="cbp-l-grid-projects-desc">
								<input id="subject" name ="subject" type="text" placeholder="<?php esc_html_e( 'Enter Subject', 'falcons' ); ?>" class="cbp-search-input">
							</div>
							<div class="cbp-l-grid-projects-desc">
								<input name ="email_address" id="email_address" type="text" placeholder="<?php esc_html_e( 'Enter Email', 'falcons' ); ?>" class="cbp-search-input">
							</div>
							<div class="cbp-l-grid-projects-desc">
								<textarea name="message-content" id="message-content"  class="cbp-search-"  cols="54" rows="4" title="<?php esc_html_e( 'Please Enter Message', 'falcons' ); ?>"  placeholder="<?php esc_html_e( 'Enter Message', 'falcons' ); ?>"  ></textarea>
							</div>
							 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo esc_attr($id); ?>">
							  <a onclick="send_message_iv();" class="btn btn-primary full-width" ><?php esc_html_e( 'Send Message', 'falcons' ); ?></a>
								<div id="update_message_popup"></div>
							</form>
						<?php
							}else{
									echo get_option('_iv_visibility_login_message');
							}
						?>
						<br/>
					</div>

				</div>
				
				<!-------- Claim Start --------->
				<?php
					$dir_claim_show=get_option('_dir_claim_show');
					if($dir_claim_show==""){$dir_claim_show='yes';}
					if($dir_claim_show=='yes'){
						if(get_post_meta($id,'iv_cpt2_approve',true)!='yes'){
						?>
				<div class="falcons-sidebar">
					<div class="sidebar-content claims">
						<div class="cbp-l-project-details-title"><span><?php esc_html_e('Claim The Listing','falcons'); ?></span></div>
						 <form action="" id="message-claim" name="message-claim"  method="POST" role="form">
							<div class="cbp-l-grid-projects-desc">
								<input id="subject" name ="subject" type="text" placeholder="<?php esc_html_e('Enter Subject', 'falcons' ); ?>" Value="<?php esc_html_e('Claim The Listing', 'falcons' ); ?>" class="cbp-search-input">
							</div>
							<div class="cbp-l-grid-projects-desc">
								<textarea name="message-content" id="message-content"  class="cbp-search-"  cols="56" rows="4" title="<?php esc_html_e('Please Enter Message', 'falcons' ); ?>"  placeholder="<?php esc_html_e( 'Enter Message', 'falcons' ); ?>"  ></textarea>
							</div>
							 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo esc_attr($id); ?>">
							  <a onclick="send_message_claim();" class="btn btn-primary full-width"><?php esc_html_e( 'Submit Claim', 'falcons' ); ?></a>
								<div id="update_message_claim"></div>

						</form>
					</div>
				</div>

				<?php
							}
						}
				?>


			</div>	<!-- End col-md-3-->
		</div>
	</div>



<?php
endwhile;
?>

<!--
            



<!-- ************************** Start Sidebar **************************** -->




<!-- ************************** End Sidebar **************************** -->
        </div>
      </div> <!--  end blog-single -->
    </div> <!-- end container -->


<?php
wp_enqueue_script('iv_directories-ar-script-23', wp_iv_directories_URLPATH . 'assets/cube/js/jquery.cubeportfolio.min.js');
wp_enqueue_script('iv_directories-ar-script-102', wp_iv_directories_URLPATH . 'assets/cube/js/meet-team.js');
wp_enqueue_script('single-cpt1-js', falcons_JS.'single-cpt1.js', array('jquery'), $ver = true, true );
wp_localize_script('single-cpt1-js', 'falcons_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
'loading_image'		=> '<img src="'.falcons_IMAGE.'loader2.gif">',
'current_user_id'	=>get_current_user_id(),
'login_message'		=> esc_html__('Please login to remove favorite','falcons'),
'Add_to_Favorites'	=> esc_html__('Add to Favorites','falcons'),
'Login_claim'		=> esc_html__('Please login to Claim The Listing','falcons'),
'login_favorite'	=> esc_html__("Please login to add favorite",'falcons'),
'login_review'	=> esc_html__("Please login to add review",'falcons'),
) );

?>


<?php get_footer(); ?>
