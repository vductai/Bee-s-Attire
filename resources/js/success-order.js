import './bootstrap'

// khi ấn nút hủy
document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
    button.addEventListener('click', function () {
        // Lấy order_id
        const orderId = this.getAttribute('data-orderId');
        // Cập nhật giá trị order_id
        const confirmButton = document.querySelector('#submitSuccess');
        confirmButton.setAttribute('data-orderId', orderId);
    });
});
// đóng modal
document.querySelector('#submitSuccess').addEventListener('click', function () {
    const successModal = bootstrap.Modal.getInstance(document.getElementById('successOrderModal'));
    successModal.hide();
});

const successItem = document.querySelectorAll('.success-order');
if (successItem) {
    successItem.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault()
            const id = item.dataset.orderid
            axios.post(`/order/${id}/success`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                document.querySelector(`.cancel[data-badgeId='${id}']`).innerText = 'Đã nhận được hàng'
                document.querySelector(`.successOrder[data-orderId='${id}']`).innerText = 'Đã nhận được hàng'
                document.querySelector(`.successOrder[data-orderId='${id}']`).classList.remove('bg-success')
                document.querySelector(`.successOrder[data-orderId='${id}']`).classList.add('bg-secondary')
                document.querySelector(`.successOrder[data-orderId='${id}']`).classList.add('disabled')
            });
        })
    })
}

