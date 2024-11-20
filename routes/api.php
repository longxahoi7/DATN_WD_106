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

use Spatie\FlareClient\Api;

// Route::post('register', [ApiUserController::class, 'register']);
// //  http://127.0.0.1:8000/api/login
// // Route::post('login', [ApiUserController::class, 'login']);
// Route::middleware('auth:sanctum')->group(function () {
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
                    Route::get('/list-category', [CategoryController::class, 'listCategory']);
                    Route::post('/add-category', [CategoryController::class, 'addCategory']);
                    Route::get('/detail-category/{id}', [CategoryController::class, 'detailCategory']);
                    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroyCategory']);
                    Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory']);
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
                    Route::get('/get-data', [ProductController::class, 'getData']);
                    Route::post('/add-product', [ProductController::class, 'addProduct']);
                    Route::get('/get-data-atrpro', [ProductController::class, 'getDataAtrPro']);
                    Route::put('/update-atrPro', [ProductController::class, 'updateMultipleAttributeProducts']);
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
    Route::group(
        [
            'prefix' => 'users',
            'as' => 'users.'
        ],
        function () {
            Route::group(
                [
                    'prefix' => 'products',
                    'as' => 'products.'
                ],
                function () {
                    Route::get('/list-product', [ProductsController::class, 'productList']);
                    Route::get('/show-product/{id}', [ProductsController::class, 'showProduct']);
                }
            );
            Route::group(
                [
                    'prefix' => 'cart',
                    'as' => 'cart.'
                ],
                function () {
                    Route::post('/add/{productId}', [CartController::class, 'addToCart']);
                    Route::get('/list-cart', [CartController::class, 'viewCart']);
                }
            );
            Route::group(
                [
                    'prefix' => 'payment',
                    'as' => 'payment.'
                ],
                function () {
                    Route::post('/checkout', [ApiPaymentController::class, 'checkout']);
                    Route::get('/invoices/{order_id}', [InvoiceController::class, 'generateInvoice']);
                }
            );
        }
    );
// });




// Nhóm route cho giỏ hàng
