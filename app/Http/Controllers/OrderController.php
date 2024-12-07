<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderHistory()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem lịch sử mua hàng.');
        }

        // Lấy danh sách đơn hàng của người dùng
        $orders = Order::where('user_id', auth()->id())
            ->with('orderItems.product') // Eager load thông tin sản phẩm
            ->orderBy('order_date', 'desc') // Sắp xếp theo ngày đặt hàng mới nhất
            ->get();

        // Trả về view danh sách đơn hàng
        return view('user.orderHistory', compact('orders'));
    }


    public function show($id)
    {
        // Lấy thông tin đơn hàng của người dùng đang đăng nhập
        $order = Order::where('order_id', $id)
            ->where('user_id', auth()->id())->with('orderItems.product')->firstOrFail();

        // Trả về view chi tiết đơn hàng
        return view('user.orders.details', compact('order'));
    }

    public function store(Request $request)
    {
        $cart = ShoppingCart::where('user_id', auth()->id())->with('cartItems')->firstOrFail();

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $cart->cartItems->sum(function ($item) {
                return $item->qty * $item->price;
            }),
            'status' => 'pending', // Trạng thái mặc định
        ]);

        // Lưu từng sản phẩm trong giỏ hàng vào chi tiết đơn hàng
        foreach ($cart->cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->price,
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        $cart->cartItems()->delete();
        $cart->delete();

        return redirect()->route('user.orders.index')->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::with('payment')->find($orderId);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        return view('user.orders.order-cod', compact('order'));
    }
    public function cancelOrder($id)
    {
        // Tìm đơn hàng
        $order = Order::findOrFail($id);

        // Kiểm tra trạng thái đơn hàng
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Chỉ có thể hủy đơn hàng trong trạng thái chờ xác nhận.');
        }

        // Cập nhật trạng thái thành 'cancelled'
        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
    }

}
