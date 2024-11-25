@extends('layout.client.home')
@section('title', 'Shop')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Cửa hàng</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Cửa hàng</span>
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
                            <h2>Danh mục</h2>
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
                            <h4 class="cr-shop-sub-title">Danh mục</h4>
                            <div class="cr-checkbox">
                                @foreach($listcategory as $item)
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="{{$item->category_name}}">
                                        <label for="{{$item->category_name}}">{{$item->category_name}}</label>
                                        {{--<span>[{{$item->product_count}}]</span>--}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="cr-shop-price">
                            <h4 class="cr-shop-sub-title">Giá</h4>
                            <div class="price-range-slider">
                                <div id="slider-range" class="range-bar"></div>
                                <p class="range-value">
                                    <label>Giá :</label>
                                    <input type="text" id="amount" placeholder="'" readonly>
                                </p>
                                <button type="button" class="cr-button cr-filter">Filter</button>
                            </div>
                        </div>
                        <div class="cr-shop-color">
                            <h4 class="cr-shop-sub-title">Màu sắc</h4>
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
                            <h4 class="cr-shop-sub-title">Kích thước</h4>
                            <div class="cr-checkbox">
                                @foreach($listSize as $item)
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="{{$item->size_name}}">
                                        <label for="{{$item->size_name}}">{{$item->size_name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="cr-shop-tags">
                            <h4 class="cr-shop-sub-title">Từ khoá</h4>
                            <div class="cr-shop-tags-inner">
                                <ul class="cr-tags">
                                    @foreach($tags as $tag)
                                        <li><a href="javascript:void(0)">{{$tag->tag_name}}</a></li>
                                    @endforeach
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
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-100 mb-minus-24" id="product-results">
                        @foreach($listAllProductShop as $item)
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
                                            <a href="shop-left-sidebar.html">{{$item->category->category_name}}</a>
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
                    <nav aria-label="" class="cr-pagination">
                        {{$listAllProductShop->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <script>
        const lowestPrice = {{$lowestPrice}};
        const highestPrice = {{$highestPrice}};
    </script>
@endsection
