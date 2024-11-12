@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Sản phẩm</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Chi tiết sản phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product -->
    <section class="section-product padding-t-100 mb-5">
        <div class="container">
            <div class="row mb-minus-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="col-xxl-4 col-xl-5 col-md-6 col-12 mb-24">
                    <div class="vehicle-detail-banner banner-content clearfix">
                        <div class="banner-slider">
                            <div class="slider slider-for">
                                @foreach($getDetail->product_image as $item)
                                    <div class="slider-banner-image">
                                        <div class="zoom-image-hover">
                                            <img src="{{asset('upload/'. $item->product_image)}}" alt="product-tab-1"
                                                 class="product-image">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="slider slider-nav thumb-image">
                                @foreach($getDetail->product_image as $item)
                                    <div class="thumbnail-image">
                                        <div class="thumbImg">
                                            <img src="{{asset('upload/'. $item->product_image)}}" alt="product-tab-1">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <form class="col-xxl-8 col-xl-7 col-md-6 col-12 mb-24" action="{{route('addCart')}}" method="post">
                    @if(auth()->check())
                        <input type="hidden" name="user_id" value="{{auth()->user()->user_id}}">
                    @else
                        <input type="hidden" name="user_id" value="">
                    @endif
                    <input type="hidden" name="product_id" value="{{$getDetail->product_id}}">
                    <input type="hidden" name="sale_price" value="{{$getDetail->sale_price}}">
                    <input type="hidden" name="product_variant_id" id="selected-product-variant-id" value="">
                    @csrf
                    <div class="cr-size-and-weight-contain">
                        <h2 class="heading">
                            {{$getDetail->product_name}}
                        </h2>
                        <p><label>Mã sản phẩm <span>:</span></label> {{$getDetail->product_id}}</p>
                    </div>
                    <div class="cr-size-and-weight">
                        <div class="list">
                            <ul>
                                <li><label>Danh mục <span>:</span></label>{{$getDetail->category->category_name}}</li>
                            </ul>
                        </div>
                        <div class="cr-product-price">
                            <span class="new-price">{{number_format($getDetail->sale_price)}} đ</span>
                            <span class="old-price">{{number_format($getDetail->product_price)}} đ</span>
                        </div>
                        <div class="cr-size-weight">
                            <h5><span>Size</span>:</h5>
                            <div class="cr-kg">
                                <ul>
                                    @foreach($getDetail->variants->unique('size') as $item)
                                        <li class="size-option"
                                            style="padding: 13px 13px;"
                                            data-size-id="{{$item->size->size_id}}">{{$item->size->size_name}}</li>
                                    @endforeach
                                </ul>
                                <!-- Input ẩn để lưu giá trị size được chọn -->
                                <input type="hidden" name="size_id" id="selected-size-id">
                            </div>
                        </div>
                        <div class="cr-color-weight">
                            <h5><span>Color</span>:</h5>
                            <div class="cl-kg">
                                <ul>
                                    {{--<li class="cl-active-color">50kg</li>--}}
                                    @foreach($getDetail->variants->unique('color') as $item)
                                        <li class="color-option" data-size-id="{{$item->color->color_id}}"
                                            data-color-id="{{$item->color->color_id}}"
                                            style="background-color: {{$item->color->color_code}}; padding: 17px 17px; margin: 0 5px"></li>
                                    @endforeach
                                </ul>
                                <!-- Input ẩn để lưu giá trị color được chọn -->
                                <input type="hidden" name="color_id" id="selected-color-id">
                            </div>
                        </div>

                        <div class="cr-add-card">
                            <div class="cr-qty-main">
                                <input type="text" placeholder="."
                                       name="quantity" value="1" minlength="1" maxlength="5"
                                       class="quantity">
                                <button type="button" class="plus">+</button>
                                <button type="button" class="minus">-</button>
                            </div>
                            <div class="cr-add-button">
                                @if(auth()->check())
                                    <button type="submit" class="cr-button">Thêm vào giỏ hàng</button>
                                @else
                                    <button type="button" class="cr-button">Thêm vào giỏ hàng</button>
                                @endif
                            </div>
                            <div class="cr-add-button">
                                @if(session()->has('errorCart'))
                                    <div class="alert alert-danger">
                                        {{ session('errorCart') }}
                                    </div>
                                    {{ session()->forget('errorCart') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="col-12">
                    <div class="cr-paking-delivery">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description"
                                        aria-selected="true">Mô tả sản phẩm
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                        type="button" role="tab" aria-controls="review"
                                        aria-selected="false">Đánh giá
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                 aria-labelledby="description-tab">
                                <div class="cr-tab-content">
                                    <div class="cr-description">
                                        <p>{!!$getDetail->product_desc!!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="cr-tab-content-from">
                                    @foreach($listPost as $post)
                                        <div class="post">
                                            <div class="content">
                                                <img src="{{asset('upload/'. $post->user->avatar) }}" alt="review">
                                                <div class="details">
                                                    <span class="date">
                                                        {{\Illuminate\Support\Carbon::parse($post->created_at)->diffForHumans()}}
                                                    </span>
                                                    <span class="name">{{$post->user->username}}</span>
                                                </div>
                                            </div>
                                            <p>{{$post->comment}}</p>
                                        </div>
                                    @endforeach
                                    <div id="viewComment">

                                    </div>
                                    <form action="javascript:void(0)" id="formComment">
                                        @if(auth()->check())
                                            <input type="hidden"
                                                   id="user_id_comment"
                                                   name="user_id"
                                                   value="{{auth()->user()->user_id}}">
                                        @else
                                            <input type="hidden"
                                                   id="user_id_comment"
                                                   name="user_id"
                                                   value="">
                                        @endif
                                        <input type="hidden"
                                               id="product_id_comment"
                                               name="product_id"
                                               value="{{$getDetail->product_id}}">
                                        <div class="cr-ratting-input form-submit">
                                            @if($hasPurchased)
                                                <textarea id="comment" name="comment" placeholder="Nhập bình luận của bạn"></textarea>
                                                <p class="text-danger error-text" id="comment-error"></p>
                                                <button class="cr-button" type="submit">Submit</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script !src="">
        const variants = @json($getDetail->variants);
    </script>
@endsection
