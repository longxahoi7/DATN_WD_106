<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Mail;
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
        if (!$shoppingCart) {
            return redirect()->route('shopping-cart')->with('error', 'Giỏ hàng trống!');
        }
    
        $cartItems = $shoppingCart->cartItems;
    
        // Lấy thông tin địa chỉ giao hàng và số điện thoại từ form
        $shippingAddress = $request->input('shipping_address');  // Lấy địa chỉ giao hàng từ form
        $phone = $request->input('phone');                        // Lấy số điện thoại từ form
    
        // Tính tổng tiền đơn hàng (không bao gồm phí vận chuyển)
        $totalWithoutShipping = 0;
        $productDetails = []; // Lưu thông tin chi tiết sản phẩm
        foreach ($cartItems as $item) {
            $attributeProduct = $item->product->attributeProducts->firstWhere('size_id', $item->size_id);
            if ($attributeProduct) {
                $totalWithoutShipping += $attributeProduct->price * $item->qty;
    
                $productDetails[] = [
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'color' => $item->color->name,
                    'size' => $item->size->name,
                    'quantity' => $item->qty,
                    'price' => $attributeProduct->price,
                    'subtotal' => $attributeProduct->price * $item->qty,
                    'color_id' => $item->color_id,
                    'size_id' => $item->size_id
                ];
            }
        }
    
        // Thêm phí vận chuyển
        $shippingFee = 40000;
        $total = $totalWithoutShipping + $shippingFee;
    
        // Tạo đơn hàng mới và lưu shipping_address
        $order = Order::create([
            'user_id' => $user->user_id,
            'shipping_address' => $shippingAddress,
            'phone'  => $phone,
            'total' => $total,
            'invoice_date' => now(),
            'shipping_fee' => $shippingFee,
            'status' => 'pending',    // Trạng thái đơn hàng
        ]);
    
        // Thêm các sản phẩm vào đơn hàng
        foreach ($productDetails as $product) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $product['product_id'],
                'product_name' => $product['name'],
                'color_id' => $product['color_id'],
                'size_id' => $product['size_id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['subtotal'],
            ]);
        }
    
        // Xóa các sản phẩm trong giỏ hàng sau khi thanh toán
        $shoppingCart->cartItems()->delete();
    
        // Chuyển hướng đến trang thông báo thanh toán thành công và truyền thông tin
        return view('user.orders.order-cod', [
            'order' => $order,
            'userName' => $user->name,
            'productDetails' => $productDetails,
            'total' => $total,
            'shippingFee' => $shippingFee
        ]);
    }
    
    


    // Trang thông báo thanh toán thành công

    public function orderSuccess()
    {
        $user = Auth::user();
        $shoppingCart = ShoppingCart::where('user_id', $user->user_id)->first();
        // Xóa các sản phẩm trong giỏ hàng sau khi thanh toán
        $shoppingCart->cartItems()->delete();
        // Lấy thông tin tên người dùng từ session
        $userName = session('userName');
        $successMessage = session('success');

        // Trả về view với thông báo và tên người dùng
        return view('user.orders.order-cod', compact('userName', 'successMessage'));
    }
}
