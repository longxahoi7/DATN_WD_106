<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        // Lấy ngày bắt đầu và ngày kết thúc từ form
        $startDate = $request->input('start_date', Carbon::now()->subDays(6)->toDateString()); // Mặc định là 7 ngày trước
        $endDate = $request->input('end_date', Carbon::now()->toDateString()); // Mặc định là ngày hôm nay

        // Thống kê theo ngày trong khoảng thời gian được chọn
        $dailyStats = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total_orders, SUM(total) as revenue')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dailyLabels = $dailyStats->pluck('date');
        $dailyOrders = $dailyStats->pluck('total_orders');
        $dailyRevenue = $dailyStats->pluck('revenue');

        // Thống kê theo tháng trong năm hiện tại (có thể mở rộng theo nhu cầu)
        $monthlyStats = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total_orders, SUM(total) as revenue')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyLabels = $monthlyStats->pluck('month')->map(function ($month) {
            return 'Tháng ' . $month;
        });
        $monthlyOrders = $monthlyStats->pluck('total_orders');
        $monthlyRevenue = $monthlyStats->pluck('revenue');

         // Lấy tất cả các danh mục và số lượng sản phẩm của từng danh mục
         $categories = Category::withCount('products')->get();

        // Trả dữ liệu về view
        return view('stats.index', compact(
            'dailyLabels',
            'dailyOrders',
            'dailyRevenue',
            'monthlyLabels',
            'monthlyOrders',
            'monthlyRevenue',
            'categories'
        ));
    }
}
