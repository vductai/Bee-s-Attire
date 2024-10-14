<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="admin, dashboard, ecommerce, panel"/>
    <meta name="description" content="Carrot - Admin.">
    <meta name="author" content="ashishmaraviya">

    <title>Carrot - Admin.</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/admin/img/favicon/favicon.ico')}}">

    <!-- Icon CSS -->
    <link href="{{asset('assets/admin/css/vendor/materialdesignicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/owl.carousel.min.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">--}}
    <!-- Vendor CSS -->
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
                    <div class="header-search-box">
                        <div class="header-search-drop">
                            <a href="javascript:void(0)" class="open-search"><i class="ri-search-line"></i></a>
                            <form class="cr-search">
                                <input class="search-input" type="text" placeholder="Search...">
                                <a href="javascript:void(0)" class="search-btn"><i class="ri-search-line"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="right-header">
                    {{--                    <div class="cr-right-tool cr-flag-drop language">
                                            <div class="cr-hover-drop">
                                                <div class="cr-hover-tool">
                                                    <img class="flag" src="{{asset('assets/admin/img/flag/us.png')}}" alt="flag">
                                                </div>
                                                <div class="cr-hover-drop-panel right">
                                                    <ul>
                                                        <li><a href="javascript:void(0)"><img class="flag"
                                                                                              src="{{asset('assets/admin/img/flag/us.png')}}"
                                                                                              alt="flag">English</a></li>
                                                        <li><a href="javascript:void(0)"><img class="flag"
                                                                                              src="{{asset('assets/admin/img/flag/in.png')}}"
                                                                                              alt="flag">Hindi</a></li>
                                                        <li><a href="javascript:void(0)"><img class="flag"
                                                                                              src="{{asset('assets/admin/img/flag/de.png')}}"
                                                                                              alt="flag"> Deutsch</a></li>
                                                        <li><a href="javascript:void(0)"><img class="flag"
                                                                                              src="{{asset('assets/admin/img/flag/it.png')}}"
                                                                                              alt="flag">Italian</a></li>
                                                        <li><a href="javascript:void(0)"><img class="flag"
                                                                                              src="{{asset('assets/admin/img/flag/jp.png')}}"
                                                                                              alt="flag">Japanese</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cr-right-tool apps">
                                            <div class="cr-hover-drop">
                                                <div class="cr-hover-tool">
                                                    <i class="ri-apps-2-line"></i>
                                                </div>
                                                <div class="cr-hover-drop-panel right">
                                                    <h6 class="title">Apps</h6>
                                                    <ul>
                                                        <li><a href="javascript:void(0)"><img class="app"
                                                                                              src="{{asset('assets/admin/img/apps/1.png')}}"
                                                                                              alt="flag">English</a></li>
                                                        <li><a href="javascript:void(0)"><img class="app"
                                                                                              src="{{asset('assets/admin/img/apps/2.png')}}"
                                                                                              alt="flag">Hindi</a></li>
                                                        <li><a href="javascript:void(0)"><img class="app"
                                                                                              src="{{asset('assets/admin/img/apps/3.png')}}"
                                                                                              alt="flag"> Deutsch</a></li>
                                                        <li><a href="javascript:void(0)"><img class="app"
                                                                                              src="{{asset('assets/admin/img/apps/4.png')}}"
                                                                                              alt="flag">Italian</a></li>
                                                        <li><a href="javascript:void(0)"><img class="app"
                                                                                              src="{{asset('assets/admin/img/apps/5.png')}}"
                                                                                              alt="flag">Japanese</a></li>
                                                        <li><a href="javascript:void(0)"><img class="app"
                                                                                              src="{{asset('assets/admin/img/apps/6.png')}}"
                                                                                              alt="flag">Japanese</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>--}}
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
                                <img class="user" src="{{asset('assets/admin/img/user/1.jpg')}}" alt="user">
                            </div>
                            <div class="cr-hover-drop-panel right">
                                <div class="details">
                                    @if(auth()->check())
                                        <h6>{{auth()->user()->username}}</h6>
                                        <p>{{auth()->user()->email}}</p>
                                    @endif

                                </div>
                                <ul class="border-top">
                                    <li><a href="team-profile.html">Profile</a></li>
                                    <li><a href="project-overview.html">Projects</a></li>
                                </ul>
                                <ul class="border-top">
                                    <form action="{{ route('admin.logout') }}" method="POST" style="display: none;" id="logout-form">
                                        @csrf
                                    </form>
                                    <li>
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="ri-logout-circle-r-line"></i>Logout
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
            <a href="index.html" class="sb-full"><img src="{{asset('assets/admin/img/logo/full-logo.png')}}" alt="logo"></a>
            <a href="index.html" class="sb-collapse"><img src="{{asset('assets/admin/img/logo/collapse-logo.png')}}"
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

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <div class="copyright">
                <p><span id="copyright_year"></span> © Carrot, All rights Reserved.</p>
                <p>Design by MaraviyaInfotech.</p>
            </div>
        </div>
    </footer>

    <!-- Feature tools -->
    <div class="cr-tools-sidebar-overlay"></div>
    <div class="cr-tools-sidebar">
        @include('layout.admin.tool')
    </div>
</main>

<!-- Vendor Custom -->
<script src="{{asset('assets/admin/js/vendor/jquery-3.6.4.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/simplebar.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/bootstrap.bundle.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/apexcharts.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/jquery-jvectormap-1.2.2.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/jquery-jvectormap-world-mill-en.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/owl.carousel.min.js')}}" async></script>
<!-- Data Tables -->
<script src="{{asset('assets/admin/js/vendor/jquery.datatables.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/datatables.bootstrap5.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/datatables.responsive.min.js')}}" async></script>
<!-- Caleddar -->
<script src="{{asset('assets/admin/js/vendor/jquery.simple-calendar.js')}}" async></script>
<!-- Date Range Picker -->
<script src="{{asset('assets/admin/js/vendor/moment.min.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/daterangepicker.js')}}" async></script>
<script src="{{asset('assets/admin/js/vendor/date-range.js')}}" async></script>

<!-- Main Custom -->
<script src="{{asset('assets/admin/js/main.js')}}" async></script>
<script src="{{asset('assets/admin/js/data/ecommerce-chart-data.js')}}" async></script>
@yield('script')
</body>
</html>
