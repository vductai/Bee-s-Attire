import './bootstrap';

const formLoginClient = document.getElementById('loginFormClient')
const email = document.getElementById('emailClient')
const pwd = document.getElementById('passwordClient')
const toastElement = document.getElementById('toastMessage')
const toast = new bootstrap.Toast(toastElement)
if (formLoginClient) {
    formLoginClient.addEventListener('submit', function (e) {
        e.preventDefault()
        document.getElementById('sub-login').innerText = ''
        document.getElementById('sub-login').innerHTML = `
            <span class="spinner-border spinner-border-sm mx-4" aria-hidden="true"></span>
        `
        document.querySelectorAll('.es').forEach(p => {
            p.textContent = ''
        })
        axios.post('/auth/login', {
            email: email.value,
            password: pwd.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            document.getElementById('sub-login').innerHTML = 'Đăng nhập'
            if (res.data.success) {
                document.querySelector('#toast-content').textContent = 'Đăng nhập thành công'
                toast.show();
                setTimeout(() => {
                    window.location.href = res.data.redirect || '/'
                }, 1000)
            } else {
                document.getElementById('e-error').innerText = res.data.message
            }
        }).catch(err => {
            document.getElementById('sub-login').innerHTML = 'Đăng nhập'
            if (err.response && err.response.data.errors) {
                let errors = err.response.data.errors
                for (let field in errors) {
                    document.querySelector(`#${field}-error`).textContent = errors[field][0];
                }
            }
        })
    })
}

/*-------------------------------------------------- register --------------------------------------------------------*/
const formRegister = document.getElementById('registerForm')
const emailRegister = document.getElementById('emailRegister')
const pwdRegister = document.getElementById('passwordRegister')
const pwdConfirmation = document.getElementById('password_confirmation')

if (formRegister) {
    formRegister.addEventListener('submit', function (e) {
        e.preventDefault()
        document.getElementById('sub-res').innerText = ''
        document.getElementById('sub-res').innerHTML = `
            <span class="spinner-border spinner-border-sm mx-4" aria-hidden="true"></span>
        `
        document.querySelectorAll('.es').forEach(p => {
            p.textContent = ''
        })
        axios.post('/auth/register', {
            email: emailRegister.value,
            password: pwdRegister.value,
            password_confirmation: pwdConfirmation.value
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            document.getElementById('sub-res').innerHTML = 'Đăng kí'

            if (res.data.success === false) {
                document.getElementById('email-exit').innerText = res.data.message
            } else {
                document.querySelectorAll('.es').forEach(p => {
                    p.textContent = ''
                })
                this.reset()
                document.getElementById('verifyContent').innerHTML =
                    `
                        <p class="text-center">Đăng kí thành công. Kiểm tra email <b>${res.data}</b> để xác minh.</p>
                    `;
                const verify = new bootstrap.Modal(document.getElementById('verifyRegisterModal'));
                verify.show();
            }
        }).catch(err => {
            document.getElementById('sub-res').innerHTML = 'Đăng kí'
            if (err.response && err.response.data.errors) {
                const error = err.response.data.errors
                for (let feild in error) {
                    document.querySelector(`#${feild}-error`).textContent = error[feild][0];
                }
            }
        })
    })
}

/*----------------------------------------------------- logout -------------------------------------------------------------*/

const btnLogout = document.getElementById('btnLogout')
btnLogout.addEventListener('click', function (e) {
    e.preventDefault()
    axios.post('/logout', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(res => {
        localStorage.clear()
        window.location.href = '/'
    })
})
