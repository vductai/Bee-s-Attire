@extends('layout.client.home')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Cart</h2>
                            <span> <a href="index.html">Home</a> / Cart</span>
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
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getCart as $item)
                                            <tr>
                                                <td class="cr-cart-name">
                                                    <a href="{{route('detail', ['slug' => $item->product->slug])}}" data-idPro="{{$item->product_id}}">
                                                        <img src="{{asset('upload/'. $item->product->product_avatar)}}"
                                                             alt="product-1" class="cr-cart-img">
                                                        <div>
                                                            <span class="amount"
                                                                  style="font-size: 25px">{{$item->product->product_name}}</span>
                                                            <p>{{$item->productVariant->size->size_name ?? 'Trống'}}
                                                                , {{$item->productVariant->color->color_name ?? 'Trống'}}</p>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="cr-cart-price" data-total="{{$item->product->sale_price}}">
                                                    <span class="amount product_price">{{number_format($item->product->sale_price)}} đ</span>
                                                </td>
                                                <td class="cr-cart-qty">
                                                    <div class="cart-qty-plus-minus">
                                                        <button type="button" class="pluss">+</button>
                                                        <input type="text" placeholder="." value="{{$item->quantity}}"
                                                               maxlength="20" class="quantityy">
                                                        <button type="button" class="minuss">-</button>
                                                    </div>
                                                </td>
                                                <td class="cr-cart-subtotal total">
                                                    {{number_format($item->price)}} đ
                                                </td>
                                                <td class="cr-cart-remove">
                                                    <form action="{{ route('deleteCart', $item->cart_item_id) }}"
                                                          method="POST" style="display: none;"
                                                          id="cart-form-{{$item->cart_item_id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a href="#"
                                                       onclick="event.preventDefault(); document.getElementById('cart-form-{{$item->cart_item_id}}').submit();">
                                                        <i class="ri-delete-bin-line"></i>
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
                                            <a href="{{route('home')}}" class="cr-links">Continue Shopping</a>
                                            <a href="" class="cr-button checkout">Check Out</a>
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
