import './bootstrap';

Echo.private('admin-cancel-order')
    .listen('CancelOrderEvent', function (e) {
        const toastElement = document.getElementById('toastAdmin')
        const toastAdmin = new bootstrap.Toast(toastElement)
        document.querySelector('#toast-content-admin').textContent = 'Có thông báo mới'
        toastAdmin.show();
        const notiManagerView = document.getElementById('noti-manager-view')
        const createLi = document.createElement('li')
        // tính toán thời gian
        function timeAgo(date) {
            // lấy second
            const seconds = Math.floor((new Date() - new Date(date)) / 1000) // milions
            const intervals = [
                { label: 'năm', seconds: 31536000 },
                { label: 'tháng', seconds: 2592000 },
                { label: 'ngày', seconds: 86400 },
                { label: 'giờ', seconds: 3600 },
                { label: 'phút', seconds: 60 },
                { label: 'giây', seconds: 1 }
            ]
            for (const interval of intervals){
                // tính số thời gian trôi qua
                const count = Math.floor(seconds / interval.seconds)
                if (count >= 1){
                    return `${count} ${interval.label} trước`;
                }
            }
            return "Vừa xong";
        }
        const timeAgoText = timeAgo(e.time)
        createLi.innerHTML = `
            <li>
                <div class="icon cr-alert">
                    <i class="ri-alarm-warning-line"></i>
                </div>
                <div class="detail">
                    <div class="d-flex justify-content-start align-items-center">
                        <p class="time mx-3">${timeAgoText}</p>
                        <span class="badge text-bg-danger">Mới</span>
                    </div>
                    <p class="message">${e.message}</p>
                </div>
            </li>
        `
        notiManagerView.appendChild(createLi)

        document.querySelector(`.oro[data-orId='${e.order_id}']`).innerText = 'Yêu cầu huỷ đơn hàng'
        document.querySelector(`.oro[data-orId='${e.order_id}']`).classList.add('text-bg-danger')
        document.querySelectorAll(`.update-status[data-id='${e.order_id}']`).forEach(us => {
            us.style.display = 'none'
        })
    })
