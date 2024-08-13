<?php /* Template Name: Registation */
get_header();

echo do_shortcode('[LYI_registration_form]');

?>


<section class="register-sec">
    <div class="container mx-auto ">

        <div class="register-sec-inner">
            <div class="register-left-sec">
                <h2 class="register-content-head">Let’s Create Something Great Together</h2>
                <p class="register-subcontent">We love to help! Drop us a note and we will get <br>back to you very soon.</p>
            </div>


            <div class="register-right-sec">
                <form class="register-from">
                    <h2 class="register-form-title">Registration</h2>
                    <div class="register-radio-btn-sec">
                        <label class="register-radio-label" for="">
                            <input type="radio" name="radio-1" class="radio" checked="checked" />
                            <span>
                                lawyers
                            </span>
                        </label>

                        <label class="register-radio-label" for="">
                            <input type="radio" name="radio-1" class="radio" />
                            <span>
                                lawyers firm
                            </span>
                        </label>
                    </div>

                    <div class="">
                        <div class="common-header-wrapper">
                            <div class="common-imput-wrapper ">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="border-b" placeholder="Domain Name">
                            </div>

                            <div class="common-imput-wrapper">
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="border-b" placeholder="Point of Contact Person">
                            </div>

                        </div>

                        <div class="common-header-wrapper">
                            <div class="common-imput-wrapper">
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="border-b" placeholder="Email address">
                                </div>
                            </div>

                            <div class="common-imput-wrapper">
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="border-b" placeholder="Phone">
                                </div>
                            </div>
                        </div>



                        <label for="street-address" class="common-imput-full-wrapper">
                            <input class="register-input-full" type="text" name="street-address" id="street-address" autocomplete="street-address" class="border-b-2" placeholder="Address">
                        </label>



                        <div class="select-common-header-wrapper">
                            <div class=" register-commo-select-wrapper">
                                <select class="register-commo-select">
                                    <option disabled selected>Country</option>
                                    <option>Game of Thrones</option>
                                    <option>Lost</option>
                                    <option>Breaking Bad</option>
                                    <option>Walking Dead</option>
                                </select>
                            </div>

                            <div class="register-commo-select-wrapper">
                                <select class="register-commo-select">
                                    <option disabled selected>State</option>
                                    <option>Game of Thrones</option>
                                    <option>Lost</option>
                                    <option>Breaking Bad</option>
                                    <option>Walking Dead</option>
                                </select>
                            </div>
                            <div class=" register-commo-select-wrapper">
                                <select class="register-commo-select">
                                    <option disabled selected>City</option>
                                    <option>Game of Thrones</option>
                                    <option>Lost</option>
                                    <option>Breaking Bad</option>
                                    <option>Walking Dead</option>
                                </select>
                            </div>
                        </div>


                        <label for="street-address" class="common-imput-full-wrapper">
                            <input class="register-input-full" type="text" name="street-address" id="street-address" autocomplete="street-address" class="border-b-2" placeholder="GMB Link">
                        </label>


                        <label for="street-address" class="common-imput-full-wrapper">
                            <input class="register-input-full" type="text" name="street-address" id="street-address" autocomplete="street-address" class="border-b-2" placeholder="Business Description">
                        </label>
                    </div>

                    <button type="button" class="register-submit-button">Submit <img class="submit-image-arrow" src="<?php bloginfo('template_url'); ?>/images/arrow.png" alt="arrow" />
                </button>
            </div>
        </div>
        </form>
    </div>
    </div>

    </div>

</section>


<!-- <style>
    input, select, textarea {
        margin: 15px;
        display: block;
    }
</style> -->

<?php
get_footer();
?>