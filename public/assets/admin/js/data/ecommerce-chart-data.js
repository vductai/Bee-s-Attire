(function ($) {
    "use strict";

    // Biểu đồ thống kê Orders theo tháng
    function areaChartRevenue() {
        var options = {
            chart: {
                type: "area",
                height: 365,
                sparkline: {enabled: false},
                dropShadow: {enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1},
                toolbar: {show: false}
            },
            series: [{name: 'Đơn hàng', data: ordersPerMonth}],
            stroke: {width: 2, curve: 'smooth'},
            colors: ["#3f51b5"],
            xaxis: {
                categories: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                axisBorder: {show: false},
                axisTicks: {show: false}
            },
            grid: {show: false},
            tooltip: {fixed: {enabled: false}},
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return Math.floor(value);
                    }
                },
            },
            title: {
                text: 'Thống kê Đơn hàng theo tháng',
                align: 'center',
                margin: 20,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            }
        };
        var areaChartRevenue = new ApexCharts(document.querySelector("#areaChartRevenue"), options);
        areaChartRevenue.render();
    }

    // Biểu đồ doanh thu theo tháng
    function areaChartRevenue1() {
        var options = {
            chart: {
                type: "area",
                height: 365,
                sparkline: {enabled: false},
                dropShadow: {enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1},
                toolbar: {show: false}
            },
            series: [{name: 'Doanh thu', data: revenuePerMonth}],
            stroke: {width: 2, curve: 'smooth'},
            colors: ["#3f51b5"],
            xaxis: {
                categories: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                axisBorder: {show: false},
                axisTicks: {show: false},
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '11px'
                    }
                }
            },
            grid: {show: false},
            tooltip: {
                fixed: {enabled: false},
                y: {
                    formatter: function (value) {
                        return value.toLocaleString('vi-VN') + " VNĐ";
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value.toLocaleString('vi-VN') + " VNĐ";
                    }
                }
            },
            title: {
                text: 'Doanh thu theo tháng',
                align: 'center',
                margin: 20,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            }
        };
        var areaChartRevenue1 = new ApexCharts(document.querySelector("#areaChartRevenue1"), options);
        areaChartRevenue1.render();
    }

    // Biểu đồ người dùng đặt hàng nhiều nhất theo tháng
    function areaChartUsersOrders() {
        var options = {
            chart: {
                type: "area",
                height: 365,
                sparkline: { enabled: false },
                dropShadow: { enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1 },
                toolbar: { show: false }
            },
            series: [{
                name: '',
                data: usersOrdersPerMonth
            }],
            stroke: { width: 2, curve: 'smooth' },
            colors: ["#3f51b5"],
            xaxis: {
                categories: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '11px'
                    }
                }
            },
            grid: { show: false },
            tooltip: {
                fixed: { enabled: false },
                y: {
                    formatter: function (value, {dataPointIndex,}) {
                        return "Tên người dùng: " + topUsers[dataPointIndex] + " - Số đơn hàng: " + Math.floor(value);
                    },
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return Math.floor(value) + " đơn hàng";
                    },
                }
            },
            title: {
                text: 'Người dùng đặt hàng nhiều nhất theo tháng',
                align: 'center',
                margin: 20,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            }
        };
        var areaChartUsersOrders = new ApexCharts(document.querySelector("#usersOrdersPerMonth"), options);
        areaChartUsersOrders.render();
    }

    // Biểu đồ trạng thái đơn hàng theo tuần
    function areaChartStatusWeekly() {
        var options = {
            chart: {
                type: "line",
                height: 365,
                sparkline: {enabled: false},
                dropShadow: {enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1},
                toolbar: {show: false},
            },
            series: Object.keys(ordersByStatusWeekly).map(function (status) {
                return {
                    name: status,
                    data: ordersByStatusWeekly[status]
                };
            }),
            stroke: {width: 2, curve: 'smooth'},
            colors: ["#ff9800", "#4caf50", "#f44336", "#2196f3"],
            xaxis: {
                categories: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                axisBorder: {show: false},
                axisTicks: {show: false},
                labels: {
                    style: {
                        fontSize: '11px',
                        fontWeight: 'normal',
                        color: '#333'
                    }
                }
            },
            grid: {show: false},
            tooltip: {
                fixed: {enabled: false},
                shared: true,
                intersect: false
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return Math.floor(value);
                    },
                    style: {
                        color: '#333'
                    }
                },
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    colors: ['#3f51b5']
                },
                background: {
                    enabled: true,
                    foreColor: '#fff',
                    borderRadius: 2,
                    padding: 4
                }
            },
            title: {
                text: 'Trạng thái đơn hàng theo tuần',
                align: 'center',
                margin: 20,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            }
        };
        var areaChartStatusWeekly = new ApexCharts(document.querySelector("#areaChartStatusWeekly"), options);
        areaChartStatusWeekly.render();
    }

    // Biểu đồ thống kê đơn hàng theo tuần
    function areaChartWeekly() {
        var options = {
            chart: {
                type: "area",
                height: 365,
                sparkline: {enabled: false},
                dropShadow: {enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1},
                toolbar: {show: false}
            },
            series: [{name: 'Đơn hàng', data: dailyOrders}],
            stroke: {width: 2, curve: 'smooth'},
            colors: ["#3f51b5"],
            xaxis: {
                categories: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                axisBorder: {show: false},
                axisTicks: {show: false}
            },
            grid: {show: false},
            tooltip: {fixed: {enabled: false}},
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return Math.floor(value);
                    }
                },
            },
            title: {
                text: 'Thống kê đơn hàng theo tuần',
                align: 'center',
                margin: 20,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            }
        };
        var areaChartWeekly = new ApexCharts(document.querySelector("#areaChartWeekly"), options);
        areaChartWeekly.render();
    }


    //Tăng trưởng bán hàng
    var currentMonth = new Date().getMonth();

    var totalOrdersThisMonth = ordersPerMonth[currentMonth] || 0;
    var totalRevenueThisMonth = revenuePerMonth[currentMonth] || 0;

    var totalOrdersLastMonth = ordersPerMonth[currentMonth - 1] !== undefined ? ordersPerMonth[currentMonth - 1] : 0;
    var totalRevenueLastMonth = revenuePerMonth[currentMonth - 1] !== undefined ? revenuePerMonth[currentMonth - 1] : 0;

    var percentageOrders = totalOrdersLastMonth > 0
        ? ((totalOrdersThisMonth - totalOrdersLastMonth) / totalOrdersLastMonth) * 100
        : (totalOrdersThisMonth > 0 ? 100 : 0);

    var percentageRevenue = totalRevenueLastMonth > 0
        ? ((totalRevenueThisMonth - totalRevenueLastMonth) / totalRevenueLastMonth) * 100
        : (totalRevenueThisMonth > 0 ? 100 : 0);

    percentageOrders = Math.round(percentageOrders * 10) / 10;
    percentageRevenue = Math.round(percentageRevenue * 10) / 10;

    document.getElementById("ordersChange").innerHTML = `<span class="${percentageOrders > 0 ? 'up' : 'down'}">${percentageOrders.toFixed(1)}%</span>`;
    document.getElementById("totalOrders").innerHTML = `${totalOrdersThisMonth} đơn hàng`;
    document.getElementById("revenueChange").innerHTML = `<span class="${percentageRevenue > 0 ? 'up' : 'down'}">${percentageRevenue.toFixed(1)}%</span>`;
    document.getElementById("totalRevenue").innerHTML = `${Math.round(totalRevenueThisMonth).toLocaleString('vi-VN')} VNĐ`;

    function newcampaignsChart() {
        var totalPercentage = percentageOrders + percentageRevenue;
        var options = {
            series: [percentageOrders, percentageRevenue],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Tổng',
                            formatter: function () {
                                //return `${totalOrdersThisMonth} đơn hàng, ${totalRevenueThisMonth.toLocaleString('vi-VN')} VNĐ`;
                                return totalPercentage.toFixed(1) + '%';
                            }
                        }
                    }
                }
            },
            labels: ['Tổng đơn hàng', 'Tổng doanh thu'],
            colors: ["#3f51b5", "#50d1f8"],
        };

        var newcampaignsChart = new ApexCharts(document.querySelector("#newcampaignsChart"), options);
        newcampaignsChart.render();
    }


    $(document).ready(function () {
        areaChartRevenue();
        areaChartRevenue1();
        areaChartWeekly();
        newcampaignsChart();
        areaChartStatusWeekly();
        areaChartUsersOrders();
        $("#chartType").on("change", function () {
            const selected = $(this).val();

            $("#areaChartWeekly").hide();
            $("#areaChartRevenue").hide();
            $("#areaChartRevenue1").hide();
            $("#areaChartStatusWeekly").hide();
            $("#usersOrdersPerMonth").hide();

            if (selected === "weekly") {
                $("#areaChartWeekly").show();
            } else if (selected === "monthlyOrders") {
                $("#areaChartRevenue").show();
            } else if (selected === "monthlyRevenue") {
                $("#areaChartRevenue1").show();
            } else if (selected === "statusWeekly") {
                $("#areaChartStatusWeekly").show();
            }else if (selected === "usersOrdersPerMonth") {
                $("#usersOrdersPerMonth").show();
            }

        });

        $("#chartType").val("weekly").trigger("change");
    });
})(jQuery);
