<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/betting.css">
<?php
$i = 0;
global $woocommerce;
$items = $woocommerce->cart->get_cart();
$post_date = '';
$unique_items = (WC()->cart->get_cart_contents_count());
$item_count = count($items);
/*echo $item_count;*/
?>
<div class = "betting_slip">
    <table id = "title_bar" class="betting-bid-box">
        <tr>
            <td>Your selections</td>
            <td>Risk</td>
            <td>To Win</td>
        </tr>
    </table>
    <div id = "main_container">
        <?php
        $order_details = "";

        if (isset($_POST['submit'])) {
            $risk = $_POST['risk'];
            $win = $_POST['win'];
            $risk_total = $_POST['risk_total'];
            $win_total = $_POST['win_total'];
            if (isset($_POST['confirmBet'])) {
                if (isset($_POST['confirmBet'])) {
                    $order_details = instantOrder($item_count, $risk, $win, $risk_total, $win_total);
                }
            } else {
                $order_details = 'Please confirm  your bet/s.';
            }
        }

        if (is_user_logged_in() && ($item_count == 0)) {
            ?>
            <div id="empty_message">
                Your betslip is empty. <br/> You can add selections by clicking on the green odds buttons.
            </div>
            <?php
        }

        ?>
        <div class="bet-main-content" id="main_content">

            <?php
            if (is_user_logged_in() && ($item_count > 0) && $order_details != "Bet successfully placed.") {
                $admin_url = site_url() . '/wp-admin/admin-ajax.php';
                ?>
                <form id="frm" method="post">
                    <ul>
                        <?php
                        $i = 0;
                        foreach ($items as $item => $values) {
                            //var_dump($values);
                            if (isset($values['custom_data']['name'])) {
                                $name = $values['custom_data']['name'];
                                if (strlen($name) > 23) {
                                    $name = substr($name, 0, 20) . '...';
                                }
                                //$name = strstr($name, ")", true);
                                $product_name[$i] = $name;
                            } else {
                                $product = wc_get_product($values['data']->get_id());
                                $product_name[] = $product->get_name();
                            }
                            if (isset($values['custom_data']['totals']))        {      $totals[$i]  = $values['custom_data']['totals'];     }
                            if (isset($values['custom_data']['contestant']))    {  $contestant[$i]  = $values['custom_data']['contestant']; }
                            if (isset($values['custom_data']['propline']))      {    $propline[$i]  = $values['custom_data']['propline'];   }
                            if (isset($values['custom_data']['spreads']))       {     $spreads[$i]  = $values['custom_data']['spreads'];    }
                            if (isset($values['custom_data']['moneyline']))     {   $moneyline[$i]  = $values['custom_data']['moneyline'];  }
                            if (isset($values['custom_data']['teamtotal']))     {   $teamtotal[$i]  = $values['custom_data']['teamtotal'];  }
                            $key[$i] = $values['key'];

                            ?>
                            <li>
                                <div class = "left_side">

                                    <?php
                                    echo '<span class="close">' . apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="close" title="%s">&times;</a>', esc_url(wc_get_cart_remove_url($key[$i])), __('Remove this item', 'woocommerce')), $key[$i]);
                                    echo '</span>';
                                    $juice_final = 0;

                                    if ($product_name[$i] == "Increase Account Balance") {
                                        echo "<b>" . $product_name[$i] . '</b>';
                                        echo '<span id="subtitle"> Amount: ' . $values['quantity'] . '</span><br/>';
                                    } elseif ($product_name[$i] == "Wallet Topup") {
                                        ?>
                                        <b>Deposit Bitcoin</b><br/>
                                        <span id="subtitle"> Bitcoin Reload: <?php echo $values['recharge_amount']; ?></span><br/>

                                        <?php                                       
                                    } else {
                                

                                        if (isset($product_name[$i])) {
                                            echo "<span>" . $product_name[$i] . '</span><br/>'; //name
                                        }
                                        if (isset($totals[$i])) {
                                            echo '<span id="subtitle"> Total Points: ' . $totals[$i] . '</span><br/>';
                                            $juice_final = $totals[$i];
                                            $juice_final = strstr($totals[$i], ' ');
                                        }
                                        if (isset($propline[$i])) {
                                            echo '<span id="subtitle"> ' . $contestant[$i] . ' : ' . $propline[$i] . '</span><br/>';
                                            $juice_final = strstr($propline[$i], ' ');
                                        }
                                        if (isset($teamtotal[$i])) {
                                            echo '<span id="subtitle"> Team Totals: ' . $teamtotal[$i] . '</span><br/>';
                                            $juice_final = $teamtotal[$i];
                                            $juice_final = strstr($teamtotal[$i], ' ');
                                        }
                                        if (isset($spreads[$i])) {
                                            echo '<span id="subtitle"> Spread: ' . $spreads[$i] . '</span><br/>';
                                            $juice_final = $spreads[$i];
                                            $juice_final = strstr($spreads[$i], ' ');
                                            //echo $juice_final;
                                        }
                                        if (isset($moneyline[$i])) {
                                            echo '<span id="subtitle"> Money Line: ' . $moneyline[$i] . '</span><br/>';
                                            $juice_final = $moneyline[$i];
                                        }                    
                   
                                    } 
                                    ?>
                                </div>
                                <div class = "right_side" data-juice='<?php echo $juice_final; ?>'>
                                    <input class ="risk_input  risk_input_<?php echo $i; ?>" type="text" maxlength="9" name="risk[]" method="post"> <input class="stake_input stake_input_<?php echo $i; ?>" type="text" name="win[]" maxlength="9">
                                   
                                </div>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>
                    </ul>           
                    <div id ="button_background">
                        <a id = "remove_button"  ajax-url="<?php echo $admin_url; ?>" onclick="replace()">Remove all</a>
                    </div>

                    <div id = "total_winnings">Winnings: &#36;<span id="total">0.00</span></div>
                    <div id = "total_value">
                        Risk: &#36;<span id="risk">0.00</span>
                    </div>
                    <div id = "confirm" class="confirm-box">
                        <input type="checkbox" name="confirmBet"><label style="color:white;" for="confirmBet">Confirm Bets</label>
                    </div>


                    <input type="hidden"  id="risk_total" name="risk_total" />
                    <input type="hidden" id="win_total" name="win_total" />
                    <button type="button" class="btn btn-info btn-lg conform-modal-btn" >Place Bets</button>
                    <input type="submit" value="Place Bets" id="place_bet" name="submit" />
                </form>

                <?php
            }
            echo "<span class='order_notice'>" .    $order_details . "</span>";
            echo "<span class='order_notice confirm_error'>Please confirm  your bet/s.</span>";

            /*User logged in and cart has more then one item*/
            if (is_user_logged_in() <> 1) {
                ?>
                <div id = "login_alert">Please login before placing your bets</div>
                <?php
            }
            ?>
        </div>
    </div>
</div>




<!-- Modal -->
<div id="myModal" class="modal fade conform-bid-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Confirm Bets</h4>
            <div class="modal-body">
                <?php
                $i = 0;
                global $woocommerce;
                $items = $woocommerce->cart->get_cart();
                $post_date = '';
                $unique_items = (WC()->cart->get_cart_contents_count());
                $item_count = count($items);
                ?>
                <div class="betting_slip betting-bid-box" style="position: unset;">
                    <table>
                        <tr>
                            <td>Your selections</td>
                            <td>Risk</td>
                            <td>To Win</td>
                        </tr>
                    </table>
                    <div id="main_container">


                        <div class="bet-main-content" id="main_content">
                            <?php

                            if (is_user_logged_in() && ($item_count > 0) && $order_details != "Bet successfully placed.") {
                                $admin_url = site_url() . '/wp-admin/admin-ajax.php';
                            ?>


                                <form class="modal-form" method="post">
                                    <ul>

                                    </ul>
                                    <div id="button_background">
                                        <a id="remove_button" ajax-url="<?php echo $admin_url; ?>" onclick="replace()">Remove all</a>
                                    </div>

                                    <div id="total_winnings">
                                        Winnings: &#36;<span id="total">0.00</span>
                                    </div>

                                    <div id="total_value">
                                        Risk: &#36;<span id="risk">0.00</span>
                                    </div>

                                    <div id="confirm">
                                        <input type="checkbox" name="confirmBet"><label style="color:white;" for="confirmBet">Confirm Bets</label>
                                    </div>
                                    <input type="button" value="Place Bets" id="confirm_bets" class="btn" name="submit" />

                                </form>

                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/assets/js/betting.js?fgdfggdf"></script>

<script>
    jQuery("body").on("click", ".conform-modal-btn", function() {


        if (jQuery("body .confirm-box input[name=confirmBet]").is(":checked")) {
            
            jQuery("#myModal .order_notice").hide();
            var fomr_ul = jQuery("#frm ul").html();
            jQuery(".modal-form ul").html(fomr_ul);

            jQuery('body #frm ul li').each(function(index, currentElement) {

                var risk_input_val = jQuery(".risk_input_" + index).val();
                jQuery("#myModal .risk_input_" + index).val(risk_input_val);
                var stake_input_val = jQuery(".stake_input_" + index).val();
                jQuery("#myModal .stake_input_" + index).val(stake_input_val);

                var total_value = jQuery("#total_value").html();
                var total_winnings = jQuery("#total_winnings").html();

                jQuery("#myModal #total_value").html(total_value);
                jQuery("#myModal #total_winnings").html(total_winnings);


            });

            jQuery("#myModal input[type=text]").attr('readonly', 'readonly');
            jQuery(".confirm_error").hide();
            jQuery('#myModal').modal('show');
        } else {
            jQuery(".confirm_error").show();
        }


    });


    jQuery('body #myModal input[name=confirmBet]').change(function() {
        if (jQuery(this).is(":checked")) {
            jQuery(".confirm-box input[name=confirmBet]").attr("checked", "checked");

        }
    });

    jQuery("body #myModal #confirm_bets").on("click", function() {
            jQuery("#place_bet").trigger("click");
        // if (jQuery("body #myModal input[name=confirmBet]").is(":checked")) {
        //     jQuery("#myModal .order_notice").hide();
        // } else {
        //     jQuery("#myModal .order_notice").show();
        // }
    });
</script>