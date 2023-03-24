<?php

/**
 * Template Name: Summary
 */


get_template_part('admin/admin', 'header');
if (is_user_logged_in()) {

    get_template_part('admin/admin', 'sidebar');
}

?>

<?php get_template_part('admin/template-parts/content', 'summary'); ?>

<?php

get_template_part('admin/admin', 'footer');