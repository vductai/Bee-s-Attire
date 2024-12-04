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
            $revenuePerMonth[] = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total_price');

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

        // Thống kê cho mỗi ngày trong tuần trước
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $day = $startOfLastWeek->copy()->addDays($i);
            $dailyOrdersLastWeek[] = Order::whereDate('created_at', $day->toDateString())->count();
        }

        $top5MostSoldProductsDetails = Product::join('order_item', 'product.product_id', '=', 'order_item.product_id')
            ->select(
                'product.*',
                DB::raw('SUM(order_item.quantity) as total_sales'),
                DB::raw('SUM(order_item.quantity * product.sale_price) as total_revenue')
            )
            ->groupBy('product.product_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();


        // Lấy 5 sản phẩm có lượt xem cao nhất
        $top5MostViewedProducts = Product::orderByDesc('views')
            ->limit(5)
            ->get();


        return view('admin.dashboard', compact(
            'ordersPerMonth',
            'dailyOrders',
            'dailyOrdersLastWeek',
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
            'ordersByStatusWeekly',
            'usersOrdersPerMonth',
            'topUsers'
        ));
    }

}
