@extends('layout.client.home')
@section('title', 'Liên hệ với chúng tôi')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Liên hệ với chúng tôi</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Liên hệ với chúng tôi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="section-Contact padding-tb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Liên hệ</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>
                                Chúng tôi luôn sẳn sàng hỗ trợ bạn mọi lúc khi có vấn đề gì cần thắc mắc
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-minus-24">
                <div class="col-lg-4 col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000"
                     data-aos-delay="400">
                    <div class="cr-info-box">
                        <div class="cr-icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div class="cr-info-content">
                            <h4 class="heading">Số điện thoại</h4>
                            <p><a href="javascript:void(0)"><i class="ri-phone-line"></i> &nbsp; (+84)-943244933</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000"
                     data-aos-delay="600">
                    <div class="cr-info-box">
                        <div class="cr-icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div class="cr-info-content">
                            <h4 class="heading">Email</h4>
                            <p><a href="javascript:void(0)"><i class="ri-mail-line"></i> &nbsp;
                                    taivdph43863@fpt.edu.vn</a></p>
                            <p>
                                <a href="javascript:void(0)"></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                    <div class="cr-info-box">
                        <div class="cr-icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <div class="cr-info-content">
                            <h4 class="heading">Địa chỉ</h4>
                            <p>
                                <a href="javascript:void(0)">
                                    <i class="ri-map-pin-line"></i>
                                    13, Trịnh Văn Bô, Phương Canh, Nam Từ Liêm, Hà Nội .
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row padding-t-100 mb-minus-24">
                <div class="col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863806019117!2d105.74468687596995!3d21.038134787455142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1732632876092!5m2!1svi!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="col-md-6 col-12 mb-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                    <form class="cr-content-form" id="form-contact">
                        <div class="form-group">
                            <input type="text" id="name" placeholder="Họ và tên" class="cr-form-control">
                            <p class="text-danger contact-err" id="name-error"></p>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" placeholder="Email" class="cr-form-control">
                            <p class="text-danger contact-err" id="email-error"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone" placeholder="Số điện thoại" class="cr-form-control">
                            <p class="text-danger contact-err" id="phone-error"></p>
                        </div>
                        <div class="form-group">
                            <textarea class="cr-form-control" id="content" rows="4"
                                      placeholder="Nội dung"></textarea>
                            <p class="text-danger contact-err" id="content-error"></p>
                        </div>
                        <button type="submit" class="cr-button">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
