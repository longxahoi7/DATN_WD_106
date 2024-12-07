<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    //
    public function checkoutCOD(Request $request)
    {
        // Lấy thông tin người dùng đang đăng nhập
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán!');
        }
    
        // Lấy giỏ hàng của người dùng
        $shoppingCart = ShoppingCart::where('user_id', $user->user_id)->first();
        $cartItems = $shoppingCart->cartItems;
    
        // Tính tổng tiền đơn hàng (không bao gồm phí vận chuyển)
        $totalWithoutShipping = 0;
        $productDetails = []; // Lưu thông tin chi tiết sản phẩm
        foreach ($cartItems as $item) {
            $attributeProduct = $item->product->attributeProducts->firstWhere('size_id', $item->size_id);
            if ($attributeProduct) {
                $totalWithoutShipping += $attributeProduct->price * $item->qty;
    
                $productDetails[] = [
                    'name' => $item->product->name,
                    'color' => $item->color->name,
                    'size' => $item->size->name,
                    'quantity' => $item->qty,
                    'price' => $attributeProduct->price,
                    'subtotal' => $attributeProduct->price * $item->qty
                ];
            }
        }
    
        // Thêm phí vận chuyển
        $shippingFee = 40000;
        $total = $totalWithoutShipping + $shippingFee;
    
        // Tạo bản ghi trong bảng orders
        $order = Order::create([
            'user_id' => $user->user_id,
            'order_date' => now(),
            'status' => 'pending',
            'total' => $total,
            'payment_status' => 'paid', // Thanh toán COD
        ]);
    
        // Lưu thông tin sản phẩm vào order_items
        foreach ($cartItems as $item) {
            $attributeProduct = $item->product->attributeProducts->firstWhere('size_id', $item->size_id);
    
            if ($attributeProduct) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'price' => $attributeProduct->price,
                ]);
            }
        }
    
        // Xóa các sản phẩm trong giỏ hàng sau khi thanh toán
        $shoppingCart->cartItems()->delete();
    
        // Chuyển hướng đến trang thông báo thanh toán thành công và truyền thông tin
        return view('user.orders.order-cod', [
            'userName' => $user->name,
            'productDetails' => $productDetails,
            'total' => $total,
            'shippingFee' => $shippingFee
        ]);
    }
    
    
    
    // Trang thông báo thanh toán thành công

    public function orderSuccess()
{
    // Lấy thông tin tên người dùng từ session
    $userName = session('userName');
    $successMessage = session('success');

    // Trả về view với thông báo và tên người dùng
    return view('user.orders.order-cod', compact('userName', 'successMessage'));
}
}
