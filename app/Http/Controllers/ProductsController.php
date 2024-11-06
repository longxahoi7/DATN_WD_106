<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // API để lấy danh sách sản phẩm
    public function productList()
    {
        $listProduct = Product::all();

        // Trả về danh sách sản phẩm dưới dạng JSON
        return response()->json([
            'products' => $listProduct
        ], 200);
    }

    // API để lấy chi tiết một sản phẩm
    public function showProduct($productId)
    {
        // Tìm sản phẩm theo ID và kèm theo các thuộc tính của sản phẩm
        $product = Product::with('attributes')->findOrFail($productId);

        // Trả về thông tin sản phẩm dưới dạng JSON
        return response()->json([
            'product' => $product
        ], 200);
    }
}
