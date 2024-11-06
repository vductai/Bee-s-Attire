@extends('layout.client.home')
@section('content_client')
    <link rel="stylesheet" href="{{asset('assets/client/app.css')}}">
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="from">
                <img src="{{asset('assets/client/img/logo/logo.png')}}" style="margin-bottom: 5px;" alt="Carrot">
                <p>13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội</p>
            </div>
            <div class="to">
                <p><strong>Người nhận</strong><br>
                    Họ và tên: {{$detail->user->username}}<br>
                    Địa chỉ: {{$detail->user->address}}<br>
                    Email: {{$detail->user->email}}<br>
                    Số điện thoại: {{$detail->user->phone}}</p>
            </div>
            <div class="details">
                <p><strong>Mã đơn hàng:</strong> {{$detail->order_id}}<br>
                    <strong>Phương thức thanh toán:</strong> {{$detail->payment_method}}<br>
            </div>
        </div>

        <div class="invoice-summary">
            <div><strong>Mã đơn hàng:</strong> {{$detail->order_id}}</div>
            <div><strong>Tổng tiền hàng:</strong> {{number_format($detail->final_price)}} đ</div>
            <div><strong>Số lượng:</strong> {{$quantity}}</div>
            <div><strong>Ngày mua:</strong> {{\Carbon\Carbon::parse($detail->created_at)->format('h:m d-m-Y')}}</div>
        </div>

        <table class="invoice-items">
            <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ảnh</th>
                <th class="item-column">Tên sản phẩm</th>
                <th>Số lượng</th>
                <th class="price-column">Giá</th>
                <th class="total-column">Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($detail->order_item as $item)
                <tr>
                    <td>{{$item->order_id}}</td>
                    <td>
                        <img src="{{asset('upload/'. $item->product->product_avatar)}}"
                             alt="Pants">
                    </td>
                    <td>{{$item->product->product_name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{number_format($item->product->sale_price)}} đ</td>
                    <td>{{number_format($item->product->sale_price * $item->quantity)}} đ</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="invoice-bottom">
            <div class="invoice-note">
                <p><strong>Ghi chú:</strong></p>
                <p>{{$detail->note}}</p>
            </div>

            <div class="invoice-total">
                <table>
                    <tr>
                        <td><strong>Tổng thu</strong></td>
                        <td>{{number_format($detail->total_price)}} đ</td>
                    </tr>
                    <tr>
                        @if(is_null($detail->voucher_id))
                            <td><strong>Voucher</strong></td>
                            <td>0</td>
                        @else
                            <td><strong>Voucher</strong></td>
                            <td>{{number_format($detail->total_price * ($detail->voucher->voucher_price / 100)) }} đ</td>
                        @endif
                    </tr>
                    <tr>
                        <td><strong>Thành tiền</strong></td>
                        @if(is_null($detail->voucher_id))
                            <td>
                                {{number_format($detail->final_price)}} đ
                            </td>
                        @else
                            <td>
                                {{number_format($detail->total_price - ($detail->total_price * ($detail->voucher->voucher_price / 100)))}} đ
                            </td>
                        @endif
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
