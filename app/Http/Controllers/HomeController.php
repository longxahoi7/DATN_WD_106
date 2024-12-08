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
        $categories = Category::get(); // Lấy danh mục cùng các danh mục con
        $productSoldCount = Product::where('sold_count', '>', 100)
            ->where('is_active', true)
            ->orderBy('sold_count', 'desc')
            ->take(10) // Lấy top 10 sản phẩm bán chạy
            ->get();
        $productHot = Product::where('is_hot',0)
            ->where('is_active', true)
            ->get();

        return view('user.home', compact('listProduct','productHot','productSoldCount','categories'));

    }
}
