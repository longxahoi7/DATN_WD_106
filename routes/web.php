<?php

use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\Dasboard;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentVnPayController;
use App\Http\Controllers\OrderController as OrderUserController;

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => ['checkAdmin:admin,manager'] // Chỉ cho phép 'admin' và 'manager' truy cập
    ],
    function () {
        Route::get('/dashBoard', [StatsController::class, 'Stats'])->name('dashboard');

        // CRUD CATEGORY - Manager chỉ được xem danh mục
        Route::group(
            [
                'prefix' => 'categories',
                'as' => 'categories.',
                'middleware' => ['checkAdmin:admin,manager'] // Manager được phép xem danh mục
            ],
            function () {
                Route::get('/list-category', [CategoryController::class, 'listCategory'])->name('index');
                Route::get('/detail-category/{id}', [CategoryController::class, 'detailCategory'])->name('detail');

                // Admin mới có quyền CRUD
                Route::middleware('checkAdmin:admin')->group(function () {
                    Route::post('/categories/{id}/toggle', [CategoryController::class, 'toggle'])->name('toggle');
                    Route::get('/create-category', [CategoryController::class, 'createCategory'])->name('create');
                    Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('store');
                    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroyCategory'])->name('delete');
                    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit');
                    Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update');
                });
            }
        );

        // CRUD BRAND
        Route::group(
            [
                'prefix' => 'brands',
                'as' => 'brands.',
                'middleware' => ['checkAdmin:admin,manager'] // Manager được phép xem nhưng không có quyền CRUD
            ],
            function () {
                Route::get('/list-brand', [BrandController::class, 'listBrand'])->name('index');
                Route::get('/detail-brand/{id}', [BrandController::class, 'detailBrand'])->name('detail');

                // Admin mới có quyền CRUD
                Route::middleware('checkAdmin:admin')->group(function () {
                    Route::post('/brands/{id}/toggle', [BrandController::class, 'toggle'])->name('toggle');
                    Route::get('/create-brand', [BrandController::class, 'createBrand'])->name('create');
                    Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('edit');
                    Route::post('/add-brand', [BrandController::class, 'addBrand'])->name('store');
                    Route::delete('/destroy-brand/{id}', [BrandController::class, 'destroyBrand'])->name('delete');
                    Route::put('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update');
                });
            }
        );

        // Các route CRUD khác (Color, Size, Product, Coupon, Order) sẽ tương tự.
        // Đảm bảo rằng chỉ 'admin' có quyền thêm, sửa, xóa, còn 'manager' chỉ được xem thông tin.

        // Ví dụ CRUD COLOR
        Route::group(
            [
                'prefix' => 'colors',
                'as' => 'colors.',
                'middleware' => ['checkAdmin:admin,manager']
            ],
            function () {
                Route::get('/list-color', [ColorController::class, 'listColor'])->name('index');
                Route::get('/detail-color/{id}', [ColorController::class, 'detailColor'])->name('detail');

                // Admin mới có quyền CRUD
                Route::middleware('checkAdmin:admin')->group(function () {
                    Route::get('/create-color', [ColorController::class, 'createColor'])->name('create');
                    Route::post('/add-color', [ColorController::class, 'addColor'])->name('store');
                    Route::get('/edit-color/{id}', [ColorController::class, 'editColor'])->name(name: 'edit');
                    Route::delete('/destroy-color/{id}', [ColorController::class, 'destroyColor'])->name('delete');
                    Route::put('/update-color/{id}', [ColorController::class, 'updateColor'])->name('update');
                });
            }
        );

        // CRUD size
        Route::group(
            [
                'prefix' => 'sizes',
                'as' => 'sizes.',
                'middleware' => ['checkAdmin:admin,manager']
            ],
            function () {
                Route::get('/list-size', [SizeController::class, 'listSize'])->name('index');

                Route::get('/create-size', [SizeController::class, 'createSize'])->name('create');
                Route::post('/add-size', [SizeController::class, 'addSize'])->name('store');
                Route::get('/detail-size/{id}', [SizeController::class, 'detailSize'])->name(name: 'detail');
                Route::get('/edit-size/{id}', [SizeController::class, 'editSize'])->name(name: 'edit');
                Route::delete('/destroy-size/{id}', [SizeController::class, 'destroySize'])->name('delete');
                Route::put('/update-size/{id}', [SizeController::class, 'updateSize'])->name('update');
            }
        );
        // CRUD PRODUCT
        Route::group(
            [
                'prefix' => 'products',
                'as' => 'products.',
                'middleware' => ['checkAdmin:admin,manager']
            ],
            function () {
                Route::get('/list-product', [ProductController::class, 'listProduct'])->name(name: 'index');
                Route::post('/product/{id}/toggle', [ProductController::class, 'toggle'])->name('toggle');
                Route::get('/get-data', [ProductController::class, 'getData'])->name('create');
                Route::post('/add-product', [ProductController::class, 'addProduct'])->name('store');
                Route::get('/get-data-atrpro/{id}', [ProductController::class, 'getDataAtrPro'])->name('getDataAtrPro');
                Route::post('/update-atrPro', [ProductController::class, 'updateAllAttributeProducts'])->name('updateAtrr');
                Route::get('/get-dataId/{id}', [ProductController::class, 'editProduct'])->name(name: 'edit');
                Route::get('/detail-product/{id}', [ProductController::class, 'detailProduct'])->name('detail');
                Route::delete('/destroy-product/{id}', [ProductController::class, 'destroyProduct'])->name('delete');
                Route::post('/products/{id}/restore', [ProductController::class, 'restoreProduct']);
                Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('update');;
            }
        );
        // CRUD COUPON
        Route::group(
            [
                'prefix' => 'coupons',
                'as' => 'coupons.',
                'middleware' => ['checkAdmin:admin,manager']
            ],
            function () {
                Route::get('/list-coupon', [CouponController::class, 'listCoupon'])->name(name: 'index');
                Route::post('/add-coupon', [CouponController::class, 'addCoupon'])->name('create');
                Route::get('/detail-coupon/{id}', [CouponController::class, 'detailCoupon'])->name('detail');
                Route::delete('/destroy-coupon/{id}', [CouponController::class, 'destroyCoupon'])->name('delete');
                Route::put('/update-coupon/{id}', [CouponController::class, 'updateCoupon'])->name(name: 'edit');
            }
        );
        //Quản lý đơn hàng
        Route::group(
            [
                'prefix' => 'orders',
                'as' => 'orders.',
                'middleware' => ['checkAdmin:admin,manager']
            ],
            function () {
                Route::get('/orders', [OrderController::class, 'index']);
                Route::get('/orders/{id}', [OrderController::class, 'show']);
                Route::put('/orders/{id}', [OrderController::class, 'updateStatus']);
                Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
            }
        );
    }
);

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(
    [
        'middleware' => ['auth'], // Chỉ cho phép người dùng đã đăng nhập
        'as' => 'user.' // Tiền tố cho các route của người dùng
    ],
    function () {
        //danh mục sản phẩm
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

        //sản phẩm
        Route::group(
            [
                'prefix' => 'product',
                'as' => 'product.',
            ],
            function () {
                Route::get('product/{id}', [ProductsController::class, 'showProduct'])->name('detail');
                Route::get('/product-list', [ProductsController::class, 'productList'])->name('list');
                Route::get('/products/{categoryId?}', [ProductController::class, 'productList'])->name('user.proincate');
                Route::get('/color', [ColorController::class, 'index'])->name('color.index');
                Route::get('/size', [SizeController::class, 'index'])->name('size.index');
                Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
            }
        );
        // Quản lý đơn hàng
        Route::group(
            [
                'prefix' => 'order',
                'as' => 'order.',
            ],
            function () {
                Route::get('/order-history', [OrderUserController::class, 'orderHistory'])->name('history');
                Route::post('/order-confirm', [OrderUserController::class, 'confirmOrder'])->name('confirm');
                Route::post('/cancel-order/{orderId}', [OrderUserController::class, 'cancelOrder'])->name('cancelOrder');
                Route::post('/checkout/cod', [PaymentController::class, 'checkoutCOD'])->name('checkoutcod');
                Route::get('order/success', [PaymentController::class, 'orderSuccess'])->name('order-cod');
            }
        );
        // Giỏ hàng
        Route::group(
            [
                'prefix' => 'cart',
                'as' => 'cart.',
            ],
            function () {
                Route::get('/cart-list', [CartController::class, 'viewCart'])->name('index');
                Route::post('/cart/add', [CartController::class, 'addToCart'])->name('add');
                Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cupdate');
                Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('remove');
                Route::get('/cart-popup', [CartController::class, 'viewCartPopup'])->name('popup');

            }
        );

    }
);

Route::post('/vnp_payment', [PaymentVnPayController::class, 'vnp_payment'])
    ->name('checkout.vnpay');

Route::get('/vnp_return', [PaymentVnPayController::class, 'handleVNPayCallback'])
    ->name('vnpay.callback');

Route::get('/payment_vnpay', function () {
    return view('user.orders.orderVNPAY');
})->name('vnp.success');
Route::get('/payment_vnpay', function () {
    return view('user.orders.orderVNPAYFailed');
})->name('vnp.failed');

Route::get('about', function () {
    return view('user.about');
})->name('about');

Route::get('/orders', [OrderController::class, 'showAllOrders'])
    ->name('admin.orders');

Route::get('/orders-detail/{id}', [OrderController::class, 'showDetailOrder'])
    ->name('admin.orderDetail');

Route::post('/admin/update-order-status', [OrderController::class, 'updateOrderStatus'])->name('admin.updateOrderStatus');






// Quản lý đơn hàng
// Route::get('orders', function () {
//     return view('admin.orders.index');
// })->name('admin.orders');






// Route::get('login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('register', function () {
//     return view('auth.register');
// })->name('register');

// // Route cho người dùng
// // Route::prefix('/')->group(function () {
//     Route::get('/', function () {
//     return redirect()->route('home');
//     });

//     Route::get('home', function () {
//         return view('layouts.app');
//     })->name('home');

//     Route::get('products', function () {
//         return view('user.product');
//     })->name('products');

//     Route::get('product/{id}', function ($id) {
//         return view('user.product-detail', ['id' => $id]);
//     })->name('product.detail');

//     Route::get('cart', function () {
//         return view('user.cart');
//     })->name('cart');

//     Route::get('checkout', function () {
//         return view('user.checkout');
//     })->name('checkout');

//     Route::get('about', function () {
//         return view('user.about');
//     })->name('about');
// // });

// // Route cho admin (cần middleware xác thực admin)
// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');

//     // Quản lý sản phẩm
//     Route::prefix('products')->group(function () {
//         Route::get('/', function () {
//             return view('admin.products.index');
//         })->name('admin.products.index');

//         Route::get('create', function () {
//             return view('admin.products.create');
//         })->name('admin.products.create');

//         Route::get('edit/{id}', function ($id) {
//             return view('admin.products.edit', ['id' => $id]);
//         })->name('admin.products.edit');

//         Route::get('categories', function () {
//             return view('admin.products.categories');
//         })->name('admin.products.categories');
//     });

//     // Quản lý đơn hàng
//     Route::get('orders', function () {
//         return view('admin.orders.index');
//     })->name('admin.orders');

//     // Quản lý mã giảm giá
//     Route::prefix('discounts')->group(function () {
//         Route::get('/', function () {
//             return view('admin.discounts.index');
//         })->name('admin.discounts.index');

//         Route::get('create', function () {
//             return view('admin.discounts.create');
//         })->name('admin.discounts.create');
//     });

//     // Quản lý tài khoản
//     Route::get('accounts', function () {
//         return view('admin.accounts.index');
//     })->name('admin.accounts');
// });

// Quản lý tài khoản
Route::get('accounts', function () {
    return view('admin.accounts.index');
})->name('admin.accounts');
// });