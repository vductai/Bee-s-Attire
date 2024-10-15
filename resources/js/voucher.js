import './bootstrap';
import axios from "axios";



const formVoucher = document.getElementById('formVoucher')
const tableVoucher = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]

if (formVoucher) {
    formVoucher.addEventListener('submit', function (e) {
        e.preventDefault()
        const voucherCode = document.getElementById('voucher_code')
        const voucherPrice = document.getElementById('voucher_price')
        const startDate = document.getElementById('start_date')
        const endDate = document.getElementById('end_date')
        const voucherDesc = document.getElementById('voucher_desc')

        // xoá các lỗi nếu có
        document.querySelectorAll('.error-text').forEach(function(p) {
            p.textContent = '';
        });


        axios.post('/admin/coupon', {
            voucher_code: voucherCode.value,
            voucher_price: voucherPrice.value,
            start_date: startDate.value,
            end_date: endDate.value,
            voucher_desc: voucherDesc.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const voucher = res.data
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
                    <td class="voucher_price">${voucher.voucher_price}</td>
                    <td class="voucher_desc">${voucher.voucher_desc}</td>
                    <td class="start_date">${voucher.start_date}</td>
                    <td class="end_date">${voucher.end_date}</td>
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
                                <a class="dropdown-item" href="/admin/coupon/${voucher.voucher_id}/edit">Edit</a>
                                <button class="dropdown-item delete-btn" data-id="${voucher.voucher_id}">Delete</button>
                            </div>
                        </div>
                    </td>
                `;
            voucherCode.value = ''
            voucherPrice.value = ''
            startDate.value = ''
            endDate.value = ''
            voucherDesc.value = ''
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
        const startDateUpdate = document.getElementById('start_date')
        const endDateUpdate = document.getElementById('end_date')
        const voucherDescUpdate = document.getElementById('voucher_desc')

        document.querySelectorAll('.error-text').forEach(function(p) {
            p.textContent = '';
        });

        axios.put(`/admin/coupon/${voucherId}`, {
            voucher_code: voucherCodeUpdate.value,
            voucher_price: voucherPriceUpdate.value,
            start_date: startDateUpdate.value,
            end_date: endDateUpdate.value,
            voucher_desc: voucherDescUpdate.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const voucher = res.data
            console.log(voucher)
            const row = document.querySelector(`tr[data-id='${voucherId}']`)
            if (row){
                row.querySelector('.voucherCode').textContent = voucher.voucher_code
                row.querySelector('.voucherPrice').textContent = voucher.voucher_price
                row.querySelector('.voucherDesc').textContent = voucher.voucher_desc
                row.querySelector('.startDate').textContent = voucher.start_date
                row.querySelector('.endDate').textContent = voucher.end_date
            }
            voucherCodeUpdate.value = ''
            voucherPriceUpdate.value = ''
            startDateUpdate.value = ''
            endDateUpdate.value = ''
            voucherDescUpdate.value = ''
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
    if (e.target.classList.contains('delete-btn')){
        const voucherId = e.target.getAttribute('data-id')
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
