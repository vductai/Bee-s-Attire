import './bootstrap';
import axios from "axios";
const formAddCart = document.getElementById('formAddCart')
if (formAddCart){
    formAddCart.addEventListener('submit', function (e) {
        e.preventDefault()
        document.getElementById('errCart').innerHTML = ''
        const idVariant = document.getElementById('selected-product-variant-id').value;
        const idProduct = document.getElementById('product_id').value;
        const sale_price = document.getElementById('sale_price').value;
        const user_id = document.getElementById('user_id').value;
        const quantity = document.querySelector('.quantity').value;
        axios.post(`/addCart`,{
            product_id: idProduct,
            sale_price: sale_price,
            user_id: user_id,
            product_variant_id: idVariant,
            quantity: quantity
        },{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res =>{
            const data = res.data
            if (data.success === false){
                document.getElementById('errCart').innerHTML = `
                    <div class="alert alert-danger">${data.message}</div>
                `
            }else {
                Swal.fire({
                    title: "Thêm thành công",
                    icon: "success",
                    timer: 3000,
                    timerProgressBar: true,
                });
            }
        });
    })
}


/*---------------------------------- deleete cart -------------------------------------------------------------*/
const tableCart = document.getElementById('cart-table').getElementsByTagName('tbody')[0]
tableCart.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-cart')){
        const cartId = e.target.getAttribute('data-id')
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: 'Xóa mục này sẽ không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed){
                axios.delete(`/deleteCart/${cartId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(() => {
                    const row = document.querySelector(`tr[data-id='${cartId}']`)
                    if (row){
                        row.remove()
                    }
                }).catch((error) => {
                    if (error.response) {
                        alert(error.response.data.message);
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại sau.');
                    }
                });
            }
        })
    }
})