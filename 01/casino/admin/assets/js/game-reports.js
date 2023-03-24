$(document).ready(function () {
    var ajaxurl = jQuery("input[name=ajaxurl]").attr("data-ajaxurl");



    $("#start_date").pickadate({
        max: new Date,
        format: 'dd mmm yyyy',
        formatSubmit: 'yyyy/mm/dd',
        clear: 'erase',
        // onSet: function () {
        //     playerdataTable.draw(true);
        // }
    });

    $("#end_date").pickadate({
        max: new Date,
        format: 'dd mmm yyyy',
        formatSubmit: 'yyyy/mm/dd',
        clear: 'erase',
        // onSet: function () {
        //     playerdataTable.draw(true);
        // }
    });
    $("#start_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () {
        //     playerdataTable.draw(true);
        // }
    });
    $("#end_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () {
        //     playerdataTable.draw(true);
        // }
    });
    $('select.casino-provider-select').on('change', function() {
        playerdataTable.draw(true);
    });

    /** Charges and withdrawals page js start */
    // var dataTable = $("#report_balances").DataTable({
    //     dom: '<"table_filter_topbar" <"row align-items-center"<"col-sm-6"f><"col-sm-6"<> >>>rt <"table_filter_bottombar"<"row align-items-center"<"col-sm-6"l><"col-sm-6"p>>>',
    //     bFilter: false,
    //     language: {
    //         processing: '<i class="fad fa-spinner-third fa-spin"></i>',
    //     },
    //     ordering: false,
    //     processing: true,
    //     serverSide: true,
    //     serverMethod: "post",
    //     ajax: {
    //         url: ajaxurl + "?action=report_balances",
    //         data: function (data) {
    //             var start_date = $("body #start_date").val();
    //             var start_time = $("body #start_time").val();
    //             var end_date = $("body #end_date").val();
    //             var end_time = $("body #end_time").val();
    //             var userrole = $(".charges-withdrawals-form select[name=userrole]").val();
    //             var username = $(".charges-withdrawals-form input[name=username_search]").val();
    //             var tran_checkbox = $(".charges-withdrawals-form input[name=transaction_checkbox]:checked").val();
    //             var current_user = jQuery(".user_map .user_map_main_ul").attr("data-userid");


    //             data.start_date = start_date;
    //             data.start_time = start_time;
    //             data.end_date = end_date;
    //             data.end_time = end_time;
    //             data.userrole = userrole;
    //             data.username = username;
    //             data.tran_checkbox = tran_checkbox;
    //             data.current_user = current_user;
    //         },
    //     },
    //     columns: [
    //         { data: "date", },
    //         { data: "origin" },
    //         {
    //             data: "destination", render: function (data, type, row, meta) {
    //                 return (
    //                     '<sapn class="' +
    //                     data.role +
    //                     '_user_column" >' +
    //                     data.name +
    //                     "</sapn>"
    //                 );
    //             },
    //         },
    //         { data: "amount" },
    //     ],
    //     pageLength: 10,
    // });


    // jQuery("body").on("submit", ".charges-withdrawals-form", function (event) {
    //     dataTable.draw(true);
    //     event.preventDefault();

    //     return false;
    // });

    // /** user map ajax to change data in main table  */
    // jQuery("body.page-template-template-report-balances").on("click", ".user_map ul li a", function () {
    //     jQuery(".user_map ul li").removeClass("current_user");
    //     jQuery(this).closest("li").addClass("current_user");
    //     var user_id = jQuery(this).attr("data-user");
    //     jQuery(".user_map_main_ul").attr("data-userid", user_id);
    //     dataTable.draw(true);
    //     setTimeout(function () {
    //         $('body [data-button-toggle="tooltip"]').tooltip({
    //             trigger: "hover",
    //         });
    //     }, 1000);
    // });

    /** Charges and withdrawals page js End */

    /** Player History JS Start */
    var symbol = jQuery('.woocommerce-Price-currencySymbol.symbol-only').text();   
    if ($("input[name=matchType]").val() == "casino") {
        var column_arr = [{ data: "betId" }, { data: "date" }, { data: "user" }, { data: "operation" }, { data: "amount" }];
    } else if($("input[name=matchType]").val() == "poker") {
        var column_arr = [{ data: "date" }, { data: "user" }, { data: "buyin" }, { data: "cashout" }, { data: "rake" }];
    } else {
        var column_arr = [{ data: "betId" }, { data: "date" }, { data: "user" }, { data: "operation" }, { data: "amount" }, { data: "resultamount" }, { data: "possiblewin" }, { data: "abcd" }, { data: "efgh" }, { data: "wxyz" }, { data: "abcd" }, { data: "efgh" }, { data: "wxyz" }, { data: 'info' }];
    }
    var playerdataTable = $("#casino_report").DataTable({
        dom: '<"table_filter_topbar" <"row align-items-center"<"col-sm-6"f><"col-sm-6"<> >>>r <"responsive-table-scroll" t> <"table_filter_bottombar"<"row align-items-center"<"col-sm-6"l><"col-sm-6"p>>>',
        bFilter: false,
        language: {
            processing: '<i class="fad fa-spinner-third fa-spin"></i>',
        },
        ordering: false,
        processing: true,
        serverSide: true,
        serverMethod: "post",
        ajax: {
            url: ajaxurl + "?action=casino_report",
            data: function (data) {
                var start_date = $("body #start_date").val();
                var start_time = $("body #start_time").val();
                var end_date = $("body #end_date").val();
                var end_time = $("body #end_time").val();
                var username = $(".game-reports-form input[name=username_search]").val();
                var betId = $(".game-reports-form input[name=bet_id]").val();
                var matchType = $("input[name=matchType]").val();
                var current_user = jQuery(".user_map .user_map_main_ul").attr("data-userid");
                var selectedProvider = jQuery("select.casino-provider-select").find(":selected").val();
                var transactionType = jQuery(".game-reports-form input[name=poker-only-pending]").is(':checked');

                data.start_date = start_date;
                data.start_time = start_time;
                data.end_date = end_date;
                data.end_time = end_time;
                data.username = username;
                data.current_user = current_user;
                data.matchType = matchType;
                data.betId = betId;
                data.provider = selectedProvider;
                data.transaction_type = transactionType;
            },
        },
        responsive: true,
        columns: column_arr,
        createdRow: function (row, data, dataIndex) {
            jQuery(".total-win-amount").html(data.totalwinamount);

            if ( $("input[name=matchType]").val() === "casino" ) {
                if(data.operation.toLowerCase().indexOf('win') !== -1) $(row).addClass('player-bet-loss');
                if(data.operation.toLowerCase().indexOf('loss') !== -1) $(row).addClass('player-bet-won');
            }
            
            if($("input[name=matchType]").val() == 'sports') {
                $(row).find('td:eq(0)').addClass('sports-bet-information');
                $(row).find('td:eq(7)').text('ABCD');
                $(row).find('td:eq(8)').text('EFGH');
                $(row).find('td:eq(9)').text('WXYZ');
            }
            jQuery(".game_reports_status_wise_total_1").text(symbol + data.totalAmountPending);
            jQuery(".game_reports_status_wise_total_3").text(symbol + data.totalPossibleWin);
        },
        pageLength: 10,
    });

    $('.game-reports-form input[name=bet_id]').on('input', function() {
        if($(this).val() != '') {
            $('.game-reports-form input[name=poker-only-pending]').attr('disabled', true);
        } else {
            $('.game-reports-form input[name=poker-only-pending]').removeAttr('disabled');
        }
    });

    $('.game-reports-form input[name=poker-only-pending]').on('change', function() {
        if($(this).is(':checked')) {
            $('.game-reports-form input[name=bet_id]').attr('disabled', true);
        } else {
            $('.game-reports-form input[name=bet_id]').removeAttr('disabled');
        }
    });

    jQuery("body").on("submit", ".game-reports-form", function (event) {
        if ( $("input[name=matchType]").val() === "sports" ) {
            if ( $('.game-reports-form input[name=poker-only-pending]').is(':checked') ) {
                playerdataTable.columns([5]).visible(false);
                $('body tfoot').removeClass('d-none');
            } else {
                playerdataTable.columns([5]).visible(true);
                $('body tfoot').addClass('d-none');
            }
        }

        playerdataTable.draw(true);
        event.preventDefault();
        return false;
    });


    jQuery("body.page-template-template-game-reports").on("click", ".user_map ul li a", function () {
        jQuery(".user_map ul li").removeClass("current_user");
        jQuery(this).closest("li").addClass("current_user");
        var user_id = jQuery(this).attr("data-user");
        jQuery(".user_map_main_ul").attr("data-userid", user_id);
        playerdataTable.draw(true);
        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
            });
        }, 1000);
    });
    /** Player History JS End */
});