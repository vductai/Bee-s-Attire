@extends('layout.client.home')
@section('title', 'Tìm kiếm')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Tìm kiếm</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Tìm kiếm</span>
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
                @if($searchResults->isEmpty())
                    <h3 class="text-danger text-center">Không có sản phẩm</h3>
                @else
                    @foreach($searchResults as $item)
                        @if(auth()->check())
                            @php
                                $isFavorite = \App\Models\Whishlist::where('user_id', auth()->user()->user_id ?? 0)
                                                                ->where('product_id', $item->product_id)
                                                                ->exists();
                            @endphp
                        @else
                        @endif
                        <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                            <div class="cr-product-card">
                                <div class="cr-product-image">
                                    <div class="cr-image-inner zoom-image-hover">
                                        <img src="{{asset('upload/'. $item->product_avatar)}}" alt="product-1">
                                    </div>
                                    @if(auth()->check())
                                        <a class="cr-shopping-bag {{$isFavorite ? 'active' : ''}}"
                                           data-productId="{{$item->product_id}}"
                                           href="javascript:void(0)">
                                            <i class="ri-shopping-bag-line"></i>
                                            <input type="hidden"
                                                   id="userBag"
                                                   value="{{auth()->user()->user_id}}">
                                        </a>
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
                                       class="title">
                                        {{$item->product_name}}
                                    </a>
                                    <p class="cr-price">
                                        <span class="new-price">{{number_format($item->sale_price) }} đ</span>
                                        @if($item->product_price)
                                            <span
                                                class="old-price">{{number_format($item->product_price)}} đ</span>
                                        @else
                                            <span class="old-price"></span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <nav aria-label="..." class="cr-pagination">
                    {{$searchResults->links()}}
                </nav>
            </div>
        </div>
    </section>
@endsection
