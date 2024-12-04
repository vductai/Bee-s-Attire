import './bootstrap'

const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')
console.log('sdfsdfsdfsdf')
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
            document.getElementById('giveVoucherContent').innerHTML = `
                <p class="text-center">Bạn đã được tặng 1 mã giảm giá chào mừng, hãy dùng ngay</p>
                <p class="text-center"><strong>Mã Voucher:</strong> NEWBIE</p>
                <p class="text-center"><strong>Giảm giá:</strong> 10%</p>
                <p class="text-center"><strong>Hạn sử dụng:</strong> ${formattedDate}</p>
            `
            const giveModal = new bootstrap.Modal(document.getElementById('giveVoucherModal'))
            giveModal.show();
        })
})
