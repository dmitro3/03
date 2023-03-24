<?php

/**
 * Template Name: Main Page
 *
 * Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header();
get_sidebar();
$banner_image_1 = get_field('banner_image_1', 'option');
$banner_image_2 = get_field('banner_image_2', 'option');
?>

<?php
global $api_server_url;
// $agere_games_url = $api_server_url . '/games/admin?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '&page=' . $page . '' . $providers . '' . $gametype;
$agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino();
try {
    $all_game_data = file_get_contents($agere_games_url);
} catch (Exception $e) {
    $all_game_data = 0;
}

$all_game_data = json_decode($all_game_data);

if (isset($all_game_data) && !empty($all_game_data)) {
    $all_providers = $all_game_data->providers;
    $all_gametypes = $all_game_data->gamesTypes;
    $all_available_game = $all_game_data->availableGames;

    $total_game = $all_available_game->currentGamesCount;
    $total_games = $all_available_game->totalGames;
}
?>

<input type="hidden" class="casino-page-url" value="<?php echo get_permalink(get_page_by_path('casino')); ?>">
<input type="hidden" class="main-page-ajax-url" value="<?php echo admin_url('admin-ajax.php'); ?>">

<!-- <div class="main-banner-wp">
    <div class="social-wrapper">
        <div class="social " data-pages="social">
            <div class="jumbotron banner-slider" data-pages="parallax">
                <?php
                if (have_rows('add_banner_slider')) {
                    while (have_rows('add_banner_slider')) {
                        the_row();
                        $slider_title = get_sub_field('add_banner_slider_title');
                        $slider_sub_title = get_sub_field('add_banner_slider_sub_title');
                        $slider_sub_button_text = get_sub_field('add_banner_slider_button_text');
                        $slider_sub_button_link = get_sub_field('add_banner_slider_button_link');
                        $slider_image = get_sub_field('add_banner_slider_image');
                ?>
                        <div class="slider-row">
                            <div class="cover-photo" style="background-image:url('<?php echo $slider_image; ?>');">

                            </div>
                            <div class="inner">
                                <div class="pull-bottom bottom-left m-b-40 sm-p-l-15">
                                    <?php
                                    if (!empty($slider_sub_title)) {
                                    ?>
                                        <h5 class="text-white no-margin"><?php echo $slider_sub_title; ?></h5>
                                    <?php
                                    }
                                    if (!empty($slider_title)) {
                                    ?>
                                        <h1 class="text-white no-margin"><span class="semi-bold"><?php echo $slider_title; ?></h1>
                                    <?php
                                    }
                                    if (!empty($slider_sub_button_text)) {
                                    ?>
                                        <a href="<?php echo $slider_sub_button_link; ?>" title="<?php echo $slider_sub_button_text; ?>" target="_blank"><?php echo $slider_sub_button_text; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="pagingInfo"></div>
        </div>
    </div>
</div> -->

<section class="hero_sec">
    <div class="row align-items-center flex-column-reverse flex-lg-row">
        <div class="col-lg-6">
            <div class="hero_sec_text">
                <h1 class="h1-title">Deposit and play now!</h1>
                <a href="#" class="sec_btn big_sec_btn" title="Get a Bonus">Play now</a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="hero_img_wp">
                <div class="hero_img_bg">
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/12/banner_circle.png" alt="banner_circle" width="582" height="497">
                </div>
                <div class="hero_main_img">
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/12/banner_img.png" alt="banner_img" width="520" height="580">

                    <div class="hero_sunshine_img_1">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/01/banner_sunlight.png" alt="banner_sunlight" width="600" height="600">
                    </div>
                </div>

                <div class="hero_sunshine_img_2">
                    <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/01/banner_sunlight.png" alt="banner_sunlight" width="600" height="600">
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End of hero_sec -->

<div class="featured-providers">
    
   <?php
    $featured_games_url = "{$api_server_url}/games/admin/getAllCombineAPI?action=feature-providers-games&token=" . agereToken() . "&casino=" . agereCasino();
    $featured_games = file_get_contents($featured_games_url);
    $featured_games = json_decode($featured_games);
    if (200 == $featured_games->status) {
        if (isset($featured_games) && !empty($featured_games)) {
            $featured_providers = $featured_games->providers;
            // $featured_games = $featured_games->games;
            $total_game = $featured_games->currentGamesCount;
        }
    }
    ?>
    <div class="casino_main featured-providers-main">
        
        <!-- <div class="casino_provide_title">
            <h3>Featured Providers</h3>
        </div>
        <form action="" method="get">
            <div class="casino-filter">
                <ul class="casino-filter-slider">
                    <?php if (isset($featured_providers)) { ?>
                        <?php foreach ($featured_providers as $provider) { ?>
                            <?php if (isset($provider->logoURL)) { ?>
                                <li>
                                    <div class="checkbox-wp img-checkbox featured-provider-list">
                                        <label data-featured-id="<?php echo $provider->providerID; ?>">
                                            <img src="<?php echo $provider->logoURL; ?>" height="80">
                                        </label>
                                    </div>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <div class="checkbox-wp custom-img-box featured-provider-list">
                                        <label data-featured-id="<?php echo $provider->providerID; ?>">
                                            <span><?php echo $provider->name; ?></span>
                                        </label>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <h6>Not found</h6>
                    <?php } ?>
                </ul>
            </div>
            <div class="casino-filter-btn">
                        <button type="button" class="button reset-filters">Reset Filters</button>
                        <button type="submit" class="button">Save Filters</button>
                    </div>
        </form> -->

        <!-- Games Slider -->
        <div class='game-popup-wrap'>
            <div class='game-popup-inner'><iframe class='fancybox-iframe' src='about:blank' style='display:none;'></iframe>
                <div id='game-tvbet-popup-inner'></div>
                <div class='fancy-loader-wrap'>
                    <div class='loading'>
                        <div class='bounceball'></div>
                        <div class='loader-text'>GAME LOADING...</div>
                    </div>
                </div>
                <div class='close-game-popup'>&times;</div>
                <a href='javascript:void(0)' class='full-screen' data-gameid='' id='full-screen'><i class='fas fa-expand'></i></a>
                <a href='javascript:void(0)' style='display:none' class='small-screen'><i class='fas fa-compress'></i></a>
            </div>
        </div>
        <div class="from-loader-box">
            <i class="fas fa-spinner fa-spin ajax-loader from-loader" aria-hidden="true"></i>
        </div>

        <!-- Featured Games -->
        <div class="casino_provide_title">
            <h3>Featured Games</h3>
        </div>
        <?php if (isset($featured_games->games) && !empty($featured_games->games)) { ?>
            <div class="home_game_slider">
                <?php all_casino_game_html($featured_games, 'main-page', 'feature'); ?>
            </div>
        <?php } else { ?>
            <h6>Not found</h6>
        <?php } ?>
    </div>
</div>

<!-- Content Box Section -->
<?php if (have_rows('home_content_box_with_image')) : ?>
    <div class="home_card_sec">
        <div class="row">
            <?php while (have_rows('home_content_box_with_image')) : the_row(); ?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card_shape">
                            <img src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/card_shape.svg" width="97" height="280" alt="card_shape">
                        </div>
                        <?php if ($image = get_sub_field('home_content_box_image')) : ?>
                            <div class="card_icon">
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="78" height="78">
                            </div>
                        <?php endif; ?>
                        <?php if (get_sub_field('home_content_box_title_link') || get_sub_field('home_content_box_content')) : ?>
                            <div class="card-body">
                                <?php if ($title_link = get_sub_field('home_content_box_title_link')) : ?>
                                    <h5 class="card-title">
                                        <a href="<?php echo $title_link['url']; ?>" target="<?php echo $title_link['target'] ? $title_link['target'] : '_self'; ?>"><?php echo $title_link['title']; ?></a>
                                    </h5>
                                <?php endif; ?>
                                <?php if ($content = get_sub_field('home_content_box_content')) : ?>
                                    <p class="card-text"><?php echo $content; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>
<!-- End Content Box Section -->

<!-- <script type="text/javascript" src="https://tvbetframe.com/assets/frame.js"></script> -->
<!-- <script src="<? php # echo get_template_directory_uri() 
                    ?>/assets/js/casino-js.js"></script> -->
<script src="https://client.pragmaticplaylive.net/desktop/assets/api/fullscreenApi.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/main-page.js?<?php echo time(); ?>"></script>


<?php get_footer(); ?>