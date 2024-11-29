<!-- Cart -->
<div class="cr-cart-overlay"></div>
<div class="cr-cart-view">
    <div class="cr-cart-inner">
        <div class="cr-cart-top">
            <div class="cr-cart-title">
                <h6>Giỏ hàng</h6>
                <button type="button" class="close-cart">×</button>
            </div>
            <ul class="crcart-pro-items">
                @php
                    $subTotal = 0;
                @endphp
                @foreach($getCartSlider as $item)
                    @php
                        $subTotal += $item->product->sale_price;
                    @endphp
                    <li>
                        <a href="product-left-sidebar.html" class="crside_pro_img">
                            <img src="{{asset('upload/'. $item->product->product_avatar)}}" alt="product-1">
                        </a>
                        <div class="cr-pro-content">
                            <a href="{{route('detail', $item->product->slug)}}"
                               class="cart_pro_title">{{$item->product->product_name}}</a>
                            <span class="cart-price"><span>{{number_format($item->product->sale_price)}}</span> đ</span>
                            <form action="{{route('deleteCartSlider', $item->cart_item_id)}}" method="post"
                                  style="display: none" id="cartSlider">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="javascript:void(0)"
                               onclick="event.preventDefault(); document.getElementById('cartSlider').submit()"
                               class="remove">×</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="cr-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                    <tr>
                        <td class="text-left">Tổng tiền :</td>
                        <td class="text-right">{{number_format($subTotal)}} đ</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="{{route('viewCart')}}" class="cr-button">Xem giỏ hàng</a>
                <a href="{{route('checkout')}}" class="cr-btn-secondary">Thanh toán</a>
            </div>
        </div>
    </div>
</div>
