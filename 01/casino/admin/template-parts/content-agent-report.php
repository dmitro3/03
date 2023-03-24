<?php
$page_id = get_the_ID();
$page_slug = get_post_field('post_name', $page_id);
$currency_symbol = get_woocommerce_currency_symbol(get_option('woocommerce_currency'));
?>

<div class="main_container">
    <div class="main_content_box">
        <section class="user_main_sec">
            <div class="title_bar">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="title">
                            <h1 class="h1-title">Agents Report</h1>
                            <a href="javascript:void(0);" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="agent-tree-list" class="sec-btn modal-html-btn agent-tree-modal-btn" title="Agent Tree"> Agent Tree </a>
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
                    <div class="col-lg-9">
                        <div class="use_main_form">
                            <form class="finance-report-form">
                                <div class="row g-10">
                                    <div class="col-lg-5">
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
                                    <div class="col-lg-7">
                                        <div class="button_group finance-button_group">
                                            <button class="sec-btn details-btn" data-click="0">Details</button>
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
                        <?php 
                        $current_user_info = get_userdata( get_current_user_id() );
                        $casino_admin =  get_user_meta( get_current_user_id() , 'casino_admin', true);
                        if((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1 ) || $current_user_info->roles[0] === 'administrator'){ ?>
                            <input type="hidden" id="super-admin-agent" value="super-admin">
                            <?php 
                        } ?>
                        <table id="global_reports" class="table table-striped table-bordered dataTable no-footer nowrap">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Number of Bets</th>
                                    <th>Total Bet</th>
                                    <th>Win</th>
                                    <!-- <th>Total Balance</th> -->
                                    <th>Commission</th>
                                    <?php 
                                    $current_user_info = get_userdata( get_current_user_id() );
                                    $casino_admin =  get_user_meta( get_current_user_id() , 'casino_admin', true);
                                    if((isset($casino_admin) && !empty($casino_admin) && $casino_admin == 1 ) || $current_user_info->roles[0] === 'administrator'){ 
                                        $total_payment_colspan = 5;
                                        ?>
                                        <th>Pay Amount</th>
                                        <?php 
                                    } else {
                                        $total_payment_colspan = 4;   
                                    }?>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="total-payment" colspan="<?php echo $total_payment_colspan; ?>" style="text-align: right;"><b>Total Amount</b></td>
                                    <td><b class="status_wise_total"> <?php echo $currency_symbol; ?> 0.00</b></td>
                                </tr>
                                <!-- <tr class="d-none agent-data-details">
                                    <td colspan="7">&nbsp;</td>
                                </tr>
                                <tr class="d-none agent-data-details">
                                    <td>Chips Sale</td>
                                    <td></td>
                                    <td></td>
                                    <td><?php echo $currency_symbol; ?>0.00</td>
                                    <td><?php echo $currency_symbol; ?>0.00</td>
                                    <td><?php echo $currency_symbol; ?>0.00</td>
                                    <td></td>
                                </tr>
                                <tr class="d-none agent-data-details">
                                    <td colspan="6" style="text-align: right;"><b>Sales included</b></td>
                                    <td><b class="sales_included_total"><?php echo $currency_symbol; ?>0.00</b></td>
                                </tr> -->
                                <tr class="d-none agent-data-details">
                                    <td colspan="7">&nbsp;</td>
                                </tr>
                                <tr class="d-none agent-data-details">
                                    <td colspan="5">Agents credits</td>
                                    <td class="total-agents-credits"><b><?php echo $currency_symbol; ?>0.00</b></td>
                                    <td></td>
                                </tr>
                                <tr class="d-none agent-data-details">
                                    <td colspan="5">Players credits</td>
                                    <td class="total-players-credits"><?php echo $currency_symbol; ?>0.00</td> <!-- <button class="btn btn-light btn-sm" id="players_balance_calculate">Calculate</button> -->
                                    <td></td>
                                </tr>
                            </tfoot>
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