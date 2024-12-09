<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeProduct;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // sản phẩm đang sale
    // public function saleProducts()
    // {
    //     $products = Product::where('is_sale', true)
    //         ->where('is_active', true)
    //         ->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $products
    //     ]);
    // }

    // sản phẩm đang hot
    // public function hotProducts()
    // {
    //     $products = Product::where('is_hot', true)
    //         ->where('is_active', true)
    //         ->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $products
    //     ]);
    // }

    // Sản phẩm bán chạy
    // public function bestSellingProducts()
    // {
    //     $products = Product::where('sold_count', '>', 0)
    //         ->where('is_active', true)
    //         ->orderBy('sold_count', 'desc')
    //         ->take(10) // Lấy top 10 sản phẩm bán chạy
    //         ->get();

    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $products
    //     ]);
    // }


    // API để lấy danh sách sản phẩm
    public function productList($categoryId = null)
    {
        // Nếu có categoryId thì lọc theo danh mục, nếu không thì lấy tất cả sản phẩm
        if ($categoryId) {
            $listProduct = Product::with('attributeProducts')
                ->where('category_id', $categoryId)
                ->where('is_active', true)
                ->get();
        } else {
            $listProduct = Product::with('attributeProducts')
                ->where('is_active', true)
                ->get();
        }


        // Lấy top 10 sản phẩm bán chạy (sold_count > 100) và đang hoạt động
        $bestSellers = Product::getBestSellers();
        $hotProducts = Product::getHotProducts();
        // Trả về view với dữ liệu
        return view('user.product', compact('listProduct', 'hotProducts', 'bestSellers'));
    }


    // API để lấy chi tiết một sản phẩm
    public function showProduct($productId)
    {
        // Tìm sản phẩm theo ID và kèm theo các thuộc tính của sản phẩm
        $product = Product::where('product_id', $productId)
            ->with(['attributeProducts.color', 'attributeProducts.size', 'attributeProducts']) // Eager load color and size attributes
            ->firstOrFail();
        //Hiển thj sản phẩm liên quan
        $relatedProducts = Product::where('product_category_id', $product->product_category_id)
            ->where('product_id', '!=', $product->product_id) // Loại trừ sản phẩm hiện tại
            ->where('is_active', true) // Chỉ lấy sản phẩm đang hoạt động
            ->take(4) // Giới hạn 4 sản phẩm
            ->get();

        // Trả về thông tin sản phẩm dưới dạng JSON
        return view('user.detailProduct', compact('product', 'relatedProducts'));
    }
}
