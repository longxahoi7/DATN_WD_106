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
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'color_id' => 'nullable|exists:colors,color_id',
            'size_id' => 'nullable|exists:sizes,size_id',
            'qty' => 'required|integer|min:1'
        ]);

        // Lấy thông tin sản phẩm
        $product = Product::findOrFail($request->product_id);

        // Tìm hoặc tạo giỏ hàng cho người dùng
        $cart = ShoppingCart::firstOrCreate([
            'user_id' => auth()->id() // Người dùng phải đăng nhập
        ]);

        // Kiểm tra nếu sản phẩm đã tồn tại trong giỏ hàng
        $cartItem = CartItem::where('shopping_cart_id', $cart->id)
            ->where('product_id', $product->product_id)

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
                'price' => $product->price,
            ]);
        }

        // Điều hướng về trang giỏ hàng
        return redirect()->route('users.cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
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
        $order = Order::where('user_id', auth()->id())->latest()->first();

        $shoppingCart = ShoppingCart::where('user_id', $userId)
            ->with(['cartItems.product.attributeProducts.color', 'cartItems.product.attributeProducts.size']) // Eager load sản phẩm và thuộc tính màu sắc, kích thước
            ->first();

        // Nếu không tìm thấy giỏ hàng, trả về view với giỏ hàng rỗng
        if (!$shoppingCart) {
            return view('user.cart', [
                'cartItems' => [],
                'total' => 0,
            ]);
        }

        // Tính tổng tiền giỏ hàng
        $totalAmount = $shoppingCart->cartItems->sum(function ($item) {
            // Lấy giá từ bảng attribute_products qua quan hệ với product
            $attributeProduct = $item->product->attributeProducts->first();
            return $item->qty * ($attributeProduct ? $attributeProduct->price : 0);
        });

        // Trả về dữ liệu giỏ hàng
        return view('user.cart', [
            'cartItems' => $shoppingCart->cartItems,
            'total' => $totalAmount,
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

        return redirect()->route('user.cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}
