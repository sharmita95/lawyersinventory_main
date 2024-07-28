<?php /* Template Name: Custom Metadata Listing */ ?>

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
?>
<!----------- Location Page ------------------>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $falcons_option_data =get_option('falcons_option_data'); ?>
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
                    <a rel="v:url" property="v:title" href="<?php echo home_url(); ?>">Home</a> </span> &nbsp; &nbsp; > &nbsp; &nbsp; <span>Listing</span> 
                </li>
               
              </ul>
            </div>
        </div> <!-- end .uou-block-3b -->

    </div>
    
    <div class="container pt60 pb40">
        <div class="row">
            <div class="col-md-12 pt-4">
                
                <a style="float: right; margin-bottom: 25px;" href="<?php echo home_url('/add-custom-metadata/'); ?>" class="vc_general vc_btn3 vc_btn3-color-orange">
                    Add New Meta Data
                </a>
                <div class="clearfix"></div>
                
                <table id="">
                  <tr>
                    <th>SL No.</th>
                    <th>Issue</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Action</th>
                  </tr>
                  
                    <?php
                    global $wpdb;
                    $table_name = $wpdb->prefix . "custom_metadata";
                    
                    $datam = $wpdb->get_results("SELECT * FROM $table_name");
                    
                    foreach($datam as $data) { ?>
                        <tr>
                            <td>#<?php echo get_custom_heading($data->id); ?></td>
                            <td><?php echo get_custom_heading($data->issue); ?></td>
                            <td><?php echo get_custom_heading($data->state); ?></td>
                            <td><?php echo get_custom_heading($data->city); ?></td>
                            <td><?php echo $data->custom_meta_title; ?></td>
                            <td><?php echo $data->custom_meta_description; ?></td>
                            <td><a href="https://lawyersinventory.com/add-custom-metadata/?id=<?php echo $data->id; ?>" target="_blank">Edit</a></td>
                          </tr>
                        
                    <?php
                    }
                    ?>
                  </table>
                
            </div>
        </div>
    </div>
    
    
    <style>
        table th {
            background: #c29c6a;
            color: #fff;
        }
        table tr:nth-child(odd) {
            background-color: #dddddd94;
        }
        table tr td:not(:last-child) {
            border-right: 1px solid #c29c6a52;
        }
    </style>
    
    
    <?php 
    // if(isset($_GET['SubmitButton'])){
    
    //     $issue = $_GET['issue'];
    //     $state = $_GET['state'];
    //     $city = $_GET['city'];
    //     $custom_meta_title = $_GET['custom_meta_title'];
    //     $custom_meta_description = $_GET['custom_meta_description'];
        
        
        
    //     global $wpdb;
    //     $table_name = $wpdb->prefix . "custom_metadata";
        
        
    //     $post_id = $wpdb->get_results("SELECT id FROM $table_name WHERE (issue = '". $issue ."' AND state = '". $state ."' AND city = '". $city ."')");
        
    //     if(empty($post_id)) {
        
    //         $wpdb->insert($table_name, array(
    //             'issue' => $issue, 
    //             'state' => $state,
    //             'city' => $city, 
    //             'custom_meta_title' => $custom_meta_title,
    //             'custom_meta_description' => $custom_meta_description
    //         ) ); 
            
    //         echo "Added";
            
    //     } else {
            
    //         echo "Already Exists!!";
    //     }

        
    // }
    

get_footer();
?>