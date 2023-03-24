<?php $website_logo = get_field('website_logo', 'option'); ?>
<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">

    <div class="header_top_info for_mob">
        <div class="menu-icon toggle-sidebar" data-toggle="sidebar">
            <i class="pg-close"></i>
        </div>

        <div class="lang-switcher">
            <?php echo do_shortcode('[language-switcher]'); ?>
        </div>
    </div>

    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items lrm-login">
            <li class="<?php if(is_home() || is_front_page()) echo "menu_active"; ?>">
                <a href="<?php echo home_url(); ?>/" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/main_page_icon.svg" alt="main_page_icon">

                    <span class="title">Main Page</span>
                </a>
            </li>
            <li class="<?php if(is_page('welcome-bonus')) echo "menu_active"; ?>">
                <a href="<?php echo home_url(); ?>/welcome-bonus/" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/promotions_icon.svg" alt="promotions_icon">

                    <span class="title">Promotions</span>
                </a>
            </li>
            
            <li class="<?php if('casino' === get_post_field('post_name', get_the_ID()) && $_REQUEST['slots'] != 'slots') echo "menu_active"; ?>">
                <a href="<?php echo home_url(); ?>/casino/" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/casino_icon.svg" alt="casino_icon">
                    <span class="title">All Games</span>
                </a>
            </li>

            <li class="<?php if('slots' === get_post_field('post_name', get_the_ID())) echo "menu_active"; ?>">
                <a href="<?php echo home_url(); ?>/slots/" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/slot_icon.svg" alt="slots_icon">
                    <span class="title">Slots</span>
                </a>
            </li>
            <?php /*
            <li class="<?php if('virtual-sports' === get_post_field('post_name', get_the_ID())) echo "menu_active"; ?>">
                <a href="<?php echo home_url(); ?>/virtual-sports" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/virtual_sports_icon.svg" alt="virtual_sports_icon">
                    <span class="title">Virtual Sports</span>
                </a>
            </li> */?>
            <li class="<?php if('live-dealer' === get_post_field('post_name', get_the_ID())) echo "menu_active"; ?>">
                <a href="<?php echo home_url(); ?>/live-dealer" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/live_dealer_icon.svg" alt="live_dealer_icon">
                    <span class="title">Live Dealer</span>
                </a>
            </li>
            <?php
            if (is_user_logged_in()) {
                ?>
                <li class="account-menu <?php if('active-bonus' === get_post_field('post_name', get_the_ID()) || is_account_page() || is_wc_endpoint_url( 'wallet/add' ) || is_wc_endpoint_url( 'edit-account' ) || is_wc_endpoint_url( 'wallet' ) ) echo "menu_active"; ?>">
                    <a href="javascript:void(0)">
                        <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/account_icon.svg" alt="account_icon">
                        <span class="title">Account</span>
                        <span class=" arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if(is_wc_endpoint_url( 'wallet/add' ) || is_wc_endpoint_url('active-bonus')) echo "menu_active"; ?>">
                            <a href="<?php echo home_url(); ?>/my-account/wallet/add/">Deposit</a>
                        </li>
						
						
                        <li class="<?php if(is_wc_endpoint_url( 'wallet-withdrawal' ) || is_wc_endpoint_url('active-bonus')) echo "menu_active"; ?>">
                            <a href="<?php echo home_url(); ?>/my-account/wallet-withdrawal/">Withdraw</a>
                        </li>

						<!--
                        <li class="">
							<a href="<?php echo home_url(); ?>/my-account/active-bonus/">Active Bonus</a>
						</li>
						-->
                        <li class="<?php if(is_wc_endpoint_url( 'edit-account' )) echo "menu_active"; ?>">
                            <a href="<?php echo home_url(); ?>/my-account/edit-account/">Settings</a>
                        </li>
                        <li class="<?php if(is_wc_endpoint_url( 'wallet' )) echo "menu_active"; ?>">
                            <a href="<?php echo home_url(); ?>/my-account/wallet/">Transactions</a>
                        </li>
                        <li>
                            <?php echo '<a href="' . site_url() . '?action=custom_logout">Logout</a>'; ?>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="<?php echo home_url(); ?>/my-account/wallet/" class="detailed">
                        <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/cashier_icon.svg" alt="cashier_icon">

                        <span class="title">Balance</span>
                        <span class="details header-wallet-balance"> <?php echo woo_wallet()->wallet->get_wallet_balance(get_current_user_id()); ?> </span>
                    </a>
                </li>
                <?php 
            } else { ?>
                <li class="<?php if('login' === get_post_field('post_name', get_the_ID())) echo "menu_active"; ?>">
                    <a href="<?php echo home_url(); ?>/login/" class="detailed lrm-hide-if-logged-in">
                        <img width="32" height="32" src="<?php echo site_url() . '/wp-content/themes/casino/assets/image/account_icon.svg'; ?>" alt="account_icon">
                        <span class="title">Login</span>
                    </a>
                </li>
                
                <li class="<?php if('register' === get_post_field('post_name', get_the_ID())) echo "menu_active"; ?>">
                    <a href="<?php echo home_url(); ?>/register/" class="detailed">
                        <img width="32" height="32" src="<?php echo site_url() . '/wp-content/themes/casino/assets/image/account_icon.svg'; ?>" alt="account_icon">
                        <span class="title">Register</span>
                    </a>
                </li>
                <?php 
            } ?>
            <?php /*
            <li class="<?php if('poker' === get_post_field('post_name', get_the_ID())) echo "menu_active"; ?>">
                <a href="<?php echo home_url(); ?><?php echo is_user_logged_in() ? '/poker' : '/login'; ?>" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/online_poker_icon.svg" alt="online_poker_icon">
                    <span class="title">Online Poker</span>
                </a>
            </li> */?>
            <!-- <li class="<?php if('sports-betting' === get_post_field('post_name', get_the_ID())) echo "menu_active"; ?>">
                <a href="/sports-betting" class="detailed">
                    <img width="32" height="32" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/sports_betting_icon.svg" alt="sports_betting_icon">
                    <span class="title">Sports Betting</span>
                </a>
            </li> -->
            <?php
            global $api_server_url;
            /*
				$sports_games_url = $api_server_url . '/providers/odds-824215133479014/?token='.agereToken().'&casino='.agereCasino().'&action=getSports';
				try {
					$sports_raw_post = json_decode(file_get_contents($sports_games_url));
				}
				catch(Exception $e) {
					$sports_raw_post = 0;
				}
				*/
            ?>
            <!--
			<li class="">
				<a href="javascript:void(0);">
					<span class="title">Sports</span><span class="arrow"></span>
				</a>
				<span class="icon-thumbnail"><i class="fas fa-baseball-ball"></i></span>
					<ul class="sub-menu" style="display: none;">
					
                    <?php

                    if (isset($sports_raw_post->status) && $sports_raw_post->status == 200) {
                        if (isset($sports_raw_post->data) && !empty($sports_raw_post->data)) {
                            foreach ($sports_raw_post as $key => $game_name_data) {
                                foreach ($game_name_data as $key => $game_main_menu) {
                                    $game_main_menu = json_encode($game_main_menu);
                                    $game_main_menu = json_decode($game_main_menu, true);
                                    foreach ($game_main_menu as $key => $game_sub_menu) {
                    ?>
										<li class="">
											<a href="javascript:void(0);"><span class="game-title-menu"><?php echo $key; ?></span><span class="arrow"></span></a>
											<?php
                                            if (isset($game_sub_menu) && !empty($game_sub_menu)) {
                                                echo '<ul class="game-sub-menu sub-menu" style="display: none;" >';
                                                foreach ($game_sub_menu as $key => $game_menu) {
                                                    // echo '<pre style="color:#fff;">'; print_r( $game_menu ); echo '</pre>';
                                            ?>
													<li class="">
														<a href="<?php echo '/sports/?id=' . $game_menu['key']; ?>"><?php echo $game_menu['name']; ?></a>
													</li>
													<?php
                                                }
                                                echo "</ul>";
                                            }
                                                    ?>
										</li>
										<?php
                                    }
                                }
                            }
                        }
                    }
                                        ?>
                </ul>
			</li>
			-->
        </ul>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBPANEL-->
<!-- START PAGE-CONTAINER -->
<div class="page-container">