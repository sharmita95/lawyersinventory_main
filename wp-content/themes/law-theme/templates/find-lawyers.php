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





<?php
get_footer();
?>