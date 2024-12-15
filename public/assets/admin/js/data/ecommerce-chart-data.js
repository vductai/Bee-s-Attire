(function ($) {
    "use strict";

    // Biểu đồ thống kê Orders theo tháng
    function areaChartRevenue() {
        var options = {
            chart: {
                type: "area",
                height: 365,
                sparkline: { enabled: false },
                dropShadow: { enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1 },
                toolbar: { show: false }
            },
            series: [{ name: 'Đơn hàng', data: ordersPerMonth }],
            stroke: { width: 2, curve: 'smooth' },
            colors: ["#3f51b5"],
            xaxis: {
                categories: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            grid: { show: false },
            tooltip: { fixed: { enabled: false } },
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
                sparkline: { enabled: false },
                dropShadow: { enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1 },
                toolbar: { show: false }
            },
            series: [{ name: 'Doanh thu', data: revenuePerMonth }],
            stroke: { width: 2, curve: 'smooth' },
            colors: ["#3f51b5"],
            dataLabels: {
                enabled: true, 
                formatter: function (value) {
                    return value.toLocaleString('vi-VN') + "VNĐ";
                },
                style: {
                    fontSize: '12px',
                    colors: ["#3f51b5"] 
                }
            },
            xaxis: {
                categories: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    rotate: 0,
                    style: {
                        fontSize: '11px'
                    }
                }
            },
            grid: { show: false },
            tooltip: {
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
                    formatter: function (value, { dataPointIndex, }) {
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


    // Biểu đồ trạng thái đơn hàng theo thangs
    function areaChartStatus() {
        var options = {
            chart: {
                type: "line",
                height: 365,
                sparkline: { enabled: false },
                dropShadow: { enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1 },
                toolbar: { show: false },
            },
            series: Object.keys(ordersByStatusMonthly).map(function (status) {
                return {
                    name: status,
                    data: ordersByStatusMonthly[status]
                };
            }),
            stroke: { width: 2, curve: 'smooth' },
            colors: ["#ff9800", "#4caf50", "#f44336", "#2196f3"],
            xaxis: {
                categories: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: {
                        fontSize: '11px',
                        fontWeight: 'normal',
                        color: '#333'
                    }
                }
            },
            grid: { show: false },
            tooltip: {
                fixed: { enabled: false },
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
                text: 'Trạng thái đơn hàng theo tháng',
                align: 'center',
                margin: 20,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#333'
                }
            }
        };
        var areaChartStatus = new ApexCharts(document.querySelector("#areaChartStatus"), options);
        areaChartStatus.render();
    }

    // Biểu đồ thống kê đơn hàng theo tuần

    
    function areaChartWeekly() {
        var currentMonth = new Date().toLocaleString('vi-VN', { month: 'long' });
        var options = {
            chart: {
                type: "area",
                height: 365,
                sparkline: { enabled: false },
                dropShadow: { enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1 },
                toolbar: { show: false }
            },
            series: [{ name: 'Đơn hàng', data: dailyOrders }],
            stroke: { width: 2, curve: 'smooth' },
            colors: ["#3f51b5"],
            xaxis: {
                categories: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            grid: { show: false },
            tooltip: { fixed: { enabled: false } },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return Math.floor(value);
                    }
                },
            },
            title: {
                text: `Thống kê đơn hàng theo tuần của ${currentMonth}`,
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
    
      // Biểu đồ trạng thái đơn hàng theo tuần
      function areaChartStatusWeekly() {
        var currentMonth = new Date().toLocaleString('vi-VN', { month: 'long' });
        var options = {
            chart: {
                type: "line",
                height: 365,
                sparkline: { enabled: false },
                dropShadow: { enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1 },
                toolbar: { show: false },
            },
            series: Object.keys(ordersByStatusWeekly).map(function (status) {
                return {
                    name: status,
                    data: ordersByStatusWeekly[status]
                };
            }),
            stroke: { width: 2, curve: 'smooth' },
            colors: ["#ff9800", "#4caf50", "#f44336", "#2196f3"],
            xaxis: {
                categories: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: {
                        fontSize: '11px',
                        fontWeight: 'normal',
                        color: '#333'
                    }
                }
            },
            grid: { show: false },
            tooltip: {
                fixed: { enabled: false },
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
                text: `Trạng thái đơn hàng theo tuần của ${currentMonth}`,
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

    //oanh thu và đơn hàng tháng này so với tổng một năm
    var currentMonth = new Date().getMonth();
    var totalRevenueThisMonth = parseInt(revenuePerMonth[currentMonth]) || 0;
    var totalOrdersThisMonth = ordersPerMonth[currentMonth] || 0;

    var allRevenueThisMonth = revenuePerMonth.reduce((sum, item) => sum + parseInt(item) || 0, 0);
    var allOrdersThisMonth = ordersPerMonth.reduce((sum, item) => sum + (item || 0), 0);

    var revenuePercentageOfTotal = allRevenueThisMonth > 0 ? (totalRevenueThisMonth / allRevenueThisMonth) * 100 : 0;

    var ordersPercentageOfTotal = allOrdersThisMonth > 0 ? (totalOrdersThisMonth / allOrdersThisMonth) * 100 : 0;

    revenuePercentageOfTotal = Math.round(revenuePercentageOfTotal * 10) / 10;
    ordersPercentageOfTotal = Math.round(ordersPercentageOfTotal * 10) / 10;

    document.getElementById("revenueChange").innerHTML =
        `<span class="${revenuePercentageOfTotal > 0 ? 'up' : 'down'}">${revenuePercentageOfTotal.toFixed(1)}%</span>`;

    document.getElementById("ordersChange").innerHTML =
        `<span class="${ordersPercentageOfTotal > 0 ? 'up' : 'down'}">${ordersPercentageOfTotal.toFixed(1)}%</span>`;

    document.getElementById("totalOrders").innerHTML =
        `${totalOrdersThisMonth} đơn hàng`;

    document.getElementById("totalRevenue").innerHTML =
        `${Math.round(totalRevenueThisMonth).toLocaleString('vi-VN')} VNĐ`;

    function newcampaignsChart() {
        var options = {
            series: [ordersPercentageOfTotal, revenuePercentageOfTotal],
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
                            label: 'Tổng ',
                            formatter: function () {
                                return `${(ordersPercentageOfTotal + revenuePercentageOfTotal).toFixed(1)}%`;
                            }
                        }
                    }
                }
            },
            labels: ['% Đơn hàng so với tổng', '% Doanh thu so với tổng'],
            colors: ["#3f51b5", "#50d1f8"], 
        };
        var newcampaignsChart = new ApexCharts(document.querySelector("#newcampaignsChart"), options);
        newcampaignsChart.render();
    }


    $(document).ready(function () {
        areaChartWeekly();
        areaChartStatusWeekly();
        areaChartRevenue();
        areaChartRevenue1();
        newcampaignsChart();
        areaChartStatus();
        areaChartUsersOrders();

        $("#chartType").on("change", function () {
            const selected = $(this).val();

            $("#areaChartWeekly").hide();
            $("#areaChartStatusWeekly").hide();
            $("#areaChartRevenue").hide();
            $("#areaChartRevenue1").hide();
            $("#areaChartStatus").hide();
            $("#usersOrdersPerMonth").hide();

            if (selected === "weekly") {
                $("#areaChartWeekly").show();
            } else if (selected === "statusWeekly") {
                $("#areaChartStatusWeekly").show();
            } else if (selected === "monthlyOrders") {
                $("#areaChartRevenue").show();
            } else if (selected === "monthlyRevenue") {
                $("#areaChartRevenue1").show();
            } else if (selected === "statusMonth") {
                $("#areaChartStatus").show();
            } else if (selected === "usersOrdersPerMonth") {
                $("#usersOrdersPerMonth").show();
            }

        });

        $("#chartType").val("weekly").trigger("change");
    });
})(jQuery);


