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
            <div class="row mixshow" id="MixItUpDA2FB7">
                <div class="col-lg-3 col-12 md-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                    <div class="cr-shop-sideview">
                        <div class="cr-shop-categories">
                            <h4 class="cr-shop-sub-title">Category</h4>
                            <div class="cr-checkbox">

                                <div class="cr-product-tabs">
                                    <ul>
                                        <li data-filter="all">Tất cả sản phẩm</li>
                                        @foreach($listcategory as $item)
                                            <li data-filter=".category-{{$item->category_id}}">
                                                {{$item->category_name}} ( {{ $item->product_count }} )
                                            </li>
                                        @endforeach
                                    </ul>
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
                            <h4 class="cr-shop-sub-title">Color</h4>
                            <div class="cr-checkbox">
                                @foreach($listColor as $item)
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="{{$item->color_name}}">
                                        <label for="{{$item->color_name}}">{{$item->color_name}}</label>
                                        <span style="background-color: {{$item->color_code}}"></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="cr-shop-weight">
                            <h4 class="cr-shop-sub-title">Size</h4>
                            <div class="cr-checkbox">
                                @foreach($listSize as $item)
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="{{$item->size_name}}">
                                        <label for="{{$item->size_name}}">{{$item->size_name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
{{--                        <div class="cr-shop-tags">
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
                        </div>--}}
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
                        @foreach($listAllProductShop as $item)
                            <div
                                class="mix category-{{$item->category->category_id}} col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                                <div class="cr-product-card">
                                    <div class="cr-product-image">
                                        <div class="cr-image-inner zoom-image-hover">
                                            <img src="{{asset('upload/'. $item->product_avatar)}}" alt="product-1">
                                        </div>
                                        <div class="cr-side-view">
                                            {{--<a href="javascript:void(0)" class="wishlist">
                                                <i class="ri-heart-line"></i>
                                            </a>--}}
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
                                            <a href="shop-left-sidebar.html">{{$item->category->category_name}}</a>
                                            {{--<div class="cr-star">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-line"></i>
                                                <p>(4.5)</p>
                                            </div>--}}
                                        </div>
                                        <a href="{{route('detail', ['slug' => $item->slug])}}" class="title">
                                            {{$item->product_name}}
                                        </a>
                                        <ul class="list">

                                            <li><label>Size :</label>
                                                @foreach($item->variants->unique('size') as $size)
                                                    {{$size->size->size_name}},
                                                @endforeach
                                            </li>
                                            <li><label>Color :</label>
                                                @foreach($item->variants->unique('color') as $color)
                                                    {{$color->color->color_name}},
                                                @endforeach
                                            </li>
                                        </ul>
                                        <p class="cr-price">
                                            <span class="new-price">{{number_format($item->sale_price) }} đ</span>
                                            <span class="old-price">{{number_format($item->product_price)}} đ</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
