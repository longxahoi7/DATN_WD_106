<?php
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use Illuminate\Support\Facades\Route;
Route::get('index', [BrandController::class, 'home']);
Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/color', [ColorController::class, 'index'])->name('color.index');
Route::get('/size', [SizeController::class, 'index'])->name('size.index');
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

// Route cho người dùng
// Route::prefix('/')->group(function () {
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('home', function () {
    return view('layouts.app');
})->name('home');

Route::get('products', function () {
    return view('user.product');
})->name('products');

Route::get('product/{id}', function ($id) {
    return view('user.product-detail', ['id' => $id]);
})->name('product.detail');

Route::get('cart', function () {
    return view('user.cart');
})->name('cart');

Route::get('checkout', function () {
    return view('user.checkout');
})->name('checkout');

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
    Route::get('orders', function () {
        return view('admin.orders.index');
    })->name('admin.orders');

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
