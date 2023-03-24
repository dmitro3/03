<?php 
/**
 * Template Name: Affiliate Area Main Page
 *
 * Affiliate Area Main Page
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header();
get_sidebar(); ?>
<div class="inner-page-text">
    <div class="woocommerce-page woocommerce-cart-page">
        <div class="container">
            <div class="row m-auto justify-content-center">
                <div class="col-lg-6  text-center">
                    <h2 class="h2-title"><?php the_title(); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    echo do_shortcode('[affiliate_area]');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-5 col-lg-5 col-md-8 col-sm-5 col-xs-5">
</div>
<?php
if (have_posts()):
  while (have_posts()) : the_post();
    the_content();
  endwhile;
else:
  echo '<p>Sorry, no posts matched your criteria.</p>';
endif;
?>
<?php get_footer(); ?>
