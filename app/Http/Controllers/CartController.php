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
        $userId = auth()->id(); // Lấy ID của người dùng đang đăng nhập

        if (!$userId) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Thêm sản phẩm vào giỏ hàng với user_id đã xác định
        $cart = ShoppingCart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $request->input('quantity', 1),
        ]);

        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart' => $cart
        ], 201);
    }


    // API để xem giỏ hàng
    public function viewCart()
    {
        // Lấy ID người dùng đã đăng nhập
        //$userId = Auth::id();

        // Kiểm tra nếu người dùng chưa đăng nhập
        // if (!$userId) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'User is not authenticated.'
        //     ], 401);
        // }

        // Lấy giỏ hàng của người dùng đã đăng nhập
        $shoppingCart = ShoppingCart::where('user_id', 1)
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