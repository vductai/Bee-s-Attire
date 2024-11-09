import './bootstrap';




const tableUser = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]
const tableProduct = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]
if (tableProduct){
    tableProduct.addEventListener('click', function (e) {
        if (e.target.classList.contains('toggleButton')){
            const row = e.target.closest('tr');
            const productId = row.getAttribute('data-id');
            axios.post(`/admin/actionProduct/${productId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => {
                const badgeProduct = row.querySelector('.badgeProduct')
                const toggleButton = row.querySelector('.toggleButton')

                if (badgeProduct && toggleButton){
                    if (badgeProduct.classList.contains('text-success')){
                        badgeProduct.innerHTML = 'Private'
                        badgeProduct.classList.remove('text-success')
                        badgeProduct.classList.add('text-danger')
                        toggleButton.innerHTML = 'Public'
                    }else {
                        badgeProduct.innerHTML = 'Public'
                        badgeProduct.classList.remove('text-danger')
                        badgeProduct.classList.add('text-success')
                        toggleButton.innerHTML = 'Private'
                    }
                }
            })
        }
    })
}






if (tableUser) {
    tableUser.addEventListener('click', function (e) {
        if (e.target.classList.contains('statusToggle')) {
            const row = e.target.closest('tr');  // Tìm hàng (row) gần nhất
            const userId = row.getAttribute('data-id');  // Lấy userId từ hàng

            axios.post(`/admin/action/${userId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => {
                const statusBadge = row.querySelector('.statusBadge');
                const statusButton = row.querySelector('.statusToggle');

                if (statusBadge && statusButton) {
                    if (statusBadge.classList.contains('text-success')) {
                        statusBadge.innerHTML = 'Tạm khoá';
                        statusBadge.classList.remove('text-success');
                        statusBadge.classList.add('text-danger');
                        statusButton.innerHTML = 'Mở khoá';
                    } else {
                        statusBadge.innerHTML = 'Đang hoạt động';
                        statusBadge.classList.remove('text-danger');
                        statusBadge.classList.add('text-success');
                        statusButton.innerHTML = 'Khoá tài khoản';
                    }
                }
            });
        }
    });
}



