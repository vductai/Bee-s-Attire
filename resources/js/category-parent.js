// create
import axios from "axios";

const formCategoryParent = document.getElementById('formCategoryParent')
const categoryMain = document.getElementById('category_main')
const tableParent = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]

if (formCategoryParent) {
    formCategoryParent.addEventListener('submit', function (e) {
        e.preventDefault()
        const name = categoryMain.value
        axios.post('/admin/category-parent', {
            category_main: name
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
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
                                <button class="dropdown-item delete-btn" data-id="${data.id}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                `
        }).catch(err => {

        })
    })
}

// update
const formCategoryParentUpdate = document.getElementById('formCategoryParentUpdate')
if (formCategoryParentUpdate){
    formCategoryParentUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        const nameUpdate = document.getElementById('category_main')
        const id = document.getElementById('idParent').value
        axios.put(`/admin/category-parent/${id}`, {
            category_main: nameUpdate.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res =>{
            const data = res.data
            const row = document.querySelector(`tr[data-id = '${data.id}']`)
            if (row){
                row.querySelector('.categoryParent').textContent = data.name
            }
            nameUpdate.value = ''
        })
    })
}

// delete
tableParent.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')){
        const id = e.target.getAttribute('data-id')
        axios.delete(`/admin/category-parent/${id}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() =>{
            const row = document.querySelector(`tr[data-id='${id}']`)
            if (row){
                row.remove()
            }
        })
    }
})
