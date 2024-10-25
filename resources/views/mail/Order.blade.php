<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #007BFF;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .email-header h1 {
            font-size: 28px;
            margin: 0;
            letter-spacing: 1px;
        }

        .email-body {
            padding: 30px;
        }

        .email-body h2 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
        }

        .email-body .order-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .order-info h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333333;
        }

        .order-info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .order-details {
            margin-top: 20px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-details th, .order-details td {
            padding: 15px;
            border: 1px solid #eeeeee;
            text-align: left;
        }

        .order-details th {
            background-color: #f1f1f1;
        }

        .order-summary {
            font-size: 18px;
            text-align: right;
            font-weight: bold;
        }

        .email-footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            color: #777777;
        }

        .email-footer p {
            margin: 0;
            font-size: 14px;
        }

        .email-footer a {
            color: #007BFF;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .order-info {
                padding: 15px;
            }

            .order-details th, .order-details td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Email Header -->
    <div class="email-header">
        <h1>Cảm ơn bạn đã đặt hàng!</h1>
    </div>

    <!-- Email Body -->
    <div class="email-body">
        <h2>Xin chào {{$order->user->username}},</h2>
        <p>Chúng tôi rất vui mừng thông báo với bạn rằng đơn hàng có mã <strong>{{$order->order_id}}</strong> của bạn đã được xác nhận và đang được xử lý.
            Sau đây là thông tin chi tiết:</p>

        <!-- Order Information -->
        <div class="order-info">
            <h3>Thông tin đặt hàng</h3>
            <p><strong>Ngày đặt hàng:</strong> {{$order->created_at}}</p>
            <p><strong>Mã Đơn hàng:</strong> {{$order->order_id}}</p>
        </div>

        <!-- Order Details -->
        <div class="order-details">
            <h3>Chi tiết đặt hàng</h3>
            <table>
                <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->order_item as $item)
                    <tr>
                        <td>{{$item->product->product_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->price_per_item) }} đ</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            Tổng thanh toán: {{number_format($order->final_price)}} đ
        </div>
    </div>

    <!-- Email Footer -->
    <div class="email-footer">
        <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với nhóm hỗ trợ của chúng tôi theo địa chỉ <a href="#">admin@gmail.com</a>.
        </p>
        <p>Cảm ơn bạn đã mua sắm với chúng tôi!</p>
    </div>
</div>
</body>
</html>
