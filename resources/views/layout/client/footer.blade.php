@if(auth()->check())
    @if(auth()->user()->role->role_name === 'admin')
    @else
        <a href="javascript:void(0)" type="button"
           class="cr-button shadow rounded-circle position-fixed"
           style="bottom: 93px; right: 12px; width: 50px;height: 50px;border-radius: 50%; z-index: 1050"
           data-sender="{{auth()->user()->user_id}}"
           id="replys"
           data-bs-toggle="modal"
           data-bs-target="#chatModal">
            <i class="ri-question-answer-line fs-5"></i>
        </a>
    @endif
@endif
<!-- Footer -->
<footer class="footer padding-t-100 bg-off-white">
    <div class="container">
        <div class="row footer-top padding-b-100">
            <div class="col-xl-4 col-lg-6 col-sm-12 col-12 cr-footer-border">
                <div class="cr-footer-logo">
                    <div class="image">
                        <img src="{{asset('full-logo.png')}}" alt="logo" class="logo">
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
                            13, phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội .
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
                        <li><a href="{{route('return')}}">Chính sách đổi trả</a></li>
                        <li><a href="{{route('policy')}}">Chính sách bảo mật</a></li>
                        <li><a href="{{route('contact')}}">Liên hệ với chúng tôi</a></li>
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
                        Địa chỉ cửa hàng
                        <span class="cr-heading-res"></span>
                    </h4>
                    <div class="cr-social-media" style="height: 250px">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863806019117!2d105.74468687596995!3d21.038134787455142!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0xcf10b34e9f1a03df!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEZQVCBQb2x5dGVjaG5pYw!5e0!3m2!1svi!2s!4v1732632876092!5m2!1svi!2s"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="cr-last-footer">
            <p>&copy; <span id="copyright_year"></span> <a href="{{route('home')}}">Bee's Attire</a>, Mọi quyền được bảo
                lưu.</p>
        </div>
    </div>
</footer>
<!-- Tab to top -->
<a href="#Top" class="back-to-top result-placeholder">
    <i class="ri-arrow-up-line"></i>
    <div class="back-to-top-wrap">
        <svg viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
</a>
<!-- Model -->
@include('client.product.quickview-modal')
@include('modal.modal-view')
<!-- Cart -->
@include('client.carts.cart-slider')
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
