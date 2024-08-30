<?php /* Template Name: Blog listing Page Template  */ ?>
<?php get_header(); 

$filter_category = isset($_POST['input_category'])?$_POST['input_category']:'';
$filter_order = isset($_POST['input_order'])?$_POST['input_order']:'';
$filter_search = isset($_POST['input_search'])?$_POST['input_search']:'';

$post_per_page = get_option('posts_per_page');
$paged = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
$args = array(
   'post_type' => 'post',
   's' => $filter_search,
   'order' => $filter_order,
   'cat'    => $filter_category,
   'paged'  => $paged,
   'posts_per_page' => $post_per_page,
);
$blog_query = new WP_Query($args);
$page_count = $blog_query->max_num_pages;
$post_count = $blog_query->found_posts; ?>


<section class="lawyers-common-banner-sec">
    <div class="container mx-auto">
        <div class="lawyers-c-b-inner">
            <div class="l-c-b-title-wrapper">
                <h2 class="l-c-b-title">
                    Read Best Legal Blogs and Resources
                </h2>
                <p>Stay informed with our expert legal blogs: Get insights on the latest laws, trends, and case studies from top attorneys, and stay up-to-date on legal matters that affect you.</p>
            </div>
        </div>
    </div>
</section>

<section class="blog-listing-sec">
    <div class="container mx-auto">
        <div class="blog-listing-search-and-select-sec">
            <div class="blog-listing-select-sec">
<!-- ----------------------------------------- Category list up  --------------------------------------------------------->
                <div class="lawyers-filter-select-option-wrapper">
                    <?php
                    $categories = get_categories();
                    ?>
                    <select class="lawyers-filter-select-option" name="category_filter" id="category_filter">
                        <option value="">Sort by Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->term_id; ?>" <?php if($category->term_id==$filter_category) echo 'selected'; ?>>
                                <?php echo esc_html($category->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    
                </div>
<!-- ----------------------------------------- Date sorting option --------------------------------------------------------->
                <div class="lawyers-filter-select-option-wrapper">
                    <select class="lawyers-filter-select-option" name="date_sort" id="date_sort">
                        <option value="">Sort by Date</option>
                        <option value="ASC" <?php if('ASC'==$filter_order) echo 'selected'; ?>>Oldest First</option>
                        <option value="DESC" <?php if('DESC'==$filter_order) echo 'selected'; ?>>Newest First</option>
                    </select>
                </div>
                
            </div>
<!-- ----------------------------------------- Search query --------------------------------------------------------->
            <div class="blog-listing-search-sec">
                <div class="lawyers-filter-search-wrapper">
                    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="lawyers-filter-search-from">
                        <input class="lawyers-filter-search-from-input" type="text" placeholder="Search.." value="<?php echo $filter_search; ?>">
                        <button class="lawyers-filter-search-from-button" type="submit">
                            <span class="icon-search"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
<!-- ------------------------------------ all Posts -------------------------------------------------- -->
        <div class="lawyers-card-grid-wrapper">
            <div id = "posts-container" class="lawyers-card-grid">
                
                <?php
                display_custom_card_posts($args, 'blog');
 
                ?>
            </div>
        </div>
<!------------------------------------------ Pagination --------------------------------------------------------------->
      
            <div id="pagination-container">
                    <?php echo custom_pagination(array(
                        'base'    => get_permalink(),
                        'current' => $paged,
                        'total'   => $page_count,
                        'mid_size' => 2,
                        'end_size' => 1,
                        'prev_text' => '&laquo; prev',
                        'next_text' => 'Next &raquo;'
                    )); ?>
            </div>

    </div>
</section>


<?php get_footer() ?>