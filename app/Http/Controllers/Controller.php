<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShoppingCart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        // Eager load cả 'attributeProducts' từ bảng attribute_products
     
        $categories = Category::get(); // Lấy danh mục cùng các danh mục con
      
        return view('user.home', compact('categories'));
    }
    
}
