<?php
/*
        Template Name: Welcome Bonus
         
        @refer https://millionclues.com/tutorials/custom-wordpress-register-login-page
        */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

global $wpdb, $user_ID;
$action  = (isset($_GET['action'])) ? $_GET['action'] : 0;

get_header();
get_sidebar();

?>

<div class="promotion_text">
    <h2>There are no ongoing promotions. We will update the campaign information as needed.</h2>
</div>

<!-- <div class="page-content-wrapper">
    <div class="bonus-banner-wp">
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
                                            <a class="sec-btn" href="<?php echo $slider_sub_button_link; ?>" title="<?php echo $slider_sub_button_text; ?>" target="_blank"><?php echo $slider_sub_button_text; ?></a>
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
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-wp text-center">
                    <a href="<?php echo site_url(); ?>/my-account/wallet/add/" class="button" title="Deposit Now">Deposit Now</a>
                </div>
                <div class="rich-text-body-content" data-version="v2">
                    <p>If you're looking for excitement, you've come to the right place. We're giving away $3,000 in Casino welcome bonuses, allowing you to explore our selection of over 300 entertaining slots and classic casino games.</p>
                    <p>The great news is that we'll be giving you three times the welcome. Claim the Casino Welcome Bonus with your first deposit and unlock up to $3000 in bonuses.</p>

                    <div class="table-responsive mb-5 mt-5">
                        <table class="custom_table" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>Bonus Code</th>
                                    <th>Bonus Amount</th>
                                    <th>Number of Redemptions</th>
                                    <th>Rollover Requirements</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>WELCOME100</span></td>
                                    <td>100% Match Bonus up to $1,000</span></td>
                                    <td>1X </span></td>
                                    <td>25X </span></td>
                                </tr>
                                <tr>
                                    <td>BTC100 </span></td>
                                    <td>100% Reload Bonus up to $1000</span></td>
                                    <td>2X</span></td>
                                    <td>25X</span></td>
                                </tr>

                                <tr>
                                    <td>RELOAD </span></td>
                                    <td>25% Reload Bonus up to $1000</span></td>
                                    <td>2X</span></td>
                                    <td>10X</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ol>
                        <li>Go to <a href="<?php echo site_url(); ?>/register/" rel="noopener">sway7</a> and open an account.</li>
                        <li>Redeem the Casino Welcome bonus on your first deposit.</li>
                        <li>Instantly collect your bonus</li>
                    </ol>
                    <p>If you're looking to try all the casino games we have on offer, redeem your code and get ready for serious casino action.</p>
                    <h3 class="h3-heading">Terms and Conditions</h3>
                    <p>The $1000 Casino Welcome Bonus ("Promotion") is valid from February 3, 2017 at 00:00:01 AM ET.</p>
                    <p>Casino Welcome Bonus</p>
                    <ul>
                        <li>The Promotion consists of one (1) 100% match bonuses up to $1000 followed by two (2) 100% match bonuses up to $1000.</li>
                        <li>The Casino Welcome Bonus must be claimed upon first deposit in order to unlock the subsequent Casino Welcome bonuses.</li>
                        <li>Only activity following the bonus code redemption counts towards fulfilling the rollover requirements.</li>
                        <li>The deposit plus bonus amount is subject to a 25X playthrough requirement before the deposit, bonus amount and any winnings can be withdrawn.</li>
                        <li>Forfeiting this bonus will result in this bonus and any subsequent winnings associated with this bonus to be removed.</li>
                        <li>Bonus funds cannot be used for play on Live Dealer games.</li>
                        <li>Craps and Live Dealer play do not count toward meeting rollover requirements for withdrawal.</li>
                        <li>All games, except Craps and Live Dealer, contribute towards playthrough requirements; however, certain games may have a greater contribution than others. For more information please view our wagering contribution chart.</li>
                    </ul>
                    <h3 class="h3-heading">General Terms and Conditions</h3>
                    <ul>
                        <li>The general rules and policies of <a href="<?php echo site_url(); ?>/" target="_self" rel="noopener"><?php echo site_url(); ?>/</a> shall also apply to the Promotion.</li>
                        <li>Sway7 has the right to cancel or withdraw the Promotion or change any of its terms at any time and without cause or notice.</li>
                    </ul>
                    <p>If you have any questions regarding the Promotion, please contact <a href="mailto:Info@Sway7.com">Info@Sway7.com</a>.</p>
                    <div class="btn-wp text-center">
                        <a href="<?php echo site_url(); ?>/my-account/wallet/add/" class="button" title="Deposit Now">Deposit Now</a>
                    </div>

                    <p> 100% Welcome Bonus Must use Promo Code WELCOME100 in the cashier to claim this 100% Welcome Bonus. Only new Sway7 accounts are eligible for this Welcome Bonus. This Bonus can only be claimed once per customer. Promo expires December 31st at 11:59 pm ET. Bonus requires a minimum deposit of $100. Bonus is valid for a maximum $1,000 Bonus has a 25x Rollover.</p>

                    <p> 25% Reload Bonus This 25% Reload Bonus is valid on every qualifying deposit via Cryptocurrency. A MINIMUM deposit of $50.00 is required to qualify for the bonus. The maximum bonus per deposit is $250.00. There is a 10x (ten time) rollover requirement associated with this bonus. In order to receive a bonus you must use Promo Code RELOAD in the cashier while making your deposit. The free plays you earn are for the casino. They cannot be used in the Racebook, Casino, Poker or Live Betting. Sway7 reserves the right to alter or amend the Terms and Conditions of this promotion at any time without notice.</p>

                    <p> 100% Cryptocurrency Only Bonus This 100% Cryptocurrency-Only Deposit Bonus is valid on every qualifying deposit via Cryptocurrency. This bonus is only available in the casino. This bonus is only available on your first three Cryptocurrency deposits. Minimum deposit to receive this bonus is $50. Maximum bonus per deposit is $1,000. Players are required to use the related bonus code in order to receive this bonus. The deposit plus bonus amount is subject to 25X play through requirement before the deposit, bonus amount and any winnings can be withdrawn. All bonus amounts are subject to wagering requirements before any winnings can be issued or withdrawn. Please note that some games in the casino may contribute to different percentages on wagering requirements. Please refer to table below:</p>

                    <p> In cases where rollover or other criteria as set out in individual bonus Terms and Conditions are not met within 30 days of the initial bonus redemption, any remaining bonus funds and associated winnings will be forfeited. Any action on Craps, Specialty games, Virtual Racebook or Games with Progressive Jackpots will not count towards the bonus rollover. Play through requirements must be met before future, additional bonuses can be granted. Standard terms and conditions apply.</p>

                    <p> 150% Agora Bonus Must use Promo Code AGORA150 in the cashier to claim this 150% Welcome Bonus. This Bonus can only be claimed once per customer. Promo expires December 31st at 11:59 pm ET. Bonus requires a minimum deposit of $100. Bonus is valid for a maximum $1,500 Bonus has a 40x Rollover.</p>

                    <div class="table-responsive mt-5">
                        <table class="custom_table" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th colspan="2" style="text-align: center;"><b>Bonus Contribution Table</b></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Game Types</td>
                                    <td>Percent contribution to Bonus Rollover</td>
                                </tr>
                                <tr>
                                    <td>Slot Games (progressive jackpo t slots excluded)</td>
                                    <td>100%</td>
                                </tr>
                                <tr>
                                    <td>"Roulette (All versions), Draw High-Lo, 3 Card Rummy"</td>
                                    <td>20%</td>
                                </tr>
                                <tr>
                                    <td>"Baccarat, Blackjack (American & European), Poker 3, Oasis Poker, Single Deck Blackjack, Triple Edge Poker, Caribbean Poker, Three Card Poker, Video Poker"</td>
                                    <td>10%</td>
                                </tr>
                                <tr>
                                    <td>"Pirate 21, Blackjack Super 7, Pai Gow, 21 Burn, All forms of Keno, Red Dog, Pontoon, Top Card Trumps"</td>
                                    <td>5%</td>
                                </tr>
                                <tr>
                                    <td>"Craps, Live Casino, All Games with Progressive Jackpo ts, Ride'm Poker, Virtual Racebook.Speciality games ie Keno's and Scratcher game offered by Betsoft"</td>
                                    <td>0%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->


<?php get_footer(); ?>