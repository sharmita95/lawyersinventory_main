<?php
function falcons_enqueue_styles() {

    $version = '1.0.0';
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css',array( $parent_style ));
    
    
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri().'/js/custom.js',$version, false, true );
}
add_action( 'wp_enqueue_scripts', 'falcons_enqueue_styles' );


// custom css and js
add_action('admin_enqueue_scripts', 'admin_cstm_css_and_js');
 
function admin_cstm_css_and_js() {
    //echo get_stylesheet_directory_uri().'/css/admin-style.css';
    // your-slug => The slug name to refer to this menu used in "add_submenu_page"
        // tools_page => refers to Tools top menu, so it's a Tools' sub-menu page
    //if ( 'tools_page_your-slug' != $hook ) {
      //  return;
    //}
    wp_enqueue_style('admin_css', get_stylesheet_directory_uri().'/css/admin-style.css');
}

add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_func_init' );
function wpdocs_theme_slug_widgets_func_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'textdomain' ),
        'id'            => 'blogsidebar',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
}

if ( file_exists( get_stylesheet_directory_uri().'/theme-shortcodes.php') ) {
    require_once(get_stylesheet_directory_uri().'/theme-shortcodes.php');
}


/************************** Populate city data by choosing state from search(lawyer) *****************/
add_action('wp_ajax_iv_directories_change_city', 'ajax_iv_directories_change_city_process');
add_action('wp_ajax_nopriv_iv_directories_change_city', 'ajax_iv_directories_change_city_process');
function ajax_iv_directories_change_city_process() {   
    
    $output=array('error'=>false,'msg'=>'','url'=>'');

    $termID = $_POST['state_name'];
    $cityid = $_POST['city_name'];
    $taxonomyName = 'lawyers-location';
    
    if(!empty($termID)) {
        $termchildren = get_term_children( $termID, $taxonomyName );
        
        $data = '<select class="city" name="postcity" id ="postcity">';
        $data .= '<option>Choose a City</option>';
        if(!empty($termchildren)) {
            foreach($termchildren as $child) {
                $term = get_term_by( 'id', $child, $taxonomyName ); 
                
                $data .= '<option value="'.$term->term_id.'">'. $term->name . '</option>';
                
            }
        }
        $data .= '</select>';
    } else {
        $parent_term_arr = get_term( $cityid, $taxonomyName );
        //print_r($parent_term_arr);
        $parent_term = $parent_term_arr->parent;
        
        $termchildren = get_term_children( $parent_term, $taxonomyName );
        
        $data = '<select class="city" name="postcity" id ="postcity">';
        $data .= '<option>Choose a City</option>';
        if(!empty($termchildren)) {
            foreach($termchildren as $child) {
                $term = get_term_by( 'id', $child, $taxonomyName ); 
                
                if($cityid == $term->term_id) {
                    $data .= '<option selected value="'.$term->term_id.'">'. $term->name . '</option>';
                } else {
                    $data .= '<option value="'.$term->term_id.'">'. $term->name . '</option>';
                }
            }
        }
        $data .= '</select>';
        
    }
    
    echo json_encode(array("code" => "success","msg"=>"Updated Successfully", "data" => $data));
    exit(0);

}

/*********************** City Chage on Custom  Metadata Form ***********************/
add_action('wp_ajax_iv_directories_change_city_on_metaform', 'ajax_iv_directories_change_city_on_metaform_process');
add_action('wp_ajax_nopriv_iv_directories_change_city_on_metaform', 'ajax_iv_directories_change_city_on_metaform_process');
function ajax_iv_directories_change_city_on_metaform_process() {   
    
    $output=array('error'=>false,'msg'=>'','url'=>'');

    $termslug = $_POST['state_name'];
    $taxonomyName = 'lawyers-location';
    
    if(!empty($termslug)) {
        
        $termArr = get_term_by('slug', $termslug, $taxonomyName);
        
        $termchildren = get_term_children( $termArr->term_id, $taxonomyName );
        
        $data = '<select class="city" name="city" id ="postcity">';
        $data .= '<option value="NULL">----</option>';
        if(!empty($termchildren)) {
            foreach($termchildren as $child) {
                $term = get_term_by( 'id', $child, $taxonomyName );
                
                $data .= '<option value="'.$term->slug.'">'. $term->name . '</option>';
                
            }
        }
        $data .= '</select>';
    }
    echo json_encode(array("code" => "success","msg"=>"City Updated Successfully", "data" => $data));
    exit(0);

}


/////////////// Lawyers Location ////////////////////
/*add_action( 'init', 'create_lawyers_location');
function create_lawyers_location() {

    $labels = array(
        'name'              => _x( 'Location', 'taxonomy general name', 'falcons' ),
        'singular_name'     => _x( 'Location', 'taxonomy singular name', 'falcons' ),
        'search_items'      => __( 'Search location', 'falcons' ),
        'all_items'         => __( 'All Location', 'falcons' ),
        'parent_item'       => __( 'Year of publication', 'falcons' ),
        'parent_item_colon' => __( 'Year of publication:', 'falcons' ),
        'edit_item'         => __( 'Edit Location', 'falcons' ),
        'update_item'       => __( 'Update Location', 'falcons' ),
        'add_new_item'      => __( 'Add new Location', 'falcons' ),
        'new_item_name'     => __( 'New Location', 'falcons' ),
        'menu_name'         => __( 'Location', 'falcons' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        //'public' => true,
        //'has_archive' => true,
        'show_admin_column' => true,
        'query_var'         => false,
        'rewrite'           => array( 
            'slug' => 'lawyers-location', 
            'hierarchical' => true,
            //'with_front'    => true 
        ),
    );

    register_taxonomy( 'lawyers-location', array( 'lawyers' ), $args );
} */

/////////////// Lawyers Location ////////////////////
add_action( 'init', 'create_lawyers_location');
function create_lawyers_location() {

    $labels = array(
        'name'              => _x( 'Location', 'taxonomy general name', 'falcons' ),
        'singular_name'     => _x( 'Location', 'taxonomy singular name', 'falcons' ),
        'search_items'      => __( 'Search location', 'falcons' ),
        'all_items'         => __( 'All Location', 'falcons' ),
        'parent_item'       => __( 'Year of publication', 'falcons' ),
        'parent_item_colon' => __( 'Year of publication:', 'falcons' ),
        'edit_item'         => __( 'Edit Location', 'falcons' ),
        'update_item'       => __( 'Update Location', 'falcons' ),
        'add_new_item'      => __( 'Add new Location', 'falcons' ),
        'new_item_name'     => __( 'New Location', 'falcons' ),
        'menu_name'         => __( 'Location', 'falcons' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        //'public' => true,
        //'has_archive' => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 
            'slug' => 'lawyers-location', 
            'hierarchical' => true,
            //'with_front'    => true 
        ),
    );

    register_taxonomy( 'lawyers-location', array( 'lawyers' ), $args );
}

/********************** Relationship of LawFirms and lawyers ****************************/
add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
    add_menu_page( __('Relationship','my-textdomain'), __('Relationship','my-textdomain'),'manage_options','relationship','my_admin_page_contents','dashicons-schedule',7);
}

function my_admin_page_contents() { ?>

    <h1><?php esc_html_e( 'Relationship between Law Firms and Lawyers', 'my-plugin-textdomain' ); ?></h1>
    
    <?php $lawfirm_arr = get_posts(array('post_type' => 'law-firms', 'posts_per_page' => -1));
    foreach($lawfirm_arr  as $post) { ?>
        
        <div style="    border: 1px solid #ccc;
    padding: 10px 20px;
    margin-bottom: 15px;     margin-right: 15px;">
            <?php echo '<h3>'.$post->post_title.'</h3>'; ?>
            <?php $lawyers_jsondata = get_post_meta( $post->ID, 'physician_list', true );
            
            if(!empty($lawyers_jsondata)) {
                echo '<div>';
                foreach($lawyers_jsondata as $data) {
                    $parent_title = get_the_title( $data );
                    echo '<h5> >> '.$parent_title.'</h5>';
                }
                echo '</div>';
            }
            
            ?>
            
        </div>
        
    <?php } 
}


/***************************************** custom_location_dropdown for Frontend *************************************/
function custom_location_dropdown() {
    
    $location_taxonomy_slug = 'lawyers-location';
    $location_post_type = 'lawyers';

    $taxonomies = array( 
        $location_taxonomy_slug,
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
    
    echo '<ul>';

    foreach ( $terms as $key=>$term ) {
        
        $firstpostargs = array(
            'post_type' => $location_post_type,
            'tax_query' => array(
                array(
                'taxonomy' => $location_taxonomy_slug,
                'field' => 'term_id',
                'terms' => $term->term_id
                 )
              )
        );
        
        echo '<li value="'.$term->term_id.'">'.$term->name.'</li>';

        $subterms = get_terms(  $location_taxonomy_slug, array(
          'parent'   => $term->term_id,
          'hide_empty' => false
        ));
        
        echo '<ul style="margin-left:10px">';

        foreach ( $subterms as $key=>$subterm ) {

            $secondtermlink = get_term_link( $subterm );
            
            $secondpostargs = array(
                'post_type' => $location_post_type,
                'tax_query' => array(
                    array(
                    'taxonomy' => $location_taxonomy_slug,
                    'field' => 'term_id',
                    'terms' => $subterm->term_id
                     )
                  )
            );
            
            echo '<li value="'.$subterm->term_id.'">'.$subterm->name.'</li>';
        
            $secondsubterms = get_terms(  $location_taxonomy_slug, array(
              'parent'   => $subterm->term_id,
              'hide_empty' => false
            ));  
              
            echo '<ul style="margin-left:10px">'; 

            foreach ( $secondsubterms as $key=>$secondsubterm ) {

                $thirdtermlink = get_term_link( $secondsubterm );
                
                $thirdpostargs = array(
                    'post_type' => $location_post_type,
                    'tax_query' => array(
                        array(
                        'taxonomy' => $location_taxonomy_slug,
                        'field' => 'term_id',
                        'terms' => $secondsubterm->term_id
                         )
                      )
                );
                
                echo '<li value="'.$secondsubterm->term_id.'">'.$secondsubterm->name.'</li>';
                
            }
            
            echo '</ul>';
        }
        
        echo '</ul>';
      
    }
    
    echo '</ul>';
    
}

/******************************************************************************************************/

function get_all_lawyers_locaton() {
    
    $location_taxonomy_slug = 'lawyers-location';
    $location_post_type = 'lawyers';

    $taxonomies = array( 
        $location_taxonomy_slug,
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

    foreach ( $terms as $key=>$term ) {

        $firsttermlink = get_term_link( $term );
        
        $firstpostargs = array(
            'post_type' => $location_post_type,
            'tax_query' => array(
                array(
                'taxonomy' => $location_taxonomy_slug,
                'field' => 'term_id',
                'terms' => $term->term_id
                 )
              )
        );
        if(count(get_posts($firstpostargs)) > 0 ) {
        

        $first_level_location[$key] = ['id' => $term->term_id, 'name' => $term->name, 'description' => $term->description, 'link' => $firsttermlink];     

        }
        
        $subterms = get_terms(  $location_taxonomy_slug, array(
          'parent'   => $term->term_id,
          'hide_empty' => false
        ));

        foreach ( $subterms as $key=>$subterm ) {

            $secondtermlink = get_term_link( $subterm );
            
            $secondpostargs = array(
                'post_type' => $location_post_type,
                'tax_query' => array(
                    array(
                    'taxonomy' => $location_taxonomy_slug,
                    'field' => 'term_id',
                    'terms' => $subterm->term_id
                     )
                  )
            );
            if(count(get_posts($secondpostargs)) > 0 ) {

                $second_level_location[$subterm->name] = ['id' => $subterm->term_id, 'name' => $subterm->name, 'description' => $subterm->description, 'link' => $secondtermlink];

            }
            
            $secondsubterms = get_terms(  $location_taxonomy_slug, array(
              'parent'   => $subterm->term_id,
              'hide_empty' => false
              ));           

            foreach ( $secondsubterms as $key=>$secondsubterm ) {

                $thirdtermlink = get_term_link( $secondsubterm );
                
                $thirdpostargs = array(
                    'post_type' => $location_post_type,
                    'tax_query' => array(
                        array(
                        'taxonomy' => $location_taxonomy_slug,
                        'field' => 'term_id',
                        'terms' => $secondsubterm->term_id
                         )
                      )
                );
                if(count(get_posts($thirdpostargs)) > 0 ) {

                    $third_level_location[$secondsubterm->name] = ['id' => $secondsubterm->term_id, 'name' => $secondsubterm->name, 'description' => $secondsubterm->description, 'link' => $thirdtermlink];

                }
                
            }
        }
      
    }
    
    return array($first_level_location, $second_level_location, $third_level_location);
}


/**************** Term image *********/
if (!function_exists('get_term_image')) {
    function get_term_image($termid) {
        if (function_exists('get_wp_term_image')) {
            $meta_image = get_wp_term_image($termid);
        } if(empty($meta_image)) {
            $meta_image = get_stylesheet_directory_uri().'/img/default-blog-bg.jpg';
        }
        
        echo '<img src='.$meta_image.'">';
        //return $meta_image;
    }
}


/***************** Title(Location,Practice) *************/
if (!function_exists('get_custom_heading')) {
    function get_custom_heading($title) {
        echo ucwords(str_replace("-"," ",$title));
    }
}



//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////// Page META DATA Change /////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

add_filter( 'wpseo_opengraph_title', 'change_title' ); //og title
function change_title( $title ) {
  
    $whole_current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
    $current_url = str_replace(home_url(),"",$whole_current_url);
    $current_url = explode("/",str_replace("/lawyersinventory/","",$_SERVER['REQUEST_URI']));
    
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
    
    if( ($current_url[0] =='location' || $current_url[0] =='practice') && !empty($current_url[1])) {
        
      $title = __( 'Practice page' );
      
        if( $current_url[0] =='location' && !empty($current_url[1])) {
        
            $state = ucwords(str_replace("-"," ",$current_url[1]));
            $city = ucwords(str_replace("-"," ",$current_url[2]));
            $issue = ucwords(str_replace("-"," ",$current_url[3]));
            
            if(!empty($state) && $city == '') {
                $title = __( 'Best Lawyers in the State '.$state);
            } elseif(!empty($city) && $issue == '') {
                $title = __( 'Best Lawyers in the State '.$city);
            } else {
                $title = __( 'Best Lawyers in the State '.$issue);
            }
            
        } elseif( $current_url[0] =='practice' && !empty($current_url[1])) {
            
            $issue = ucwords(str_replace("-"," ",$current_url[1]));
            $state = ucwords(str_replace("-"," ",$current_url[2]));
            $city = ucwords(str_replace("-"," ",$current_url[3]));
            ?>
            
            
            <?php
            if(!empty($issue) && $state == '') { //when we have issue
                $title = __( 'Best Lawyers of '.$issue);
            } elseif(!empty($state) && $city == '') { //when we have issue/state
                $title = __( 'Best Lawyers in the State '.$state);
            } else { //when we have issue/state/city
                $title = __( 'Best Lawyers in the City '.$city);
            } ?>
            <?php
        }
    
    }
  
    return $title;

}


add_filter('wpseo_robots', 'yoast_no_home_noindex', 999); //robots
function yoast_no_home_noindex($string= "") {
    
    $whole_current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
    $current_url = str_replace(home_url(),"",$whole_current_url);
    $current_url = explode("/",str_replace("/lawyersinventory/","",$_SERVER['REQUEST_URI']));
  
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
    if( ($current_url[0] =='location' || $current_url[0] =='practice') && !empty($current_url[1])) {
        $string= "index,follow";
    }
    return $string;
}

add_action( 'init', 'disable_yoast_seo_frontend' ); // Remove Meta tag for location,practice page
function disable_yoast_seo_frontend() {
    
    $whole_current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
    $current_url = str_replace(home_url(),"",$whole_current_url);
    $current_url = explode("/",str_replace("/lawyersinventory/","",$_SERVER['REQUEST_URI']));
    
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
    //die();
    
    if( ($current_url[0] =='location' || $current_url[0] =='practice') && !empty($current_url[1])) {
        //echo '404';
        remove_action( 'wp_head', '_wp_render_title_tag', 1 );
        //remove_action( 'wp_head', 'wc_page_noindex' );
    }
    
    if($current_url[0] =='location' && !empty($current_url[1]) && empty($current_url[2])) {
        //echo '404';
        echo 'stop here';
        //die();
    }
    
}

//add Meta Tags in Header without Plugin
add_action('wp_head', 'add_meta_tags'); 
function add_meta_tags() { 
    
    $whole_current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];   
    $current_url = str_replace(home_url(),"",$whole_current_url);
    $current_url = explode("/",str_replace("/lawyersinventory/","",$_SERVER['REQUEST_URI']));
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
    
    if( $current_url[0] =='location' && !empty($current_url[1])) {
        
        $state = ucwords(str_replace("-"," ",$current_url[1]));
        $city = ucwords(str_replace("-"," ",$current_url[2]));
        $issue = ucwords(str_replace("-"," ",$current_url[3]));
        
        header("HTTP/1.1 200 OK");
        
        if(!empty($state) && $city == '') {
            echo '<title>Best Lawyers in the State '.$state.'</title>';
            echo '<meta name="description" content="There are many lawyers found in '.$state.' and the average fee of the lawyers varies as per their experience and skills. ">';
        } elseif(!empty($city) && $issue == '') {
            echo '<title>Best Lawyers in the City '.$city.'</title>';
            echo '<meta name="description" content="There are many lawyers found in '.$city.' and the average fee of the lawyers varies as per their experience and skills. ">';
        } else {
            echo '<title>Best Lawyers of '.$issue.'</title>';
            echo '<meta name="description" content="There are many lawyers found on '.$issue.' and the average fee of the lawyers varies as per their experience and skills. ">';
        }
        
    } elseif( $current_url[0] =='practice' && !empty($current_url[1])) {
        
        $issue = ucwords(str_replace("-"," ",$current_url[1]));
        $state = ucwords(str_replace("-"," ",$current_url[2]));
        $city = ucwords(str_replace("-"," ",$current_url[3]));
        
        header("HTTP/1.1 200 OK");
        
        if(!empty($issue) && $state == '') { //when we have issue
            echo '<title>Best Lawyers of '.$issue.'</title>';
            echo '<meta name="description" content="There are many lawyers found in '.$issue.' and the average fee of the lawyers varies as per their experience and skills. ">';
        } elseif(!empty($state) && $city == '') { //when we have issue/state
            echo '<title>Best Lawyers in the State '.$state.'</title>';
            echo '<meta name="description" content="There are many lawyers found in '.$state.' and the average fee of the lawyers varies as per their experience and skills. ">';
        } else { //when we have issue/state/city
            echo '<title>Best Lawyers in the City '.$city.'</title>';
            echo '<meta name="description" content="There are many lawyers found on '.$city.' and the average fee of the lawyers varies as per their experience and skills. ">';
        } ?>
        <?php
    }
    
}


//add_filter( 'wpseo_metadesc', 'remove_yoast_meta_description' );
function remove_yoast_meta_description( $myfilter ) {
    if ( is_page ( 'about' ) ) {
        return false;
    }
    return $myfilter;
}

/**************************************** Home page Location section *************************************/
//add_shortcode('top_lawyers_locations', 'top_lawyers_locations_func');
/*function top_lawyers_locations_func() {
    
    $location_arr = get_all_lawyers_locaton(); ?>
    
    <div class="container home-location">
        <div class="row">
        
            <div class="col-md-6">
                <h5>Top States</h5>
                <div class="row">
                    <?php $i = 0;
                    foreach ( $location_arr[1] as $key=>$singlestate ) {
                        if($i <= 3) {?>
                        <div class="col-md-4 card">
                            <i class="fa fa-globe" aria-hidden="true"></i><br>
                            <a href="<?php echo $singlestate['link']; ?>">
                                 <?php echo $singlestate['name']; ?>
                            </a>
                        </div>
                    <?php }
                    $i++;
                    } ?>
                </div>
            </div>
        
            <div class="col-md-6">
                <h5>Top Cities</h5>
                Find the best lawyers near you - Filter out the right lawyer based on your cities.
                <div class="row">
                    <?php $j = 0;
                    foreach ( $location_arr[2] as $key=>$singlecity ) {
                        if($j <= 3) { ?>
                        <div class="col-md-4 card">
                            <i class="fa fa-globe" aria-hidden="true"></i><br>
                            <a href="<?php echo $singlecity['link']; ?>">
                                <?php echo $singlecity['name']; ?>
                            </a>
                        </div>
                    <?php }
                    $j++;
                    } ?>
                </div>
            </div>
        </div>
    </div>
    
<?php    
} */



add_shortcode('top_locations_for_lawyers', 'top_locations_for_lawyers_func');
function top_locations_for_lawyers_func() {
    
    $location_arr = get_all_lawyers_locaton(); ?>
    
    <!--<h2 class="home-title" style="text-align: center;"><strong>Top Locations</strong></h2>-->
    
    <div class="container featured-location">
        <div class="row">
        
            <div class="col-md-12">
                <h2 class="home-title" style="text-align: center;"><strong> Top States </strong></h2>
                <p style="text-align: center;">Filter out the best lawyers based on states.</p>
                <div class="row">
                    <?php $i = 0;
                    foreach ( $location_arr[1] as $key=>$singlestate ) {
                        if($i <= 11) {
                        
                            if (function_exists('get_wp_term_image')) {
                                $meta_image = get_wp_term_image($singlestate['id']);
                            } if(empty($meta_image)) {
                                $meta_image = get_stylesheet_directory_uri().'/img/default-blog-bg.jpg';
                            } ?>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="card">
                                    <a href="<?php echo $singlestate['link']; ?>"><img src="<?php echo $meta_image; ?>"></a>
                                    <div class="content">
                                        <!--<i class="fa fa-globe" aria-hidden="true"></i>-->
                                        <a href="<?php echo $singlestate['link']; ?>">
                                             <?php echo $singlestate['name']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        
                        }
                    $i++;
                    } ?>
                </div>
            </div>
        
            <div class="col-md-12">
                <h2 class="home-title" style="text-align: center;"><strong> Top Cities</strong></h2>
                <p style="text-align: center;">Find the best lawyers near you - Filter out the right lawyer based on your cities.</p>
                <div class="row">
                    <?php $j = 0;
                    foreach ( $location_arr[2] as $key=>$singlecity ) {
                        if($j <= 11) {
                            if (function_exists('get_wp_term_image')) {
                                $meta_image = get_wp_term_image($singlecity['id']);
                            } if(empty($meta_image)) {
                                $meta_image = get_stylesheet_directory_uri().'/img/default-blog-bg.jpg';
                            } ?>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <div class="card">
                                    <a href="<?php echo $singlecity['link']; ?>"><img src="<?php echo $meta_image; ?>"></a>
                                    <div class="content">
                                        <!--<i class="fa fa-globe" aria-hidden="true"></i>-->
                                        <a href="<?php echo $singlecity['link']; ?>">
                                            <?php echo $singlecity['name']; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    $j++;
                    } ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="wpb_column vc_column_container vc_col-sm-12" style="margin-bottom: 25px;">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="vc_btn3-container vc_btn3-center">
                    <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-icon-right vc_btn3-color-orange" 
                    href="<?php echo home_url('location/'); ?>" title="">View All Location <i class="vc_btn3-icon fa fa-arrow-right"></i></a>
               </div>
           </div>
       </div>
     </div>
    
<?php    
}

/********************* Legal Issues *******************/
add_shortcode('legal_issues_card', 'legal_issues_card_func'); //Front page Legal Issues
function legal_issues_card_func() {
    
    global $post,$wpdb,$tag;
    $directory_url_1='lawyers'; 
    ?>
    <div class="container categories-imgs text-center legal-issues-wrapper">
        <div class="legal-issues-container ">
            <h2 class="home-title" style="text-align: center;"><strong> Top Legal Issues </strong></h2>
            <p style="text-align: center;">Filter out the best lawyers based on states.</p>
            <div class="grid-container">
                        
                <?php
                $taxonomies = array( 
                    $directory_url_1.'-category',
                );
                
                $args = array(
                    'orderby'           => 'name', 
                    'order'             => 'ASC',
                    'hide_empty'        => true, 
                    'fields'            => 'all',
                    'parent'            => 0,
                    'hierarchical'      => true,
                    'child_of'          => 0,
                    'pad_counts'        => false,
                    'cache_domain'      => 'core'  ,
                    'number' => 10
                );
                
                $terms = get_terms($taxonomies, $args);
                $t = 0;
                foreach ( $terms as $term ) {
                    
                    if($t <= 7) {
                    
                        $feature_img_id = get_option('_cate_main_image_'.$term->term_id);
                        $feature_img=falcons_IMAGE.'default-lawfirm-category.jpg';
                        $feature_image = wp_get_attachment_image_src( $feature_img_id, 'large' );
                        if($feature_image[0]!=""){
                            $feature_img=$feature_image[0];
                            $feature_img_width=$feature_image[1];
                            $feature_img_height=$feature_image[2];
                        } 
                        
                        $subterms = get_terms( array(
                          'taxonomy' => $directory_url_1.'-category',
                          'parent'   => $term->term_id,
                          'hide_empty' => true
                        ));
                        
                        if(!empty($subterms)) { ?>
                        
                            <div class="grid-item">
                                <div class="aops-box">
                                    <div class="circle icon icon-family-law">
                                         <div class="img-container">
                                            <img src="<?php echo $feature_img; ?>" class="fade-in-fx loaded">
                                        </div>
                                    </div>
                                    <h3><?php echo $term->name; ?></h3>
                                    <?php echo '<ul class="child-law">';
                                        $c =1;
                                        foreach ( $subterms as $subterm ) {
                                            if($c<=4) { ?>
                                                <li><a href="<?php echo get_term_link( $subterm ); ?>"><?php echo $subterm->name; ?></a></li>
                                        <?php }
                                        $c++;
                                        }
                                        echo '</ul>';
                                    ?>
                                </div>
                            </div>
                    
                        <?php
                        }
                    }
                $t++;
                } 
                ?>
                
            </div>      
        </div>
    </div>
    
    <div class="wpb_column vc_column_container vc_col-sm-12" style="margin-top: 20px;">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="vc_btn3-container vc_btn3-center">
                    <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-classic vc_btn3-icon-right vc_btn3-color-orange" 
                    href="<?php echo home_url('practice/'); ?>" title="">View All Issues <i class="vc_btn3-icon fa fa-arrow-right"></i></a>
               </div>
           </div>
       </div>
     </div>
    
<?php
}

/*************************** Custom Lawyers Card *****************************/

if (!function_exists('custom_lawysers_card')) {
  function custom_lawysers_card($post, $id) {
      
    $category_issue_slug = 'lawyers-category';
    $phone_no = get_post_meta($id,'phone',true);
    $contact_web = get_post_meta($id,'contact_web',true);
    $address = get_post_meta($id,'address',true);
    $content = substr(strip_tags(get_the_content()),0, 240);
    
    $thumbnail_img = get_the_post_thumbnail($id, 'thumbnail', array( 'class' => '' ) );
    
    /************************* Profile Status Checking ******************/
    $post_author_id = $post->post_author;
    $user_meta = get_userdata($post_author_id);
    $user_roles = $user_meta->roles;
    
    $payment_status= get_user_meta($post_author_id, 'iv_directories_payment_status', true);
    
    //All package
    $package_names = iPayment_package();
    ?>
    
        <div class="col-md-12">
            <div class="lawyers-card">
                <div class="row">
                
                <div class="col-md-2 col-xs-12">
                    <div class="image-container">
                        <?php if(!empty($thumbnail_img)) {
                            echo get_the_post_thumbnail($id, 'thumbnail', array( 'class' => '' ) );
                        } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/framework/falcons-profile/assets/images/default-lawyer.png" alt="image">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="cbp-l-caption-body">
                        <a href="<?php echo get_the_permalink($id); ?>">
                            <div class="cbp-l-caption-title">
                                <h2>
                                    <?php echo $post->post_title; ?>
                                    <!--<div class="premium-profile-tag">Premium</div>-->
                                </h2>
                            </div>
                        </a>
                        <ul class="issues-list">
                            <?php $term_arr = [];
                            $term_count = 0;
                            foreach ( get_the_terms( $id, $category_issue_slug ) as $term ) {
                                $term_link = get_term_link( $term );
                                if ( is_wp_error( $term_link ) ) {
                                    continue;
                                }
                                if($term_count <= 2) {
                                    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
                                } else {
                                    if(empty($term_arr)) {
                                        $term_arr = array(0=>array('link' => $term_link, 'name' => $term->name ));
                                    } else {
                                        $new_term_arr = array($term_count => array('link' => $term_link, 'name' => $term->name ));
                                        $term_arr = array_merge($term_arr, $new_term_arr);
                                    }
                                }
                            $term_count++;
                            } ?>
                            
                            <?php if(!empty($term_arr) && count($term_arr)>0) { ?>
                            <div class="tooltip">+
                                <span class="tooltiptext">
                                    <?php foreach ( $term_arr as $extra_term ) { ?>
                                    
                                        <a href="<?php echo $extra_term['link']; ?>"><?php echo $extra_term['name']; ?></a><br>
                                        
                                    <?php } ?>
                                </span>
                            </div>
                            <?php } ?>
                            
                        </ul>
                        <p><?php echo $content; ?></p>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    
                    <div class="listing-ctas">
                        <div class="result_contact_info">
                            <?php if(in_array($user_roles[0],$package_names) && $user_roles[0] != 'Basic' && $payment_status == 'success' && !empty($phone_no)) { ?>
                            <a rel="sponsored" class="serp_result_phone listing-desc-phone directory_phone" href="tel:<?php echo $phone_no; ?>">
                                <i class="fa fa-phone" aria-hidden="true"></i><?php echo $phone_no; ?>
                            </a>
                            <?php } ?>
                            <a class="listing-desc-phone directory_profile" href="<?php echo get_the_permalink($id); ?>">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Visit Profile
                            </a>
                            <?php if(in_array($user_roles[0],$package_names) && $user_roles[0] != 'Basic' && $payment_status == 'success' && !empty($address)) { ?>
                            <a class="listing-desc-contact directory_contact">
                                <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $address; ?>
                            </a>
                            <?php } ?>
                            <!--<p class="listing-free-consult"><i class="fa fa-check" aria-hidden="true"></i>Free Consultation</p>-->
                        </div>
                        
                        <?php if(in_array($user_roles[0],$package_names) && $user_roles[0] != 'Basic' && $payment_status == 'success' && !empty($contact_web)) { ?>
                        <a class="directory_website" href="<?php echo esc_url($contact_web); ?>" target="_blank" rel="noopener noreferrer nofollow">
                            <div class="button">Visit Website</div>
                        </a>
                        <?php } ?>
                        
                    </div>
                    
                </div>
                
            </div>
            </div>
        </div>
                        
    <?php
  }
}

/************************************** Search Query ********************************/
add_action('pre_get_posts', 'exclude_other_post_types');
function exclude_other_post_types($query) {
  if ($query->is_search && $query->is_main_query() ) {
    $query->set('post_type', 'post');
  }
}


//add_action( 'category_add_form_fields', array ( 'add_category_image' ), 10, 2 );
function add_category_image ( $taxonomy ) { ?>
   <div class="form-field term-group">
     <label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
     <div id="category-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
    </p>
   </div>
 <?php
}

/********************* Featured lawyers *************************/
add_action( 'add_meta_boxes', 'add_custom_box' );

function add_custom_box( $post ) {
    
    //$post_types = array ( 'post', 'lawyers');
    $post_types = array ( 'lawyers');
    
    add_meta_box(
        'Meta Box', // ID, should be a string.
        'Featured Lawyer', // Meta Box Title.
        'featured_meta_box', // Your call back function, this is where your form field will go.
        $post_types, // The post type you want this to show up on, can be post, page, or custom post type.
        'normal', // The placement of your meta box, can be normal or side.
        'core' // The priority in which this will be displayed.
    );
}

function featured_meta_box($post) {
    wp_nonce_field( 'my_awesome_nonce', 'awesome_nonce' );    
    $checkboxMeta = get_post_meta( $post->ID );
    ?>
    
     <input type="checkbox" name="_featured_post" id="_featured_post" value="yes" <?php if ( isset ( $checkboxMeta['_featured_post'] ) ) checked( $checkboxMeta['_featured_post'][0], 'yes' ); ?> />Yes<br />

<?php }


add_action( 'save_post', 'save_featured_checkboxes' );
function save_featured_checkboxes( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;
    if ( ( isset ( $_POST['my_awesome_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['my_awesome_nonce'], plugin_basename( __FILE__ ) ) ) )
        return;
    if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }    
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    
    //saves _featured_post's value
    if( isset( $_POST[ '_featured_post' ] ) ) {
        update_post_meta( $post_id, '_featured_post', 'yes' );
    } else {
        update_post_meta( $post_id, '_featured_post', 'no' );
    }
}


/************************* Post view *****************************/
function subh_get_post_view( $postID ) {
    $count_key = 'post_views_count';
    $count     = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '0' );
    
    return '0 View';
    }
    
    return $count . ' Views';
}
function subh_set_post_view( $postID ) {
    $count_key = 'post_views_count';
    $count     = (int) get_post_meta( $postID, $count_key, true );
    if ( $count < 1 ) {
    delete_post_meta( $postID, $count_key );
    add_post_meta( $postID, $count_key, '1' );
    } else {
    $count++;
    update_post_meta( $postID, $count_key, (string) $count );
    }
}
function subh_posts_column_views( $defaults ) {
    $defaults['post_views'] = __( 'Views' );
    
    return $defaults;
}
function subh_posts_custom_column_views( $column_name, $id ) {
    if ( $column_name === 'post_views' ) {
    echo subh_get_post_view( get_the_ID() );
    }
}
    
add_filter( 'manage_posts_columns', 'subh_posts_column_views' );
add_action( 'manage_posts_custom_column', 'subh_posts_custom_column_views', 5, 2 );


add_shortcode('my_popular_posts', 'my_popular_post_func');
function my_popular_post_func() { ?>

    <?php global $posts;
    $popular_args = get_posts(
        array( 'post_type' => 'post',
            'post_status'=>'publish', 
            'posts_per_page' => 5,
            'order'     => 'DESC',
            'meta_key' => 'post_views_count',
            'orderby'   => 'meta_value_num'
        )
    ); ?>
    <li class="widget widget_recent_entries">
        <h3 class="widgettitle">Popular Posts</h4>
        <ul>
        <?php foreach($popular_args as $posts) { ?>
            <li>
                <a href="<?php echo get_the_permalink($posts->ID); ?>"><?php echo $posts->post_title; ?></a>
                <span class="post-date"><?php echo get_the_date(); ?></span>
            </li>
            <?php } ?>
        </ul>
    </li>
<?php }

/* Add the media uploader script */
function my_media_lib_uploader_enqueue() {
    wp_enqueue_media();
    wp_register_script( 'media-lib-uploader-js', home_url().'/wp-includes/js/media-models.min.js?ver=5.8.2', array('jquery') );
    wp_enqueue_script( 'media-lib-uploader-js' );
}
// add_action('admin_enqueue_scripts', 'my_media_lib_uploader_enqueue');


/* All Payment Packages */
if (!function_exists('iPayment_package')) {
    function iPayment_package() {
        global $wpdb, $post;
        $package = [];
        $sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'";
        $membership_pack = $wpdb->get_results($sql);
        $total_package=count($membership_pack);
        
        if(sizeof($membership_pack)>0){
            foreach ( $membership_pack as $row )
            {
                $package[] = $row->post_title;
            }
        }
        return $package;
    }
}

/* Show All Users on Author Dropdown (Backend) */
add_action('wp_dropdown_users_args', 'filter_authors');
function filter_authors( $args ) {
    if ( isset( $args['who'])) {
        $args['role__in'] = ['author', 'editor', 'administrator', 'Basic', 'Gold', 'wpseo_editor', 'wpseo_manager'];
        unset( $args['who']);
    }
    return $args;
}


