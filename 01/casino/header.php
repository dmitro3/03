<?php
if (isset($_GET['action']) && $_GET['action'] == "logout-account") {
    wp_logout();
    session_unset();
    wp_redirect(site_url());
    exit;
}
$website_logo = get_field('website_logo', 'option');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/pages/fonts/pages-icon/Pages-icon.woff?-u69vo5" as="font" crossorigin>
    <title><?php echo wp_title(); ?></title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- <link rel="icon" href="<?php echo get_template_directory_uri() ?>/favicon.ico" type="image/x-icon" /> -->
    <!-- <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/favicon.ico" type="image/x-icon" /> -->
    <?php wp_head(); ?>

    <link rel="preconnect" href="<?php echo home_url();?>/wp-content/themes/casino/assets/fonts/MPLUS1p-Medium.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preconnect" href="<?php echo home_url();?>/wp-content/themes/casino/assets/fonts/MPLUS1p-ExtraBold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preconnect" href="<?php echo home_url();?>/wp-content/themes/casino/assets/fonts/MPLUS1p-Regular.woff2" as="font" type="font/woff2" crossorigin>

</head>

<body class="sidebar-open">
    <div class="header">
        <div class="menu-icon toggle-sidebar" data-toggle="sidebar">
            <i class="pg-menu"></i>
        </div>
        <div class="brand d-inline-flex">
            <div class="logo">
                <a href="<?php echo home_url(); ?>/"><img width="251" height="41" src="<?php echo $website_logo; ?>" alt="<?php echo wp_title(); ?>" data-src="<?php echo $website_logo; ?>" data-src-retina="<?php echo $website_logo; ?>"></a>
            </div>
        </div>

        <!-- outputs a dropdown list of languages names -->
        <div class="d-flex align-items-center">
            <!-- outputs a dropdown list of languages names -->
            <div class="lang-switcher for_des">
                <?php echo do_shortcode('[language-switcher]'); ?>
            </div>
            <!-- START User Info-->
            <!-- outputs a dropdown list of languages names -->
            <div class="header_right">
                <?php if (is_user_logged_in()) {
                ?>
                    <div class="p-r-15 hidden-md-down header-wallet-balance">
                        <?php echo do_shortcode('[woo-mini-wallet]'); ?>
                    </div>
                <?php

                } else {
                    echo '<a href="' . home_url() . '/login/" class="header_login sec-btn"><span><i class="fas fa-sign-in-alt"></i></span> Login</a>';
                } ?>
            </div>
            <?php
            if (is_user_logged_in()) {
                $userdata = get_userdata(get_current_user_id());
            ?>
                <div class="account-details">
                    <button class="dropdown">
                        <a href="<?php echo home_url(); ?>/my-account/" class="dropdown-toggle" data-toggle="dropdown">
                            <img width="24" height="24" src="<?php echo site_url(); ?>/wp-content/themes/casino/assets/image/user_icon.svg" alt="user_icon">
                            <span>Account</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <div class="account-dropdown">
                                <div class="user-name" data-no-translation>
                                    <span class="small-title">Username</span>
                                    <span class="title"><?php echo $userdata->data->display_name; ?></span>
                                </div>
                                <div class="user-balance">
                                    <span class="small-title">Balance</span>
                                    <span class="title header-wallet-balance"><?php echo do_shortcode('[woo-mini-wallet]'); ?></span>
                                </div>
                            </div>
                            <ul class="account-info">
                                <li><a href="<?php echo home_url(); ?>/my-account/wallet/add/" class="list-group-item"><span class="icon- fas fa-wallet"></span>Deposit</a></li>
                                <li><a href="<?php echo home_url(); ?>/my-account/wallet-withdrawal/" class="list-group-item"><span class="icon- fas fa-wallet"></span>Withdraw</a></li>
                                <li><a href="<?php echo home_url(); ?>/my-account/edit-account/" class="list-group-item"><span class="icon- fas fa-dice"></span>Settings</a></li>
                                <!-- <li class="button-popup-link" data-id="login-history"><a href="javascript:void(0);" class="list-group-item"><span class="icon- fas fa-sign-in"></span>Login History</a></li> -->
                                <li><a href="<?php echo home_url(); ?>/my-account/wallet/" class="list-group-item"><span class="fas fa-chart-bar"></span>Transactions</a></li>
                                <li><a href="<?php echo home_url(); ?>?action=custom_logout" class="list-group-item"><span class="fas fa-power-off"></span>Logout</a></li>
                            </ul>
                        </div>
                    </button>
                </div>
            <?php
            }
            ?>
            <!-- END User Info-->
        </div>
    </div>
    <?php
