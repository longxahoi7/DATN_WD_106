<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
        $listProduct = Product::with([
            'attributeProducts',
            'promPerProducts.promPer' => function ($query) {
                $query->where('is_active', 1);// Đợt giảm giá đang hoạt động
                    //   ->whereDate('start_date', '<=', Carbon::now()) // Đợt giảm giá đã bắt đầu
                    //   ->whereDate('end_date', '>=', Carbon::now());
                     // Đợt giảm giá chưa kết thúc
            }
        ])
        ->where('is_active', 1) // Lọc sản phẩm đang hoạt động
        ->get();
        
        // Eager load cả 'attributeProducts' từ bảng attribute_products
        // $listProduct = Product::with('attributeProducts')
        //     ->where('is_active', 1)  // Lọc sản phẩm có trạng thái is_active = 1 (sản phẩm đang hoạt động)
        //     ->get();
        $bestSellers = Product::getBestSellers();
        $hotProducts = Product::getHotProducts();
        return view('user.home', compact('listProduct', 'hotProducts', 'bestSellers'));
    }
}
