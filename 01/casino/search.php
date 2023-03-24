<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Premier_Turf_Farms
 */

get_header();
get_sidebar();
?>
<!-- <section class="main-banner inner-banner rest-banner" style=" background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2022/10/footer-bg.jpg');">
    <div class="sec-wp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-text white-text">
                        <h1 class="h1-title">Search</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>emd of main-banner -->

<div class="col-xl-12 col-lg-12 col-md-12">


    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">

        <div class="content">
            <div class="inner_banner" style="background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2022/09/Urgent-Games-BannerBanner-2-copy.jpg')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner_banner_text">
                                <h1 class="h1_title">
                                    <?php
                                    /* translators: %s: search query. */
                                    printf(esc_html__('Search Results for: %s', 'premier-turf-farms'), '<span>' . get_search_query() . '</span>');
                                    ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="inner-page-text">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div id="primary" class="content-area">
                                <main id="primary" class="site-main">

                                    <?php if (have_posts()) : ?>

                                    <?php
                                        /* Start the Loop */
                                        while (have_posts()) :
                                            the_post();

                                            /**
                                             * Run the loop for the search to output the results.
                                             * If you want to overload this in a child theme then include a file
                                             * called content-search.php and that will be used instead.
                                             */
                                            get_template_part('template-parts/content', 'search');

                                        endwhile;

                                        the_posts_navigation();

                                    else :

                                        get_template_part('template-parts/content', 'none');

                                    endif;
                                    ?>

                                </main><!-- #main -->
                            </div><!-- #primary -->
                        </div>
                        <div class="col-lg-4">
                            <?php dynamic_sidebar(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
