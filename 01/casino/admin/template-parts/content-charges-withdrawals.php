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
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-target="add_player_Modal" class="sec-btn modal-html-btn" title="Add Player"> Player <i class="far fa-plus-circle"></i></a>
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-target="add_agent_Modal" class="sec-btn modal-html-btn" title="Add Agent"> Agent <i class="far fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user_main_sec_content">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="use_main_form">
                            <form action="" class="charges-withdrawals-form">
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
                                    <div class="col-lg-2 col-sm-6">
                                        <div class="form_input_wp form-element">
                                            <select name="userrole" class="form_input">
                                                <option value="player">Players</option>
                                                <option value="agent">Agents</option>
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
                                    <div class="col-lg-5 col-sm-6">
                                        <div class="form_checkbox_wp checkbox_filter checkbox_agent">
                                            <div class="form_checkbox">
                                                <input type="checkbox" name="transaction_checkbox" data-vaql="direct_children" value="direct" class="form-check-input" id="direct">
                                                <label class="form-check-label" data-button-toggle="tooltip" for="direct" data-original-title="Only show uploads and withdrawals made to direct users">Only direct <i class="fas fa-info"></i></label>
                                            </div>
                                            <div class="form_checkbox">
                                                <input type="checkbox" name="transaction_checkbox" data-vaql="by_parent" value="received" class="form-check-input" id="received">
                                                <label class="form-check-label" data-button-toggle="tooltip" for="received" data-original-title="Show uploads and withdrawals made to my panel">Received <i class="fas fa-info"></i></label>
                                            </div>
                                        </div>
                                        <div class="form_checkbox_wp checkbox_filter checkbox_player">
                                            <div class="form_checkbox">
                                                <input type="checkbox" name="transaction_checkbox" data-vaql="direct_children" value="direct" class="form-check-input" id="direct">
                                                <label class="form-check-label" data-button-toggle="tooltip" for="direct" data-original-title="Only show uploads and withdrawals made to direct users">Only direct <i class="fas fa-info"></i></label>
                                            </div>
                                            <div class="form_checkbox">
                                                <input type="checkbox" name="transaction_checkbox" data-vaql="by_parent" value="higher" class="form-check-input" id="received">
                                                <label class="form-check-label" data-button-toggle="tooltip" for="received" data-original-title="Show uploads and withdrawals made to my panel">Higher user <i class="fas fa-info"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6">
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
                                    <th>Source</th>
                                    <th>Destination</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
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