<?php
    $post_id = get_the_ID();
    $post_slug = get_post_field( 'post_name', $post_id );
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
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/simplebar.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/jquery.fancybox.min.js'; ?>"></script>



<?php
if ('casino-admin' === $post_slug) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/chart.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/dashborad-chart.js'; ?>"></script>
<?php
}
if ('agent-report' === $post_slug ) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/global-reports.js'; ?>"></script>
<?php
}
if('player-report' === $post_slug){
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/player-global-reports.js'; ?>"></script>
<?php
}
if ('charges-and-withdrawals' === $post_slug || 'player-history' === $post_slug ) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/file-reports.js'; ?>"></script>
    <?php
}
if ('finance-agent-operation' === $post_slug || 'finance-players-operation' === $post_slug || 'finance-agent-balances' === $post_slug || 'finance-player-balances' === $post_slug) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/finance.js'; ?>"></script>
    <?php
}
if ('casino-game-reports' === $post_slug || 'sports-game-reports' === $post_slug || 'poker-game-reports' === $post_slug) {
    ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/mdb-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/game-reports.js'; ?>"></script>
    <?php
}
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/admin/assets/js/custom.js'; ?>">
</script>


</body>

</html>