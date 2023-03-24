<?php

/**
 * Template Name: Live Casino page
 *
 * Casino Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */

get_header();
get_sidebar();

$gametype = 'LiveGames';
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
    $gameTypeSecondary = $all_game_data->subGameTypes;
    $all_available_game = $all_game_data->availableGames;
    $total_game = $all_available_game->currentGamesCount;
    $total_games = $all_available_game->totalGames;
}

?>

<div class="casino_main">
    <div class="casino_banner">
        <div class="casino_banner_text">
            <h1 class="h1-title">Live dealer</h1>
            <p>Play with the dealer in over 100 games!</p>
        </div>
        <div class="casino_banner_img">
            <img src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/casino_banner_img.png" alt="Casino Shape">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="casino_provide_title">
                <h3><b>Popular Games</b></h3>
                <?php   $agere_slider_url =  $api_server_url . '/games/admin/getAllCombineAPI?action=feature-providers-games&token=' . agereToken() . '&casino=' . agereCasino().'&gameType=LiveGames';
                // echo '<pre>'; print_r(  $agere_slider_url); echo '</pre>';
            ?>
            </div>
            <div class="casino_slider">
                <?php
                
                try {
                    $all_slider_data = file_get_contents($agere_slider_url);
                } catch (Exception $e) {
                    $all_slider_data = 0;
                }
                $all_slider_data = json_decode($all_slider_data);
                // echo "</pre>";
                // print_r($all_slider_data);
                if (isset($all_slider_data) && !empty($all_slider_data)) {
                    all_casino_game_html($all_slider_data, 'live', 'feature');

                }else{?>
                    <h4>No Data Found</h4>
                    <?php
                }?>
            
            </div>
        </div>
    </div>
    <?PHP /*           
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
    </div> */ ?>



    <div class="casino_filer_wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="casino_search_box">
                    <form class="gameSearch">
                        <input type="search" class="form-input game-provider-ser" value="" placeholder="Game Name or Provider">
                        <button type="submit" class="game-provider-input_btn">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.8715 20.29L18.1615 16.61C19.6016 14.8144 20.299 12.5353 20.1103 10.2413C19.9216 7.9473 18.8612 5.81278 17.147 4.27664C15.4329 2.74051 13.1953 1.91951 10.8944 1.98247C8.59356 2.04543 6.40425 2.98756 4.77667 4.61514C3.14909 6.24272 2.20696 8.43204 2.144 10.7329C2.08104 13.0338 2.90203 15.2714 4.43817 16.9855C5.97431 18.6997 8.10883 19.7601 10.4028 19.9488C12.6968 20.1375 14.9759 19.4401 16.7715 18L20.4515 21.68C20.5445 21.7737 20.6551 21.8481 20.7769 21.8989C20.8988 21.9497 21.0295 21.9758 21.1615 21.9758C21.2935 21.9758 21.4242 21.9497 21.5461 21.8989C21.668 21.8481 21.7786 21.7737 21.8715 21.68C22.0518 21.4935 22.1525 21.2443 22.1525 20.985C22.1525 20.7257 22.0518 20.4765 21.8715 20.29V20.29ZM11.1615 18C9.77706 18 8.42368 17.5895 7.27253 16.8203C6.12139 16.0511 5.22418 14.9579 4.69437 13.6788C4.16456 12.3997 4.02593 10.9922 4.29603 9.63437C4.56612 8.2765 5.23281 7.02922 6.21178 6.05025C7.19075 5.07128 8.43803 4.4046 9.79589 4.1345C11.1538 3.86441 12.5612 4.00303 13.8403 4.53284C15.1194 5.06266 16.2126 5.95986 16.9818 7.11101C17.751 8.26215 18.1615 9.61553 18.1615 11C18.1615 12.8565 17.424 14.637 16.1113 15.9497C14.7985 17.2625 13.018 18 11.1615 18V18Z" fill="white" />
                                <path d="M21.8715 20.29L18.1615 16.61C19.6016 14.8144 20.299 12.5353 20.1103 10.2413C19.9216 7.9473 18.8612 5.81278 17.147 4.27664C15.4329 2.74051 13.1953 1.91951 10.8944 1.98247C8.59356 2.04543 6.40425 2.98756 4.77667 4.61514C3.14909 6.24272 2.20696 8.43204 2.144 10.7329C2.08104 13.0338 2.90203 15.2714 4.43817 16.9855C5.97431 18.6997 8.10883 19.7601 10.4028 19.9488C12.6968 20.1375 14.9759 19.4401 16.7715 18L20.4515 21.68C20.5445 21.7737 20.6551 21.8481 20.7769 21.8989C20.8988 21.9497 21.0295 21.9758 21.1615 21.9758C21.2935 21.9758 21.4242 21.9497 21.5461 21.8989C21.668 21.8481 21.7786 21.7737 21.8715 21.68C22.0518 21.4935 22.1525 21.2443 22.1525 20.985C22.1525 20.7257 22.0518 20.4765 21.8715 20.29V20.29ZM11.1615 18C9.77706 18 8.42368 17.5895 7.27253 16.8203C6.12139 16.0511 5.22418 14.9579 4.69437 13.6788C4.16456 12.3997 4.02593 10.9922 4.29603 9.63437C4.56612 8.2765 5.23281 7.02922 6.21178 6.05025C7.19075 5.07128 8.43803 4.4046 9.79589 4.1345C11.1538 3.86441 12.5612 4.00303 13.8403 4.53284C15.1194 5.06266 16.2126 5.95986 16.9818 7.11101C17.751 8.26215 18.1615 9.61553 18.1615 11C18.1615 12.8565 17.424 14.637 16.1113 15.9497C14.7985 17.2625 13.018 18 11.1615 18V18Z" fill="#3D3A3A" />
                            </svg>
                        </button>
                        <button type="submit" class="game-provider-submit sec-btn">
                            Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-3"  data-no-translation>
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


    <div class="group-item">
        <ul class="game-type-list">
            <li class="game-type-all" data-gameTypeSecondary=""><a href="javascript:void(0);" class="active-type">All<span class="type-count"><?php echo $total_games; ?></span></a></li>
            <?php
            if (isset($gameTypeSecondary)) {
                foreach ($gameTypeSecondary as $key => $type) {
                    if (!empty($type->name)) { ?>
                        <li data-gameTypeSecondary="<?php echo $type->name; ?>"><a href="javascript:void(0);"><?php echo $type->name; ?><span class="type-count"> <?php echo $type->gamesCount; ?></span></a>
                        </li> <?php
                    }
                }
            }
            ?>
        </ul>
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
    }else{?>
        <div class="text-center">
            <h4>No games found</h4>
        </div>
        <?php
    }
    ?>
</div>


<script src="<?php echo get_template_directory_uri() ?>/assets/js/casino-js.js"></script>
<?php get_footer(); ?>