<?php

namespace App\Http\Controllers\admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\order_item;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
