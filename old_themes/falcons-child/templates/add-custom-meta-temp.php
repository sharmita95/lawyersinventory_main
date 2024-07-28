<?php /* Template Name: Add Custom Metadata */ ?>

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
 
 <?php global $wpdb;
 $table_name = $wpdb->prefix . "custom_metadata"; ?>

<div id="main-wrapper" class="pb40">
    
    <div class="toolbar">
        <?php get_template_part('templates/headerS/header','choose'); ?>
		
		<div class="uou-block-3a secondary">
            <div class="container">
              <ul class="breadcrumbs">
               
                <li>
                    <a rel="v:url" property="v:title" href="<?php echo home_url(); ?>">Home</a> </span> &nbsp; &nbsp; > &nbsp; &nbsp; <span>Add Data</span> 
                </li>
               
              </ul>
            </div>
        </div> <!-- end .uou-block-3b -->

    </div>
    
    
    
    <?php 
    $metaID = $_GET['id'];
    if(!empty($metaID)) {
        
        global $postDatam;
        
        $postDatam = $wpdb->get_results("SELECT * FROM $table_name WHERE (id = '". $metaID ."')");
        
        $issueGetData = $postDatam[0]->issue;
        $stateGetData = $postDatam[0]->state;
        $cityGetData = $postDatam[0]->city;
        $metaTitleGetData = $postDatam[0]->custom_meta_title;
        $metaDescGetData = $postDatam[0]->custom_meta_description;
        
    }
    if(is_user_logged_in()) {
        $user = wp_get_current_user(); // getting & setting the current user 
    	$roles = ( array ) $user->roles; // obtaining the role
        
        if($roles[0] == 'administrator' || $roles[0] == 'editor') { // check if there is a logged in user 
    	?>
        
            <div class="container pt60">
                
                <div class="row">
                    <div class="col-md-12 pt-4">
                        
                        <a style="float: right; margin-bottom: 25px;" href="<?php echo home_url('/add-custom-metadata/'); ?>" class="vc_general vc_btn3 vc_btn3-color-orange">
                            Add New Meta Data
                        </a>
                        <a style="float: right; margin-bottom: 25px; margin-right: 15px;" href="<?php echo home_url('/custom-metadata-listing/'); ?>" class="vc_general vc_btn3 vc_btn3-color-orange">
                            Meta Data Listing
                        </a>
                        <div class="clearfix"></div>
                        
                        <?php if(isset($_POST['SubmitButton'])) {
                            
                            $metaID = $_POST['metaID'];
                            $issue = $_POST['issue'];
                            $state = $_POST['state'];
                            $city = $_POST['city'];
                            $custom_meta_title = $_POST['custom_meta_title'];
                            $custom_meta_description = $_POST['custom_meta_description'];
                            
                            if(!empty($issue) && !empty($state) && !empty($city)) {
                                $post_Arr = $wpdb->get_results("SELECT id FROM $table_name WHERE (issue = '". $issue ."' AND state = '". $state ."' AND city = '". $city ."')");
                                $post_ID = $post_Arr[0]->id;
                            } elseif(!empty($issue) && !empty($state) && empty($city)) {
                                $post_Arr = $wpdb->get_results("SELECT id FROM $table_name WHERE (issue = '". $issue ."' AND state = '". $state ."' AND city = 'NULL')");
                                $post_ID = $post_Arr[0]->id;
                            } elseif(!empty($issue) && empty($state) && empty($city)) {
                                $post_Arr = $wpdb->get_results("SELECT id FROM $table_name WHERE (issue = '". $issue ."' AND state = 'NULL' AND city = 'NULL')");
                                $post_ID = $post_Arr[0]->id;
                            }
                            
                            // echo $post_ID;
                            // print_r($_POST);
                            
                            if(empty($post_ID)) {
                            
                                $wpdb->insert($table_name, array(
                                    'issue' => $issue, 
                                    'state' => $state,
                                    'city' => $city, 
                                    'custom_meta_title' => $custom_meta_title,
                                    'custom_meta_description' => $custom_meta_description
                                ) ); 
                                
                                echo "<div class='message'><div class='success'>Added. Check the <a href='https://lawyersinventory.com/custom-metadata-listing/'>listing page.</a></div></div>";
                                //Redirect after sometime to listing page
                                
                            } else {
                                
                                //echo 'UPDATE SECTION';
                                
                                $data=array('custom_meta_title'=>$custom_meta_title, 'custom_meta_description' => $custom_meta_description);
                                $where=array('id'=>$post_ID);
                                $result4=$wpdb->UPDATE($table_name,$data,$where,"%s","%d");
                                
                                echo "<div class='message'><div class='update'>Updated. Check the <a href='https://lawyersinventory.com/custom-metadata-listing/'>listing page.</a></div></div>";
                                //Redirect after sometime to listing page
                                
                            }
                            
                            $_POST = array();
                        }
                        ?>
                        
                        <div class="clearfix"></div>
                        
                        <form action="" method="post">
                            
                            <?php if(!empty($metaID)) { ?>
                            <input type="hidden" value="<?php echo $metaID; ?>" name="metaID" readonly>
                            <?php } ?>
                            
                            <?php /* $issue_tax = get_terms($category_issue_slug, array('hide_empty' => 0)); ?>
                            <label for="city">Legal Issues/Practice Area</label>
                            <select name="issue" id="issue">
                                <?php foreach($issue_tax as $issue) { ?>
                                    <option value="<?php echo $issue->slug; ?>"><?php echo $issue->name; ?></option>
                                <?php } ?>
                            </select>
                            <?php */ ?>
                            
                            <label for="city">Legal Issues/Practice Area</label>
                            <select name="issue" id="issue">
                                <option value="NULL" <?php if($issueGetData == 'NULL') { echo 'selected'; } ?>>-----</option>
                                <?php $parent_issue_tax = get_terms( $category_issue_slug, array( 'parent' => 0, 'orderby' => 'slug', 'hide_empty' => false ) );  
                                foreach ( $parent_issue_tax as $pterm ) {
                                    $terms = get_terms( $category_issue_slug, array( 'parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
                                    foreach ( $terms as $term ) { ?>
                                        <option value="<?php echo $term->slug; ?>" <?php if($issueGetData == $term->slug) { echo 'selected'; } ?>><?php echo $term->name; ?></option>
                                    <?php  }
                                } ?>
                            </select>
                            
                            <?php
                            if(!empty($stateGetData)) { ?>
                                    
                                <label for="state">State</label>
                                <select name="state" id="state">
                                    <option value="<?php echo $stateGetData; ?>"><?php echo get_custom_heading($stateGetData); ?></option>
                                </select>
                                
                            <?php } else {
                            
                                $state_tax = get_terms($location_taxonomy_slug, array('hide_empty' => 0)); ?>
                                <label for="state">State</label>
                                <select name="state" id="poststate">
                                    <option value="NULL" <?php if($issueGetData == 'NULL') { echo 'selected'; } ?>>-----</option>
                                    <?php foreach($state_tax as $state) { ?>
                                        <option value="<?php echo $state->slug; ?>"><?php echo $state->name; ?></option>
                                    <?php } ?>
                                </select>
                            
                            <?php } ?>
                            
                            <?php 
                            if(!empty($cityGetData)) { ?>
                                    
                                <label for="city">City</label>
                                <select name="city" id="city">
                                    <option value="<?php echo $cityGetData; ?>"><?php echo get_custom_heading($cityGetData); ?></option>
                                </select>
                                
                                <?php
                            } else { ?>
                            
                            <div class="city-based-on-state">
                                <label for="city">City</label>
                    		    <select>
                    		        <option value="NULL">Select State to choose city</option>
                    		    </select>
                    		 </div>
                    		 
                    		 <?php } ?>
                            
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="custom_meta_title" value="<?php echo $metaTitleGetData; ?>">
                            
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control" name="custom_meta_description"><?php echo $metaDescGetData; ?></textarea>
                            
                            <input type="submit" value="Submit" name="SubmitButton">
                        </form>
                        
                    </div>
                </div>
            </div>
        
        <?php } else {
            echo '<div class="container pt60">You are not allowed to add metadata.</div>';
        }
    } else {
        echo '<div class="container pt60">You are not allowed to add metadata.</div>';
    }
get_footer();
?>

<script>
    jQuery(document).ready(function($) {
	   /****** On change state get city  *******/ 
        $('#poststate').on('change', function () {
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            
        	var search_params={
        		"action"  : 	"iv_directories_change_city_on_metaform",	
        		"state_name":	$(this).val(), 
        	};
        	
        	console.log(search_params);
        	jQuery.ajax({					
        		url : ajaxurl,					 
        		dataType : "json",
        		type : "post",
        		data : search_params,
        		success : function(response){
        		    console.log(response.code);
        		    
        			if(response.code=='success'){
        				$('.city-based-on-state select').remove();
        				//console.log(response.data);
        				$(".city-based-on-state").append(response.data);
        			}
        		}
        	});
        });
        
        
        /********* Hide Success and error message **********/
        setTimeout(function() {
            $('.message').remove();
        }, 5000);
    });
</script>



<style>
    .success {
        background: #00ff1f30;
        color: #21821a;
        font-weight: 800;
        padding: 15px;
        margin: 0 auto;
        border-radius: 10px; 
    }
    .update {    
        background: #ffe1aa;
        color: #faa200;
        font-weight: 800;
        padding: 15px;
        margin: 0 auto;
        border-radius: 10px;
    }
    .message > div {
            margin-bottom: 30px;
    }
    .message > div a {
        font-weight: 800;
        color: #000;
            font-size: 16px;
    }
    form input[type="submit"] {
        width: 15%;
        height: 5rem;
        background: #c29c6a;
        color: #fff;
        border: none;
        transition: 0.3s;
    }
    form input[type="submit"]:hover {
        background-color: var(--color-hover) !important;
    }
</style>