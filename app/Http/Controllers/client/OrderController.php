<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getAllOrder()
    {
        $getUser = Auth::user();
        $getOrder = Order::orderBy('created_at', 'desc')
            ->where('user_id', $getUser->user_id)->get();
        return view('client.order.list-order', compact('getOrder', 'getUser'));
    }

    public function orderDetail($id){
        $detail = Order::findOrFail($id);
        $quantity = $detail->order_item->sum('quantity');
        return view('client.order.orderDetail', compact('detail', 'quantity'));
    }

    public function trackOrder(){
        return view('client.order.track-order');
    }
}