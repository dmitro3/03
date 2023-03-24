<?php
global $api_server_url;
$page_id = get_the_ID();
$page_slug = get_post_field('post_name', $page_id);

if ('casino-game-reports' === $page_slug) {
    $matchType = "casino";
} elseif ('sports-game-reports' === $page_slug) {
    $matchType = "sports";
} elseif ('poker-game-reports' === $page_slug) {
    $matchType = "poker";
}
?>
<div class="main_container">
    <div class="main_content_box">
        <section class="user_main_sec">
            <div class="title_bar">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="title">
                            <h1 class="h1-title">Balances Report</h1>
                            <a href="javascript:void(0);" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="agent-tree-list" class="sec-btn modal-html-btn agent-tree-modal-btn" title="Agent Tree"> Agent Tree </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-right d-none">
                        <div class="button_group">
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-target="add_player_Modal" class="sec-btn modal-html-btn" title="Add Player"> Player
                                <i class="far fa-plus-circle"></i></a>
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-target="add_agent_Modal" class="sec-btn modal-html-btn" title="Add Agent"> Agent <i class="far fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user_main_sec_content">

                <?php

                ?>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="use_main_form">
                            <form action="" class="game-reports-form">
                                <div class="row g-10">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp">
                                            <label>Start date</label>
                                            <div class="position-relative">
                                                <i class="fal fa-calendar"></i>
                                                <input name="Start_date" id="start_date" type="text" class="form_input" value="" data-value="<?php echo date("d M Y"); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp">
                                            <label>Start time</label>
                                            <div class="position-relative">
                                                <i class="fal fa-alarm-clock"></i>
                                                <input name="start_time" id="start_time" type="text" class="form_input" value="00:00">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp">
                                            <label>End date</label>
                                            <div class="position-relative">
                                                <i class="fal fa-calendar"></i>
                                                <input name="end_date" id="end_date" type="text" class="form_input" value="" data-value="<?php $date = date('Y-m-d');
                                                                                                                                            echo $date = date('Y-m-d', strtotime('+1 day', strtotime($date))); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp">
                                            <label>End time</label>
                                            <div class="position-relative">
                                                <i class="fal fa-alarm-clock"></i>
                                                <input name="end_time" id="end_time" type="text" class="form_input" value="00:00" placeholder="00:00:00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-10">
                                    <!-- <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp form-element">
                                            <select name="userrole" class="form_input">
                                                <option value="player">Players</option>
                                                <option value="agent">Agents</option>
                                            </select>
                                            <i class="far fa-angle-down"></i>
                                        </div>
                                    </div> -->
                                    <?php if ($matchType === "casino") { ?>
                                        <?php
                                        $providers = file_get_contents($api_server_url . "/casinos/casino-admin-reports?action=get-all-providers&token=e666cd71c534c269624e41346a5480fa&casino=63110e3fb1ad90a7278e8a36");
                                        $providers = json_decode($providers);
                                        $totals_colspan = 4;
                                        ?>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="form_input_wp form-element">
                                                <!-- <i class="fal fa-user"></i> -->
                                                <select class="form-select casino-provider-select" aria-label="Select Providers">
                                                    <option value="" selected>All Providers</option>
                                                    <?php
                                                    if ($providers->status == 200) {
                                                        foreach ($providers->providers as $provider) {
                                                            echo "<option value='" . $provider->name . "'>$provider->name</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <i class="far fa-angle-down"></i>
                                                <!-- <input name="username_search" type="text" class="form_input" autocomplete="off" placeholder="UserName"> -->
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp">
                                            <i class="fal fa-user"></i>
                                            <input name="username_search" type="text" class="form_input" autocomplete="off" placeholder="Username">
                                        </div>
                                    </div>
                                    <?php if ($matchType !== "poker") { 
                                        $totals_colspan = 4;
                                        ?>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="form_input_wp">
                                                <i class="fal fa-user"></i>
                                                <input name="bet_id" type="number" class="form_input" autocomplete="off" placeholder="Bet ID">
                                            </div>
                                        </div>
                                    <?php } else {
                                        $totals_colspan = 4;
                                        ?>
                                        <div class="col-lg-3 for-des"></div>
                                        <div class="col-lg-3 for-des"></div>
                                    <?php } ?>
                                    <?php if ($matchType === "sports") { 
                                        $totals_colspan = 4;
                                        ?>
                                        <div class="col-lg-3 col-sm-6 form_checkbox">
                                            <input type="checkbox" name="poker-only-pending" value="direct" class="form-check-input" id="poker-only-pending">
                                            <label class="form-check-label" for="poker-only-pending">Pending</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="submit_btn">
                                            <button type="submit" class="sec-btn">Submit</button>
                                            <input type="hidden" name="matchType" value="<?php echo $matchType; ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table id="casino_report" class="table table-striped table-bordered dataTable no-footer nowrap">
                            <thead>
                                <tr>
                                    <tr>
                                        <td class="total-win" colspan="<?php echo $totals_colspan; ?>" style="text-align: right;"><b>Total Win</b></td>
                                        <td class="total-win-amount" colspan="1"><b><?php echo add_currency_symbol("0.00"); ?></b></td>
                                    </tr>
                                    <?php if ($matchType === "poker") { ?>
                                        <th class="all">Date</th>
                                        <th class="all">User</th>
                                        <th class="all">Buyin</th>
                                        <th class="all">Cashout</th>
                                        <th class="all">Rake</th>
                                    <?php } else { ?>
                                        <th class="all">Bet ID</th>
                                        <th class="all">Date</th>
                                        <th class="all">User</th>
                                        <th class="all">Operation</th>
                                        <th class="all">Amount</th>
                                        <?php if ($matchType == "sports") { ?>
                                            <th class="all">Result</th>
                                            <th class="all">Possible Win</th>
                                            <th class="none">Date</th>
                                            <th class="none">Player</th>
                                            <th class="none">Type</th>
                                            <th class="none">Stack</th>
                                            <th class="none">Odds</th>
                                            <th class="none">Possible Win</th>
                                            <th class="none"></th>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <?php
                            if ($matchType !== "sports") { ?>
                                <tfoot>
                                    <tr>
                                        <td class="total-win" colspan="<?php echo $totals_colspan; ?>" style="text-align: right;"><b>Total Win</b></td>
                                        <td class="total-win-amount" colspan="1"><b><?php echo add_currency_symbol("0.00"); ?></b></td>
                                    </tr>
                                </tfoot>
                                <?php
                            } else if ($matchType === "sports") { ?>
                                <tfoot class="d-none">
                                    <tr>
                                        <td colspan="4" style="text-align: right;"><b>Total</b></td>
                                        <td><b class="game_reports_status_wise_total_1"><?php echo add_currency_symbol("0.00"); ?></b></td>
                                        <td><b class="game_reports_status_wise_total_2"><?php echo add_currency_symbol("0.00"); ?></b></td>
                                        <td><b class="game_reports_status_wise_total_3"><?php echo add_currency_symbol("0.00"); ?></b></td>
                                    </tr>
                                    
                                </tfoot>
                            <?php } ?>
                        </table>
                    </div>

                    <div class="col-lg-3">
                        <?php include get_template_directory().'/admin/template-parts/agents-sidebar.php'; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div><!-- End of Main Container -->

<div class="modal fade center-modal-view show" id="agent-tree-list" tabindex="-1" aria-modal="true">
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

<div class="modal fade center-modal-view show" id="modal-bet-details" tabindex="-1" aria-modal="true">
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