<?php /* Template Name: Registation */
get_header();

echo do_shortcode('[LYI_registration_form]');

?>

<style>
    input, select, textarea {
        margin: 15px;
        display: block;
    }
</style>

<?php
get_footer();
?>