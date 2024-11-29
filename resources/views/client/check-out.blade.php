@extends('layout.client.home')
@section('title', 'Thanh toán đơn hàng')
@section('content_client')
    <!-- Breadcrumb -->
    <section class="section-breadcrumb">
        <div class="cr-breadcrumb-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-breadcrumb-title">
                            <h2>Thanh toán</h2>
                            <span> <a href="{{route('home')}}">Trang chủ</a> / Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout section -->
    <section class="cr-checkout-section padding-tb-100">
        <div class="container">
            @if(\App\Models\Cart::where('user_id', auth()->user()->user_id)->exists())
                <div class="row">
                    <div class="cr-checkout-rightside col-lg-4 col-md-12">
                        <div class="cr-sidebar-wrap">
                            <div class="cr-sidebar-block">
                                <div class="cr-sb-title">
                                    <h3 class="cr-sidebar-title">Sơ lược</h3>
                                </div>
                                <div class="cr-sb-block-content">
                                    <div class="cr-checkout-summary">

                                        <div>
                                            <span class="text-left">Tiền hàng</span>
                                            <span class="text-right">{{number_format($totalAmount)}} đ</span>
                                        </div>
                                        <div>
                                        <span class="text-left">
                                            Giảm giá ( {{$voucher->voucher->voucher_price ?? ''}} % )
                                        </span>
                                            <span class="text-right">{{ number_format($discount) ?? 0}} đ</span>
                                        </div>
                                        <div class="cr-checkout-summary-total">
                                            <span class="text-left">Tổng tiền hàng</span>
                                            <span
                                                class="text-right">{{number_format($total_after_discount) ?? 0}} đ</span>
                                        </div>
                                    </div>
                                    <div class="cr-checkout-pro">
                                        <div class="col-sm-12 mb-6">
                                            @foreach($selCart as $item)
                                                <div class="cr-product-inner">
                                                    <div class="cr-pro-image-outer">
                                                        <div class="cr-pro-image">
                                                            <a href="product-left-sidebar.html" class="image">
                                                                <img class="main-image"
                                                                     src="{{asset('upload/'. $item->product->product_avatar)}}"
                                                                     alt="Product">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="cr-pro-content cr-product-details">
                                                        <h5 class="cr-pro-title">
                                                            <a href="{{route('detail', ['slug' => $item->product->slug])}}"
                                                               style="display: -webkit-box;
                                                                -webkit-line-clamp: 2; -webkit-box-orient: vertical;
                                                                overflow: hidden; text-overflow: ellipsis; white-space: normal"
                                                            >{{$item->product->product_name}}</a>
                                                        </h5>
                                                        <div class="cr-pro-rating d-flex
                                                        justify-content-between align-content-center">
                                                            <p>{{$item->productVariant->size->size_name ?? 'Trống'}}
                                                                , {{$item->productVariant->color->color_name ?? 'Trống'}}</p>
                                                            <p style="">x{{$item->quantity}}</p>
                                                        </div>
                                                        <p class="cr-price">
                                                            <span class="new-price">{{number_format($item->product->sale_price)}} đ</span>
                                                            <span class="old-price">{{number_format($item->product->product_price)}} đ</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cr-sidebar-wrap cr-checkout-del-wrap">
                            <div class="cr-sidebar-block">
                                <div class="cr-sb-title">
                                    <h3 class="cr-sidebar-title">Voucher</h3>
                                </div>
                                <div class="cr-sb-block-content">
                                    <div class="cr-checkout-del">
                                        <form action="{{route('addVoucher')}}" method="post" id="addVoucher">
                                            <input type="hidden" name="totalAmount" value="{{$totalAmount}}">
                                            @csrf
                                            <span class="cr-del-option">
                                                <span>
                                                    <span class="cr-del-opt-head">Nhập mã giảm giá</span>
                                                    <input type="text" class="form-control" name="voucher_code">
                                                    @if(session()->has('voucherError'))
                                                        <div
                                                            class="alert alert-danger">{{ session('voucherError') }}</div>
                                                        {{ session()->forget('voucherError') }}
                                                    @endif
                                                </span>
                                                <span>
                                                    <a class="model-oraganic-product cr-button mt-4 mx-2 btn-secondary"
                                                       data-bs-toggle="modal" href="#quickview"
                                                       role="button">
                                                        Mã của bạn
                                                    </a>
                                                </span>
                                            </span>
                                            <button
                                                form="addVoucher"
                                                class="cr-button mt-2" type="submit">Add mã giảm giá
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="cr-sidebar-block mt-5">
                                <div class="cr-sb-block-content">
                                    <span class="cr-del-commemt">
                                            <span class="cr-del-opt-head">Ghi chú cho đơn hàng</span>
                                            <textarea name="note" id="note" placeholder=""></textarea>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="cr-sidebar-wrap cr-checkout-pay-wrap">
                            <div class="cr-sidebar-block">
                                <div class="cr-sb-title">
                                    <h3 class="cr-sidebar-title">Phương thức thanh toán</h3>
                                </div>
                                <div class="cr-sb-block-content">
                                    <div class="cr-checkout-pay">
                                        <div action="#" class="payment-options">
                                        <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay1" value="cod" name="radio-group" checked>
                                                <label for="pay1">Tiền mặt khi giao hàng</label>
                                            </span>
                                        </span>
                                            <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay2" value="vnpay" name="radio-group">
                                                <label for="pay2">Thanh toán qua <b
                                                        style="color:#002C6D;">VNPay</b></label>
                                            </span>
                                        </span>
                                            <span class="cr-pay-option">
                                            <span>
                                                <input type="radio" id="pay3" value="payUrl" name="radio-group">
                                                <label for="pay3">Thanh toán qua <b
                                                        style="color: #D82D8B">MoMo</b></label>
                                            </span>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cr-checkout-leftside col-lg-8 col-md-12 m-t-991">
                        <div class="cr-checkout-content">
                            <div class="cr-checkout-inner">
                                <form action="{{route('check-payment-method')}}" method="post" class="cr-checkout-wrap">
                                    @csrf
                                    <input type="hidden" name="total_price" value="{{$totalAmount}}">
                                    <input type="hidden" name="voucher_id" value="{{$voucher_item_id ?? null}}">
                                    <input type="hidden" name="final_price" value="{{$total_after_discount}}">
                                    <input type="hidden" name="product" value="{{json_encode($selCart)}}">
                                    <input type="hidden" name="notes" value="" id="notes">
                                    <div class="cr-checkout-block cr-check-bill">
                                        <h3 class="cr-checkout-title">Chi tiết thanh toán</h3>
                                        <div class="cr-bl-block-content">
                                            <div class="cr-check-bill-form mb-minus-24">
                                                <span class="cr-bill-wrap">
                                                    <label>Tên người nhận</label>
                                                    <input type="text" value="{{$item->user->username}}"
                                                           name="username"
                                                           placeholder="Họ và tên">
                                                </span>
                                                <span class="cr-bill-wrap">
                                                    <label>Địa chỉ nhận hàng</label>
                                                    <input type="text" name="address" value="{{$item->user->address}}"
                                                           placeholder="Địa chỉ">
                                                </span>
                                                <span class="cr-bill-wrap ">
                                                    <label>Số điện thoại</label>
                                                    <input type="number" value="{{$item->user->phone}}" name="phone"
                                                           placeholder="Số điện thoại">
                                                </span>
                                                <span class="cr-bill-wrap ">
                                                    <label>Email</label>
                                                    <input type="email" value="{{$item->user->email}}" name="email"
                                                           placeholder="Email">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="cr-check-order-btn">
                                    <button class="cr-button mt-30" id="submitButton" name="cod"
                                            type="submit">Đặt hàng</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <h3 class="text-danger text-center" style="margin: 200px 0;">
                        Không có đơn hàng nào cần thanh toán
                    </h3>
                </div>
            @endif
        </div>
    </section>
    <script>
        const notes = document.getElementById('notes')
        const note = document.getElementById('note')
        note.addEventListener('input', function () {
            notes.value = note.value
            console.log(notes.value)
        })
    </script>
@endsection
