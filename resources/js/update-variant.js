import './bootstrap';

const variants = document.querySelectorAll('.variants');
const tableVariant = document.querySelector('.table-variant').getElementsByTagName('tbody')[0];
if (tableVariant) {
    tableVariant.addEventListener('click', function (e) {
        if (e.target.classList.contains('variants')) {
            e.preventDefault()
            const idVariant = e.target.dataset.idvariant;
            axios.get(`/admin/product-variant/${idVariant}/edit`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                const data = res.data
                console.log(data)
                // Cập nhật chọn giá trị trong select size
                const sizeSelect = document.getElementById('size_id1');
                const sizeOptions = sizeSelect.querySelectorAll('option');
                sizeOptions.forEach(option => {
                    if (option.textContent.trim() === data.size.trim()) {
                        option.selected = true;
                    }
                });
                // Cập nhật chọn giá trị trong select color
                const colorSelect = document.getElementById('color_id1');
                const colorOptions = colorSelect.querySelectorAll('option');
                colorOptions.forEach(option => {
                    if (option.textContent.trim() === data.color.trim()) {
                        option.selected = true;
                    }
                });
                document.getElementById('quantity1').value = data.quantity
                document.getElementById('idVariant').value = data.idVariant
            })
        }
    })
}
// form thêm
const formVariant = document.getElementById('formProductVariant');
if (formVariant) {
    formVariant.addEventListener('submit', function (e) {
        e.preventDefault();

        const idProduct = document.getElementById('idProduct').value;
        const sizeId = document.getElementById('size_id').value;
        const colorId = document.getElementById('color_id').value;
        const quantity = document.getElementById('quantity').value;

        // Xóa các thông báo lỗi trước đó
        document.querySelectorAll('.error-text').forEach(function (p) {
            p.textContent = '';
        });

        axios.post('/admin/product-variant', {
            product_id: idProduct,
            size_id: sizeId,
            color_id: colorId,
            quantity: quantity
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const variant = res.data.data;
            console.log(variant)
            // Lấy STT hiện tại
            const lastRow = tableVariant.querySelector('tr:last-child');
            let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
            if (lastRow) {
                const lastSttCell = lastRow.querySelector('td:first-child');
                stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
            }
            // Tạo hàng mới
            let newRow = tableVariant.insertRow();
            newRow.setAttribute('data-id', variant.id);
            newRow.innerHTML = `
                <td>${stt}</td>
                <td class="color_id">${variant.color}</td>
                <td class="size_id">Size ${variant.size}</td>
                <td class="quantity">${variant.quantity}</td>
                <td>
                    <div>
                        <button type="button"
                                class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" data-display="static">
                            <span class="sr-only"><i class="ri-settings-3-line"></i></span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item variants"
                               data-idVariant="${variant.id}"
                               data-bs-toggle="modal"
                               data-bs-target="#variantModal"
                               href="javascript:void(0)">Sửa</a>
                            <button class="dropdown-item delete-variant"
                                    data-id="${variant.id}">Xóa</button>
                        </div>
                    </div>
                </td>
            `;
            // Reset form
            document.getElementById('size_id').value = '';
            document.getElementById('color_id').value = '';
            document.getElementById('quantity').value = '';

        }).catch(err => {
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors;
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        });
    });
}

const formUpdateVariant = document.getElementById('form-update-variant')
if (formUpdateVariant) {
    formUpdateVariant.addEventListener('submit', function (e) {
        e.preventDefault()
        const idVariantUpdate = document.getElementById('idVariant').value;
        const productIdUpdate = document.getElementById('idProduct').value;
        const sizeIdUpdate = document.getElementById('size_id1').value;
        const colorIdUpdate = document.getElementById('color_id1').value;
        const quantityUpdate = document.getElementById('quantity1').value;
        document.querySelectorAll('.error-variant').forEach(p => {
            p.textContent = ''
        })
        axios.put(`/admin/product-variant/${idVariantUpdate}`, {
            color_id1: colorIdUpdate,
            size_id1: sizeIdUpdate,
            product_id: productIdUpdate,
            quantity1: quantityUpdate
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data.data
            console.log(data)
            const row = document.querySelector(`tr[data-id='${data.id}']`)
            if (row) {
                row.querySelector('.color_id').textContent = data.color;
                row.querySelector('.size_id').textContent = `Size ${data.size}`;
                row.querySelector('.quantity').textContent = data.quantity;
            }
        }).catch(err => {
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors;
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}


/*---------------------------------------------------- delete -------------------------------------------------------------*/
tableVariant.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains('delete-variant')) {
        const variantId = e.target.getAttribute('data-id');
        const isConfirmed = window.confirm('Bạn có chắc chắn muốn xóa mục này không?');
        if (!isConfirmed){
            return;
        }
        axios.delete(`/admin/product-variant/${variantId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            // Tìm và xóa hàng trong bảng
            const row = document.querySelector(`tr[data-id='${variantId}']`);
            if (row) {
                row.remove();
            }
        }).catch(err => {
            console.error('Có lỗi xảy ra:', err);
        });
    }
});



