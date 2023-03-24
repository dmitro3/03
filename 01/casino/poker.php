<?php

/**
 * Template Name: Poker Main Page
 *
 * Poker Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */

get_header();
get_sidebar();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/poker.css">
<?php
global $api_server_url;

$agere_games_url = $api_server_url . '/games/admin?action=available_games&token=' . agereToken() . '&casino=' . agereCasino() . '&page=1&provider=6 ';
$user = get_current_user_id();

try {
    $agere_raw_post = file_get_contents($agere_games_url);
} catch (Exception $e) {
    $agere_raw_post = 0;
}

$game = "";
$agere_raw_post = json_decode($agere_raw_post);
if (isset($agere_raw_post->response->games[0])) {
    $game = $agere_raw_post->response->games[0];
}

$game_id = $game->id;
$serverUrl = $game->serverUrl;
$gameUrl = $game->gameUrl;
$game_url = "";


if ($user == 0) {
    $get_demo_games = $serverUrl . '?token=' . agereToken() . '&currency=FUN&action=gameLoad&casino=' . agereCasino() . '&game_id=' . $game_id . '&mode=offline';
} else {
    $get_demo_games = $serverUrl . '?token=' . agereToken() . '&remote_id=' . $user . '&currency=USD&action=gameLoad&casino=' . agereCasino() . '&game_id=' . $game_id;
}

$get_demo_url_raw = file_get_contents($get_demo_games);

$get_demo_game_url_decoded = json_decode($get_demo_url_raw);


if ($get_demo_game_url_decoded->status == 200) {

    $add_balance = '&deposit=' . site_url() . '/my-account/wallet/add/';
    $game_url = $get_demo_game_url_decoded->result;

    if (!empty($game_url)) {
        $game_url =  $game_url . '' . $add_balance;
    }
}

if (!is_user_logged_in()) {
    echo "<h4 class='text-center'>To play the poker game user must be logged in and required permission to play the poker game</h4>";
}

if (is_user_logged_in()) {
    $user_permission = get_the_author_meta('user_play_permission', get_current_user_id());
    $role = get_user_by('ID', get_current_user_id());
    $role = $role->roles[0];
    if (stripos('poker', $user_permission) !== false || $role === 'administrator') {
?>
        <div class="poker-popup">
            <div class="picker_inner game-popup-inner">
                <a href="javascript:void(0)" class="full-screen" data-gameid="94" id="full-screen"><i class="fas fa-expand"></i></a>
                <iframe src="<?php echo $game_url; ?>" width="100%" title="Online Poker" id="pokerGame" class="poker-iframe"></iframe>
            </div>
        </div>
    <?php } else {
        echo "<h4 class='text-center'>You don't have permission to play the poker game, please contact your administrator</h4>";
    } ?>
<?php } ?>

<script src="https://client.pragmaticplaylive.net/desktop/assets/api/fullscreenApi.js"></script>

<script>
    /* Get into full screen */
    // function GoInFullscreen(element) {
    //     if (element.requestFullscreen) {
    //         jQuery(".picker_inner").addClass("mac-popup");
    //         console.log('mac-full _test');
    //         element.requestFullscreen();
    //     } else if (element.mozRequestFullScreen) {
    //         element.mozRequestFullScreen();
    //     } else if (element.webkitRequestFullscreen) {
    //         element.webkitRequestFullscreen();
    //     } else if (element.msRequestFullscreen) {
    //         element.msRequestFullscreen();
    //     } else {
    //         jQuery(".picker_inner").addClass("mac-popup");
    //         console.log('mac-full');
    //     }
    // }

    jQuery("#full-screen").on('click', function() {
        GoInFullscreen(jQuery(".picker_inner").get(0));
    });
    jQuery(document).ready(function() {
        update_balance_using_interval();
    });
</script>

<?php get_footer(); ?>