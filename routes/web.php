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
        'as' => 'admin.'
    ],
    function () {
        Route::get('/dashBoard', [Dasboard::class, 'dashBoard']);
        // Thống kê
        Route::get('stats', [StatsController::class, 'index']);
        // CRUD CATẺGORY
        Route::group(
            [
                'prefix' => 'categories',
                'as' => 'categories.'
            ],
            function () {
            Route::get('/list-category', [CategoryController::class, 'listCategory'])->name('index');
            Route::post('/categories/{id}/toggle', [CategoryController::class, 'toggle'])->name('toggle');
            Route::get('/create-category', [CategoryController::class, 'createCategory'])->name('create');
            Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('store');
            Route::get('/detail-category/{id}', [CategoryController::class, 'detailCategory'])->name(name: 'detail');
            Route::delete('/delete-category/{id}', [CategoryController::class, 'destroyCategory'])->name('delete');
            Route::get('/detail-category/{id}', [CategoryController::class, 'detailCategory'])->name(name: 'detail');
            Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name(name: 'edit');
            Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name(name: 'update');
        }
        );
        // CRUD BRAND
        Route::group(
            [
                'prefix' => 'brands',
                'as' => 'brands.'
            ],
            function () {

            Route::get('/list-brand', [BrandController::class, 'listBrand'])->name('index');
            Route::post('/brands/{id}/toggle', [BrandController::class, 'toggle'])->name('toggle');
            Route::get('/create-brand', [BrandController::class, 'createBrand'])->name('create');
            Route::post('/add-brand', [BrandController::class, 'addBrand'])->name('store');
            Route::get('/detail-brand/{id}', [BrandController::class, 'detailBrand'])->name(name: 'detail');
            Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('edit');
            Route::delete('/destroy-brand/{id}', [BrandController::class, 'destroyBrand'])->name('delete');
            Route::put('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update');
        }
        );
        // CRUD color
        Route::group(
            [
                'prefix' => 'colors',
                'as' => 'colors.'
            ],
            function () {
            Route::get('/list-color', [ColorController::class, 'listColor'])->name('index');
            Route::get('/create-color', [ColorController::class, 'createColor'])->name('create');
            Route::post('/add-color', [ColorController::class, 'addColor'])->name('store');

            Route::get('/detail-color/{id}', [ColorController::class, 'detailColor'])->name(name: 'detail');
            Route::get('/edit-color/{id}', [ColorController::class, 'editColor'])->name(name: 'edit');
            Route::delete('/destroy-color/{id}', [ColorController::class, 'destroyColor'])->name(name: 'delete');
            Route::put('/update-color/{id}', [ColorController::class, 'updateColor'])->name('update');
        }
        );
        // CRUD size
        Route::group(
            [
                'prefix' => 'sizes',
                'as' => 'sizes.'
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
                'as' => 'products.'
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
            Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('update');
            ;
        }
        );
        // CRUD COUPON
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


Route::get('register', function () {
    return view('auth.register');
})->name('register');



Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('index', [BrandController::class, 'home']);

Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');

Route::get('/color', [ColorController::class, 'index'])->name('color.index');

Route::get('/size', [SizeController::class, 'index'])->name('size.index');

Route::get('/cart-list', [CartController::class, 'viewCart'])->name('users.cart');


// Route cho người dùng
// Route::prefix('/')->group(function () {
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('home', [HomeController::class, 'index'])->name('product.list');

// Route::get('product', [ProductsController::class, 'productList'])->name('product.list');

Route::get('product/{id}', [ProductsController::class, 'showProduct'])->name('product.detail');




Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');


Route::post('/checkout/cod', [PaymentController::class, 'handleCodPayment'])->name('checkout.cod');

Route::get('/order/success/{order_id}', [OrderUserController::class, 'orderSuccess'])->name('order.success');

Route::post('/vnp_payment', [PaymentVnPayController::class, 'vnp_payment'])->name('checkout.vnpay');
Route::get('/vnp_return', [PaymentVnPayController::class, 'handleVNPayCallback'])
    ->name('vnp_return');

Route::get('about', function () {
    return view('user.about');
})->name('about');
// });

// Route cho admin (cần middleware xác thực admin)
// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
Route::get('/dashboard', function () {
    return view('admin.pages.orderDetail');
})->name('admin.dashboard');
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
