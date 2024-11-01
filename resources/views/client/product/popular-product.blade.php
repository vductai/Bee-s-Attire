<div class="container">
    <div class="row">
        <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-duration="2000">
            <div class="cr-twocolumns-product">
                <div class="slick-slide">
                    <div class="cr-product-card">
                        <div class="cr-product-image">
                            <div class="cr-image-inner zoom-image-hover">
                                <img src="{{asset('assets/client/img/product/9.jpg')}}" alt="product-1">
                            </div>
                            @if(auth()->check())
                                <a class="cr-shopping-bag {{$isFavorite ? 'active' : ''}}"
                                   data-productId="{{$item->product_id}}"
                                   href="javascript:void(0)">
                                    <i class="ri-heart-line"></i>
                                </a>
                                <input type="hidden"
                                       id="userBag"
                                       value="{{auth()->user()->user_id}}">
                            @else
                            @endif
                        </div>
                        <div class="cr-product-details">
                            <div class="cr-brand">
                                <a href="shop-left-sidebar.html">Snacks</a>
                            </div>
                            <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut
                                mix pack 200gm</a>
                            <p class="cr-price"><span class="new-price">$120.25</span> <span
                                    class="old-price">$123.25</span></p>
                        </div>
                    </div>
                </div>
                <div class="slick-slide">
                    <div class="cr-product-card">
                        <div class="cr-product-image">
                            <div class="cr-image-inner zoom-image-hover">
                                <img src="{{asset('assets/client/img/product/9.jpg')}}" alt="product-1">
                            </div>
                            @if(auth()->check())
                                <a class="cr-shopping-bag {{$isFavorite ? 'active' : ''}}"
                                   data-productId="{{$item->product_id}}"
                                   href="javascript:void(0)">
                                    <i class="ri-heart-line"></i>
                                </a>
                                <input type="hidden"
                                       id="userBag"
                                       value="{{auth()->user()->user_id}}">
                            @else
                            @endif
                        </div>
                        <div class="cr-product-details">
                            <div class="cr-brand">
                                <a href="shop-left-sidebar.html">Snacks</a>
                            </div>
                            <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut
                                mix pack 200gm</a>
                            <p class="cr-price"><span class="new-price">$120.25</span> <span
                                    class="old-price">$123.25</span></p>
                        </div>
                    </div>
                </div>
                <div class="slick-slide">
                    <div class="cr-product-card">
                        <div class="cr-product-image">
                            <div class="cr-image-inner zoom-image-hover">
                                <img src="{{asset('assets/client/img/product/9.jpg')}}" alt="product-1">
                            </div>
                            @if(auth()->check())
                                <a class="cr-shopping-bag {{$isFavorite ? 'active' : ''}}"
                                   data-productId="{{$item->product_id}}"
                                   href="javascript:void(0)">
                                    <i class="ri-heart-line"></i>
                                </a>
                                <input type="hidden"
                                       id="userBag"
                                       value="{{auth()->user()->user_id}}">
                            @else
                            @endif
                        </div>
                        <div class="cr-product-details">
                            <div class="cr-brand">
                                <a href="shop-left-sidebar.html">Snacks</a>
                            </div>
                            <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut
                                mix pack 200gm</a>
                            <p class="cr-price"><span class="new-price">$120.25</span> <span
                                    class="old-price">$123.25</span></p>
                        </div>
                    </div>
                </div>
                <div class="slick-slide">
                    <div class="cr-product-card">
                        <div class="cr-product-image">
                            <div class="cr-image-inner zoom-image-hover">
                                <img src="{{asset('assets/client/img/product/9.jpg')}}" alt="product-1">
                            </div>
                            @if(auth()->check())
                                <a class="cr-shopping-bag {{$isFavorite ? 'active' : ''}}"
                                   data-productId="{{$item->product_id}}"
                                   href="javascript:void(0)">
                                    <i class="ri-heart-line"></i>
                                </a>
                                <input type="hidden"
                                       id="userBag"
                                       value="{{auth()->user()->user_id}}">
                            @else
                            @endif
                        </div>
                        <div class="cr-product-details">
                            <div class="cr-brand">
                                <a href="shop-left-sidebar.html">Snacks</a>
                            </div>
                            <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut
                                mix pack 200gm</a>
                            <p class="cr-price"><span class="new-price">$120.25</span> <span
                                    class="old-price">$123.25</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-duration="2000">
            <div class="cr-products-rightbar">
                <img src="{{asset('assets/client/img/product/products-rightview.jpg')}}" alt="products-rightview">
                <div class="cr-products-rightbar-content">
                    <h4>Organic & Healthy <br> Vegetables</h4>
                    <div class="cr-off">
                        <span>25% <code>OFF</code></span>
                    </div>
                    <div class="rightbar-buttons">
                        <a href="shop-left-sidebar.html" class="cr-button">
                            shop now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
