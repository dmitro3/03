<?php

/**
 * Template Name: Active Bonus Template
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header();
get_sidebar();

global $api_server_url, $currency_symbol;
$remote_id = site_url( '/_'.get_current_user_id() );
$current_bonus = "{$api_server_url}/api/player-bonus/current-bonus?remote_id={$remote_id}&casino=".agereCasino();
// $current_bonus = "https://api.agere.games/api/player-bonus/current-bonus?remote_id=https://demo.urgentgames.com/_103&casino=63110e3fb1ad90a7278e8a36";
$current_bonus = file_get_contents($current_bonus);
$current_bonus = json_decode($current_bonus);
?>
<div class="inner-page-text">
    <div class="woocommerce-page woocommerce-myaccount-page">
        <div class="container">
            <div class="row m-auto justify-content-center">
                <div class="col-lg-6  text-center">
                    <h2 class="h2-title"><?php the_title(); ?></h2>
                </div>
            </div>

            <div class="active_bonus">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="active_bonus_box">
                            <h2 class="text-center">Bonus <i class="fas fa-percent"></i></h2>
                            <div class="active_bonus_content">
                                <?php if(isset($current_bonus->bonusInfo) && !empty($current_bonus->bonusInfo)) { ?>
                                    <?php foreach($current_bonus->bonusInfo as $bonus) { ?>
                                        <ul>
                                            <li>
                                                <label>Bonus name</label>
                                                <b><?php echo $bonus->bonusName; ?></b>
                                            </li>
                                            <li>
                                                <label>Bonus name</label>
                                                <b><?php echo $bonus->bonusCode; ?></b>
                                            </li>
                                            <li>
                                                <label>Bonus type</label>
                                                <b><?php echo $bonus->bonusType; ?></b>
                                            </li>
                                            <li>
                                                <label>Deposit Amount</label>
                                                <b><?php echo add_currency_symbol($bonus->depositAmount); ?></b>
                                            </li>
                                            <li>
                                                <label>Bonus amount</label>
                                                <b><?php echo add_currency_symbol($bonus->bonusAmount); ?></b>
                                            </li>
                                            <li>
                                                <label>Initial wagering requirements</label>
                                                <b><?php echo $bonus->initalWageringRequirement; ?></b>
                                            </li>
                                            <li>
                                                <label>Remaining wagering requirement</label>
                                                <b><?php echo $bonus->remainingWageringRequirement; ?></b>
                                            </li>
                                            <li>
                                                <label>Granted date</label>
                                                <b><?php echo date( 'd/m/Y H:i:s', strtotime($bonus->startDate) ); ?></b>
                                            </li>
                                            <li>
                                                <label>Expiry date </label>
                                                <b><?php echo date( 'd/m/Y H:i:s', strtotime($bonus->endDate) ); ?></b>
                                            </li>
                                            <li>
                                                <label>Status </label>
                                                <?php $bonus_status = $bonus->status ? 'active' : 'expired'; ?>
                                                <b><span class="bonus-status-<?php echo $bonus_status; ?>"><?php echo $bonus_status; ?></span></b>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                <!-- <div class="active_bonus_btn">
                                    <a href="#" class="sec_btn" title="forfeit">forfeit</a>
                                </div> -->
                                <?php } else { ?>
                                    <ul>
                                        <li>No active bonus found</li>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="active_bonus_form">
                            <h5>if you are eligible and have a bonus code for a bonus, please enter it below and click "submit".</h5>

                            <form id="active-bonus-code-form">
                                <div class="form_input_wp">
                                    <div class="form_bonus_input">
                                        <label><b>Bonus Code</b></label>
                                        <input type="text" class="form-input bonus-code-input">
                                        <p class="error-msg"></p>
                                        <p class="succuss-msg"></p>
                                    </div>

                                    <button type="submit" class="sec_btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>