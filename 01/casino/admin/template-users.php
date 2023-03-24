<?php
/**
 * Template Name: Users
 */
get_template_part( 'admin/admin','header' );   
get_template_part( 'admin/admin','sidebar' );   
?>
   	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
			get_template_part( 'admin/template-parts/content', 'users' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php

get_template_part( 'admin/admin','footer' );  