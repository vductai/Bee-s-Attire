import './bootstrap';


const formCategory = document.getElementById('formCategory')
const category_name_create = document.getElementById('category_name')
const category_parent_create = document.getElementById('id')
const tableCategory = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]

if (formCategory) {
    formCategory.addEventListener('submit', function (e) {
        e.preventDefault()
        const name = category_name_create.value;
        const id = category_parent_create.value;
        // kiểm tra coi hiện lỗi chưa
        const errorMessage = document.querySelector('#errCategory');
        if (errorMessage) {
            errorMessage.remove()
        };
        axios.post('/admin/categories', {
            category_name: name,
            id: id
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            if (res.data.success === false){
                document.getElementById('errsss').textContent = res.data.message
            }else {
                const category = res.data
                // Lấy số thứ tự của hàng cuối cùng
                const lastRow = tableCategory.querySelector('tr:last-child');
                let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
                if (lastRow) {
                    const lastSttCell = lastRow.querySelector('td:first-child');
                    stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
                }
                const newRow = tableCategory.insertRow()
                newRow.setAttribute('data-id', category.category.category_id)
                newRow.innerHTML =
                    `
                    <td>${stt}</td>
                    <td>${category.category.category_name}</td>
                    <td>${category.parent.name}</td>
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
                                <a class="dropdown-item" href="/admin/categories/${category.category.category_id}/edit">Edit</a>
                                <button class="dropdown-item delete-cate" data-id="${category.category.category_id}">Delete</button>
                            </div>
                        </div>
                    </td>
            `;
                category_name_create.value = '';
            }
        }).catch(error => {
            // kiểm tra xem có phản hồi lỗi ko, 422: dữ liệu gửi lên ko hợp lệ
            if (error.response && error.response.status === 422){
                // lấy các lỗi từ server
                const errors = error.response.data.errors
                // kiểm tra có lỗi liên quan không
                if (errors.category_name){
                    // kiểm tra nếu thẻ tồn tại thì lưu trữ biến
                    let errorElement = document.querySelector('#errCategory');
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errCategory'
                        errorElement.classList.add('text-danger');
                        // chèn thẻ p sau trường input
                        category_name_create.insertAdjacentElement('afterend', errorElement)
                    }
                    // gán lỗi
                    errorElement.textContent = errors.category_name[0]
                }
            }
        })
    })
}

// update
const formCategoryUpdate = document.getElementById('formCategoryUpdate')
const category_name_update = document.getElementById('category_name')
const category_parent_update = document.getElementById('id')

if (formCategoryUpdate){
    formCategoryUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        const category_id = document.getElementById('category_id').value
        const name = category_name_update.value
        const id = category_parent_update.value
        const errorMessage = document.querySelector('#errCategory');
        if (errorMessage) {
            errorMessage.remove()
        };
        axios.put(`/admin/categories/${category_id}`, {
            category_name: name,
            id: id
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            if (res.data.success === false){
                document.getElementById('errsss').textContent = res.data.message
            }else {
                const category = res.data
                const row = document.querySelector(`tr[data-id='${category_id}']`)
                if (row){
                    row.querySelector('.categoryName').textContent = category.category.category_name
                    row.querySelector('.categoryParent').textContent = category.parent.name
                }
                category_name_update.value = '';
                category_parent_update.value = '';
            }
        }).catch(error => {
            if (error.response && error.response.status === 422){
                const errors = error.response.data.errors
                if (errors.category_name){
                    let errorElement = document.querySelector('#errCategory');
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errCategory'
                        errorElement.classList.add('text-danger');
                        category_name_create.insertAdjacentElement('afterend', errorElement)
                    }
                    errorElement.textContent = errors.category_name[0]
                }
            }
        })


    })
}

tableCategory.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-cate')){
        const categoryId = e.target.getAttribute('data-id')
        axios.delete(`/admin/categories/${categoryId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            const row = document.querySelector(`tr[data-id='${categoryId}']`)
            if (row){
                row.remove()
            }
        })
    }
})

