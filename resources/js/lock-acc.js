import './bootstrap'

const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')
Echo.private(`lock-acc.${userId}`)
    .listen('LockUserAccountEvent', function (e) {
        document.getElementById('contentLockAccModal').innerHTML = `
            <p class="text-center">Tài khoản của bạn đã bị khóa</p> <br>
            <p class="text-center">Đăng xuất sau <span id="countdown">5</span>s </p> <br>
        `
        let countdown = 5; // Thời gian đếm ngược (giây)
        const interval = setInterval(() => {
            countdown--;
            document.getElementById('countdown').innerText = countdown;

            if (countdown === 0) {
                clearInterval(interval); // Dừng đếm ngược khi hết thời gian
            }
        }, 1000); // Chạy mỗi giây

        const lockModal = new bootstrap.Modal(document.getElementById('lockAccModal'))
        lockModal.show()
        setTimeout(()=>{
            axios.post('/logout', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                localStorage.clear()
                window.location.href = '/auth/login'
            })
        }, 5000)
    })
