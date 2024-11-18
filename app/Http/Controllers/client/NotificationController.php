<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notifications::where('user_id', Auth::user()->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('client.notification', compact('notifications'));
    }

    public function checkNewNotifications()
    {
        $hasNewNotifications = Notifications::where('user_id', auth()->user()->user_id)
            ->where('is_real', 0)
            ->exists();
        return response()->json(['hasNewNotifications' => $hasNewNotifications]);
    }

    public function updateStatusNoti($id){
        $noti = Notifications::find($id);
        if ($noti){
            $noti->update(['is_read' => 'Đã đọc']);
        }
        //Notifications::where('is_real', 'chưa đọc')->update(['is_real' => 'đã đọc']);
        return response()->json($noti);
    }

    public function delAllNoti(){
        Notifications::where('user_id', Auth::user()->user_id)
            ->where('is_read', 'Đã đọc')
            ->delete();
        $notiRead = Notifications::where('user_id', Auth::user()->user_id)
            ->where('is_read', 'Chưa đọc')
            ->get();
        Log::info([$notiRead]);
        return response()->json(['notis' => $notiRead]);
    }
}
