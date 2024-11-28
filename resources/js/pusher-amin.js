import './bootstrap';
const receiverId = 88;
Echo.private(`chat.${receiverId}`)
    .listen('MessageSentEvent', function (e) {
        // thông báo toast
        const toastElement = document.getElementById('toastAdmin')
        const toastAdmin = new bootstrap.Toast(toastElement)
        document.querySelector('#toast-content-admin').innerHTML = `Có tin nhắn mới từ ${e.senderInfo.name}`
        toastAdmin.show();
        const data = e.message
        const receiver = e.senderId
        localStorage.setItem('receiver', receiver)
        // hiện tin nhắn trong trang thông báo
        const viewChatAdmin = document.getElementById('view-chat-admin')
        const createLiChat = document.createElement('li')
        const avatar = `${window.location.origin}/upload/${e.senderInfo.avatar}`
        createLiChat.innerHTML = `
            <a href="javascript:void(0)" data-sender="${data.senderId}" data-bs-toggle="modal"
            data-bs-target="#replyModal" class="reply">Reply</a>
            <div class="user">
                <img src="${avatar}" alt="user">
                <span class="label online"></span>
            </div>
            <div class="detail">
                <a href="" class="name">${e.senderInfo.name}</a>
                <p class="time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</p>
                <p class="message">${data.message}</p>
            </div>
        `
        viewChatAdmin.appendChild(createLiChat)

        // hiện tin nhắn trong modal
        const replyBox = document.getElementById('replyBox');
        const supportMess = document.createElement('div')
        supportMess.className = 'chat-message-reply support'
        supportMess.innerHTML = `
            <div class="message-text-reply">${data.message}</div>
            <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</div>
        `

        replyBox.appendChild(supportMess)
        replyBox.scrollTop = replyBox.scrollHeight
    });
