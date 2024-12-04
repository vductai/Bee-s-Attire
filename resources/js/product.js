import './bootstrap';


/*-------------------------------------------------------- update ---------------------------------------------------------*/
const formUpdatePro = document.getElementById('formUpdatePro')
if (formUpdatePro) {
    formUpdatePro.addEventListener('submit', (e) => {
        e.preventDefault()
        const loadModal = new bootstrap.Modal(document.getElementById('loadModal'))
        loadModal.show()
        document.querySelectorAll('.proErr').forEach(function (p) {
            p.textContent = '';
        });
        const idPro = document.getElementById('idProductUpdate').value
        console.log(idPro)
        const productName = document.querySelector('input[name="product_name"]').value;
        const categoryId = document.querySelector('select[name="category_id"]').value;
        const productPrice = document.querySelector('input[name="product_price"]').value;
        const salePrice = document.querySelector('input[name="sale_price"]').value;
        const productDesc = document.querySelector('textarea[name="product_desc"]').value;
        const slug = document.querySelector('input[name="slug"]').value

        const productAvatar = document.querySelector('input[name="product_avatar"]').files[0];
        const productImages = document.querySelectorAll('input[name="product_images[]"]');

        const formUpdate = new FormData()
        formUpdate.append('product_id', idPro);
        formUpdate.append('product_name', productName);
        formUpdate.append('category_id', categoryId);
        formUpdate.append('product_price', productPrice);
        formUpdate.append('sale_price', salePrice);
        formUpdate.append('product_desc', productDesc);
        formUpdate.append('slug', slug)
        formUpdate.append('_method', 'PUT')
        // Gắn ảnh chính (nếu có)
        if (productAvatar) {
            formUpdate.append('product_avatar', productAvatar);
        }
        // Gắn các ảnh phụ (nếu có)
        productImages.forEach((input, index) => {
            if (input.files[0]) {
                formUpdate.append(`product_images[${index}]`, input.files[0]);
            }
        });
        axios.post(`/admin/product/${idPro}`, formUpdate, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'multipart/form-data'
            }
        }).then(res => {
            const data = res.data
            if (data.success === false){
                loadModal.hide()
                document.getElementById('sale_price-error').textContent = data.messages
            }else {
                window.location.href = '/admin/product'
            }
        }).catch(err => {
            loadModal.hide()
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })

    })
}

/*--------------------------------------------------- product ----------------------------------------------*/
const productForm = document.getElementById('product-form')
if (productForm) {
    productForm.addEventListener('submit', function (e) {
        e.preventDefault()
        const loadModal = new bootstrap.Modal(document.getElementById('loadModal'))
        loadModal.show()
        document.querySelectorAll('.proErr').forEach(function (p) {
            p.textContent = '';
        });
        const form = document.getElementById('product-form')
        const desc = document.querySelector('#product_desc');
        const formData = new FormData(form)
        axios.post('/admin/product', formData, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
            if (data.success === false){
                loadModal.hide()
                document.getElementById('sale_price-error').textContent = data.messages
            }else {
                window.location.href = '/admin/product'
            }
        }).catch(err => {
            loadModal.hide()
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}

