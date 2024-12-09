import './bootstrap';



const formVoucher = document.getElementById('formVoucher')
const tableVoucher = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]

if (formVoucher) {
    formVoucher.addEventListener('submit', function (e) {
        e.preventDefault()
        const voucherCode = document.getElementById('voucher_code')
        const voucherPrice = document.getElementById('voucher_price')
        /*const quantity = document.getElementById('quantity')
        const startDate = document.getElementById('start_date')
        const endDate = document.getElementById('end_date')*/
        const voucherDesc = document.getElementById('voucher_desc')
        const maxDiscount = document.getElementById('max_discount')

        // xoá các lỗi nếu có
        document.querySelectorAll('.error-text').forEach(function(p) {
            p.textContent = '';
        });


        axios.post('/admin/coupon', {
            voucher_code: voucherCode.value,
            voucher_price: voucherPrice.value,
            /*quantity: quantity.value,
            start_date: startDate.value,
            end_date: endDate.value,*/
            voucher_desc: voucherDesc.value,
            max_discount: maxDiscount.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const voucher = res.data
            function formatCurrencyVND(amount) {
                // Kiểm tra nếu không phải số
                if (isNaN(amount)) {
                    return "0 đ";
                }
                return new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0, // Không hiển thị phần thập phân
                }).format(amount).replace("₫", "đ"); // Thay thế ký hiệu ₫ bằng đ
            }
            // Lấy số thứ tự của hàng cuối cùng
            const lastRow = tableVoucher.querySelector('tr:last-child');
            let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
            if (lastRow) {
                const lastSttCell = lastRow.querySelector('td:first-child');
                stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
            }
            const newRow = tableVoucher.insertRow();
            newRow.setAttribute('data-id', voucher.voucher_id)
            newRow.innerHTML =
                `
                    <td>${stt}</td>
                    <td class="voucher_code">${voucher.voucher_code}</td>
                    <td class="voucher_price">${voucher.voucher_price} %</td>
                    <td class="max_discount">${formatCurrencyVND(voucher.max_discount)}</td>
                    <td class="voucher_desc">${voucher.voucher_desc}</td>
                    <td>
                        <div>
                            <button type="button"
                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" data-display="static">
                            <span class="sr-only">
                                <i class="ri-settings-3-line"></i>
                            </span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/coupon/${voucher.voucher_id}/edit">Sửa</a>
                                <button class="dropdown-item delete-coupon" data-id="${voucher.voucher_id}">Xóa</button>
                            </div>
                        </div>
                    </td>
                `;
            voucherCode.value = ''
            voucherPrice.value = ''
            voucherDesc.value = ''
            maxDiscount.value = ''
        }).catch(err =>{
            if (err.response && err.response.data.errors){
                let errors = err.response.data.errors
                for (let field in errors){
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}

// update
const formVoucherUpdate = document.getElementById('formVoucherUpdate')

if (formVoucherUpdate){
    formVoucherUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        const voucherId = document.getElementById('voucherId').value
        const voucherCodeUpdate = document.getElementById('voucher_code')
        const voucherPriceUpdate = document.getElementById('voucher_price')
        /*const quantityUpdate = document.getElementById('quantity')
        const startDateUpdate = document.getElementById('start_date')
        const endDateUpdate = document.getElementById('end_date')*/
        const voucherDescUpdate = document.getElementById('voucher_desc')
        const maxDiscountUpdate = document.getElementById('max_discount')

        document.querySelectorAll('.error-text').forEach(function(p) {
            p.textContent = '';
        });

        axios.put(`/admin/coupon/${voucherId}`, {
            voucher_code: voucherCodeUpdate.value,
            voucher_price: voucherPriceUpdate.value,
            voucher_desc: voucherDescUpdate.value,
            max_discount: maxDiscountUpdate.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const voucher = res.data
            function formatCurrencyVND(amount) {
                // Kiểm tra nếu không phải số
                if (isNaN(amount)) {
                    return "0 đ";
                }
                return new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                    minimumFractionDigits: 0, // Không hiển thị phần thập phân
                }).format(amount).replace("₫", "đ"); // Thay thế ký hiệu ₫ bằng đ
            }
            const row = document.querySelector(`tr[data-id='${voucherId}']`)
            if (row){
                row.querySelector('.voucherCode').textContent = voucher.voucher_code
                row.querySelector('.voucherPrice').textContent = `${voucher.voucher_price} %`
                row.querySelector('.voucherDesc').textContent = voucher.voucher_desc
                row.querySelector('.max_discount').textContent = `${formatCurrencyVND(voucher.max_discount)}`
/*                row.querySelector('.quantity').textContent = voucher.quantity
                row.querySelector('.startDate').textContent = voucher.start_date
                row.querySelector('.endDate').textContent = voucher.end_date*/
            }
            voucherCodeUpdate.value = ''
            voucherPriceUpdate.value = ''
            /*startDateUpdate.value = ''
            quantityUpdate.value = ''
            endDateUpdate.value = ''*/
            voucherDescUpdate.value = ''
            maxDiscountUpdate.value = ''
        }).catch(err =>{
            if (err.response && err.response.data.errors){
                let errors = err.response.data.errors
                for (let field in errors){
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}


tableVoucher.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-coupon')){
        const voucherId = e.target.getAttribute('data-id')
        const isConfirmed = window.confirm('Bạn có chắc chắn muốn xóa mục này không?');
        if (!isConfirmed){
            return;
        }
        axios.delete(`/admin/coupon/${voucherId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            const row = document.querySelector(`tr[data-id='${voucherId}']`)
            if (row){
                row.remove()
            }
        })
    }
})
