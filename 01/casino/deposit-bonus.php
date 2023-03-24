<?php 
/**
 * Template Name: Deposit-Bonus Main Page
 *
 * Deposit-Bonus Main Page.
 *
 * @author Plutus
 * @since 1.0.0
 */
get_header(); 
get_sidebar(); ?>

<div class="col-xl-10 col-lg-10 col-md-6 col-sm-8 col-xs-8">
        <!-- Starts -->
            <div class="landing__item-promo clearfix"><a href="#"> <img
                        class="img img-responsive col-xs-12 col-sm-6" src="/wp-content/uploads/2018/10/sportsbetting-1.jpg"
                        alt="100% 1st Time Crypto Bonus" style="width: 100%;"></a>
                <div class="landing__item-info col-xs-12 col-sm-6" style="width: 160%;">
                    <h3>100% 1st Time Crypto Bonus</h3>
                    <p>If you have never made a deposit with Cryptocurrency before, sign-up using deposit code 100BTC
                         to receive a first-ever deposit bonus of 100% using either Bitcoin, Bitcoin Cash, Ethereum, DASH or Litecoin.</p>
                    <div class="landing__btn-box">
                        <a href="/my-account/wallet/add/" class="landing__item-btn btn btn-play">Deposit Now</a>
                        <a href="#" class="landing__item-btn btn btn-play" data-toggle="modal" data-target="#modal-cryptocurrency-bonus100">Terms
                            & Conditions</a>
                    </div>
                </div>
            </div>
    
            <!-- Starts modal-cryptocurrency-bonus -->
            <div class="modal fade" id="modal-cryptocurrency-bonus100" tabindex="-1" role="dialog" aria-labelledby="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Terms and Conditions</h4>
                        </div>
                        <div class="modal-body">
                            <p>100% 1st Time Crypto Bonus:</p>
                            <ol>
                                <li>This 100% Bonus is only valid on first-ever deposits via Bitcoin, Bitcoin Cash,
                                    Litecoin or DASH and can only be claimed once.</li>
                                <li>A MINIMUM deposit of 420.00 is required to qualify for the bonus. </li>
                                <li>The maximum bonus per deposit is $3,000.00. </li>
                                <li>There is a 20x rollover requirement associated with this bonus. </li>
                                <li> You must use any existing free plays already in your account before claiming any new
                                    free plays. </li>
                                <li>The free plays you earn are for the sportsbook. They cannot be used in the Racebook,
                                    Casino, Poker or Live Betting. </li>
                                <li>No withdrawals can be made within 30 days of claiming this promotion. </li>
                                <li> All free plays expire in 30 days unless otherwise stated. At the 30 day mark, any
                                    unused free plays will disappear from your account. </li>
                                <li> Sway7 reserves the right to alter or amend the terms and conditions of this
                                    promotion at any time without notice. </li>
                                <li>Please see Sway7's General Rules for additional terms and conditions, which
                                    apply to any and all promotions.
                                </li>
                            </ol>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ends modal-cryptocurrency-bonus -->
    
        </div>
        <!-- Ends -->
<?php
if (have_posts()):
  while (have_posts()) : the_post();
    the_content();
  endwhile;
else:
  echo '<p>Sorry, no posts matched your criteria.</p>';
endif;
?>		
<?php get_footer(); ?>
