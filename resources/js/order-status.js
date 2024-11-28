import './bootstrap';
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')

Echo.private(`order-status.${userId}`)
    .listen('OrderStatusUpdateEvent',  (e) => {
        const viewNoti = document.getElementById('noti-header-view')
        document.getElementById('notis-badge').style.display = 'inline'
        document.getElementById('noti-null').style.display = 'none'
        const createNoti = document.createElement('li')

        if (e.status === "Đã xác nhận"){
            createNoti.innerHTML = `
                <li>
                     <a class="dropdown-item"
                        href="/notification">
                             <span class="badge text-bg-danger">Mới</span>
                         Đơn hàng có mã ${e.order.order_id} của bạn đã được chúng tôi xác nhận và sẽ giao cho bạn sớm nhất.
                     </a>
                </li>
            `
            viewNoti.appendChild(createNoti)
        }else if (e.status === "Đã giao hàng"){
            createNoti.innerHTML = `
                <li>
                     <a class="dropdown-item"
                        href="/notification">
                             <span class="badge text-bg-danger">Mới</span>
                         Đơn hàng có mã ${e.order.order_id} của bạn đã được chúng tôi gửi đi, vui lòng kiển tra tin nhắn.
                     </a>
                </li>
            `
            viewNoti.appendChild(createNoti)
        }
    })
