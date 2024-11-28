<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->get(); // Lấy tất cả đơn hàng cùng các item
        return response()->json($orders);
    }

    // Lấy chi tiết một đơn hàng
    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id); // Lấy đơn hàng theo ID
        return response()->json($order);
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
