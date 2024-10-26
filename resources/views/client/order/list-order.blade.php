@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Checkout</h2>
                            <span> <a href="index.html">Home</a> - Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout section -->
    <section class="cr-checkout-section padding-tb-100">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="cr-checkout-rightside col-lg-4 col-md-12">
                    <div class="cr-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Thông Tin Người Nhận</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-summary">
                                    <div>
                                        <span class="text-left">Họ và tên</span>
                                        <span class="text-right">{{$getUser->username}}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Số điện thoại</span>
                                        <span class="text-right">{{$getUser->phone}}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Email</span>
                                        <span class="text-right">{{$getUser->email}}</span>
                                    </div>
                                    <div>
                                        <span class="text-left">Địa chỉ nhận hàng</span>
                                        <span class="text-right">{{$getUser->address}}</span>
                                    </div>
                                </div>
                                <div class="cr-checkout-pro">

                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
                <div class="cr-checkout-leftside col-lg-8 col-md-12 m-t-991">
                    <!-- checkout content Start -->
                    <div class="cr-checkout-content">
                        <div class="cr-checkout-inner">
                            <div class="cr-checkout-wrap mb-30">
                                <div class="cr-checkout-block cr-check-new">
                                    <h3 class="cr-checkout-title">Đơn hàng</h3>
                                </div>
                                <div>
                                    @foreach($getOrder as $item)
                                        <div class="d-flex justify-content-evenly align-items-center border border-2 rounded-2 mb-3 w-75" style="height: 200px">
                                            <div>
                                                <img src="{{asset('assets/client/img/product/1.jpg')}}" width="170" height="170" alt="">
                                            </div>
                                            <div class="">
                                                <ul class="" style="list-style: none">
                                                    <li><label>Tên sản phẩm :</label></li>
                                                    <li><label>Diet Type :</label>Vegetarian</li>
                                                    <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                                    <li>$120.25</li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
@endsection
