<?php 
/**
 * Template Name: Lawyers Find By Practice Page
 *
 */
 ?>
<?php get_header(); ?>

<?php

$current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
$current_url = str_replace(home_url(),"",$current_url);

$current_url = explode("?",$current_url);

$location_taxonomy_slug = 'lawyers-location';
$category_issue_slug = 'lawyers-category';
$location_post_type = 'lawyers';
$issue_arr=[];
$us_term_id = 5;



//if($_GET['issue'] == '') { ?>
	
	<div class="container pb-40">
		<div class="issues">
    		<h3>Issues/Practice Areas</h3>
    		<div class="row">
                <?php //$terms = get_terms( $category_issue_slug, array( 'orderby' => 'slug', 'hide_empty' => true ) );
                global $post,$wpdb,$tag;
                $directory_url_1='lawyers';	
                $taxonomies = array( 
                    $directory_url_1.'-category',
                );
                
                $args = array(
                    'orderby'           => 'name', 
                    'order'             => 'ASC',
                    'hide_empty' => true, 
                    'fields'            => 'all',
                    'parent'            => 0,
                    'hierarchical'      => true,
                    'child_of'          => 0,
                    'pad_counts'        => false,
                    'cache_domain'      => 'core'    
                );
                
                $terms = get_terms($taxonomies, $args); 
                
                foreach ( $terms as $term ) { ?>
                        
                    <div class="col-md-12">
                        <?php $subterms = get_terms( array(
                          'taxonomy' => $directory_url_1.'-category',
                          'parent'   => $term->term_id,
                          'hide_empty' => true
                        ));
                        if(!empty($subterms)) { ?>
                        <h4 class="secondary-heading"><?php echo $term->name; ?></h4>
                        <div class="country">
                    		<div class="row ">
                        		<?php
                                foreach ( $subterms as $subterm ) {
                                
                                $feature_img_id = get_option('_cate_main_image_'.$subterm->term_id);
            					$feature_img=falcons_IMAGE.'default-lawfirm-category.jpg';
            					$feature_image = wp_get_attachment_image_src( $feature_img_id, 'large' );
            					if($feature_image[0]!=""){
            						$feature_img=$feature_image[0];
            						$feature_img_width=$feature_image[1];
            						$feature_img_height=$feature_image[2];
            					}
            					
            					?>
                                    <div class="col-md-3">
                                        <div class="issue-small-card">
                                            <a href="<?php echo home_url().'/practice/lawyers/'.$subterm->slug; ?>"> 
                                                <!--<i class="fa fa-arrow-right" aria-hidden="true"></i> -->
                                                <span class="img-wrapper">
                                                    <img src="<?php echo $feature_img; ?>" alt="<?php echo $subterm->slug.'-img'; ?>" height="40px" width="auto">
                                                </span>
                                                <span><?php echo $subterm->name; ?></span>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } 
                        /*else {
                            echo '<div class="col-md-12">No states found</div>';
                        }*/ ?>
                        
                    </div>
                    
                <?php } ?>
            
            </div>
        </div>
    </div>
<?php
/*} elseif($_GET['state'] == '') { ?>

    <div class="container">
		<div class="state">
		    <h3>States Based on <?php echo ucwords(str_replace("-"," ",$_GET['issue'])); ?></h3>
		    <div class="row">
            	<?php
                $args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                        
                if (!empty($_GET['issue'])) {
            	    $tax_arr[] = array(
                        'taxonomy' => $category_issue_slug, //Category/issue/practice
                        'field' => 'slug',
                        'terms' =>  $_GET['issue'],
                    );
                }
                if (!empty($_GET['state'])) {
                    $tax_arr[] = array(
                        'taxonomy' => $location_taxonomy_slug, //taxonomy/location //$category_issue_slug
                        'field' => 'term_id',
                        'terms' =>  $us_term_id,
                    );
                }
            	
            	$args['tax_query'] = array('relation' => 'AND', $tax_arr);
            	
            	$the_query = new WP_Query( $args );
            	
            	$statteIDs_arr = [];
            	
            	if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                	                
                	    $city_term = get_the_terms( $id, $location_taxonomy_slug );
                	    foreach ( $city_term as $term ) {
                    	    
                    	    if($term->parent == $us_term_id) { //term is a state
                    	        array_push($statteIDs_arr, $term->term_id);
                    	    } else { //term is a city
                    	        array_push($statteIDs_arr, $term->parent);
                    	    }
                	    }
                    endwhile;
                endif;
                
                if(!empty(array_unique($statteIDs_arr))) {
                    foreach(array_unique($statteIDs_arr) as $satteID) {
                        
                        $stateTerm = get_term_by('id', $satteID, $location_taxonomy_slug); ?>
                        <div class="col-md-2">
                            <div class="card">
                			    <a href="?issue=<?php echo $_GET['issue']; ?>&state=<?php echo $stateTerm->slug; ?>">
                			        <?php get_term_image($stateTerm->term_id); ?>
                			        <div class="content"><?php echo $stateTerm->name; ?></div>
                			    </a>
                    		</div>
                        </div>
                    
                <?php }
                } else {
            	    echo '<div class="col-md-12">Nothing found</div>';
            	}?>
            </div>
        </div>
    </div>
    
<?php
} elseif($_GET['city'] == '') {
    
    $stateCatArr = get_term_by( 'slug', $_GET['state'], $location_taxonomy_slug );
    $stateCatId = $stateCatArr->term_id; ?>
    
    <div class="container">
		<div class="city">
            <h3>City Based on <?php echo ucwords(str_replace("-"," ",$_GET['issue'])); ?></h3>
            <div class="row">
                <?php 
                $all_location = [];
                $new_location = [];
                
                $args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                
                if (!empty($_GET['issue'])) {
            	    $tax_arr[] = array(
                        'taxonomy' => $category_issue_slug, //Category/issue/practice
                        'field' => 'slug',
                        'terms' =>  $_GET['issue'],
                    );
                }
                        
                if (!empty($_GET['state'])) {
                    $tax_arr[] = array(
                        'taxonomy' => $location_taxonomy_slug, //taxonomy/location
                        'field' => 'slug',
                        'terms' =>  $_GET['state'],
                    );
                }
            	
            	$args['tax_query'] = array('relation' => 'AND', $tax_arr);
            	
            	$the_query = new WP_Query( $args );
            	
            	if ( $the_query->have_posts() ) :
            	
                
                while ( $the_query->have_posts() ) : $the_query->the_post();
            	                
            	    $id = get_the_ID();
            	    $city_term = get_the_terms( $id, $location_taxonomy_slug );
            	    foreach ( $city_term as $term ) {
            	        
            	        if($term->parent == $stateCatId) { //if the parent of city is the selected state
            	        
            	            $new_location[] = $term->slug;
            	        }
            	        
            	    }
            	     
            	endwhile;
            	endif; ?>
                
                <?php $new_location = array_unique($new_location);
                if(!empty($new_location)) {
            	    foreach ( $new_location as $cterm ) { ?>
                        
                        <div class="col-md-2">
                            
                            <div class="card">
                			    <a href="?issue=<?php echo $_GET['issue']; ?>&state=<?php echo $_GET['state']; ?>&city=<?php echo $cterm; ?>">
                			        <?php get_term_image($stateTerm->term_id); ?>
                			        <div class="content"><?php echo ucwords(str_replace("-"," ",$cterm)); ?></div>
                			    </a>
                    		</div>
                    		
                        </div>
                        
                    <?php
            	    }
        	    } else {
        	        echo '<div class="col-md-12">Nothing found</div>';
        	    } ?>
    		</div>
        </div>
    </div>
                		 
	  
		
	<?php
	
    
} else { ?>

    <div class="container">
		<div class="issues">
    		<h3>Lawyers of <?php echo ucwords(str_replace("-"," ",$_GET['city'])); ?></h3>
    		<div class="row">
        		<?php
        		$args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                
                if (!empty($_GET['city'])) {
                    $tax_arr[] = array(
                        'taxonomy' => $location_taxonomy_slug, //Category/issue/practice
                        'field' => 'slug',
                        'terms' =>  $_GET['city'],
                    );
                }
                
                if (!empty($_GET['issue'])) {
            	    $tax_arr[] = array(
                        'taxonomy' => $category_issue_slug, //Category/issue/practice
                        'field' => 'slug',
                        'terms' =>  $_GET['issue'],
                    );
                }
        		
        		
        		$args['tax_query'] = array('relation' => 'AND', $tax_arr);
                
        		
        		$the_query = new WP_Query( $args );
        		
        		if ( $the_query->have_posts() ) : ?>
        		
            		<div class="container">
                      <div class="row">
                          
        	            <?php while ( $the_query->have_posts() ) : $the_query->the_post();
        	                
        	                custom_lawysers_card($post, get_the_ID());
                         
        				endwhile; ?>
                        		 
            		  </div>
            		</div>
        			
    			<?php else:
    			    echo '<div class="col-md-12">Nothing found</div>';
    			endif; ?>
    		</div>
    	</div>
    </div>


<?php    
} */

?>


<!--
	<div class="container">
		<div class="row country">
			<h3>Find By Country</h3>
			<?php //foreach ( $location_arr[0] as $singlecountry ) { ?>
				<div class="col-md-3">
					<a href="<?php //echo $singlecountry['link']; ?>">
						<i class="fa fa-globe" aria-hidden="true"></i> <?php //echo $singlecountry['name']; ?>
					</a>
				</div>
			<?php //} ?>
		</div>

		<div class="row state">
			<h3>Find By State</h3>

			<?php //foreach ( $location_arr[1] as $key=>$singlestate ) {?>
				<div class="col-md-3">
					<a href="<?php //echo $singlestate['link']; ?>">
						<i class="fa fa-globe" aria-hidden="true"></i> <?php //echo $singlestate['name']; ?>
					</a>
				</div>
			<?php //} ?>

		</div>

		<div class="row city">
			<h3>Find By City</h3>

			<?php //foreach ( $location_arr[2] as $key=>$singlecity ) {?>
				<div class="col-md-3">
					<a href="<?php //echo $singlecity['link']; ?>">
						<i class="fa fa-globe" aria-hidden="true"></i> <?php //echo $singlecity['name']; ?>
					</a>
				</div>
			<?php //} ?>
		</div>

	</div>
-->    


<?php get_footer();