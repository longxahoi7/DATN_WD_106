<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\ShoppingCart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    //
    public function processCOD(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thanh toán.');
        }

        // Lấy user hiện tại
        $user = auth()->user();

        // Kiểm tra giỏ hàng
        $cartItems = $user->cartItems;
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Lưu thông tin đơn hàng
        $order = new Order();
        $order->user_id = $user->id;
        $order->total = $request->input('amount'); // Tổng tiền từ input
        $order->payment_status = 'COD';
        $order->status = 'processing'; // Trạng thái mặc định
        $order->save();

        // Lưu các sản phẩm trong giỏ hàng vào `order_items`
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->qty,
                'price' => $item->product->price,
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        // $user->cartItems()->delete();

        // Lưu ID đơn hàng vào session
        $request->session()->put('order_id', $order->id);

        // Chuyển hướng tới trang thành công
        return redirect()->route('checkout.success');
    }

    public function success(Request $request)
    {
        // Lấy ID đơn hàng từ session
        $orderId = $request->session()->get('order_id');

        // Tải thông tin đơn hàng và các mục trong đơn hàng
        $order = Order::with('items.product')->findOrFail($orderId);

        return view('checkout.success', compact('order'));
    }
}
