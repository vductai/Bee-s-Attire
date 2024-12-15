import './bootstrap'

const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')
document.addEventListener('DOMContentLoaded', function () {
    Echo.private(`give-voucher.${userId}`)
        .listen('GiveVoucherEvent', function (e) {
            // Lấy ngày hiện tại
            const today = new Date();
            // Tính ngày 3 ngày sau
            const threeDaysLater = new Date();
            threeDaysLater.setDate(today.getDate() + 3);
            // Định dạng ngày theo dạng d-m-Y
            const formattedDate =
                `${threeDaysLater.getDate().toString().padStart(2, '0')}-${(threeDaysLater.getMonth() + 1).toString().padStart(2, '0')}-${threeDaysLater.getFullYear()}`;
            Swal.fire({
                title: "Chúc mừng",
                html: `
                    <p class="text-center">Bạn đã được tặng 1 mã giảm giá chào mừng, hãy dùng ngay</p> <br>
                    <p class="text-center"><strong>Mã Voucher:</strong> NEWBIE</p> <br>
                    <p class="text-center"><strong>Giảm giá:</strong> 10%</p> <br>
                    <p class="text-center"><strong>Hạn sử dụng:</strong> ${formattedDate}</p>
                `,
            });
        })
})
