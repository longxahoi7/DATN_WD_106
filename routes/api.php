<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AttributeProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

use Spatie\FlareClient\Api;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [ApiUserController::class, 'register']);
//  http://127.0.0.1:8000/api/login
Route::post('login', [ApiUserController::class, 'login']);
Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/list-category', [CategoryController::class, 'listCategory'])->name('api.admin.categories.list-category');
    });
});

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.'
    ],
    function () {
        Route::group(
            [
                'prefix' => 'categories',
                'as' => 'categories.'
            ],
            function () {
                // Route::get('/list-category', [CategoryController::class, 'listCategory'])->name('list-category');
                Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('add-category');
                Route::get('/detail-category/{id}', [CategoryController::class, 'detailCategory'])->name('detail-category');
                Route::delete('/delete-category/{id}', [CategoryController::class, 'destroyCategory'])->name('delete-category');
                Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update-category');
            }
        );
        Route::group(
            [
                'prefix' => 'brands',
                'as' => 'brands.'
            ],
            function () {
                Route::get('/list-brand', [BrandController::class, 'listBrand'])->name('list-brand');
                Route::post('/add-brand', [BrandController::class, 'addBrand'])->name('add-brand');
                Route::get('/detail-brand/{id}', [BrandController::class, 'detailBrand'])->name('detail-brand');
                Route::delete('/destroy-brand/{id}', [BrandController::class, 'destroyBrand'])->name('destroy-brand');
                Route::put('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update-brand');
            }
        );

        Route::group(
            [
                'prefix' => 'attributes',
                'as' => 'attributes.'
            ],
            function () {
                Route::get('/list-attribute', [AttributeController::class, 'listAttribute'])->name('list-attribute');
                Route::post('/add-attribute', [AttributeController::class, 'addAttribute'])->name('add-brand');
                Route::get('/detail-attribute/{id}', [AttributeController::class, 'detailAttribute'])->name('detail-attribute');
                Route::delete('/destroy-attribute/{id}', [AttributeController::class, 'destroyAttribute'])->name('destroy-attribute');
                Route::put('/update-attribute/{id}', [AttributeController::class, 'updateAttribute'])->name('update-attribute');
            }
        );

    }
);
Route::middleware('auth:sanctum')->group(function () {
    // Route cho thanh toán
    Route::post('/checkout', [ApiPaymentController::class, 'checkout']);

    // Route cho xuất hóa đơn
    Route::get('/invoices/{order_id}', [InvoiceController::class, 'generateInvoice']);
});
Route::get('/list-cart',      [ProductsController::class, 'productList']);
Route::get('detail/{id}',      [ProductsController::class, 'showProduct'])->name('detail');

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('Cart');