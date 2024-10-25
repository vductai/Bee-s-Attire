@extends('layout.client.home')
@section('content_client')

    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Wishlist</h2>
                            <span><a href="index.html">Home</a> - Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-compare padding-tb-100">
        <div class="container">
            <div class="row mb-minus-24">
                @foreach($wishlists as $item)
                    <div class="col-lg-3 col-6 cr-product-box mb-24">
                        <div class="cr-product-card">
                            <div class="cr-product-image">
                                <div class="cr-image-inner zoom-image-hover">
                                    <img src="{{ asset('upload/' . $item->product->product_avatar) }}" alt="{{ $item->product->product_name }}">
                                </div>
                                <div class="cr-side-view">
                                    <a class="cr-remove-product" href="#" 
                                       onclick="event.preventDefault(); 
                                       if(confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi wishlist?')) {
                                           document.getElementById('remove-wishlist-form-{{ $item->product_id }}').submit();
                                       }">
                                       <i class="ri-close-line"></i>
                                    </a>
                                    <a class="wishlist" href="javascript:void(0)">
                                        <i class="ri-heart-line"></i>
                                    </a>
                                    <a class="model-oraganic-product" data-bs-toggle="modal" href="#quickview" role="button">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                </div>
                                <a class="cr-shopping-bag" href="javascript:void(0)">
                                    <i class="ri-shopping-bag-line"></i>
                                </a>
                            </div>
                            <div class="cr-product-details">
                                <div class="cr-brand">
                                    <a href="shop-left-sidebar.html">{{ $item->product->category->category_name }}</a>
                                </div>
                                <a href="{{ route('detail', ['slug' => $item->product->slug]) }}" class="title">{{ $item->product->product_name }}</a>
                                <p class="cr-price">
                                    <span class="new-price">{{ number_format($item->product->sale_price) }} đ</span>
                                    <span class="old-price">{{ number_format($item->product->product_price) }} đ</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <form id="remove-wishlist-form-{{ $item->product_id }}" action="{{ route('delete-wishlist', $item->product_id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            //console.log(window.Echo); 
            const userId = {{ Auth::id() ?? 'null' }};

            // if (userId !== 'null') {
            //     window.Echo.channel('wishlist.' + userId)
            //         .listen('.product-added', (e) => {
            //             alert('Sản phẩm đã được thêm vào wishlist của bạn');
            //         });
            // } 
            if (userId !== 'null') {
                window.Echo.channel('wishlist.' + userId)
                    .listen('.product-added', (e) => {
                        const notification = document.getElementById('notification');
                        notification.textContent = 'Sản phẩm đã được thêm vào wishlist của bạn!';
                        notification.classList.remove('invisible'); 
                        notification.style.display = 'block';
                        setTimeout(() => {
                            notification.style.display = 'none';
                        }, 3000);
                    });
            }
        });
    </script>
       
@endsection
