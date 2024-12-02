<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        // Tổng số sản phẩm
        $totalProducts = Product::count();

        // Tổng số đơn hàng trong tuần
        $ordersThisWeek = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        // Doanh thu trong tháng
        $revenueThisMonth = Order::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                                 ->sum('total');

        // Tổng số người dùng
        $totalUsers = User::count();

        // Trả về tất cả thống kê trong một response JSON
        return response()->json([
            'totalProducts' => $totalProducts,
            'ordersThisWeek' => $ordersThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'totalUsers' => $totalUsers
        ]);
    }
}
