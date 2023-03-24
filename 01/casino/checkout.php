<?php 
/**
 * Template Name: Check-Out Main Page
 *
 * Check-Out Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header();
get_sidebar(); 
?>
<div class="inner-page-text">
    <div class="woocommerce-page woocommerce-checkout-page">
        <div class="container">
            <div class="row m-auto justify-content-center">
                <div class="col-lg-6  text-center">
                    <h2 class="h2-title">Checkout</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

		