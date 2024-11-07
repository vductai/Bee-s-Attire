<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\order_item;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $currentMonth = Carbon::now()->month;
    
        $thisMonth = Carbon::now()->format('F');
    
        $ordersPerMonth = [];
        $productsSoldPerMonth = [];
        $viewsPerMonth = [];
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
            $viewsPerMonth[] = Product::whereBetween('updated_at', [$startOfMonth, $endOfMonth])->sum('views');
            
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
            'viewsPerMonth' => $viewsPerMonth,
            'topSellingProduct' => $topSellingProduct,
            'mostViewedProduct' => $mostViewedProduct,
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalProductsSold' => $totalProductsSold,
            'totalViews' => $totalViews,
            'thisMonth' => $thisMonth,
        ]);
    }
    
}
