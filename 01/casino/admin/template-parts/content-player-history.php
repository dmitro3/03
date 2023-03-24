<div class="main_container">
    <div class="main_content_box">
        <section class="user_main_sec">
            <div class="title_bar">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="title">
                            <h1 class="h1-title">Player History</h1>
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


                <div class="row">
                    <div class="col-lg-12">
                        <div class="use_main_form">
                            <form action="" class="player-history-form">
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
                                        <div class="form_input_wp">
                                            <i class="fal fa-user"></i>
                                            <input name="username_search" type="text" class="form_input" autocomplete="off" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 for-des">

                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="submit_btn">
                                            <button type="submit" class="sec-btn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table id="player_history" class="table table-striped table-bordered dataTable no-footer nowrap">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Provider</th>
                                    <th>Operation</th>
                                    <th>Amount</th>
                                    <th>Balance Before</th>
                                    <th>Balance After</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </section>
    </div>
</div>