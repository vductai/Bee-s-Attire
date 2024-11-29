import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.variants1').forEach(button => {
        button.addEventListener('click', function () {
            // Lấy ID của biến thể từ thuộc tính data-idVariant
            const variantId = this.getAttribute('data-idVariant');
            if (variantId) {
                axios.get(`/admin/product-variant/${variantId}`)
                    .then(res => {
                        const variant = res.data.data;
                        // Điền dữ liệu vào modal
                        document.getElementById('idVariant').value = variant.product_variant_id;
                        document.getElementById('product_id').value = variant.product_id;  // Điền product_id vào input ẩn
                        document.getElementById('size_id1').value = variant.size_id;
                        document.getElementById('color_id1').value = variant.color_id;
                        document.getElementById('quantity1').value = variant.quantity;

                    })
                    .catch(err => {
                        console.error('Có lỗi khi cập nhật biến thể:', err);
                    });
            } else {
                console.error('Không tìm thấy data-idVariant!');
            }
        });
    });


    // form update
    document.getElementById('formProductUpdate').addEventListener('submit', function (e) {
        e.preventDefault();

        const idVariant = document.getElementById('idVariant').value;
        const productId = document.getElementById('product_id').value;  // Lấy product_id
        const size_id = document.getElementById('size_id1').value;
        const color_id = document.getElementById('color_id1').value;
        const quantity = document.getElementById('quantity1').value;

        axios.put(`/admin/product-variant/${idVariant}`, {
            product_id: productId,
            size_id,
            color_id,
            quantity
        })
            .then(res => {

                const updatedVariant = res.data.data;
                // Tìm dòng trong bảng có product_variant_id tương ứng
                const row = document.querySelector(`tr[data-id='${idVariant}']`);
                if (row) {
                    // Cập nhật các ô trong dòng đó
                    row.querySelector('.size_id').textContent = updatedVariant.size.size_name;
                    row.querySelector('.color_id').textContent = updatedVariant.color.color_name;
                    row.querySelector('.quantity').textContent = updatedVariant.quantity;
                }
                const modal = bootstrap.Modal.getInstance(document.getElementById('variantModal'));
                modal.hide();
            })
            .catch(err => {
                // Xử lý lỗi từ server nếu có
                if (err.response && err.response.data && err.response.data.errors) {
                    const errors = err.response.data.errors;
                    // Lọc và hiển thị lỗi cho từng trường
                    if (errors.size_id) {
                        document.getElementById('size_id1_error').textContent = errors.size_id;
                    }
                    if (errors.color_id) {
                        document.getElementById('color_id1_error').textContent = errors.color_id;
                    }
                    if (errors.quantity) {
                        document.getElementById('quantity1_error').textContent = errors.quantity;
                    }
                } else {
                    alert('Có lỗi không xác định xảy ra.');
                }
            });
    });

});


// form thêm
const formVariant = document.getElementById('formProductVariant');
const tableVariant = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0];

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
            // Lấy STT hiện tại
            const lastRow = tableVariant.querySelector('tr:last-child');
            let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
            if (lastRow) {
                const lastSttCell = lastRow.querySelector('td:first-child');
                stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
            }
            // Tạo hàng mới
            let newRow = tableVariant.insertRow();
            newRow.setAttribute('data-id', variant.product_variant_id);
            newRow.innerHTML = `
                <td>${stt}</td>
                <td class="size_id">${variant.size.size_name}</td>
                <td class="color_id">${variant.color.color_name}</td>
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
                               data-idVariant="${variant.product_variant_id}"
                               data-bs-toggle="modal"
                               data-bs-target="#variantModal"
                               href="javascript:void(0)">Sửa</a>
                            <button class="dropdown-item delete-variant"
                                    data-id="${variant.product_variant_id}">Xóa</button>
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


// form xóa
const table = document.querySelector('#cat_data_table');
table.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-variant')) {
        const variantId = e.target.getAttribute('data-id')
        axios.post(`/admin/product-variant/${variantId}`, {
            _method: 'DELETE'
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            const row = document.querySelector(`tr[data-id='${variantId}']`);
            if (row) row.remove();
        });

    }
})



const formUpdateProduct = document.getElementById('formUpdateProduct');
if (formUpdateProduct) {
    formUpdateProduct.addEventListener('submit', function (e) {
        e.preventDefault();

        const productId = document.getElementById('productId').value;
        const productName = document.getElementById('product_name');
        const categoryId = document.getElementById('category_id');
        const productPrice = document.getElementById('product_price');
        const salePrice = document.getElementById('sale_price');
        const productDesc = document.getElementById('product_desc');
        const slug = document.getElementById('slug');
        const productAvatar = document.getElementById('product_avatar');

        let isValid = true; // Biến để kiểm tra tất cả trường

        // Xóa lỗi cũ
        document.querySelectorAll('.error-text').forEach(function (p) {
            p.textContent = '';
        });

        // Kiểm tra từng trường
        if (!productName.value) {
            document.querySelector('#product_name-error').textContent = 'Tên sản phẩm không được để trống';
            isValid = false;
        }
        if (!categoryId.value) {
            document.querySelector('#category_id-error').textContent = 'Danh mục không được để trống';
            isValid = false;
        }
        if (!productPrice.value) {
            document.querySelector('#product_price-error').textContent = 'Giá sản phẩm không được để trống';
            isValid = false;
        }
        if (!salePrice.value) {
            document.querySelector('#sale_price-error').textContent = 'Giá giảm không được để trống';
            isValid = false;
        }
        if (!productDesc.value) {
            document.querySelector('#product_desc-error').textContent = 'Mô tả sản phẩm không được để trống';
            isValid = false;
        }
        // Nếu không hợp lệ, không gửi request
        if (!isValid) return;

        // Chuẩn bị dữ liệu gửi đi
        const updateData = new FormData();
        updateData.append('product_name', productName.value);
        updateData.append('category_id', categoryId.value);
        updateData.append('product_price', productPrice.value);
        updateData.append('sale_price', salePrice.value);
        updateData.append('product_desc', productDesc.value);
        updateData.append('slug', slug.value);
        updateData.append('product_avatar', productAvatar.files[0]);

        updateData.append('_method', 'PUT');

        // Gửi request tới server
        axios.post(`/admin/product/${productId}`, updateData, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'multipart/form-data'
            }
        })
            .then(res => {
                alert('Cập nhật sản phẩm thành công!');
                window.location.href = '/admin/product';
            })
            .catch(err => {
                // Xử lý lỗi từ server
                if (err.response && err.response.data.errors) {
                    const errors = err.response.data.errors;
                    for (let field in errors) {
                        const errorElement = document.querySelector(`#${field}-error`);
                        if (errorElement) {
                            errorElement.textContent = errors[field][0];
                        }
                    }
                }
            });
    });
}
