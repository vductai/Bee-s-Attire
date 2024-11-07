(function ($) {
    "use strict";
    function newrevenueChart() {
        var options = {
            chart: {
                height: 365,
                type: 'line',
                stacked: false,
                foreColor: '#373d3f',
                sparkline: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    top: 5,
                    left: 5,
                    blur: 3,
                    color: '#000',
                    opacity: 0.1
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                    name: 'Orders',
                    data: ordersPerMonth,
                }, {
                    name: 'Products Sold',
                    data: productsSoldPerMonth, 
                }, {
                    name: 'Views',
                    data: viewsPerMonth, 
                },
                
                
            ],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '20%',
                }
            },
            stroke: {
                width: [2, 2, 2],
                curve: "smooth",
            },
            fill: {
                opacity: [1, 1, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: .45,
                    opacityTo: .05,
                    stops: [50, 100, 100, 100]
                }
            },
            colors: ["#3f51b5", "#50d1f8", "#5caf90"],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], 
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    formatter: function (e) {
                        return e;
                    },
                    offsetX: -15
                }
            },
            legend: {
                show: true,
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: -5,
                markers: {
                    width: 15,
                    height: 10,
                    radius: 6
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 0
                }
            },
            grid: {
                show: false,
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
                padding: {
                    top: 0,
                    right: -2,
                    bottom: 15,
                    left: 0
                },
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: '250px',
                    },
                    yaxis: {
                        show: false,
                    },
                }
            }]
        };
        var newrevenueChart = new ApexCharts(document.querySelector("#newrevenueChart"), options);
        newrevenueChart.render();
    }
    function newcampaignsChart() {
        var options = {
            series: [
                ordersPerMonth.reduce((a, b) => a + b, 0),  
                productsSoldPerMonth.reduce((a, b) => a + b, 0), 
                viewsPerMonth.reduce((a, b) => a + b, 0)
            ],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
         
                                return w.series.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            },
            labels: ['Orders', 'Products Sold', 'Product Views'],
            colors: ["#3f51b5", "#50d1f8", "#5caf90"],
        };
    
        var newcampaignsChart = new ApexCharts(document.querySelector("#newcampaignsChart"), options);
        newcampaignsChart.render();
    }
    

    jQuery(window).on('load', function () {
        newrevenueChart();
        newcampaignsChart();
    });
})(jQuery);
