import './bootstrap';
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')
const toastOrder = document.getElementById('toastOrder')
const toastOrderShow = new bootstrap.Toast(toastOrder)
Echo.private(`order-status.${userId}`)
    .listen('OrderStatusUpdateEvent',  (e) => {
        const viewNoti = document.getElementById('noti-header-view')
        document.getElementById('notis-badge').style.display = 'inline'
        const notiNullElement = document.getElementById('noti-null');
        if (notiNullElement) {
            notiNullElement.style.display = 'none';
        }
        const createNoti = document.createElement('li')

        if (e.status === "Đã xác nhận"){
            document.querySelector(`.bbb[data-badgeId='${e.order.order_id}']`).classList.remove('text-bg-warning')
            document.querySelector(`.bbb[data-badgeId='${e.order.order_id}']`).textContent = 'Đã xác nhận'
            document.querySelector(`.bbb[data-badgeId='${e.order.order_id}']`).classList.add('text-bg-primary')
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
            const baba = document.querySelector(`.successOrder[data-orderId='${e.order.order_id}']`)
            if (baba){
                baba.classList.remove('d-none')
                baba.style.display = 'block'
            }
            document.querySelector(`.bbb[data-badgeId='${e.order.order_id}']`).classList.remove('text-bg-warning')
            document.querySelector(`.bbb[data-badgeId='${e.order.order_id}']`).textContent = 'Đã giao hàng'
            document.querySelector(`.bbb[data-badgeId='${e.order.order_id}']`).classList.add('text-bg-success')
            document.querySelector(`.modalCanner[data-orderId='${e.order.order_id}']`).style.display = 'none'
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
            document.querySelector(`.modalCanner[data-orderId='${e.order.order_id}']`).style.display = 'none'
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
