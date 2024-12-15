// create
import axios from "axios";

const formCategoryParent = document.getElementById('formCategoryParent')
const categoryMain = document.getElementById('category_main')
const tableParent = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]

if (formCategoryParent) {
    formCategoryParent.addEventListener('submit', function (e) {
        e.preventDefault()
        document.querySelector('.errs').textContent = ''
        const name = categoryMain.value
        axios.post('/admin/category-parent', {
            category_main: name
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
            if (data.success === false) {
                document.querySelector('.errs').textContent = data.message
            } else {
                const lastRow = tableParent.querySelector('tr:last-child');
                let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
                if (lastRow) {
                    const lastSttCell = lastRow.querySelector('td:first-child');
                    stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
                }
                const newRow = tableParent.insertRow();
                newRow.setAttribute('data-id', data.id)
                newRow.innerHTML =
                    `
                    <td>${stt}</td>
                    <td class="categoryParent">${data.name}</td>
                    <td>
                        <div>
                            <button type="button"
                                    class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" data-display="static">
                                    <span class="sr-only"><i class="ri-settings-3-line"></i></span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/category-parent/${data.id}/edit">Edit</a>
                                <button class="dropdown-item delete-parent" data-id="${data.id}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                `
            }
        }).catch(err => {
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}

// update
const formCategoryParentUpdate = document.getElementById('formCategoryParentUpdate')
if (formCategoryParentUpdate) {
    formCategoryParentUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        document.querySelector('.errs').textContent = ''
        const nameUpdate = document.getElementById('category_main')
        const id = document.getElementById('idParent').value
        axios.put(`/admin/category-parent/${id}`, {
            category_main: nameUpdate.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
            if (data.success === false) {
                document.querySelector('.errs').textContent = data.message
            } else {
                const row = document.querySelector(`tr[data-id = '${data.id}']`)
                if (row) {
                    row.querySelector('.categoryParent').textContent = data.name
                }
                nameUpdate.value = ''
            }
        }).catch(err => {
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}

// delete
tableParent.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-parent')) {
        const id = e.target.getAttribute('data-id')
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: 'Xóa mục này sẽ không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/admin/category-parent/${id}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(() => {
                    const row = document.querySelector(`tr[data-id='${id}']`)
                    if (row) {
                        row.remove()
                    }
                }).catch((error) => {
                    if (error.response) {
                        Swal.fire({
                            icon: "error",
                            text: `${error.response.data.message}`
                        });
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại sau.');
                    }
                });
            }
        });
    }
})
