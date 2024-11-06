<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo Voucher Sắp Hết Hạn</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f5;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            line-height: 1.6;
        }

        .voucher-details {
            background: #e9f5ee;
            border: 1px solid #d1e7dd;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .voucher-details p {
            margin: 10px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #218838;
        }

        footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }

        @media (max-width: 600px) {
            .email-container {
                padding: 20px;
            }
            .button {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <h1>Thông Báo Voucher</h1>
    <p>Kính gửi Quý Khách Hàng,</p>
    <p>Chúng tôi xin thông báo rằng voucher của bạn sắp hết hạn. Dưới đây là thông tin chi tiết:</p>

    @foreach($vouchers as $item)
        <div class="voucher-details">
            <p><strong>Mã Voucher:</strong> <span style="color: #28a745;">{{$item->voucher->voucher_code}}</span></p>
            <p><strong>Ngày Hết Hạn:</strong> <span style="color: #d9534f;">{{\Illuminate\Support\Carbon::parse($item->end_date)->format('H:i d-m-Y') }}</span></p>
            <p><strong>Giá Trị Voucher:</strong> <span style="color: #28a745;">{{$item->voucher->voucher_price}} %</span></p>
        </div>
    @endforeach

    <p>Đừng bỏ lỡ cơ hội sử dụng voucher của mình! Nhấn vào nút bên dưới để mua sắm ngay hôm nay.</p>
    <a href="https://yourwebsite.com/shop" class="button">Mua Sắm Ngay</a>

    <footer>
        <p>Cảm ơn bạn đã chọn chúng tôi!</p>
        <p>Địa chỉ: 123 Đường ABC, Thành Phố XYZ</p>
    </footer>
</div>
</body>
</html>
