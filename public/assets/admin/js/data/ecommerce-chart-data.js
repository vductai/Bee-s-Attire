(function ($) {
    "use strict";

    // Biểu đồ thống kê theo tháng
    function newrevenueChart() {
        var options = {
            chart: {
                height: 365,
                type: 'line',
                stacked: false,
                foreColor: '#373d3f',
                sparkline: { enabled: false },
                dropShadow: {
                    enabled: true,
                    top: 5,
                    left: 5,
                    blur: 3,
                    color: '#000',
                    opacity: 0.1
                },
                toolbar: { show: false }
            },
            dataLabels: { enabled: false },
            series: [
                {
                    name: 'Orders',
                    data: ordersPerMonth, 
                }, 
                {
                    name: 'Products Sold',
                    data: productsSoldPerMonth, 
                },

                {
                    name: 'Most Viewed Product Views',
                    data: mostViewedProductData, 
                }
            ],
            plotOptions: { bar: { horizontal: false, columnWidth: '20%' } },
            stroke: { width: [2, 2, 2], curve: "smooth" },

            fill: {
                opacity: [1, 1, 1],
                gradient: { inverseColors: false, shade: 'light', type: "vertical", opacityFrom: .45, opacityTo: .05, stops: [50, 100, 100, 100] }
            },
            colors: ["#3f51b5", "#50d1f8", "#5caf90"],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                axisBorder: { show: false }
            },
            yaxis: {
                labels: { formatter: function (e) { return e; }, offsetX: -15 }
            },
            legend: {
                show: true,
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: -5,
                markers: { width: 15, height: 10, radius: 6 },
                itemMargin: { horizontal: 10, vertical: 0 }
            },
            grid: {
                show: false,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: false } },
                padding: { top: 0, right: -2, bottom: 15, left: 0 }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: { height: '250px' },
                    yaxis: { show: false }
                }
            }]
        };
        var newrevenueChart = new ApexCharts(document.querySelector("#newrevenueChart"), options);
        newrevenueChart.render();
    }

    // Biểu đồ thống kê theo tuần
    function newWeeklyChart() {
        var options = {
            chart: {
                height: 365,
                type: 'line',
                stacked: false,
                foreColor: '#373d3f',
                sparkline: { enabled: false },
                dropShadow: {
                    enabled: true,
                    top: 5,
                    left: 5,
                    blur: 3,
                    color: '#000',
                    opacity: 0.1
                },
                toolbar: { show: false }
            },
            dataLabels: { enabled: false },
            series: [
                {
                    name: 'Orders',
                    data: dailyOrders, 
                }, 
                {
                    name: 'Products Sold',
                    data: dailyProductsSold,
                },
                {
                    name: 'Views',
                    data: dailyViews,
                }
            ],
            plotOptions: { bar: { horizontal: false, columnWidth: '20%' } },
            stroke: { width: [2, 2, 2], curve: "smooth" },
            fill: {
                opacity: [1, 1, 1],
                gradient: { inverseColors: false, shade: 'light', type: "vertical", opacityFrom: .45, opacityTo: .05, stops: [50, 100, 100, 100] }
            },
            colors: ["#3f51b5", "#50d1f8", "#5caf90"],
            xaxis: {
                categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                axisTicks: { show: false },
                axisBorder: { show: false }
            },
            yaxis: {
                labels: { formatter: function (e) { return e; }, offsetX: -15 }
            },
            legend: {
                show: true,
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: -5,
                markers: { width: 15, height: 10, radius: 6 },
                itemMargin: { horizontal: 10, vertical: 0 }
            },
            grid: {
                show: false,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: false } },
                padding: { top: 0, right: -2, bottom: 15, left: 0 }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: { height: '250px' },
                    yaxis: { show: false }
                }
            }]
        };
        var weeklyChart = new ApexCharts(document.querySelector("#weeklyChart"), options);
        weeklyChart.render();
    }
    // Khởi tạo biểu đồ 
    $(document).ready(function() {
        newrevenueChart();
        newWeeklyChart();

    });

})(jQuery);
