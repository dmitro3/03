<?php
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
                            <h1 class="h1-title">My summary </h1>
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

                        <div class="my-summary-payment">
                            <p>Payment: <span><?php echo add_currency_symbol(number_format(0.00, 2)); ?></span></p>
                        </div>

                        <table id="summary_datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Operation</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th width="50"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>

                    <div class="col-lg-3">


                    </div>
                </div>
            </div>
        </section>
    </div>

</div><!-- End of Main Container -->