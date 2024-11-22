import './bootstrap';
const formPasswordEmail = document.getElementById('form-password-email')
if (formPasswordEmail){
    formPasswordEmail.addEventListener('submit', function (e) {
        e.preventDefault()
        const email = document.getElementById('emailPassword')
        document.querySelector('.es').textContent = ''
        axios.post('/auth/forgot-password',{
            email: email.value
        },{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            if (res.data.success === false){
                document.getElementById('email-error').textContent = res.data.message
            }else {
                document.getElementById('email-error').textContent = 'Kiểm tra email và xác thực'

                /*tạo hàm đếm ngược 5p*/
                document.getElementById('subEmail').textContent = ''
                document.getElementById('subEmail').type = 'button'
                let time = 300; //5p
                const display = document.getElementById('subEmail')
                const timer = setInterval(() => {
                    const minutes = Math.floor(time / 60); // tính phút
                    const seconds = time % 60; // tính giây
                    display.textContent = `${minutes} : ${seconds < 10 ? '0' : ''}${seconds}`
                    if (time-- <= 0){
                        clearInterval(timer);
                        display.textContent = 'Xác nhận'
                        document.getElementById('subEmail').type = 'submit'
                    }
                }, 1000)
            }
        }).catch(err => {
            if (err.response && err.response.data.errors) {
                const error = err.response.data.errors
                for (let feild in error) {
                    document.querySelector(`#${feild}-error`).textContent = error[feild][0];
                }
            }
        })
    })
}

/*-------------------------------------------------- reset pass --------------------------------------------------------*/
const formResetPass = document.getElementById('formResetPass')
if (formResetPass){
    formResetPass.addEventListener('submit', function (e) {
        e.preventDefault();
        document.querySelectorAll('.ess').forEach( e =>{
            e.textContent = ''
        })
        const email = document.getElementById('email')
        const password = document.getElementById('password')
        const password_confirmation = document.getElementById('password_confirmation')
        const token = document.getElementById('token')
        axios.post('/auth/reset-password',{
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
            token: token.value
        },{
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            if (res.data.success === false){
                document.getElementById('er').textContent = res.data.message
            }else {
                document.getElementById('emailContent').innerHTML = `
                    <p class="text-center">Đặt lại mật khẩu thành công</p>
                `
                const emailModal = new bootstrap.Modal(document.getElementById('emailModal'))
                emailModal.show()
                setTimeout(()=>{
                    window.location.href = '/auth/login'
                }, 1000)
            }
        }).catch(err =>{
            if (err.response && err.response.data.errors) {
                const error = err.response.data.errors
                for (let feild in error) {
                    document.querySelector(`#${feild}-error`).textContent = error[feild][0];
                }
            }
        })
    })
}
