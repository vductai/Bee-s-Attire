import './bootstrap';
import axios from "axios";

const formVariant = document.getElementById('formVariant');

if (formVariant) {
    formVariant.addEventListener('submit', function(e) {
        e.preventDefault();

        const productName = document.getElementById('product_name');
        const color = document.getElementById('color_code');
        const size = document.getElementById('size_name'); 
        const quantity = document.getElementById('quantity');

        // Gửi dữ liệu
        const createVariant = new FormData();
        createVariant.append('product_name', productName.value);
        createVariant.append('color_code', color.value);
        createVariant.append('size_name', size.value);
        createVariant.append('quantity', quantity.value);

        axios.post('/admin/product-variant', createVariant, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            })
            .then(res => {
                const data = res.data;
                window.location.href = '/admin/product-variant'; 
            }).catch(err => {
                if (err.response && err.response.data.errors) {
                    let errors = err.response.data.errors;
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