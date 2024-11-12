import './bootstrap';
const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')

Echo.private(`orders.${userId}`)
    .listen('OrderEvent', (e) => {
        document.getElementById('noti-badge').style.display = 'inline'
        //alert(`Đơn hàng ${e.order.order_id} của bạn đã được tạo`)
        /*const viewNoti = document.getElementById('viewNoti')
        const createNoti = document.createElement('li')
        // Hàm tính thời gian
        function timeAgo(date) {
            const seconds = Math.floor((new Date() - new Date(date)) / 1000);
            const intervals = [
                { label: 'năm', seconds: 31536000 },
                { label: 'tháng', seconds: 2592000 },
                { label: 'ngày', seconds: 86400 },
                { label: 'giờ', seconds: 3600 },
                { label: 'phút', seconds: 60 },
                { label: 'giây', seconds: 1 }
            ];
            for (const interval of intervals) {
                const count = Math.floor(seconds / interval.seconds);
                if (count >= 1) {
                    return `${count} ${interval.label} trước`;
                }
            }
            return "Vừa xong";
        }
        const timeAgoText = timeAgo(e.created_at);
        createNoti.innerHTML = `
            <div class="post rounded-2 border p-3 d-flex justify-content-between align-items-center">
                <div class="">
                    <div class="content">
                        <div class="details">
                            <span class="date">${timeAgoText}</span>
                        </div>
                    </div>
                <p class="text-black">
                    Đơn hàng ${e.order.order_id} của bạn đã đặt hàng thành công
                </p>
                </div>
                <div class="">
                    <button id="noti-button" class="cr-button">
                         Đánh dấu là đã đọc
                    </button>
                </div>
            </div>
        `
        viewNoti.appendChild(createNoti)*/
    })
