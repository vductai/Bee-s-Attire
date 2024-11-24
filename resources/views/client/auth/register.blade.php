@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Đăng kí</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Đăng kí</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Register -->
    <section class="section-register padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Register</h2>
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
                    <div class="cr-register" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="form-logo">
                            <img src="{{asset('assets/client/img/logo/logo.png')}}" alt="logo">
                        </div>
                        <form class="cr-content-form" id="registerForm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" name="email" placeholder="Nhập email"
                                               id="emailRegister"
                                               class="cr-form-control">
                                        <p class="text-danger es" id="email-error"></p>
                                        <p class="text-danger es" id="email-exit"></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mật khẩu*</label>
                                        <input type="password" name="password" placeholder="Nhâp mật khẩu"
                                               id="passwordRegister"
                                               class="cr-form-control">
                                        <p class="text-danger es" id="password-error"></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Xác nhận lại mật khẩu*</label>
                                        <input type="password" name="password_confirmation"
                                               id="password_confirmation"
                                               placeholder="Xác nhận mật khẩu" class="cr-form-control">
                                        <p class="text-danger es" id="password_confirmation-error"></p>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <a href="{{route('auth.google')}}" class="cr-button">
                                        <i class="ri-google-fill mx-2"></i>
                                        google
                                    </a>
                                </div>
                                <div class="cr-register-buttons">
                                    <button type="submit" id="sub-res" class="cr-button">Đăng kí</button>
                                    <a href="{{route('client-login')}}" class="link">
                                        Đã có tài khoản ?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
