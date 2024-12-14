<style>
    .body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    #cartModal .modal-content {
        border-radius: 12px;
        padding: 20px;
        max-width: 445px;
        margin-left: 245px;
    }

    #cartModal .modal-body {
        text-align: center;
        padding: 20px;
    }

    .checkmark-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto;
    }

    .checkmark {
        width: 100%;
        height: 100%;
        stroke-width: 2;
        stroke: #4CAF50;
        stroke-miterlimit: 10;
        fill: none;
    }

    .checkmark-circle {
        stroke-dasharray: 157;
        stroke-dashoffset: 157;
        stroke-width: 2;
        animation: draw-circle 0.6s ease-in-out forwards;
    }

    .checkmark-check {
        stroke-dasharray: 36;
        stroke-dashoffset: 36;
        stroke-width: 3;
        stroke-linecap: round;
        animation: draw-check 0.4s ease-in-out 0.6s forwards;
    }

    @keyframes draw-circle {
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes draw-check {
        to {
            stroke-dashoffset: 0;
        }
    }

    .success-message {
        font-size: 16px;
        color: #4CAF50;
        margin-top: 10px;
        font-weight: bold;
    }
</style>
<div class="modal fade quickview-modal" id="cartModal"
     tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered cr-modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="cartContent">
                <div class="body">
                    <div class="checkmark-wrapper">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark-check" fill="none" d="M16 26l7 7 13-13"/>
                        </svg>
                    </div>
                </div>
                <div class="success-message">Thêm vào giỏ hàng thành công</div>
            </div>
        </div>
    </div>
</div>
