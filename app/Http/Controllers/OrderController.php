<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            ->orderBy('order_id', 'desc') // Sắp xếp theo ngày đặt hàng mới nhất
            ->paginate(10);
            session()->flash('alert', 'Bạn đang vào trang lịch sử mua hàng');
        // Trả về view danh sách đơn hàng
        return view('user.orders.orderHistory', compact('orders'));
    }
    public function confirmDelivery($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== auth()->id()) {
            return redirect()->route('user.order.history')->with('error', 'Vui lòng đăng nhập');
        }
        if ($order->received) {
            return redirect()->route('user.order.history')->with('info', 'Đơn hàng này đã được xác nhận.');
        }

        $order->received = true;
        $order->save();

        // Nếu người dùng đã xác nhận, cập nhật trạng thái của đơn hàng cho Admin
        if ($order->received && $order->status != 'completed') {
            $order->status = 'completed'; // Chuyển trạng thái đơn hàng thành 'completed'
            $order->save();
        }
        session()->flash('alert', 'Đã xác nhận nhận hàng thành công!');
        return redirect()->route('user.order.history')->with('alert', 'Đơn hàng đã được xác nhận nhận hàng.');
    }

    public function show($orderId)
    {
        // Lấy thông tin đơn hàng của người dùng đang đăng nhập
        $order = Order::with(['orderItems.color', 'orderItems.size'])->find($orderId);
        session()->flash('alert', 'Bạn đang vào trang chi tiết đơn hàng');
        return view('user.orders.detail', compact('order'));
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
        session()->flash('alert', 'Đặt hàng thành công!');
        return redirect()->route('user.orders.index')->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::with('payment')->find($orderId);

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }

        session()->flash('alert', 'Đặt hàng thành công!');
        return view('user.orders.order-cod', compact('order'));
    }
    public function cancelOrder($orderId)
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để hủy đơn hàng.');
        }

        // Lấy đơn hàng
        $order = Order::where('order_id', $orderId)
            ->where('user_id', auth()->id())
            ->first();


        if (!$order) {
            return redirect()->route('user.order.history')->with('error', 'Đơn hàng không tồn tại.');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('user.order.history')->with('error', 'Đơn hàng không thể hủy ở trạng thái này.');
        }

        // Cập nhật trạng thái đơn hàng thành "canceled"
        $order->update([
            'status' => 'cancelled',
        ]);

        session()->flash('alert_2', 'Đơn hàng đã được hủy thành công.');
        return redirect()->route('user.order.history');
    }
    public function confirmOrder(Request $request)
    {
        // Lấy thông tin người dùng đang đăng nhập
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán!');
        }

        // Lấy giỏ hàng của người dùng
        $shoppingCart = ShoppingCart::where('user_id', $user->user_id)->first();
        if (!$shoppingCart) {
            return redirect()->route('shopping-cart')->with('error', 'Giỏ hàng trống!');
        }

        $cartItems = $shoppingCart->cartItems;

        // Tính tổng tiền đơn hàng (không bao gồm phí vận chuyển)
        $totalWithoutShipping = 0;
        $productDetails = []; // Lưu thông tin chi tiết sản phẩm
        foreach ($cartItems as $item) {
            // Lấy thông tin sản phẩm với size_id và color_id
            $attributeProduct = $item->product->attributeProducts->firstWhere('size_id', $item->size_id);
            if ($attributeProduct) {
                $totalWithoutShipping += $attributeProduct->price * $item->qty;

                $productDetails[] = [
                    'name' => $item->product->name,
                    'img' => $item->product->main_image_url,
                    'color' => $item->color->name,  // Lấy tên màu từ quan hệ color
                    'size' => $item->size->name,    // Lấy tên size từ quan hệ size
                    'quantity' => $item->qty,
                    'price' => $attributeProduct->price,
                    'subtotal' => $attributeProduct->price * $item->qty,
                    'color_id' => $item->color_id,  // Lưu color_id
                    'size_id' => $item->size_id    // Lưu size_id
                ];
            }
        }

        // Thêm phí vận chuyển
        $shippingFee = 40000;
        $total = $totalWithoutShipping + $shippingFee;

        // Chuyển hướng đến trang thông báo thanh toán thành công và truyền thông tin
        return view('user.orders.orderConfirm', [
            'user' => $user,
            'productDetails' => $productDetails,
            'total' => $total,
            'shippingFee' => $shippingFee
        ]);
    }
    public function confirmOrderVNPay(Request $request)
    {
        // Lấy thông tin người dùng đang đăng nhập
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán!');
        }

        // Lấy giỏ hàng của người dùng
        $shoppingCart = ShoppingCart::where('user_id', $user->user_id)->first();
        if (!$shoppingCart) {
            return redirect()->route('shopping-cart')->with('error', 'Giỏ hàng trống!');
        }

        $cartItems = $shoppingCart->cartItems;

        // Tính tổng tiền đơn hàng (không bao gồm phí vận chuyển)
        $totalWithoutShipping = 0;
        $productDetails = []; // Lưu thông tin chi tiết sản phẩm
        foreach ($cartItems as $item) {
            // Lấy thông tin sản phẩm với size_id và color_id
            $attributeProduct = $item->product->attributeProducts->firstWhere('size_id', $item->size_id);
            if ($attributeProduct) {
                $totalWithoutShipping += $attributeProduct->price * $item->qty;

                $productDetails[] = [
                    'name' => $item->product->name,
                    'color' => $item->color->name,  // Lấy tên màu từ quan hệ color
                    'size' => $item->size->name,    // Lấy tên size từ quan hệ size
                    'quantity' => $item->qty,
                    'price' => $attributeProduct->price,
                    'subtotal' => $attributeProduct->price * $item->qty,
                    'color_id' => $item->color_id,  // Lưu color_id
                    'size_id' => $item->size_id    // Lưu size_id
                ];
            }
        }

        // Thêm phí vận chuyển
        $shippingFee = 40000;
        $total = $totalWithoutShipping + $shippingFee;

        // Chuyển hướng đến trang thông báo thanh toán thành công và truyền thông tin
        return view('user.orders.orderConfirmVNPay', [
            'user' => $user,
            'productDetails' => $productDetails,
            'total' => $total,
            'shippingFee' => $shippingFee
        ]);
    }

}
