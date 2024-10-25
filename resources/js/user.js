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
        // xoá các lỗi nếu có
        document.querySelectorAll('.error-text').forEach(function (p) {
            p.textContent = '';
        });
        

        axios.post('/admin/user', {
            username: userName.value,
            avatar: avaTar.value,
            password: passWord.value,
            email: Email.value,
            phone: Phone.value,
            address: Address.value,
            gender: Gender.value,
            birthday: Birthday.value,
            role_id: 3
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

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')){
        const userid = e.target.getAttribute('data-id')
        axios.delete(`/admin/user/${userid}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(() => {
            const row = document.querySelector(`tr[data-id='${voucherId}']`)
            if (row){
                row.remove()
            }
        })
    }
})

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

        })
    })
}



