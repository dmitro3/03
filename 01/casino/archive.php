<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Premier_Turf_Farms
 */

get_header();
get_sidebar();
// $blog_page_id = get_option('page_for_posts', true);
?>
<!-- <section class="main-banner inner-banner rest-banner" style=" background-image: url('<?php the_field('banner_image', $blog_page_id); ?>');">
   <div class="sec-wp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-text white-text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<div class="col-xl-12 col-lg-12 col-md-12">


    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">

        <div class="content">
            <div class="inner_banner" style="background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2022/09/Urgent-Games-BannerBanner-2-copy.jpg')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner_banner_text">
                                <h1 class="h1_title"> <?php the_archive_title(); ?></h1>
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

                                            /*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
                                            get_template_part('template-parts/content', get_post_type());

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
