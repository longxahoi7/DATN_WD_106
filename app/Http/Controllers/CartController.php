<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
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
            // Thêm sản phẩm mới
            CartItem::create([
                'shopping_cart_id' => $cart->id,
                'product_id' => $product->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'qty' => $request->qty,
                'price' => $product->price, // Giá hiện tại
            ]);
        }

        return response()->json(['success' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
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
    $order = Order::where('user_id', auth()->id())->latest()->first();
    // Lấy giỏ hàng của người dùng đã đăng nhập với eager load product và attributeProduct
    $shoppingCart = ShoppingCart::where('user_id', $userId)
        ->with(['cartItems.product.attributeProducts']) // Eager load sản phẩm và attributeProducts
        ->first(); // Mỗi người dùng chỉ có một giỏ hàng

    // Nếu không tìm thấy giỏ hàng
    if (!$shoppingCart) {
        return view('user.cart', [
            'cartItems' => [],
            'total' => 0
        ]);
    }

    // Tính tổng tiền
    $totalAmount = $shoppingCart->cartItems->sum(function ($item) {
        // Lấy giá từ bảng attribute_products qua quan hệ product
        $attributeProduct = $item->product->attributeProducts->first();
        return $item->qty * ($attributeProduct ? $attributeProduct->price : 0);
    });

    // Trả dữ liệu về view
    return view('user.cart', [
        'cartItems' => $shoppingCart->cartItems,
        'total' => $totalAmount,
        'order' => $order
    ]);
}



}