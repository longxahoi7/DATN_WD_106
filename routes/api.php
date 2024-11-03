<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\InvoiceController;

use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::get('/invoices/{order_id}', [InvoiceController::class, 'generateInvoice']);  
//     return $request->user();
// });
// Route::post('/checkout', [ApiPaymentController::class, 'checkout']);
// Route::get('/invoice/{order_id}', [ApiPaymentController::class, 'getInvoice']);
Route::post('/register', [ApiUserController::class, 'register']);
Route::post('/login', [ApiUserController::class, 'login']);


Route::middleware('auth:sanctum')->post('/checkout', [ApiPaymentController::class, 'checkout']);
