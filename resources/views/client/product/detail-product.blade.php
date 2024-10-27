@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Product</h2>
                            <span> <a href="index.html">Home</a> - product</span>
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
                        {{--<div class="cr-review-star">
                            <div class="cr-star">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>( 75 Review )</p>
                        </div>--}}
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
                                    <button type="submit" class="cr-button cr-shopping-bag">Add to cart</button>
                                @else
                                    <button type="button" class="cr-button cr-shopping-bag">Add to cart</button>
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
                            <div class="cr-add-button">
                                @if(session()->has('errorCart'))
                                    <div class="alert alert-danger">
                                        {{ session('errorCart') }}
                                    </div>
                                    {{ session()->forget('errorCart') }}
                                @endif
                            </div>
                            {{--<div class="cr-card-icon">
                                <a href="javascript:void(0)" class="wishlist">
                                    <i class="ri-heart-line"></i>
                                </a>
                                <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview"
                                   role="button">
                                    <i class="ri-eye-line"></i>
                                </a>
                            </div>--}}
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
                            {{--<li class="nav-item" role="presentation">
                                <button class="nav-link" id="additional-tab" data-bs-toggle="tab"
                                        data-bs-target="#additional" type="button" role="tab" aria-controls="additional"
                                        aria-selected="false">Information
                                </button>
                            </li>--}}
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                        type="button" role="tab" aria-controls="review"
                                        aria-selected="false">Review
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
                            {{--<div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                                <div class="cr-tab-content">
                                    <div class="cr-description">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error in vero
                                            sapiente
                                            doloribus debitis corporis, eaque dicta, repellat amet, illum adipisci vel
                                            perferendis dolor! Quis vel consequuntur repellat distinctio rem. Corrupti
                                            ratione alias odio, error dolore temporibus consequatur, nobis veniam odit
                                            laborum dignissimos consectetur quae vero in perferendis provident quis.</p>
                                    </div>
                                    <div class="list">
                                        <ul>
                                            <li><label>Brand <span>:</span></label>ESTA BETTERU CO</li>
                                            <li><label>Flavour <span>:</span></label>Super Saver Pack</li>
                                            <li><label>Diet Type <span>:</span></label>Vegetarian</li>
                                            <li><label>Weight <span>:</span></label>200 Grams</li>
                                            <li><label>Speciality <span>:</span></label>Gluten Free, Sugar Free</li>
                                            <li><label>Info <span>:</span></label>Egg Free, Allergen-Free</li>
                                            <li><label>Items <span>:</span></label>1</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>--}}
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
                                    <h4 class="heading">Add a Review</h4>
                                    <form action="javascript:void(0)" id="formComment">
                                        <input type="hidden"
                                               id="user_id_comment"
                                               name="user_id"
                                               value="{{auth()->user()->user_id}}">
                                        <input type="hidden"
                                               id="product_id_comment"
                                               name="product_id"
                                               value="{{$getDetail->product_id}}">
                                        <div class="cr-ratting-input form-submit">
                                            <textarea id="comment" name="comment"
                                                      placeholder="Enter Your Comment"></textarea>
                                            <button class="cr-button" type="submit">Submit</button>
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
        document.addEventListener('DOMContentLoaded', function () {
            const sizeOptions = document.querySelectorAll('.size-option');
            const hiddenInputSize = document.getElementById('selected-size-id');
            const colorOptions = document.querySelectorAll('.color-option');
            const hiddenInputColor = document.getElementById('selected-color-id');
            const hiddenInputVariant = document.getElementById('selected-product-variant-id');

            let selectedSizeId = null;
            let selectedColorId = null;

            sizeOptions.forEach(option => {
                option.addEventListener('click', function () {
                    sizeOptions.forEach(opt => opt.classList.remove('active-color'));

                    this.classList.add('active-color');

                    // Gán giá trị cho selectedSizeId
                    selectedSizeId = this.getAttribute('data-size-id');
                    hiddenInputSize.value = selectedSizeId;
                    console.log(selectedSizeId)
                    updateProductVariant();
                    filterColorsByStock();
                });
            });

            colorOptions.forEach(option => {
                option.addEventListener('click', function () {
                    colorOptions.forEach(opt => opt.classList.remove('cl-active-color'));

                    this.classList.add('cl-active-color');

                    // Gán giá trị cho selectedColorId
                    selectedColorId = this.getAttribute('data-color-id');
                    hiddenInputColor.value = selectedColorId;
                    updateProductVariant();
                });
            });

            function updateProductVariant() {
                if (selectedSizeId && selectedColorId) {
                    const variants = @json($getDetail->variants);

                    const selectedVariant = variants.find(variant =>
                        variant.size_id == selectedSizeId && variant.color_id == selectedColorId
                    );
                    if (selectedVariant) {
                        hiddenInputVariant.value = selectedVariant.product_variant_id;
                    }
                }
            }

            function filterColorsByStock() {
                const variants = @json($getDetail->variants);

                colorOptions.forEach(option => {
                    const colorId = option.getAttribute('data-color-id');
                    const matchingVariant = variants.find(variant =>
                        variant.size_id == selectedSizeId && variant.color_id == colorId
                    );

                    if (matchingVariant && matchingVariant.quantity > 0) {
                        option.style.display = 'inline-block'; // Hiển thị màu nếu còn hàng
                    } else {
                        option.style.display = 'none'; // Ẩn màu nếu hết hàng
                    }
                });
            }

            function filterSizesByStock() {
                const variants = @json($getDetail->variants);

                sizeOptions.forEach(option => {
                    const sizeId = option.getAttribute('data-size-id');
                    const matchingVariant = variants.find(variant =>
                        variant.color_id == selectedColorId && variant.size_id == sizeId
                    );

                    if (matchingVariant && matchingVariant.quantity > 0) {
                        option.style.display = 'none'; // Hiển thị size nếu còn hàng
                    } else {
                        selectedSizeId.style.display = 'none';
                        option.style.display = 'inline-block'; // Ẩn size nếu hết hàng
                    }
                });
            }
        });
    </script>
@endsection
