import './bootstrap';
import axios from "axios";

const formSize = document.getElementById('formSize')
const size_name_create = document.getElementById('size_name')
const tableSize = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]

if (formSize) {
    formSize.addEventListener('submit', function (e) {
        e.preventDefault()
        const name = size_name_create.value;
        // kiểm tra coi hiện lỗi chưa
        const errorMessage = document.querySelector('#errSize');
        if (errorMessage) {
            errorMessage.remove()
        };
        axios.post('/admin/size', {
            size_name: name
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const size = res.data
            // Lấy số thứ tự của hàng cuối cùng
            const lastRow = tableSize.querySelector('tr:last-child');
            let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
            if (lastRow) {
                const lastSttCell = lastRow.querySelector('td:first-child');
                stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
            }
            const newRow = tableSize.insertRow()
            newRow.setAttribute('data-id', size.size_id)
            newRow.innerHTML =
                `
                    <td>${stt}</td>
                    <td>${size.size_name}</td>
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
                                <a class="dropdown-item" href="/admin/size/${size.size_id}/edit">Edit</a>
                                <button class="dropdown-item delete-btn" data-id="${size.size_id}">Delete</button>
                            </div>
                        </div>
                    </td>
            `;
            size_name_create.value = '';
        }).catch(error => {
            // kiểm tra xem có phản hồi lỗi ko, 422: dữ liệu gửi lên ko hợp lệ
            if (error.response && error.response.status === 422){
                // lấy các lỗi từ server
                const errors = error.response.data.errors
                // kiểm tra có lỗi liên quan không
                if (errors.size_name){
                    // kiểm tra nếu thẻ tồn tại thì lưu trữ biến
                    let errorElement = document.querySelector('#errSize');
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errSize'
                        errorElement.classList.add('text-danger');
                        // chèn thẻ p sau trường input
                        size_name_create.insertAdjacentElement('afterend', errorElement)
                    }
                    // gán lỗi
                errorElement.textContent = errors.size_name[0]
                }
            }
        })
    })
}

// update
const formSizeUpdate = document.getElementById('formSizeUpdate')
const size_name_update = document.getElementById('size_name')

if (formSizeUpdate){
    formSizeUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        const size_id = document.getElementById('size_id').value
        const name = size_name_update.value
        const errorMessage = document.querySelector('#errSize');
        if (errorMessage) {
            errorMessage.remove()
        };
        axios.put(`/admin/size/${size_id}`, {
            size_name: name
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const size = res.data
            const row = document.querySelector(`tr[data-id='${size_id}']`)
            if (row){
                row.querySelector('.sizeName').textContent = size.size_name
            }
            size_name_update.value = '';
        }).catch(error => {
            if (error.response && error.response.status === 422){
                const errors = error.response.data.errors
                if (errors.size_name){
                    let errorElement = document.querySelector('#errSize');
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errSize'
                        errorElement.classList.add('text-danger');
                        size_name_create.insertAdjacentElement('afterend', errorElement)
                    }
                    errorElement.textContent = errors.size_name[0]
                }
            }
        })


    })
}

// window.Echo.channel('sizes')
//     .listen('size-updated', (e) => {
//         const action = e.action
//         const size = e.size
//         if (action === 'create'){
//             // Lấy số thứ tự của hàng cuối cùng
//             const lastRow = tableSize.querySelector('tr:last-child');
//             let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
//             if (lastRow) {
//                 const lastSttCell = lastRow.querySelector('td:first-child');
//                 stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
//             }
//             const newRow = tableSize.insertRow()
//             newRow.setAttribute('data-id', size.size_id)
//             newRow.innerHTML =
//                 `
//                     <td>${stt}</td>
//                     <td>${size.size_name}</td>
//                     <td>
//                         <div>
//                             <button type="button"
//                                     class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
//                                     data-bs-toggle="dropdown" aria-haspopup="true"
//                                     aria-expanded="false" data-display="static">
//                             <span class="sr-only">
//                                 <i class="ri-settings-3-line"></i>
//                             </span>
//                             </button>
//                             <div class="dropdown-menu">
//                                 <a class="dropdown-item" href="/admin/size/${size.size_id}/edit">Edit</a>
//                                 <button class="dropdown-item delete-btn" data-id="${size.size_id}">Delete</button>
//                             </div>
//                         </div>
//                     </td>
//             `;
//
//         }else if (action === 'update'){
//             const row = document.querySelector(`tr[data-id='${size_id}']`)
//             if (row){
//                 row.querySelector('.sizeName').textContent = size.size_name
//             }
//         }else if (action === 'delete'){
//             const row = document.querySelector(`tr[data-id='${category.id}']`);
//             if (row) {
//                 row.remove();
//             }
//         }
//     })

tableSize.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')){
        const sizeId = e.target.getAttribute('data-id')
        axios.delete(`/admin/size/${sizeId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            const row = document.querySelector(`tr[data-id='${sizeId}']`)
            if (row){
                row.remove()
            }
        })
    }
})
