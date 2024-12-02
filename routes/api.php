<?php

use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatsController;

Route::post('register', [ApiUserController::class, 'register']);
//  http://127.0.0.1:8000/api/login
Route::post('login', [ApiUserController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.'
    ],
    
    function () {
        
        //Thống kê
        Route::get('stats', [StatsController::class, 'index']);
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
        // Route::group(
        //     [
        //         'prefix' => 'stats',
        //         'as' => 'stats.'
        //     ],
        //     function () {
        //         Route::get('stats', [StatsController::class, 'index']);
        //     }
        // );
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
        //CRUD color
        Route::group(
            [
                'prefix' => 'colors',
                'as' => 'colors.'
            ],
            function () {
                Route::get('/list-color', [ColorController::class, 'listColor']);
                Route::post('/add-color', [ColorController::class, 'addColor']);
                Route::get('/detail-color/{id}', [ColorController::class, 'detailColor']);
                Route::delete('/destroy-color/{id}', [ColorController::class, 'destroyColor']);
                Route::put('/update-color/{id}', [ColorController::class, 'updateColor']);
            }
        );
        //CRUD size
        Route::group(
            [
                'prefix' => 'sizes',
                'as' => 'sizes.'
            ],
            function () {
                Route::get('/list-size', [SizeController::class, 'listSize']);
                Route::post('/add-size', [SizeController::class, 'addSize']);
                Route::get('/detail-size/{id}', [SizeController::class, 'detailSize']);
                Route::delete('/destroy-size/{id}', [SizeController::class, 'destroySize']);
                Route::put('/update-size/{id}', [SizeController::class, 'updateSize']);
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
                Route::put('/update-atrPro', [ProductController::class, 'updateMultiplecolorProducts']); //chỉnh sửa sản phẩm thuộc tính theo id 
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
        //Quản lý đơn hàng
        Route::group(
            [
                'prefix' => 'orders',
                'as' => 'orders.'
            ],
            function () {
                Route::get('/orders', [OrderController::class, 'index']);         // Lấy danh sách đơn hàng
                Route::get('/orders/{id}', [OrderController::class, 'show']);    // Lấy chi tiết đơn hàng
                Route::put('/orders/{id}', [OrderController::class, 'updateStatus']); // Cập nhật trạng thái đơn hàng
                Route::delete('/orders/{id}', [OrderController::class, 'destroy']);  // Xóa đơn hàng
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
                Route::get('/sale', [ProductController::class, 'saleProducts']);
                Route::get('/hot', [ProductController::class, 'hotProducts']);
                Route::get('/best-selling', [ProductController::class, 'bestSellingProducts']);
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
        //Bỉnh luận
        Route::group([
            'prefix' => 'comments',
            'as' => 'comments.'
        ],function () {
              // API thêm bình luận
    Route::post('/comments', [CommentController::class, 'store']);
    // API lấy bình luận theo đối tượng (ví dụ: sản phẩm)
    Route::get('/comments/{commentable_id}', [CommentController::class, 'index']);
    // API sửa bình luận
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    // API xóa bình luận
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
        });
    }
);
});




// Nhóm route cho giỏ hàng