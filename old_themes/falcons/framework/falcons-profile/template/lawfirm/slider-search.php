<?php


$radius=get_option('_iv_radius');
$keyword_post='';
$back_ground_color='0099fe';
if(isset($atts['bgcolor']) and $atts['bgcolor']!="" ){
	$back_ground_color=$atts['bgcolor'];
}

$falcons_option_data =get_option('falcons_option_data');

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}	


$directory_url_1_string=str_replace("-"," ",$directory_url_1); 
$directory_url_1_string =  esc_attr (ucwords($directory_url_1_string)); 						
 						 
$directory_url_1_string = (isset($falcons_option_data['falcons-home-hearder-block1'])? $falcons_option_data['falcons-home-hearder-block1']: $directory_url_1_string);

$directory_url_2_string=str_replace("-"," ",$directory_url_2); 
$directory_url_2_string= (isset($falcons_option_data['falcons-home-hearder-block2'])?$falcons_option_data['falcons-home-hearder-block2']:$directory_url_2_string)

?>

<form  action="<?php echo get_post_type_archive_link( $directory_url_1) ; ?>" method="POST"  class="form-inline advanced-serach" id="searchformhd" onkeypress="return event.keyCode != 13;">
	<div class="container">
	 <div class="input-field">
	     
	     <div class="" >
		    <div class="form-group" >
				<i class="fa fa-chevron-down arrow"></i>
				<select name="dir_type"  id="dir_type" class="cbp-search-select">
				    <option class="cbp-search-select"  value="rurl_2"><?php echo ucfirst($directory_url_2_string); ?></option>
				    <option  class="cbp-search-select" value="rurl_1"><?php echo ucfirst($directory_url_1_string); ?></option>
				</select>
		    </div>
	    </div>

		<div class="" >
           <div class="form-group" >
    		   <!--<input type="text" class="cbp-search-input" id="keyword" name="keyword"  placeholder="<?php esc_html_e( 'Filter By Keyword', 'falcons' ); ?>" value="<?php echo $keyword_post; ?>">-->
    		    <?php
    			 $main_class = new wp_iv_directories;
    		   $pos = $main_class->get_unique_keyword_values('keyword',$directory_url_1);
    		   $pos2 = $main_class->get_unique_keyword_values('keyword',$directory_url_2);					   
    				?>
    				<script>									
    					jQuery(function() {
    					var availableTags = [ "<?php echo  implode('","',$pos); ?>","<?php echo  implode('","',$pos2); ?>" ];
    					jQuery( "#keyword" ).autocomplete({source: availableTags});
    				  });
    				  
    				</script> 
		     </div>
        </div>
	    
	    <div class="">
    
		  <div class="form-group top-8" >
		  <i class="fa fa-chevron-down arrow"></i>
						<?php
					echo '<select name="'.$directory_url_2.'-category" class="form-control">';
					echo'	<option selected="'.$selected.'" value="">'.esc_html__('Any Issue','falcons').'</option>';


							if( isset($_POST['submit'])){
								$selected = $_POST[$directory_url_2.'-category'];
							}
								//directories
								$taxonomy = $directory_url_2.'-category';
								$args = array(
									'orderby'           => 'name',
									'order'             => 'ASC',
									'hide_empty'        => true,
									'exclude'           => array(),
									'exclude_tree'      => array(),
									'include'           => array(),
									'number'            => '',
									'fields'            => 'all',
									'slug'              => '',
									'parent'            => '0',
									'hierarchical'      => true,
									'child_of'          => 0,
									'childless'         => false,
									'get'               => '',

								);
					$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
					if ( $terms && !is_wp_error( $terms ) ) :
						$i=0;
						foreach ( $terms as $term_parent ) {  ?>


								<?php

								echo '<option  value="'.$term_parent->slug.'" '.($selected==$term_parent->slug?'selected':'' ).'><strong>'.$term_parent->name.'</strong></option>';
								?>
									<?php

									$args2 = array(
										'type'                     => $directory_url_2,
										'parent'                   => $term_parent->term_id,
										'orderby'                  => 'name',
										'order'                    => 'ASC',
										'hide_empty'               => 1,
										'hierarchical'             => 1,
										'exclude'                  => '',
										'include'                  => '',
										'number'                   => '',
										'taxonomy'                 => $directory_url_2.'-category',
										'pad_counts'               => false

									);
									$categories = get_categories( $args2 );
									if ( $categories && !is_wp_error( $categories ) ) :


										foreach ( $categories as $term ) {
											echo '<option  value="'.$term->slug.'" '.($selected==$term->slug?'selected':'' ).'>-'.$term->name.'</option>';
										}

									endif;

									?>


						<?php
							$i++;
						}
					endif;
						echo '</select>';
					?>
			</div>
		</div>
		
		
		<div class="">
			<div class="form-group top-8" >
				<?php echo '<select name="poststate" class=" " id="poststate">';
					echo'	<option value="">'.__('Choose a State','falcons').'</option>'; ?>
					
					<?php $taxonomies = array( 
                	    $directory_url_2.'-location',
                	);
                
                	$args = array(
                	    'orderby'           => 'name', 
                	    'order'             => 'ASC',
                	    'hide_empty'        => false, 
                	    'fields'            => 'all',
                	    'parent'            => 0,
                	    'hierarchical'      => true,
                	    'child_of'          => 0,
                	    'pad_counts'        => false,
                	    'cache_domain'      => 'core'    
                	);
                
                	$terms = get_terms($taxonomies, $args);
					if ( $terms && !is_wp_error( $terms ) ) :
							
						foreach ( $terms as $term ) { 
							echo '<option  disabled value="'.$term->term_id.'" '.($selected==$term->slug?'selected':'' ).'>'.$term->name.'</option>';
						
						    
                    		$subterms = get_terms(  $directory_url_2.'-location', array(
                              'parent'   => $term->term_id,
                              'hide_empty' => false
                            ));
                    
                            foreach ( $subterms as $subterm ) {
                                if($selected_state_id == $subterm->term_id) { 
                                    echo '<option selected class="left-10" value="'.$subterm->term_id.'"> -'.$subterm->name.'</option>';
                                } else {
                                    echo '<option class="left-10" value="'.$subterm->term_id.'"> -'.$subterm->name.'</option>';
                                }
                                
                            }
						} 	
													
					endif;
					echo '</select>';
					
					?>
		  </div>
	  </div>
	  
	    <div class="form-group top-8 city-based-on-state">
		    <select>
		        <option>Select State to choose city</option>
		    </select>
		 </div>

        <?php /* ?>
		<div class="" >
			<!--
			<div class="form-group" >
				<input type="text" class="cbp-search-input location-input" id="address" name="address"  placeholder="<?php esc_html_e( 'Location', 'falcons' ); ?>"
				value="">
				<i class="fa fa-map-marker marker"></i>
				<input type="hidden" id="latitude" name="latitude"  value="" >
				<input type="hidden" id="longitude" name="longitude"  value="">
			</div>
			-->
			<?php
			$args_citys = array(
				'post_type'  => $directory_url_1,
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key'     => 'city',	
						'orderby' => 'meta_value', 
						'order' => 'ASC',		
					),
					
				),
			);
			$citys = new WP_Query( $args_citys );	
			$citys_all = $citys->posts;
			$get_cityies =array();
			foreach ( $citys_all as $term ) {
				$new_city="";
				$new_city=ucfirst(trim(get_post_meta($term->ID,'city',true)));
				if (!in_array($new_city, $get_cityies)) {
					$get_cityies[]=ucfirst($new_city);
				
				}	
			}	
			?>
			 <div class="form-group" >
					<select name="dir_city"  id="dir_city" class="cbp-search-select">
					  <option   value="">
					  <?php esc_html_e('Choose a City   ','falcons'); ?>
					  </option>							  
					  <?php		
							$selected_city= (isset($_REQUEST['dir_city'])?$_REQUEST['dir_city']:'' );
											
								if(count($get_cityies)) {
										asort($get_cityies);
								  foreach($get_cityies as $row1) {
									  if($row1!=''){													  
									  ?>
										<option   value="<?php echo $row1; ?>" <?php echo ($selected_city==$row1?'selected':''); ?>><?php echo $row1; ?></option>
									<?php
									}
										
									}
								  
								} 
									
								?>
					</select>
			</div>		
	    </div>
			  
		<div class="" >
		  <div class="form-group" >
				<i class="fa fa-chevron-down arrow"></i>
				<select name="dir_Specialities"  id="dir_Specialities" class="cbp-search-select">
					<option  class="cbp-search-select" value=""><?php esc_html_e('Choose a Speciality','falcons'); ?></option>	
					<?php
					$specialtie =__('Accident Injury,Administrative,Admiralty Maritime,Adoption,Agricultural Law,Antitrust and Unfair Competition,Appeals,Appellate Practice,Arson and Fraud Defense,Asbestos Mesothelioma,Asset Protection,Auto Accidents,Aviation Litigation,Bad Faith Litigation,Bankruptcy,Bicycle Personal Injury,Brain Injury,Burglary,Business Commercial,Casualty and Property Defense,Child Abuse,Child Custody,Children,Civil Engineering,Civil Litigation,Civil Practice,Civil Rights,Collaborative Law,Collections,Commercial Litigation,Computer,Constitutional Law,Construction,Construction Claim,Construction Litigation,Consumer Debt Protection,Consumer Litigation,Contract,Copyright and Trademark,Corporate and Partnership Litigation,Corporate Planning,Corporation,Credit Card Settlement,Credit Reporting,Creditor Debtor,Creditors Rights,Criminal,Crisis Management,Directors and Officers Liability,Discrimination,Divorce,Domestic,Drug Charges,Drug Possession,DUI OWI,E-Commerce and Internet Business Law,Education,Elder Law,Emerging Business and Venture Capital,Employee Benefits and Executive Compensation,Employment Law,Entertainment,Environmental Coverage,Environmental Law,Environmental Litigation,ERISA,Estate Planning,Estate Planning and Administration,Estate Settlement,Family,Federal and State Taxation,Federal Law,FELA Railroad Injury,Felonies,Fidelity and Security,Financial Services,Food Borne Illness,Foreclosures,Franchise Law,General Practice,Government Contracts,Guardianship Conservator,Hand Surgery,Health Care,Health Regulatory Law and Litigation,Immigration,Injuries At Bars Hotels and Restaurants,Injuries from Animal Attacks,Injuries to Children,Injury,Insurance,Insurance Bad Faith,Insurance Corporate and Regulatory,Insurance Coverage,Intellectual Property,International,International Tax and Estate Planning,International Torts,Internet,Juvenile,Labor and Employment,Land Use,Landlord Tenant,Latin America Practice Group,Legal Malpractice,Liability,Litigation,Loan Modification,Long Term Disability,Main,Malpractice,Manslughter,Marine and Maritime Law,Matrimonial,Mergers and Acquisitions,Military Law,Misdemeanors,Motor Vehicle Accident,Murder Homicide,Nonprofit,Oil Drilling,Oil Field Production,OSHA Defense,Patent,Personal Injury,Pharmaceuticals,Premise Liability,Privacy Law and Regulations,Pro Bono,Probate,Product Liability,Professional Liability,Professional Malpractice,Property,Public and Project Finance,Public Utilities and Energy Law,Punitive Damages,Racial Discrimination,Real Estate,Real Estate Litigation,Real Property,Reinsurance,Securities and Banking Law,Securities Arbitration and Litigation,Securities Litigation and Civil RICO,Securities Offerings and Regulations,Sentencing Issues,Sexual Assault,Sexual Harassment,Small Business,Social Security Disability,Special,Sports,State Law,Structured Settlement and Lottery Funding,Subrogation and Recovery,Tax Law,Toxic and Other Mass Torts,Traffic,Transportation,Truck Accident,Truck Crash,Trucks and Semis,Trust and Estate Litigation,Trust and Estate Planning,Unfair Insurance Practices,Vaccine Injury,Veterans Disability,Veterinarian Malpractice Defense,White Collar Crime,Wills Estates,Workers Compensation,Wrongful Death,Zoning','falcons');
    																			
    					$field_set=get_option('iv_cpt1_specialtie' );
    					if($field_set!=""){ 
    							$specialtie=get_option('iv_cpt1_specialtie' );
    					}			
    											
    								
    				$i=1;		
    					
    				$specialtie_fields= explode(",",$specialtie);			
    				foreach ( $specialtie_fields as $field_value ) { ?>	
    						<option  class="cbp-search-select" value="<?php echo $field_value; ?>"><?php echo $field_value; ?></option>
    					
    				<?php
    				}
    				?>	
									
				</select>
		  </div>
	    </div>
	    <?php */ ?>
	    
	    
	    <script>
	    jQuery(document).ready(function($) {
	        /****** On change state get city  *******/ 
	        $('#poststate').on('change', function () {
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            	//var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
            	//jQuery('#update_message').html(loader_image);
            	var search_params={
            		"action"  : 	"iv_directories_change_city",	
            		"state_name":	$(this).val(), 
            	};
            	
            	//console.log(search_params);
            	jQuery.ajax({					
            		url : ajaxurl,					 
            		dataType : "json",
            		type : "post",
            		data : search_params,
            		success : function(response){
            		    console.log(response.code);
            		    
            			if(response.code=='success'){
            					//var url = "<?php //echo get_permalink(); ?>?&profile=all-post";    						
            					//jQuery(location).attr('href',url);
            				$('.city-based-on-state select').remove();
            				console.log(response.data);
            				$(".city-based-on-state").append(response.data);
            			}
            			//jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
            			
            		}
            	});
	        });
	    });
	    </script>

		

		<div class="" >
            <div class="form-group search" >
				<button type="button" id="search_submit_m" name="search_submit_m"  onClick='submitSearchForm()' class="btn-new btn-custom-search "> 
				<i class="fa fa-search"></i>
				<span><?php esc_html_e( 'Find the Lawyers', 'falcons' ); ?></span></button>
		    </div>
        </div>
		 </div>
  </div>
</form>

<?php 
 wp_enqueue_script( 'search-form-js', falcons_JS.'search-form.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'search-form-js', 'jsdata', array( 'cpt1_url' => get_post_type_archive_link( $directory_url_1),'cpt2_url'=> get_post_type_archive_link( $directory_url_2 )) );
 
?>   
 

