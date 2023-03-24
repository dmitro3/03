$(document).ready(function () {
    var ajaxurl = jQuery("input[name=ajaxurl]").attr("data-ajaxurl");


    /** Dashboard Balance form ajax */
    jQuery("body").on("click", ".credit_debit_dashboard .balance_action", function () {
        var action = jQuery(this).attr('data-action');
        var username = jQuery(this).closest('.credit_debit_dashboard').find('input[name=username]').val();
        jQuery(".common_page_loader").fadeIn();

        $this = jQuery(this);

        var currentRequest = null;
        currentRequest = $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action': 'dashboard_balance_action',
                'bal_action': action,
                'username': username
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {


                if (response == 0) {
                    $this.closest('.credit_debit_dashboard').find('.error-msg').css('display', 'block');
                    jQuery(".common_page_loader").fadeOut();
                } else {
                    jQuery('.credit_debit_dashboard').find('.error-msg').css('display', 'none');
                    var user_id = response.trim();
                    var modal_name = 'add_' + action + '_modal';

                    var currentRequest = null;
                    currentRequest = $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            'action': 'get_modal_html',
                            'user_id': user_id,
                            'modal_name': modal_name
                        },
                        beforeSend: function () {
                            if (currentRequest != null) {
                                currentRequest.abort();
                            }
                        },
                        success: function (response) {

                            jQuery("#" + modal_name + " .modal-body").html(response);
                            jQuery('.overflow-text').each((index, element) => new SimpleBar(element));
                            jQuery("#" + modal_name).modal("show");
                            $('[data-button-toggle="tooltip"]').tooltip({
                                trigger: 'hover',
                            });
                            jQuery(".credit_debit_dashboard").trigger("reset");
                            jQuery(".common_page_loader").fadeOut();

                        }
                    });
                }
                // console.log(response);
                // if(response == 1){
                //     location.reload();
                // }else{
                //     jQuery("body .login__form .error-msg").text(response);
                //     jQuery("body .login__form .error-msg").css('display','block');

                // }               
            }
        });

    });






    var AlertTimeout = "",
        date = new Date();

    /** Dashbord Chart Ajax Start */
    var currentRequest = null;
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
            action: "dashbord_chart_ajax",
        },
        beforeSend: function () {
            if (currentRequest != null) {
                currentRequest.abort();
            }
        },
        success: function (a) {
            var e = $.parseJSON(a);

            if (e.NetwinDaily) {
                $("#NetwinDaily_container").html(
                    '<canvas id="NetwinDaily"></canvas>'
                );
                var d = document.getElementById("NetwinDaily").getContext("2d");

                netwinDaily = new Chart(d, {
                    type: "line",
                    data: {
                        labels: [],
                        datasets: [
                            {
                                data: [],
                                label: "demo",
                                borderColor: ["rgba(54, 162, 235, 1)"],
                                borderWidth: 1,
                                fill: true,
                                backgroundColor: "rgba(54, 162, 235, 0.2)",
                                cubicInterpolationMode: "monotone",
                                tension: 0.4,
                            }
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        interaction: {
                            mode: "index",
                            intersect: false,
                        },
                        scales: {
                            x: {
                                display: true,
                            },
                            y: {
                                display: true,
                            },
                        },
                    },
                });

                (r = 0),
                    (n = Object.keys(e.NetwinDaily.data).length),
                    (o = new Date(date.getFullYear(), date.getMonth() + 1, 0));
                $.each(e.NetwinDaily.data, function (a, t) {

                    if (((netwinDaily.data.labels[r] = t.label), (netwinDaily.data.datasets[0].data[r] = t.value), n - 1 == r)) {
                        var o = new Date(1e3 * e.NetwinDaily.last_update);
                        (o = 60 * (o.getHours() - 3) + o.getMinutes());
                    }
                    netwinDaily.update(), r++;
                });
            }
            if (e.TopAffiliates) {
                $("#TopAffiliates_container").html(
                    '<canvas id="TopAffiliates"></canvas>'
                );
                var d = document
                    .getElementById("TopAffiliates")
                    .getContext("2d");

                const c = new Chart(d, {
                    type: "pie",
                    data: {
                        labels: [],
                        datasets: [
                            {
                                data: [],
                                backgroundColor: [
                                    "rgba(255, 99, 132, 0.2)",
                                    "rgba(255, 159, 64, 0.2)",
                                ],
                                borderColor: [
                                    "rgba(255, 99, 132, 1)",
                                    "rgba(255, 159, 64, 1)",
                                ],
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        responsive: !0,
                        plugins: {
                            legend: {
                                position: "bottom",
                                labels: {
                                    padding: 20,
                                },
                            },
                        },

                        tooltips: {
                            callbacks: {
                                label: function (a, e) {
                                    return Intl.NumberFormat().format(
                                        e.datasets[a.datasetIndex].data[a.index]
                                    );
                                },
                            },
                        },
                    },
                });

                r = 0;
                $.each(e.TopAffiliates.data, function (a, e) {
                    (c.data.labels[r] = e.label),
                        (c.data.datasets[0].data[r] = e.value),
                        c.update(),
                        r++;
                });
            }
            if (e.Netwin) {

                $("#Netwin_container").html('<canvas id="Netwin"></canvas>');
                var netwin_elmnt = document.getElementById("Netwin").getContext('2d');
                netwin = new Chart(netwin_elmnt, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            data: [],
                            backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                            borderColor: ['rgba(54, 162, 235, 1)'],
                            borderWidth: 1,
                            fill: true,
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false,
                            },
                        },
                        scales: {
                            y: {
                                display: true,
                            },
                        },
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.datasetIndex == 2 ? '' : Intl.NumberFormat().format(tooltipItem.yLabel);
                                }
                            }
                        },
                        legend: { display: false }
                    }
                });
                var i = 0;
                if (e.Netwin.dates) {
                    var dates = e.Netwin.dates;
                } else {
                    var dates = e.Netwin;
                }


                $.each(dates, function (k, v) {
                    netwin.data.labels[i] = v.label;
                    netwin.data.datasets[0].data[i] = v.value;
                    netwin.update();
                    i++;
                });

            }
        },
    });



});
