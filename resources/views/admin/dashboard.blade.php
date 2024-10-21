@extends('layout.admin.home')
@section('content_admin')
    <!-- Page title & breadcrumb -->
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
                                <span class="icon icon-1"><i class="ri-shield-user-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Customers</h4>
                                    <h5>857k</h5>
                                </div>
                            </div>
                            <p class="card-groth up">
                                <i class="ri-arrow-up-line"></i>
                                32%
                                <span>Last Month</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="cr-card">
                        <div class="cr-card-content label-card">
                            <div class="title">
                                <span class="icon icon-2"><i class="ri-shopping-bag-3-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Order</h4>
                                    <h5>08.65k</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <i class="ri-arrow-down-line"></i>
                                1.7%
                                <span>Last Month</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="cr-card">
                        <div class="cr-card-content label-card">
                            <div class="title">
                                <span class="icon icon-3"><i class="ri-money-dollar-circle-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Revenue</h4>
                                    <h5>$85746</h5>
                                </div>
                            </div>
                            <p class="card-groth down">
                                <i class="ri-arrow-down-line"></i>
                                3.8%
                                <span>Last Month</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="cr-card">
                        <div class="cr-card-content label-card">
                            <div class="title">
                                <span class="icon icon-4"><i class="ri-exchange-dollar-line"></i></span>
                                <div class="growth-numbers">
                                    <h4>Expenses</h4>
                                    <h5>$75462</h5>
                                </div>
                            </div>
                            <p class="card-groth up">
                                <i class="ri-arrow-up-line"></i>
                                8%
                                <span>Last Month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="row">
        <div class="col-xxl-8 col-xl-12">
            <div class="cr-card revenue-overview">
                <div class="cr-card-header header-575">
                    <h4 class="cr-card-title">Revenue Overview</h4>
                    <div class="header-tools">
                        <a href="javascript:void(0)" class="m-r-10 cr-full-card" title="Full Screen"><i
                                class="ri-fullscreen-line"></i></a>
                        <div class="cr-date-range date">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="cr-card-content">
                    <div class="cr-chart-header">
                        <div class="block">
                            <h6>Orders</h6>
                            <h5>825
                                <span class="up"><i class="ri-arrow-up-line"></i>24%</span>
                            </h5>
                        </div>
                        <div class="block">
                            <h6>Revenue</h6>
                            <h5>$89k
                                <span class="up"><i class="ri-arrow-up-line"></i>24%</span>
                            </h5>
                        </div>
                        <div class="block">
                            <h6>Expence</h6>
                            <h5>$68k
                                <span class="down"><i class="ri-arrow-down-line"></i>24%</span>
                            </h5>
                        </div>
                        <div class="block">
                            <h6>Profit</h6>
                            <h5>$21k
                                <span class="up"><i class="ri-arrow-up-line"></i>24%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="cr-chart-content">
                        <div id="newrevenueChart" class="mb-m-24"></div>
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
                        <div class="block">
                            <h6>Social</h6>
                            <h5><span class="up">94%<i class="ri-arrow-up-line"></i></span>75k</h5>
                        </div>
                        <div class="block">
                            <h6>Referral</h6>
                            <h5><span class="down">96%<i class="ri-arrow-down-line"></i></span>54k</h5>
                        </div>
                        <div class="block">
                            <h6>Organic</h6>
                            <h5><span class="up">72%<i class="ri-arrow-up-line"></i></span>2.5k</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection
