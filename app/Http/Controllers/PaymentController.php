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
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

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
        $shippingAddress = $request->input('shipping_address');
        $phone = $request->input('phone');
        $recipients_name = $request->input('recipient_name');
    
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
        $discountAmount = 0;
        $discountCode = $request->input('discount_code'); // Lấy mã giảm giá từ form
        if ($discountCode) {
            $coupon = Coupon::where('code', $discountCode)->first();
            if ($coupon && $coupon->is_active && $coupon->is_public) {
                // Tính toán giảm giá sau khi đã cộng phí vận chuyển
                $shippingFee = 40000; // Phí vận chuyển
                $totalAfterShipping = $totalWithoutShipping + $shippingFee; // Tổng tiền sau khi cộng phí vận chuyển
                $discountAmount = $this->calculateDiscount($coupon, $totalAfterShipping);
            }
        }
        // Thêm phí vận chuyển
        $shippingFee = 40000;
        $total = $totalWithoutShipping + $shippingFee - $discountAmount; // Cập nhật tổng tiền sau khi trừ mã giảm giá
        // dd( $total);
        // Kiểm tra kết quả tính toán

        $order = Order::create([
            'user_id' => $user->user_id,
            'shipping_address' => $shippingAddress,
            'phone' => $phone,
            'total' => $total,
            'invoice_date' => now(),
            'shipping_fee' => $shippingFee,
            'status' => 'pending',
            'payment_method' => 'COD',
            'recipient_name' => $recipients_name
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
    
        $emailData = [
            'user' => $user,
            'address' => $shippingAddress,
            'phone' => $phone,
            'productDetails' => $productDetails,
            'total' => $total,
            'shippingFee' => $shippingFee
        ];
        Mail::to($user->email)->send(new OrderConfirm($emailData));
    
        // Chuyển hướng đến trang thông báo thanh toán thành công và truyền thông tin
        return redirect()->route('user.order.order-cod')->with('alert', 'Đơn hàng của bạn đã được thanh toán thành công. Cảm ơn bạn!');
    }

    private function calculateDiscount($coupon, $total)
    {
        // Kiểm tra kiểu giảm giá (theo số tiền hay phần trăm)
        if ($coupon->discount_percentage) {
            $discount = ($total * $coupon->discount_percentage) / 100;
            // Đảm bảo giảm giá không vượt quá giá trị tối đa
            return min($discount, $coupon->max_order_value);
        } elseif ($coupon->discount_amount) {
            return $coupon->discount_amount;
        }
        return 0;
    }
    
    public function applyDiscount(Request $request)
    {
        $code = $request->input('discount_code');
        $amount = $request->input('amount');
    
        // Nếu không có mã giảm giá, trả về tổng không thay đổi
        if (!$code) {
            return response()->json([
                'success' => true,
                'message' => 'Không áp dụng mã giảm giá.',
                'newTotal' => $amount,  // Trả về tổng ban đầu nếu không có mã giảm giá
            ]);
        }
    
        // Tìm mã giảm giá trong database
        $coupon = DB::table('coupons')
            ->where('code', $code)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->first();
    
        // Kiểm tra mã giảm giá có hợp lệ không
        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.',
            ]);
        }
    
        // Kiểm tra giá trị đơn hàng có đủ điều kiện áp dụng mã giảm giá không
        if ($amount < $coupon->min_order_value || $amount > $coupon->max_order_value) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá chỉ áp dụng cho đơn hàng có giá trị từ ' . 
                    number_format($coupon->min_order_value, 0, ',', '.') . 'đ đến ' . 
                    number_format($coupon->max_order_value, 0, ',', '.') . 'đ.',
            ]);
        }
    
        // Tính giá trị giảm giá
        $discount = $coupon->discount_amount ? $coupon->discount_amount : ($amount * $coupon->discount_percentage / 100);
    
            // Cập nhật số lượng mã giảm giá nếu có
        if ($coupon->quantity > 0) {
            DB::table('coupons')
                ->where('coupon_id', $coupon->coupon_id)
                ->decrement('quantity');
        }
    
        // Tính tổng mới sau khi áp dụng mã giảm giá
        $newTotal = $amount - $discount;
    
        return response()->json([
            'success' => true,
            'message' => 'Mã giảm giá đã được áp dụng thành công!',
            'discount' => $discount,
            'newTotal' => $newTotal,
        ]);
    }
    

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
        return view('user.orders.order-cod', compact('userName', 'successMessage'))->with('alert', 'Đơn hàng của bạn đã được thanh toán thành công. Cảm ơn bạn!');
    }

}
