<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
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
            //CRUD CATẺGORY

        Route::group(
            [
                'prefix' => 'categories',
                'as' => 'categories.'
            ],
            function () {
                Route::get('/list-category', [CategoryController::class, 'listCategory'])->name('list-category');
                Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('add-category');
                Route::get('/detail-category/{id}', [CategoryController::class, 'detailCategory'])->name('detail-category');
                Route::delete('/delete-category/{id}', [CategoryController::class, 'destroyCategory'])->name('delete-category');
                Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update-category');
            }
        );
         //CRUD BRAND
        Route::group(
            [
                'prefix' => 'brands',
                'as' => 'brands.'
            ],
            function () {
                Route::get('/list-brand', [BrandController::class, 'listBrand']);
                Route::post('/add-brand', [BrandController::class, 'addBrand']);
                Route::get('/detail-brand/{id}', [BrandController::class, 'detailBrand']);
                Route::delete('/destroy-brand/{id}', [BrandController::class, 'destroyBrand']);
                Route::put('/update-brand/{id}', [BrandController::class, 'updateBrand']);
            }
        );
    //CRUD ATTRIBUTE
        Route::group(
            [
                'prefix' => 'attributes',
                'as' => 'attributes.'
            ],
            function () {
                Route::get('/list-attribute', [AttributeController::class, 'listAttribute']);
                Route::post('/add-attribute', [AttributeController::class, 'addAttribute']);
                Route::get('/detail-attribute/{id}', [AttributeController::class, 'detailAttribute']);
                Route::delete('/destroy-attribute/{id}', [AttributeController::class, 'destroyAttribute']);
                Route::put('/update-attribute/{id}', [AttributeController::class, 'updateAttribute']);
            }
        );
        //CRUD PRODUCT
        Route::group(
            [
                'prefix' => 'products',
                'as' => 'products.'
            ],
            function () {
                Route::get('/list-product', [ProductController::class, 'listProduct']);
                Route::post('/add-product', [ProductController::class, 'addProduct']);
                Route::get('/get-data', [ProductController::class, 'getData']);
                Route::get('/get-dataId/{id}', [ProductController::class, 'getDataId']);
                Route::get('/detail-product/{id}', [ProductController::class, 'detailProduct']);
                Route::delete('/destroy-product/{id}', [ProductController::class, 'destroyProduct']);
                Route::post('/products/{id}/restore', [ProductController::class, 'restoreProduct']); 
                Route::put('/update-product/{id}', [ProductController::class, 'updateProduct']);

            }
        );
        //CRUD COUPON
        Route::group(
            [
                'prefix' => 'coupons',
                'as' => 'coupons.'
            ],
            function () {
                Route::get('/list-coupon', [CouponController::class, 'listCoupon']);
                Route::post('/add-coupon', [CouponController::class, 'addCoupon']);
                Route::get('/detail-coupon/{id}', [CouponController::class, 'detailCoupon']);
                Route::delete('/destroy-coupon/{id}', [CouponController::class, 'destroyCoupon']);
                Route::put('/update-coupon/{id}', [CouponController::class, 'updateCoupon']);

            }
        );

    }
);

    // Route cho xuất hóa đơn
    Route::get('/invoices/{order_id}', [InvoiceController::class, 'generateInvoice']);
});
Route::get('/list-cart',      [ProductsController::class, 'productList']);
Route::get('detail/{id}',      [ProductsController::class, 'showProduct'])->name('detail');

Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('Cart');