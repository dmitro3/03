$(document).ready(function () {
    var ajaxurl = jQuery("input[name=ajaxurl]").attr("data-ajaxurl");



    $("#start_date").pickadate({
        max: new Date,
        format: 'dd mmm yyyy',
        formatSubmit: 'yyyy-mm-dd',
        clear: 'erase',
        // onSet: function () {
        //     dataTable.draw(true);
        // }
    });

    $("#end_date").pickadate({
        max: new Date,
        format: 'dd mmm yyyy',
        formatSubmit: 'yyyy-mm-dd',
        clear: 'erase',
        // onSet: function () {
        //     dataTable.draw(true);
        // }
    });
    $("#start_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () {
        //     dataTable.draw(true);
        // }
    });
    $("#end_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () {
        //     dataTable.draw(true);
        // }
    });

    /** Charges and withdrawals page js start */
    var dataTable = $("#report_balances").DataTable({
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
            url: ajaxurl + "?action=report_balances",
            data: function (data) {
                var start_date = $("body input[name=Start_date_submit]").val();
                var start_time = $("body #start_time").val();
                var end_date = $("body input[name=end_date_submit]").val();
                var end_time = $("body #end_time").val();
                var userrole = $(".charges-withdrawals-form select[name=userrole]").val();
                var username = $(".charges-withdrawals-form input[name=username_search]").val();
                var tran_checkbox = $(".charges-withdrawals-form input[name=transaction_checkbox]:checked").val();
                var current_user = jQuery(".user_map .user_map_main_ul").attr("data-userid");


                data.start_date = start_date;
                data.start_time = start_time;
                data.end_date = end_date;
                data.end_time = end_time;
                data.userrole = userrole;
                data.username = username;
                data.tran_checkbox = tran_checkbox;
                data.current_user = current_user;
            },
        },
        columns: [
            { data: "date", },
            { data: "source" },
            {
                data: "destination", render: function (data, type, row, meta) {
                    return (
                        '<sapn class="' +
                        data.role +
                        '_user_column" >' +
                        data.name +
                        "</sapn>"
                    );
                },
            },
            { data: "amount" },
        ],
        pageLength: 10,
    });

    jQuery("body").on("click", ".checkbox_agent input[name=transaction_checkbox]", function () {
        if (jQuery(this).val() == "direct") {
            jQuery('.checkbox_agent #received').prop('checked', false);
        }
        if (jQuery(this).val() == "received") {
            jQuery('.checkbox_agent #direct').prop('checked', false);
        }
    });

    jQuery("body").on("click", ".checkbox_player input[name=transaction_checkbox]", function () {

        if (jQuery(this).val() == "direct") {
            jQuery('.checkbox_player #received').prop('checked', false);
        }
        if (jQuery(this).val() == "higher") {
            jQuery('.checkbox_player #direct').prop('checked', false);
        }
    });


    jQuery("body").on("submit", ".charges-withdrawals-form", function (event) {
        dataTable.draw(true);
        event.preventDefault();
        return false;
    });

    jQuery("body").on("change", "select[name=userrole]", function () {
        var curr_val = jQuery(this).val();
        jQuery(".checkbox_filter").hide();
        jQuery(".checkbox_" + curr_val).fadeIn();
    });
    jQuery(".checkbox_agent").hide();

    /** user map ajax to change data in main table  */
    jQuery("body.page-template-template-report-balances").on("click", ".user_map ul li a", function () {
        jQuery(".user_map ul li").removeClass("current_user");
        jQuery(this).closest("li").addClass("current_user");
        var user_id = jQuery(this).attr("data-user");
        jQuery(".user_map_main_ul").attr("data-userid", user_id);
        dataTable.draw(true);
        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
            });
        }, 1000);
    });
    /** Charges and withdrawals page js End */




    /** Player History JS Start*/
    var playerdataTable = $("#player_history").DataTable({
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
            url: ajaxurl + "?action=player_history",
            data: function (data) {
                var start_date = $("body input[name=Start_date_submit]").val();
                var start_time = $("body #start_time").val();
                var end_date = $("body input[name=end_date_submit]").val();
                var end_time = $("body #end_time").val();
                var username = $(".player-history-form input[name=username_search]").val();


                data.start_date = start_date;
                data.start_time = start_time;
                data.end_date = end_date;
                data.end_time = end_time;
                data.username = username;
            },
        },
        columns: [
            { data: "date", "width": "20%" },
            { data: "provider", "width": "15%" },
            { data: "operation", "width": "15%" },
            { data: "amount" },
            { data: "previous_balance" },
            { data: "subsequent_balance" },
        ],
        pageLength: 10,
    });

    jQuery("body").on("submit", ".player-history-form", function (event) {
        playerdataTable.draw(true);
        event.preventDefault();
        return false;
    });
    /** Player History JS End */
});