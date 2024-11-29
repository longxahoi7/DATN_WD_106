<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function products()
    {
        return view('user.product');
    }

    public function productDetail($id)
    {
        return view('user.product-detail', ['id' => $id]);
    }

    public function cart()
    {
        return view('user.cart');
    }

    public function checkout()
    {
        return view('user.checkout');
    }

    public function about()
    {
        return view('user.about');
    }
}