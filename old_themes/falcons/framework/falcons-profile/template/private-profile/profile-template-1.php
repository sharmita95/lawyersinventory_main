<?php

wp_enqueue_style('wp-iv_directories-myaccount-style-11', wp_iv_directories_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_directories-myaccount-style-12', wp_iv_directories_URLPATH . 'admin/files/js/bootstrap.min.js');

//wp_enqueue_style('myaccount-style-12', falcons_CSS . 'my-account.css');

wp_enqueue_media();
global $current_user;


$user = new WP_User( $current_user->ID );									
if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
	foreach ( $user->roles as $role ){
		$crole= ucfirst($role); 
		break;
	}	
}	
if(strtoupper($crole)!=strtoupper('administrator')){ 
	include(wp_iv_directories_template.'/private-profile/check_status.php');
}

?>


    <?php
      global $current_user;
       $current_user = wp_get_current_user();
	  //print_r($current_user);
	  $currencies = array();
	$currencies['AUD'] ='$';$currencies['CAD'] ='$';
	$currencies['EUR'] ='€';$currencies['GBP'] ='£';
	$currencies['JPY'] ='¥';$currencies['USD'] ='$';
	$currencies['NZD'] ='$';$currencies['CHF'] ='Fr';
	$currencies['HKD'] ='$';$currencies['SGD'] ='$';
	$currencies['SEK'] ='kr';$currencies['DKK'] ='kr';
	$currencies['PLN'] ='zł';$currencies['NOK'] ='kr';
	$currencies['HUF'] ='Ft';$currencies['CZK'] ='Kč';
	$currencies['ILS'] ='₪';$currencies['MXN'] ='$';
	$currencies['BRL'] ='R$';$currencies['PHP'] ='₱';
	$currencies['MYR'] ='RM';$currencies['AUD'] ='$';
	$currencies['TWD'] ='NT$';$currencies['THB'] ='฿';
	$currencies['TRY'] ='TRY';	$currencies['CNY'] ='¥';
	$currency= get_option('_iv_directories_api_currency');

	$currency_symbol=(isset($currencies[$currency]) ? $currencies[$currency] :$currency );
$directory_url_1=get_option('_iv_directory_url_1');
if($directory_url_1==""){$directory_url_1='law-firms';}

$directory_url_2=get_option('_iv_directory_url_2');
if($directory_url_2==""){$directory_url_2='lawyers';}


$falcons_option_data =get_option('falcons_option_data');

$directory_url_1_string=str_replace("-"," ",$directory_url_1); 
$directory_url_1_string =  esc_attr (ucwords($directory_url_1_string)); 						
 						 
$directory_url_1_string = (isset($falcons_option_data['falcons-home-hearder-block1'])? $falcons_option_data['falcons-home-hearder-block1']: $directory_url_1_string);

$directory_url_2_string=str_replace("-"," ",$directory_url_2); 
$directory_url_2_string =  esc_attr (ucwords($directory_url_2_string)); 	
$directory_url_2_string= (isset($falcons_option_data['falcons-home-hearder-block2'])?$falcons_option_data['falcons-home-hearder-block2']:$directory_url_2_string)


      ?>
<style>
  /***
  New Profile Page
  ***/
  .media-modal-close, .media-modal-close span.media-modal-icon {
  width: auto !important;
  }
  .bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
  }
  .bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
  }
  .html-active .switch-html, .tmce-active .switch-tmce {
  height: 28px!important;
  }
  .wp-switch-editor {
    height: 28px!important;
  }
  body{
    font-family: 'Open Sans', sans-serif;
  }
 #profile-account2 label {
  font-weight: 400;
  font-size: 14px;
  background-color: #fff;
  display: block;
  }

  #profile-account2  .form-control {
  font-size: 14px;
  font-weight: normal;
  color: #333333;
  background-color: #fff;
  border: 1px solid #e5e5e5;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius:0 !important;
  -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  }
  #profile-account2 .fa-times{
    margin: 0 8px 0 12px;
  }
  #profile-account2 .fa-pencil{
    margin: 0 8px 0 12px;
  }

  #profile-account2 .btn .default {
  color: #333333;
  background: #e5e5e5;
  background-image: none;
  border-color: "";
  }

  #profile-account2 .default {
    color: #333333;
    background: #e5e5e5;
    border-color: "";
    }

  #profile-account2 .green-haze{
  color: white;
  background: #44b6ae !important;
  background-image: none;
  box-shadow: none;
  outline: none;
  filter:none;
  }
  #profile-account2  .form-control:focus{
  border-color: #999999;
  outline: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
  }
  #profile-account2  .profile-usertitle-name {
  color: #5a7391;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 7px;
  }
  #profile-account2 .nav  li a {
    padding: 5px 10px;
    font-size: 15px;
    border: 0;
  }
  #profile-account2  .profile-sidebar {
    float: left;
    width: 100%;
    margin-right: 0;
    padding: 0 0 10px 15p
    x;
  }
  #profile-account2 .active{
    background-color: #fff;
  }
   #profile-account2 .profile-usermenu .active{
   border-left: 5px solid #c29c6a;
  }
  #profile-account2  .icon-round{
    border: 1px solid #93a3b5;
    border-radius: 50%;
    padding: 4px;
    font-size: 8px !important;
  }
  #profile-account2  .nav{
    margin-left: 0;
  }
   #profile-account2  .nav li{
    margin-left: 0;
  }
  #profile-account2  .nav li:hover .icon-round{
    border: 1px solid #c29c6a;
  }

   #profile-account2  .portlet-title  .nav li:hover{
    border-bottom: 5px solid #c29c6a;
  }
   #profile-account2  .portlet-title  .nav li.active{
    border-bottom: 5px solid #c29c6a;
  }
   #profile-account2  .portlet-title  .nav li a:focus{
    box-shadow: 0 0 0 0px #5b9dd9,0 0 0px 0px rgba(30,140,190,.0);
    -web-kit-box-shadow:  0 0 0 0px #5b9dd9,0 0 0px 0px rgba(30,140,190,.0);
  }
  #profile-account2  .nav-tabs > li.active > a{
    border: 1px solid #fff;

  }
  #profile-account2  .profile-content {
    overflow: hidden;
    background: #fff;
    padding: 15px;
    border: 0;
  }
#profile-account2 a{
  border:none !important;
  text-decoration: none;
}
  /* PROFILE SIDEBAR */
  #profile-account2  .profile-sidebar-portlet {
    padding: 30px 5px 0  !important;
  }

  #profile-account2  .profile-userpic {
    padding: 20px 20px 0px;
  }

  #profile-account2  .profile-userpic img {
    float: none;
    margin: 0 auto;
    padding: 5px;
    border: 1px solid #f4f4f4;
    width: 100%;
    height: auto;

  }

  #profile-account2  .profile-usertitle {
    text-align: center;
    margin-top: 10px;
  }

  #profile-account2  .profile-usertitle-name {
    color: #333;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 7px;
  }

  #profile-account2  .profile-usertitle-job {
    text-transform: uppercase;
    color: #c29c6a;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 7px;
  }

  #profile-account2  .profile-userbuttons {
    text-align: center;
    margin-top: 10px;
    position: relative;
    /*padding-bottom: 30px;*/
    /*border-bottom: 1px solid #f3f3f3;*/
  }

  #profile-account2  .profile-userbuttons .btn {
    margin-right: 5px;
  }
  #profile-account2  .profile-userbuttons .btn:last-child {
    margin-right: 0;
  }
  #profile-account2  .caption {
  float: left;
  display: inline-block;
  font-size: 18px;
  line-height: 18px;
  font-weight: 100%;
  padding: 10px 0;
  }
  #profile-account2  .profile-userbuttons button {
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 600;
    padding: 6px 15px;
  }

  #profile-account2  .profile-usermenu {
    margin-top: 30px;
    padding-bottom: 20px;
  }

  #profile-account2  .profile-usermenu ul li {
    border-bottom: 1px solid #f0f4f7;
  }

  #profile-account2  .profile-usermenu ul li:first-child {
    border-top: 1px solid #f0f4f7;
  }

  #profile-account2  .profile-usermenu ul li a {
    color: #93a3b5;
    font-size: 14px;
    font-weight: 400;
    padding: 14px;
    padding: 10px;

  }

  #profile-account2  .profile-usermenu ul li a {
    font-size: 14px;
  }

  #profile-account2  .profile-usermenu ul li a:hover {
    background-color: #fafcfd;
    color: #c29c6a;
  }

  .profile-usermenu ul li.active a {
    color: #c29c6a !important;
    background-color: #f6f9fb;
    border-left: 2px solid #c29c6a;
    margin-left: -2px;
  }

  #profile-account2  .profile-stat {
    padding-bottom: 20px;
    border-bottom: 1px solid #f0f4f7;
  }

  .about-profile-owner {
    padding: 30px;
    display: inline-block;
    width: 100%;
  }
  .about-profile-owner .profile-desc-title {
    color: #333;
    padding-bottom: 15px;
    border-bottom: 1px solid #ddd;
  }
  #profile-account2  .profile-stat-title {
    color: #7f90a4;
    font-size: 25px;
    text-align: center;
  }
  #profile-account2 .tabbable-line{
    border-bottom: 1px solid #ececec;
    margin-bottom: 30px;
  }
  #profile-account2 .profile-stat-text {
    color: #c29c6a;
    font-size: 11px;
    font-weight: 800;
    text-align: center;
  }
  #profile-account2 .btn-circle{
    border-top-right-radius:30px ;
    border-top-left-radius:30px ;
    outline: 0;
    border-bottom-right-radius:30px ;
    border-bottom-left-radius:30px ;
  }
  #profile-account2 .profile-desc-title {
    color: #333;
    font-size: 17px;
    font-weight: 600;
  }
  #profile-account2 .profile-desc-text {
    color: #7e8c9e;
    font-size: 14px;
    display: block;
  }
  #profile-account2 .caption-subject{
    font-weight: 600;
    font-size: 15px !important;
    font-family: 'open-sans',sans-serif;
    text-transform: uppercase;
    color: #578ebe !important;
  }
  #profile-account2 .profile-desc-link i {
    width: 22px;
    font-size: 25px;
    color: #abb6c4;
    margin-right: 5px;
  }
  #profile-account2 .portlet{
    background: #fff;
    padding: 20px;
    margin-bottom: 15px;
  }
  #profile-account2 .portlet0{
    border: 0;
  }

   #profile-account2 .profile-desc-link {
    float: left;
   }
  #profile-account2 .profile-desc-link a {
    font-size: 13px;
    font-weight: 600;
    color: #c29c6a;
  }

   #profile-account2 .profile-desc-link a  i {
    font-size: 32px;
    margin-right: 18px;
   }

   #profile-account2 .profile-desc-link a  span {
    display: none;
   }



  #profile-account2 .profile-sidebar-portlet {
    padding: 0 !important;
    box-shadow: 0px 1px 3px 1px rgba(0,0,0, .1);
  }


  #profile-account2 .margin-top-20{
    margin-top: 20px
  }
  #profile-account2  h2 {
    font-weight: 700;
    font-family: 'open-sans',sans-serif;
    font-size: 16px;
    padding-bottom: 15px;
    display: block;
    color:#578ebe !important;
    border-bottom: 1px solid #ececec;
    }
    #profile-account2 .nav-tabs {
    border-bottom: 1px solid #ddd;
    }
   #profile-account2 .nav-tabs {
    background: none;
    margin: 0;
    float: right;
    display: inline-block;
    border: 0;
    }

    #profile-account2 .around-separetor{
    background-color: #eff3f8 !important;
    }

     #profile-account2 ul.iv-pagination {
     display: inline-block;
     padding-left: 0;
     margin: 20px 0;
     border-radius: 4px;
     list-style: none;
     }
    #profile-account2 .list-pagi{
      border: 1px solid transparent;
      float: left;
      margin-left: .5em;
      padding: 0;
      list-style: none;
      border-radius: 3px;
    }
    #profile-account2 .list-pagi a{
      color: #666;
      padding: 1px 10px;
    }
    #profile-account2 .list-pagi:hover{
      border: 1px solid #ddd;
      border-radius: 3px;
      color: #333;
    }
    #profile-account2 .list-pagi:hover a{
      color: #333;
      text-decoration: none;
    }
    #profile-account2 .active-li{
      border: 1px solid #ddd;
      background: transparent;
    }
    #profile-account2 .active-li a{
      color: #333;
    }
  /* RESPONSIVE MODE */
  @media (max-width: 767px) {

  #profile-account2 .profile-sidebar {
      float: none;
      width: 100%;
      margin-right: 20px;
      padding: 0 0 15px 15px;
      text-align: center
      }

  #profile-account2  .profile-sidebar > .portlet {
      margin-bottom: 10px;
    }

  #profile-account2  .profile-content {
      overflow: visible;
    }
  }


</style>

    <?php $post_author_id = $current_user->ID;
    $user_meta = get_userdata($post_author_id);
    $user_roles = $user_meta->roles;
    
    //All package
    $package_names = iPayment_package();
    
    $payment_status= get_user_meta($post_author_id, 'iv_directories_payment_status', true);
    
    if((in_array($user_roles[0],$package_names) && $user_roles[0] == 'Basic') || $payment_status != 'success') { ?>
    
    <div class="alert alert-warning" role="alert">
        <strong>Please Upgrade your Account</strong> & <strong>complete the payment process </strong> to show contact information and others details to the visitors.
    </div>
    
    <?php } ?>

    <div id="profile-account2" class="bootstrap-wrapper around-separetor">
      <div class="row margin-top-10">
        <div class="col-md-3 col-sm-3 col-xs-12">
          <!-- BEGIN PROFILE SIDEBAR -->

          <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet portlet0 light profile-sidebar-portlet">
              <!-- SIDEBAR USERPIC -->
              <div class="profile-userpic text-center" id="profile_image_main">
				  <?php
				  	$iv_profile_pic_url=get_user_meta($current_user->ID, 'iv_profile_pic_thum',true);
				  	if($iv_profile_pic_url!=''){ ?>
					 <img src="<?php echo $iv_profile_pic_url; ?>">
					<?php
					}else{
					 echo'	 <img src="'. wp_iv_directories_URLPATH.'assets/images/Blank-Profile.jpg">';
					}
				  	?>

              </div>
              <!-- END SIDEBAR USERPIC -->
              <!-- SIDEBAR USER TITLE -->
              <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                   <?php
				   $name_display=get_user_meta($current_user->ID,'first_name',true).' '.get_user_meta($current_user->ID,'last_name',true);
				   echo (trim($name_display)!=""? $name_display : $current_user->display_name );?>
                </div>
                <div class="profile-usertitle-job">
                   <?php echo get_user_meta($current_user->ID,'occupation',true); ?>
                </div>

              </div>
              <!-- END SIDEBAR USER TITLE -->
              <!-- SIDEBAR BUTTONS -->
              <div class="profile-userbuttons">
                <button type="button" onclick="edit_profile_image('profile_image_main');"  class="btn-new btn-custom"><?php esc_html_e('Change Image','falcons'); ?> </button>
              </div>
              <!-- END SIDEBAR BUTTONS -->
              <!-- SIDEBAR MENU -->
              <div class="profile-usermenu">
			  <?php
			  $active='all-post';

			  if(isset($_GET['profile']) AND $_GET['profile']=='setting' ){
				 $active='setting';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='level' ){
				 $active='level';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='all-post' ){
				 $active='all-post';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='new-lawfirm' ){
				 $active='new-lawfirm';
			  }
			 
			   if(isset($_GET['profile']) AND $_GET['profile']=='new-lawyer' ){
				 $active='new-lawyer';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='bidding' ){
				 $active='bidding';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='favorites' ){
				 $active='favorites';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='who-is-interested' ){
				 $active='who-is-interested';
			  }
			  if(isset($_GET['profile']) AND $_GET['profile']=='balance' ){
				 $active='balance';
			  }
			   if(isset($_GET['profile']) AND $_GET['profile']=='post-edit' ){
				$active='all-post';
			  }





				$post_type=  'directories';

			  ?>
                <ul class="nav">
					 <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menuallpost' ) ) {
						 $account_menu_check= get_option('_iv_directories_menuallpost');
					}
					if($account_menu_check!='yes'){
					?>
				  <li class="<?php echo ($active=='all-post'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=all-post">
                    <i class="fa-list-alt"></i>
                    <?php esc_html_e('All Listings','falcons');?>  </a>
                  </li>
				  <?php
					}
				  ?>
				   <?php
					$account_menu_check= '';
					if( get_option( '_iv_menunew_cpt1_listing' ) ) {
						 $account_menu_check= get_option('_iv_menunew_cpt1_listing');
					}
					if($account_menu_check!='yes'){
					?>
				    <li class="<?php echo ($active=='new-lawfirm'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=new-lawfirm">
                    <i class="fa fa-cpt1-o"></i>
                    <?php  esc_html_e('Add New '.ucfirst($directory_url_1_string),'falcons');?> </a>
                  </li>
				  <?php
					}
				  ?>
				  <?php
					$account_menu_check= '';
					if( get_option( '_iv_menunew_cpt2_listing' ) ) {
						 $account_menu_check= get_option('_iv_menunew_cpt2_listing');
					}
					if($account_menu_check!='yes'){
					?>
				    <li class="<?php echo ($active=='new-lawyer'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=new-lawyer">
                    <i class="fa fa-user-md"></i>
                    <?php  esc_html_e('Add New '.ucfirst($directory_url_2_string),'falcons');?> </a>
                  </li>
				  <?php
					}
				  ?>
				  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menufavorites' ) ) {
						 $account_menu_check= get_option('_iv_directories_menufavorites');
					}
					if($account_menu_check!='yes'){
					?>
					  <li class="<?php echo ($active=='favorites'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=favorites">
                    <i class="fa fa-heart-o"></i>
                    <?php  esc_html_e('My Favorites','falcons');?> </a>
                  </li>
				  <?php
					}
				  ?>
				  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menuinterested' ) ) {
						 $account_menu_check= get_option('_iv_directories_menuinterested');
					}
					if($account_menu_check!='yes'){
					?>
				    <li class="<?php echo ($active=='who-is-interested'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=who-is-interested">
                    <i class="fa fa-group"></i>
                    <?php  esc_html_e('Who is Interested','falcons');?> </a>
                  </li>
				  <?php
					}
				  ?>

					<?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menu_listinghome' ) ) {
						 $account_menu_check= get_option('_iv_directories_menu_listinghome');
					}
					if($account_menu_check!='yes'){
					?>


					<li class="">
                    <a href="<?php echo get_post_type_archive_link( $directory_url_1 ) ; ?>">
                    <i class="fa fa-home"></i>
                    <?php esc_html_e(ucfirst($directory_url_1_string).' Home','falcons');	 ?> </a>
					</li>
					<?php
						}
					?>
                  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_mylevel' ) ) {
						 $account_menu_check= get_option('_iv_directories_mylevel');
					}
					if($account_menu_check!='yes'){
					?>
					  <li class="<?php echo ($active=='level'? 'active':''); ?> ">
						<a href="<?php echo get_permalink(); ?>?&profile=level">
						<i class="fa fa-plus-circle"></i>
						<?php esc_html_e('Upgrade My Account','falcons');	 ?> </a>
					  </li>
					 <?php
					}
					?>

				  <?php
					$account_menu_check= '';
					if( get_option( '_iv_directories_menusetting' ) ) {
						 $account_menu_check= get_option('_iv_directories_menusetting');
					}
					if($account_menu_check!='yes'){
					?>
                  <li class="<?php echo ($active=='setting'? 'active':''); ?> ">
                    <a href="<?php echo get_permalink(); ?>?&profile=setting">
                    <i class="fa fa-cog"></i>
                    <?php esc_html_e('Account Settings','falcons');?> </a>
                  </li>
				  <?php
					}
				  ?>





			  <?php     $old_custom_menu = array();
							if(get_option('iv_directories_profile_menu')){
								$old_custom_menu=get_option('iv_directories_profile_menu' );
							}
							$ii=1;
							if($old_custom_menu!=''){
								foreach ( $old_custom_menu as $field_key => $field_value ) { ?>

									  <li class="">
											<a href="<?php echo $field_value; ?>">
												<i class="fa fa-cog"></i>
											 <?php echo $field_key;?> </a>
									  </li>

								<?php
								}
							}


					?>
					<li class="<?php echo ($active=='log-out'? 'active':''); ?> ">
						<a href="<?php echo wp_logout_url( home_url() ); ?>" >
						<i class="fa fa-sign-out"></i>
						  <?php esc_html_e('Sign out','falcons');?>
						 </a>
					 </li>


                </ul>
              </div>
              <!-- END MENU -->
              
                <?php $user_web_site = get_user_meta($current_user->ID,'web_site',true);
                $user_twitter = get_user_meta($current_user->ID,'twitter',true);
                $user_facebook = get_user_meta($current_user->ID,'facebook',true); ?>
                
                <div class="about-profile-owner">
                  <h4 class="profile-desc-title"><?php esc_html_e('About','falcons');?>    <?php
                 $name_display=get_user_meta($current_user->ID,'first_name',true).' '.get_user_meta($current_user->ID,'last_name',true);
                 echo (trim($name_display)!=""? $name_display : $current_user->display_name );?></h4>
                  <span class="profile-desc-text"> <?php echo get_user_meta($current_user->ID,'description',true); ?>

                  </span>
                  <?php if(!empty($user_web_site)) { ?>
                      <div class="margin-top-20 profile-desc-link">
                        <a href="http://<?php echo $user_web_site;?>"><span><?php echo $user_web_site; ?></span><i class="fa fa-globe"></i></a>
                      </div>
                  <?php } if(!empty($user_twitter)) { ?>
                      <div class="margin-top-20 profile-desc-link">
                        <a href="http://www.twitter.com/<?php echo $user_twitter; ?>/"><span><?php echo $user_twitter; ?></span><i class="fa fa-twitter-square"></i></a>
                      </div>
                  <?php } if(!empty($user_facebook)) { ?>
                      <div class="margin-top-20 profile-desc-link">
                        <a href="http://www.facebook.com/<?php echo $user_facebook; ?>/"><span><?php echo $user_facebook; ?></span><i class="fa fa-facebook-square"></i></a>
                      </div>
                  <?php } ?>
                </div>
            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->

              <!-- STAT -->

              <!-- END STAT -->


          </div>
          </div>
          <!-- END BEGIN PROFILE SIDEBAR -->
          <!-- BEGIN PROFILE CONTENT -->
		  <?php ?>

          <div class="col-md-9 col-sm-9 col-xs-12">
		  <?php
		  if(isset($_GET['profile']) AND $_GET['profile']=='all-post' ){
			include(  wp_iv_directories_template. 'private-profile/profile-all-post-1.php');
		  } elseif(isset($_GET['profile']) AND $_GET['profile']=='bidding' ){
			include( wp_iv_directories_template. 'private-profile/bidding-1.php');
		  } elseif(isset($_GET['profile']) AND $_GET['profile']=='new-lawyer' ){
			include( wp_iv_directories_template. 'private-profile/profile-new-lawyers.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='new-lawfirm' ){
			include( wp_iv_directories_template. 'private-profile/profile-new-law-firms.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='level' ){
			include(  wp_iv_directories_template. 'private-profile/profile-level-1.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='lawfirm-edit' ){
			include(  wp_iv_directories_template. 'private-profile/profile-edit-law-firms.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='lawyer-edit' ){
			include(  wp_iv_directories_template. 'private-profile/profile-edit-lawyers.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='favorites' ){
			include(  wp_iv_directories_template. 'private-profile/my-favorites-1.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='who-is-interested' ){
			include(  wp_iv_directories_template. 'private-profile/interested-1.php');
		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='balance' ){
			include(  wp_iv_directories_template. 'private-profile/balance.php');

		  }elseif(isset($_GET['profile']) AND $_GET['profile']=='setting' ){
			include(  wp_iv_directories_template. 'private-profile/profile-setting-1.php');
		  }
		  else{


			include(  wp_iv_directories_template. 'private-profile/profile-all-post-1.php');
		  }


		  ?>


        </div>
      </div>
    </div>




 <script>

			  function edit_profile_image(profile_image_id){
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php esc_html_e( 'Profile Image', 'easy-image-gallery' ); ?>',
                    button: {
                        text: '<?php esc_html_e( 'Profile Image', 'easy-image-gallery' ); ?>',
                    },
                    multiple: false,
                    displayUserSettings: true,
                });
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							//console.log(attachment.sizes.thumbnail.url);
							var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
							var search_params = {
								"action": 	"iv_directories_update_profile_pic",
								"attachment_thum": attachment.sizes.thumbnail.url,
								"profile_pic_url_1": attachment.url,
							};
                             jQuery.ajax({
										url: ajaxurl,
										dataType: "json",
										type: "post",
										data: search_params,
										success: function(response) {
											if(response=='success'){

												jQuery('#'+profile_image_id).html('<img  class="img-circle img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');


											}

										}
									});

						}
					});

                });
				image_gallery_frame.open();

			}

	function update_profile_setting (){

	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_profile_setting",
					"form_data":	jQuery("#profile_setting_form").serialize(),
				};
				jQuery.ajax({
					url : ajaxurl,
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');

					}
				});

	}


		  </script>

