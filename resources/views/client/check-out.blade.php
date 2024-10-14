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
                                <h3 class="cr-sidebar-title">Sơ lược</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-summary">

                                    <div>
                                        <span class="text-left">Tiền hàng</span>
                                        <span class="text-right">{{number_format($totalAmount)}} đ</span>
                                    </div>

                                    <div>
                                        <span class="text-left">Giảm giá</span>
                                        <span class="text-right">{{ number_format($discount) ?? '0'}} đ</span>
                                    </div>
                                    <div class="cr-checkout-summary-total">
                                        <span class="text-left">Tổng tiền hàng</span>
                                        <span class="text-right">{{number_format($total_after_discount) ?? '0'}} đ</span>
                                    </div>
                                </div>
                                <div class="cr-checkout-pro">
                                    <div class="col-sm-12 mb-6">
                                        @foreach($selCart as $item)
                                            <div class="cr-product-inner">
                                                <div class="cr-pro-image-outer">
                                                    <div class="cr-pro-image">
                                                        <a href="product-left-sidebar.html" class="image">
                                                            <img class="main-image"
                                                                 src="{{asset('upload/'. $item->product->product_avatar)}}"
                                                                 alt="Product">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="cr-pro-content cr-product-details">
                                                    <h5 class="cr-pro-title">
                                                        <a href="product-left-sidebar.html">{{$item->product->product_name}}</a>
                                                    </h5>
                                                    <div class="cr-pro-rating">
                                                        <p>x{{$item->quantity}}</p>
                                                    </div>
                                                    <p class="cr-price">
                                                        <span class="new-price">{{number_format($item->product->sale_price)}} đ</span>
                                                        <span class="old-price">{{number_format($item->product->product_price)}} đ</span>
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                    <div class="cr-sidebar-wrap cr-checkout-del-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Voucher</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-del">
                                    <form action="{{route('addVoucher')}}" method="post">
                                        <input type="hidden" name="totalAmount" value="{{$totalAmount}}">
                                        @csrf
                                        <span class="cr-del-option">
                                            <span >
                                                <span class="cr-del-opt-head">Nhập mã giảm giá</span>
                                                <input type="text" class="form-control" name="voucher_code">
                                            </span>
                                        </span>
                                        <button class="btn btn-success mt-2" type="submit">Add mã giảm giá</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                    <div class="cr-sidebar-wrap cr-checkout-pay-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Phương thức thanh toán</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-checkout-pay">
                                    <div class="cr-pay-desc">
                                        Vui lòng chọn phương thức thanh toán ưa thích để sử dụng cho đơn hàng này.
                                    </div>
                                    <form action="#" class="payment-options">
                                        <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay1" name="radio-group" checked>
                                                <label for="pay1">Tiền mặt khi giao hàng</label>
                                            </span>
                                        </span>
                                        <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay2" name="radio-group">
                                                <label for="pay2">UPI</label>
                                            </span>
                                        </span>
                                        <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay3" name="radio-group">
                                                <label for="pay3">Chuyển khoản ngân hàng</label>
                                            </span>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                    <div class="cr-sidebar-wrap cr-check-pay-img-wrap">
                        <!-- Sidebar Payment Block -->
                        <div class="cr-sidebar-block">
                            <div class="cr-sb-title">
                                <h3 class="cr-sidebar-title">Payment Method</h3>
                            </div>
                            <div class="cr-sb-block-content">
                                <div class="cr-check-pay-img-inner">
                                    <div class="cr-check-pay-img">
                                        <img src="{{asset('assets/client/img/banner/payment.png')}}" alt="payment">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Payment Block -->
                    </div>
                </div>
                <div class="cr-checkout-leftside col-lg-8 col-md-12 m-t-991">
                    <!-- checkout content Start -->
                    <div class="cr-checkout-content">
                        <div class="cr-checkout-inner">
                            {{--<div class="cr-checkout-wrap mb-30">
                                <div class="cr-checkout-block cr-check-new">
                                    <h3 class="cr-checkout-title">New Customer</h3>
                                    <div class="cr-check-block-content">
                                        <div class="cr-check-subtitle">Checkout Options</div>
                                        <form action="#">
                                            <span class="cr-new-option">
                                                <span>
                                                    <input type="radio" id="account1" name="radio-group" checked>
                                                    <label for="account1">Register Account</label>
                                                </span>
                                                <span>
                                                    <input type="radio" id="account2" name="radio-group">
                                                    <label for="account2">Guest Account</label>
                                                </span>
                                            </span>
                                        </form>
                                        <div class="cr-new-desc">By creating an account you will be able to shop faster,
                                            be up to date on an order's status, and keep track of the orders you have
                                            previously made.
                                        </div>
                                        <span>
                                            <button class="cr-button mt-30" type="submit">Continue</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="cr-checkout-block cr-check-login">
                                    <h3 class="cr-checkout-title">Returning Customer</h3>
                                    <div class="cr-check-login-form">
                                        <form action="#" method="post">
                                            <span class="cr-check-login-wrap">
                                                <label>Email Address</label>
                                                <input type="text" name="name" placeholder="Enter your email address"
                                                       required>
                                            </span>
                                            <span class="cr-check-login-wrap">
                                                <label>Password</label>
                                                <input type="password" name="password" placeholder="Enter your password"
                                                       required>
                                            </span>

                                            <span class="cr-check-login-wrap cr-check-login-btn">
                                                <button class="cr-button mr-15" type="submit">Login</button>
                                                <a class="cr-check-login-fp" href="#">Forgot Password?</a>
                                            </span>
                                        </form>
                                    </div>
                                </div>

                            </div>--}}
                            <div class="cr-checkout-wrap">
                                <div class="cr-checkout-block cr-check-bill">
                                    <h3 class="cr-checkout-title">Chi tiết thanh toán</h3>
                                    <div class="cr-bl-block-content">
                                        {{--<div class="cr-check-subtitle">Checkout Options</div>
                                        <span class="cr-bill-option">
                                            <span>
                                                <input type="radio" id="bill1" name="radio-group">
                                                <label for="bill1">I want to use an existing address</label>
                                            </span>
                                            <span>
                                                <input type="radio" id="bill2" name="radio-group" checked>
                                                <label for="bill2">I want to use new address</label>
                                            </span>
                                        </span>--}}
                                        <div class="cr-check-bill-form mb-minus-24">
                                            <form action="#" method="post" id="formCheckOut">
                                                @csrf
                                                <span class="cr-bill-wrap">
                                                    <label>UserName</label>
                                                    <input type="text" value="{{$item->user->username}}"
                                                           name="username"
                                                           placeholder="Enter your username" required>
                                                </span>
                                                <span class="cr-bill-wrap">
                                                    <label>Address</label>
                                                    <input type="text" name="address" value="{{$item->user->address}}"
                                                           placeholder="Address">
                                                </span>
                                                <span class="cr-bill-wrap ">
                                                    <label>Phone</label>
                                                    <input type="number" value="{{$item->user->phone}}" name="phone"
                                                           placeholder="Phone">
                                                </span>
                                                <span class="cr-bill-wrap ">
                                                    <label>Email</label>
                                                    <input type="email" value="{{$item->user->email}}" name="email"
                                                           placeholder="Email">
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="cr-check-order-btn">
                                <a class="cr-button mt-30"
                                   onclick="event.preventDefault(); document.getElementById('formCheckOut').submit();"
                                   href="#">Place Order</a>
                            </span>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
@endsection
