@extends('layout.client.home')
@section('content_client')
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
                        <div class="cr-content-form text-center">
                            <h4>Đặt hàng thành công</h4>
                            <h6>Cảm ơn bạn đã đặt hàng. chúng tôi sẻ liên hệ với bạn sớm.</h6>
                            <a href="{{route('home')}}" class="btn btn-success">
                                Tiếp tục mua hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
