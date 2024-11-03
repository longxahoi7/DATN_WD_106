<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function productList(){
        $listProduct = Product::all();
        return view('ProductList', compact('listProduct'));
    }
    public function showProduct($productId)
{
    $product = Product::with('attributes')->findOrFail($productId);

    return view('showProduct', compact('product'));
}
    
}
