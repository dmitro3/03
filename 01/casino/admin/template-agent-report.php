<?php

/**
 * Template Name: Agent Report
 */


get_template_part('admin/admin', 'header');
if (is_user_logged_in()) {

    get_template_part('admin/admin', 'sidebar');
}

?>

<?php get_template_part('admin/template-parts/content', 'agent-report'); ?>

<?php

get_template_part('admin/admin', 'footer');