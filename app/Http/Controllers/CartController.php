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
    public function addToCart(Request $request)
{
    // Lấy thông tin sản phẩm
    $product = Product::findOrFail($request->product_id);

    // Tìm hoặc tạo giỏ hàng cho người dùng
    $cart = ShoppingCart::firstOrCreate([
        'user_id' => auth()->id() // Nếu người dùng đã đăng nhập
    ]);

    // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
    $cartItem = CartItem::where('shopping_cart_id', $cart->id)
        ->where('product_id', $product->product_id)
        ->where('color_id', $request->color_id)
        ->where('size_id', $request->size_id)
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
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'qty' => $request->qty,
            'price' => $product->price, // Giá hiện tại của sản phẩm
        ]);
    }

    // Lấy tất cả sản phẩm trong giỏ hàng và tính tổng giá trị
    $cartItems = CartItem::where('shopping_cart_id', $cart->id)->get();
    $total = $cartItems->sum(function ($item) {
        return $item->qty * $item->price;
    });

    // Trả về view giỏ hàng với thông tin cập nhật
    return view('user.cart', [
        'cartItems' => $cartItems,
        'total' => $total
    ]);
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