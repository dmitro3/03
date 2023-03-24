<div class="main_container">
    <div class="main_content_box">
        <section class="user_main_sec">
            <div class="title_bar">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="title">
                            <h1 class="h1-title">Users</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <div class="button_group">

                            <a href="javascript:void(0)" data-toggle="modal" data-target="#add_player_Modal"
                                class="sec-btn" title="Add Player">
                                Player
                                <i class="far fa-plus-circle"></i>
                            </a>

                            <a href="javascript:void(0)" data-toggle="modal" data-target="#request_a_quote_Modal"
                                class="sec-btn" title="Add Agent">
                                Agent
                                <i class="far fa-plus-circle"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="user_main_sec_content">
                <div class="row">
                    <div class="col-lg-9">
                        <?php
                        $all_users_data = get_users(array('fields' => array('ID', 'display_name', 'user_login'), 'role__in' => array('player', 'agent')));

                        global $sports_list, $casino_list, $poker_list;
                        ?>
                        <table id="user_data" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Records</th>
                                    <th>Actions</th>
                                    <th>info</th>
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

<div class="modal fade show" id="add_player_Modal" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Add player</h3>
                <div class="modal_tablist">
                    <ul>
                        <li data-tab="entry" class="active_modal_tab error-tab">
                            entry
                        </li>
                        <li data-tab="personal-information">
                            Personal information
                        </li>
                        <li data-tab="permission">
                            permission
                        </li>
                    </ul>
                </div>

                <form class="vr_add_user_from">

                    <div class="modal-from-section entry-sec">
                        <div class="modal_form">
                            <div class="form_input_wp">
                                <i class="fal fa-user"></i>
                                <input name="username" type="text" class="form_input" autocomplete="off"
                                    placeholder="UserName">
                            </div>
                            <div class="form_input_wp">
                                <i class="fal fa-eye"></i>
                                <input name="password" type="password" class="form_input" autocomplete="off"
                                    placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="modal-from-section personal-information-sec" style="display: none;">
                        <div class="modal_form">
                            <div class="form_input_wp">
                                <i class="fal fa-user"></i>
                                <input name="fullname" type="text" class="form_input" placeholder="Fullname">
                            </div>
                            <div class="form_input_wp">
                                <i class="fal fa-id-card"></i>
                                <input name="document" type="text" class="form_input" placeholder="Document">
                            </div>

                            <div class="form_input_wp">
                                <i class="fal fa-envelope"></i>
                                <input name="user_email" type="email" class="form_input" placeholder="E-mail">
                            </div>

                            <div class="form_input_wp">
                                <i class="fal fa-phone-alt"></i>
                                <input name="phone" type="text" class="form_input" placeholder="phone">
                            </div>
                        </div>
                    </div>

                    <div class="modal-from-section permission-sec" style="display: none;">
                        <div class="form_chechbox-sec-wp">
                            <div class="form_chechbox-sec">
                                <div class="form_chocbox-header">
                                    <span>Sports</span>
                                    <div class="form_checkbox">
                                        <input type="checkbox" id="all_sports" class="vr_ck_everyone">
                                        <label for="all_sports" class="form-check-label">Everyone</label>
                                    </div>
                                </div>
                                <div class="form_short-list-ck form_ck-list">

                                    <?php
                                    if (isset($sports_list) && !empty($sports_list)) {
                                        foreach ($sports_list as $key => $value) {
                                    ?>
                                    <div class="form_checkbox">
                                        <input type="checkbox" name="sports[]" value="<?php echo $key; ?>"
                                            class="form-check-input" id="<?php echo $value; ?>">
                                        <label class="form-check-label"
                                            for="<?php echo $value; ?>"><?php echo $value; ?></label>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form_chechbox-sec">
                                <div class="form_chocbox-header">
                                    <span>Casino</span>
                                    <div class="form_checkbox">
                                        <input type="checkbox" id="all_casino" class="vr_ck_everyone">
                                        <label for="all_casino" class="form-check-label">Everyone</label>
                                    </div>
                                </div>
                                <div class="form_short-list-ck form_ck-list">

                                    <?php
                                    if (isset($casino_list) && !empty($casino_list)) {
                                        foreach ($casino_list as $key => $value) {
                                    ?>
                                    <div class="form_checkbox">
                                        <input type="checkbox" name="casino[]" value="<?php echo $key; ?>"
                                            class="form-check-input" id="<?php echo $value; ?>">
                                        <label class="form-check-label"
                                            for="<?php echo $value; ?>"><?php echo $value; ?></label>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal_footer">
                        <button type="submit" class="sec-btn">Submit</button>
                        <span class="load-more"><i class="fad fa-spinner-third  fa-spin ajax-loader"></i></span>
                        <input type="hidden" name="user_role" value="player">
                    </div>
                    <p class="error-msg vr-uname-err" style="display: none;">Please enter valid username.</p>
                    <p class="error-msg vr-pwd-err" style="display: none;">Please enter valid password.</p>
                    <p class="error-msg vr-email-err" style="display: none;">Please enter valid email.</p>
                    <p class="success-msg" style="display: none;">your account has been created successfully.</p>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade show" id="request_a_quote_Modal" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Add Agent</h3>
                <div class="modal_tablist">
                    <ul>
                        <li data-tab="entry" class="active_modal_tab">
                            entry
                        </li>
                        <li data-tab="personal-information">
                            Personal information
                        </li>
                        <li data-tab="permission">
                            permission
                        </li>
                        <li data-tab="commissions">
                            commissions
                        </li>
                    </ul>
                </div>

                <form class="vr_add_user_from">
                    <div class="modal-from-section entry-sec">
                        <div class="modal_form">
                            <div class="form_input_wp">
                                <i class="fal fa-user"></i>
                                <input name="username" type="text" class="form_input" placeholder="UserName">
                            </div>
                            <div class="form_input_wp">
                                <i class="fal fa-eye"></i>
                                <input name="password" type="password" class="form_input" placeholder="Password">
                            </div>
                        </div>
                    </div>


                    <div class="modal-from-section personal-information-sec" style="display: none;">
                        <div class="modal_form">
                            <div class="form_input_wp">
                                <i class="fal fa-user"></i>
                                <input name="fullname" type="text" class="form_input" placeholder="Fullname">
                            </div>
                            <div class="form_input_wp">
                                <i class="fal fa-id-card"></i>
                                <input name="document" type="text" class="form_input" placeholder="Document">
                            </div>

                            <div class="form_input_wp">
                                <i class="fal fa-envelope"></i>
                                <input name="user_email" type="email" class="form_input" placeholder="E-mail">
                            </div>

                            <div class="form_input_wp">
                                <i class="fal fa-phone-alt"></i>
                                <input name="phone" type="text" class="form_input" placeholder="phone">
                            </div>
                        </div>
                    </div>

                    <div class="modal-from-section permission-sec" style="display: none;">
                        <div class="form_chechbox-sec-wp">
                            <div class="form_chechbox-sec">
                                <div class="form_chocbox-header">
                                    <span>Sports</span>
                                    <div class="form_checkbox">
                                        <input type="checkbox" id="all_sports" class="vr_ck_everyone">
                                        <label for="all_sports" class="form-check-label">Everyone</label>
                                    </div>
                                </div>
                                <div class="form_short-list-ck form_ck-list">

                                    <?php
                                    if (isset($sports_list) && !empty($sports_list)) {
                                        foreach ($sports_list as $key => $value) {
                                    ?>
                                    <div class="form_checkbox">
                                        <input type="checkbox" name="sports[]" value="<?php echo $key; ?>"
                                            class="form-check-input" id="<?php echo $value; ?>">
                                        <label class="form-check-label"
                                            for="<?php echo $value; ?>"><?php echo $value; ?></label>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form_chechbox-sec">
                                <div class="form_chocbox-header">
                                    <span>Casino</span>
                                    <div class="form_checkbox">
                                        <input type="checkbox" id="all_casino" class="vr_ck_everyone">
                                        <label for="all_casino" class="form-check-label">Everyone</label>
                                    </div>
                                </div>
                                <div class="form_short-list-ck form_ck-list">
                                    <?php
                                    if (isset($casino_list) && !empty($casino_list)) {
                                        foreach ($casino_list as $key => $value) {
                                    ?>
                                    <div class="form_checkbox">
                                        <input type="checkbox" name="casino[]" value="<?php echo $key; ?>"
                                            class="form-check-input" id="<?php echo $value; ?>">
                                        <label class="form-check-label"
                                            for="<?php echo $value; ?>"><?php echo $value; ?></label>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-from-section commissions-sec" style="display: none;">
                        <div class="commissions_modal_form">

                            <div class="settle_dropdown">
                                <label for="">Settle automatically</label>
                                <div class="form-element">
                                    <select name="commission_automatically" aria-controls="" class="form_input">
                                        <option value="monthly">Monthly</option>
                                        <option value="weekly">Weekly</option>
                                    </select>
                                    <i class="far fa-angle-down"></i>
                                </div>
                            </div>

                            <div class="form_chechbox-sec-wp">
                                <div class="form_chechbox-sec form_input-sec">
                                    <div class="form_input-sec_list all-commission-main-box">
                                        <div class="form_chocbox-header">
                                            <span>Poker</span>
                                            <div class="form-element">
                                                <input type="number" name="everyone_commission" class="form_input"
                                                    placeholder="Everyone">
                                                <i class="far fa-percent"></i>
                                            </div>
                                        </div>
                                        <div class="form_short-list-ck form_input-list">

                                            <?php
                                            if (isset($poker_list) && !empty($poker_list)) {
                                                foreach ($poker_list as $key => $value) {
                                            ?>
                                            <div class="form_input_wp">
                                                <label class="form-check-label"><?php echo $value; ?></label>
                                                <div class="form_input-number">
                                                    <input type="number" name="poker_commission[<?php echo $key; ?>]"
                                                        class="form_input">
                                                    <i class="far fa-percent"></i>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <div class="form_input-sec_list all-commission-main-box">
                                        <div class="form_chocbox-header">
                                            <span>Sports</span>
                                            <div class="form-element">
                                                <input type="number" name="everyone_commission" class="form_input"
                                                    placeholder="Everyone">
                                                <i class="far fa-percent"></i>
                                            </div>
                                        </div>
                                        <div class="form_short-list-ck form_input-list">

                                            <?php
                                            if (isset($sports_list) && !empty($sports_list)) {
                                                foreach ($sports_list as $key => $value) {
                                            ?>
                                            <div class="form_input_wp">
                                                <label class="form-check-label"><?php echo $value; ?></label>
                                                <div class="form_input-number">
                                                    <input type="number" name="sports_commission[<?php echo $key; ?>]"
                                                        class="form_input">
                                                    <i class="far fa-percent"></i>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form_chechbox-sec form_input-sec all-commission-main-box">
                                    <div class="form_chocbox-header">
                                        <span>Casino</span>
                                        <div class="form-element">
                                            <input type="number" name="everyone_commission" class="form_input"
                                                placeholder="Everyone">
                                            <i class="far fa-percent"></i>
                                        </div>
                                    </div>
                                    <div class="form_short-list-ck form_input-list">

                                        <?php
                                        if (isset($casino_list) && !empty($casino_list)) {
                                            foreach ($casino_list as $key => $value) {
                                        ?>

                                        <div class="form_input_wp">
                                            <label class="form-check-label"
                                                for="casino_ck"><?php echo $value; ?></label>
                                            <div class="form_input-number">
                                                <input type="number" name="casino_commission[<?php echo $key; ?>]"
                                                    class="form_input">
                                                <i class="far fa-percent"></i>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal_footer">
                        <button type="submit" class="sec-btn">Submit</button>
                        <input type="hidden" name="user_role" value="agent">
                        <span class="load-more"><i class="fad fa-spinner-third  fa-spin ajax-loader"></i></span>
                        <p class="error-msg vr-uname-err" style="display: none;">Please enter valid username.</p>
                        <p class="error-msg vr-pwd-err" style="display: none;">Please enter valid password.</p>
                        <p class="error-msg vr-email-err" style="display: none;">Please enter valid email.</p>
                        <p class="success-msg" style="display: none;">your account has been created successfully.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="load_tabs_Modal" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Load Tabs</h3>
                <div class="form_input_group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-modal-addon">
                            <i class="fas fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="text" class="form_input" id="" readonly value="Pirry2022">
                    <input type="text" class="form_input" id="" readonly value="676.072,00">
                </div>

                <div class="form_input_group">
                    <div class="d-flex">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-modal-addon">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="number" class="form_input" id="" aria-label="amount" autocomplete="off"
                            value="0.05" placeholder="0.00">
                    </div>
                    <div class="table_btn_group form_right_group">
                        <ul>
                            <li>
                                <button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip"
                                    title="increase">
                                    <i class="far fa-plus"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip"
                                    title="decrease">
                                    <i class="far fa-minus"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="add_coin_group">
                    <ul>
                        <li>
                            <button type="button" class="sec-btn sm-btn" data-button-toggle="tooltip"
                                title="increase 100">
                                <i class="far fa-plus"></i>
                                100
                            </button>
                        </li>
                        <li>
                            <button type="button" class="sec-btn sm-btn" data-button-toggle="tooltip"
                                title="increase 1,000">
                                <i class="far fa-plus"></i>
                                1,000
                            </button>
                        </li>
                        <li>
                            <button type="button" class="sec-btn sm-btn" data-button-toggle="tooltip"
                                title="increase  10,000">
                                <i class="far fa-plus"></i>
                                10,000
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="form_input_group">
                    <div class="d-flex form_checkbox_group">
                        <div class="form_checkbox">
                            <input type="checkbox" name="" value="" class="form-check-input" id="register_charged">
                            <label class="form-check-label" for="register_charged">Register Charged</label>
                        </div>

                        <div class="form_checkbox">
                            <input type="checkbox" name="" value="" class="form-check-input" id="register_bonus">
                            <label class="form-check-label" for="register_bonus">Register Bonus</label>
                        </div>
                    </div>
                    <div class="form_right_group">
                        <button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip"
                            title="Balance in finance: 0.00">
                            <i class="fal fa-dollar-sign"></i>
                        </button>
                    </div>
                </div>

                <div class="modal_footer">
                    <button type="submit" class="sec-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="download_sheets_Modal" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Download Sheets</h3>
                <div class="form_input_group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-modal-addon">
                            <i class="fas fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input type="text" class="form_input" id="" readonly value="Pirry2022">
                    <input type="text" class="form_input" id="" readonly value="676.072,00">
                </div>

                <div class="form_input_group">
                    <div class="d-flex">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-modal-addon">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="number" class="form_input" id="" aria-label="amount" autocomplete="off"
                            value="0.05" placeholder="0.00">
                    </div>
                    <div class="table_btn_group form_right_group">
                        <ul>
                            <li>
                                <button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip"
                                    title="increase">
                                    <i class="far fa-plus"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip"
                                    title="decrease">
                                    <i class="far fa-minus"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="add_coin_group">
                    <ul>
                        <li>
                            <button type="button" class="sec-btn sm-btn" data-button-toggle="tooltip"
                                title="increase 100">
                                <i class="far fa-plus"></i>
                                100
                            </button>
                        </li>
                        <li>
                            <button type="button" class="sec-btn sm-btn" data-button-toggle="tooltip"
                                title="increase 1,000">
                                <i class="far fa-plus"></i>
                                1,000
                            </button>
                        </li>
                        <li>
                            <button type="button" class="sec-btn sm-btn" data-button-toggle="tooltip"
                                title="increase  10,000">
                                <i class="far fa-plus"></i>
                                10,000
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="form_input_group">
                    <div class="d-flex form_checkbox_group">
                        <div class="form_checkbox">
                            <input type="checkbox" name="" value="" class="form-check-input" id="register_paid">
                            <label class="form-check-label" for="register_paid">Register Paid</label>
                        </div>
                    </div>
                    <div class="form_right_group">
                        <button type="button" class="sec-btn icon_btn" data-button-toggle="tooltip"
                            title="Balance in finance: 0.00">
                            <i class="fal fa-dollar-sign"></i>
                        </button>
                    </div>
                </div>

                <div class="modal_footer">
                    <button type="submit" class="sec-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="user_information_Modal" aria-modal="true">
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

<div class="modal fade" id="change_password" aria-modal="true">
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

<div class="modal fade" id="modify_popup_player" aria-modal="true">
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
<div class="modal fade" id="modify_popup_agent" aria-modal="true">
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

<div class="modal fade" id="to_lock_popup" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Block user</h3>

                <form class="modal_form">
                    <div class="form_input_wp">
                        <label for="">Blocking reason (optional)</label>
                        <textarea name="" id="" rows="3" placeholder="Massage" class="form_input"></textarea>
                    </div>
                </form>

                <div class="modal_footer">
                    <button type="submit" class="sec-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>