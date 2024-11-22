@extends('layout.client.home')
@section('title', 'Yêu thích')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Yêu thích</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> - Yêu thích</span>
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
                @foreach($list as $item)
                    <div class="col-lg-3 col-6 cr-product-box mb-24">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{{asset('upload/' . $item->product->product_avatar)}}" alt="product-1">
                                </div>
                                <div class="cr-side-view">
                                    <a class="cr-remove-product"
                                       data-wishlistId="{{$item->wishlist_id}}"
                                       href="javascript:void(0)">
                                        <i class="ri-close-line"></i>
                                    </a>
                                    <input type="hidden"
                                           id="userBagDel"
                                           value="{{auth()->user()->user_id}}">
                                </div>
                            </div>
                            <div class="cr-product-details">
                                <div class="cr-brand">
                                    <a href="">
                                        {{$item->product->category->category_name}}
                                    </a>
                                </div>
                                <a href="{{route('detail', ['slug' => $item->product->slug])}}" class="title">
                                    {{$item->product->product_name}}
                                </a>
                                <p class="cr-price">
                                    <span class="new-price">{{number_format($item->product->sale_price)}} đ</span>
                                    <span class="old-price">{{number_format($item->product->product_price)}} đ</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
