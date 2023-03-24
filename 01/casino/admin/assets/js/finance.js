function loadFile(event) {
    const image = document.getElementById("finance-image-preview");
    if (image.src.trim() != "") {
        const reader = new FileReader();
        reader.onload = function () {
            jQuery(".attach_proof_preview_wp").show();
            image.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
}

function add_currency_symbol(amount) {
    let currency_symbol = jQuery('.currency_symbol').text();
    console.log(typeof amount);
    let negative = 0 > amount ? `-${currency_symbol}` : currency_symbol;
    return amount !== '' || amount !== null ? negative + Math.abs(amount) : '';


    // $currency_symbol = get_woocommerce_currency_symbol(get_option('woocommerce_currency'));
    // $negative = 0 > $amount ? "-{$currency_symbol}" : $currency_symbol;
    // return $amount !== '' || $amount !== null ? $negative . abs($amount) : '';
}

$(document).ready(function () {
    const symbol = jQuery(".woocommerce-Price-currencySymbol.symbol-only").text();
    var ajaxurl = jQuery("input[name=ajaxurl]").attr("data-ajaxurl");

    /**
     * Agent and Player Operations Page JS Start     *
     */
    /** Finance Operations Agent and Player list datatable Start*/
    var submit_btn_html =
        '<div class="submit_btn"><button type="submit" class="sec-btn finance-operations-submit">Submit</button></div>';

    var financeOprTable = $("#finance_operations").DataTable({
        dom: '<"table_filter_topbar finance_data" <"row align-items-center"<"col-sm-12" <"finance-operations-top-bar" f <"table_submit_button">>>>>r <"responsive-table-scroll" t> <"table_filter_bottombar"<"row align-items-center"<"col-sm-6"l><"col-sm-6"p>>>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Username...",
            processing: '<i class="fad fa-spinner-third fa-spin"></i>',
        },
        ordering: false,
        processing: true,
        serverSide: true,
        serverMethod: "post",
        ajax: {
            url: ajaxurl + "?action=finance_agent_data",
            data: function (data) {
                var user_role = jQuery("#finance_operations").attr("data-user-role");
                data.sort_user_role = user_role;
            },
        },
        columns: [
            {
                data: "username",
                render: function (data, type, row, meta) {
                    return '<sapn class="' + data.role + '_user_column" >' + data.name + "</sapn>";
                },
            },
            {
                data: "balance",
                render: function (data, type, row, meta) {
                    return data;
                }
            },
            { data: "action" },
        ],
        createdRow: function (row, data, dataIndex) {
            jQuery(".finance_total").text("");
            jQuery(".finance_total").html(data.totalamt);
        },
        paging: false,
    });
    $("#finance_operations_filter input").addClass("form_input");
    $("div.table_submit_button").html(submit_btn_html);
    $("div.table_filter_topbar.finance_data .dataTables_filter input").unbind();

    jQuery(".finance-operations-submit").on("click", function () {
        financeOprTable
            .search($("div.table_filter_topbar.finance_data .dataTables_filter input").val())
            .draw();
        // financeOprTable.draw(true);
        // setTimeout(function () {
        //     $('body [data-button-toggle="tooltip"]').tooltip({
        //         trigger: "hover",
        //     });
        // }, 1000);
    });

    jQuery("body").on("click", "#user_data_wrapper .modal_tablist ul li", function () {
        jQuery("body #user_data_wrapper .modal_tablist ul li").removeClass("active_modal_tab");
        jQuery(this).addClass("active_modal_tab");
        financeOprTable.draw(true);
        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
            });
        }, 1000);
    });
    /** User page user list datatable End*/

    /** User table show user information pop up */
    jQuery("body").on("click", ".finance-modal-html-btn", function () {
        var user_id = jQuery(this).attr("data-user-id");
        var status = jQuery(this).attr("data-modal-status");
        var modal_title = jQuery(this).attr("title");
        var payment_action = jQuery(this).attr("data-payment-action");
        var userBalance = jQuery(this).attr("data-balance");
        var user_role = jQuery("#finance_operations").attr("data-user-role");
        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "get_finance_modal_html",
                user_id: user_id,
                modal_title: modal_title,
                status: status,
                payment_action: payment_action,
                balance: userBalance,
                user_role: user_role,
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                jQuery("#finance_modal .modal-body").html(response);
                jQuery(".overflow-text").each((index, element) => new SimpleBar(element));
                jQuery("#finance_modal").modal("show");
                $('[data-button-toggle="tooltip"]').tooltip({
                    trigger: "hover",
                });
            },
        });
        return false;
        e.preventDefault();
    });

    /** finance form submit ajax  */
    // jQuery('body .finance_payment_form input[name=attach_proof]').change(function() {
    jQuery("#attach_proof").change(function () {
        console.log("image added");
    });

    jQuery(document).on("click", "button.finance-image-preview-close", function () {
        $(this).parents(".attach_proof_preview_wp").hide();
    });

    jQuery(document).on('blur input', 'form.finance_payment_form input[name=user_balance]', function() {
        if (this.value.indexOf('.') !== -1) {
            const decimals = this.value.length - this.value.indexOf('.');
            if( decimals > 3 ) this.value = this.value.slice(0, this.value.indexOf('.') + 3);
        }
    });

    jQuery("body").on("submit", ".finance_payment_form", function () {
        var balance = jQuery(this).find("input[name=user_balance]").val();
        
        if (balance.indexOf('.') !== -1) {
            const decimals = balance.length - balance.indexOf('.');
            if( decimals > 3 ) balance = balance.slice(0, balance.indexOf('.') + 3);
        }

        $this = jQuery(this);
        var err = 1;
        if (balance != 0) {
            err = 0;
        }
        if (err == 0) {
            var form_data = $(this).serialize();
            var imageData = new FormData();
            var file = jQuery(this).find("input[name=attach_proof]")[0].files[0];
            imageData.append("image_data", file);
            imageData.append("action", "finance_balance_action");
            imageData.append("form_data", form_data);

            jQuery(this).find(".load-more").css("display", "inline-block");
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: imageData,
                contentType: false,
                processData: false,
                // dataType: "text",
                success: function (response) {
                    if (response.response === "error") {
                        alert(response.message);
                        jQuery(this).find(".load-more").css("display", "none");
                    } else {
                        jQuery(this).find(".load-more").css("display", "none");
                        setTimeout(function () {
                            jQuery("#finance_modal").modal("hide");
                        }, 200);
                        financeOprTable.draw(true);
                        setTimeout(function () {
                            $('body [data-button-toggle="tooltip"]').tooltip({
                                trigger: "hover",
                            });
                        }, 1000);
                    }
                },
                error: function () {
                    alert("There was an error while update balance.");
                    jQuery(this).find(".load-more").css("display", "none");
                },
            });
        } else {
            alert("There was an error while update balance.");
            return false;
        }
        return false;
        event.preventDefault();
    });

    /**
     * Agent and Player Operations Page JS End    *
     *
     * *******************************************
     *
     *  Agent and Player Current accounts JS Start
     */

    $("#start_date").pickadate({
        max: new Date(),
        format: "dd mmm yyyy",
        formatSubmit: "yyyy/mm/dd",
        clear: "erase",
        // onSet: function () {
        //     accountDataTable.draw(true);
        // }
    });

    $("#end_date").pickadate({
        max: new Date(),
        format: "dd mmm yyyy",
        formatSubmit: "yyyy/mm/dd",
        clear: "erase",
        // onSet: function () {
        //     accountDataTable.draw(true);
        // }
    });
    $("#start_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () { accountDataTable.draw(true); }
    });
    $("#end_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () { accountDataTable.draw(true); }
    });
    var accountDataTable = $("#report_balances").DataTable({
        dom: '<"table_filter_topbar" <"row align-items-center"<"col-sm-6"f><"col-sm-6"<> >>>r <"responsive-table-scroll" t> <"table_filter_bottombar"<"row align-items-center"<"col-sm-6"l><"col-sm-6"p>>>',
        bFilter: false,
        language: { processing: '<i class="fad fa-spinner-third fa-spin"></i>' },
        ordering: false,
        processing: true,
        serverSide: true,
        serverMethod: "post",
        ajax: {
            url: ajaxurl + "?action=finance_report",
            data: function (data) {
                var start_date = $("body #start_date").val();
                var start_time = $("body #start_time").val();
                var end_date = $("body #end_date").val();
                var end_time = $("body #end_time").val();
                var userid = $(".finance-report-form select[name=username]").val();
                var status = $(".finance-report-form select[name=status]").val();
                var userrole = $(".finance-report-form input[name=userrole]").val();
                data.start_date = start_date;
                data.start_time = start_time;
                data.end_date = end_date;
                data.end_time = end_time;
                data.userid = userid;
                data.status = status;
                data.userrole = userrole;
            },
        },
        columns: [
            { data: "date" },
            { data: "user" },
            { data: "status" },
            { data: "amount" },
            { data: "balance" },
            { data: "more-info" },
        ],
        createdRow: function (row, data, dataIndex) {
            jQuery(".status_wise_total").text(symbol + "0.00");
            $(row).addClass("finance_status_" + data.status.replace(" ", "_").toLowerCase());
            jQuery(".status_wise_total").html(data.totalamt);
        },
        pageLength: 10,
    });

    function statusChange() {
        jQuery("body .status_wise_total").text(symbol + "0.00");
        if (
            (jQuery("select[name=username]").val() === "all" &&
                jQuery("select[name=status]").val() === "all") ||
            jQuery("select[name=status]").val() != "all"
        ) {
            accountDataTable.columns([4]).visible(false);
            jQuery(accountDataTable.table().footer()).removeClass("d-none");
        } else {
            jQuery(accountDataTable.table().footer()).addClass("d-none");
            accountDataTable.columns([4]).visible(true);
        }
    }

    jQuery("body").on("submit", ".finance-report-form", function (event) {
        statusChange();
        accountDataTable.draw(true);
        event.preventDefault();
        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
                html: true,
            });
        }, 1500);
        // return false;
    });
    accountDataTable.columns([4]).visible(false);
    jQuery("body").on("change", "select[name=username]", function (event) {
        statusChange();
        accountDataTable.draw(true);

        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
                html: true,
            });
        }, 1500);
        event.preventDefault();

        jQuery("body .status_wise_total").text(symbol + "0.00");
        return false;
    });

    $("[data-fancybox]").fancybox({
        speedIn: 600,
        speedOut: 200,
        overlayShow: false,
        transitionEffect: "fade",
    });
    /**
     *  Agent and Player Current accounts JS Start
     */



    /**
     * withdrawal request Page JS
     *
     * - Apply datatable with AJAX
     * -
     */
    /** withdrawal request list datatable Start*/   
    var dataTable = $("#withdrawal_data").DataTable({       
        bFilter: false,
        language: { processing: '<i class="fad fa-spinner-third fa-spin"></i>' },
        ordering: false,
        processing: true,
        serverSide: true,
        serverMethod: "post",
        ajax: {
            url: ajaxurl + "?action=withdrawal_request_datatabel_data",
        },
        columns: [
            {data: "username",},
            { data: "amount" },
            { data: "gateway" },
            { data: "status" },
            { data: "method" },
            { data: "date" },
            { data: "action" },
        ],
    
        pageLength: 10,
    });



    /* global withdrawal_post_type_param */

    jQuery(function ($) {
        var withdrawal_post_type = {
            init: function () {
                $(document).on('click', '.woo_wallet_withdrawal_action', function (event) {
                    event.preventDefault();
                    var row_action = $(this).attr('data-action');
                    var post_id = $(this).attr('data-post_id');
                    var security_nonce = jQuery('#security_nonce').attr('data-nonce');
                    console.log(security_nonce);

                    var withdrawal_post_type_paramStatus = 'Are you sure you want to delete this request?';

                    if (row_action === 'approve' || row_action === 'reject' || row_action === 'pending' || (row_action === 'delete' && confirm(withdrawal_post_type_paramStatus))) {
                        $(this).css('cursor', 'progress');
                        $(this).attr('disabled', 'disabled');
                        var data = {
                            action: 'woo_wallet_withdrawal_post_action',
                            security: security_nonce,
                            post_id: post_id,
                            row_action: row_action
                        };
                        $.post(ajaxurl, data, function (response) {
                            if (response.status) {
                                if (response.redirect_url) {
                                    window.location.reload();
                                } else {
                                    window.location.reload();
                                }
                            } else {
                                alert('An error occurred, please check WooCommerce error log file.');
                            }
                        });
                    }
                });
            }
        };
        withdrawal_post_type.init();
    });


});