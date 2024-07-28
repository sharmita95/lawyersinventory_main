<!doctype html>
<html <?php language_attributes(); ?> >
<!-----PRACTICE----------->
<?php
/*$current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
$current_url = str_replace(home_url(),"",$current_url);

$current_url = explode("?",$current_url); */
$whole_current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
$current_url = str_replace(home_url(),"",$whole_current_url);
//$current_url = explode("?",$current_url);


$current_url = explode("/",str_replace("lawyers/","",$_SERVER['REQUEST_URI']));

$location_taxonomy_slug = 'lawyers-location';
$category_issue_slug = 'lawyers-category';
$location_post_type = 'lawyers';
$issue_arr=[];
$us_term_id = 5;


/*********** Remove blank array value ************/
$array=$tempArray= $current_url;
$result=array();
$tempArray=  array_values($tempArray);
$tempArray=array_values(array_filter($tempArray));

foreach(array_keys($array) as $key_key => $key)
{
    if(!empty($tempArray[$key_key]))
    {
        $result[$key]=$tempArray[$key_key];   
    }
    else
    {
        $result[$key]="";
    }
}
$current_url = $result;
/**************/
//print_r($current_url);

global $stateTerm;
$issue = $current_url[1];
$state = $current_url[2];
$city = $current_url[3];



/*************** Get Metadata *************/
global $wpdb;
$table_name = $wpdb->prefix . "custom_metadata";

if(!empty($issue) && empty($state) && empty($city)) { //echo 'only issue available'; 
    
    $post_Arr = $wpdb->get_results("SELECT * FROM $table_name WHERE (issue = '". $issue ."' AND state = 'NULL' AND city = 'NULL')");
    $meta_title = $post_Arr[0]->custom_meta_title;
    $meta_description = $post_Arr[0]->custom_meta_description;
    
} elseif(!empty($issue) && !empty($state) && empty($city)) { //echo 'issue & state available';
    
    $post_Arr = $wpdb->get_results("SELECT * FROM $table_name WHERE (issue = '". $issue ."' AND state = '". $state ."' AND city = 'NULL')");
    $meta_title = $post_Arr[0]->custom_meta_title;
    $meta_description = $post_Arr[0]->custom_meta_description;
    
} else { //echo 'issue & state & city available';
    
    $post_Arr = $wpdb->get_results("SELECT * FROM $table_name WHERE (issue = '". $issue ."' AND state = '". $state ."' AND city = '". $city ."')");
    $meta_title = $post_Arr[0]->custom_meta_title;
    $meta_description = $post_Arr[0]->custom_meta_description;
    
}
if(empty($meta_title)) {
    $meta_title = '';
}
if(empty($meta_description)) {
    $meta_description = '';
}
?>
<!----------- Practice Page ------------------>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $falcons_option_data =get_option('falcons_option_data'); ?>
    
    <title><?php echo $meta_title; ?></title>
    <meta name="title" content="<?php echo $meta_title; ?>">
    <meta name="description" content="<?php echo $meta_description; ?>"/>
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_description; ?>">
    
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Open+Sans:wght@300&display=swap" rel="stylesheet">

  <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class('page-template-lawyers-find-by-practice'); ?> >
 <div class="uou-block-11a mobileMenu">
    <!--<h5 class="title"><?php esc_html_e( 'Menu', 'falcons' ); ?></h5>-->
    <a href="#" class="mobile-sidebar-close"><?php esc_html_e( 'X', 'falcons' ); ?> </a>
      <?php get_template_part('templates/header','menuMobile'); ?>
    <hr>

    <?php
     // get_search_form();
     ?>
</div>

<div id="main-wrapper">
    
    <div class="toolbar">
        <?php get_template_part('templates/headerS/header','choose'); ?>
		
		<div class="uou-block-3a secondary">
            <div class="container">
              <ul class="breadcrumbs">
               
                <li>
                    <a rel="v:url" property="v:title" href="<?php echo home_url(); ?>">Home</a>
                    &nbsp; &nbsp; &gt; &nbsp; &nbsp;<span><?php echo get_custom_heading($issue); ?></span> 
                <?php if(!empty($state)) { ?>
                    &nbsp; &nbsp; &gt; &nbsp; &nbsp;<span><?php echo get_custom_heading($state); ?></span> 
                <?php } if(!empty($city)) { ?>
                    &nbsp; &nbsp; &gt; &nbsp; &nbsp;<span><?php echo  get_custom_heading($city); ?></span> 
                <?php } ?>
                </li>
               
              </ul>
            </div>
        </div> <!-- end .uou-block-3b -->
     

    </div>
    
    
    <?php if($state == '') { ?>

        <div class="container">
		<div class="state">
		    <h3>States Based on <?php echo get_custom_heading($issue); ?></h3>
		    <div class="row">
            	<?php
                $args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                        
                if (!empty($issue)) {
            	    $tax_arr[] = array(
                        'taxonomy' => $category_issue_slug, //Category/issue/practice
                        'field' => 'slug',
                        'terms' =>  $issue,
                    );
                }
                if (!empty($state)) {
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
                			    <a href="<?php echo home_url().'/practice/lawyers/'.$issue.'/'.$stateTerm->slug; ?>">
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
    } elseif($city == '') {
        
        $stateCatArr = get_term_by( 'slug', $state, $location_taxonomy_slug );
        $stateCatId = $stateCatArr->term_id; ?>
        
            <div class="container">
    		<div class="city">
                <h3>City Based on <?php echo  get_custom_heading($issue); ?></h3>
                <div class="row">
                    <?php 
                    $all_location = [];
                    $new_location = [];
                    
                    $args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                    
                    if (!empty($issue)) {
                	    $tax_arr[] = array(
                            'taxonomy' => $category_issue_slug, //Category/issue/practice
                            'field' => 'slug',
                            'terms' =>  $issue,
                        );
                    }
                            
                    if (!empty($state)) {
                        $tax_arr[] = array(
                            'taxonomy' => $location_taxonomy_slug, //taxonomy/location
                            'field' => 'slug',
                            'terms' =>  $state,
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
                	        
                	            //$new_location[] = $term->slug;
                	            array_push($new_location,array('name' => $term->name, 'slug' => $term->slug, 'id' => $term->term_id));
                	        }
                	        
                	    }
                	     
                	endwhile;
                	endif; ?>
                    
                    <?php $new_location = array_unique($new_location, SORT_REGULAR);
                 
                    if(!empty($new_location)) {
                	    foreach ( $new_location as $cterm ) { ?>
                            
                            <div class="col-md-2">
                                
                                <div class="card">
                    			    <a href="<?php echo home_url().'/practice/lawyers/'.$issue.'/'.$state.'/'.$cterm['slug']; ?>">
                    			        <?php get_term_image($cterm['id']); ?>
                    			        <div class="content"><?php get_custom_heading($cterm['name']); ?></div>
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
        		<h3>Lawyers of <?php get_custom_heading($issue); ?> in <?php get_custom_heading($city); ?></h3>
        		<div class="row">
            		<?php
            		$args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                    
                    if (!empty($city)) {
                        $tax_arr[] = array(
                            'taxonomy' => $location_taxonomy_slug, //Category/issue/practice
                            'field' => 'slug',
                            'terms' =>  $city,
                        );
                    }
                    
                    if (!empty($issue)) {
                	    $tax_arr[] = array(
                            'taxonomy' => $category_issue_slug, //Category/issue/practice
                            'field' => 'slug',
                            'terms' =>  $issue,
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
    }

    

