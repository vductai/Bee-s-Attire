<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ecommerce, market, shop, mart, cart, deal, multipurpose, marketplace">
    <meta name="description" content="Carrot - Multipurpose eCommerce HTML Template.">
    <meta name="author" content="ashishmaraviya">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Carrot - Multipurpose eCommerce HTML Template</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/client/img/logo/favicon.png')}}">

    <!-- Icon CSS -->
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/remixicon.css')}}">


    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/aos.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/range-slider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/jquery.slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/slick-theme.css')}}">
    @vite('resources/js/comment.js')
    @vite('resources/js/whishlist.js')

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/client/css/style.css')}}">
    <livewire:styles/>
</head>

<body class="body-bg-6">

<!-- Loader -->
<div id="cr-overlay">
    <span class="loader"></span>
</div>

<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-header">
                    <a href="{{route('home')}}" class="cr-logo">
                        <img src="{{asset('assets/client/img/logo/logo.png')}}" alt="logo" class="logo">
                        <img src="{{asset('assets/client/img/logo/dark-logo.png')}}" alt="logo" class="dark-logo">
                    </a>
                    <livewire:tag-search/>
                    <div class="cr-right-bar">
                        <ul class="navbar-nav">
                            @if(auth()->check())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span>{{auth()->user()->username}}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{route('profile')}}">Hồ sơ</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('checkout')}}">Thanh toán đơn hàng</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('get-all-order')}}">Đơn hàng của bạn</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('client.logout') }}" method="POST"
                                                  style="display: none;" id="logout-form">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item" href="#"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span>Tài khoản</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{route('client.viewRegister')}}">Đăng kí</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('client-viewLogin')}}">Đăng nhập</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                        @if(auth()->check())
                            <a href="{{route('list-wish')}}" class="cr-right-bar-item">
                                <i class="ri-heart-3-line"></i>
                                <span>Yêu thích</span>
                            </a>
                            <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle position-relative">
                                <i class="ri-shopping-cart-line"></i>
                                <span class="me-3">Giỏ hàng</span>
                                @if(\App\Models\Cart::where('user_id', auth()->user()->user_id)->exists())
                                    <span
                                        class="position-absolute top-10 start-100 translate-middle
                                        bg-danger border border-light rounded-circle" style="padding: 6px">
                                    </span>
                                @else
                                    <span
                                        class="position-absolute top-10 start-100 translate-middle
                                        bg-danger border border-light rounded-circle" style="padding: 6px; display:none;">
                                    </span>
                                @endif
                            </a>
                        @else
                            {{--  --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cr-fix" id="cr-main-menu-desk">
        @include('layout.client.navigation')
    </div>
</header>
<livewire:scripts/>
@include('layout.client.mobile-menu')