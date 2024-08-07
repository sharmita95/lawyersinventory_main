<?php /* Template Name: Find Law Firms */
get_header(); ?>

<section class="lawyers-common-banner-sec">
    <div class="container mx-auto">
        <div class="lawyers-c-b-inner">
            <div class="l-c-b-title-wrapper">
                <h2 class="l-c-b-title">
                    Best Lawyers firm In US
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
                        <select x class="lawyers-filter-select-option" name="lawyers Type" id="cars">
                            <option value="volvo" selected>lawyers Type</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select x class="lawyers-filter-select-option" name="choose a country" id="cars">
                            <option value="volvo" selected>choose a country</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
                        <select x class="lawyers-filter-select-option" name="choose a state" id="cars">
                            <option value="volvo" selected>choose a state</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>

                    <div class="lawyers-filter-select-option-wrapper">
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

        <div class="lawyers-firm-card-grid-wrapper">
            <div class="lawyers-firm-card-grid">
                <?php
                    for ($lawyers_card = 0; $lawyers_card <= 11; $lawyers_card++) {
                        echo  get_template_part('template-parts/lawyers', 'card');
                    }
                ?>
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