@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Đăng nhập</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Đăng nhập</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login -->
    <section class="section-login padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Login</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="cr-login" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="form-logo">
                            <img src="{{asset('full-logo.png')}}" alt="logo">
                        </div>
                        <form class="cr-content-form" id="loginFormClient">
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="email" name="email" id="emailClient" placeholder="Nhập email"
                                       class="cr-form-control">
                                <p class="text-danger es" id="email-error"></p>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu*</label>
                                <input type="password" name="password" id="passwordClient" placeholder="Nhập mật khẩu"
                                       class="cr-form-control">
                                <p class="text-danger es" id="password-error"></p>
                                <p class="text-danger es" id="e-error"></p>
                            </div>
                            <div class="remember">
                                <span class="form-group custom">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">Lưu thông tin</label>
                                </span>
                                <a class="link" href="{{route('password.request')}}">Quên mật khẩu ?</a>
                            </div>
                            <br>
                            <div class="login-buttons">
                                <button type="submit" class="cr-button" id="sub-login">
                                    Đăng nhập
                                </button>
                                <a href="{{route('client.viewRegister')}}" class="link">
                                    Đăng kí ?
                                </a>
                            </div>
                            <div class="form-group ">
                                <div class="d-flex justify-content-center align-items-center m-2">
                                    <div style="width: 40%;height: 1px;background-color: #dbdbdb"></div>
                                    <div style="margin: 0 6px; color: #c0bfbf">Hoặc</div>
                                    <div style="width: 40%;height: 1px;background-color: #dbdbdb"></div>
                                </div>
                                <div class="cr-btn-bw">
                                    <a href="{{route('auth.google')}}" class="custom-btn btn-1 d-flex
                                    justify-content-center align-items-center">
                                        {{--<i class="ri-google-fill mx-2"></i>--}}
                                        <div class="" style="width: 30px;height: 30px;margin-right: 10px">
                                            <img src="{{asset('google-logo.png')}}"
                                                 class="w-100 h-100"
                                                 style="filter: brightness(1.2); object-fit: cover">
                                        </div>
                                        <p>
                                            google
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        if (window.history.replaceState) {
            // Nếu người dùng đã đăng nhập, chuyển hướng họ khỏi trang login
            if ({{ Auth::check() ? 'true' : 'false' }}) {
                window.location.href = '/'; // Hoặc trang mà bạn muốn chuyển hướng
            }
        }
    </script>
@endsection
@include('toast.auth-toast')
