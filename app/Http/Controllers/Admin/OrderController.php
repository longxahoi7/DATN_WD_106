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
    public function index()
    {
        return view('admin.pages.order_management');
        $orders = Order::with('orderItems')->get(); // Lấy tất cả đơn hàng cùng các item
        return response()->json($orders);
    }

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
        // Lấy thông tin order theo ID
        $order = Order::with(['user'])->findOrFail($orderId);

        // Trả về view cùng dữ liệu
        return view('admin.pages.orderDetail', compact('order'));
    }
    //Cập nhật
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,completed',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $validated['status']]);

        return response()->json($order);
    }
    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Đơn hàng đã được xóa.']);
    }
}
