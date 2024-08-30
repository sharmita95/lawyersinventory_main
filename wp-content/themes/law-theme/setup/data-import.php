<?php
// Add an admin menu for CSV import
// Add an admin menu for CSV import
add_action('admin_menu', 'custom_csv_import_menu');

function custom_csv_import_menu()
{
    global $wp_roles; 
    $wp_roles->add_cap( 'administrator', 'view_custom_menu' ); 
    $wp_roles->add_cap( 'editor', 'view_custom_menu' );

    $current_user = wp_get_current_user();
    add_menu_page(
        'CSV Import', 
        'CSV Import Panel', 
        'view_custom_menu', 
        'custom-csv-import', 
        'custom_csv_import_instruction'
    );
    add_submenu_page(
        'custom-csv-import',        // Parent slug
        'Lawyers Data Import',         // Page title
        'Lawyers Data Import',                    // Menu title
        'view_custom_menu',             // Capability required
        'lawyers-import',     // Submenu slug
        'lawyers_import_callback' // Function to display the content
    );
    add_submenu_page(
        'custom-csv-import',        // Parent slug
        'Firms Data Import',         // Page title
        'Firms Data Import',                    // Menu title
        'view_custom_menu',             // Capability required
        'firms-import',     // Submenu slug
        'firms_import_callback' // Function to display the content
    );

    add_submenu_page(
        'custom-csv-import',        // Parent slug
        'Testing',         // Page title
        'For Testing',                    // Menu title
        'view_custom_menu',             // Capability required
        'test-import',     // Submenu slug
        'testing_callback' // Function to display the content
    );

    add_submenu_page(
        'custom-csv-import',        // Parent slug
        'Lat Lon Update',         // Page title
        'Lat Lon Update',                    // Menu title
        'view_custom_menu',             // Capability required
        'lat-lon-update',     // Submenu slug
        'lat_lng_checking_callback' // Function to display the content
    );
    
}

function testing_callback() {
    ?>

    <div class="wrap">
        <h1>Test</h1>

        <form method="post" enctype="multipart/form-data">
            <input type="text" class="regular-text" name="pic" required>
            <input type="submit" name="test_import" class="button button-primary" value="Test">
        </form>

    </div>


    <?php

    if (isset($_POST['test_import'])) {
        $image_url = $_POST['pic'];
        // $image_url = 'https://example.com/image.jpg'; // Replace with your image URL
        $post_id = 51; // Attach to a post ID, or 0 for unattached
        $image_url = 'https://streetviewpixels-pa.googleapis.com/v1/thumbnail?panoid=kvlEANMESccdufSZYqBiqA&cb_client=search.gws-prod.gps&w=408&h=240&yaw=219.64227&pitch=0&thumbfov=100';
        // $image_url = 'https://lh5.googleusercontent.com/p/AF1QipOGIv6f9UuFdmtMXz9gq4aOb3SycjzpdA2TVB7S=w408-h306-k-no';
        // $actual_image_url = get_image_url($image_url);

        $images_arr = file_get_contents($image_url);
        $img_arr = file_put_contents('abcdef.jpg', $images_arr);

        die($img_arr);

        if ($actual_image_url) {
            echo "Image URL found: " . $actual_image_url;
        } else {
            echo "Failed to find image URL.";
        }

    }
    
}


function lat_lng_checking_callback() {

    $args = array(
        'post_type' => array('lawyers', 'law-firms'),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order'   => 'DESC',
        'posts_per_page' => -1,
    );
    $posts_array = get_posts( $args );
    // echo '<pre>';
    // print_r($posts_array);
    // echo '</pre>'; ?>

    <div class="wrap">
        <h1>Service Location <b>Latitude & Longitude</b></h1>
        <p>Add latitude and longitude for each users. Here are the list of missing items.</p>
        <table id="sample-table">
            <tr style="border: 1px solid black;">
                <th>Type</th>
                <th>Post Id</th>
                <th>Title </th>
                <th>Addess </th>
                <th>Latitude </th>
                <th>Longitude </th>
                <th>Action </th>
            </tr>
            <?php
            foreach ( $posts_array as $posts ) { 
                $address = get_post_meta( $posts->ID, 'address', true );
                $location_lat = get_post_meta($posts->ID, 'latitude', true);
                $location_lon = get_post_meta($posts->ID, 'longitude', true);
                if(!$location_lat || !$location_lon) {
                    echo '<tr>
                        <td>'.$posts->post_type.'</td>
                        <td>'.$posts->ID.'</td>
                        <td>'. esc_html($posts->post_title).'</td>
                        <td>'.$address.'</td>
                        <td>'.$location_lat.'</td>
                        <td>'.$location_lon.'</td>
                        <td>
                            <a href="'. home_url('wp-admin/post.php?post='.$posts->ID.'&action=edit').'">Edit</a>
                        </td>
                    </tr>';
                }
            } ?>
        </table>

        <style>
            table {
                width: 100%;
                border: 1px solid #ddd;
                text-align: center;
            }
            table th {
                background: #000;
                color: white;
            }
            table tr { background: #e6e6e6b3; }
            table td:not(:last-child), table th:not(:last-child) {
                border-right: 1px solid #000;
            }
        </style>
    </div>
    <?php
}



function custom_csv_import_instruction() { ?>

    <div class="wrap">
        <h1>Import CSV File</h1>

        <p><b>Note:</b>
            Please ensure that you include all of the fields listed below in the correct order when uploading a CSV file. Do not upload any CSV file that is missing these fields or has them in a different order.
            <br>If you have any questions, please contact the development team before importing the data.
        </p>

        <div>
            <h3>Lawyers</h3>
            <table id="sample-table">
                <tr>                   
                    <td>id</td>
                    <td>name </td>
                    <td>emails </td>
                    <td>phone </td>
                    <td>address </td>
                    <td>image_url</td>
                    <td>profile_description </td>                    
                    <td>practice area</td>
                    <td>cost </td>
                    <td>availability</td>
                    <td>googleMapUrl </td>
                    <td>rating </td>
                    <td>total_rating</td>
                    <td>FB link</td>
                    <td>Insta Link</td>
                    <td>Linkedin link</td>
                    <td>qualifications </td>
                </tr>
            </table>
            <p>Download a dummy CSV for your reference For Lawyers
                <a href="<?php echo get_template_directory_uri().'/import-csv-lawyers.csv'; ?>" download="import-csv">
                    <img src="<?php echo get_template_directory_uri().'/images/downloadIcon.svg'; ?>" alt="import-csv" >
                </a>
            </p>
        </div>
        <div>
            <h3>Law Firms</h3>
            <table id="sample-table">
                <tr>                   
                    <td>id</td>
                    <td>name </td>
                    <td>emails </td>
                    <td>phone </td>
                    <td>address </td>
                    <td>image_url</td>
                    <td>About us</td>
                    <td>practice area</td>
                    <td>cost </td>
                    <td>availability</td>
                    <td>googleMapUrl </td>
                    <td>rating </td>
                    <td>total_rating</td>
                    <td>FB link</td>
                    <td>Insta Link</td>
                    <td>Linkedin link</td>
                </tr>
            </table>
            <p>Download a dummy CSV for your reference For Law firm
                <a href="<?php echo get_template_directory_uri().'/import-csv-lawfirm.csv'; ?>" download="import-csv">
                    <img src="<?php echo get_template_directory_uri().'/images/downloadIcon.svg'; ?>" alt="import-csv" >
                </a>
            </p>
        </div>

        <style>
            #sample-table {
                width: 100%;
                border: 1px solid #ddd;
                text-align: center;
            }

            #sample-table td:not(:last-child) {
                border-right: 1px solid #000;
            }
        </style>

    </div>


<?php
}

function lawyers_import_callback() {
    ?>
    <div class="wrap">
        <h1>Import Lawyers Data</h1>
        <p></p>

        <?php $type = 'lawyers';
        
        $data_taxonomy = $type.'-location';
        $countryList = get_terms(array( //Get countries
            'taxonomy' => $data_taxonomy,
            'parent' => 0,
            'hide_empty' => false
        )); ?>        

        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('custom_form_nonce_action', 'custom_form_nonce'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="custom_field">Choose Data Type</label>
                    </th>
                    <td>
                        <!-- <input type="text" name="type" readonly value="<?php //echo $type; ?>">
                        <input type="text"  readonly value="<?php //echo $data_taxonomy; ?>"> -->
                        <input type="text" name="type" value="<?php echo $type?>" id="type" readonly/>
                        <input type="text" name="tax_name" value="<?php echo $data_taxonomy?>" id="tax-type" readonly/>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="custom_field">Choose City</label>
                    </th>
                    <td class="location">

                        <select id="country">
                            <option>Choose Country</option>
                            <?php foreach ($countryList as $pet_country) {
                                echo '<option value="' . $pet_country->term_id . '">' . $pet_country->name . '</option>';
                            } ?>
                        </select>

                        <select id="state">
                            <option>Choose State</option>
                        </select>

                        <select name="location" id="city">
                            <option>Choose City</option>
                        </select>
                        
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="custom_textarea">Upload</label>
                    </th>
                    <td>
                        <input type="file" class="regular-text" name="csv_file" accept=".csv" required>
                    </td>
                </tr>
            </table>

            <input type="submit" name="import_csv" class="button button-primary" value="Import CSV">
        </form>


        <?php
        if (isset($_POST['import_csv'])) {
            custom_csv_import_handler();
        } ?>

    </div>

    <?php
}

function firms_import_callback() {
    ?>
    <div class="wrap">
        <h1>Import Firms Data</h1>
        <p></p>

        <?php $type = 'law-firms';
        
        $data_taxonomy = 'lawfirms-location';
        $countryList = get_terms(array( //Get countries
            'taxonomy' => $data_taxonomy,
            'parent' => 0,
            'hide_empty' => false
        )); ?>        

        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('custom_form_nonce_action', 'custom_form_nonce'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="custom_field">Choose Data Type</label>
                    </th>
                    <td>
                        <input type="text" name="type" value="<?php echo $type?>" id="type" readonly/>
                        <input type="text" name="tax_name" value="<?php echo $data_taxonomy?>" id="tax-type" readonly/>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="custom_field">Choose City</label>
                    </th>
                    <td class="location">
                        
                        <input type="hidden" value="<?php echo $data_taxonomy?>" id="tax-type"/>

                        <select id="country">
                            <option>Choose Country</option>
                            <?php foreach ($countryList as $pet_country) {
                                echo '<option value="' . $pet_country->term_id . '">' . $pet_country->name . '</option>';
                            } ?>
                        </select>

                        <select id="state">
                            <option>Choose State</option>
                        </select>

                        <select name="location" id="city">
                            <option>Choose City</option>
                        </select>
                        
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="custom_textarea">Upload</label>
                    </th>
                    <td>
                        <input type="file" class="regular-text" name="csv_file" accept=".csv" required>
                    </td>
                </tr>
            </table>

            <input type="submit" name="import_csv" class="button button-primary" value="Import CSV">
        </form>


        <?php
        if (isset($_POST['import_csv'])) {
            custom_csv_import_handler();
        } ?>

    </div>

    <?php
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
        $taxonomy = $_POST['tax_name'];

        if (($handle = fopen($csv_file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $csv_data[] = $row;
            }                      

            array_shift($csv_data);
            foreach ($csv_data as $row) {

                $upload_id = $row[0];
                $business_name = __( stripslashes($row[1]) );
                $email_list = strtolower($row[2]);
                $phone = clean($row[3]);
                $address = clean($row[4]);
                $image = $row[5];
                $profile_description = clean($row[6]);                
                $practice_area = $row[7];
                $cost = clean($row[8]);
                $availability = clean($row[9]);
                $gmb_link = $row[10];
                $rating = $row[11];
                $total_rating = $row[12];
                $fb_link = $row[13];
                $insta_link = $row[14];
                $linkedin_url = $row[15];
                $twitter_url = $row[16];
                if($post_type == 'lawyers')
                $qualification = clean($row[17]);

                if (!empty($email_list)) {

                    $email_list = str_replace(array('[', ']', '"'), '', $email_list);
                    $email_list = explode(",", $email_list);

                    $i = 0;
                    if (!empty($email_list) && sizeof($email_list) > 0) {

                        $primary_email = array_shift($email_list); //get the mail email

                        $exists = email_exists($primary_email);
                        if (!$exists) { //Email exists 

                            $email_part = strstr($primary_email, '@', true);
                            $name_part = strtolower(str_replace(' ', '_', $business_name));
                            $login_name = $name_part . '_' . $email_part;
                            if (strlen($login_name) > 60) {
                                $login_name = $name_part;
                            }

                            $userdata = array(
                                'user_login' =>  $login_name,
                                'user_email' =>  $primary_email,
                                'first_name' =>  $business_name,
                                'user_pass'  =>  wp_generate_password(12, true, true),
                                'role' => $post_type
                            );

                            $user_id = wp_insert_user($userdata);
                            if (!is_wp_error($user_id)) {

                                importing_post_data($user_id, $email_list, $primary_email, $row, $post_type, $city_id, $taxonomy);

                            } else {
                                echo "<p style='color:red;'>Error on creating User. Upload id: " . $upload_id . "</p>";
                            }
                            
                        } else {
                            $user_id = $exists;
                            echo "<p style='color:blue;'><b>That E-mail is registered to user Id: " . $exists . "</b>, so here only the post will be added.</p>";
                        
                            importing_post_data($user_id, $email_list, $primary_email, $row, $post_type, $city_id, $taxonomy);

                        }
                    }

                    echo "------- Done. Waiting for the next. -------<br>";

                }

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


function importing_post_data($user_id, $email_list, $primary_email, $row, $post_type, $city_id, $taxonomy) {

    $upload_id = $row[0];
    $business_name = __( stripslashes($row[1]) );
    // $email_list = strtolower($row[2]);
    $phone = clean($row[3]);
    $address = clean($row[4]);
    $image = $row[5];
    $profile_description = clean($row[6]);                
    $practice_area = $row[7];
    $cost = clean($row[8]);
    $availability = clean($row[9]);
    $gmb_link = $row[10];
    $rating = $row[11];
    $total_rating = $row[12];
    $fb_link = $row[13];
    $insta_link = $row[14];
    $linkedin_url = $row[15];
    $twitter_url = $row[16];
    if($post_type == 'lawyers')
    $qualification = clean($row[17]);

    $myquery = new WP_Query( array(
        'post_type' => $post_type,
        'meta_key' => 'associated_email',
        'meta_value' => $primary_email,
        'order' => 'ASC',
    ));

    if (!empty($myquery->posts) && sizeof($myquery->posts) > 0) {

        echo "<p style='color:red;'>The post already exists. Post ID: " . $myquery->posts[0]->ID . ", Sheet ID: " . $upload_id . "</p>";

    } else {

        //If the post not exists
        $new_post = array(
            'post_title' => $business_name,
            'post_content' => 'About us coming soon....',
            'post_status' => 'publish',
            'post_date' => date('Y-m-d H:i:s'),
            'post_author' => $user_id,
            'post_type' => $post_type,
        );

        $post_id = wp_insert_post($new_post);

        if (!is_wp_error($post_id)) {

            //Adding city depending on the post type(taxonomy)
            wp_set_post_terms($post_id, $city_id, $taxonomy);

            if (!empty($email_list) && sizeof($email_list) > 0) { //get the mail email
                update_post_meta($post_id, 'other_email', implode(',', $email_list));
            }

            if(!empty($primary_email)) update_post_meta($post_id, 'associated_email', $primary_email);
            if(!empty($phone)) update_post_meta($post_id, 'phone_number', $phone);
            if(!empty($address)) update_post_meta($post_id, 'address', $address);
            //image pending;
            if(!empty($image)) update_post_meta($post_id, 'image', $image);
            if(!empty($profile_description)) update_post_meta($post_id, 'profile_description', $profile_description);
            if(!empty($qualification)) update_post_meta($post_id, 'qualification', $qualification);
            //practice area pending
            if(!empty($practice_area)) update_post_meta($post_id, 'practice_area', $practice_area);
            if(!empty($cost)) update_post_meta($post_id, 'cost', $cost);
            if(!empty($availability)) update_post_meta($post_id, 'availability', $availability);
            if(!empty($gmb_link)) update_post_meta($post_id, 'gmb_link', $gmb_link);
            if(!empty($rating)) update_post_meta($post_id, 'rating', $rating);
            if(!empty($total_rating)) update_post_meta($post_id, 'total_rating', $total_rating);
            if(!empty($fb_link)) update_post_meta($post_id, 'image', $fb_link);
            if(!empty($insta_link)) update_post_meta($post_id, 'image', $insta_link);
            if(!empty($linkedin_url)) update_post_meta($post_id, 'image', $linkedin_url);
            if(!empty($twitter_url)) update_post_meta($post_id, 'image', $twitter_url);

            echo "<p>User id: " . $user_id . " , Post id: " . $post_id . "</p>";
            echo "<p style='color:green;'>Uploaded id (from sheet): " . $upload_id . "</p>";
        } else {
            //there was an error in the post insertion, 
            echo $post_id->get_error_message();
            echo "<p style='color:red;'>Error on adding post. Upload id: " . $upload_id . "</p>";
        }

    }

}


function clean($string) {
    // $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
 
    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}












//Admin 
add_action('admin_enqueue_scripts', 'lyi_admin_enqueue_files');

function lyi_admin_enqueue_files() {

    $admin_ver = rand(10,100);
    wp_enqueue_script('tpm-admin-script', get_template_directory_uri() . '/js/admin-script.js', array(), $admin_ver, true);

    wp_localize_script('tpm-admin-script', 'myAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('my_nonce')
    ));
}