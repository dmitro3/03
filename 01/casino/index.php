<?php

/**
 * Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header();
get_sidebar();
?>
<div class="col-xl-12 col-lg-12 col-md-12">


    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">

        <div class="content">
            <div class="inner_banner" style="background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2022/09/Urgent-Games-BannerBanner-2-copy.jpg')">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner_banner_text">
                                <h1 class="h1_title">Blog</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-page-text">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <?php
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                                    get_template_part('template-parts/content', get_post_type());
                                endwhile;
                            echo paginate_links();
                            
                            else :
                                get_template_part('template-parts/content', 'none');
                            endif;
                            ?>
                        </div>
                        <?php if (is_active_sidebar('sidebar-1')) : ?>
                            <div class="col-lg-4">
                                <?php dynamic_sidebar('sidebar-1'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>