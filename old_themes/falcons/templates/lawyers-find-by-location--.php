<?php 
/**
 * Template Name: OLD Lawyers Find By Location Page
 *
 */
 ?>
<?php get_header(); ?>

<?php
// 	$location_taxonomy_slug = 'lawyers-location';
// 	$location_post_type = 'lawyers';

// 	$taxonomies = array( 
// 	    $location_taxonomy_slug,
// 	);

// 	$args = array(
// 	    'orderby'           => 'name', 
// 	    'order'             => 'ASC',
// 	    'hide_empty'        => false, 
// 	    'fields'            => 'all',
// 	    'parent'            => 0,
// 	    'hierarchical'      => true,
// 	    'child_of'          => 0,
// 	    'pad_counts'        => false,
// 	    'cache_domain'      => 'core'    
// 	);

// 	$terms = get_terms($taxonomies, $args);

//     foreach ( $terms as $key=>$term ) {

//     	$firsttermlink = get_term_link( $term );
    	
//     	$firstpostargs = array(
//             'post_type' => $location_post_type,
//             'tax_query' => array(
//                 array(
//                 'taxonomy' => $location_taxonomy_slug,
//                 'field' => 'term_id',
//                 'terms' => $term->term_id
//                  )
//               )
//         );
//         if(count(get_posts($firstpostargs)) > 0 ) {
        

//     	$first_level_location[$key] = ['id' => $term->term_id, 'name' => $term->name, 'description' => $term->description, 'link' => $firsttermlink];     

//         }
        
//         $subterms = get_terms(  $location_taxonomy_slug, array(
//           'parent'   => $term->term_id,
//           'hide_empty' => false
//         ));

//         foreach ( $subterms as $key=>$subterm ) {

//         	$secondtermlink = get_term_link( $subterm );
        	
//         	$secondpostargs = array(
//                 'post_type' => $location_post_type,
//                 'tax_query' => array(
//                     array(
//                     'taxonomy' => $location_taxonomy_slug,
//                     'field' => 'term_id',
//                     'terms' => $subterm->term_id
//                      )
//                   )
//             );
//             if(count(get_posts($secondpostargs)) > 0 ) {

//         	$second_level_location[$subterm->name] = ['id' => $subterm->term_id, 'name' => $subterm->name, 'description' => $subterm->description, 'link' => $secondtermlink];

//             }
            
//         	$secondsubterms = get_terms(  $location_taxonomy_slug, array(
// 	          'parent'   => $subterm->term_id,
// 	          'hide_empty' => false
// 	          ));	        

// 	        foreach ( $secondsubterms as $key=>$secondsubterm ) {

// 	        	$thirdtermlink = get_term_link( $secondsubterm );
	        	
// 	        	$thirdpostargs = array(
//                     'post_type' => $location_post_type,
//                     'tax_query' => array(
//                         array(
//                         'taxonomy' => $location_taxonomy_slug,
//                         'field' => 'term_id',
//                         'terms' => $secondsubterm->term_id
//                          )
//                       )
//                 );
//                 if(count(get_posts($thirdpostargs)) > 0 ) {

// 	        	    $third_level_location[$secondsubterm->name] = ['id' => $secondsubterm->term_id, 'name' => $secondsubterm->name, 'description' => $secondsubterm->description, 'link' => $thirdtermlink];

//                 }
                
// 	        }
//         }
      
//     }

		

  // 		echo '<pre>';
		// print_r($first_level_location);
		// print_r($second_level_location);
		// print_r($third_level_location);
		// echo '</pre>';


$location_arr = get_all_lawyers_locaton(); // get all location from get_all_lawyers_locaton function
?>


	<div class="container">
		<div class="row country">
			<h3>Find By Country</h3>
			<?php foreach ( $location_arr[0] as $singlecountry ) { ?>
				<div class="col-md-3">
					<a href="<?php echo $singlecountry['link']; ?>">
						<i class="fa fa-globe" aria-hidden="true"></i> <?php echo $singlecountry['name']; ?>
					</a>
				</div>
			<?php } ?>
		</div>

		<div class="row state">
			<h3>Find By State</h3>

			<?php foreach ( $location_arr[1] as $key=>$singlestate ) {?>
				<div class="col-md-3">
					<a href="<?php echo $singlestate['link']; ?>">
						<i class="fa fa-globe" aria-hidden="true"></i> <?php echo $singlestate['name']; ?>
					</a>
				</div>
			<?php } ?>

		</div>

		<div class="row city">
			<h3>Find By City</h3>

			<?php foreach ( $location_arr[2] as $key=>$singlecity ) {?>
				<div class="col-md-3">
					<a href="<?php echo $singlecity['link']; ?>">
						<i class="fa fa-globe" aria-hidden="true"></i> <?php echo $singlecity['name']; ?>
					</a>
				</div>
			<?php } ?>
		</div>

	</div>
    


<?php get_footer();
