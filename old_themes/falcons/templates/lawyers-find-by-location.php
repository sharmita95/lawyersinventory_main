<?php 
/**
 * Template Name: Lawyers Find By Location Page
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



//if($_GET['state'] == '') {

    
	
	$term_object = get_term_by( 'slug', 'us' , $location_taxonomy_slug );
    $termID = $term_object->term_id;
    
    $terms = get_terms( $location_taxonomy_slug, array( 'parent' => $termID, 'orderby' => 'slug', 'hide_empty' => true ) );
    
    ?>
    <div class="container">
		<div class="country">
        	<h3>Find By State</h3>
        	<div class="row">
        		<?php if(!empty($terms)) {
                    foreach ( $terms as $term ) { ?>
                        <div class="col-md-2">
                            <div class="card">
                			    <a href="<?php echo home_url().'/location/lawyers/'.$term->slug; ?>">
                			        <?php get_term_image($term->term_id); ?>
                			        <div class="content"><?php echo $term->name; ?></div>
                			    </a>
                    		</div>
                        </div>
                    <?php }
                } else {
                    echo '<div class="col-md-12">No states found</div>';
                }?>
            </div>
        </div>
    </div>
<?php
/*} elseif($_GET['city'] == '') { 
    
    $term_object = get_term_by( 'slug', $_GET['state'] , $location_taxonomy_slug );
    $termID = $term_object->term_id;
    
    $terms = get_terms( $location_taxonomy_slug, array( 'parent' => $termID, 'orderby' => 'slug', 'hide_empty' => true ) );
    
    ?>
    <div class="container">
		<div class="city">
    		<h3>Issues based on State <?php echo ucwords(str_replace("-"," ",$_GET['state'])); ?></h3>
    		<div class="row">
                <?php if(!empty($terms)) {
                    foreach ( $terms as $term ) { ?>
                        <div class="col-md-2">
                            <!-- <a href="?state=<?php //echo $_GET['state']; ?>&city=<?php echo $term->slug; ?>"><i class="fa fa-globe" aria-hidden="true"></i> <?php //echo $term->name; ?></a>-->
                            <div class="card">
                                <a href="?state=<?php echo $_GET['state']; ?>&city=<?php echo $term->slug; ?>">
                    			    <?php get_term_image($term->term_id); ?>
                    			    <div class="content"> <?php echo $term->name; ?> </div>
                    			</a>
                    		</div>
                        </div>
                    <?php }
                } else {
                    echo '<div class="col-md-12">No cities found</div>';
                }?>
            </div>
        </div>
    </div>

<?php
} elseif($_GET['issue'] == '') {
    
    ?>
    <div class="container">
		<div class="issues">
    		<h3>Issues based on City <?php echo ucwords(str_replace("-"," ",$_GET['city'])); ?></h3>
    		<div class="row">
                <?php
                $thirdpostargs = array(
                    'post_type' => $location_post_type,
                    'tax_query' => array(
                        array(
                        'taxonomy' => $location_taxonomy_slug,
                        'field' => 'slug',
                        'terms' => $_GET['city']
                         )
                      )
                );
                $posts = get_posts($thirdpostargs);
                
                foreach($posts as $post) {
                    $category_detail=get_the_category($post->ID);
                    $term_obj_list = get_the_terms( $post->ID, $category_issue_slug );
                    foreach ( $term_obj_list as $sterm ) {
                        array_push($issue_arr,array('name' => $sterm->name, 'slug' => $sterm->slug));
                    }
                }
                
                //$unique_issue_arr = array_unique($issue_arr);
                $unique_issue_arr = array_unique($issue_arr, SORT_REGULAR);
                
                // echo '<pre>';
                // print_r($unique_issue_arr);
                // echo '</pre>';
                
                foreach ( $unique_issue_arr as $single_issue ) { 
                    
                    //$single_issue_slug = str_replace(" ","-",strtolower($single_issue)); ?>
                    <div class="col-md-3">
                        <div class="issue-small-card">
                            <a href="?state=<?php echo $_GET['state']; ?>&city=<?php echo $_GET['city']; ?>&issue=<?php echo $single_issue['slug']; ?>"> 
                                <i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $single_issue['name']; ?>
                            </a>
                        </div>
                    </div>
                    
                <?php } ?>
            </div>
        </div>
    </div>
    
    <?php
} else { ?>

    <div class="container">
		<div class="issues">
    		<h3>Lawyers of City <?php echo ucwords(str_replace("-"," ",$_GET['city'])); ?> and Issue <?php echo ucwords(str_replace("-"," ",$_GET['issue'])); ?></h3>
    		<div class="row">
        		<?php
        		$args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                
                if (!empty($_GET['city'])) {
                    $tax_arr[] = array(
                        'taxonomy' => $location_taxonomy_slug, //taxonomy/location
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
        		
        		if ( $the_query->have_posts() ) :
        		    
    	            while ( $the_query->have_posts() ) : $the_query->the_post();
    	                
    	                custom_lawysers_card($post, get_the_ID());
    	                
    				endwhile;
    				
    			endif; ?>
    			
        	</div>
    	</div>
    </div>


<?php    
} */

get_footer();
