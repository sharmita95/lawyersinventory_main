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


<!-- <form id="find-lawyers-by-location" action="" method="POST">

    <select name="country" id="country">
        <option value="">Choose Country</option>
        <?php /*foreach($countryList as $country) { ?>
            <option value="<?php echo $country->term_id; ?>" slug="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
        <?php }*/ ?>
    </select>

    <select name="state" id="state">
        <option value="">Choose State</option>
    </select>

    <select name="city" id="city">
        <option value="">Choose City</option>
    </select> -->

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

    <!-- <input type="submit" value="Submit"/>

</form> -->




<!--------------------------- HTML ------------------------------->
<section class="lawyers-common-banner-sec">
    <div class="container mx-auto">
        <div class="lawyers-c-b-inner">
            <div class="l-c-b-title-wrapper">
                <h2 class="l-c-b-title">
                    Best Lawyers
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
            <form id="find-lawyers-by-location" action="" method="POST" class="lawyers-filter-submit-from">
                <div class="lawyers-filter-left-sec">
                    <div class="lawyers-filter-select-option-wrapper">
                        <select x class="lawyers-filter-select-option" name="issue" id="issue">
                            <option value="" selected>lawyers Type</option>
                            <option value="1" slug="family">Family</option>
                            <option value="2" slug="criminal">Criminal</option>
                            <option value="3" slug="business">Business</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="country" id="country" x class="lawyers-filter-select-option">
                            <option value="">Choose Country</option>
                            <?php foreach($countryList as $country) { ?>
                                <option value="<?php echo $country->term_id; ?>" slug="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="state" id="state" x class="lawyers-filter-select-option">
                            <option value="">Choose State</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select name="city" id="city" x class="lawyers-filter-select-option">
                            <option value="">Choose City</option>
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
                <?php 
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/lawyers', 'card');
                    endwhile; ?>
                <?php else : ?>
                    <p>No data available</p>
                <?php endif; ?>
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