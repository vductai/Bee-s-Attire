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
                                        <span>[{{$item->product_count}}]</span>
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
                                <button type="button" class="cr-button">Filter</button>
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
                    <div class="row col-100 mb-minus-24" id="product-results">
                        @foreach($listAllProductShop as $item)
                            @if(auth()->check())
                                @php
                                    $isFavorite = \App\Models\Whishlist::where('user_id', auth()->user()->user_id)
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
                                        <a class="cr-shopping-bag" href="javascript:void(0)">
                                            <i class="ri-shopping-bag-line"></i>
                                        </a>
                                    </div>
                                    <div class="cr-product-details">
                                        <div class="cr-brand">
                                            <a href="shop-left-sidebar.html">{{$item->category->category_name}}</a>
                                        </div>
                                        <a href="{{route('detail', ['slug' => $item->slug])}}" class="title">
                                            {{$item->product_name}}
                                        </a>
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
    <script>
        document.querySelectorAll('.cr-checkbox input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const selectedCategories = Array.from(document.querySelectorAll('.cr-shop-categories input[type="checkbox"]:checked'))
                    .map(el => el.id);
                const selectedColors = Array.from(document.querySelectorAll('.cr-shop-color input[type="checkbox"]:checked'))
                    .map(el => el.id);
                const selectedSizes = Array.from(document.querySelectorAll('.cr-shop-weight input[type="checkbox"]:checked'))
                    .map(el => el.id);

                // Kiểm tra các giá trị đã chọn
                console.log("Categories:", selectedCategories);
                console.log("Colors:", selectedColors);
                console.log("Sizes:", selectedSizes);

                axios.post('/search-product', {
                    categories: selectedCategories,
                    colors: selectedColors,
                    sizes: selectedSizes
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(res => {
                    const products = res.data;
                    console.log(products)
                    let html = '';
                    function format(amount) {
                        return amount.toLocaleString('vi-VN', {style: 'currency', currency: 'VND'})
                    }
                    products.forEach(product => {
                        const avatar = `${window.location.origin}/upload/${product.product.product_avatar}`
                        html +=
                            `
                                <div class="col-xxl-3 col-xl-4 col-6 cr-product-box mb-24">
                                    <div class="cr-product-card">
                                        <div class="cr-product-image">
                                            <div class="cr-image-inner zoom-image-hover">
                                                <img src="${avatar}" alt="product-1">
                                            </div>
                                            <a class="cr-shopping-bag" href="javascript:void(0)">
                                                <i class="ri-shopping-bag-line"></i>
                                            </a>
                                        </div>
                                        <div class="cr-product-details">
                                            <div class="cr-brand">
                                                <a href="shop-left-sidebar.html">${product.category_name}</a>
                                            </div>
                                            <a href="/detail/${product.product.slug}" class="title">
                                                ${product.product.product_name}
                                            </a>
                                            <p class="cr-price">
                                                <span class="new-price">${format(product.product.sale_price)}</span>
                                                <span class="old-price">${format(product.product.product_price)}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `
                    })
                    document.getElementById('product-results').innerHTML = html
                }).catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                });
            })
        })
    </script>
@endsection
