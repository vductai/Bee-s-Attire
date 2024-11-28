import './bootstrap';

const userId = document.querySelector('meta[name="user-id"]').getAttribute('content')
localStorage.setItem('rece', userId)
const chatForm = document.getElementById('chatForm');
const chatBox = document.getElementById('chatBox');
const receiverId = 88;
chatForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if (message) {
        axios.post('/send-message', {
            receiver_id: receiverId,
            message: message
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            console.log(res)
            const data = res.data
            console.log(data)
            // Add user message to chat
            const userMessage = document.createElement('div');
            userMessage.className = 'chat-message user';
            userMessage.innerHTML = `
                <div class="message-text">${data.message}</div>
                <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</div>
            `;
            chatBox.appendChild(userMessage);
            // Scroll to the bottom
            chatBox.scrollTop = chatBox.scrollHeight;
            // Clear input
            input.value = '';
        })
    }
});


// lịch sử chat
const rece = localStorage.getItem('rece');
Echo.private(`chat.${rece}`)
    .listen('MessageSentEvent', function (e) {
        console.log(e)
        const data = e.message
        const userMessage = document.createElement('div');
        userMessage.className = 'chat-message support';
        userMessage.innerHTML = `
                <div class="message-text">${data.message}</div>
                <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</div>
            `;
        chatBox.appendChild(userMessage);
        chatBox.scrollTop = chatBox.scrollHeight;
    })




// lich sử chat
document.addEventListener('DOMContentLoaded', function () {
    const click = document.getElementById('replys')
    click.addEventListener('click', function (e) {
        e.preventDefault()
        const senderId = this.getAttribute('data-sender');
        chatBox.innerHTML = `
                <div class="d-flex justify-content-center align-items-center">
                    <span class="spinner-border
                        spinner-border-sm mx-4"
                        style="margin-top: 200px;width: 3rem; height: 3rem;" aria-hidden="true"></span>
                </div>
        `

        axios.get(`/get-chats/${senderId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            chatBox.innerText = ''
            const data = res.data.message
            console.log(data)
            data.forEach((mess) => {
                const messHTML = `
                            <div class="chat-message ${mess.sender === 'user' ? 'user' : 'support'}">
                                <div class="message-text">
                                    ${mess.text}
                                </div>
                                <div class="message-time">${mess.time}</div>
                            </div>
                        `;
                chatBox.innerHTML += messHTML;
            })
        })
    })
})



