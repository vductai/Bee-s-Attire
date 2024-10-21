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
}
