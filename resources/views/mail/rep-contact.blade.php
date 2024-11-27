<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #007BFF;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }
        .body {
            padding: 20px;
            color: #333333;
        }
        .body p {
            line-height: 1.6;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #888888;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        Trả Lời Tin Nhắn
    </div>
    <div class="body">
        <p>Xin chào <strong>{{$name}}</strong>,</p>
        <p>Chúng tôi đã nhận được tin nhắn của bạn với nội dung:</p>
        <blockquote style="font-style: italic; background-color: #f9f9f9; padding: 10px; border-left: 4px solid #007BFF;">
            "{{$content}}"
        </blockquote>
        <p>Chúng tôi xin trả lời như sau:</p>
        <p><strong>{{$rep}}</strong></p>
        <p>Nếu bạn cần thêm thông tin hoặc có bất kỳ câu hỏi nào, vui lòng liên hệ lại với chúng tôi qua email hoặc số điện thoại bên dưới.</p>
        <p>Trân trọng,</p>
        <p><strong>Admin của shop</strong></p>
    </div>
    <div class="footer">
        <p>Đây là email tự động. Vui lòng không trả lời email này.</p>
        <p>Liên hệ chúng tôi qua: <a href="mailto:taivdph43863@fpt.edu.vn">taivdph43863@fpt.edu.vn</a> | Hotline: 034 543 5445</p>
    </div>
</div>
</body>
</html>

