$(document).ready(function () {
    var ajaxurl = jQuery("input[name=ajaxurl]").attr("data-ajaxurl");


    /** Dashboard Balance form ajax */
    jQuery("body").on("click",".credit_debit_dashboard .balance_action",function(){
        var action = jQuery(this).attr('data-action');
        var username = jQuery(this).closest('.credit_debit_dashboard').find('input[name=username]').val();

        $this = jQuery(this);

        var currentRequest = null;
        currentRequest = $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action': 'dashboard_balance_action',
                'bal_action': action,
                'username' :username
            },
            beforeSend: function() {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function(response) {
                
                if(response == 0){
                    $this.closest('.credit_debit_dashboard').find('.error-msg').css('display','block');
                }else{
                    jQuery('.credit_debit_dashboard').find('.error-msg').css('display','none');
                    var user_id = response;
                    var modal_name = 'add_'+action+'_modal';
                
                    var currentRequest = null;
                    currentRequest = $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            'action': 'get_modal_html',
                            'user_id': user_id,
                            'modal_name':modal_name
                        },
                        beforeSend: function() {
                            if (currentRequest != null) {
                                currentRequest.abort();
                            }
                        },
                        success: function(response) {

                                jQuery("#"+modal_name+" .modal-body").html(response);
                                jQuery('.overflow-text').each((index, element) => new SimpleBar(element));
                                jQuery("#"+modal_name).modal("show");
                                $('[data-button-toggle="tooltip"]').tooltip({
                                    trigger: 'hover',
                                });
                                jQuery(".credit_debit_dashboard").trigger("reset");         
                            
                        }
                    });
                }
                console.log(response);
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
                            },
                            {
                                data: [],
                                label: "demo 2",
                                borderColor: "rgb(184 69 255)",
                                fill: false,
                                borderDash: [5, 5],
                                cubicInterpolationMode: "monotone",
                                tension: 0.4,
                            },
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
                    // console.log(r);
                    if (
                        ((netwinDaily.data.labels[r] = t.label),
                        (netwinDaily.data.datasets[0].data[r] = t.value),
                        n - 1 == r)
                    ) {
                        var o = new Date(1e3 * e.NetwinDaily.last_update);
                        (o = 60 * (o.getHours() - 3) + o.getMinutes()),
                            (netwinDaily.data.datasets[1].data[r] =
                                (t.value / o) * 1440);
                    } else netwinDaily.data.datasets[1].data[r] = t.value;
                    netwinDaily.update(), r++;
                }),
                    1 == $("body").data("HideValues") &&
                        ((netwinDaily.options.scales.yAxes[0].display = status),
                        netwinDaily.update());
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
            if(e.Netwin){


                // $("#Netwin_container").html('<canvas id="Netwin"></canvas>');
                // var netwin_elmnt = document.getElementById("Netwin").getContext('2d');
                // netwin = new Chart(netwin_elmnt, {
                //     type: 'line',
                //     data: {
                //         labels: [],
                //         datasets: [{
                //             data: [],
                //             backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                //             borderColor: ['rgba(54, 162, 235, 1)'],
                //             borderWidth: 1
                //         }, {
                //             data: [],
                //             backgroundColor: ['rgba(54, 162, 235, 0)'],
                //             borderColor: ['rgba(0, 0, 0, 0.2)'],
                //             borderWidth: 1,
                //             borderDash: [3, 2]
                //         }, {
                //             data: [],
                //             backgroundColor: ['rgba(162, 54, 235, 0.07)'],
                //             borderColor: ['rgba(162, 54, 235, 0.5)'],
                //             borderWidth: 1,
                //             borderDash: [1]
                //         }]
                //     },
                //     options: {
                //         scales: {
                //             y: {
                //                 display: true,
                //                 title: {
                //                     display: true,
                //                     // text: "Value",
                //                 },
                //             },
                //         },
                //         tooltips: {
                //             callbacks: {
                //                 label: function (tooltipItem) {
                //                     return tooltipItem.datasetIndex == 2 ? '' : Intl.NumberFormat().format(tooltipItem.yLabel);
                //                 }
                //             }
                //         },
                //         legend: { display: false }
                //     }
                // });
                // var i = 0;
                // if (result.Netwin.data.dates) {
                //     var ratio = result.Netwin.data.ratio;
                //     var dates = result.Netwin.data.dates;
                // } else {
                //     var dates = result.Netwin.data;
                // }
                // var len = Object.keys(dates).length;
                // var d = new Date(date.getFullYear(), date.getMonth() + 1, 0);
                // $.each(dates, function (k, v) {
                //     netwin.data.labels[i] = v.label;
                //     netwin.data.datasets[0].data[i] = v.value;
                //     if (result.Netwin.data.dates) {
                //         netwin.data.datasets[2].data[i] = v.wager / ratio;
                //     }
                //     if (len - 1 == i) {
                //         var hour1 = new Date(result.Netwin.last_update * 1000);
                //         hour1 = ((hour1.getDate() - 1) * 24 + hour1.getHours() - 3) * 60 + hour1.getMinutes();
                //         var hour2 = d.getDate() * 24 * 60;
                //         netwin.data.datasets[1].data[i] = v.value / hour1 * hour2;
                //     } else {
                //         netwin.data.datasets[1].data[i] = v.value;
                //     }
                //     netwin.update();
                //     i++;
                // });
                // if ($('body').data('HideValues') == 1) {
                //     netwin.options.scales.yAxes[0].display = dstatus;
                //     netwin.update();
                // }
            }
        },
    });

    $("#Netwin_container").html('<canvas id="Netwin"></canvas>');
    var ch2 = document.getElementById("Netwin").getContext("2d");

    const DATA_COUNT = 6;
    const NUMBER_CFG = [0,0,0,1, 10, 20, 18, 15];
    const NUMBER_CFG2 = [0,0,0,1, 3, 5, 18, 20];
    const datapoints = [0,0,0,1, 1, 2, 18, 30];


    const MONTHS = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
      ];
    // const labels = Utils.months({count: 6});
    const data = {
        labels: MONTHS,
        datasets: [
            {
                label: "Filled",
                data: NUMBER_CFG2,
                borderColor: "rgba(255, 159, 64, 0.8)",
                fill: true,
                backgroundColor: "rgba(255, 159, 64, 0.2)",
                cubicInterpolationMode: "monotone",
                tension: 0.4,
            },
            {
                label: "Filled",
                data: NUMBER_CFG,
                borderColor: ["rgba(54, 162, 235, 0.8)"],
                fill: true,
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                cubicInterpolationMode: "monotone",
                tension: 0.4,
            },            {
                label: "Dashed",
                data: datapoints,
                borderColor: "rgb(184 69 255)",
                fill: false,
                borderDash: [2, 2],
                cubicInterpolationMode: "monotone",
                tension: 0.4,
            },
        ],
    };

   


    const myChart2 = new Chart(ch2, {
        type: "line",
        data: data,
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    // text: "Chart.js Line Chart",
                },
                legend: {
                    position: "bottom",
                },
            },
            interaction: {
                mode: "index",
                intersect: false,
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        // text: "Month",
                    },
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        // text: "Value",
                    },
                },
            },
        },
    });
});
