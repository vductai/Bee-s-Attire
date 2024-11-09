@extends('layout.client.home')
@section('content_client')
    <div class="cr-bar-title">
        <h6>Thông báo <span class="label">{{ $unreadCount }}</span></h6>
        <a href="javascript:void(0)" class="close-notify"><i class="ri-close-line"></i></a>
    </div>

    <div class="cr-bar-content">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="alert-tab" data-bs-toggle="tab" data-bs-target="#alert"
                        type="button" role="tab" aria-controls="alert" aria-selected="true">Thông báo
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="alert" role="tabpanel" aria-labelledby="alert-tab">
                <div class="cr-alert-list">
                    <ul>
                        @foreach ($notifications as $notification)
                            <li class="{{ $notification->read_at ? 'read' : 'unread' }}">
                                <div class="icon cr-alert">
                                    <i class="ri-alarm-warning-line"></i>
                                </div>
                                <div class="detail">
                                    <!-- Tên thông báo từ 'type' của Notification -->
                                    <div class="title">{{ class_basename($notification->type) }}</div>
                                    <p class="time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                                    <p class="message">{{ isset($notification->data['message']) ? $notification->data['message'] : 'No message available' }}</p>
                                </div>
                                @if (!$notification->read_at)
                                    <a style="margin-left: 100px" href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-sm btn-primary">Đánh dấu là đã đọc</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* General styles */
        .unread {
            background-color: #f5f5f5;  /* Nền cho thông báo chưa đọc */
            border-left: 4px solid #007bff;  /* Thêm viền trái cho thông báo chưa đọc */
        }

        .read {
            background-color: #e0e0e0;  /* Nền cho thông báo đã đọc */
            text-decoration: line-through;  /* Gạch ngang cho thông báo đã đọc */
        }
        .cr-bar-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background-color: #4a4a4a;
            color: #fff;
            font-size: 1rem;
        }

        .cr-bar-title .label {
            background-color: #f44336;
            padding: 4px 8px;
            border-radius: 12px;
            color: #fff;
            font-size: 0.75rem;
        }

        .cr-bar-title .close-notify {
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
        }

        /* Tab styles */
        .nav-tabs .nav-link {
            color: #666;
            padding: 10px 15px;
            border: none;
            font-weight: bold;
        }

        .nav-tabs .nav-link.active {
            color: #4a4a4a;
            background-color: #f1f1f1;
            border-bottom: 2px solid #4a4a4a;
        }

        /* Content styles */
        .cr-bar-content {
            background-color: #fff;
            padding: 10px 15px;
            max-height: 600px;
            overflow-y: auto;
        }

        /* Alert List */
        .cr-alert-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cr-alert-list ul li {
            display: flex;
            align-items: flex-start;
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
        }

        .cr-alert-list ul li .icon {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .cr-alert-list ul li .icon.cr-alert {
            color: #f44336;
        }

        .cr-alert-list ul li .icon.cr-warn {
            color: #ff9800;
        }

        .cr-alert-list ul li .icon.cr-success {
            color: #4caf50;
        }

        .cr-alert-list ul li .detail .title {
            font-weight: bold;
            color: #333;
        }

        .cr-alert-list ul li .detail .time {
            font-size: 0.75rem;
            color: #999;
        }

        .cr-alert-list ul li .detail .message {
            margin-top: 4px;
            font-size: 0.85rem;
            color: #666;
        }

        /* View All Button */
        .cr-alert-list ul li.check {
            text-align: center;
            padding: 10px;
        }

        .cr-primary-btn {
            color: #4a4a4a;
            background-color: #e0e0e0;
            padding: 6px 12px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .cr-primary-btn:hover {
            background-color: #ccc;
        }

        /* Message List */
        .cr-message-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cr-message-list ul li {
            display: flex;
            align-items: flex-start;
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
        }

        .cr-message-list ul li .user img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .cr-message-list ul li .user .label {
            position: relative;
            bottom: 10px;
            right: 10px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #4caf50;
        }

        .cr-message-list ul li .user .label.busy {
            background-color: #ff9800;
        }

        .cr-message-list ul li .user .label.offline {
            background-color: #9e9e9e;
        }

        .cr-message-list ul li .detail .name {
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        .cr-message-list ul li .detail .time {
            font-size: 0.75rem;
            color: #999;
        }

        .cr-message-list ul li .detail .message {
            margin-top: 4px;
            font-size: 0.85rem;
            color: #666;
        }

        .cr-message-list ul li .download-files {
            display: flex;
            gap: 8px;
            margin-top: 4px;
        }

        .download .file {
            font-size: 1.5rem;
            color: #666;
        }

        /* Log Tab */
        .cr-activity-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cr-activity-list ul li {
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
        }

        .cr-activity-list ul li .date-time {
            font-weight: bold;
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 4px;
        }

        .cr-activity-list ul li .title {
            font-weight: bold;
            color: #333;
        }

        .cr-activity-list ul li .detail {
            font-size: 0.85rem;
            color: #666;
        }

        .cr-activity-list ul li .download-files {
            display: flex;
            gap: 8px;
            margin-top: 4px;
        }

    </style>
@endsection
