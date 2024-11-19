// hiện lịch sử trò truyện
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.reply').forEach(click => {
        click.addEventListener('click', function (e) {
            e.preventDefault()
            const senderId = this.getAttribute('data-sender');
            const modalTitle = document.getElementById('chatModalLabel');
            replyBox.innerHTML = `
                <div class="d-flex justify-content-center align-items-center">
                    <span class="spinner-border
                        spinner-border-sm mx-4"
                        style="margin-top: 200px;width: 3rem; height: 3rem;" aria-hidden="true"></span>
                </div>
            `
            modalTitle.textContent = `Trò chuyện với ${senderId}`

            axios.get(`/get-chat/${senderId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(res => {
                const data = res.data.message
                replyBox.innerHTML = '';
                console.log(data)
                data.forEach((mess) => {
                    const messHTML = `
                            <div class="chat-message-reply ${mess.sender === 'user' ? 'user' : 'support'}">
                                <div class="message-text-reply">
                                    ${mess.text}
                                </div>
                                <div class="message-time">${mess.time}</div>
                            </div>
                        `;
                    replyBox.innerHTML += messHTML;
                })
            })
        })
    })
})


// gửi tin nhắn trả về
const replyForm = document.getElementById('replyForm')
replyForm.addEventListener('submit', function (e) {
    e.preventDefault()
    const input = document.getElementById('replyInput')
    const message = input.value
    const receiver = localStorage.getItem('receiver');
    console.log('admin ', receiver)
    if (message.trim() !== ''){
        axios.post('/send-message', {
            receiver_id: receiver,
            message: message
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(res => {
            const data = res.data
            console.log(data)
            const replyBox = document.getElementById('replyBox');
            const supportMess = document.createElement('div')
            supportMess.className = 'chat-message-reply user'
            supportMess.innerHTML = `
                    <div class="message-text-reply">${data.message}</div>
                    <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'})}</div>
                `
            replyBox.appendChild(supportMess)
            replyBox.scrollTop = replyBox.scrollHeight
            input.value = '';
        })
    }
})

