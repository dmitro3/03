<?php
global $api_server_url;
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
                            <h1 class="h1-title"><?php if ('finance-agent-balances' === $page_slug) {
                                                        echo 'Agents';
                                                    } else {
                                                        echo 'Players';
                                                    }  ?> Balances</h1>
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

                if ('finance-agent-balances' === $page_slug) {
                    $user_role = 'agent';
                    $status_result = array("collect", "payout", "discount", "surcharge");
                }
                if ('finance-player-balances' === $page_slug) {
                    $user_role = 'player';
                    $status_result = array("collect", "payout", "discount", "surcharge", "Add Credit", "Remove credit");
                }

                $agere_casino_id = get_field('agere_casino_id', 'option');
                $agere_token = get_field('agere_token', 'option');
                $current_login .= site_url('/') . '_' . get_current_user_id();
                $agent_list_api = $api_server_url . "/casinos/casino-admin-reports?action=finance-user-list&type=" . $user_role . "&token=" . $agere_token . "&casino=" . $agere_casino_id . "&remote_id=" . $current_login;

                $agent_list_content = file_get_contents($agent_list_api);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="use_main_form">
                            <form action="" class="finance-report-form">

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
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp form-element">
                                            <select name="username" class="form_input">
                                                <option value="all">All <?php echo ucwords($user_role); ?>s</option>
                                                <?php

                                                if (isset($agent_list_content) && !empty($agent_list_content)) {
                                                    $agent_list_data = json_decode($agent_list_content);
                                                    $all_list = $agent_list_data->data->users;
                                                    foreach ($all_list as $key => $value) {
                                                        $user_info = get_userdata($value->remoteId);
                                                        if (!empty($user_info)) {

                                                ?>
                                                            <option value="<?php echo $value->remoteId; ?>"><?php echo $user_info->display_name; ?></option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <i class="far fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="form_input_wp form-element">
                                            <select name="status" class="form_input">
                                                <option value="all">All Operations</option>
                                                <?php
                                                if (!empty($status_result) && isset($status_result)) {

                                                    foreach ($status_result as $key => $value) {

                                                ?>
                                                        <option value="<?php echo strtolower($value); ?>"><?php echo $value; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <i class="far fa-angle-down"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6">
                                        <?php
                                        if ('finance-agent-balances' === $page_slug) {
                                            echo ' <input type="hidden" name="userrole" value="agent" >';
                                        }
                                        if ('finance-player-balances' === $page_slug) {
                                            $user_args['role__in'] = 'player';
                                            echo ' <input type="hidden" name="userrole" value="player" >';
                                        }
                                        ?>

                                    </div>

                                    <div class="col-lg-3 col-sm-12">
                                        <div class="submit_btn">
                                            <button type="submit" class="sec-btn">Submit</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <table id="report_balances" class="table table-striped table-bordered dataTable no-footer nowrap">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Operation</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th class="finance-balance-more-info"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot class="d-none-1">
                                <tr>
                                    <td colspan="3" style="text-align: right;"><b>Total</b></td>
                                    <td><b class="status_wise_total"><?php echo add_currency_symbol("0.00"); ?></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>

</div><!-- End of Main Container -->