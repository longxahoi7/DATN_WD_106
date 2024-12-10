<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Eager load cả 'attributeProducts' từ bảng attribute_products
        $listProduct = Product::with('attributeProducts')
            ->where('is_active', 1)  // Lọc sản phẩm có trạng thái is_active = 1 (sản phẩm đang hoạt động)
            ->get();
        $bestSellers = Product::getBestSellers();
        $hotProducts = Product::getHotProducts();
        return view('user.home', compact('listProduct', 'hotProducts', 'bestSellers'));
    }
}
