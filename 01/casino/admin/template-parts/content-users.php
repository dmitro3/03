<div class="main_container">
    <div class="common_page_loader"><i class="fad fa-spinner-third fa-spin"></i></div>
    <div class="main_content_box">
        <section class="user_main_sec">
            <div class="title_bar">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="title">
                            <h1 class="h1-title">Users</h1>
                            <a href="javascript:void(0);" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="agent-tree-list" class="sec-btn modal-html-btn agent-tree-modal-btn" title="Agent Tree"> Agent Tree </a>
                        </div>
                    </div>
                    <div class="col-lg-7 text-lg-right">
                        <div class="button_group">
						
						
						<!--
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="add_player_Modal" class="sec-btn modal-html-btn" title="Add Player"> Player <i class="far fa-plus-circle"></i></a>
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="add_agent_Modal" class="sec-btn modal-html-btn" title="Add Agent"> Agent <i class="far fa-plus-circle"></i></a>
						-->	
							
							
                            <a href="javascript:void(0)" data-user-id="<?php echo get_current_user_id(); ?>" data-loader="1" data-target="add_referral_modal" class="sec-btn modal-html-btn" title="Get Referral Link"> Get Referral Link <i class="far fa-plus-circle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user_main_sec_content">
               
                <div class="row">
                    <div class="col-lg-9">
                        <?php
                        global $sports_list, $casino_list, $poker_list;
                        ?>
                        <table id="user_data" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <?php
                                    $current_user_info = wp_get_current_user();
                                    $casino_admin =  get_user_meta( get_current_user_id() , 'casino_admin', true);
                                    if((isset($casino_admin) && !empty($casino_admin) && $casino_admin === 1 ) || $current_user_info->roles[0] === 'administrator'){?>
                                        <th>Credits</th>
                                        <th>Actions </th>
                                        <th></th>
                                        <input type="hidden" id="super-admin-user" value="super-admin">
                                        <?php 
                                    } ?>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-3" data-no-translation>
                        <?php include get_template_directory().'/admin/template-parts/agents-sidebar.php'; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div><!-- End of Main Container -->

<div class="modal fade center-modal-view show" id="add_player_Modal" tabindex="-1" aria-modal="true">
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
</div>

<!-- Referral Modal -->
<div class="modal fade center-modal-view show" id="add_referral_modal" tabindex="-1" aria-modal="true">
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