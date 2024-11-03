<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\InvoiceController;

use Spatie\FlareClient\Api;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
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
                Route::get('/list-category', [CategoryController::class, 'listCategory'])->name('list-category');
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

