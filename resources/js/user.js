import './bootstrap';
import axios from "axios";

const formUser = document.getElementById('formUser')
if (formUser) {
    formUser.addEventListener('submit', function (e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const avatar = document.getElementById('avatar').files[0]; 
        const password = document.getElementById('password').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const address = document.getElementById('address').value;
        const gender = document.getElementById('gender').value;
        const birthday = document.getElementById('birthday').value;

    
        const formData = new FormData();
        formData.append('username', username);
        formData.append('avatar', avatar);
        formData.append('password', password);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('address', address);
        formData.append('gender', gender);
        formData.append('birthday', birthday);
        formData.append('role_id', 3);

        // Xóa lỗi cũ
        document.querySelectorAll('.error-text').forEach((p) => p.textContent = '');

        axios.post('/admin/user', formData, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => {
            window.location.href = '/admin/user';
        })
        .catch(err => {
            if (err.response && err.response.data.errors) {
                const errors = err.response.data.errors;
                for (const field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        });
    });
}


// update

const formUserUpdate = document.getElementById('formUserUpdate')

if (formUserUpdate){
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


        document.querySelectorAll('.error-text').forEach(function(p) {
            p.textContent = '';
        });
        axios.put(`/admin/user/${userId}`, {
            username: usernameUpdate.value,
            avatar: avatarUpdate.value,
            email: emailUpdate.value,
            phone: phoneUpdate.value,
            address: addressUpdate.value,
            gender: genderUpdate.value,
            birthday: birthdayUpdate.value,
        }, {
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



