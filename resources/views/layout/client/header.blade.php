<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ecommerce, market, shop, mart, cart, deal, multipurpose, marketplace">
    <meta name="description" content="Carrot - Multipurpose eCommerce HTML Template.">
    <meta name="author" content="ashishmaraviya">

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

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/client/css/style.css')}}">
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
                    <form class="cr-search">
                        <input class="search-input" type="text" placeholder="Search For items...">
                        {{--<select class="form-select" aria-label="Default select example">
                            <option selected>All Categories</option>
                            <option value="1">Mens</option>
                            <option value="2">Womens</option>
                            <option value="3">Electronics</option>
                        </select>--}}
                        <a href="javascript:void(0)" class="search-btn">
                            <i class="ri-search-line"></i>
                        </a>
                    </form>
                    <div class="cr-right-bar">
                        <ul class="navbar-nav">
                            @if(auth()->check())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span>Xin chào, {{auth()->user()->username}}</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('checkout')}}">Checkout</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('client.logout') }}" method="POST" style="display: none;" id="logout-form">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item" href="#"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span>Account</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{route('client.viewRegister')}}">Register</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('checkout')}}">Checkout</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('client.viewLogin')}}">Login</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                        {{--<a href="wishlist.html" class="cr-right-bar-item">
                            <i class="ri-heart-3-line"></i>
                            <span>Wishlist</span>
                        </a>--}}
                        <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle">
                            <i class="ri-shopping-cart-line"></i>
                            <span>Cart</span>
                        </a>
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