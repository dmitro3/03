<?php
$page_id = get_the_ID();
$page_slug = get_post_field('post_name', $page_id);
?>
<div class="main_container">
    <div class="main_content_box">
        <section class="user_main_sec">
            <div class="title_bar">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="title">
                            <h1 class="h1-title">Players Report</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-right d-none">
                        <div class="button_group">
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-target="add_player_Modal" class="sec-btn modal-html-btn" title="Add Player"> Player <i class="far fa-plus-circle"></i></a>
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-target="add_agent_Modal" class="sec-btn modal-html-btn" title="Add Agent"> Agent <i class="far fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user_main_sec_content">

                <?php
                $user_args = array();
                $user_args['fields'] = array('ID', 'display_name');
                $user_args['meta_key'] = 'parent_user';
                $user_args['meta_value'] = get_current_user_id();
                $user_args['meta_compare'] = '=';
                if ('finance-agent-balances' === $page_slug) {
                    $user_args['role__in'] = 'agent';
                    $status_result = array('Collect', 'Payout', 'Discount', 'Surcharge');
                }
                if ('finance-player-balances' === $page_slug) {
                    $user_args['role__in'] = 'player';
                    $status_result = array('Collect', 'Payout', 'Discount', 'Surcharge', 'Add Credit', 'Remove Credit');
                }
                $current_page_user = get_users($user_args);

                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="use_main_form">
                            <form class="finance-report-form">

                                <div class="row g-10">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form_input_wp form-element">
                                            <select class="" id="customDaterange">
                                                <option value="today" selected="">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="thisWeek">Current Week</option>
                                                <option value="lastWeek">Previous Week</option>
                                                <option value="thisMonth">Current Month</option>
                                                <option value="lastMonth">Previous Month</option>
                                            </select>
                                            <i class="far fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp">
                                            <i class="fal fa-user"></i>
                                            <input name="username_search" type="text" class="form_input" autocomplete="off" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-3">
                                        <div class="submit_btn">
                                            <button type="submit" class="sec-btn">Submit</button>
                                        </div>
                                    </div>
                                </div>

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



                            </form>
                        </div>

                        <table id="player_global_reports" class="table table-striped table-bordered dataTable no-footer nowrap">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Total Bet</th>
                                    <th>Win</th>
                                    <th>Total Balance</th>
                                    <th>Commission</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot class="d-none player-report-details">
                                <tr>
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <!-- <tr>
                                    <td>Loads and Withdrawals</td>
                                    <td class="player-bets">$0</td>
                                    <td class="player-win">$0</td>
                                    <td class="player-netwin">$0</td>
                                    <td></td>
                                </tr> -->
                                <tr>
                                    <td>Player Account Balance</td>
                                    <td></td>
                                    <td></td>
                                    <td class="player-reports-balance">$0</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="player-data-last-update">Last update <span>01-01-2022 08:00:00</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                </div>
            </div>
        </section>
    </div>

</div><!-- End of Main Container -->