<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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
    public function showAllOrders()
    {
        // Lấy toàn bộ orders, eager load quan hệ với bảng users
        $orders = Order::with('user')->get();

        // Trả dữ liệu về view
        return view('admin.pages.order_management', compact('orders'));
    }

    public function showDetailOrder($orderId)
{
    $order = Order::with(['orderItems.attributeProduct.product'])->findOrFail($orderId);

    return view('admin.pages.orderDetail', compact('order'));
}
    //Cập nhật
    // AdminController.php

    public function updateOrderStatus(Request $request)
    {
        // Kiểm tra nếu đơn hàng tồn tại
        $order = Order::find($request->order_id);
        
        if ($order) {
            // Cập nhật trạng thái đơn hàng
            $order->status = $request->status;
            $order->save();

            // Trả về phản hồi JSON
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
        }

        // Nếu không tìm thấy đơn hàng
        return response()->json(['success' => false, 'message' => 'Không tìm thấy đơn hàng!']);
    }



}
