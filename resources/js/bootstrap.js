import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

document.addEventListener('DOMContentLoaded', function() {
    const userIdMeta = document.querySelector('meta[name="user-id"]');
    const userId = userIdMeta ? userIdMeta.getAttribute('content') : null;

    if (userId) {
        window.Echo.private(`wishlist.${userId}`)
            .listen('.ProductUpdated', (e) => {
                const notification = document.getElementById('notification');
                const wishlistCommon = document.getElementById('wishlist-common');

                if (e.action === 'add') {
                    notification.innerText = `Sản phẩm "${e.productName}" đã được thêm vào wishlist bởi ${e.username}.`;
                    wishlistCommon.style.display = 'inline'; 
                } else if (e.action === 'remove') {
                    notification.innerText = `Sản phẩm "${e.productName}" đã bị xóa khỏi wishlist bởi ${e.username}.`;
                    
                    const allIndicators = document.querySelectorAll('.wishlist-indicator');
                    const anyVisible = Array.from(allIndicators).some(indicator => indicator.style.display === 'inline');
                    wishlistCommon.style.display = anyVisible ? 'inline' : 'none';
                }

                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 2000);
            });
    }
});






    

