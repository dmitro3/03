<?php
/**
 * Template Name: Test Template
 */
get_template_part( 'admin/admin','header' );   
// get_template_part( 'admin/admin','sidebar' );   
?>
   	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
            global $api_server_url;
			// get_template_part( 'admin/template-parts/content', 'users' );

            $providers = file_get_contents($api_server_url."/casinos/casino-admin-reports?action=get-all-providers&token=e666cd71c534c269624e41346a5480fa&casino=63110e3fb1ad90a7278e8a36");
            $get_providers = json_decode($providers);

            if ($get_providers->status == 200) {
                echo "<pre>";
                // print_r($get_providers->providers);

                foreach ($get_providers->providers as $provider) {
                    echo $provider->name." ".$provider->providerId;
                }
                echo "</pre>";
            } else {
                $response_msg = $get_providers->response;
            }
            
			?>
		</main><!-- #main -->
	</div><!-- #primary -->


<?php

get_template_part( 'admin/admin','footer' );  