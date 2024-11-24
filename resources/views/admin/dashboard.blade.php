@extends('layout.admin.home')
@include('toast.admin-toast')

@section('content_admin')
    <!-- Page title & breadcrumb -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('88008db891eef10204ed', {

            cluster: 'ap1'

        });

        var channel = pusher.subscribe('notify-channel');
        channel.bind('form-submit', function(data) {
            // Xử lý thông báo
            console.log(data);
        });
    </script>
    <script>
        var ordersPerMonth = @json($ordersPerMonth);
        var dailyOrders = @json($dailyOrders);
        var revenuePerMonth = @json($revenuePerMonth);
        var dailyOrdersLastWeek = @json($dailyOrdersLastWeek); 
    </script>

    <div class="cr-page-title">
        <div class="cr-breadcrumb">
            <h5>Thống kê</h5>
            <ul>
                <li><a href="index.html">Carrot</a></li>
                <li>Thống kê</li>
            </ul>
        </div>
        <div class="cr-tools">
            <div id="pagedate">
                <div class="cr-date-range" title="Date">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="cr-card">
                        <div class="cr-card-content label-card">
                            <div class="title">
                                <span class="icon icon-1"><i class="ri-shopping-bag-3-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Tổng số người dùng</h4>
                                    <h5>{{ $totalUsers }}</h5>
                                </div>
                            </div>
                            <p class="card-groth up">
                                <span>{{ $thisMonth }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="cr-card">
                        <div class="cr-card-content label-card">
                            <div class="title">
                                <span class="icon icon-2"><i class="ri-star-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Tổng số sản phẩm</h4>
                                    <h5>{{ $totalProducts }}</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <span>{{ $thisMonth }}</span>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="cr-card">
                        <div class="cr-card-content label-card">
                            <div class="title">
                                <span class="icon icon-3"><i class="ri-eye-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Tổng số lượt xem</h4>
                                    <h5>{{ $totalViews }}</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <span>{{ $thisMonth }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="cr-card">
                        <div class="cr-card-content label-card">
                            <div class="title">
                                <span class="icon icon-4"><i class="ri-money-dollar-circle-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Tổng sản phẩm đã bán</h4>
                                    <h5>{{ $totalProductsSold }}</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <span>{{ $thisMonth }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-8 col-xl-12">
            <div class="cr-card revenue-overview">
                <div class="cr-card-header header-575">
                    <h4 class="cr-card-title">Tổng quan về thống kê</h4>
                    <div class="header-tools">
                        <a href="javascript:void(0)" class="m-r-10 cr-full-card" title="Full Screen"><i
                                class="ri-fullscreen-line"></i></a>
                                
                                <div class="mb-3 mt-3">
                                    <select id="chartType" class="form-select form-select-sm">
                                        <option value="weekly">Biểu đồ Đơn hàng tuần này</option>
                                        <option value="areaChartLastWeek">Biểu đồ Đơn hàng tuần trước</option>
                                        <option value="monthlyOrders">Biểu đồ Đơn hàng theo tháng trong năm</option>
                                        <option value="monthlyRevenue">Biểu đồ Doanh thu theo tháng trong năm</option>
                                    </select>
                                </div>
                    </div>
                </div>
                <div class="cr-card-content">

                    <div class="cr-chart-content">
                        <div id="newrevenueChart" class="mb-m-24"></div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="areaChartWeekly" class="mb-m-24"></div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="areaChartRevenue" class="mb-m-24" style="display: none;"></div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="areaChartRevenue1" class="mb-m-24" style="display: none;"></div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="areaChartLastWeek" class="mb-m-24" style="display: none;"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6 col-md-12">
            <div class="cr-card" id="campaigns">
                <div class="cr-card-header">
                    <h4 class="cr-card-title">Tăng trưởng bán hàng</h4>
                    <div class="header-tools">
                        <div class="cr-date-range dots">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="cr-card-content">
                    <div class="cr-chart-content">
                        <div id="newcampaignsChart"></div>
                    </div>
                    <div class="cr-chart-header-2" >
                        <div class="block">
                            <h6>Tổng đơn hàng</h6>
                            <h5><span id="ordersChange"></span> <span id="totalOrders"></span></h5> 
                        </div>
                        <div class="block">
                            <h6>Tổng doanh thu</h6>
                            <h5><span id="revenueChange"></span> <span id="totalRevenue"></span></h5> 
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
@endsection
