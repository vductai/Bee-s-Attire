<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\order_item;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $currentMonth = Carbon::now()->month;
        $thisMonth = Carbon::now()->locale('vi')->translatedFormat('F');

        $ordersPerMonth = [];
        $revenuePerMonth = [];
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalProductsSold = order_item::sum('quantity');
        $totalViews = Product::sum('views');

        // Thống kê theo tháng trong năm
        for ($i = $currentMonth - 1; $i >= 0; $i--){
            $startOfMonth = Carbon::now()->subMonths($i)->startOfMonth();
            $endOfMonth = Carbon::now()->subMonths($i)->endOfMonth();

            $ordersPerMonth[] = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $revenuePerMonth[] = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_price');
        }

        // Thống kê mỗi ngày trong tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $dailyOrders[] = Order::whereDate('created_at', $day->toDateString())->count();
        }

        // Thống kê cho mỗi ngày trong tuần trước
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfLastWeek->copy()->addDays($i);
            $dailyOrdersLastWeek[] = Order::whereDate('created_at', $day->toDateString())->count();
        }

        $mostViewedProduct = Product::max('views');

        return view('admin.dashboard', compact(
            'ordersPerMonth', 'dailyOrders', 'dailyOrdersLastWeek', 'totalUsers',
            'totalProducts', 'totalOrders', 'totalRevenue', 'totalProductsSold',
            'totalViews', 'mostViewedProduct', 'thisMonth', 'revenuePerMonth'
        ));

    }

}
