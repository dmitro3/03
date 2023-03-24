<?php

/**
 * Template Name: Sports betting
 *
 * Sports Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */

get_header();
get_sidebar();

// $order = wc_get_order( 753654   ); 
// $order_id=$order->get_id();
// $testObject = new Woo_Wallet_Wallet();


// echo $testObject->wallet_credit_purchase($order_id);

// die;
// echo get_post_meta($order_id, '_wc_wallet_purchase_credited', true);
// if (is_wallet_rechargeable_order($order)) {
// echo "yes";
// }

// die;
// echo "<pre/>";
// print_r(wp_get_schedules());
// Get 10 most recent order ids in date descending order.
$query = new WC_Order_Query( array(
    'limit' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'return' => 'ids',
    'status' => array('wc-on-hold'),
) );
$data = $query->get_orders();

foreach($data  as $order_id)
{   echo $order_id;
    $order = wc_get_order( $order_id ); 
    echo  $order->get_status();

    die;
}
echo "</pre>";
print_r($orders);
echo "<pre>";

  die;


$order = wc_get_order( 753653  ); 
echo $order_status  = $order->get_status();

$order->update_status( 'completed' );

echo $order_status  = $order->get_status();

global $api_server_url;

$user = get_current_user_id();
$agere_games_url = $api_server_url . '/providers/betconstruct-423539527853/?token=' . agereToken() . '&currency=USD&action=gameLoad&casino=' . agereCasino() . '&remote_id=' . $user . '&language=' . selected_language();

try {
    $all_game_data = file_get_contents($agere_games_url);
} catch (Exception $e) {
    $all_game_data = 0;
}

$all_game_data = json_decode($all_game_data);

$token = "";
if (isset($all_game_data->status) && $all_game_data->status == 200) {
    $token = $all_game_data->result;
    $language = $all_game_data->language;
}

?>
<script src="https://client.pragmaticplaylive.net/desktop/assets/api/fullscreenApi.js"></script>
<script>
    var sport_domain = 'https://sportsbook.urgentgames.com';
    if (window.innerHeight > window.innerWidth) {
        sport_domain = 'https://mobile.urgentgames.com';

    }
    var sport_link = sport_domain + "/js/partnerinit.js?containerID=bcsportsbookcontainer&callbackName=bettingCB&oddsType=decimal&type=prematch&UserId=<?php echo $user; ?>&AuthToken=<?php echo $token; ?>&lang=<?php echo $language; ?>&sport=852&region=327693";
    var script = document.createElement('script');
    script.setAttribute('src', sport_link);
    script.setAttribute('id', 'bcsportsbook');
    document.body.appendChild(script);
</script>
<script>
    window.addEventListener("message", (event) => {

        if (event.data.type === "deposit") {

            window.location.href = "<?php echo site_url(); ?>/my-account/wallet/add/";
        }
    }, false);
</script>
<div class="sports_betting_iframe poker-popup ">
    <div class="picker_inner game-popup-inner">
        <a href="javascript:void(0)" class="full-screen" data-gameid="94" id="full-screen"><i class="fas fa-expand"></i></a>
        <div id="bcsportsbookcontainer"></div>
    </div>
</div>

<script>
    jQuery("#full-screen").on('click', function() {
        GoInFullscreen(jQuery(".picker_inner").get(0));
    });
</script>

<?php
get_footer();