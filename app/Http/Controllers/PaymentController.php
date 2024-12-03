<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Payment;
class PaymentController extends Controller
{
    //
    public function handleCodPayment(Request $request)
    {
        // Lấy thông tin đơn hàng (giả sử `order_id` được gửi từ request)
        $orderId = $request->input('order_id');
        $total = $request->input('amount'); // Số tiền thanh toán

        // Kiểm tra đơn hàng tồn tại
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Tạo một bản ghi trong bảng `payments`
        $payment = Payment::create([
            'order_id' => $order->order_id,
            'amount' => $total,
            'payment_method' => 'COD',
            'status' => 'completed', // Gán trạng thái "completed"
        ]);

        // Chuyển hướng về trang thành công
        return redirect()->route('order.success', ['order_id' => $order->order_id])
                         ->with('success', 'Payment completed successfully.');
    }
}
