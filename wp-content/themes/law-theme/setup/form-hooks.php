<?php

//Registration
add_shortcode('LYI_registration_form_old', 'LYI_registration_func_old');
function LYI_registration_func_old() {
    $output = '';
    ob_start();

    $countryList = get_terms(array(
        'taxonomy' => 'lawyers-location',
        'parent' => 0,
        'hide_empty' => false
    ));
    ?>
    <div class="contactpage-form register-right-sec">
        <form name="lyi_registration_form" method="post" id="lyi_registration_form" action="">
            <input type="hidden" name="action" value="lyi_registration_process" />

            <input type="radio" id="lyr" name="user_type" value="lawyers" checked="checked"><label for="lyr">Lawyers</label>            
            <input type="radio" id="lfm" name="user_type" value="law-firms"><label for="lfm">Law Firms</label>            
            
            <input type="text" name="name" value="" placeholder="Point of contact Person" />
            <input type="email" name="email" value="" placeholder="Email"   />
            <input type="text" name="phone" placeholder="Phone"/>
            
            <select name="country" id="country">
                <option value="">Choose Country</option>
                <?php foreach($countryList as $country) { ?>
                    <option value="<?php echo $country->term_id; ?>" slug="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                <?php } ?>
            </select>

            <select name="state" id="state">
                <option value="">Choose State</option>
            </select>

            <select name="city" id="city">
                <option value="">Choose City</option>
            </select>
            
            <textarea name="address" placeholder="Full Address" ></textarea>
            <input type="text" name="gmb_link" placeholder="GMB Link" value="" />
            <textarea name="business_description" placeholder="Business Description" ></textarea>
            <button type="submit" name="registration_btn" class="sub-btn">Submit</button>
        </form>
        <div class="success-msg"></div>
        <div class="error-msg"></div>
        <div class="clear"></div>
    </div>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}



add_shortcode('LYI_registration_form', 'LYI_registration_func');
function LYI_registration_func() {
    $output = '';
    ob_start();

    /*$countryList = get_terms(array(
        'taxonomy' => 'lawyers-location',
        'parent' => 0,
        'hide_empty' => false
    )); */
    ?>

    <div class="register-right-sec">
        <form class="register-from" name="lyi_registration_form" method="post" id="lyi_registration_form" action="">
                
            <input type="hidden" name="action" value="lyi_registration_process" />
            <input type="hidden" name="type" value="" id="type"/>
            <input type="hidden" name="tax_name" value="" id="tax-type"/>

            <h2 class="register-form-title">Registration</h2>

            <div class="register-radio-btn-sec">
                <label class="register-radio-label" for="">
                    <input type="radio" id="lawyer" name="user_type" value="lawyers" class="radio" checked="checked" />
                    <span>
                        Lawyers
                    </span>
                </label>

                <label class="register-radio-label" for="">
                    <input type="radio" id="firm" name="user_type" value="law-firms" class="radio" />
                    <span>
                        Lawyers Firm
                    </span>
                </label>
            </div>

            <div class="">
                <div class="common-header-wrapper">
                    <div class="common-imput-wrapper ">
                        <input type="text" name="name" id="domain-name" autocomplete="domain-name" class="border-b" placeholder="Domain Name">
                    </div>

                    <div class="common-imput-wrapper">
                        <input type="text" name="point_of_contact" value="" autocomplete="point-of-contact" class="border-b" placeholder="Point of Contact Person">
                    </div>

                </div>

                <div class="common-header-wrapper">
                    <div class="common-imput-wrapper">
                        <div class="mt-2">
                            <input id="email" name="email" value="" type="email" autocomplete="email" class="border-b" placeholder="Email address">
                        </div>
                    </div>

                    <div class="common-imput-wrapper">
                        <div class="mt-2">
                            <input id="phone" name="phone" type="text" autocomplete="phone" class="border-b" placeholder="Phone">
                        </div>
                    </div>
                </div>

                <label for="address" class="common-imput-full-wrapper">
                    <input class="register-input-full" type="text" name="address" id="address" autocomplete="address" class="border-b-2" placeholder="Address">
                </label>

                <div class="select-common-header-wrapper">
                    <div class="register-commo-select-wrapper">
                        <select name="country" id="country" class="register-commo-select">
                            <option disabled selected>Country</option>
                            <?php /*foreach($countryList as $country) { ?>
                                <option value="<?php echo $country->term_id; ?>" slug="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                            <?php }*/ ?>
                        </select>
                    </div>

                    <div class="register-commo-select-wrapper">
                        <select name="state" id="state" class="register-commo-select">
                            <option disabled selected>State</option>
                        </select>
                    </div>
                    <div class=" register-commo-select-wrapper">
                        <select name="city" id="city" class="register-commo-select">
                            <option disabled selected>City</option>
                        </select>
                    </div>
                </div>


                <label for="gmb-link" class="common-imput-full-wrapper">
                    <input class="register-input-full" type="text" name="gmb_link" id="gmb_link" class="border-b-2" placeholder="GMB Link">
                </label>


                <label for="business-description" class="common-imput-full-wrapper">
                    <input class="register-input-full" type="text" name="business_description" class="border-b-2" placeholder="Business Description">
                </label>
            </div>

            <button type="submit" class="register-submit-button">Submit <img class="submit-image-arrow" src="<?php echo get_template_directory_uri(); ?>/images/arrow.png" alt="arrow" /></button>
            <!-- <button type="submit" name="registration_btn" class="sub-btn">Submit</button> -->
            
        </form>

        <div class="success-msg output-msg"></div>
        <div class="error-msg output-msg"></div>
        <div class="clear"></div>

    </div>

    
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_action('wp_ajax_lyi_registration_process', 'ajax_lyi_registration_process_func');
add_action('wp_ajax_nopriv_lyi_registration_process', 'ajax_lyi_registration_process_func');
function ajax_lyi_registration_process_func() {
    $response_arr = ['flag' => FALSE, 'msg' => NULL];
    
    $user_type = $_POST['user_type'];
    $name = $_POST['name'];    
    $point_of_contact = $_POST['point_of_contact'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $gmb_link = $_POST['gmb_link'];
    $business_description = $_POST['business_description'];

    
    if(empty($name)) {
        $response_arr['msg'] = 'Enter your name.';
    } elseif(empty($point_of_contact)) {
        $response_arr['msg'] = 'Enter Contact Person Name.';
    } elseif(empty($phone)) {
        $response_arr['msg'] = 'Enter your phone.';
    } elseif(empty($email)) {
        $response_arr['msg'] = 'Enter email address.';
    } elseif(empty($country)) {
        $response_arr['msg'] = 'Choose country.';
    } elseif(empty($state)) {
        $response_arr['msg'] = 'Choose state.';
    } elseif(empty($city)) {
        $response_arr['msg'] = 'Choose city.';
    } elseif(empty($gmb_link)) {
        $response_arr['msg'] = 'Enter your Google My Business link.';
    } elseif(empty($address)) {
        $response_arr['msg'] = 'Enter your Address.';
    } elseif(!empty(email_exists($email))) {
        $response_arr['msg'] = 'You are already registed. Try to login.';
    }
    else {

        $login_name = str_replace(['.', '-', '_'], '', substr($email, 0, strrpos($email, '@')));

        $userdata = array(
            'user_login' =>  $login_name,
            'user_email' =>  $email,
            'first_name' => $name,
            'user_pass'  =>  wp_generate_password( 12, true, true ),
            'role' => 'basic' //For now
        );
        $user_id = wp_insert_user( $userdata ) ;

        if ( ! is_wp_error( $user_id ) ) {

            $new_post = array(
                'post_title' => $name,
                'post_content' => $business_description,
                'post_status' => 'pending',
                'post_date' => date('Y-m-d H:i:s'),
                'post_author' => $user_id,
                'post_type' => $user_type
            );
            $post_id = wp_insert_post($new_post);

            add_post_meta( $post_id, 'point_of_contact', $point_of_contact, true );
            add_post_meta( $post_id, 'address', $address, true );
            add_post_meta( $post_id, 'phone', $phone, true );
            add_post_meta( $post_id, 'gmb_link', $gmb_link, true );
            
            wp_set_post_terms( $post_id, $city, 'lawyers-location' );


            $response_arr['msg'] = 'Successfully registered.';
            $response_arr['flag'] = true;
            
        } else {

            $response_arr['msg'] = 'Error. Try after sometime!!';
        }
        
        
    }
    
    
    echo json_encode($response_arr);
    exit;
}


//Get states depending on the Country(Registration)
add_action('wp_ajax_registration_get_state', 'ajax_registration_get_state_func');
add_action('wp_ajax_nopriv_registration_get_state', 'ajax_registration_get_state_func');
function ajax_registration_get_state_func() {
    $response_arr = ['flag' => FALSE, 'data' => NULL];
    $country_id = $_POST['country'];
    $tax_type = $_POST['type'];
    $gen_state_html = '<option value="" label="">Choose State</option>';

    if(!empty($country_id)) {

        $stateList = get_terms( $tax_type, 
        array(
            'parent' => $country_id,
            'hide_empty' => false,                        
        ));
                   
        foreach($stateList as $state) {
            $gen_state_html .= '<option value="'.$state->term_id.'" slug="'.$state->slug.'">'.$state->name.'</option>';
        }
        
        $response_arr['flag'] = true;
        $response_arr['data'] = $gen_state_html;
    }    
    
    echo json_encode($response_arr);
    exit;
}

//Get city depending on the state(Registration)
add_action('wp_ajax_registration_get_city', 'ajax_registration_get_city_func');
add_action('wp_ajax_nopriv_registration_get_city', 'ajax_registration_get_city_func');
function ajax_registration_get_city_func() {
    $response_arr = ['flag' => FALSE, 'data' => NULL];
    $state_id = $_POST['state'];
    $tax_type = $_POST['type'];
    $gen_city_html = '<option value="" label="">Choose City</option>';

    if(!empty($state_id)) {

        $cityList = get_terms( $tax_type, 
        array(
            'parent' => $state_id,
            'hide_empty' => false,                        
        ));
                   
        foreach($cityList as $city) {
            $gen_city_html .= '<option value="'.$city->term_id.'" slug="'.$city->slug.'">'.$city->name.'</option>';
        }        
        
        $response_arr['flag'] = true;
        $response_arr['data'] = $gen_city_html;
    }    
    
    echo json_encode($response_arr);
    exit;
}


//Get Country depending on type (for registration only)
add_action('wp_ajax_registration_get_country', 'ajax_registration_get_country_func');
add_action('wp_ajax_nopriv_registration_get_country', 'ajax_registration_get_country_func');
function ajax_registration_get_country_func() {
    $response_arr = ['flag' => FALSE, 'data' => NULL];
    $tax_type = $_POST['tax'];
    $gen_country_html = '<option value="" label="">Choose Country</option>';

    $countryList = get_terms( $tax_type, 
    array(
        'parent' => 0,
        'hide_empty' => false,                        
    ));
                
    foreach($countryList as $country) {
        $gen_country_html .= '<option value="'.$country->term_id.'" slug="'.$country->slug.'">'.$country->name.'</option>';
    }
    
    $response_arr['flag'] = true;
    $response_arr['data'] = $gen_country_html;
    
    
    echo json_encode($response_arr);
    exit;
}



///////////////////////////////////// Practice Area Form //////////////////////////////////////////////


add_shortcode('LYI_practice_area_form', 'LYI_practice_area_func');
function LYI_practice_area_func() {
    $output = '';
    ob_start();

    $taxonomies = get_terms( array(
        'taxonomy' => 'lawyers-category',
        'hide_empty' => false
    ) );

    ?>
    <div class="practice-form">
        <form>
            <select name="type">
                <option value="lawyers">Lawyers</option>
                <option value="law-firms">Law Firms</option>
            </select>

            <?php 
            if ( !empty($taxonomies) ) :
                $output = '<select name="practice-area">';
                foreach( $taxonomies as $category ) {
                    if( $category->parent == 0 ) {
                        $output.= '<option class="parent-practice" value="'. esc_attr( $category->term_id ) .'" label="'. esc_attr( $category->name ) .'">';
                        foreach( $taxonomies as $subcategory ) {
                            if($subcategory->parent == $category->term_id) {
                            $output.= '<option class="child-practice" value="'. esc_attr( $subcategory->term_id ) .'">
                                &nbsp&nbsp&nbsp&nbsp'. esc_html( $subcategory->name ) .'</option>';
                            }
                        }
                        $output.='</option>';
                    }
                }
                $output.='</select>';
                echo $output;
            endif; ?>

            <a href="">Submit</a>

        </form>
    </div>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


add_action('wp_ajax_lyi_practice_process', 'ajax_lyi_practice_func');
add_action('wp_ajax_nopriv_lyi_practice_process', 'ajax_lyi_practice_func');
function ajax_lyi_practice_func() {
    // $response_arr = ['flag' => FALSE, 'type' => NULL, 'msg' => NULL];
    
    $type = $_POST['type'];
    $choosed_issue = $_POST['issue'];

    $gen_full_html = '';    

    $args = array(
        'post_type'         => $type,
        'post_status'       => 'publish',
        'orderby'           => 'date',
        //'paged'             => $paged,
        'order'             => 'DESC',
        'posts_per_page'    => 4,
    );
    if(!empty($choosed_issue)) {
        $args['tax_query'] = array(
            [
            'taxonomy' => 'lawyers-category',
            'field' => 'id',
            'terms' => $choosed_issue
            ]
        );
    }     

    if($type == 'lawyers') {

        echo '<div class="lawyers-card-grid-wrapper">
            <div class="lawyers-card-grid">';        

        display_custom_card_posts($args,'lawyers');    
        
        echo '</div>
        </div>';
        
    } else {
        echo '<div class="lawyers-firm-card-grid-wrapper">
            <div class="lawyers-firm-card-grid">';        

        display_custom_card_posts($args,'lawyersfirm',$before_html,$after_html);

        echo'</div>
        </div>';
        
    }
    die();
}



// Services and practice search
add_action('wp_ajax_service_search', 'service_search_func');
add_action('wp_ajax_nopriv_service_search', 'service_search_func');
if(!function_exists('service_search_func'))
{
    function service_search_func() {

        print_r($_POST);
       
        die();
    }
}


//////////////////// Search
add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');
if(!function_exists('ajax_search'))
{
    function ajax_search() {
        $search_query = $_POST['search_query'];
           
        $search_args = array(
            's' => $search_query,
            'post_type' => 'post',
            'posts_per_page' => get_option('posts_per_page'),
            'order'      =>'DESC',
        );
       
        display_custom_card_posts($search_args,'blog');
       
        die();
    }
}

if(!function_exists('display_custom_card_posts')) {
    function display_custom_card_posts($query_args, $card_type, $before_card = "", $after_card = "") {
        $custom_query = new WP_Query($query_args);

        if(!empty($before_card)) echo $before_card;
        if ($custom_query->have_posts()) :            
            while ($custom_query->have_posts()) : $custom_query->the_post();                
                get_template_part('/template-parts/'.$card_type, 'card');                
            endwhile;            
            wp_reset_postdata();            
        else :
            echo '<p>No posts found.</p>';
        endif;

        if(!empty($after_card)) echo $after_card;
    }
}