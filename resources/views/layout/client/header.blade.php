<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ecommerce, market, shop, mart, cart, deal, multipurpose, marketplace">
    <meta name="description" content="Carrot - Multipurpose eCommerce HTML Template.">
    <meta name="author" content="ashishmaraviya">
    @if(auth()->check())
        <meta name="user-id" content="{{auth()->user()->user_id}}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang chủ')</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    <!-- Icon CSS -->
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/remixicon.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap"
          rel="stylesheet">

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
@vite('resources/js/order.js')
@vite('resources/js/voucherassigned.js')
@vite('resources/js/order-status.js')
@vite('resources/js/auth.js')
@vite('resources/js/chat.js')
@vite('resources/js/password.js')
@vite('resources/js/noti-post.js')
@vite('resources/js/contact.js')
<!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/client/css/style.css')}}">
</head>
<style>
    body.modal-open{
        overflow: auto !important;
    }
    .modal{
        pointer-events: auto !important;
    }
    .modal-backdrop{
        display: none !important;
    }
</style>
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
                        <img src="{{asset('full-logo.png')}}" alt="logo" class="logo">
                        <img src="{{asset('assets/client/img/logo/dark-logo.png')}}" alt="logo" class="dark-logo">
                    </a>
                    <form class="cr-search" action="{{route('search-product')}}" method="get">
                        <input class="search-input"
                               autocomplete="off"
                               name="key"
                               id="key"
                               type="text" placeholder="Tìm kiếm mục...">
                        <a href="javascript:void(0)" class="search-btn">
                            <i class="ri-search-line"></i>
                        </a>
                    </form>
                    <datalist id="browsers"></datalist>
                    <div class="cr-right-bar">
                        @if(auth()->check())
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item"
                                       href="{{route('notification')}}">
                                        <i class="ri-notification-4-line"></i>
                                        <span class="position-relative">
                                        Thông báo
                                            <span
                                                id="notis-badge"
                                                class="position-absolute top-0 start-100 translate-middle
                                                    bg-danger border border-light rounded-circle"
                                                style="padding: 6px; margin-left: 12px; display: {{$counts ? 'inline' : 'none'}}">
                                            </span>
                                    </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @if($noti->isEmpty())
                                            <li id="noti-null">
                                                <a href="javascript:void(0)" class="dropdown-item">
                                                    Bạn không có thông báo mới nào
                                                </a>
                                            </li>
                                        @else
                                            @foreach($noti as $item)
                                                <li>
                                                    <a class="dropdown-item"
                                                       href="{{route('notification')}}">
                                                        @if($item->is_read === 'Chưa đọc')
                                                            <span class="badge text-bg-danger">Mới</span>
                                                        @endif
                                                        {{$item->message}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                        <div id="noti-header-view">

                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        <ul class="navbar-nav">
                            @if(auth()->check())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span class="position-relative">
                                            {{auth()->user()->username}}
                                             <span
                                                 class="position-absolute top-10 start-100 translate-middle
                                                    bg-danger border border-light rounded-circle"
                                                 style="padding: 6px; margin-left: 12px; display: none">
                                            </span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{route('profile')}}">Hồ sơ</a>
                                        </li>
                                        @if(auth()->user()->role_id === 4)
                                            <li>
                                                <a class="dropdown-item" href="{{route('dashboard')}}">Trang quản
                                                    trị</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a class="dropdown-item" href="{{route('checkout')}}">Thanh toán đơn
                                                hàng</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('get-all-order')}}">Đơn hàng của
                                                bạn</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('client.logout') }}" method="POST"
                                                  style="display: none;" id="logout-form">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                               id="btnLogout">Đăng xuất</a>
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
                                        bg-danger border border-light rounded-circle"
                                        style="padding: 6px; display:none;">
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
@include('layout.client.mobile-menu')
@include('toast.auth-toast')
