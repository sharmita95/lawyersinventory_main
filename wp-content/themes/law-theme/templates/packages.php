<?php /* Template Name: Packages */
get_header(); ?>

<section class="best-lawyers-in-us">
    <div class="container mx-auto">
        <div class="package">
            <div>
                <h3>Free</h3>
                <p>Not able to do anything. Only can login</p>
                <span>Price: N/A (If subscription expires)</span>
            </div>

            <div>
                <h3>Basic</h3>
                <p>Profile Listing</p>
                <span>Price: Free</span>
            </div>

            <div>
                <h3>Sliver</h3>
                <p>Get About Us content</p>
                <span>Price: $5</span>
            </div>

            <div>
                <h3>Platinum</h3>
                <p>Profile featured Listing</p>
                <span>Price: $7</span>
            </div>
        </div>
    </div>
</section>

<style>
    .package>div{
        border: 1px solid #ddd;
        padding: 0 15px;
        margin: 15px 0;
    }
    .package span {
        padding-bottom: 15px;
        display: block;
    }
</style>


<?php
get_footer();
?>