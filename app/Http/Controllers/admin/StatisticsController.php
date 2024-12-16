<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\order_item;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $usersOrdersPerMonth = [];
        $topUsers = [];

        for ($i = $currentMonth - 1; $i >= 0; $i--) {
            $startOfMonth = Carbon::now()->subMonths($i)->startOfMonth();
            $endOfMonth = Carbon::now()->subMonths($i)->endOfMonth();

            $ordersPerMonth[] = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $revenuePerMonth[] = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('final_price');

            // Lấy người dùng có nhiều đơn hàng nhất trong tháng
            $topUser = User::join('order', 'users.user_id', '=', 'order.user_id')
                ->whereBetween('order.created_at', [$startOfMonth, $endOfMonth])
                ->select(
                    'users.username',
                    DB::raw('COUNT(order.order_id) as total_orders')
                )
                ->groupBy('users.user_id', 'users.username')
                ->orderByDesc('total_orders')
                ->orderByRaw('MIN(order.created_at) ASC')
                ->first();

            $usersOrdersPerMonth[] = $topUser ? $topUser->total_orders : 0;
            $topUsers[] = $topUser ? $topUser->username : "Không có";

            $statuses = ['Đã xác nhận', 'Đang sử lý', 'Đã giao hàng', 'Yêu cầu huỷ đơn hàng'];
            foreach ($statuses as $status) {
                if (!isset($ordersByStatusMonthly[$status])) {
                    $ordersByStatusMonthly[$status] = [];
                }
                $ordersByStatusMonthly[$status][] = Order::where('status', $status)
                    ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                    ->count();
            }
        }

        // Lấy thông tin trạng thái đơn hàng theo tuần
        $statuses = ['Đã xác nhận', 'Đang sử lý', 'Đã giao hàng', 'Yêu cầu huỷ đơn hàng'];
        $ordersByStatusWeekly = [];
        $startOfWeek = Carbon::now()->startOfWeek();
        foreach ($statuses as $status) {
            $ordersByStatusWeekly[$status] = [];
            for ($i = 0; $i < 7; $i++) {
                $day = $startOfWeek->copy()->addDays($i);
                $ordersByStatusWeekly[$status][] = Order::where('status', $status)
                    ->whereDate('created_at', $day->toDateString())
                    ->count();
            }
        }

        // Thống kê mỗi ngày trong tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);
            $dailyOrders[] = Order::whereDate('created_at', $day->toDateString())->count();
        }

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $top5MostSoldProductsDetails = Product::join('order_item', 'product.product_id', '=', 'order_item.product_id')
            ->join('order', 'order.order_id', '=', 'order_item.order_id')
            ->where('order.status', 'Đã xác nhận')
            ->whereBetween('order_item.created_at', [$startOfMonth, $endOfMonth])
            ->select(
                'product.*',
                DB::raw('SUM(order_item.quantity) as total_sales'),
                DB::raw('SUM(order_item.quantity * product.sale_price) as total_revenue')
            )
            ->groupBy('product.product_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();

        //Top 5 người mua sản phẩm nhiều nhất
        $top5MostPurchasedUsers = User::join('order', 'users.user_id', '=', 'order.user_id')
        ->join('order_item', 'order_item.order_id', '=', 'order.order_id')
        ->whereBetween('order_item.created_at', [$startOfMonth, $endOfMonth])
        ->select(
            'users.username',
            'users.user_id',
            DB::raw('SUM(order_item.quantity) as total_purchased'),
           
        )
        ->groupBy('users.user_id', 'users.username')
        ->orderByDesc('total_purchased')
        ->limit(5)
        ->get();
    

        // Lấy 5 sản phẩm có lượt xem cao nhất
        $top5MostViewedProducts = Product::orderByDesc('views')
            ->limit(5)
            ->get();


        return view('admin.dashboard', compact(
            'ordersPerMonth',
            'dailyOrders',
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'totalProductsSold',
            'totalViews',
            'top5MostViewedProducts',
            'thisMonth',
            'revenuePerMonth',
            'top5MostSoldProductsDetails',
            'ordersByStatusMonthly',
            'usersOrdersPerMonth',
            'topUsers',
            'ordersByStatusWeekly',
            'top5MostPurchasedUsers'
        ));
    }
}
