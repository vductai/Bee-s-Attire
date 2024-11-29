import './bootstrap';
import axios from "axios";

const formUser = document.getElementById('formUser')
if (formUser) {
    formUser.addEventListener('submit', function (e) {
        e.preventDefault()
        const userName = document.getElementById('username')
        const avaTar = document.getElementById('avatar')
        const passWord = document.getElementById('password')
        const Email = document.getElementById('email')
        const Phone = document.getElementById('phone')
        const Address = document.getElementById('address')
        const Gender = document.getElementById('gender')
        const Birthday = document.getElementById('birthday')

        const formData = new FormData();
        formData.append('username', userName.value);
        formData.append('avatar', avaTar.files[0]); // Lấy file đầu tiên từ input
        formData.append('password', passWord.value);
        formData.append('email', Email.value);
        formData.append('phone', Phone.value);
        formData.append('address', Address.value);
        formData.append('gender', Gender.value);
        formData.append('birthday', Birthday.value);
        formData.append('role_id', 3);

        // xoá các lỗi nếu có
        document.querySelectorAll('.error-text').forEach(function (p) {
            p.textContent = '';
        });
        axios.post('/admin/user', formData, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const user = res.data
            window.location.href = '/admin/user'
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

const formUserUpdate = document.getElementById('formUserUpdate')
if (formUserUpdate) {
    formUserUpdate.addEventListener('submit', function (e) {
        e.preventDefault()
        const userId = document.getElementById('userId').value
        const avatarUpdate = document.getElementById('avatar')
        const emailUpdate = document.getElementById('email')
        const addressUpdate = document.getElementById('address')
        const phoneUpdate = document.getElementById('phone')
        const birthdayUpdate = document.getElementById('birthday')
        const genderUpdate = document.getElementById('gender')
        const usernameUpdate = document.getElementById('username')

        const updateData = new FormData();
        updateData.append('avatar', avatarUpdate.files[0]);
        updateData.append('email', emailUpdate.value);
        updateData.append('address', addressUpdate.value);
        updateData.append('phone', phoneUpdate.value);
        updateData.append('birthday', birthdayUpdate.value);
        updateData.append('gender', genderUpdate.value);
        updateData.append('username', usernameUpdate.value);
        updateData.append('_method', 'PUT')
        document.querySelectorAll('.error-text').forEach(function (p) {
            p.textContent = '';
        });
        axios.post(`/admin/user/${userId}`, updateData
            , {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'multipart/form-data'
                }
            }).then(res => {
            const user = res.data
            window.location.href = '/admin/user'
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




