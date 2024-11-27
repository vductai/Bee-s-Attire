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
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-header p, .invoice-items td, .invoice-items th, .invoice-summary div {
            font-family: 'DejaVuSans', sans-serif; /* Áp dụng font cho các phần tử cần thiết */
        }
        .invoice-container {
            font-family: 'DejaVuSans', Sans-Serif;
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
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-header .from, .invoice-header .to, .invoice-header .details {
            width: 30%;
            min-width: 200px;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-header img {
            max-height: 60px;
        }
        .invoice-header p {
            margin: 0;
            line-height: 1.5;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-header .details {
            text-align: right;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-summary div {
            text-align: center;
            font-size: 16px;
            min-width: 100px;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-items th, .invoice-items td {
            border: 1px solid #ddd;
            padding: 12px;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-items th {
            background-color: #3d3d6b;
            color: white;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-items td {
            vertical-align: middle;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-items img {
            width: 40px;
            height: auto;
        }
        .invoice-items .item-column {
            width: 30%;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-items .description-column {
            width: 35%;
            font-family: 'DejaVuSans', Sans-Serif;
        }
        .invoice-items .price-column, .invoice-items .total-column {
            width: 10%;
            white-space: nowrap;
            font-family: 'DejaVuSans', Sans-Serif;
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
            font-family: 'DejaVuSans', Sans-Serif;
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
            font-family: 'DejaVuSans', Sans-Serif;
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
                            {{number_format($detail->total_price - ($detail->total_price * ($detail->voucher->voucher_price / 100)))}}
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
