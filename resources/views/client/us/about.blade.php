@extends('layout.client.home')
@section('title', 'Về chúng tôi')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Về chúng tôi</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Về chúng tôi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="section-about padding-tb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cr-about" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <h4 class="heading">Giới thiệu về Bee Attire</h4>
                        <div class="cr-about-content">
                            <p>Chào mừng bạn đến với Bee Attire, thương hiệu thời trang nam dành riêng cho những quý ông
                                hiện đại, lịch lãm và cá tính. Chúng tôi tự hào mang đến những thiết kế độc đáo, đậm
                                chất nam tính với các sản phẩm từ áo sơ mi, quần jeans, vest cho đến phụ kiện thời trang
                                cao cấp.</p>
                            <p>Với tiêu chí "Chất lượng hàng đầu - Phong cách vượt trội", Bee Attire không chỉ mang lại
                                sự thoải mái mà còn giúp bạn thể hiện phong cách riêng biệt trong mọi hoàn cảnh, từ công
                                sở chuyên nghiệp đến dạo phố năng động.</p>
                            <p>Đội ngũ của chúng tôi luôn nỗ lực cập nhật xu hướng thời trang mới nhất, kết hợp chất
                                liệu cao cấp để tạo ra những sản phẩm không chỉ bền đẹp mà còn phù hợp với gu thẩm mỹ
                                của phái mạnh.</p>
                            <div class="elementor-counter">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">{{number_format($user)}}</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Khách hàng</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-12 margin-575">
                                        <h4 class="elementor">
                                            <span class="elementor-counter-number">{{number_format($product)}}</span>
                                        </h4>
                                        <div class="elementor-counter-title">
                                            <span>Sản phẩm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cr-about-image" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="800">
                        <img src="{{asset('assets/client/img/about/about.png')}}" alt="side-view">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
