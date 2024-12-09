import './bootstrap';
import axios from "axios";


const formColor = document.getElementById('formColor')
const tableColor = document.getElementById('cat_data_table').getElementsByTagName('tbody')[0]

if (formColor){
    formColor.addEventListener('submit', function (e) {
        e.preventDefault()
        const colorNameCreate = document.getElementById('color_name')
        const colorCodeCreate = document.getElementById('color_code')


        const errorFields = ['colorNameCreate', 'colorCodeCreate'];
        errorFields.forEach(id => {
            let errMessage = document.querySelector(`#${id}`)
            if (errMessage){
                errMessage.remove()
            }
        })

        axios.post('/admin/color',{
            color_name: colorNameCreate.value,
            color_code: colorCodeCreate.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const color = res.data
            const lastRow = tableColor.querySelector('tr:last-child');
            let stt = 1; // Bắt đầu từ 1 nếu bảng rỗng
            if (lastRow) {
                const lastSttCell = lastRow.querySelector('td:first-child');
                stt = parseInt(lastSttCell.textContent) + 1; // Lấy STT của hàng cuối và +1
            }
            const newRow = tableColor.insertRow();
            newRow.setAttribute('data-id', color.color_id)
            newRow.innerHTML =
                `
                    <td>${stt}</td>
                    <td class="colorName">${color.color_name}</td>
                    <td>
                        <input id="text" name="color_code"
                               class="form-control here slug-title" type="color" value="${color.color_code}" disabled>
                    </td>
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
                                <a class="dropdown-item" href="/admin/color/${color.color_id}/edit">Edit</a>
                                <button class="dropdown-item delete-color" data-id="${color.color_id}">Delete</button>
                            </div>
                        </div>
                    </td>
                `;
            colorNameCreate.value = ''
            colorCodeCreate.value = ''

        }).catch(err => {
            if (err.response && err.response.status ===422){
                const error = err.response.data.errors

                if (error.color_name){
                    let errorElement = document.querySelector('#errColorName')
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errColorName'
                        errorElement.classList.add = 'text-danger'
                        colorNameCreate.insertAdjacentElement('afterend', errorElement)
                    }
                errorElement.textContent = error.color_name[0]
                }

                if (error.color_code){
                    let errorElement = document.querySelector('#errColorCode')
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errColorCode'
                        errorElement.classList.add = 'text-danger'
                        colorCodeCreate.insertAdjacentElement('afterend', errorElement)
                    }
                    errorElement.textContent = error.color_code[0]
                }

            }
        })
    })
}

// update
const formColorUpdate = document.getElementById('formColorUpdate')
if (formColorUpdate){
    formColorUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        const colorNameUpdate = document.getElementById('color_name')
        const colorCodeUpdate = document.getElementById('color_code')
        const colorId = document.getElementById('colorId').value

        const errorFields = ['colorNameUpdate', 'colorCodeUpdate'];
        errorFields.forEach(id => {
            let errMessage = document.querySelector(`#${id}`)
            if (errMessage){
                errMessage.remove()
            }
        })

        axios.put(`/admin/color/${colorId}`,{
            color_name: colorNameUpdate.value,
            color_code: colorCodeUpdate.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const color = res.data

            const row = document.querySelector(`tr[data-id='${colorId}']`)
            if (row){
                row.querySelector('.colorName').textContent = color.color_name
                row.querySelector('#colorCode').value = color.color_code
            }

            colorNameUpdate.value = ''
            colorCodeUpdate.value = ''

        }).catch(err => {
            if (err.response && err.response.status ===422){
                const error = err.response.data.errors

                if (error.color_name){
                    let errorElement = document.querySelector('#errColorName')
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errColorName'
                        errorElement.classList.add = 'text-danger'
                        colorNameCreate.insertAdjacentElement('afterend', errorElement)
                    }
                    errorElement.textContent = error.color_name[0]
                }

                if (error.color_code){
                    let errorElement = document.querySelector('#errColorCode')
                    if (!errorElement){
                        errorElement = document.createElement('p')
                        errorElement.id = 'errColorCode'
                        errorElement.classList.add = 'text-danger'
                        colorCodeCreate.insertAdjacentElement('afterend', errorElement)
                    }
                    errorElement.textContent = error.color_code[0]
                }

            }
        })
    })
}

// delete
tableColor.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-color')){
        const colorId = e.target.getAttribute('data-id')
        const isConfirmed = window.confirm('Bạn có chắc chắn muốn xóa mục này không?');
        if (!isConfirmed){
            return;
        }
        axios.delete(`/admin/color/${colorId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            const row = document.querySelector(`tr[data-id='${colorId}']`)
            if (row){
                row.remove()
            }
        })
    }
})
