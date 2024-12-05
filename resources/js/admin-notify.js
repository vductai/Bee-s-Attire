import './bootstrap';

Echo.private('admin-cancel-order')
    .listen('CancelOrderEvent', function (e) {
        console.log(e)
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
        if (e.status === 'Đã nhận được hàng'){
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
                    <p class="message">Đơn hàng ${e.order_id} đã được giao thành công</p>
                </div>
            </li>
        `
            notiManagerView.appendChild(createLi)
            document.querySelector(`.oro[data-orId='${e.order_id}']`).innerText = 'Đã nhận được hàng'
            document.querySelector(`.oro[data-orId='${e.order_id}']`).classList.add('text-bg-success')
            document.querySelectorAll(`.update-status[data-id='${e.order_id}']`).forEach(us => {
                us.style.display = 'none'
            })
        }else {
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
                    <p class="message">Bạn có yêu cầu hủy đơn hàng ${e.order_id} từ ${e.username}</p>
                </div>
            </li>
        `
            notiManagerView.appendChild(createLi)
            document.querySelector(`.oro[data-orId='${e.order_id}']`).innerText = 'Yêu cầu huỷ đơn hàng'
            document.querySelector(`.oro[data-orId='${e.order_id}']`).classList.add('text-bg-danger')
            // Loại bỏ class d-none và đảm bảo các phần tử update-status được hiển thị
            document.querySelectorAll(`.update-status[data-id='${e.order_id}']`).forEach(us => {
                us.classList.remove('d-none'); // Loại bỏ class d-none
                us.style.display = 'block'; // Đảm bảo hiển thị phần tử
            });

            // Ẩn phần tử không có class d-none nhưng không ảnh hưởng đến phần tử có textContent "Hủy đơn hàng"
            document.querySelectorAll(`.update-status[data-id='${e.order_id}']`).forEach(us => {
                if (!us.classList.contains('d-none') && us.textContent.trim() !== 'Hủy đơn hàng') {
                    us.style.display = 'none';
                }
            });
        }
    })
