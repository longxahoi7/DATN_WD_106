<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // API để thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();

        // Tạo giỏ hàng nếu chưa có
        $cart = ShoppingCart::firstOrCreate(['user_id' => $user->id]);

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
        $cartItem = CartItem::where('shopping_cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->qty += $request->input('qty', 1);
        } else {
            $cartItem = new CartItem([
                'shopping_cart_id' => $cart->id,
                'product_id' => $productId,
                'qty' => $request->input('qty', 1)
            ]);
        }
        $cartItem->save();

        // Trả về phản hồi JSON
        return response()->json([
            'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
            'cartItem' => $cartItem
        ], 200);
    }

    // API để xem giỏ hàng
    public function viewCart()
    {
        $user = Auth::user();

        // Lấy giỏ hàng của người dùng và kèm theo các sản phẩm trong giỏ hàng
        $cart = ShoppingCart::where('user_id', $user->id)
            ->with('items.product')
            ->first();

        // Trả về phản hồi JSON với giỏ hàng
        return response()->json([
            'cart' => $cart
        ], 200);
    }
}