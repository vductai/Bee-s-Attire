import './bootstrap';
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')
Echo.private(`user.${userId}`)
    .listen('VoucherAssignedEvent', function (e) {
        const viewNoti = document.getElementById('noti-header-view')
        document.getElementById('notis-badge').style.display = 'inline'
        document.getElementById('noti-null').style.display = 'none'
        const createNoti = document.createElement('li')

        createNoti.innerHTML = `
            <li>
                 <a class="dropdown-item"
                    href="/notification">
                         <span class="badge text-bg-danger">Mới</span>
                     Bạn vừa nhận được một voucher ${e.voucher.voucher_code} Hãy sử dụng ngay để tiết kiệm nhiều hơn.
                 </a>
            </li>
        `
        viewNoti.appendChild(createNoti)

        document.getElementById('voucherContent').innerHTML =
            `
                <p>Bạn vừa nhận được một voucher mới! Hãy kiểm tra ví của bạn và sử dụng ngay để tiết kiệm nhiều hơn.</p>
                <p><strong>Mã Voucher:</strong> ${e.voucher.voucher_code}</p>
                <p><strong>Giảm giá:</strong> ${e.voucher.voucher_price} %</p>
                <p><strong>Hạn sử dụng:</strong> ${e.endDate}</p>
            `;
        const voucherModal = new bootstrap.Modal(document.getElementById('voucherModal'));
        voucherModal.show();
    })

/*-------------------------------- Delete voucher -----------------------------------------------*/

Echo.private(`user.${userId}`)
    .listen('DeleteVoucherEvent', function (e) {
        const viewNoti = document.getElementById('noti-header-view')
        document.getElementById('notis-badge').style.display = 'inline'
        document.getElementById('noti-null').style.display = 'none'
        const createNoti = document.createElement('li')

        createNoti.innerHTML = `
            <li>
                 <a class="dropdown-item"
                    href="/notification">
                         <span class="badge text-bg-danger">Mới</span>
                     ${e.message}
                 </a>
            </li>
        `
        viewNoti.appendChild(createNoti)
    })
