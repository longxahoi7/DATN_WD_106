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
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
    }
    // Lấy ID người dùng đã đăng nhập
    $userId = Auth::id();
    // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
    }

    // Lấy giỏ hàng của người dùng đã đăng nhập
    $shoppingCart = ShoppingCart::where('user_id', $userId)
        ->with('cartItems.product') // Eager load sản phẩm trong giỏ hàng
        ->first();
        dd($shoppingCart);
    // Nếu không tìm thấy giỏ hàng, trả về danh sách rỗng
    $cartItems = $shoppingCart ? $shoppingCart->cartItems : [];
    $totalAmount = $cartItems->sum(function ($item) {
        return $item->qty * $item->product->price;
    });

    return view('user.chiTietGioHang', [
        'cartItems' => $cartItems,
        'total' => $totalAmount,
        'shippingFee' => 70000 // Phí vận chuyển mặc định
    ]);
}

}