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
                            <h1 class="h1-title">Financial <?php if ('finance-agent-operation' === $page_slug) {
                                                                echo 'Agents';
                                                            } else {
                                                                echo 'Players';
                                                            }  ?> </h1>
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
                    <div class="col-lg-12">

                        <table id="finance_operations" data-user-role="<?php if ('finance-agent-operation' === $page_slug) {
                                                                            echo 'agent';
                                                                        } else {
                                                                            echo 'player';
                                                                        }  ?>" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot class="d-none-1">
                                <tr>
                                    <td style="text-align: right;"><b>Total payment</b></td>
                                    <td><b class="finance_total"><?php echo $currency_symbol; ?> 0.00</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-lg-3">


                    </div>
                </div>
            </div>
        </section>
    </div>

</div><!-- End of Main Container -->



<div class="modal fade center-modal-view" id="finance_modal" tabindex="-1" aria-modal="true">
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