@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Compare</h2>
                            <span> <a href="index.html">Home</a> - Compare</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Compare -->
    <section class="section-compare padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Compare</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-minus-24" data-aos="fade-up" data-aos-duration="2000"
                 data-aos-delay="400">
                <div class="col-lg-3 col-6 cr-product-box mb-24">
                    <div class="cr-product-card">
                        <div class="cr-product-image">
                            <div class="cr-image-inner zoom-image-hover">
                                <img src="{{asset('assets/client/img/product/1.jpg')}}" alt="product-1">
                            </div>
                            <div class="cr-side-view">
                                <a class="cr-remove-product" href="javascript:void(0)">
                                    <i class="ri-close-line"></i>
                                </a>
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
                                <a href="shop-left-sidebar.html">xcvxdf</a>
                                {{--<div class="cr-star">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-line"></i>
                                    <p>(4.5)</p>
                                </div>--}}
                            </div>
                            <a href="" class="title">dfgdfgdf</a>
                            <p class="cr-price"><span class="new-price">4564564 đ</span> <span
                                    class="old-price">345345 đ</span></p>
                        </div>
                        <div class="cr-product-info">
                            <ul>
                                <li><strong>Category :</strong> Vegetable</li>
                                <li><strong>Weight :</strong> 1kg</li>
                                <li><strong>Brand :</strong> Bhisma organics</li>
                                <li><strong>Availability :</strong> In Stock</li>
                                <li><strong>Location :</strong> In Store , Online</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
