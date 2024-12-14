@extends('layout.client.home')
@section('title', 'Giỏ hàng')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Giỏ hàng</h2>
                            <span> <a href="index.html">Trang chủ</a> / Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart -->
    <section class="section-cart padding-t-100 mb-5">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Cart</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cr-cart-content" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="row">
                            <div>
                                <div class="cr-table-content">
                                    <table id="cart-table">
                                        <thead>
                                        <tr>
                                            <th>Sản phầm</th>
                                            <th>Giá</th>
                                            <th class="text-center">Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getCart as $item)
                                            <tr data-id="{{$item->cart_item_id}}">
                                                <td class="cr-cart-name">
                                                    <a href="{{route('detail', ['slug' => $item->product->slug])}}" data-idPro="{{$item->product_id}}">
                                                        <img src="{{asset('upload/'. $item->product->product_avatar)}}"
                                                             alt="product-1" class="cr-cart-img">
                                                        <div>
                                                            <span class="amount"
                                                                  style="font-size: 18px">{{$item->product->product_name}}</span>
                                                            <p>{{$item->productVariant->size->size_name ?? 'Trống'}}
                                                                , {{$item->productVariant->color->color_name ?? 'Trống'}}</p>
                                                            <input type="hidden" value="{{$item->product_variant_id}}" id="variantId">
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="cr-cart-price" data-total="{{$item->product->sale_price}}">
                                                    <span class="amount product_price">{{number_format($item->product->sale_price)}} đ</span>
                                                </td>
                                                <td class="cr-cart-qty">
                                                    <div class="cart-qty-plus-minus">
                                                        <button type="button" class="minuss">-</button>
                                                        <input type="text" placeholder="." value="{{$item->quantity}}"
                                                               maxlength="20" class="quantityy">
                                                        <button type="button" class="pluss">+</button>
                                                    </div>
                                                </td>
                                                <td class="cr-cart-subtotal total">
                                                    {{number_format($item->price)}} đ
                                                </td>
                                                <td class="cr-cart-remove">
                                                    <a href="javascript:void(0)">
                                                        <i class="ri-delete-bin-line delete-cart" data-id="{{$item->cart_item_id}}"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cr-cart-update-bottom">
                                            <a href="{{route('home')}}" class="cr-links">Tiếp tục mua sắm</a>
                                            <a href="" class="cr-button checkout">Thanh toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
