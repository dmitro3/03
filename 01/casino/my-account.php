<?php

/**
 * Template Name: My-Account Main Page
 *
 * My-Account Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header();
get_sidebar();
?>
<div class="woocommerce-page woocommerce-myaccount-page">
    <div class="container">
        <div class="row m-auto justify-content-center">
            <div class="col-lg-6  text-center">
                <h2 class="h2-title"><?php the_title(); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>