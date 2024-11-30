import './bootstrap';
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')
const toastOrder = document.getElementById('toastOrder')
const toastOrderShow = new bootstrap.Toast(toastOrder)
Echo.private(`order-status.${userId}`)
    .listen('OrderStatusUpdateEvent',  (e) => {
        const viewNoti = document.getElementById('noti-header-view')
        document.getElementById('notis-badge').style.display = 'inline'
        document.getElementById('noti-null').style.display = 'none'
        const createNoti = document.createElement('li')

        if (e.status === "Đã xác nhận"){
            document.querySelector('#toast-order-content').textContent = 'Bạn có thông báo mới về đơn hàng';
            toastOrderShow.show();
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
            document.querySelector('#toast-order-content').textContent = 'Bạn có thông báo mới về đơn hàng';
            toastOrderShow.show();
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
        }else if (e.status === "Hủy đơn hàng"){
            document.querySelector('#toast-order-content').textContent = 'Bạn có thông báo mới về đơn hàng';
            toastOrderShow.show();
            document.querySelector(`.cancel[data-badgeId='${e.order.order_id}']`).innerText = 'Đơn hàng đã bị hủy'
            document.querySelector(`.cancel-order[data-orderId='${e.order.order_id}']`).style.display = 'none'
            createNoti.innerHTML = `
                <li>
                     <a class="dropdown-item"
                        href="/notification">
                             <span class="badge text-bg-danger">Mới</span>
                         Đơn hàng có mã ${e.order.order_id} của bạn đã được hủy thành công.
                     </a>
                </li>
            `
            viewNoti.appendChild(createNoti)
        }
    })
