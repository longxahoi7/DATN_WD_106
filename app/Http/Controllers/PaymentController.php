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
        $cartItems = $shoppingCart->cartItems;
    
        // Lấy thông tin địa chỉ và số điện thoại của người dùng
        $address = $user->address;
        $phone = $user->phone;     
    
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
    
        // Tạo dữ liệu cho email
        $emailData = [
            'user' => $user,
            'address' => $address,
            'phone' => $phone,
            'productDetails' => $productDetails,
            'total' => $total,
            'shippingFee' => $shippingFee
        ];
    
        // Gửi email
        Mail::to($user->email)->send(new OrderConfirm($emailData));
    
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
