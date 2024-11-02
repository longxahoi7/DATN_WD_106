<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();

        //tao gio hang
        $cart = ShoppingCart::firstOrCreate(['user_id' => $user->id]);

        //check neu san pham da co trong gio hang
        $cartItem = CartItem::where('shopping_cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();
        if($cartItem){
            $cartItem->qty += $request->input('qty',1);
        }else{
            $cartItem = new CartItem([
                'shopping_cart_id' => $cart->id,
                'product_id' => $productId,
                'qty' => $request->input('qty',1)
            ]);
        }
        $cartItem->save();
        return redirect()->back()->with('success','Đã thêm sản phẩm vào giỏ hàng!');
    }
    public function viewCart(){
        $user = Auth::user();
        $cart = ShoppingCart::where('user_id',$user->id)->with('items.product')->first();
        return view('Cart',compact('cart'));
    }
}
