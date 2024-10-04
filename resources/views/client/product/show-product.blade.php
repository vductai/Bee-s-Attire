@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Shop</h2>
                            <span> <a href="index.html">Home</a> - Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shop -->
    <section class="section-shop padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Categories</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-12 md-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-shop-sideview">
                        <div class="cr-shop-categories">
                            <h4 class="cr-shop-sub-title">Category</h4>
                            <div class="cr-checkbox">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="drinks">
                                    <label for="drinks">Juice & Drinks</label>
                                    <span>[20]</span>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="drinks1">
                                    <label for="drinks1">Dairy & Milk</label>
                                    <span>[54]</span>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="drinks2">
                                    <label for="drinks2">Snack & Spice</label>
                                    <span>[64]</span>
                                </div>
                            </div>
                        </div>
                        <div class="cr-shop-price">
                            <h4 class="cr-shop-sub-title">Price</h4>
                            <div class="price-range-slider">
                                <div id="slider-range" class="range-bar"></div>
                                <p class="range-value">
                                    <label>Price :</label>
                                    <input type="text" id="amount" placeholder="'" readonly>
                                </p>
                                <button type="button" class="cr-button">Filter</button>
                            </div>
                        </div>
                        <div class="cr-shop-color">
                            <h4 class="cr-shop-sub-title">Colors</h4>
                            <div class="cr-checkbox">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="blue">
                                    <label for="blue">Blue</label>
                                    <span class="blue"></span>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="yellow">
                                    <label for="yellow">Yellow</label>
                                    <span class="yellow"></span>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="red">
                                    <label for="red">Red</label>
                                    <span class="red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="cr-shop-weight">
                            <h4 class="cr-shop-sub-title">Weight</h4>
                            <div class="cr-checkbox">
                                <div class="checkbox-group">
                                    <input type="checkbox" id="2kg">
                                    <label for="2kg">2kg Pack</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="20kg">
                                    <label for="20kg">20kg Pack</label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="30kg">
                                    <label for="30kg">30kg pack</label>
                                </div>
                            </div>
                        </div>
                        <div class="cr-shop-tags">
                            <h4 class="cr-shop-sub-title">Tages</h4>
                            <div class="cr-shop-tags-inner">
                                <ul class="cr-tags">
                                    <li><a href="javascript:void(0)">Vegetables</a></li>
                                    <li><a href="javascript:void(0)">juice</a></li>
                                    <li><a href="javascript:void(0)">Food</a></li>
                                    <li><a href="javascript:void(0)">Dry Fruits</a></li>
                                    <li><a href="javascript:void(0)">Vegetables</a></li>
                                    <li><a href="javascript:void(0)">juice</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-12 md-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                    <div class="row">
                        <div class="col-12">
                            <div class="cr-shop-bredekamp">
                                <div class="cr-toggle">
                                    <a href="javascript:void(0)" class="gridCol active-grid">
                                        <i class="ri-grid-line"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="gridRow">
                                        <i class="ri-list-check-2"></i>
                                    </a>
                                </div>
                                <div class="center-content">
                                    <span>We found 29 items for you!</span>
                                </div>
                                <div class="cr-select">
                                    <label>Sort By :</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Featured</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                        <option value="4">Four</option>
                                        <option value="5">Five</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-100 mb-minus-24">
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/1.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Vegetables</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                            <p>(4.5)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Fresh organic villa farm lomon
                                        500gm pack</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$120.25</span> <span
                                            class="old-price">$123.25</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/9.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut pack
                                        200gm</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$145</span> <span
                                            class="old-price">$150</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/2.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Fruits</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                            <p>(4.5)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Fresh organic apple 1kg simla
                                        marming</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$120.25</span> <span
                                            class="old-price">$123.25</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/3.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Fruits</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                            <p>(3.2)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Organic fresh venila farm
                                        watermelon 5kg</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$50.30</span> <span
                                            class="old-price">$72.60</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/10.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Sweet crunchy nut mix 250gm
                                        pack</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$120.25</span> <span
                                            class="old-price">$123.25</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/17.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Bakery</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Delicious white baked fresh bread
                                        and toast</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$20</span> <span
                                            class="old-price">$22.10</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/13.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Bakery</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Delicious white baked fresh bread
                                        and toast</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$20</span> <span
                                            class="old-price">$22.10</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/11.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Bakery</a>
                                       {{-- <div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Delicious white baked fresh bread
                                        and toast</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$20</span> <span
                                            class="old-price">$22.10</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/12.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Bakery</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Delicious white baked fresh bread
                                        and toast</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$20</span> <span
                                            class="old-price">$22.10</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/1.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Vegetables</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                            <p>(4.5)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Fresh organic villa farm lomon
                                        500gm pack</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$120.25</span> <span
                                            class="old-price">$123.25</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/9.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Snacks</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <p>(5.0)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Best snakes with hazel nut pack
                                        200gm</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$145</span> <span
                                            class="old-price">$150</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('assets/client/img/product/2.jpg')}}" alt="product-1">
                                    </div>
                                    <div class="cr-side-view">
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i class="ri-heart-line"></i>
                                        </a>
                                        <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                           role="button">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                    <a class="cr-shopping-bag" href="javascript:void(0)">
                                        <i class="ri-shopping-bag-line"></i>
                                    </a>
                                </div>
                                <div class="cr-product-details">
                                    <div class="cr-brand">
                                        <a href="shop-left-sidebar.html">Fruits</a>
                                        {{--<div class="cr-star">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-line"></i>
                                            <p>(4.5)</p>
                                        </div>--}}
                                    </div>
                                    <a href="product-left-sidebar.html" class="title">Fresh organic apple 1kg simla
                                        marming</a>
                                    <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                        eiusmod tempor incididunt
                                        ut labore lacus vel facilisis.</p>
                                    <ul class="list">
                                        <li><label>Brand :</label>ESTA BETTERU CO</li>
                                        <li><label>Diet Type :</label>Vegetarian</li>
                                        <li><label>Speciality :</label>Gluten Free, Sugar Free</li>
                                    </ul>
                                    <p class="cr-price"><span class="new-price">$120.25</span> <span
                                            class="old-price">$123.25</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="..." class="cr-pagination">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">1</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
