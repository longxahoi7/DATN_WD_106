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
        // Ensure user is authenticated
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!'
            ], 401);  // 401 Unauthorized
        }

        // Create the shopping cart if it doesn't exist
        $cart = ShoppingCart::firstOrCreate(['user_id' => $user->id]);

        // Check if the product is already in the cart
        $cartItem = CartItem::where('shopping_cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update the quantity if the item is already in the cart
            $cartItem->qty += $request->input('qty', 1);
        } else {
            // Create a new cart item
            $cartItem = new CartItem([
                'shopping_cart_id' => $cart->id,
                'product_id' => $productId,
                'qty' => $request->input('qty', 1),
            ]);
        }

        $cartItem->save();

        // Return a success response with the cart item data
        return response()->json([
            'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
            'cartItem' => $cartItem
        ], 200);
    }


    // API để xem giỏ hàng
    public function viewCart()
    {
        // Lấy ID người dùng đã đăng nhập
        $userId = Auth::id();
    
        // Kiểm tra nếu người dùng chưa đăng nhập
        // if (!$userId) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'User is not authenticated.'
        //     ], 401);
        // }
    
        // Lấy giỏ hàng của người dùng đã đăng nhập
        $shoppingCart = ShoppingCart::where('user_id', $userId)
            ->with('cartItems.product') // Eager load các sản phẩm trong giỏ hàng
            ->get(); // Lấy giỏ hàng đầu tiên (mỗi người dùng chỉ có một giỏ hàng)
    
        // Nếu không tìm thấy giỏ hàng
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'No cart found for the logged-in user.'
            ], 404);
        }
    
        // Trả về dữ liệu giỏ hàng cùng với các sản phẩm
        return response()->json([
            'success' => true,
            'cart' => $shoppingCart
        ], 200);
    }
}