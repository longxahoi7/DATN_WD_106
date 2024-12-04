<?php
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentVnPayController;
use App\Http\Controllers\OrderController;


Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Auth::routes();
Route::get('index', [BrandController::class, 'home']);
Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/color', [ColorController::class, 'index'])->name('color.index');
Route::get('/size', [SizeController::class, 'index'])->name('size.index');

Route::get('/cart-list', [CartController::class, 'viewCart'])->name('users.cart');


// Route cho người dùng
// Route::prefix('/')->group(function () {
Route::get('/', [ProductsController::class, 'productList'])->name('product.list');

Route::get('home', [ProductsController::class, 'productList'])->name('product.list');
Route::get('products', function () {
    return view('user.product');
})->name('products');

Route::get('product/{id}', function ($id) {
    return view('user.product-detail', ['id' => $id]);
})->name('product.detail');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
Route::post('/checkout/cod', [PaymentController::class, 'handleCodPayment'])->name('checkout.cod');
Route::get('/order/success/{order_id}', [OrderController::class, 'orderSuccess'])
            ->name('order.success');
Route::post('/vnp_payment', [PaymentVnPayController::class, 'vnp_payment'])
            ->name('checkout.vnpay');

Route::get('about', function () {
    return view('user.about');
})->name('about');
// });

// Route cho admin (cần middleware xác thực admin)
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Quản lý sản phẩm
    Route::prefix('products')->group(function () {
        Route::get('/', function () {
            return view('admin.products.index');
        })->name('admin.products.index');

        Route::get('create', function () {
            return view('admin.products.create');
        })->name('admin.products.create');

        Route::get('edit/{id}', function ($id) {
            return view('admin.products.edit', ['id' => $id]);
        })->name('admin.products.edit');

        Route::get('categories', function () {
            return view('admin.products.categories');
        })->name('admin.products.categories');
    });

    // Quản lý đơn hàng
    // Route::get('orders', function () {
    //     return view('admin.orders.index');
    // })->name('admin.orders');

    // Quản lý mã giảm giá
    Route::prefix('discounts')->group(function () {
        Route::get('/', function () {
            return view('admin.discounts.index');
        })->name('admin.discounts.index');

        Route::get('create', function () {
            return view('admin.discounts.create');
        })->name('admin.discounts.create');
    });

    // Quản lý tài khoản
    Route::get('accounts', function () {
        return view('admin.accounts.index');
    })->name('admin.accounts');
});