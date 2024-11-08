<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class InvoiceController extends Controller
{
    //
    public function generateInvoice($order_id)
    {
        // Tìm đơn hàng dựa trên order_id
        $order = Order::with('orderItems')->find($order_id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng không tồn tại.',
            ], 404);
        }

        // Tạo hóa đơn (có thể bao gồm thông tin đơn hàng và các mặt hàng)
        $invoiceData = [
            'order_id' => $order->order_id,
            'order_date' => $order->order_date,
            'total' => $order->total,
            'payment_status' => $order->payment_status,
            'items' => $order->orderItems->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ];
            }),
        ];

        return response()->json([
            'success' => true,
            'invoice' => $invoiceData,
        ], 200);
    }
}
