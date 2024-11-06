<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo Voucher</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0"
       style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">

    <!-- Header Section with Background Image -->
    <tr>
        <td align="center"
            style="background: url('https://example.com/background.jpg') no-repeat center center; background-size: cover; padding: 40px 20px;">
            <h2 style="color: #000; font-size: 28px; margin: 0;">🎉 Chúc mừng bạn! 🎉</h2>
            <p style="color: #000; font-size: 18px; margin: 10px 0;">Bạn đã nhận được một voucher giảm giá đặc biệt!</p>
        </td>
    </tr>
    <!-- Voucher Code Section -->
    <tr>
        <td align="center" style="padding: 20px;">
            <p style="color: #555555; font-size: 16px; margin: 10px 0;">Mã voucher của bạn là:</p>
            <div
                style="font-weight: bold; font-size: 24px; color: #4CAF50; background-color: #e0f7e8; padding: 15px 30px; border-radius: 5px; display: inline-block; margin-top: 10px;">
                {{$voucher->voucher->voucher_code}}
            </div>
            <p style="color: #777777; font-size: 14px; margin: 10px 0;">Hãy sử dụng mã này khi thanh toán để nhận ưu
                đãi.</p>
        </td>
    </tr>
    <!-- Button Section -->
    <tr>
        <td align="center" style="padding: 20px;">
            <a href="http://127.0.0.1:8000/"
               style="display: inline-block; padding: 15px 30px; font-size: 18px; color: #ffffff; background-color: #4CAF50; text-decoration: none; border-radius: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); margin-top: 15px;">
                Sử Dụng Ngay
            </a>
        </td>
    </tr>
</table>
</body>
</html>
