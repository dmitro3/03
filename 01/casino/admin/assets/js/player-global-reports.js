$(document).ready(function () {

    var ajaxurl = jQuery("input[name=ajaxurl]").attr("data-ajaxurl");


    /**
    * Agent and Player Operations Page JS End    *
    * 
    * *******************************************
    * 
    *  Agent and Player Current accounts JS Start
    */

    $("#start_date").pickadate({
        max: new Date,
        format: 'dd mmm yyyy',
        formatSubmit: 'yyyy/mm/dd',
        clear: 'erase',
        // onSet: function () {
        //     globalReportsDataTable.draw(true);
        // }
    });


    $("#end_date").pickadate({
        max: new Date,
        format: 'dd mmm yyyy',
        formatSubmit: 'yyyy/mm/dd',
        clear: 'erase',
        // onSet: function () {
        //     globalReportsDataTable.draw(true);
        // }
    });
    $("#start_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () {
        //     globalReportsDataTable.draw(true);
        // }
    });
    var endtime = $("#end_time").pickatime({
        autoclose: !0,
        twelvehour: !1,
        vibrate: !0,
        // afterDone: function () {
        //     globalReportsDataTable.draw(true);
        // }
    });


    /** Charges and withdrawals page js start */
    var globalReportsDataTable = $("#player_global_reports").DataTable({
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
            url: ajaxurl + "?action=player_global_reports",
            data: function (data) {
                jQuery(".status_wise_total").text('0.00');
                var start_date = $("body #start_date").val();
                var start_time = $("body #start_time").val();
                var end_date = $("body #end_date").val();
                var end_time = $("body #end_time").val();
                var username = $(".finance-report-form input[name=username_search]").val();

                data.start_date = start_date;
                data.start_time = start_time;
                data.end_date = end_date;
                data.end_time = end_time;
                data.username = username;

            },
        },
        "drawCallback": function (response) { 
            var response = response.json;
            if (response.aaData === null || response.aaData.length === 0) {
                jQuery('tfoot.player-report-details').addClass('d-none');
            } else {
                jQuery('tfoot.player-report-details').removeClass('d-none');
            }
        },
        columns: [
            {
                data: "category",
            },
            { data: "bets" },
            { data: "win" },
            { data: "netwin" },
            { data: "rakes" },
        ],
        createdRow: function (row, data, dataIndex) {
            jQuery('.player-reports-balance').html(data.playerBalance);
            jQuery('.player-bets').html(data.playerBets);
            jQuery('.player-win').html(data.playerCredits);
            jQuery('.player-netwin').html(data.playerGGR);
            jQuery('.player-data-last-update span').html(data.updatedTime);
            // if(data != '') {
            //     jQuery('tfoot.player-report-details').removeClass('d-none');
            // } else {
            //     jQuery('tfoot.player-report-details').addClass('d-none');
            // }
            // $(row).addClass("global_reports_" + data.class.replace(" ", "_").toLowerCase());
            // jQuery(".status_wise_total").text('');

            // // jQuery(".status_wise_total").text(data.totalamt.replace("&#36;", "$"));
            // jQuery(".status_wise_total").html(data.totalamt);

        },
        "paging": false
    });


    jQuery("body").on("submit", ".finance-report-form", function (event) {

        var username = jQuery("input[name=username_search]").val();
        var err = 0;
        if (username != "") {

            jQuery("input[name=username_search]").removeClass('input_error');
            console.log("if con true");
        } else {
            console.log("else con true");
            jQuery("input[name=username_search]").addClass('input_error');
            err = 1;
        }

        if (err == 0) {
            globalReportsDataTable.draw(true);
        }

        event.preventDefault();
        return false;
    });

    jQuery("body").on("click", ".details-btn", function () {
        var click_no = jQuery(this).attr('data-click');
        if (click_no == 0) {
            jQuery(this).attr('data-click', 1);
        }
        if (click_no == 1) {
            jQuery(this).attr('data-click', 0);
        }
        // globalReportsDataTable.draw(true);
    });

    jQuery("body").on("change", "#customDaterange", function () {

        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        const todayend = new Date(today);
        todayend.setDate(todayend.getDate() + 1);


        var select_date = jQuery("#customDaterange option:selected").val();
        if (select_date == "today") {

            jQuery('#start_date').pickadate('picker').set('select', new Date(), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('max', new Date(todayend), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('select', new Date(todayend), { format: 'yyyy-mm-dd' });

        } else if (select_date == "yesterday") {
            jQuery('#start_date').pickadate('picker').set('select', new Date(yesterday), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('select', new Date(), { format: 'yyyy-mm-dd' });

        } else if (select_date == "thisWeek") {

            const today = new Date();

            function getFirstDayOfWeek(d) {
                const date = new Date(d);
                const day = date.getDay();
                const diff = date.getDate() - day + (day === 0 ? -6 : 1);
                return new Date(date.setDate(diff));
            }
            const firstDay = getFirstDayOfWeek(today);
            const lastDay = new Date(firstDay);
            lastDay.setDate(lastDay.getDate() + 6);

            jQuery('#start_date').pickadate('picker').set('select', new Date(firstDay), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('max', new Date(todayend), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('select', new Date(lastDay), { format: 'yyyy-mm-dd' });


        } else if (select_date == "lastWeek") {

            var beforeOneWeek = new Date(new Date().getTime() - 60 * 60 * 24 * 7 * 1000)
                , day = beforeOneWeek.getDay()
                , diffToMonday = beforeOneWeek.getDate() - day + (day === 0 ? -6 : 1)
                , lastMonday = new Date(beforeOneWeek.setDate(diffToMonday))
                , lastSunday = new Date(beforeOneWeek.setDate(diffToMonday + 7));


            jQuery('#start_date').pickadate('picker').set('select', new Date(lastMonday), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('select', new Date(lastSunday), { format: 'yyyy-mm-dd' });

        } else if (select_date == "thisMonth") {

            var date = new Date(), y = date.getFullYear(), m = date.getMonth();
            var firstDay = new Date(y, m, 1);
            var lastDay = new Date(y, m + 1, 0);

            jQuery('#start_date').pickadate('picker').set('select', new Date(firstDay), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('max', new Date(todayend), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('select', new Date(lastDay), { format: 'yyyy-mm-dd' });


        } else if (select_date == "lastMonth") {

            function getFirstDayPreviousMonth() {
                const date = new Date();
                const prevMonth = date.getMonth() - 1;
                const firstDay = 1;

                return new Date(date.getFullYear(), prevMonth, firstDay);
            }
            var lastmonthStart = getFirstDayPreviousMonth();

            function getFirstDayPreviousMonth1() {
                const date = new Date();
                const prevMonth = date.getMonth();
                const firstDay = 1;

                return new Date(date.getFullYear(), prevMonth, firstDay);
            }
            var lastmonthEnd = getFirstDayPreviousMonth1();

            jQuery('#start_date').pickadate('picker').set('select', new Date(lastmonthStart), { format: 'yyyy-mm-dd' });
            jQuery('#end_date').pickadate('picker').set('select', new Date(lastmonthEnd), { format: 'yyyy-mm-dd' });

        }
        globalReportsDataTable.draw(true);
    });

    jQuery("body").on("click", ".user_map ul li a", function () {

        jQuery(".status_wise_total").text('0.00');

        jQuery(".user_map ul li").removeClass("current_user");
        jQuery(this).closest("li").addClass("current_user");
        var user_id = jQuery(this).attr("data-user");
        jQuery(".user_map_main_ul").attr("data-userid", user_id);
        globalReportsDataTable.draw(true);
        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
            });
        }, 1000);
    });

    /**
    *  Agent and Player Current accounts JS Start
    */
});