<?php $instagram_link = get_field('instagram_link', 'option');
$facebook_link = get_field('facebook_link', 'option');
$twitter_link = get_field('twitter_link', 'option');
$linkedin_link = get_field('linkedin_link', 'option');
?>
<!-- <div class="loader-wrap">
   <div class="loader-container">
      <div class="dot dot-1"></div>
      <div class="dot dot-2"></div>
      <div class="dot dot-3"></div>
   </div>
   <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
      <defs>
         <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
            <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"></feColorMatrix>
         </filter>
      </defs>
   </svg>
</div> -->
</div>
<div class="footer_wp">
    <footer class="footer">
        
       
        <!-- Footer Menu  Start-->
       <?php
        //  wp_nav_menu(array(
        //     'theme_location' => 'footer',
        //     // 'container' => '',
        //     'menu_class' => 'menu foote_bottom_ul_amrc',
        // ));?>
       
        <!-- Footer Menu  End-->
        <?php /*
        <ul class="foote_bottom_ul_amrc">
            <li><a href="<?php echo site_url(); ?>/">Home</a></li>
            <li><a href="<?php echo site_url(); ?>/casino/">Casino</a></li>
            <li><a href="<?php echo site_url(); ?>/my-account/wallet/add/">My Account</a></li>
            <li><a href="javascript:void(Tawk_API.toggle())">Contact</a></li>
            <li><a href="<?php echo site_url(); ?>/blog/">Blog</a></li>
        </ul> */ ?>
        
        
        <?php
         wp_nav_menu(array(
            'theme_location' => 'information',
            // 'container' => '',
            'menu_class' => 'menu foote_bottom_ul_amrc',
        ));?>
        <!-- disclaimer  -->
        <?php the_field('disclaimer', 'option');?>        

<a href="https://verification.curacao-egaming.com/validateview.aspx?domain=casinoterra.io" target="_blank">
    <img src="https://verification.curacao-egaming.com/validate.ashx?domain=casinoterra.io" alt="" width="100" />
</a>

        <div class="methods-social d-flex align-items-center justify-content-between flex-wrap">
            <!-- PAYMENT METHODS -->            
            <div class="methods">
                <p>payment mathods</p>
                <ul>
                    <?php

                    // Check rows existexists.
                    if( have_rows('payment_methods', 'option') ){

                        // Loop through rows.
                        while( have_rows('payment_methods', 'option') ) {
                            the_row();?>
                            <li>
                                <img src="<?php the_sub_field('image'); ?>" width="26" height="26" alt="btc Icon">
                                <!-- <a href="javascript:void(0);">
                                </a> -->
                            </li>
                            <?php
                        }
                    }?>
                   
                </ul>
            </div>

            <!-- FOOTER SOCIAL -->
            <div class="social-footer-wp">
                <p>Follow us</p>
                <ul class="social_footer_ul">
                    <li>
                        <img width="26" height="26" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/facebook_icon.svg" alt="FaceBook Icon">
                        <!-- <a href="<?php echo $facebook_link; ?>" target="_blank">
                        </a> -->
                    </li>
                    <li>
                        <img width="26" height="26" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/twitter_icon.svg" alt="Twitter Icon">
                        <!-- <a href="<?php echo $twitter_link; ?>" target="_blank">
                        </a> -->
                    </li>
                    <li>
                        <img width="26" height="26" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/instagram_icon.svg" alt="Instagram Icon">
                        <!-- <a href="<?php echo $instagram_link; ?>" target="_blank">
                        </a> -->
                    </li>
                    <li>
                        <img width="26" height="26" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/linkedin_icon.svg" alt="Linkedin Icon">
                        <!-- <a href="<?php echo $linkedin_link; ?>" target="_blank">
                        </a> -->
                    </li>
                </ul>
            </div>
        </div>

        <!-- COPYRIGHT TEXT -->
        <p class="copyright-text"><span class="d-lg-inline d-block">Copyright @<?php echo date("Y"); ?></span> <span class="d-lg-inline d-none">|</span> Rights Reserved <a href="/"><?php echo get_bloginfo('name'); ?></a></p>
        
    </footer>
</div>
<div class="cusino-video-popup  <?php if (get_field('enabledisable_popup', 'option') != "Enable") {
                                    echo 'popup-disable  d-none';
                                } ?>">
    <div class="cusino-video-popup-box">
        <span class="video-close-icon"></span>
        <iframe width="640" height="360" src="<?php the_field('popup_video_link', 'option') ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
<!-- Change Password Popup Start -->
<div class="common-popup sm" id="change-password">
    <div class="common-popup-box">
        <div class="common-popup-title">
            <p>Change Password</p>
            <span class="popup-close-icon"></span>
        </div>
        <div class="common-popup-content">
            <div class="common-popup-content-text">
                <form id="pwd-change-from">
                    <div class="form-row">
                        <label>New Password</label>
                        <input type="password" name="password" class="input-text" id="ch_pwd" required>
                    </div>
                    <div class="form-row">
                        <label>Enter Again</label>
                        <input type="password" name="password_confirm" class="input-text" id="ch_confirm_pwd" required>
                    </div>
                    <div class="form-row">
                        <!-- <button class="sec-btn">Cancel</button> -->
                        <button type="submit" class="sec-btn">To Accept</button>
                        <span class="loader-box"><i class="fas fa-spinner fa-spin change-pass-loader" aria-hidden="true"></i></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Change Password Popup End -->
<!-- Change Language Popup Start -->
<div class="common-popup sm" id="change-language">
    <div class="common-popup-box">
        <div class="common-popup-title">
            <p>Change Language</p>
            <span class="popup-close-icon"></span>
        </div>
        <div class="common-popup-content">
            <div class="common-popup-content-text">
                <div class="lang-switcher">
                    <?php echo do_shortcode('[language-switcher]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Change Language Popup End -->
<!-- Sports Regulations Popup Start -->
<div class="common-popup" id="sports-regulations">
    <div class="common-popup-box">
        <div class="common-popup-title">
            <p>Sports Regulations</p>
            <span class="popup-close-icon"></span>
        </div>
        <div class="common-popup-content">
            <div class="common-popup-content-text">
                <div class="sports-regulations-content">
                    <h4>Betting Regulations</h4>
                    <p>The following specific rules govern the customer's use of all interactive sports betting products and services offered on the website or mobile portals.</p>
                    <p>They form part of the Operator's General Terms and Conditions, which apply to all betting and interactive products and services that the Operator offers to persons who register or hold a betting account (the "End User") with the operator.</p>
                    <p>To the extent there is any inconsistency between the General Terms and Conditions and any of these Sports Betting Rules, the General Terms and Conditions shall prevail.</p>
                    <p>The reference language for the current betting rules is English. Notwithstanding the care given to our translations, in the event of any discrepancy between the meanings of the translated versions of these betting rules and the English version, the meaning of the English version shall prevail.</p>
                    <h4>1. General betting rules</h4>
                    <h6>1.1 General</h6>
                    <p>1.1.1 All betting information provided by the Company is done in good faith. However, the Company cannot accept responsibility for errors or omissions with respect to dates, times, locations, competitors, odds, results, statistics or other wagering information. The Company maintains its prerogative to rectify any apparent errors and shall take all equitable steps to ensure that the markets are handled fairly and clearly. The Company maintains its prerogative to have the final decision.</p>
                    <p>1.1.2 If an event, which is defined as an organized sporting match or event between two teams or between individuals, starts before the scheduled time, then only bets placed before the start of the event will be considered valid (this excludes bets on live specified) . The Company reserves the right to void all bets placed after the actual start time in the event that a Market is not closed or suspended at the correct time (this excludes specified live bets).</p>
                    <p>1.1.3 If there appears to be an inconsistency between the English and non-English names used in events displayed on the Website, the English version shall be taken as the reference.</p>
                    <p>1.1.4 It is the sole responsibility of the client to know the match score and all information related to the event at all times. It is highly recommended that the customer check the status of the match before placing a bet.</p>
                    <p>1.1.5 It is the Company's reserved right to amend these Rules at any time for any reason. Any such change will be deemed binding and effective from the time it is posted on the Website.</p>
                    <p>1.1.6 The Client acknowledges the fact that all data displayed on the Website may be subject to delay or may be inaccurate, and placing bets based on such data is the Client's responsibility. The Company does not provide any guarantee as to the accuracy, completeness or timeliness of such data, and the Company assumes no responsibility for any loss (direct or indirect) suffered by the client as a result of activity based on it.</p>
                    <h6>1.2 Abandonment and Rescheduling</h6>
                    <p>1.2.1 If an event does not start or finish according to the scheduled date for both occasions previously announced in the sports specific rules, all bets will be canceled, except those on Markets that have been settled.</p>
                    <p>1.2.2. If an event starts according to its scheduled date and time, but is later abandoned or suspended and not completed within the time frame defined above, only the bets considered valid will be those that have been settled in the markets, while the rest will be cancelled.</p>
                    <p>1.2.3. If an Event is not completed within the prescribed time period in accordance with the specific sports rules, or an official result is declared or a result is declared by the relevant sports body regulating the Event, the Company reserves the right to void the Event, and The decision of the company is considered final.</p>
                    <h6>1.3 Change of venue</h6>
                    <p>1.3.1 Unless a change of venue is handled in the Event Specific Betting Rules, then:</p>
                    <p>1.3.1.1. In the event of a change of venue (home team plays away or vice versa), all bets on the match will be void.</p>
                    <p>1.3.1.2. All bets on non-team events will be considered valid in the event of a change of venue after the market has already opened.</p>
                    <h6>1.4. Periods of time</h6>
                    <p>1.4.1. If there is a change in the duration of the event. All bets placed on such an event will be considered void.</p>
                    <p>1.4.2. All events that have occurred during extra time or stoppage time are considered to be during normal time, for example, a goal scored in the first extra period of a football match is considered to have been scored in the 45 minutes.*</p>
                    <h6>1.5. Results</h6>
                    <p>1.5.1. Where appropriate, the podium positions will be considered as the final result, without taking into account any disqualifications or future corrections of the result. If there is no podium ceremony, the results will be determined according to the official result of the relevant governing body at the time of Market settlement, notwithstanding any subsequent disqualification or modification of the results. In the event that no official result is available, the result will be determined by reference to the available evidence known at the time of Market settlement.</p>
                    <p>1.5.2 All Markets are generally settled only after an Event has concluded. Simply as a service to the client, some markets may be liquidated before the official result is declared. The Company reserves the right to reverse any liquidation made due to a Market being resolved in error.</p>
                    <p>1.5.3. The Company reserves the right to suspend settlement in any market if uncertainty arises as to any result.</p>
                    <p>1.5.4. The Company will not recognize any amendment or change in results made 72 hours after the start time of the Event, for bets that have already been settled.</p>
                    <p>1.5.5. If a contradiction appears between the official result and the results displayed in the results section on the website, the matter will be resolved using the Company's video materials of the event in question as a reference to define the exact result. However, if there is no such video material of the event in question, then the exact result will be determined in relation to the result of the governing body of the mentioned event as stated on the official website. If the official website cannot provide the result or the published result of the official website is manifestly incorrect, then the Company reserves the right to make decisions/amendments to determine the final result. The Company's decision is final and binding in this regard.</p>
                    <h4>2. The markets</h4>
                    <h6>2.1. General</h6>
                    <p>2.1.1. Long term betting - betting on the winner of an event, race or tournament. A long term bet involves the selection of a winner in a tournament, competition, league or event, either from the start or at any stage of the tournament, competition, league or event before the conclusion of the competition where the results are not yet they are determined. The number of places that are paid as winners will be indicated in the title of the Market. If one of the opponents/players does not start an event, race or tournament, all 'open' bets from the above will be void. If the winners are two or more, or a 'Dead Heat' is declared in any Open Market,</p>
                    <p>2.1.2. Bet on One: Bet on one of the opponents/teams to be the winner in an event or to get a higher score in an event. The rest of the rules of the bet on one can be found in the betting rules of the specific event. The expression 'The Field' relates to all competitors other than those specified in the bet to one comparison.</p>
                    <p>2.1.3. Handicap (HDP): Handicap means betting when a competitor or team receives a virtual advantage (effectively leading that advantage before the Event begins). The winner is the competitor or team with the best score after adding the given handicap to the result.</p>
                    <p>2.1.4. Asian Handicap (In-Play) - All bets placed on Asian Handicap for an in-play market are settled according to the score shown for the event/half surplus, after the bet has been placed - Any Goal, Scored before the bet placed is not taken into account.</p>
                    <p>2.1.5. Over/Under: This type of bet gives a player the chance to bet on a number of goals (games, etc.). Bets are settled based on the total sum of points/goals etc. achieved (resulting in a result over or under the number of goals set by the Operator) in a match or series of matches on which the bets were placed.</p>
                    <p>2.1.6. Odd/Even: Bets relate to the total sum of the points (goals) played in the match resulting in an odd or even number.</p>
                    <p>2.1.7. Multiple bets: The multiple bet represents a unification of selections (minimum two), combined in one bet. For this type of bet to gain a winning status, all included selections would need to be correctly predicted. If one (or more) selections are lost, the multiple bet is also lost. If one (or more) selections are suspended, the odds for the aforementioned selections will be repeated at 1.00. Please contact the betting glossary if you require a more detailed explanation of multiples. Please note that the page contains general information, not an explanation of each term.</p>
                    <p>2.1.8 System bets. The system bet is very similar to a multiple bet. It represents a count of selections and, despite multiple bets, not all selections included in a system bet need to be correctly predicted for you to win the bet. System bets are generally placed at higher odds with larger bets to guarantee a good profit, regardless of the fact that the player may have a couple of losing selections. Calculating prosperous returns is usually not too complicated, but in some situations bettors may require the assistance of a betting calculator when dealing with more complex system bets.</p>
                    <h6>2.2. Types of soccer bets</h6>
                    <p>Unless stated differently, the outcome of a bet on a football game relates to the end of regular time in which the bet was placed (also counting any stoppage or injury time added by the official referee). Extra time and penalties are not included.</p>
                    <p>2.2.1. 1X2 as a type of bet gives a player the possibility to bet on either: the first, (most commonly the home team) winner; X - the result of the game in a draw; or 2 - the second, (usually the away team) winner.</p>
                    <p>2.2.2. Correct Score: Bets are placed by predicting the correct result or score at the end of the match or event offered for betting. Correct score to win “5-0UP” (or 0-5UP) the selected team must win by five or more goals.</p>
                    <p>2.2.3. Total Goals: Total Goals bets involve predicting the total goals or points accumulated in a match on which the bets were placed.</p>
                    <p>2.2.4. Half Time / Full Time (HT / FT): Bets to predict the half time result and the full time result of an event (excluding extra time and penalties). Regarding this market, H is related to the first team named in the event (usually the local team); D relates to a tie; A relates to the second named team in the event (usually the away team). For example, HA means that the first team named in the event (the home team) will take the lead at half-time and the second team named in the event (the away team) will take the lead at full time.</p>
                    <p>2.2.5. First Goal / Last Goal: Bets on which team will score the first or last goal in an event. Regarding this market, HF relates to the first team named in the event (usually the home team) that scores the first goal. HL relates to the first named team in the event that scored the last goal. AF relates to the second named team in the event (usually the away team) that scores the first goal. AL relates to the second team named in the event that scored the last goal. No Goal (No Goals) (NG) No goals have been scored during the specific event. Own goals are assigned to the team awarded the goal. If an event is abandoned, after a goal is scored, all bets placed on '1st Goal' and 'No Goal' will stand, all bets on 'Last Goal' will be cancelled. If an event is abandoned without a goal being scored, all bets on First Goal, Last Goal and No Goal will be considered void.</p>
                    <p>2.2.6. Which Team Starts: Bet on which team will start the event. If an event is abandoned after it has started, all bets are still considered valid. Should the start time be earlier than the time scheduled on the website, all bets after the start time will be considered void.</p>
                    <p>2.2.7. Home Team Total vs. Away Team Total – Bets on the total number of goals scored by home teams versus the total number of goals scored by away teams in relation to matches in a specific league, played on a given day. 'Home' relates to the first named team and 'Away' relates to the second named team. If one (or more) matches are abandoned, the bet will be void.</p>
                    <p>2.2.8. Team Over / Under: Bet on a goal scored by a given team in an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result.</p>
                    <h6>23. corners</h6>
                    <p>Corners: The Number of Corners result is decided by the total number of Corners by the home/away teams in a designated match. Corners awarded but not taken do not count.</p>
                    <p>2.3.1 Handicap - Handicap means betting on which team will take the most Corners during a match, including handicaps. If an event is abandoned, all bets will be considered void.</p>
                    <p>2.3.2 Over/Under: Bets placed on the total number of Corners taken by both teams during an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result.</p>
                    <p>2.3.3 First Corner Kick - Bets placed on which team will take the first corner kick in a game. If an event is abandoned after the first corner kick has been taken, all bets stand. If an event is abandoned before the first corner kick, all bets will be considered void.</p>
                    <p>2.3.4 Last Corner Kick - Bets placed on which team will take the last corner kick of a game. If the event is abandoned before its scheduled end time, all bets will be considered void.</p>
                    <p>2.3.5 Next Corner Kick - Bets placed on which team will take the next corner kick in an event. All bets are considered valid if the corner kick is taken.</p>
                    <h6>2.4. Warnings (yellow and/or red cards)</h6>
                    <p>Yellow cards are counted as one point, while red cards are counted as two points. The highest number of points a competing player can accumulate during an event is three (one for a first yellow card and two for a subsequent consecutive red card). Cards given to non-players (managers, coaches, substitutes, etc.) are not counted.</p>
                    <p>2.4.1 Handicap: Bets placed on which team will acquire the most cards during an event, all handicaps included. All bets will be considered void if an event is abandoned.</p>
                    <p>2.4.2 Over / Under: bets on the total number of cards accumulated by both teams during an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result. If an event is abandoned, all bets will be void.</p>
                    <p>2.4.3 First Card: Bets on which team will receive the first card (yellow or red card) in the game. If two or more players are cautioned for the same incident, the player who received the first card from the referee of the match will be deemed to be the player who received the first card of the game. If an event is abandoned after the first card was drawn, all bets stand. If an event is abandoned before the first card is issued, all bets will be void.</p>
                    <p>2.4.4 Last Card: Bet on which team will receive the last card (yellow or red card) in a game. If two or more players are cautioned for the same incident, the last player to receive a card from the match referee will be considered the player who received the last card in the game. All bets will be considered void if the event is abandoned.</p>
                    <h6>2.5. Offside (Offsides)</h6>
                    <p>2.5.1 Handicap: Bets placed on the team to be taken out of play the most times during an event, all handicaps included. If an event is abandoned, all bets will be considered void.</p>
                    <p>2.5.2. Over/Under: Bets on the total number of offside penalties taken by the match official during an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result. If an event is abandoned, all bets will be void.</p>
                    <p>2.5.3. First Offside: Bets placed on which team will be taken offside first in an event. If an event is abandoned after the first offside decision has been made, all bets are considered valid. If abandoned before an offside is called, all bets will be considered void.</p>
                    <p>2.5.4. Last Offside: Bets placed on the team to be taken offside in an event. All bets will be considered void if the event in question is abandoned.</p>
                    <h6>2.6. Substitutions</h6>
                    <p>2.6.1. Handicap: Bets placed on which team will make the most substitutions during a game, including all handicaps. All bets will be considered void if an event is abandoned.</p>
                    <p>2.6.2. Over / Under: Bets placed on the total number of substitutions during an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result. If an event is abandoned, all bets will be void.</p>
                    <p>2.6.3. First Substitution: Bets placed on which team will make the first substitution in a game. If two or more players are substituted at the same time, then the player whose number is shown first by the fourth official will be considered the first substitution in the game. If an event is abandoned after the first substitution in the game has been made, all bets are still considered valid. If an event is abandoned before substitutions are made, all bets will be considered void.</p>
                    <p>2.6.4. Last Substitution: Bets placed on which team will make the last substitution in an event. If two or more players are substituted at the same time, then the player whose number is shown last by the fourth official will be considered the last substitution in the game. If the event is abandoned, all bets will be considered void.</p>
                    <h6>2.7. Goalless Teams</h6>
                    <p>Betting on whether or not a team will remain 'goalless', meaning that the team in question will not allow the other team to score a goal during the event.</p>
                    <p>If an event is abandoned after the home team has scored a goal, Away No Goals bets will stand, while Home No Goals bets will be void. If the Away team only scores one goal, Home No Goals bets will stand, while Away No Goals bets will be void. If the goals are scored by both the home and away teams, all bets will stand. If an Event is abandoned without a goal being scored, all bets will be void.</p>
                    <h6>2.8. penalties</h6>
                    <p>Betting on whether or not a penalty will be awarded during an event. If the event is abandoned after a penalty kick has been awarded and taken, then all bets are considered valid. If an event is abandoned without penalties being awarded, all bets will be considered void.</p>
                    <p>2.8.1 Penalty Shootouts: Betting on which team will win on penalty shootouts. In handicap bets, the result includes all penalties taken, plus sudden death. In over/under bets, the result only includes ten penalties, while sudden kicks at the penalty spot are not counted.</p>
                    <h6>2.9. fantasy league</h6>
                    <p>Fantasy matches represent pairings of teams from different events. All locations are strictly for reference purposes only.</p>
                    <h6>2.10. Specific 15 minutes more / less</h6>
                    <p>The specific 15 minutes Over/Under: bets that are defined by the total number of points (goals, corners, games, cards, etc.) at the end of each 15-minute time period of an event. If the total is a higher number, than the predefined Over/Under line, then 'Over' is considered to be the winning result. If the total is a number less than the predefined Over/Under line, the result is considered to be 'Under' as the winning result.</p>
                    <p>Specific Over/Under bets in the 15 minutes are settled according to the precise moment a goal is scored (when the ball passes the goal line), the same applies to the number of corner kick bets ( corners taken). If an event is abandoned, all bets placed on 15 minute periods that have not been completed will be considered void.</p>
                    <p>If a specific period of 15 minutes has already passed, all bets will be considered valid. Any action that includes playing on or around the penalty spot; a penalty; a dangerous free kick and the like will be subject to Company approval if such actions have taken place in the last two (2) minutes before a 15-minute period expires.</p>
                    <h6>2.11. Free shot</h6>
                    <p>Free throws that have been awarded but not taken will not count. Indirect and direct free kicks are considered a free kick. Goal shots and penalty kicks are not considered a free kick.</p>
                    <p>2.11.1. Handicap: Bets placed on which team will take the most free kicks during an event, including all handicaps. All bets will be considered void if the event is abandoned.</p>
                    <p>2.11.2. Over/Under: Bets placed on the total number of free throws taken by both teams during an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result. If an event is abandoned, all bets will be void.</p>
                    <p>2.11.3. First Free Kick - Bets placed on which team will take the first free kick in a game. If an event is abandoned after the first free kick in the game has been taken, all bets are still considered valid. If an event is abandoned before a free kick has been taken, all bets will be considered void.</p>
                    <p>2.11.4. Last Free Kick - Bets placed on which team will take the last free kick during an event. All bets will be considered void if an event is abandoned.</p>
                    <h6>2.12. Goal kick</h6>
                    <p>A goal kick will be awarded to the defending team if the ball completely crosses the end line, as a result of contact with an opposing player. Kicks made by the goalkeeper after obtaining the ball after a rally are not considered a goal kick.</p>
                    <p>2.12.1. Handicap: Bets placed on which team will score the most goals during an event, including all handicaps. All bets will be considered void if the event is abandoned.</p>
                    <p>2.12.2. Over/Under: Bets placed on the total number of goals scored by both teams during an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result. If an event is abandoned, all bets will be void.</p>
                    <p>2.12.3. First Goal Kick - Bets on which team will take the first kick of a game. If an event is abandoned after the first goal kick in the game has been taken, all bets are still considered valid. If an event is abandoned before the goals have been scored, all bets will be considered void.</p>
                    <p>2.12.4. Last Goal Kick - Bets placed on the team to score the last goal during an event. All bets will be considered void if an event is abandoned.</p>
                    <h6>2.13. throw-in</h6>
                    <p>A throw-in is awarded to a team if the ball completely passes the touchline as a result of an opposing player's interaction with the ball.</p>
                    <p>2.13.1. Handicap: Bets placed on which team will take the most throw-ins during an event, including all handicaps. All bets will be considered void if the event is abandoned.</p>
                    <p>2.13.2. Over/Under: Bets placed on the total number of throw-ins taken by both teams during an event. If the total is a number greater than the Over/Under line, the final result is considered to be 'Over'. If the total is a number less than the Over/Under line, the result is considered to be 'Under' as the winning result. If an event is abandoned, all bets will be void.</p>
                    <p>2.13.3. First Throw-In: Bets placed on which team will take the first throw-in in a game. If an event is abandoned after the first throw-in in the game is taken, all bets are still considered valid. If an event is abandoned before a throw-in is taken, all bets will be considered void.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sports Regulations Popup End -->
<!-- Login History Popup Start -->
<div class="common-popup lg" id="login-history">
    <div class="common-popup-box">
        <div class="common-popup-title">
            <p>Login History</p>
            <span class="popup-close-icon"></span>
        </div>
        <div class="common-popup-content">
            <div class="common-popup-content-text">
                <?php echo do_shortcode("[user_login_history limit='10'  columns='time_login,login_status,ip_address,user_agent' date_format='Y-m-d' time_format='H:i:s']"); ?>
            </div>
        </div>
    </div>
</div>
<!-- Login History Popup End -->
<script src="<?php echo get_bloginfo('template_directory'); ?>/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript"></script>
<script>
    /* Get into full screen */
    function GoInFullscreen(element) {
        if (element.requestFullscreen) {
            element.requestFullscreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen();
        } else if (element.msRequestFullscreen) {
            element.msRequestFullscreen();
        } else {
            jQuery(".game-popup-inner").addClass("mac-popup");
            jQuery(".poker-popup").addClass("mac-popup");
        }
    }
    $(function() { //shorthand document.ready function
        jQuery('#loginform-custom').on('submit', function(e) { //use on if jQuery 1.7+
            var username = jQuery("#loginform-custom #user_login").val();
            var password = jQuery("#loginform-custom #user_pass").val();
            var i = 0;
            if (username == "") {
                i = 1;
                jQuery(".user-error").fadeIn();
            } else {
                jQuery(".user-error").fadeOut();
            }
            if (password == "") {
                i = 1;
                jQuery(".pass-error").fadeIn();
            } else {
                jQuery(".pass-error").fadeOut();
            }
            if (i == 1) {
                return false;
            }
        });
    });
</script>
<?php
if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'custom_logout') {
        wp_logout();
        wp_redirect(home_url('/login/'));
        exit;
    }
}
wp_footer();
?>
</body>