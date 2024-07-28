<?php 
/**
 * Template Name: Contact Paid Profile
 *
 */
 ?>
<?php get_header();
session_start();
$post_id = base64_decode($_GET['n1']);
$type = $_GET['n2'];

if(empty($post_id) || empty($type) ) {
   
   echo '<div class="container pt60 pb-40"><h2>You are not allowed to contact.</h2></div>';
    
} else {
    
    $post_data = get_post($post_id);
    
    $contact_email = get_post_meta($post_id,'contact-email',true);
    ?>
    
        <div class="container pb-40">
    		<div class="issues">
        		<h3>Contact to <?php echo $post_data->post_title; ?> </h3>
        		<div class="row">                
                            
                    <div class="col-md-12">
    
                        <?php
                        if($type == 'lawfirm') { //lawfirm ?>
                        
                            <p>Complete the form below with your full contact information and a brief description.
                            We will forward your request to the law firm owner. They will contact you shortly.</p>
                            
                            <form action = "<?php $_PHP_SELF ?>" method = "POST">
                                
                                <label class="label">Name:</label>
                                <input type="text" name="e_name" class="form-control" placeholder="Enter Your Name">
                                
                                <input type="hidden" name="lawfirm_email" class="form-control" value="<?php echo $contact_email; ?>" readonly>
                                <input type="hidden" name="lawfirm_name" value="<?php echo $post_data->post_title; ?>" readonly>
                                
                                <div class="form-group">
                                    <label class="label">Contact Information:</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <fielditem>Email:</fielditem><br>
                                            <input name="e_email" type="text" placeholder="Your Email Address *" id="Email" class="form-control" value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <fielditem>Phone Number:<br>
                                            <input name="e_phone" id="phone" type="text" placeholder="Your Phone Number *" value="" class="form-control"></fielditem>
                                        </div>
                                    </div>
                                    <div class="bold blue">Please double-check that your email address and phone number are complete and correct otherwise law firms will be unable to contact you.</div>
                                </div>
                                
                                <!--<input type="text" name="e_subject" class="form-control" placeholder="Enter Your Subject">-->
                                <label class="label">Message to the Law Firm:</label>
                                <textarea name="e_message"></textarea>
                                
                                <p><b>Note:</b> Lawyersinventory does not share the information in this form with any persons or entities other than the law firm.
                                Please read our Terms and Conditions before sending this form.</p>
                                
                                <input type="submit" value="Submit" class="btn btn-primary full-width" name="submit">
                                
                            </form>
                            
                            <?php 
                            if ($_POST['submit']) {
                                $e_name = $_POST['e_name'];
                                $e_email = $_POST['e_email'];
                                $e_phone = $_POST['e_phone'];
                                $e_message = $_POST['e_message'];
                                $lawfirm_name = $_POST['lawfirm_name'];
                                $lawfirm_email = $_POST['lawfirm_email'];
                                
                                if(empty($e_name) || empty($e_email) || empty($e_phone) || empty($e_message)) {
                                    echo '<div class="alert alert-danger" role="alert">Fill in all fields.</div>';
                                } else {
                                    
                                    $to = $lawfirm_email;
                                    $admin_email = get_option( 'admin_email' );
                                    $body = '<table class="mail-table" style="border: 1px solid #0a9e01; padding:20px; width: 100%;">
                                            <h4 style="border-bottom: 2px solid #ccc; padding-bottom: 10px; width: 50%;">This e-mail was sent from a Lawyersinventory.</h4>
                                            <p>'.$e_name.' want to contact '.$lawfirm_name.'.</p>
                                            <tr>
                                                <td>Name of the User: ' .$e_name .'</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Email of User: '. $e_email .'</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Phone Number of User: ' . $e_phone. '</td>
                                            </tr>
                                            <tr>
                                                <td>Lawfirm Name: ' . $lawfirm_name .'</td>
                                            </tr>
                                            <tr>
                                                <td>Lawfirm Email: ' . $lawfirm_email .'</td>
                                            </tr>
                                            <tr>
                                                <td>Message: ' . $e_message .'</td>
                                            </tr>
                                            
                                        </table>';
                                    $headers = array('Content-Type: text/html; charset=UTF-8', 'Reply-To: ' .$e_name .' <' . $e_email. '>', 'Cc: '.$admin_email);
                                    wp_mail( $to, 'Lawyersinventory Lawfirm Contact Form' , $body, $headers );
                                    
                                    echo '<div class="alert alert-success" role="alert">Thank you for your message. Your email has been sent to the Lawfirm owner. They will contact shortly.</div>';
                                    
                                }
                            }
                            ?>
                            
                        <?php
                            
                        } else { //Lawyers ?>
                        
                            <p>Complete the form below with your full contact information and a brief description.
                            We will forward your request to the lawyer. He/She will contact you shortly.</p>
                            
                            <form action = "<?php $_PHP_SELF ?>" method = "POST">
                                
                                <label class="label">Name:</label>
                                <input type="text" name="e_name" class="form-control" placeholder="Enter Your Name">
                                
                                <input type="hidden" name="lawyer_email" class="form-control" value="<?php echo $contact_email; ?>" readonly>
                                <input type="hidden" name="lawyer_name" value="<?php echo $post_data->post_title; ?>" readonly>
                                
                                <div class="form-group">
                                    <label class="label">Contact Information:</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <fielditem>Email:</fielditem><br>
                                            <input name="e_email" type="text" placeholder="Your Email Address *" id="Email" class="form-control" value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <fielditem>Phone Number:<br>
                                            <input name="e_phone" id="phone" type="text" placeholder="Your Phone Number *" value="" class="form-control"></fielditem>
                                        </div>
                                    </div>
                                    <div class="bold blue">Please double-check that your email address and phone number are complete and correct otherwise lawyer will be unable to contact you.</div>
                                </div>
                                
                                <!--<input type="text" name="e_subject" class="form-control" placeholder="Enter Your Subject">-->
                                <label class="label">Message to the Lawyer:</label>
                                <textarea name="e_message"></textarea>
                                
                                <p><b>Note:</b> Lawyersinventory does not share the information in this form with any persons or entities other than the lawyer.
                                Please read our Terms and Conditions before sending this form.</p>
                                
                                <input type="submit" value="Submit" class="btn btn-primary full-width" name="submit">
                                
                            </form>
                            
                            <?php
                            if ($_POST['submit']) {
                                
                                $e_name = $_POST['e_name'];
                                $e_email = $_POST['e_email'];
                                $e_phone = $_POST['e_phone'];
                                $e_message = $_POST['e_message'];
                                $lawyer_name = $_POST['lawyer_name'];
                                $lawyer_email = $_POST['lawyer_email'];
                                
                                if(empty($e_name) || empty($e_email) || empty($e_phone) || empty($e_message)) {
                                    echo '<div class="alert alert-danger" role="alert">Fill in all fields.</div>';
                                } else {
                                    
                                    $to = $lawyer_email;
                                    $admin_email = get_option( 'admin_email' );
                                    $body = '<table class="mail-table" style="border: 1px solid #0a9e01; padding:20px; width: 100%;">
                                            <h4 style="border-bottom: 2px solid #ccc; padding-bottom: 10px; width: 50%;">This e-mail was sent from a Lawyersinventory.</h4>
                                            <p>'.$e_name.' want to contact Lawyer '.$lawyer_name.'.</p>
                                            <tr>
                                                <td>Name of the User: ' .$e_name .'</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Email of User: '. $e_email .'</td>
                                            </tr>
                                            <tr>
                                                <td>Contact Phone Number of User: ' . $e_phone. '</td>
                                            </tr>
                                            <tr>
                                                <td>Lawyer Name: ' . $lawyer_name .'</td>
                                            </tr>
                                            <tr>
                                                <td>Lawyer Email: ' . $lawyer_email .'</td>
                                            </tr>
                                            <tr>
                                                <td>Message: ' . $e_message .'</td>
                                            </tr>
                                            
                                        </table>';
                                    $headers = array('Content-Type: text/html; charset=UTF-8', 'Reply-To: ' .$e_name .' <' . $e_email. '>', 'Cc: '.$admin_email);
                                    wp_mail( $to, 'Lawyersinventory Lawyers Contact Form' , $body, $headers );
                                    
                                    echo '<div class="alert alert-success" role="alert">Thank you for your message. Your email has been sent to the lawyer. They will contact shortly.</div>';
                                    
                                }
                                
                            }
                            
                        }
                        ?>
                        
                    </div>                
                
                </div>
            </div>
        </div>
        
        <script>
            jQuery(document).ready(function($) {
                //$('.alert').delay(6000).remove();
            });
        </script>
<?php
}
get_footer();