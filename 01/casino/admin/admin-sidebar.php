<?php
$page_id = get_the_ID();
$page_slug = get_post_field('post_name', $post_id);
$casino_admin_slug = '/casino-admin';
?>
<section class="side_bar">
    <div class="header-logo">
        <a href="<?php echo home_url('/'); ?>" title="<?php echo wp_title(); ?>">
            <?php $website_logo = get_field('website_logo', 'option'); ?>
            <img src="<?php echo $website_logo; ?>" alt="<?php echo wp_title(); ?>" data-src="<?php echo $website_logo; ?>" data-src-retina="<?php echo $website_logo; ?>">
        </a>
    </div>
    <nav class="side_bar_nav navbar_wp">
        <ul>
            <li <?php if ('casino-admin' === $page_slug) {
                    echo 'class="active-nav"';
                }  ?>>
                <a href="<?php echo home_url().'/casino-admin/'; ?>" title="Statistics">
                    <i class="fal fa-chart-bar"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li <?php if ('users' === $page_slug) {
                    echo 'class="active-nav"';
                }  ?>>
                <a href="<?php echo home_url().'/casino-admin/users'; ?>" title="Users">
                    <i class="fal fa-users-cog"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="<?php if ('agent-report' === $page_slug || 'player-report' === $page_slug) {
                            echo 'active-nav nav_menu_open';
                        } ?> sub_menu_li">
                <a href="javascript:void(0);" class="sidebar_sub_menu <?php if ('agent-report' === $page_slug || 'player-report' === $page_slug) {
                                                                            echo 'current_menu_active';
                                                                        } ?>" title="Users">
                    <i class="fal fa-globe"></i>
                    <span>Global Reports<i class="far fa-angle-right"></i></span>
                </a>

                <ul>
                    <li <?php if ('agent-report' === $page_slug) {
                            echo 'class="active-nav"';
                        }  ?>>
                        <a href="<?php echo home_url().'/casino-admin/agent-report'; ?>" title="Report by Agent">
                            <i class="fal fa-user-secret"></i>
                            <span>Agent Report</span>
                        </a>
                    </li>
                    <li <?php if ('player-report' === $page_slug) {
                            echo 'class="active-nav"';
                        }  ?>>
                        <a href="<?php echo home_url().'/casino-admin/player-report'; ?>" title="Report by Player">
                            <i class="fal fa-user-cowboy"></i>
                            <span>Player Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            $current_user_info = get_userdata( get_current_user_id() );
            $casino_admin =  get_user_meta( get_current_user_id() , 'casino_admin', true);
        
            if((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1 ) || $current_user_info->roles[0] === 'administrator'){?>
                <li class="<?php if ('charges-and-withdrawals' === $page_slug || 'player-history' === $page_slug || $page_id == 0) {
                                echo 'active-nav nav_menu_open';
                            } ?> sub_menu_li">
                    <a href="javascript:void(0);" title="Users" class="sidebar_sub_menu <?php if ('charges-and-withdrawals' === $page_slug || 'player-history' === $page_slug || $page_id == 0) {
                                                                                            echo 'current_menu_active';
                                                                                        } ?>">
                        <i class="fal fa-file-alt"></i>
                        <span>Credits Reports<i class="far fa-angle-right"></i></span>
                    </a>

                    <ul>
                        <li <?php if ('charges-and-withdrawals' === $page_slug) {
                                echo 'class="active-nav"';
                            }  ?>>
                            <a href="<?php echo home_url().'/casino-admin/charges-and-withdrawals'; ?>" title="Charges and Withdrawals">
                                <i class="fal fa-user-secret"></i>
                                <span>Sales Details</span>
                            </a>
                        </li>
                        <li <?php if ('player-history' === $page_slug) {
                                echo 'class="active-nav"';
                            }  ?>>
                            <a href="<?php echo home_url().'/casino-admin/player-history'; ?>" title="Player History ">
                                <i class="fal fa-user-cowboy"></i>
                                <span>Player History</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?php if ('casino-game-reports' === $page_slug || 'sports-game-reports' === $page_slug || 'poker-game-reports' === $page_slug || $page_id == 0) {
                                echo 'active-nav nav_menu_open';
                            } ?> sub_menu_li">
                    <a href="javascript:void(0);" class="sidebar_sub_menu <?php if ('casino-game-reports' === $page_slug || 'sports-game-reports' === $page_slug || 'poker-game-reports' === $page_slug || $page_id == 0) {
                                                                                echo 'current_menu_active';
                                                                            } ?>" title="Users">
                        <i class="fal fa-gamepad-alt"></i>
                        <span>Game Reports<i class="far fa-angle-right"></i></span>
                    </a>
                    <ul>
                        <li <?php if ('casino-game-reports' === $page_slug) {
                                echo 'class="active-nav"';
                            }  ?>>
                            <a href="<?php echo home_url().'/casino-admin/casino-game-reports'; ?>" title="Casino Game Reports">
                                <i class="fal fa-user-secret"></i>
                                <span>Casino</span>
                            </a>
                        </li>
                        <!--
                        <li <?php if ('sports-game-reports' === $page_slug) {
                                echo 'class="active-nav"';
                            }  ?>>
                            <a href="<?php echo home_url().'/casino-admin/sports-game-reports'; ?>" title="Player Report">
                                <i class="fal fa-user-cowboy"></i>
                                <span>Sports</span>
                            </a>
                        </li>
                        <li <?php if ('poker-game-reports' === $page_slug) {
                                echo 'class="active-nav"';
                            }  ?>>
                            <a href="<?php echo home_url().'/casino-admin/poker-game-reports'; ?>" title="Poker Game Reports">
                                <i class="fal fa-user-cowboy"></i>
                                <span>Poker</span>
                            </a>
                        </li>
                        -->
                    </ul>
                </li>
            
                    <li class="<?php if ('finance-agent-operation' === $page_slug || 'finance-players-operation' === $page_slug || 'finance-agent-balances' === $page_slug || 'finance-player-balances' === $page_slug || 'finance-players-withdrawal-request' === $page_slug) {echo 'active-nav nav_menu_open';} ?> sub_menu_li">
                        
                    <a href="javascript:void(0);" class="sidebar_sub_menu <?php if ('finance-agent-operation' === $page_slug || 'finance-players-operation' === $page_slug || 'finance-agent-balances' === $page_slug || 'finance-player-balances' === $page_slug || 'finance-players-withdrawal-request' === $page_slug) {echo 'current_menu_active';} ?>" title="Users"><i class="fal fa-sack-dollar"></i><span>Finance <i class="far fa-angle-right"></i> </span></a>
                            <ul>
                                <li class="<?php if ('finance-agent-operation' === $page_slug || 'finance-agent-balances' === $page_slug) {
                                                echo 'active-nav nav_menu_open';
                                            }  ?> sub_menu_li">
                                    <a href="javascript:void(0);" class="sidebar_sub_menu <?php if ('finance-agent-operation' === $page_slug || 'finance-agent-balances' === $page_slug) {echo 'current_menu_active';} ?>" title="Agent Report"> <i class="fal fa-user-secret"></i> <span>Agents <i class="far fa-angle-right"></i></span></a>
                                    <ul>
                                        <li <?php if ('finance-agent-operation' === $page_slug) {echo 'class="active-nav"';}  ?>>
                                            <a href="<?php echo home_url().'/casino-admin/finance-agent-operation'; ?>" title="Agent Report">
                                                <i class="fal fa-user-secret"></i>
                                                <span>Operations</span>
                                            </a>
                                        </li>
                                        <li <?php if ('finance-agent-balances' === $page_slug) {echo 'class="active-nav"';}  ?>>
                                            <a href="<?php echo home_url().'/casino-admin/finance-agent-balances'; ?>" title="Player Report">
                                                <i class="fal fa-user-cowboy"></i>
                                                <span>Balances</span>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li class="<?php if ('finance-players-operation' === $page_slug || 'finance-player-balances' === $page_slug || 'finance-players-withdrawal-request' === $page_slug) {echo 'active-nav nav_menu_open';}  ?> sub_menu_li">
                                    <a href="javascript:void(0);" class="sidebar_sub_menu <?php if ('finance-players-operation' === $page_slug || 'finance-player-balances' === $page_slug || 'finance-players-withdrawal-request' === $page_slug) {echo 'current_menu_active';} ?>" title="Player Report"><i class="fal fa-user-cowboy"></i> <span>Players <i class="far fa-angle-right"></i></span></a>
                                    <ul>
                                        <li <?php if ('finance-players-operation' === $page_slug) {
                                                echo 'class="active-nav"';
                                            }  ?>>
                                            <a href="<?php echo home_url().'/casino-admin/finance-players-operation'; ?>" title="Agent Report">
                                                <i class="fal fa-user-secret"></i>
                                                <span>Operations</span>
                                            </a>
                                        </li>
                                        <li <?php if ('finance-player-balances' === $page_slug) {
                                                echo 'class="active-nav"';
                                            }  ?>>
                                            <a href="<?php echo home_url().'/casino-admin/finance-player-balances'; ?>" title="Player Report">
                                                <i class="fal fa-user-cowboy"></i>
                                                <span>Balances</span>
                                            </a>
                                        </li>
                                       
                                        <li <?php if ('finance-players-withdrawal-request' === $page_slug) {echo 'class="active-nav"';}  ?>>
                                            <a href="<?php echo home_url().'/casino-admin/finance-players-withdrawal-request'; ?>" title="withdrawal Report" >
                                                <i class="far fa-wallet"></i>
                                                <span>Withdrawal Request</span>
                                            </a>
                                        </li>
                                    
                                    </ul>
                                </li>
                            </ul>
                    </li>
                
                                        
                <li class="<?php if ('my-summary' === $page_slug) {
                                echo 'active-nav';
                            }  ?>">
                    <a href="<?php echo home_url().'/casino-admin/my-summary'; ?>" title="My Summary">
                        <i class="fal fa-file-invoice-dollar"></i>
                        <span>My Summary</span>
                    </a>
                </li>
                <?php

            }?>
            <li class="collapse_menu">
                <a href="javascript:void(0);">
                    <i class="fas fa-angle-double-left"></i>
                    <span>Collapse Menu</span>
                </a>
            </li>
        </ul>
    </nav>
</section><!-- Emd of Side Bar -->