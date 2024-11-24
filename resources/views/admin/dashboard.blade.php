@extends('layout.admin.home')
@section('content_admin')
    <!-- Page title & breadcrumb -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
        var productsSoldPerMonth = @json($productsSoldPerMonth);
        var mostViewedProductData = @json($mostViewedProductData);
        var mostViewedProduct = @json($mostViewedProduct);
        var dailyOrders = @json($dailyOrders);
        var dailyProductsSold = @json($dailyProductsSold);
        var dailyViews = @json($dailyViews);
    </script>

    <div class="cr-page-title">
        <div class="cr-breadcrumb">
            <h5>eCommerce</h5>
            <ul>
                <li><a href="index.html">Carrot</a></li>
                <li>eCommerce</li>
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
                                    <h4>TotalUsers</h4>
                                    <h5>{{ $totalUsers }}</h5>
                                </div>
                            </div>
                            <p class="card-groth up">
                                <i class="ri-arrow-up-line"></i>
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
                                    <h4>Total Products</h4>
                                    <h5>{{ $totalProducts }}</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <i class="ri-arrow-down-line"></i>
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
                                    <h4>TotalViews</h4>
                                    <h5>{{ $totalViews }}</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <i class="ri-arrow-down-line"></i>
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
                                    <h4>topSellingProduct</h4>
                                    <h5>{{ $topSellingProduct }}</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <i class="ri-arrow-down-line"></i>
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
                    <h4 class="cr-card-title">Revenue Overview</h4>

                </div>
                <div class="cr-card-content">
                    <div class="cr-chart-header">
                        <div class="block">
                            <h6>Orders</h6>
                            <h5>{{ $totalOrders }}
                                <span class="up"><i class="ri-arrow-up-line"></i></span>
                            </h5>
                        </div>
                        <div class="block">
                            <h6>totalProductsSold</h6>
                            <h5>{{ $totalProductsSold }}
                                <span class="down"><i class="ri-arrow-down-line"></i></span>
                            </h5>
                        </div>
                        <div class="block">
                            <h6>mostViewedProductViews</h6>
                            <h5> {{ $mostViewedProduct }}
                                <span class="up"><i class="ri-arrow-up-line"></i></span>
                            </h5>
                        </div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="newrevenueChart" class="mb-m-24"></div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="productStatisticsChart" class="mb-m-24"></div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="weeklyChart" class="mb-m-24"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6 col-md-12">
            <div class="cr-card" id="campaigns">
                <div class="cr-card-header">
                    <h4 class="cr-card-title">Campaigns</h4>
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
                    <div class="cr-chart-header-2">
                        {{-- <div class="block">
                            <h6>Orders</h6>
                            <h5>
                                <span class="up">
                                    @if ($ordersPerMonth[1] != 0)
                                        {{ round(($ordersPerMonth[0] - $ordersPerMonth[1]) / $ordersPerMonth[1] * 100, 2) }}%
                                    @else
                                        0%
                                    @endif
                                    <i class="ri-arrow-up-line"></i>
                                </span>
                                {{-- {{ number_format($ordersPerMonth[0]) }} 
                            </h5>
                        </div>
                        
                        <div class="block">
                            <h6>Products Sold</h6>
                            <h5>
                                <span class="down">
                                    @if ($productsSoldPerMonth[1] != 0)
                                        {{ round(($productsSoldPerMonth[0] - $productsSoldPerMonth[1]) / $productsSoldPerMonth[1] * 100, 2) }}%
                                    @else
                                        0%
                                    @endif
                                    <i class="ri-arrow-down-line"></i>
                                </span>
                                {{-- {{ number_format($productsSoldPerMonth[0]) }} 
                            </h5>
                        </div>
                        
                        <div class="block">
                            <h6>Product Views</h6>
                            <h5>
                                <span class="up">
                                    @if ($viewsPerMonth[1] != 0)
                                        {{ round(($viewsPerMonth[0] - $viewsPerMonth[1]) / $viewsPerMonth[1] * 100, 2) }}%
                                    @else
                                        0%
                                    @endif
                                    <i class="ri-arrow-up-line"></i>
                                </span>
                                {{-- {{ number_format($viewsPerMonth[0]) }}  
                            </h5>
                        </div>
                         --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
