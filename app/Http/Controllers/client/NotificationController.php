<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            // Lấy tất cả thông báo của người dùng
            $notifications = $user->notifications;

            // Lấy số lượng thông báo chưa đọc
            $unreadCount = $user->unreadNotifications->count();  // Lấy số lượng thông báo chưa đọc
        } else {
            // Người dùng chưa đăng nhập
            return redirect()->route('login');
        }

        return view('client.notification.index', compact('notifications', 'unreadCount'));
    }
    // NotificationController.php

    public function markAsRead($notificationId)
    {
        $user = Auth::user();

        if ($user) {
            $notification = $user->notifications->find($notificationId);  // Lấy thông báo theo ID

            if ($notification) {
                $notification->markAsRead();  // Đánh dấu thông báo là đã đọc
            }
        }

        return redirect()->route('notifications.index');  // Quay lại trang danh sách thông báo
    }

}
