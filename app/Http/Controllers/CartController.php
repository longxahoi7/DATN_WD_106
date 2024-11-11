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
        // Get the currently authenticated user
        $user = Auth::user();

        // Lấy giỏ hàng của người dùng đã đăng nhập
        $shoppingCart = ShoppingCart::where('user_id', $user->id) // Find the cart for the logged-in user
            ->with('cartItems.product') // Eager load the cart items and their associated products
            ->first(); // Get the first cart (there should be only one cart per user)

        // If no cart is found for the user
        if (!$shoppingCart) {
            return response()->json([
                'success' => false,
                'message' => 'No cart found for the logged-in user.'
            ], 404);
        }

        // Return the cart data along with the items and their associated products
        return response()->json([
            'cart' => $shoppingCart
        ], 200);
    }
}