<?php

namespace App\Http\Controllers\User;
use App\Models\Product;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function show($productId)
{
    $product = Product::with('reviews.user')->findOrFail($productId);

    $userHasPurchased = false;

    if (auth()->check()) {
        $userHasPurchased = OrderItem::whereHas('order', function ($query) {
                $query->where('user_id', auth()->id())
                      ->where('status', 'completed'); // Trạng thái đơn hàng đã hoàn tất
            })
            ->where('product_id', $productId)
            ->exists();
    }

    return view('products.show', compact('product', 'userHasPurchased'));
}

}
