<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\order_item;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function statistics(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $thisMonth = Carbon::now()->format('F');

        // Thống kê theo tháng
        $ordersPerMonth = [];
        $productsSoldPerMonth = [];
        $mostViewedProductData = [];
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $totalProductsSold = order_item::sum('quantity');
        $totalViews = Product::sum('views');

        for ($i = 11; $i >= 0; $i--) {
            $startOfMonth = Carbon::now()->subMonths($i)->startOfMonth();
            $endOfMonth = Carbon::now()->subMonths($i)->endOfMonth();

            $ordersPerMonth[] = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $productsSoldPerMonth[] = order_item::whereHas('order', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            })->sum('quantity');
            $mostViewedProductData[] = Product::whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                ->orderBy('views', 'desc')
                ->value('views') ?? 0;
        }

        // Thống kê cho mỗi ngày trong tuần h
        $dailyProductsSold = [];
        $dailyViews = [];
        $daysOfWeek = []; 
        $startOfWeek = Carbon::now()->startOfWeek();

        for ($i = 0; $i < 7; $i++) {
            $day = $startOfWeek->copy()->addDays($i);

            $daysOfWeek[] = $day->format('l');

            $dailyOrders[] = Order::whereDate('created_at', $day->toDateString())->count();
            $dailyProductsSold[] = order_item::whereHas('order', function ($query) use ($day) {
                $query->whereDate('created_at', $day->toDateString());
            })->sum('quantity');
            $dailyViews[] = Product::whereDate('updated_at', $day->toDateString())->sum('views');
        }

        $topSellingProduct = order_item::selectRaw('SUM(quantity) as total_sold')
            ->join('product', 'product.product_id', '=', 'order_item.product_id')
            ->groupBy('order_item.product_id')
            ->orderByDesc('total_sold')
            ->value('total_sold');
        $mostViewedProduct = Product::max('views');

        return view('admin.dashboard', [
            'ordersPerMonth' => $ordersPerMonth,
            'productsSoldPerMonth' => $productsSoldPerMonth,
            'mostViewedProductData' => $mostViewedProductData,
            'dailyOrders' => $dailyOrders,
            'dailyProductsSold' => $dailyProductsSold,
            'dailyViews' => $dailyViews,
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalProductsSold' => $totalProductsSold,
            'totalViews' => $totalViews,
            'topSellingProduct' => $topSellingProduct,
            'mostViewedProduct' => $mostViewedProduct,
            'thisMonth' => $thisMonth,
        ]);
    }
}
