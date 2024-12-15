<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-30">
                <div class="cr-banner">
                    <h2><a href="javascript:void(0)">Sản phẩm mới nhập</a></h2>
                </div>
                <div class="cr-banner-sub-title">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-duration="2000">
            <div class="cr-twocolumns-product">
                @foreach($populars as $item)
                    @if(auth()->check())
                        @php
                            $isFavorite = \App\Models\Whishlist::where('user_id', auth()->user()->user_id)
                                                             ->where('product_id', $item->product_id)
                                                            ->exists();
                        @endphp
                    @else
                    @endif
                    <div class="slick-slide">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{{asset('upload/' . $item->product_avatar)}}" alt="product-1">
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
                                <a href="{{route('detail', $item->slug)}}"
                                   style="display: -webkit-box;
                                            -webkit-line-clamp: 2; -webkit-box-orient: vertical;
                                            overflow: hidden; text-overflow: ellipsis; white-space: normal"
                                   class="title">{{$item->product_name}}</a>
                                <p class="cr-price"><span class="new-price">{{number_format($item->sale_price)}} đ</span> <span
                                        class="old-price">{{number_format($item->product_price)}} đ</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-duration="2000">
            <div class="cr-products-rightbar">
                <img src="{{asset('assets/client/img/product/right.png')}}" alt="products-rightview">
                <div class="cr-products-rightbar-content">

                </div>
            </div>
        </div>
    </div>
</div>
