<?php
$user_info = wp_get_current_user();
$page_id = get_the_ID();
$page_slug = get_post_field('post_name', $page_id);
// print_r($user_info);
if (is_user_logged_in() && isset($user_info)) {
    $user_role = $user_info->roles[0];
    if ($user_role == "administrator" || $user_role == "agent") {
        $user_access = 1;
    } else {
        $user_access = 0;
    }
} else {
    $user_access = 0;
}

if ($user_access == 0 && 'casino-admin' !== $page_slug) {
    wp_redirect( home_url('/casino-admin') );
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino Admin</title>
    <link rel="stylesheet" id="bootstrap-css" href="<?php echo get_template_directory_uri() . '/admin/assets/css/bootstrap.min.css'; ?>" type="text/css" media="all">
    <link rel="stylesheet" id="simplebar-css" href="<?php echo get_template_directory_uri() . '/admin/assets/css/simplebar.css'; ?>" type="text/css" media="all">
    <link rel="stylesheet" id="datatables-jquery-css" href="<?php echo get_template_directory_uri() . '/admin/assets/css/jquery.datatables.min.css'; ?>" type="text/css" media="all">
    <link rel="stylesheet" id="datatables-responsive-css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="fontawesome-css" href="<?php echo get_template_directory_uri() . '/admin/assets/css/fontawesome-min.css'; ?>" type="text/css" media="all">
    <link rel="stylesheet" id="datetimepicker" href="<?php echo get_template_directory_uri() . '/admin/assets/css/mdb.min.css'; ?>" type="text/css" media="all">
    <link rel="stylesheet" id="custom-css" href="<?php echo get_template_directory_uri() . '/admin/assets/css/style.css?' . current_time('timestamp'); ?>" type="text/css" media="all">
    <link rel='stylesheet' id='urgent-games-fancybox-min-css' href="<?php echo get_template_directory_uri() . '/admin/assets/css/jquery.fancybox.min.css' ?>" media='all' />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<!-- <link rel="icon" href="<?php echo get_template_directory_uri()?>/favicon.ico" type="image/x-icon" /> -->
	<!-- <link rel="shortcut icon" href="<?php echo get_template_directory_uri()?>/favicon.ico" type="image/x-icon" /> -->

    <input type="hidden" name="ajaxurl" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">
		
</head>


<body <?php body_class(); ?><?php //do_filter('body_class_admin'); 
                            ?>>

    <?php
    $user_role = "";
    if (isset($user_info)) {

        $user_role = $user_info->roles[0];
    }
    if (is_user_logged_in() && ($user_role == "administrator" || $user_role == "agent")) {
        $get_current_user_id = get_current_user_id();
        $user_info = get_userdata($get_current_user_id);

        $username = "";
        if (isset($user_info)) {
            $username = $user_info->user_login;
        }

    ?>

        <div class="main_container">
            <button class="menu-toggle for-mob"><span></span><span></span><span></span></button>
            <header class="site_header">
                <nav class="navbar_wp">
                    <ul>
                        <li>
                            <a href="javascript:void(0);" title="Price" class="cursor_not_allow">
                                <i class="fal fa-coins"></i>
                                <span>
                                    <span class="woocommerce-Price-currencySymbol symbol-only"><?php echo get_woocommerce_currency_symbol(get_option('woocommerce_currency')); ?></span>
                                    <span class="woocommerce-Price-currencySymbol woo_current_user_balance "><?php echo  $mini_wallet = woo_wallet()->wallet->get_wallet_balance(get_current_user_id(), 'edit'); ?></span>
                                </span>

                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="fas fa-headset"></i>
                            </a>
                            <ul>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#contact-support" class="contact-support-button"><i class="fal fa-paper-plane"></i> Contact Support</a></li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="#" title="Notification" class="header_notification">
                                <i class="fal fa-bell"></i>
                                <b>5</b>
                            </a>
                        </li> -->
                        <li>
                            <a href="javascript:void(0);" title="<?php echo $username; ?>">
                                <i class="fal fa-user"></i>
                                <span><?php echo $username; ?></span>
                            </a>
                            <ul>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#main_change_password"><i class="far fa-angle-right"></i> Change Password</a></li>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#change-language"><i class="far fa-angle-right"></i> Change language</a></li>
                                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#login-history"><i class="far fa-angle-right"></i> Login History</a></li>
                                <li><a href="<?php echo home_url('/casino-admin?action=casino_admin_logout'); ?>"><i class="far fa-angle-right"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>
        </div>



    <?php
    }
    ?>