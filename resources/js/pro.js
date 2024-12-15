import './bootstrap';






document.addEventListener('DOMContentLoaded', () => {
    const tableProduct = document.querySelector('.propro').getElementsByTagName('tbody')[0]
    if (tableProduct){
        tableProduct.addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-pro')){
                const productId = e.target.getAttribute('data-id')
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: 'Xóa mục này sẽ không thể hoàn tác!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/admin/product/${productId}`, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        }).then(() => {
                            const row = document.querySelector(`tr[data-id='${productId}']`)
                            if (row){
                                row.remove()
                            }
                        })
                    }
                });
            }
        })
    }

})
