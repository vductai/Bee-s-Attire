@extends('layout.admin.home')
@include('toast.admin-toast')
@section('content_admin')
    <script>
        var ordersPerMonth = @json($ordersPerMonth);
        var dailyOrders = @json($dailyOrders);
        var revenuePerMonth = @json($revenuePerMonth);
        var dailyOrdersLastWeek = @json($dailyOrdersLastWeek);
        var ordersByStatusWeekly = @json($ordersByStatusWeekly);
        var usersOrdersPerMonth = @json($usersOrdersPerMonth);
        var topUsers = @json($topUsers);
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

                                <span class="icon icon-2"><i class="ri-product-hunt-line"></i></span>
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
                                <option value="statusWeekly">Biểu đồ đơn hàng theo trạng thái đơn hàng</option>
                                <option value="monthlyOrders">Biểu đồ đơn hàng theo tháng trong năm</option>
                                <option value="monthlyRevenue">Biểu đồ doanh thu theo tháng trong năm</option>
                                <option value="usersOrdersPerMonth">Biểu đồ người dùng đặt hàng nhiều nhất</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="cr-card-content">

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
                        <div id="areaChartStatusWeekly" class="mb-m-24" style="display: none;"></div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="usersOrdersPerMonth" class="mb-m-24" style="display: none;"></div>
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
                    <div class="cr-chart-header-2">
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


    <div class="row">
        <div class="col-xxl-6 col-xl-12">
            <div class="cr-card" id="best_seller_tbl">
                <div class="cr-card-header">
                    <h4 class="cr-card-title">Top 5 sản phẩm bán chạy nhất</h4>
                    <div class="header-tools">
                        <a href="javascript:void(0)" class="m-r-10 cr-full-card" title="Full Screen"><i
                                class="ri-fullscreen-line"></i></a>
                        <div class="cr-date-range dots">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="cr-card-content card-default">
                    <div class="best-seller-table">
                        <div class="table-responsive">
                            <table id="best_seller_data_table" class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng bán</th>
                                    <th>Giá bán</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($top5MostSoldProductsDetails as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img class="tbl-thumb"
                                                 src="{{ asset('upload/' . $product->product_avatar) }}"
                                                 alt="Product Image" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->total_sales }}</td>
                                        <td>{{ number_format($product->total_revenue) }} VNĐ</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-xl-12">
            <div class="cr-card" id="top_product_tbl">
                <div class="cr-card-header">
                    <h4 class="cr-card-title">Top 5 sản phẩm lượt xem cao nhất</h4>
                    <div class="header-tools">
                        <a href="javascript:void(0)" class="m-r-10 cr-full-card" title="Full Screen"><i
                                class="ri-fullscreen-line"></i></a>
                        <div class="cr-date-range dots">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="cr-card-content card-default">
                    <div class="top-product-table">
                        <div class="table-responsive">
                            <table id="top_product_data_table" class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Lượt xem</th>
                                    <th>Giá bán</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($top5MostViewedProducts as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img class="tbl-thumb"
                                                 src="{{ asset('upload/' . $product->product_avatar) }}"
                                                 alt="Product Image" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->views }}</td>
                                        <td>{{ number_format($product->sale_price) }} VNĐ</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
