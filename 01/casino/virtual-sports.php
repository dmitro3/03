<?php

/**
 * Template Name: Virtual Sports Page
 *
 * Virtual Sports Page
 *
 * @author Urgent Games
 * @since 1.0.0
 */

get_header();
get_sidebar();

$gametype = 'Virtual';
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/casino.css">

<?php
global $api_server_url;

$agere_games_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '&gameType=' . $gametype;
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
}

?>

<div class="casino_main">
    <div class="row casino_slider">
        <?php if (have_rows('page_template_add_banner_slider')) : ?>
            <?php while (have_rows('page_template_add_banner_slider')) : the_row(); ?>
                <?php if (!empty($slider_image = get_sub_field('page_template_add_banner_slider_image'))) : ?>
                    <div class="col-lg-12">
                        <div class="casino_slider_img" style="background-image: url('<?php echo $slider_image['url']; ?>');"></div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <div class="casino_filer_wp">
        <div class="row">
            <div class="col-sm-9">
                <div class="casino_search_box">
                    <form class="gameSearch">
                        <input type="search" class="form-input game-provider-ser" value="" placeholder="Game name | Provider">
                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="casino-dropdown">
                    <div class="casino-dropdown-text">
                        <span class="casino-dropdown-title">Provider</span>
                    </div>
                    <div class="casino-dropdown-box">
                        <ul>
                            <?php
                            if (isset($all_providers)) {
                                foreach ($all_providers as $provider) {
                                    if (($provider->providerId == 6) || ($provider->providerId == 4)) {
                                        continue;
                                    }
                            ?>
                                    <li>
                                        <div class="checkbox-wp custom-img-box">
                                            <label>
                                                <input type="checkbox" class="provider-checkbox" name="provider[]" value="<?php echo $provider->id; ?>"><span><?php echo $provider->name; ?> <i><?php echo $provider->gamesCount; ?></i></span>
                                            </label>
                                        </div>
                                    </li>
                            <?php

                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class='game-popup-wrap'>
        <div class='game-popup-inner'><iframe class='fancybox-iframe' src='about:blank' style='display:none;'></iframe>
            <div id='game-tvbet-popup-inner'></div>
            <div class='fancy-loader-wrap'>
                <div class='loading'>
                    <div class='bounceball'></div>
                    <div class='loader-text'>GAME LOADING...</div>
                </div>
            </div>
            <div class='close-game-popup'>&times;</div><a href='javascript:void(0)' class='full-screen' data-gameid='' id='full-screen'><i class='fas fa-expand'></i></a><a href='javascript:void(0)' style='display:none' class='small-screen'><i class='fas fa-compress'></i></a>
        </div>
    </div>

    <div class="from-loader-box"> <i class="fas fa-spinner fa-spin ajax-loader from-loader" aria-hidden="true"></i> </div>

    <div class="game-wrap">
        <!-- <div class="row"> -->
        <?php
        // echo "<pre>";
        // print_r($all_available_game);
        // echo "</pre>";
        all_casino_game_html($all_available_game, 'live');
        ?>
        <!-- </div> -->
    </div>

    <?php
    if ($total_game != 0) { ?>

        <div class="load-more-div">
            <button class="game-load-more button" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>" data-page="2" data-innerpage="live" <?php echo 'data-gametype="' . $gametype . '"';  ?> data-abort="1">Load More</button>
            <i class="fas fa-spinner fa-spin ajax-loader" aria-hidden="true"></i>
        </div>
    <?php
    }
    ?>
</div>

<script src="<?php echo get_template_directory_uri() ?>/assets/js/casino-js.js"></script>
<?php get_footer(); ?>