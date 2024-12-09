@extends('layout.client.home')
@section('content_client')
    <section class="section-hero padding-b-100 next">
        @include('client.banner')
    </section>
    <section class="section-popular margin-b-100">
        @include('client.product.popular-product')
    </section>
    <!-- Popular product -->
    <section class="section-popular-product-shape padding-b-100">
        <div class="container" data-aos="fade-up" data-aos-duration="2000">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-30">
                        <div class="cr-banner">
                            <h2><a href="{{route('product')}}">Tất cả sản phẩm</a></h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Đầy đủ mẫu mã, thời trang, phong cách</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-content row mb-minus-24" id="MixItUpDA2FB7">
                <div class="col-xl-3 col-lg-4 col-12 mb-24">
                    <div class="row mb-minus-24 sticky">
                        <div class="col-lg-12 col-sm-6 col-6 cr-product-box mb-24">
                            <div class="cr-product-tabs">
                                <ul>
                                    <li class="active" data-filter="all">All</li>
                                    @foreach($listAllCategory as $itemCategory)
                                        <li data-filter=".category-{{$itemCategory->category_id}}">{{$itemCategory->category_name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-6 cr-product-box banner-480 mb-24">
                            <div class="cr-ice-cubes">
                                <img src="{{asset('assets/client/img/product/bannerLefft.png')}}"
                                     alt="product banner">
                                <div class="cr-ice-cubes-contain">
                                    <h4 class="title">Thời trang</h4>
                                    <h5 class="sub-title">Giới trẻ</h5>
                                    <span>100% Chính hãng</span>
                                    <a href="{{route('product')}}" class="cr-button">Mua sắm ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-12 mb-24">
                    <div class="row mb-minus-24">
                        @foreach($listAllProduct as $item)
                            @if(auth()->check())
                                @php
                                    $isFavorite = \App\Models\Whishlist::where('user_id', auth()->user()->user_id)
                                                                     ->where('product_id', $item->product_id)
                                                                    ->exists();
                                @endphp
                            @else
                            @endif
                            <div
                                class="mix category-{{$item->category->category_id}} col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                                <div class="cr-product-card">
                                    <div class="cr-product-image">
                                        <div class="cr-image-inner zoom-image-hover">
                                            <img src="{{asset('upload/'. $item->product_avatar)}}" alt="product-1">
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
                                            <a href="javascript:void(0)">{{$item->category->category_name}}</a>
                                        </div>
                                        <a href="{{route('detail', ['slug' => $item->slug])}}"
                                           style="display: -webkit-box;
                                            -webkit-line-clamp: 2; -webkit-box-orient: vertical;
                                            overflow: hidden; text-overflow: ellipsis; white-space: normal"
                                           class="title">{{$item->product_name}}</a>
                                        <p class="cr-price">
                                            <span class="new-price">{{number_format($item->sale_price)}} đ</span>
                                            @if($item->product_price)
                                                <span class="old-price">{{number_format($item->product_price)}} đ</span>
                                            @else
                                                <span class="old-price"></span>
                                            @endif
                                        </p>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-services padding-b-100">
        @include('layout.client.service')
    </section>
    <section class="section-testimonial padding-b-100">
        @include('layout.client.testimonial')
    </section>
    <!-- Blog -->
    <section class="section-blog padding-b-100">
        @include('layout.client.post-new')
    </section>
@endsection

