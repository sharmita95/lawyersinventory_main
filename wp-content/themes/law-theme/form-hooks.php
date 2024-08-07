<?php

//Registration
add_shortcode('LYI_registration_form', 'LYI_registration_func');
function LYI_registration_func() {
    $output = '';
    ob_start();

    $countryList = get_terms(array(
        'taxonomy' => 'lawyers-location',
        'parent' => 0,
        'hide_empty' => false
    ));
    ?>
    <div class="contactpage-form">
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


add_action('wp_ajax_lyi_registration_process', 'ajax_lyi_registration_process_func');
add_action('wp_ajax_nopriv_lyi_registration_process', 'ajax_lyi_registration_process_func');
function ajax_lyi_registration_process_func() {
    $response_arr = ['flag' => FALSE, 'msg' => NULL];
    
    $user_type = $_POST['user_type'];
    $name = $_POST['name'];    
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

            add_post_meta( $post_id, 'address', $address, true );
            add_post_meta( $post_id, 'phone', $phone, true );
            add_post_meta( $post_id, 'gmb_link', $gmb_link, true );
            
            wp_set_post_terms( $post_id, $city, 'lawyers-location' );


            $response_arr['msg'] = 'Successfully registered.';
            $response_arr['flag'] = true;
            
        } 

        $response_arr['msg'] = 'Error. Try after sometime!!';
        
        
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
    $gen_state_html = '<option value="" label="">Choose State</option>';

    if(!empty($country_id)) {

        $stateList = get_terms( 'lawyers-location', 
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
    $gen_city_html = '<option value="" label="">Choose City</option>';

    if(!empty($state_id)) {

        $cityList = get_terms( 'lawyers-location', 
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

