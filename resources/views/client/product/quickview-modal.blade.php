<style>
    .voucher-card {
        border: 2px dashed #FFA500; /* Đường viền gạch */
        padding: 15px;
        width: 200px; /* Giảm kích thước chiều rộng */
        text-align: center;
        background-color: #fdf8e1; /* Màu nền nhẹ */
        font-family: Arial, sans-serif;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng */
    }

    .voucher-title {
        font-size: 18px; /* Giảm kích thước chữ */
        font-weight: bold;
        color: #FF4500; /* Màu chữ nổi bật */
    }

    .voucher-discount {
        font-size: 24px; /* Giảm kích thước chữ */
        font-weight: bold;
        color: #32CD32; /* Màu cho phần giảm giá */
        margin: 10px 0;
    }

    .voucher-expiry {
        font-size: 12px; /* Giảm kích thước chữ */
        color: #666;
    }

    .voucher-details {
        font-size: 14px; /* Giảm kích thước chữ */
        color: #333;
        margin-top: 10px;
    }

    /* Nút sử dụng hình chữ nhật */
    .use-btn {
        background-color: #FF4500;
        color: white;
        padding: 8px 15px; /* Giảm kích thước nút */
        border: none;
        cursor: pointer;
        font-size: 14px; /* Giảm kích thước chữ */
        margin-top: 10px;
        width: 100%; /* Chiều rộng của nút bằng 100% */
        transition: background-color 0.3s ease;
    }

    .use-btn:hover {
        background-color: #e63900; /* Màu khi hover */
    }
</style>
<div class="modal fade quickview-modal" id="quickview" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered cr-modal-dialog">
        <div class="modal-content">
            <button type="button" class="cr-close-model btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($voucher as $item)
                            <div class="col">
                                <div class="voucher-card">
                                    <div class="voucher-title">{{$item->voucher_desc}}</div>
                                    <div class="voucher-discount">{{$item->voucher_price}}% OFF</div>
                                    <div class="voucher-details">Use code: <strong>{{$item->voucher_code}}</strong></div>
                                    <div class="voucher-expiry mb-3">Expires on: {{$item->end_date}}</div>
                                    <button class="use-btn" data-copys="{{$item->voucher_code}}">Copy code</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
