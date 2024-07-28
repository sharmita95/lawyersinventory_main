<?php
// Add an admin menu for CSV import
add_action('admin_menu', 'custom_csv_import_menu');

function custom_csv_import_menu() {
    if (current_user_can('manage_options') || current_user_can('seo_manage')) { //condition not working
        add_menu_page('CSV Import', 'CSV Import', 'manage_options', 'custom-csv-import', 'custom_csv_import_page');
    }
}

function custom_csv_import_page() {
    ?>
    <div class="wrap">
        <h1>Import CSV File</h1>
        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('custom_form_nonce_action', 'custom_form_nonce'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="custom_field">Choose Data Type</label>
                    </th>
                    <td>
                        <select name="type" id="csv_type" required>
                            <option value="lawyers" selected>Lawyers</option>
                            <option value="law-firms">Law Firms</option>
                        </select>
                    </td>
                </tr>                

                <tr>
                    <th scope="row">
                        <label for="custom_field">Choose City</label>
                    </th>
                    <td>
                        <!-- <input type="text" class="regular-text" name="city" required > -->
                        <select name="location" id="lawyersLocation">
                            <?php //For Lawyers
                            $lawyers_location_taxonomy = 'lawyers-location';
                            $lawyers_countryList = get_terms(array( //Get countries
                                'taxonomy' => $lawyers_location_taxonomy,
                                'parent' => 0,
                                'hide_empty' => false
                            ));
                            foreach($lawyers_countryList as $lyrs_country) {
                                echo '<optgroup label="'. $lyrs_country->name .'">'. $lyrs_country->name .'</optgroup>';

                                $lyrs_statesList = get_terms(  $lawyers_location_taxonomy, array(
                                    'parent' => $lyrs_country->term_id,
                                    'orderby' => 'slug',
                                    'hide_empty' => false
                                    )
                                );
                                foreach ( $lyrs_statesList as $lyrs_state ) {
                                    echo '<optgroup class="main"label="'. $lyrs_state->name .'">'. $lyrs_state->name .'</optgroup>';
                                    $lyrs_cityList = get_terms(  $lawyers_location_taxonomy, array(
                                            'parent' => $lyrs_state->term_id,
                                            'orderby' => 'slug',
                                            'hide_empty' => false
                                        )
                                    );
                                    foreach ( $lyrs_cityList as $lyrs_city ) {
                                        echo '<option class="sub" value="'. $lyrs_city->term_id . '">'. $lyrs_city->name .'</option>';
                                    }
                                }

                            }
                            ?>
                        </select>

                        <select name="location" id="lawfirmsLocation">
                            <?php //For firms
                            $firms_location_taxonomy = 'lawfirms-location';
                            $firms_countryList = get_terms(array( //Get countries
                                'taxonomy' => $firms_location_taxonomy,
                                'parent' => 0,
                                'hide_empty' => false
                            ));
                            foreach($firms_countryList as $firms_country) {
                                echo '<optgroup label="'. $firms_country->name .'">'. $firms_country->name .'</optgroup>';

                                $firms_statesList = get_terms(  $firms_location_taxonomy, array(
                                    'parent' => $firms_country->term_id,
                                    'orderby' => 'slug',
                                    'hide_empty' => false
                                    )
                                );
                                foreach ( $firms_statesList as $firms_state ) {
                                    echo '<optgroup class="main"label="'. $firms_state->name .'">'. $firms_state->name .'</optgroup>';
                                    $firms_cityList = get_terms(  $firms_location_taxonomy, array(
                                            'parent' => $firms_state->term_id,
                                            'orderby' => 'slug',
                                            'hide_empty' => false
                                        )
                                    );
                                    foreach ( $firms_cityList as $firms_city ) {
                                        echo '<option class="sub" value="'. $firms_city->term_id . '">'. $firms_city->name .'</option>';
                                    }
                                }

                            }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="custom_textarea">Upload</label>
                    </th>
                    <td>
                        <input type="file"  class="regular-text" name="csv_file" accept=".csv" required >
                    </td>
                </tr>
            </table>

            <input type="submit" name="import_csv" class="button button-primary" value="Import CSV">
        </form>
    </div>
    <?php

    if (isset($_POST['import_csv'])) {
        custom_csv_import_handler();
    }
}

function custom_csv_import_handler() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_FILES['csv_file']) && !empty($_FILES['csv_file']['tmp_name'])) {
        $csv_file = $_FILES['csv_file']['tmp_name'];
        $csv_data = array();

        $post_type = $_POST['type']; // Lawyers/Lawfirms
        $city_id = $_POST['location'];
        // $city_slug = $_POST['city'];
        if($post_type == 'lawyers') { $taxonomy = 'lawyers-location';
        } else { $taxonomy = 'lawfirms-location'; }
        // $term_object = get_term_by( 'slug', $city_slug, $taxonomy );
        // $city_id = $term_object->term_id;


        if (($handle = fopen($csv_file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $csv_data[] = $row;
            }                      

            array_shift($csv_data);
            foreach ($csv_data as $row) {

                // echo '<pre>';
                // print_r($row);
                // echo '<pre>';
                
                $upload_id = $row[0];
                $business_name = $row[1];
                $address = clean($row[2]);
                $website = $row[3];
                $email_list = strtolower($row[4]);
                $phone = clean($row[5]);
                $business_description = clean($row[6]); 
                $gmb_link = str_replace('"', '', $row[7]).'<br>'; 
                $reviews_count = $row[8];
                
                if(!empty($email_list)) {

                    $email_list = str_replace( array( '[', ']', '"' ), '', $email_list);
                    $email_list = explode(",",$email_list);

                    $i = 0;                    
                    if(!empty($email_list) && sizeof($email_list) > 0) {
                                                  
                        $primary_email = array_shift($email_list); //get the mail email

                        $exists = email_exists($primary_email);
                        if ( $exists ) { //Email exists 
                            echo "<p style='color:red;'><b>That E-mail is registered to user Id: " . $exists."</b>, Sheet id: : " . $upload_id."</p>";
                        } else { //User add & Post add                    

                            $email_part = strstr($primary_email, '@', true);
                            $name_part = strtolower(str_replace(' ', '_', $business_name));                            
                            $login_name = $name_part . '_' . $email_part;
                            if(strlen($login_name) > 60 ) {
                                $login_name= $name_part;
                            }

                            $userdata = array(
                                'user_login' =>  $login_name,
                                'user_email' =>  $primary_email,
                                'first_name' => $business_name,
                                'user_pass'  =>  wp_generate_password( 12, true, true ),
                                'role' => 'basic' //For now
                            );                            

                            $user_id = wp_insert_user( $userdata ) ;
                    
                            if ( ! is_wp_error( $user_id ) ) {
                    
                                $new_post = array(
                                    'post_title' => $business_name,
                                    'post_content' => wp_filter_post_kses($business_description),
                                    'post_status' => 'publish',
                                    'post_date' => date('Y-m-d H:i:s'),
                                    'post_author' => $user_id,
                                    'post_type' => $post_type,
                                );

                                $post_id = wp_insert_post($new_post);

                                if(!is_wp_error($post_id)){
                                    
                                    add_post_meta( $post_id, 'address', $address, true );
                                    add_post_meta( $post_id, 'phone', $phone, true );
                                    add_post_meta( $post_id, 'website', $website, true );
                                    add_post_meta( $post_id, 'gmb_link', $gmb_link, true );
                                    add_post_meta( $post_id, 'reviews_count', $reviews_count, true );
                                    
                                    //Adding city depending on the post type(taxonomy)
                                    wp_set_post_terms( $post_id, $city_id, $taxonomy );                
                        
                                    if(!empty($email_list) && sizeof($email_list) > 0) { //get the mail email
                                        update_post_meta($post_id, 'other_email', implode(',', $email_list)); 
                                    }   
                                    
                                    echo "<p>User id: ".$user_id." , Post id: ".$post_id."</p>";
                                    echo "<p style='color:green;'>Uploaded id (from sheet): ".$upload_id."</p>";
                                    
                                } else {
                                    //there was an error in the post insertion, 
                                    echo $post_id->get_error_message();
                                    echo "<p style='color:red;'>Error on adding post. Upload id: ".$upload_id."</p>";
                                }    
                            
                            } else {

                                echo '<div class="alert alert-danger" role="alert">';
                                    echo $user_id->get_error_message();
                                echo '</div>';

                                echo "<p style='color:red;'>Error on creating User. Upload id: ".$upload_id."</p>";

                            } 
                            
                        }
                          
                    }
                }

                echo "------- Done. Waiting for the next. -------<br>";

            }
            
            fclose($handle);  

            // Save the CSV data to the options table
            update_option('last_csv_import_time', date('Y-m-d H:i:s'));

            echo '<div class="updated"><p>CSV imported successfully!</p></div>';
        } else {
            echo '<div class="error"><p>Failed to open the CSV file.</p></div>';
        }
    } else {
        echo '<div class="error"><p>Please upload a CSV file.</p></div>';
    }

}


function clean($string) {
    // $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
 
    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}




//Admin 
add_action( 'admin_enqueue_scripts', 'lyi_admin_enqueue_files' );

function lyi_admin_enqueue_files() {
    $admin_ver = '1.0.8';
    
    // wp_enqueue_script('lyi-admin-script', get_template_directory_uri() . '/js/admin-script.js', array('jquery'), null, true);
    // wp_localize_script('lyi-admin-script', 'custom_ajax_object', array(
    //     'ajax_url' => admin_url('admin-ajax.php'),
    //     'nonce'    => wp_create_nonce('custom_ajax_form_nonce_action')
    // ));
	wp_enqueue_script( 'lyi-admin-script', get_template_directory_uri() . '/js/admin-script.js', array(), $admin_ver, true );
}

// function handle_custom_ajax_form() {
//     check_ajax_referer('custom_ajax_form_nonce_action', 'custom_ajax_form_nonce');

//     if (isset($_POST['userType'])) {

//         if($_POST['userType'] == 'lawyers') {
//             $taxonomy = 'lawyers-location';
//         } else {
//             $taxonomy = 'lawfirms-location';
//         }
//         $gen_country_html = '<option value="" label="">Choose Country</option>';

//         $countryList = get_terms(array(
//             'taxonomy' => $taxonomy,
//             'parent' => 0,
//             'hide_empty' => false
//         ));

//         foreach($countryList as $country) {
//             $gen_country_html .= '<option value="'.$country->term_id.'" slug="'.$country->slug.'">'.$country->name.'</option>';
//         }        

//         wp_send_json_success(array('flag' => 'Got', 'html' => $gen_country_html));
//     } else {
//         wp_send_json_error(array('message' => 'Error.'));
//     }
// }
// add_action('wp_ajax_get_country_for_import', 'handle_custom_ajax_form');