<!doctype html>
<html <?php language_attributes(); ?> >
<!-----LOCATION----------->
<?php
$whole_current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
$current_url = str_replace(home_url(),"",$whole_current_url);
//$current_url = explode("?",$current_url);
$current_url = explode("/",str_replace("lawyers/","",$_SERVER['REQUEST_URI']));
//print_r($current_url);

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

$location_taxonomy_slug = 'lawyers-location';
$category_issue_slug = 'lawyers-category';
$location_post_type = 'lawyers';
$issue_arr=[];

$state = $current_url[1];
$city = $current_url[2];
$issue = $current_url[3];


/*************** Get Metadata *************/
global $wpdb;
$table_name = $wpdb->prefix . "custom_metadata";

if(!empty($state) && $city== '' && $issue== '') { echo 'only state available'; 
    
    $post_Arr = $wpdb->get_results("SELECT * FROM $table_name WHERE (issue = 'NULL' AND state = '". $state ."' AND city = 'NULL')");
    $meta_title = $post_Arr[0]->custom_meta_title;
    $meta_description = $post_Arr[0]->custom_meta_description;
    
} elseif(!empty($state) && !empty($city) && $issue== '') { echo 'state & city available';
    
    $post_Arr = $wpdb->get_results("SELECT * FROM $table_name WHERE (issue = 'NULL' AND state = '". $state ."' AND city = '".$city."')");
    $meta_title = $post_Arr[0]->custom_meta_title;
    $meta_description = $post_Arr[0]->custom_meta_description;
    
} else { echo 'issue & state & city available';
    
    $post_Arr = $wpdb->get_results("SELECT * FROM $table_name WHERE (issue = '". $issue ."' AND state = '". $state ."' AND city = '". $city ."')");
    $meta_title = $post_Arr[0]->custom_meta_title;
    $meta_description = $post_Arr[0]->custom_meta_description;
    
}

if(empty($meta_title)) { $meta_title = ''; }

if(empty($meta_description)) { $meta_description = ''; }

?>
<!----------- Location Page ------------------>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $falcons_option_data =get_option('falcons_option_data'); ?>
    
    <title><?php echo $meta_title; ?></title>
    <meta property="og:description" content="<?php echo $meta_description; ?>">
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_description; ?>">
    
    <link rel="canonical" href="<?php echo $whole_current_url; ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Open+Sans:wght@300&display=swap" rel="stylesheet">

  <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
  <?php wp_head(); ?>
  
</head>

<body <?php body_class('page-template-lawyers-find-by-location'); ?> >
  <div class="uou-block-11a mobileMenu">
    <!--<h5 class="title"><?php esc_html_e( 'Menu', 'falcons' ); ?></h5>-->
    <a href="#" class="mobile-sidebar-close"><?php esc_html_e( 'X', 'falcons' ); ?> </a>
      <?php get_template_part('templates/header','menuMobile'); ?>
    <hr>
    <?php // get_search_form(); ?>
  </div>

<div id="main-wrapper">
    
    <div class="toolbar">
        <?php get_template_part('templates/headerS/header','choose'); ?>
		
		<div class="uou-block-3a secondary">
            <div class="container">
              <ul class="breadcrumbs">
               
                <li>
                    <a rel="v:url" property="v:title" href="<?php echo home_url(); ?>">Home</a>
                    &nbsp; &nbsp; &gt; &nbsp; &nbsp;<span><?php get_custom_heading($state); ?></span> 
                <?php if(!empty($city)) { ?>
                    &nbsp; &nbsp; &gt; &nbsp; &nbsp;<span><?php get_custom_heading($city); ?></span> 
                <?php } if(!empty($issue)) { ?>
                    &nbsp; &nbsp; &gt; &nbsp; &nbsp;<span><?php get_custom_heading($issue); ?></span> 
                <?php } ?>
                </li>
               
              </ul>
            </div>
        </div> <!-- end .uou-block-3b -->

    </div>
    
    <?php

    if($city == '') { //Show Cities
        
        $term_object = get_term_by( 'slug', $state , $location_taxonomy_slug );
        $termID = $term_object->term_id;
        
        $terms = get_terms( $location_taxonomy_slug, array( 'parent' => $termID, 'orderby' => 'slug', 'hide_empty' => true ) );
        
        ?>
        <div class="container">
    		<div class="city">
        		<h3>Issues based on State <?php echo get_custom_heading($state); ?></h3>
        		<div class="row">
                    <?php if(!empty($terms)) {
                        foreach ( $terms as $term ) { ?>
                            <div class="col-md-2">
                                <!-- <a href="?state=<?php //echo $state; ?>&city=<?php echo $term->slug; ?>"><i class="fa fa-globe" aria-hidden="true"></i> <?php //echo $term->name; ?></a>-->
                                <div class="card">
                                    <a href="<?php echo home_url().'/location/lawyers/'.$state.'/'.$term->slug; ?>">
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
    } elseif($issue == '') { //Show Issues
        
        ?>
        <div class="container">
    		<div class="issues">
        		<h3>Issues based on City <?php echo get_custom_heading($city); ?></h3>
        		<div class="row">
                    <?php
                    $thirdpostargs = array(
                        'post_type' => $location_post_type,
                        'tax_query' => array(
                            array(
                            'taxonomy' => $location_taxonomy_slug,
                            'field' => 'slug',
                            'terms' => $city
                             )
                          )
                    );
                    $posts = get_posts($thirdpostargs);
                    
                    foreach($posts as $post) {
                        $category_detail=get_the_category($post->ID);
                        $term_obj_list = get_the_terms( $post->ID, $category_issue_slug );
                        foreach ( $term_obj_list as $sterm ) {
                            
                            $feature_img_id = get_option('_cate_main_image_'.$sterm->term_id);
                            $feature_img=falcons_IMAGE.'default-lawfirm-category.jpg';
                            $feature_image = wp_get_attachment_image_src( $feature_img_id, 'large' );
                            if($feature_image[0]!=""){
                                $feature_img=$feature_image[0];
                                $feature_img_width=$feature_image[1];
                                $feature_img_height=$feature_image[2];
                            }
                            array_push($issue_arr,array('name' => $sterm->name, 'slug' => $sterm->slug, 'img' => $feature_img));
                        }
                    }
                    $unique_issue_arr = array_unique($issue_arr, SORT_REGULAR);
                    
                    foreach ( $unique_issue_arr as $single_issue ) { ?>
                    
                        <div class="col-md-3">
                            <div class="issue-small-card">
                                <a href="<?php echo home_url().'/location/lawyers/'.$state.'/'.$city.'/'.$single_issue['slug']; ?>">
                                    <span class="img-wrapper">
                                        <img src="<?php echo $single_issue['img']; ?>" alt="<?php echo $subterm->slug.'-img'; ?>" height="40px" width="auto">
                                    </span>
                                    <span><?php echo $single_issue['name']; ?></span>
                                </a>
                            </div>
                        </div>
                        
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <?php
    } else { //Show Lawyers?>

    <div class="container">
		<div class="issues">
    		<h3>Lawyers of City <?php echo get_custom_heading($city); ?> and Issue <?php echo get_custom_heading($issue); ?></h3>
    		<div class="row">
        		<?php
        		$args = array('post_type' => $location_post_type, 'posts_per_page' => -1);
                
                if (!empty($city)) {
                    $tax_arr[] = array(
                        'taxonomy' => $location_taxonomy_slug, //taxonomy/location
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
        		
        		if ( $the_query->have_posts() ) :
        		    
    	            while ( $the_query->have_posts() ) : $the_query->the_post();
    	                
    	                custom_lawysers_card($post, get_the_ID());
    	                
    				endwhile;
    				
    			endif; ?>
    			
        	</div>
    	</div>
    </div>


<?php    
} 

