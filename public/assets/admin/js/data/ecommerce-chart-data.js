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
                fixed: { enabled: false },
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
            }
        };
        var areaChartRevenue1 = new ApexCharts(document.querySelector("#areaChartRevenue1"), options);
        areaChartRevenue1.render();
    }


    // Biểu đồ thống kê Orders theo tuần
    function areaChartWeekly() {
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
            }
        };
        var areaChartWeekly = new ApexCharts(document.querySelector("#areaChartWeekly"), options);
        areaChartWeekly.render();
    }
    function areaChartLastWeek() {
        var options = {
            chart: {
                type: "area",
                height: 365,
                sparkline: { enabled: false },
                dropShadow: { enabled: true, top: 5, left: 5, blur: 3, color: '#000', opacity: 0.1 },
                toolbar: { show: false }
            },
            series: [{ name: 'Đơn hàng tuần trước', data: dailyOrdersLastWeek }],
            stroke: { width: 2, curve: 'smooth' },
            colors: ["#ff9800"],
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
            }
        };
        var areaChartLastWeek = new ApexCharts(document.querySelector("#areaChartLastWeek"), options);
        areaChartLastWeek.render();
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
        areaChartLastWeek();
        newcampaignsChart();

        $("#chartType").on("change", function () {
            const selected = $(this).val();

            $("#areaChartWeekly").hide();
            $("#areaChartRevenue").hide();
            $("#areaChartRevenue1").hide();
            $("#areaChartLastWeek").hide();

            if (selected === "weekly") {
                $("#areaChartWeekly").show();
            } else if (selected === "monthlyOrders") {
                $("#areaChartRevenue").show();
            } else if (selected === "monthlyRevenue") {
                $("#areaChartRevenue1").show();
            } else if (selected === "areaChartLastWeek") {
                $("#areaChartLastWeek").show();
            }

        });

        $("#chartType").val("weekly").trigger("change");
    });
})(jQuery);


