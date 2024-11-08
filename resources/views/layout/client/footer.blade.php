
<!-- Footer -->
<footer class="footer padding-t-100 bg-off-white">
    <div class="container">
        <div class="row footer-top padding-b-100">
            <div class="col-xl-4 col-lg-6 col-sm-12 col-12 cr-footer-border">
                <div class="cr-footer-logo">
                    <div class="image">
                        <img src="{{asset('assets/client/img/logo/logo.png')}}" alt="logo" class="logo">
                        <img src="{{asset('assets/client/img/logo/dark-logo.png')}}" alt="logo" class="dark-logo">
                    </div>
                    <p>
                        Bee's Attire là một trang bán hàng chuyên về thời trang nam đa dạng về mẫu mã,
                        phù hợp với nhiều lứa tuổi
                    </p>
                </div>
                <div class="cr-footer">
                    <h4 class="cr-sub-title cr-title-hidden">
                        Contact us
                        <span class="cr-heading-res"></span>
                    </h4>
                    <ul class="cr-footer-links cr-footer-dropdown">
                        <li class="location-icon">
                            Cổng số 1, Tòa nhà FPT Polytechnic, 13 phố Trịnh Văn Bô,
                            phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội .
                        </li>
                        <li class="mail-icon">
                            <a href="javascript:void(0)">taivdph43863@fpt.edu.vn</a>
                        </li>
                        <li class="phone-icon">
                            <a href="javascript:void(0)">024 8582 0808</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-sm-12 col-12 cr-footer-border">
                <div class="cr-footer">
                    <h4 class="cr-sub-title">
                        Hỗ trợ khách hàng
                        <span class="cr-heading-res"></span>
                    </h4>
                    <ul class="cr-footer-links cr-footer-dropdown">
                        <li><a href="{{route('about')}}">Về chúng tôi</a></li>
                        <li><a href="track-order.html">Thông tin giao hàng</a></li>
                        <li><a href="policy.html">Chính sách bảo mật</a></li>
                        <li><a href="terms.html">Điều khoản & Điều kiện</a></li>
                        <li><a href="{{route('contact')}}">Liên hệ với chúng tôi</a></li>
{{--                        <li><a href="faq.html">Support Center</a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-sm-12 col-12 cr-footer-border">
                <div class="cr-footer">
                    <h4 class="cr-sub-title">
                        Danh mục
                        <span class="cr-heading-res"></span>
                    </h4>
                    <ul class="cr-footer-links cr-footer-dropdown">
                        @foreach($Category as $item)
                            <li><a href="javascript:void(0)">{{$item->category_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-sm-12 col-12 cr-footer-border">
                <div class="cr-footer cr-newsletter">
                    <h4 class="cr-sub-title">
                        Đăng ký nhận bản tin của chúng tôi
                        <span class="cr-heading-res"></span>
                    </h4>
                    <div class="cr-footer-links cr-footer-dropdown">
                        <form class="cr-search-footer">
                            <input class="search-input" type="text" placeholder="Search here...">
                            <a href="javascript:void(0)" class="search-btn">
                                <i class="ri-send-plane-fill"></i>
                            </a>
                        </form>
                    </div>
                    <div class="cr-social-media">
                        <span><a href="javascript:void(0)"><i class="ri-facebook-line"></i></a></span>
                        <span><a href="javascript:void(0)"><i class="ri-dribbble-line"></i></a></span>
                        <span><a href="javascript:void(0)"><i class="ri-instagram-line"></i></a></span>
                    </div>
                    <div class="cr-payment">
                        <div class="cr-insta-slider swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/1.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/2.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/3.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/4.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/5.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/6.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/7.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#" class="cr-payment-image">
                                        <img src="{{asset('assets/client/img/insta/8.jpg')}}" alt="insta">
                                        <div class="payment-overlay"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cr-last-footer">
            <p>&copy; <span id="copyright_year"></span> <a href="{{route('home')}}">Bee's Attire</a>, Mọi quyền được bảo lưu.</p>
        </div>
    </div>
</footer>

<!-- Tab to top -->
<a href="#Top" class="back-to-top result-placeholder">
    <i class="ri-arrow-up-line"></i>
    <div class="back-to-top-wrap">
        <svg viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
</a>
<!-- Model -->
@include('client.product.quickview-modal')
<!-- Cart -->
@include('client.carts.cart-slider')
<!-- Side-tool -->
{{--@include('layout.client.tool')--}}
<!-- Vendor Custom -->
<script src="{{asset('assets/client/js/vendor/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/jquery.zoom.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/mixitup.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/range-slider.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/aos.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/client/js/vendor/slick.min.js')}}"></script>
<!-- Main Custom -->
<script src="{{asset('assets/client/js/main.js')}}"></script>
<script src="{{asset('assets/client/app.js')}}"></script>
</body>
</html>
