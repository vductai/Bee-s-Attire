<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 90%;
            max-width: 1430px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .invoice-header .from, .invoice-header .to, .invoice-header .details {
            width: 30%;
            min-width: 200px;
        }

        .invoice-header img {
            max-height: 60px;
        }

        .invoice-header p {
            margin: 0;
            line-height: 1.5;
        }

        .invoice-header .details {
            text-align: right;
        }

        .invoice-title {
            text-align: center;
            margin: 30px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .invoice-summary div {
            text-align: center;
            font-size: 16px;
            min-width: 100px;
        }

        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-items th, .invoice-items td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        .invoice-items th {
            background-color: #3d3d6b;
            color: white;
        }

        .invoice-items td {
            vertical-align: middle;
        }

        .invoice-items img {
            width: 40px;
            height: auto;
        }

        .invoice-items .item-column {
            width: 30%;
        }

        .invoice-items .description-column {
            width: 35%;
        }

        .invoice-items .price-column, .invoice-items .total-column {
            width: 10%;
            white-space: nowrap;
        }

        .invoice-bottom {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .invoice-total, .invoice-note {
            width: 45%;
            min-width: 300px;
        }

        .invoice-total table {
            width: 100%;
        }

        .invoice-total td {
            padding: 8px 12px;
            text-align: right;
        }

        .invoice-note {
            background-color: #f9f9f9;
            padding: 10px;
            border-left: 4px solid #333;
        }

        .invoice-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .invoice-actions button {
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }

        .invoice-actions button.save {
            background-color: #007bff;
            color: white;
        }

        .invoice-actions button.print {
            background-color: #333;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .invoice-header, .invoice-summary, .invoice-bottom {
                flex-direction: column;
                align-items: center;
            }

            .invoice-header .from, .invoice-header .to, .invoice-header .details {
                width: 100%;
                text-align: center;
            }

            .invoice-header .details {
                text-align: center;
                margin-top: 10px;
            }

            .invoice-summary div {
                width: 100%;
                margin-bottom: 10px;
            }

            .invoice-total, .invoice-note {
                width: 100%;
                margin-bottom: 10px;
            }

            .invoice-actions {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .invoice-items th, .invoice-items td {
                font-size: 12px;
                padding: 8px;
            }

            .invoice-items img {
                width: 30px;
            }

            .invoice-actions button {
                padding: 8px 15px;
                font-size: 12px;
            }
        }

    </style>
</head>
<body>
<div class="" style="display:flex; justify-content: center; align-items: center">
    <h2>Xin chào {{$order->user->username}},</h2>
</div>
@if($order->status === 'Đã xác nhận')
    <p>Chúng tôi thông báo với bạn rằng đơn hàng có mã <strong>#{{$order->order_id}}</strong>
        của bạn <strong>đã được xác nhận</strong> và sẻ gửi cho quý khách sớm nhất.</p>
@elseif($order->status === 'Đã giao hàng')
    <p>Chúng tôi thông báo với bạn rằng đơn hàng có mã <strong>#{{$order->order_id}}</strong>
        của bạn <strong>đã được giao đi thành công</strong>, vui lòng kiểm tra điện thoại để nhận thông tin từ shipper.</p>
@endif
<h3>Chi tiết đơn hàng</h3>
<div class="invoice-container">
    <div class="invoice-header">
        <div class="from">
            <img src="https://imgur.com/2NF23OS.png" alt="Bee Attire">
            <p>13 phố Trịnh Văn Bô, phường Phương Canh, quận Nam Từ Liêm, TP Hà Nội</p>
        </div>
        <div class="to">
            <p><strong>Người nhận</strong><br>
                Họ và tên: {{$order->user->username}}<br>
                Địa chỉ: {{$order->user->address}}<br>
                Email: {{$order->user->email}}<br>
                Số điện thoại: {{$order->user->phone}}</p>
        </div>
        <div class="details">
            <p><strong>Mã đơn hàng:</strong> #{{$order->order_id}}<br>
                <strong>Phương thức thanh toán:</strong> {{$order->payment_method}}<br>
            <div><strong>Ngày mua:</strong> {{\Carbon\Carbon::parse($order->created_at)->format('h:m d-m-Y')}}</div> <br>
        </div>
    </div>

    <div class="invoice-summary" style="display:flex; justify-content: space-between; align-items: center"></div>

    <table class="invoice-items">
        <thead>
        <tr>
            <th>Mã đơn hàng</th>
            {{--<th>Ảnh</th>--}}
            <th class="item-column">Tên sản phẩm</th>
            <th>Số lượng</th>
            <th class="price-column">Giá</th>
            <th class="total-column">Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->order_item as $item)
            <tr>
                <td>#{{$item->order_id}}</td>
                {{--<td>
                    <img src="{{ config('APP_URL') . '/upload/' . $item->product->product_avatar }}"
                         alt="Pants">
                </td>--}}
                <td>{{$item->product->product_name}}, {{$item->productVariant->size->size_name}} - {{$item->productVariant->color->color_name}}</td>
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
            <p>{{$order->note}}</p>
        </div>

        <div class="invoice-total">
            <table>
                <tr>
                    <td><strong>Tổng thu</strong></td>
                    <td>{{number_format($order->total_price)}} đ</td>
                </tr>
                <tr>
                    @if(is_null($order->voucher_id))
                        <td><strong>Voucher</strong></td>
                        <td>0</td>
                    @else
                        <td><strong>Voucher</strong></td>
                        <td>{{number_format($order->total_price * ($order->voucher->voucher_price / 100)) }} đ</td>
                    @endif
                </tr>
                <tr>
                    <td><strong>Thành tiền</strong></td>
                    @if(is_null($order->voucher_id))
                        <td>
                            {{number_format($order->final_price)}} đ
                        </td>
                    @else
                        <td>
                            {{number_format($order->total_price - ($order->total_price * ($order->voucher->voucher_price / 100)))}}
                            đ
                        </td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
