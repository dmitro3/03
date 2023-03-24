<?php
    $post_id = get_the_ID();
    $page_slug = get_post_field( 'post_name', $post_id );
?>
<div class="modal fade center-modal-view" id="main_change_password" tabindex="-1"  aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Change Password</h3>
                <form class="modal_form user_change_pwd_form">
                    <div class="form_input_wp">
                        <i class="fal fa-eye"></i>
                        <input name="new_assword" type="password" class="form_input" placeholder="New Password">
                    </div>
                    <div class="form_input_wp">
                        <i class="fal fa-eye"></i>
                        <input name="confirm_password" type="password" class="form_input"
                            placeholder="confirm Password">
                    </div>
                    <div class="modal_footer">
                        <button type="submit" class="sec-btn">Submit</button><input type="hidden"
                            value="<?php echo get_current_user_id(); ?>" name="user_id">
                    </div>
                    <p class="error-msg vr-newpwd-err">Please enter password.</p>
                    <p class="error-msg vr-conpwd-err">Please enter confirm password.</p>
                    <p class="success-msg pwd-success-msg">password is successfully update.</p>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade center-modal-view" id="contact-support" tabindex="-1"  aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Contact Support</h3>
                <?php $contact_support_user_id = get_current_user_id(); ?>
                <?php echo do_shortcode('[contact-form-7 id="753501" title="Contact Support" html_class="contact_support_form" contact-support-user-id="'.$contact_support_user_id.'"]'); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade center-modal-view" id="login-history" tabindex="-1"  aria-modal="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title">Login History</h3>
                <div class="table table-striped table-bordered dataTable">
                    <?php echo do_shortcode("[user_login_history limit='10'  columns='time_login,login_status,ip_address,user_agent' date_format='Y-m-d' time_format='H:i:s']"); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade center-modal-view" id="change-language" tabindex="-1"  aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>
                <h3 class="h3-title modal_title"> Change language</h3>
                <div class="lang-switcher">
                    <?php echo do_shortcode('[language-switcher]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/jquery.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/popper.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/bootstrap.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/jquery.datatables.min.js'; ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/simplebar.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/jquery.fancybox.min.js'; ?>"></script>



<?php 
if ('casino-admin' === $page_slug) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/chart.min.js?'.current_time('timestamp'); ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/dashborad-chart.js?'.current_time('timestamp'); ?>"></script>
<?php
}
if ('agent-report' === $page_slug ) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/global-reports.js?'.current_time('timestamp'); ?>"></script>
<?php
}
if('player-report' === $page_slug){
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/player-global-reports.js?'.current_time('timestamp'); ?>"></script>
<?php
}
if ('charges-and-withdrawals' === $page_slug || 'player-history' === $page_slug ) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/file-reports.js?'.current_time('timestamp'); ?>"></script>
    <?php
}
if ('finance-agent-operation' === $page_slug || 'finance-players-operation' === $page_slug || 'finance-agent-balances' === $page_slug || 'finance-player-balances' === $page_slug || 'finance-players-withdrawal-request' === $page_slug) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/finance.js?'.current_time('timestamp'); ?>"></script>
    <?php
}
if ('casino-game-reports' === $page_slug || 'sports-game-reports' === $page_slug || 'poker-game-reports' === $page_slug) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/game-reports.js?'.current_time('timestamp'); ?>"></script>
    <?php
}
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/custom.js?'.current_time('timestamp'); ?>">
</script>


</body>

</html>