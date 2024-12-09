<style>
    /* Custom styles for the chat messages */
    .chat-box {
        height: 200px;
        overflow-y: auto;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
    }

    .chat-message {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .chat-message.support {
        align-items: flex-start;
    }

    .chat-message.support .message-text {
        background-color: #e9ecef;
        color: #212529;
    }

    .chat-message.user {
        align-items: flex-end;
    }

    .chat-message.user .message-text {
        background-color: #0d6efd;
        color: #fff;
    }

    .message-text {
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
    #chatModal .modal-dialog{
        width: 400px;
        transform: none !important;
        position: fixed;
        bottom: 130px;
        right: 10px;
    }

</style>
<div class="modal fade" id="chatModal" tabindex="-1"
     aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatModalLabel">Nhắn tin cho chúng tôi</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <!-- Chat Box -->
                <div class="chat-box" id="chatBox">

                </div>
                <!-- Chat Input -->
                <form id="chatForm" class="mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="chatInput"
                               placeholder="Nhắn tin" autocomplete="off" required/>
                        <button class="cr-button btn-primary" type="submit">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
