<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v2/admin-html/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Jun 2024 17:48:11 GMT -->
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
    <link href='{{asset('assets/admin/css/vendor/datatables.bootstrap5.min.css')}}' rel='stylesheet'>
    <link href='{{asset('assets/admin/css/vendor/responsive.datatables.min.css')}}' rel='stylesheet'>
    <link href='{{asset('assets/admin/css/vendor/daterangepicker.css')}}' rel='stylesheet'>
    <link href="{{asset('assets/admin/css/vendor/simplebar.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/apexcharts.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet">

    <!-- Main CSS -->
    <link id="main-css" href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">

</head>

<body>
<main class="wrapper sb-default">
    <section class="auth-section anim">
        <div class="cr-login-page">
            <div class="container-fluid no-gutters">
                <div class="row">
                    <div class="offset-lg-6 col-lg-6">
                        <div class="content-detail">
                            <div class="main-info">
                                <div class="hero-container">
                                    <!-- Login form -->
                                    <form class="login-form" method="post">
                                        <div class="imgcontainer">
                                            <a href="index.html"><img src="assets/img/logo/full-logo.png" alt="logo"
                                                                      class="logo"></a>
                                        </div>
                                        <div class="input-control">
                                            <input type="text" placeholder="Enter Username" name="uname"
                                                   required>
                                            <span class="password-field-show">
													<input type="password" placeholder="Enter Password"
                                                           name="password" class="password-field" value="" required>
													<span data-toggle=".password-field"
                                                          class="fa fa-fw fa-eye field-icon toggle-password"></span>
												</span>
                                            <label class="label-container">Remember me
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="psw"><a href="forgot.html" class="forgot-btn">Forgot
														password?</a></span>
                                            <div class="login-btns">
                                                <button type="submit">Login</button>
                                            </div>
                                            <div class="division-lines">
                                                <p>or login with</p>
                                            </div>
                                            <div class="login-with-btns">
                                                <button type="button" class="google">
                                                    <i class="ri-google-fill"></i>
                                                </button>
                                                <button type="button" class="facebook">
                                                    <i class="ri-facebook-fill"></i>
                                                </button>
                                                <button type="button" class="twitter">
                                                    <i class="ri-twitter-fill"></i>
                                                </button>
                                                <button type="button" class="linkedin">
                                                    <i class="ri-linkedin-fill"></i>
                                                </button>
                                                <span class="already-acc">Not a member? <a href="signup.html"
                                                                                           class="signup-btn">Sign up</a></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Vendor Custom -->
<script src="{{asset('assets/admin/js/vendor/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/simplebar.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('assets/admin/js/vendor/owl.carousel.min.js')}}"></script>
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
<script src="{{asset('assets/admin/js/data/ecommerce-chart-data.js')}}"></script>
</body>


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v2/admin-html/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Jun 2024 17:48:11 GMT -->
</html>
