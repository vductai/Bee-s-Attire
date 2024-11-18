import './bootstrap';

const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')

Echo.private(`orders.${userId}`)
    .listen('OrderEvent', (e) => {
        resetOrderState()
        document.getElementById('paymentContent').innerHTML =
            `
            <p class="text-center">Cảm ơn bạn vì đã tin tưởng và mua hàng của chúng tôi.</p>
            <p class="text-center">Vui lòng kiểm tra email để nhận được thông tin về đơn hàng.</p>
        `;
        const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        paymentModal.show();
        document.getElementById('noti-badge').style.display = 'inline';
    })

function resetOrderState() {
    document.getElementById('paymentContent').innerHTML = '';
    // kiểm tra modal
    const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
    if (paymentModal) {
        paymentModal.hide();
    }
}


/*------------------------------------------ cancel order ------------------------------------------------------------*/
const cancelItem = document.querySelectorAll('.cancel-order');
if (cancelItem) {
    cancelItem.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault()
            const id = item.dataset.orderid
            axios.post(`/order/${id}/cancel`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                document.querySelector(`.cancel[data-badgeId='${id}']`).innerText = 'Đã yêu cầu huỷ'
                document.querySelector(`.cancel-order[data-orderId='${id}']`).innerText = 'Đã gửi yêu cầu huỷ đơn'
                document.querySelector(`.cancel-order[data-orderId='${id}']`).classList.remove('bg-danger')
                document.querySelector(`.cancel-order[data-orderId='${id}']`).classList.add('disabled')
            });
        })
    })
}
