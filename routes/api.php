<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Jobs\SendEmailJob;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, "indexProduct"]);

Route::post('register', [UserController::class, "register"]);
Route::post('login', [UserController::class, "login"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('add', [ProductController::class, "addProduct"]);
        Route::put('edit/{id}', [ProductController::class, "editProduct"]);
        Route::delete('delete/{id}', [ProductController::class, "deleteProduct"]);
    });

    Route::prefix('cart')->group(function () {
        Route::get('', [CartController::class, "indexCart"]);
        Route::post('add', [CartController::class, "addCart"]);
        Route::post('increase/{id}', [CartController::class, "increaseCart"]);
        Route::post('decrease/{id}', [CartController::class, "decreaseCart"]);
        Route::post('delete/{id}', [CartController::class, "deleteCart"]);
    });
    Route::prefix('order')->group(function () {
        Route::get('', [CartController::class, "indexOrder"]);
        Route::post('add', [OrderController::class, "addOrder"]);
        Route::post('pay', [OrderController::class, "payOrder"]);
        Route::post('complete', [OrderController::class, "completeOrder"]);
        Route::post('delete', [OrderController::class, "deleteOrder"]);
    });

    Route::post('logout', [UserController::class, "logout"]);
});


Route::get('/test-mail', function () {

    dispatch(new SendEmailJob("gate.mob@gmail.com", "Test", "test MSG"));
    return 'Mail sent successfully!';
});
