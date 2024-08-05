<?php /* Template Name: Find Lawyers */
get_header();

$countryList = get_terms(array(
    'taxonomy' => 'lawyers-location',
    'parent' => 0,
    'hide_empty' => false
));
// $taxonomies = get_terms( array(
//     'taxonomy' => 'lawyers-category',
//     'hide_empty' => false
// ) );
?>


<form id="find-lawyers-by-location" action="" method="POST">

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

    <?php 
    /*if ( !empty($taxonomies) ) :
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
    endif; */ ?>

    <input type="submit" value="Submit"/>

</form>




<!--------------------------- HTML ------------------------------->$_COOKIE<section class="lawyers-common-banner-sec">
    <div class="container mx-auto">
        <div class="lawyers-c-b-inner">
            <div class="l-c-b-title-wrapper">
                <h2 class="l-c-b-title">
                    Best Lawyers In US
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="best-lawyers-in-us">
    <div class="container mx-auto">
        <div class="lawyers-filter-search-wrapper">
            <form action="/action_page.php" class="lawyers-filter-search-from">
                <input class="lawyers-filter-search-from-input" type="text" placeholder="Search.." name="search">
                <button class="lawyers-filter-search-from-button" type="submit">
                    <span class="icon-search"></span>
                </button>
            </form>
        </div>

        <div class="lawyers-filter-submit-from-whapper">
            <form action="/action_page.php" class="lawyers-filter-submit-from">
                <div class="lawyers-filter-left-sec">
                    <div class="lawyers-filter-select-option-wrapper">
                        <!-- <label for="cars">Choose a car:</label> -->
                        <select x class="lawyers-filter-select-option" name="lawyers Type" id="cars">
                            <option value="volvo" selected>lawyers Type</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <!-- <label for="cars">Choose a car:</label> -->
                        <select x class="lawyers-filter-select-option" name="choose a country" id="cars">
                            <option value="volvo" selected>choose a country</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <!-- <label for="cars">Choose a car:</label> -->
                        <select x class="lawyers-filter-select-option" name="choose a state" id="cars">
                            <option value="volvo" selected>choose a state</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <!-- <label for="cars">Choose a car:</label> -->
                        <select x class="lawyers-filter-select-option" name="choose a city" id="cars">
                            <option value="volvo" selected>choose a city</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>

                </div>

                <div class="lawyers-filter-right-sec">
                    <button class="lawyers-filter-select-button" type="submit">
                        Submit
                    </button>
                </div>
            </form>

        </div>

        <div class="lawyers-card-grid-wrapper">
            <div class="lawyers-card-grid">

                <div class="lawyers-card">

                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-5.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-6.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">
                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-7.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-8.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-9.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-10.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-4.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-3.png'; ?>" alt="lawyers image">
                    </figure>

                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-2.png'; ?>" alt="lawyers image">
                    </figure>
                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">
                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-2.png'; ?>" alt="lawyers image">
                    </figure>
                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-6.png'; ?>" alt="lawyers image">
                    </figure>
                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="lawyers-card">
                    <figure class="lawyers-card-figure">
                        <img class="image-responsive" src="<?php echo get_template_directory_uri() . '/images/Lawyers-10.png'; ?>" alt="lawyers image">
                    </figure>
                    <div class="lawyers-card-content">
                        <div class="lawyers-card-title-button-wrapper">
                            <div class="lawyers-card-title-wrapper">
                                <h2 class="lawyers-card-title">Joe Stephens</h2>
                                <p class="lawyers-card-subtitle">
                                    Car Accidents
                                </p>
                            </div>
                            <button class="lawyers-card-button">
                                <span class="icon-arrow-right2"></span>
                            </button>
                        </div>
                        <div class="lawyers-card-social-wrapper">

                            <div class="lawyers-card-social-inner-wrapper">
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-instarm"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-fb"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-linked-in"></span>
                                </a>
                                <a class="lawyers-card-social-icon" href="">
                                    <span class="icon-Vector"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="pagination-wrapper">
            <div class="pagination">
                <a class="pagination-btn p-b-active" href="#">1</a>
                <a class="pagination-btn" href="#">2</a>
                <a class="pagination-btn" href="#">3</a>
                <a class="pagination-btn" href="#">4</a>
                <a class="pagination-btn" href="#">5</a>
                <a class="pagination-btn" href="#">6</a>
                <a class="pagination-btn-next" href="#">Next</a>
            </div>

        </div>

    </div>
</section>





<?php
get_footer();
?>