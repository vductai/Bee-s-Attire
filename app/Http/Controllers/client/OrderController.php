<?php

namespace App\Http\Controllers\client;

use App\Events\CancelOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\Notify_manager;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getAllOrder()
    {
        $getUser = Auth::user();
        $getOrder = Order::orderBy('created_at', 'desc')
            ->where('user_id', $getUser->user_id)->paginate(10);
        return view('client.order.list-order', compact('getOrder', 'getUser'));
    }

    public function orderDetail($id)
    {
        $detail = Order::findOrFail($id);
        $quantity = $detail->order_item->sum('quantity');
        return view('client.order.orderDetail', compact('detail', 'quantity'));
    }

    public function trackOrder()
    {
        return view('client.order.track-order');
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status != 'Đã giao hàng') {
            $order->status = 'Yêu cầu huỷ đơn hàng';
            $order->save();
            Notify_manager::create([
                'category' => 'Đơn hàng',
                'message' => "Có yêu cầu huỷ đơn hàng có ID: {$order->order_id} từ {$order->user->username}"
            ]);
            broadcast(new CancelOrderEvent($order))->toOthers();
            return response()->json(['message' => 'Đã gửi yêu cầu huỷ.']);
        }
        return response()->json(['message' => 'Không thể hủy đơn hàng đã giao.']);
    }
}