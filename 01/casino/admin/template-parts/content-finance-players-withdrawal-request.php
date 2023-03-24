<div class="main_container">
    <input type="hidden" id="security_nonce" name="" data-nonce="<?php echo wp_create_nonce('woo-wallet-withdrawal-post-type-action') ?>">
    <div class="common_page_loader"><i class="fad fa-spinner-third fa-spin"></i></div>
    <div class="main_content_box">
        <section class="user_main_sec">
            <div class="title_bar">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="title">
                            <h1 class="h1-title">Withdrawal Request</h1>
                            <a href="javascript:void(0);" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="agent-tree-list" class="sec-btn modal-html-btn agent-tree-modal-btn" title="Agent Tree"> Agent Tree </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user_main_sec_content">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        global $sports_list, $casino_list, $poker_list;
                        ?>
                        <table id="withdrawal_data" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Gateway Charge</th>
                                    <th>Status</th>
                                    <th>Method</th>
                                    <th>Date</th>
                                    <th>Action</th>
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
</div><!-- End of Main Container -->

 <div class="modal fade center-modal-view show" id="get_woo_wallet_withdrawal_details_Modal" tabindex="-1" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <div class="modal-body overflow-text" data-simplebar>

            </div>
        </div>
    </div>
</div>
<!--
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

<div class="modal fade center-modal-view" id="user_information_Modal" tabindex="-1" aria-modal="true">
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

<div class="modal fade center-modal-view" id="change_password" tabindex="-1" aria-modal="true">
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

<div class="modal fade center-modal-view" id="modify_popup_player" tabindex="-1" aria-modal="true">
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
<div class="modal fade center-modal-view" id="modify_popup_agent" tabindex="-1" aria-modal="true">
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

<div class="modal fade center-modal-view" id="to_lock_popup" tabindex="-1" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body overflow-text" data-simplebar>

            </div>
        </div>
    </div>
</div> -->