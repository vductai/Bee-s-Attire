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
    <!-- Register -->
    <section class="section-register padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Đặt lại mật khẩu</h2>
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
                            <img src="{{asset('full-logo.png')}}" alt="logo">
                        </div>
                        <form class="cr-content-form" id="formResetPass" action="{{route('password.update')}}" method="post">
                            @csrf
                            <input type="hidden" id="token" name="token" value="{{ $token }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" id="email" name="email"
                                               placeholder="Nhập email" class="cr-form-control">
                                    </div>
                                    <p class="text-danger ess" id="email-error"></p>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mật khẩu*</label>
                                        <input type="password" id="password" name="password"
                                               placeholder="Nhập mật khẩu" class="cr-form-control">
                                    </div>
                                    <p class="text-danger ess" id="password-error"></p>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Xác nhận mật khẩu*</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               placeholder="Xác nhận mật khẩu" class="cr-form-control">
                                    </div>
                                    <p class="text-danger ess" id="password_confirmation-error"></p>
                                    <p class="text-danger ess" id="er"></p>

                                </div>
                                <div class="cr-register-buttons">
                                    <button type="submit" class="cr-button">Đặt lại mật khẩu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
