<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    // API để thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập với thông báo
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }
        $product = Product::findOrFail($request->product_id);

        // Kiểm tra nếu có lựa chọn màu sắc và kích thước
        $color = $request->color_id ? Color::find($request->color_id) : null;
        $size = $request->size_id ? Size::find($request->size_id) : null;


        // Tìm hoặc tạo giỏ hàng cho người dùng
        $cart = ShoppingCart::firstOrCreate([
            'user_id' => auth()->id() // Người dùng phải đăng nhập
        ]);

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng với màu sắc và kích thước đã chọn
        $cartItem = CartItem::where('shopping_cart_id', $cart->id)
            ->where('product_id', $product->product_id)
            ->where('color_id', $color ? $color->color_id : null) // Nếu có màu sắc
            ->where('size_id', $size ? $size->size_id : null)   // Nếu có kích thước
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng
            $cartItem->qty += $request->qty;
            $cartItem->save();
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            CartItem::create([
                'shopping_cart_id' => $cart->id,
                'product_id' => $product->product_id,
                'color_id' => $request->color_id,   // Nếu có màu sắc
                'size_id' => $request->size_id,       // Nếu có kích thước
                'qty' => $request->qty,
                'price' => $product->price,
            ]);
        }
        // Trả về thông báo và điều hướng về trang giỏ hàng
        return redirect()->route('user.cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    // API để xem giỏ hàng
    public function viewCart()
    {
        // Lấy ID người dùng đã đăng nhập
        $userId = Auth::id();

        // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }

        // Lấy giỏ hàng của người dùng
        $shoppingCart = ShoppingCart::where('user_id', $userId)
            ->with(['cartItems.product.attributeProducts.color', 'cartItems.product.attributeProducts.size']) // Eager load sản phẩm và thuộc tính màu sắc, kích thước
            ->first();

        // Nếu không tìm thấy giỏ hàng, trả về view với giỏ hàng rỗng
        if (!$shoppingCart) {
            return view('user.cart', [
                'cartItems' => [],
                'total' => 0,
                'discount' => 0,
                'shippingFee' => 40000, // Phí ship mặc định
                'finalTotal' => 40000, // Tổng cộng bao gồm phí ship
            ]);
        }

        // Tính tổng tiền giỏ hàng
        $totalAmount = $shoppingCart->cartItems->sum(function ($item) {
            // Lấy giá từ bảng attribute_products qua quan hệ với product
            $attributeProduct = $item->product->attributeProducts->first();
            return $item->qty * ($attributeProduct ? $attributeProduct->price : 0);
        });

        // Kiểm tra mã giảm giá nếu có
        $discount = 0;
        $couponCode = session('coupon_code'); // Lấy mã giảm giá từ session (nếu có)
        // Lấy giỏ hàng của người dùng
        $order = Order::where('user_id', auth()->id())->latest()->first();
        if ($couponCode) {
            // Áp dụng mã giảm giá nếu có
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon) {
                // Giảm giá theo tỷ lệ phần trăm hoặc giá trị cố định
                if ($coupon->type == 'percentage') {
                    $discount = ($coupon->discount / 100) * $totalAmount; // Giảm giá theo phần trăm
                } else {
                    $discount = $coupon->discount; // Giảm giá theo số tiền cố định
                }
            }
        }

        // Tổng tiền sau khi áp dụng giảm giá
        $totalAfterDiscount = $totalAmount - $discount;

        // Phí ship
        $shippingFee = 40000;

        // Tổng cộng sau khi cộng phí ship
        $finalTotal = $totalAfterDiscount + $shippingFee;

        // Trả về dữ liệu giỏ hàng
        return view('user.cart', [
            'cartItems' => $shoppingCart->cartItems,
            'total' => $totalAmount,
            'discount' => $discount,
            'shippingFee' => $shippingFee,
            'finalTotal' => $finalTotal,
            'couponCode' => $couponCode,
            'order' => $order
        ]);
    }



    public function update(Request $request, $id)
    {
        // Lấy thông tin giỏ hàng
        $cartItem = CartItem::findOrFail($id);

        // Kiểm tra xem số lượng có hợp lệ không
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        // Cập nhật số lượng
        $cartItem->qty = $request->qty;
        $cartItem->save();

        // Trở lại trang giỏ hàng với thông báo thành công
        return redirect()->route('users.cart')->with('success', 'Cập nhật giỏ hàng thành công');
    }
    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('users.cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    // CartController.php
public function viewCartPopup()
{
    // Lấy ID người dùng đã đăng nhập
    $userId = Auth::id();

    // Nếu người dùng chưa đăng nhập, trả về lỗi
    if (!$userId) {
        return response()->json(['error' => 'Vui lòng đăng nhập để xem giỏ hàng.'], 403);
    }

    // Lấy giỏ hàng của người dùng
    $shoppingCart = ShoppingCart::where('user_id', $userId)
        ->with(['cartItems.product.attributeProducts.color', 'cartItems.product.attributeProducts.size']) // Eager load sản phẩm và thuộc tính màu sắc, kích thước
        ->first();

    // Nếu không tìm thấy giỏ hàng, trả về giỏ hàng rỗng
    if (!$shoppingCart) {
        return response()->json([
            'cartItems' => [],
            'total' => 0,
            'discount' => 0,
            'shippingFee' => 40000, // Phí ship mặc định
            'finalTotal' => 40000, // Tổng cộng bao gồm phí ship
        ]);
    }

    // Tính tổng tiền giỏ hàng
    $totalAmount = $shoppingCart->cartItems->sum(function ($item) {
        // Lấy giá từ bảng attribute_products qua quan hệ với product
        $attributeProduct = $item->product->attributeProducts->first();
        return $item->qty * ($attributeProduct ? $attributeProduct->price : 0);
    });

    $order = Order::where('user_id', auth()->id())->latest()->first();

    // Trả về dữ liệu giỏ hàng dưới dạng JSON
    return response()->json([
        'cartItems' => $shoppingCart->cartItems,
        'total' => $totalAmount,
        'order' => $order
    ]);
}

}
