@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Đặt lại mật khẩu</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Đặt lại mật khẩu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Forgot page -->
    <section class="section-login padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Forgot Password</h2>
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
                        <form class="cr-content-form" id="form-password-email">
                            <div class="form-group">
                                <label>Email*</label>
                                <input type="email" id="emailPassword" name="email" placeholder="Nhập email" class="cr-form-control">
                                <p class="text-danger es" id="email-error"></p>
                            </div>
                            <div class="login-buttons">
                                <button type="submit" id="subEmail" class="cr-button">Xác nhận</button>
                                <a href="{{route('client.viewRegister')}}" class="link">
                                    Đăng kí?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
