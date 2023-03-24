<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Premier_Turf_Farms
 */

get_header();
get_sidebar();
$blog_page_id = get_option('page_for_posts', true);
?>
<!-- <section class="inner-banner bg-img" style="background-image: url('<?php the_field('banner_image', $blog_page_id); ?>');">
	<div class="sec-wp">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="inner-banner-content white-text text-center">
						<div class="inner-banenr-content wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">
							
						</div>
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
            <div class="inner-page-text single_page">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="content-area">
                                <main id="primary" class="site-main">
                                    <h1 class="h2-title"><?php the_title(); ?></h1>
                                    <?php
                                    while (have_posts()) :
                                        the_post();

                                        get_template_part('template-parts/content', get_post_type());

                                        the_post_navigation(
                                            array(
                                                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'premier-turf-farms') . '</span> <span class="nav-title">%title</span>',
                                                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'premier-turf-farms') . '</span> <span class="nav-title">%title</span>',
                                            )
                                        );

                                        // If comments are open or we have at least one comment, load up the comment template.
                                        if (comments_open() || get_comments_number()) :
                                            comments_template();
                                        endif;

                                    endwhile; // End of the loop.
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
