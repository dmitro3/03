<?php

/**
 * Template Name: Finance Players Withdrawal Request
 */


get_template_part('admin/admin', 'header');
if (is_user_logged_in()) {

    get_template_part('admin/admin', 'sidebar');
}

?>

<?php get_template_part('admin/template-parts/content', 'finance-players-withdrawal-request'); ?>

<?php

get_template_part('admin/admin', 'footer');