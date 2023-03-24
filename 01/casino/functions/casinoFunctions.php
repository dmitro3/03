<?php
function casino_agere_old_api($agere_raw_post){


    if (isset($agere_raw_post->response)) {
        $game_count = count($agere_raw_post
            ->response
            ->games);
    } else {
        $game_count = 0;
    }

    for ($x = 0; $x < $game_count; $x++) {
        $game_id = $agere_raw_post
            ->response
            ->games[$x]->id;
        $name = $agere_raw_post
            ->response
            ->games[$x]->name;
        $providerId = $agere_raw_post
            ->response
            ->games[$x]->providerId;
        $isDemo = $agere_raw_post
            ->response
            ->games[$x]->isDemo;
        $gameType = $agere_raw_post
            ->response
            ->games[$x]->gameType;
        $providerName = $agere_raw_post
            ->response
            ->games[$x]->providerName;

        $providerSecret = $agere_raw_post
            ->response
            ->games[$x]->providerSecret;
        $partnerClientId = $agere_raw_post
            ->response
            ->games[$x]->partnerClientId;
        $gameIcon = $agere_raw_post
            ->response
            ->games[$x]->gameIcon;
        $providerGameId = $agere_raw_post
            ->response
            ->games[$x]->providerGameId;
        $serverUrl = $agere_raw_post
            ->response
            ->games[$x]->serverUrl;
        $gameUrl = $agere_raw_post
            ->response
            ->games[$x]->gameUrl;

        if ($providerId == 6) {
            continue;
        }
        $tvbet = '';
        if ($providerId == 4) {
            $tvbet = '-is_tvbet';
        }

        $title = $agere_raw_post
            ->response
            ->games[$x]->name;

        $alt_img = '"' . $agere_raw_post
            ->response
            ->games[$x]->name . ' Slot Game"';

        $disabledbycasino = $agere_raw_post
            ->response
            ->games[$x]->disabledByCasino;
        //	echo "rajtest";
        if ($disabledbycasino == '') {
            ?>
            <div class='col-lg-2 col-md-4 col-sm-4 col-6 geek test'>
                <div class='game-img-box c430'>
                    <picture>
                        <source srcset="<?php echo $gameIcon; ?>" type="image/png"><img src="<?php echo $gameIcon; ?>"
                            alt="<?php echo $alt_img; ?>">

                        <div class='game-box-overlay'>
                            <h6><span class='game-title'><?php echo $title; ?></span><span class='sub-game-title'><?php echo $providerName; ?></span></h6>
                            <div class='game-link-wrap'>
                                <?php
                                if ($isDemo == 1) {

                                    echo "<a href='javascript:void(0);' data-gameid='" . $game_id . "' data-provider='" . $providerId . "' data-providerGameId='" . $providerGameId . "' data-casino='" . $partnerClientId . "' data-token='" . $providerSecret . "' data-server= '" . $serverUrl . "' data-gameURL='" . $gameUrl . "' data-url='' data-mode='offline'  class='game-url play-url-agere-game" . $tvbet . "'>Free Play </a>";
                                }

                                if (is_user_logged_in()) {
                                    echo "<a href='javascript:void(0);' data-url='' data-gameid='" . $game_id . "' data-provider='" . $providerId . "' data-providerGameId='" . $providerGameId . "' data-casino='" . $partnerClientId . "' data-token='" . $providerSecret . "' data-server= '" . $serverUrl . "' data-gameURL='" . $gameUrl . "' data-mode='online' data-type='" . $gameType . "' class='game-url play-url-agere-game" . $tvbet . "'>Real Money</a>";
                                } ?>
                            </div>
                        </div>
                    </picture>
                </div>
            </div>
            <?php
        }
    }
}
?>