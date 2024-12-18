<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="admin, dashboard, ecommerce, panel"/>
    <meta name="description" content="Carrot - Admin.">
    <meta name="author" content="ashishmaraviya">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title-admin', 'Admin')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/admin/img/logo/collapse-logo.png')}}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap"
          rel="stylesheet">
    <!-- Icon CSS -->
    <link href="{{asset('assets/admin/css/vendor/materialdesignicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/owl.carousel.min.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">--}}
<!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('assets/client/css/vendor/sweetalert2.min.css')}}">
    <link href="{{asset('assets/admin/css/vendor/datatables.bootstrap5.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/responsive.datatables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/simplebar.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/apexcharts.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet">

    <!-- Main CSS -->
    <link id="main-css" href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
    {{--Tailwind css--}}{{--
    @vite('public/assets/app.css')
--}}
    @vite('resources/js/size.js')
    @vite('resources/js/color.js')
    @vite('resources/js/category.js')
    @vite('resources/js/status.js')
    @vite('resources/js/voucher.js')
    @vite('resources/js/user.js')
    @vite('resources/js/category-parent.js')
    @vite('resources/js/admin-notify.js')
    @vite('resources/js/pusher-amin.js')
    @vite('resources/js/reply.js')
    @vite('resources/js/voucher-user.js')
    @vite('resources/js/post.js')
    @vite('resources/js/product.js')
    @vite('resources/js/pro.js')
    @vite('resources/js/rep-contact.js')
    @vite('resources/js/update-variant.js')
</head>

<body>
<main class="wrapper sb-default ecom">
    <!-- Loader -->
    <div id="cr-overlay">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <header class="cr-header">
        <div class="container-fluid">
            <div class="cr-header-items">
                <div class="left-header">
                    <a href="javascript:void(0)" class="cr-toggle-sidebar">
							<span class="outer-ring">
								<span class="inner-ring"></span>
							</span>
                    </a>
                </div>
                <div class="right-header">
                    <div class="cr-right-tool display-screen">
                        <a class="cr-screen full" href="javascript:void(0)"><i
                                class="ri-fullscreen-line"></i></a>
                        <a class="cr-screen reset" href="javascript:void(0)"><i
                                class="ri-fullscreen-exit-line"></i></a>
                    </div>
                    <div class="cr-right-tool">
                        <a class="cr-notify" href="javascript:void(0)">
                            <i class="ri-notification-2-line"></i>
                            <span class="label"></span>
                        </a>
                    </div>
                    <div class="cr-right-tool display-dark">
                        <a class="cr-mode dark" href="javascript:void(0)"><i class="ri-moon-clear-line"></i></a>
                        <a class="cr-mode light" href="javascript:void(0)"><i class="ri-sun-line"></i></a>
                    </div>
                    <div class="cr-right-tool cr-user-drop">
                        <div class="cr-hover-drop">
                            <div class="cr-hover-tool">
                                <img class="user" src="{{asset('upload/' . auth()->user()->avatar)}}" alt="user">
                            </div>
                            <div class="cr-hover-drop-panel right">
                                <div class="details">
                                    @if(auth()->check())
                                        <h6>{{auth()->user()->username}}</h6>
                                        <p>{{auth()->user()->email}}</p>
                                    @endif

                                </div>
                                {{--<ul class="border-top">
                                    <li><a href="team-profile.html">Profile</a></li>
                                    <li><a href="project-overview.html">Projects</a></li>
                                </ul>--}}
                                <ul class="border-top">
                                    <li>
                                        <a href="{{route('home')}}">
                                            <i class="ri-logout-circle-r-line"></i>Quay lại
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- sidebar -->
    <div class="cr-sidebar-overlay"></div>
    <div class="cr-sidebar" data-mode="light">
        <div class="cr-sb-logo">
            <a href="{{route('dashboard')}}" class="sb-full"><img src="{{asset('full-logo.png')}}" alt="logo"></a>
            <a href="{{route('dashboard')}}" class="sb-collapse"><img src="{{asset('favicon.ico')}}"
                                                                      alt="logo"></a>
        </div>
        <div class="cr-sb-wrapper">
            @include('layout.admin.slide-bar')
        </div>
    </div>

    <!-- Notify sidebar -->
    <div class="cr-notify-bar-overlay"></div>
    <div class="cr-notify-bar">
        @include('layout.admin.notify-slider')
    </div>

    <!-- Main content -->
    <div class="cr-main-content">
        <div class="container-fluid">
            <!-- trung tam -->
            @yield('content_admin')
        </div>
    </div>
</main>

@include('modal.reply')
@include('modal.update-variant')
@include('modal.loading')
<!-- Vendor Custom -->
<script src="{{asset('assets/admin/js/vendor/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/simplebar.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/sweetalert2.all.min.js')}}"></script>

<!-- Data Tables -->
<script src="{{asset('assets/admin/js/vendor/jquery.datatables.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/datatables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/datatables.responsive.min.js')}}"></script>
<!-- Caleddar -->
<script src="{{asset('assets/admin/js/vendor/jquery.simple-calendar.js')}}"></script>
<!-- Date Range Picker -->
<script src="{{asset('assets/admin/js/vendor/moment.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/daterangepicker.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/date-range.js')}}"></script>

<!-- Main Custom -->
<script src="{{asset('assets/admin/js/main.js')}}"></script>
<script src="{{asset('assets/admin/app.js')}}"></script>
<script src="{{asset('assets/admin/js/data/ecommerce-chart-data.js')}}"></script>
@yield('script')
</body>
</html>
