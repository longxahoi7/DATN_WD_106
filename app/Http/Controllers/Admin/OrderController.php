<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    //
    public function home()
    {
        return view('admin.index');
    }
    // public function index()
    // {
    //     return view('admin.pages.order_management');
    //     $orders = Order::with('orderItems')->get(); // Lấy tất cả đơn hàng cùng các item
    //     return response()->json($orders);
    // }

    // Lấy chi tiết một đơn hàng
    public function showAllOrders(Request $request)
    {
        $startDate = $request->input('start_date'); // Ngày bắt đầu
        $endDate = $request->input('end_date');     // Ngày kết thúc
    
        $query = Order::with('user');
    
        if ($startDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($startDate));
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($endDate));
        }
    
        $orders = $query->orderBy('order_id', 'desc')->get();

        return view('admin.pages.order.order_management', compact('orders'));
    }

    public function showDetailOrder($orderId)
{
    $order = Order::with(['orderItems.attributeProduct.product'])->findOrFail($orderId);

    return view('admin.pages.order.orderDetail', compact('order'));
}
    //Cập nhật
    // AdminController.php

    public function updateOrderStatus(Request $request)
    {
        // Kiểm tra nếu đơn hàng tồn tại
        $order = Order::find($request->order_id);
    
        if ($order) {
            $previousStatus = $order->status; // Lưu trạng thái cũ trước khi cập nhật
    
            // Cập nhật trạng thái đơn hàng
            $order->status = $request->status;
            $order->save();
    
            // Ghi lại lịch sử thay đổi trạng thái
            OrderStatusHistory::create([
                'order_id' => $order->order_id,
                'previous_status' => $previousStatus, // Trạng thái cũ
                'new_status' => $request->status,    // Trạng thái mới
                'updated_by' => auth()->id(),        // ID người thực hiện thay đổi
            ]);
    
            // Trả về phản hồi JSON thành công
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
        }
    
        // Nếu không tìm thấy đơn hàng
        return response()->json(['success' => false, 'message' => 'Không tìm thấy đơn hàng!']);
    }
    
}