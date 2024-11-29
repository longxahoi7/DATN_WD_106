<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AttributeProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/sizes', function () {
    return view('size_management');
});
Route::get('/colors', function () {
    return view('color_management');
});
Route::get('/categories', function () {
    return view('category_management');
});