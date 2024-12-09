<?php

namespace App\Http\Controllers\client;

use App\Events\CancelOrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\Notify_manager;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function successOrder($id){
        $order = Order::findOrFail($id);
        if ($order->status === 'Đã giao hàng') {
            $order->status = 'Đã nhận được hàng';
            $order->payment_status = 'Đã thanh toán';
            $order->save();
            Notify_manager::create([
                'category' => 'Đơn hàng',
                'message' => "Đơn hàng có ID: {$order->order_id} từ {$order->user->username} đã được giao thành công"
            ]);
            broadcast(new CancelOrderEvent($order))->toOthers();
            return response()->json(['message' => 'Đã giao hàng thàn công.']);
        }
        return response()->json(['message' => 'Đã giao hàng thàn công.']);
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status === 'Đã giao hàng'){
            return response()->json([
                'success' => false,
                'message' => 'Không thể gửi yêu cầu hủy đơn hàng'
            ]);
        }
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

    public function printInvoice($id){
        $detail = Order::findOrFail($id);
        $quantity = $detail->order_item->sum('quantity');
        $pdf = Pdf::loadView('client.order.invoice', compact('detail', 'quantity'));
        $filename = "{$detail->order_id}";
        return $pdf->stream("{$filename}");
    }
}
