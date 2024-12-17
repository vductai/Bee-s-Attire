import './bootstrap';
import Swal from 'sweetalert2';

const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')

Echo.private(`orders.${userId}`)
    .listen('OrderEvent', (e) => {
        Swal.fire({
            icon: "success",
            title: "Đặt hàng thành công",
            html: `
                  <p class="text-center">Cảm ơn bạn vì đã tin tưởng và mua hàng của chúng tôi.</p>
                  <p class="text-center">Vui lòng kiểm tra email để nhận được thông tin về đơn hàng.</p>
            `
        })
        document.getElementById('noti-badge').style.display = 'inline';
    })


/*------------------------------------------ cancel order ------------------------------------------------------------*/
// khi ấn nút hủy
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
    button.addEventListener('click', function () {
        // Lấy order_id
        const orderId = this.getAttribute('data-orderId');
        // Cập nhật giá trị order_id
        const confirmButton = document.querySelector('#submitCancel');
        confirmButton.setAttribute('data-orderId', orderId);
    });
});
// đóng modal
document.querySelector('#submitCancel').addEventListener('click', function () {
    const cancelModal = bootstrap.Modal.getInstance(document.getElementById('cancelOrderModal'));
    cancelModal.hide();
});
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
                if (res.data.success === false) {
                    document.getElementById('contentClientModal').innerHTML = `
                        <p class="text-center">Bạn không thể hủy đơn hàng này</p>
                    `
                    const errorsModal = new bootstrap.Modal(document.getElementById('errorClientModal'))
                    errorsModal.show()
                } else {
                    document.querySelector(`.cancel[data-badgeId='${id}']`).innerText = 'Đã yêu cầu huỷ'
                    document.querySelector(`.modalCanner[data-orderId='${id}']`).innerText = 'Đã gửi yêu cầu huỷ đơn'
                    document.querySelector(`.modalCanner[data-orderId='${id}']`).classList.remove('bg-danger')
                    document.querySelector(`.modalCanner[data-orderId='${id}']`).classList.add('disabled')
                }
            });
        })
    })
}
