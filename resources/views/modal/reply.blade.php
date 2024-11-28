<style>
    /* Custom styles for the chat messages */
    .chat-box {
        height: 500px;
        overflow-y: auto;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
    }

    .chat-message-reply {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .chat-message-reply.support {
        align-items: flex-start;
    }

    .chat-message-reply.support .message-text-reply {
        background-color: #e9ecef;
        color: #212529;
    }

    .chat-message-reply.user {
        align-items: flex-end;
    }

    .chat-message-reply.user .message-text-reply {
        background-color: #0d6efd;
        color: #fff;
    }

    .message-text-reply {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 20px;
        word-wrap: break-word;
        font-size: 0.9rem;
    }

    .message-time {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 2px;
    }
</style>
<!-- Chat Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Trò chuyện</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <!-- Chat Box -->
                <div class="chat-box" id="replyBox">
                    {{--<div class="chat-message-reply support">
                        <div class="message-text-reply">
                            Hello! How can I assist you today?
                        </div>
                        <div class="message-time">10:00 AM</div>
                    </div>
                    <div class="chat-message-reply user">
                        <div class="message-text-reply">
                            Chào
                        </div>
                        <div class="message-time">10:00 AM</div>
                    </div>--}}
                </div>
                <!-- Chat Input -->
                <form id="replyForm" class="mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="replyInput"
                               placeholder="Nhắn tin" required/>
                        <button class="btn btn-primary" type="submit">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
