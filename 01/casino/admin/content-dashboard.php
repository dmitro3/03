<?php

$i = 1;
$user_info = wp_get_current_user();

$user_role = "";
if (isset($user_info)) {
    $user_role = $user_info->roles[0];
}
if (is_user_logged_in() && ($user_role == "administrator" || $user_role == "agent")) {

    global $api_server_url;

    $agere_casino_id = get_field('agere_casino_id', 'option');
    $agere_token = get_field('agere_token', 'option');

    $user_api_id = site_url() . "/_" . get_current_user_id();


    $netincome_api = $api_server_url . "/casinos/casino-admin-reports?action=netIncome&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $user_api_id;
    $netincome_api_data = file_get_contents($netincome_api);



?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="main_container">
                <div class="common_page_loader"><i class="fad fa-spinner-third fa-spin"></i></div>
                <div class="main_content_box">
                    <section class="dashboard_main">
                        <div class="title_bar">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="title">
                                        <h1 class="h1-title">Dashboard</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-20 justify-content-center">
                            <div class="col-lg-4">
                                <div class="dashboard_box">
                                    <h3 class="h3-title">Fast Charge</h3>
                                    <div class="button_group">
                                        <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="add_player_Modal" class="sec-btn sm-btn modal-html-btn" title="New Player"> New Player <i class="far fa-plus-circle"></i>
                                        </a>

                                        <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="add_agent_Modal" class="sec-btn sm-btn modal-html-btn" title="New Agent"> New Agent <i class="far fa-plus-circle"></i>
                                        </a>
                                    </div>
                                    <?php
                                   
                                        <form action="" method="post" class="credit_debit_dashboard">

                                            <div class="form_input_group">
                                                <div class="d-flex">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text input-modal-addon">
                                                            <i class="fal fa-user"></i>
                                                        </span>
                                                    </div>
                                                    <input name="username" type="text" class="form_input" autocomplete="off" placeholder="Username">
                                                </div>
                                                <div class="table_btn_group form_right_group">
                                                    <ul>
                                                        <li>
                                                            <button type="button" class="sec-btn icon_btn balance_action" data-button-toggle="tooltip" data-action="credit" data-original-title="increase"> <i class="far fa-plus"></i></button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="sec-btn icon_btn balance_action" data-button-toggle="tooltip" data-action="debit" data-original-title="decrease"> <i class="far fa-minus"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="error-msg ">Username does not exist!</p>
                                        </form>
                                        <?php
                                    }?>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <?php
                                $totalCommission_curmonth = $totalCommission_lastmonth = 0;
                                if (isset($netincome_api_data) && !empty($netincome_api_data)) {
                                    $netincome_data = json_decode($netincome_api_data, true);

                                    if (isset($netincome_data) && isset($netincome_data['commissionInfo']['currentGGR'])) {
                                        $currentMonth_income = $netincome_data['commissionInfo']['currentGGR']['totalCommission'];
                                    }
                                    if (isset($netincome_data) && isset($netincome_data['commissionInfo']['lastGGR'])) {
                                        $lastMonth_income = $netincome_data['commissionInfo']['lastGGR']['totalCommission'];
                                    }
                                }

                                ?>
                                <div class="dashboard_box">
                                    <h3 class="h3-title">Net Income</h3>
                                    <div class="dashboard_list">
                                        <ul>
                                            <li><label>Current month :</label> <span><?php echo add_currency_symbol($currentMonth_income); ?></span></li>
                                            <li><label>Previous month :</label> <span><?php echo add_currency_symbol($lastMonth_income); ?></span></li>
                                        </ul>
                                    </div>
                                    <div class="badge_wp d-none">
                                        <span class="badge badge-minus"> -4.39% <i class="far fa-level-down"></i></span>
                                        <span class="badge badge-plus"> +2.90% <i class="far fa-level-up"></i></span>
                                        <i class="fal fa-eye"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="dashboard_box dashboard_chart_box">
                                    <h3 class="h3-title">Monthly Netwin</h3>

                                    <div id="Netwin_container" class="dashboard_chart"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-20 ">
                            <div class="col-lg-8">
                                <div class="dashboard_box dashboard_chart_box">
                                    <h3 class="h3-title">Daily Netwin</h3>

                                    <div id="NetwinDaily_container" class="dashboard_chart"></div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="dashboard_box dashboard_chart_box">
                                    <h3 class="h3-title">Top Agents of the Month</h3>

                                    <div id="TopAffiliates_container" class="dashboard_chart"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div><!-- main_container -->
        </main><!-- #main -->
    </div>

    <div class="modal fade center-modal-view show" id="add_player_Modal" tabindex="-1" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-body overflow-text" data-simplebar>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade center-modal-view show" id="add_agent_Modal" tabindex="-1" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-body overflow-text" data-simplebar>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade center-modal-view" id="add_credit_modal" tabindex="-1" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-body overflow-text" data-simplebar>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade center-modal-view" id="add_debit_modal" tabindex="-1" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="modal-body overflow-text" data-simplebar>

                </div>
            </div>
        </div>
    </div>

<?php
} else {
?>
    <section class="login__page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="sec-wp">
                        <div class="login__form_wp">
                            <form class="login__form">
                                <h1 class="h1-title">Login</h1>
                                <p class="error-msg"></p>
                                <div class="form_input_wp">
                                    <i class="fal fa-user"></i>
                                    <input name="username" type="text" class="form_input" placeholder="UserName">
                                </div>
                                <div class="form_input_wp">
                                    <i class="fal fa-eye"></i>
                                    <input name="password" type="password" class="form_input" placeholder="Password">
                                </div>

                                <div class="form_submit">
                                    <button type="submit" name="login" class="sec-btn sm-btn">Login</button>
                                    <span class="load-more">
                                        <i class="fad fa-spinner-third  fa-spin ajax-loader"></i>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="login_form_bg back-img" style="background-image: url('<?php echo site_url(); ?>/wp-content/themes/casino/admin/assets/images/slot-machine.jpg');">
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End of login__page -->
<?php
}
?>