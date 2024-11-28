<?php

namespace App\Http\Controllers\admin;

use App\Events\OrderStatusUpdateEvent;
use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\order_item;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function listOrder()
    {

        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $listOrder = Order::orderBy('created_at', 'desc')->get();
        return view('admin.order.list-order', compact('listOrder'));
    }

    public function updateStatus(Request $request, Order $order, $status)
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        $statusList = ['Đang sử lý', 'Đã xác nhận', 'Đã giao hàng'];
        if (!in_array($status, $statusList)){
            return redirect()->back()->withErrors('errStatus', 'Error');
        }
        $order->update(['status' => $status]);
        if ($status === "Đã xác nhận"){
            Notifications::create([
                'user_id' => $order->user_id,
                'message' => "Đơn hàng có mã là {$order->order_id} của bạn đã được chúng tôi xác nhận và sẽ giao cho bạn sớm nhất."
            ]);
        }elseif ($status === "Đã giao hàng"){
            Notifications::create([
                'user_id' => $order->user_id,
                'message' => "Đơn hàng có mã {$order->order_id} của bạn đã được chúng tôi gửi đi, vui lòng kiển tra tin nhắn."
            ]);
        }
        broadcast(new OrderStatusUpdateEvent($order, $status));
        $listOrder = Order::orderBy('created_at', 'desc')->get();
        return view('admin.order.list-order', compact('listOrder'));
    }


    public function detailOrder($id){
        $detail = Order::findOrFail($id);
        $quantity = $detail->order_item->sum('quantity');
        return view('admin.order.order-item', compact('detail', 'quantity'));
    }

    public function export(){
        $filename = 'order_export_' . Carbon::now()->format('H-i-s_d-m-Y') . '.xlsx';
        return Excel::download(new OrderExport(), $filename);
    }
}
