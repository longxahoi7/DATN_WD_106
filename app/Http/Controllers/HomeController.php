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
        $listProduct = Product::with('attributeProducts')->get();
        $bestSellers = Product::getBestSellers();
        $productSoldCount = Product::where('sold_count', '>', 100)
            ->where('is_active', true)
            ->orderBy('sold_count', 'desc')
            ->take(10) // Lấy top 10 sản phẩm bán chạy
            ->get();
            $hotProducts = Product::getHotProducts();
        return view('user.home', compact('listProduct','hotProducts','productSoldCount','bestSellers'));

    }
}
