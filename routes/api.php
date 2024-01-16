<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post('register', [UserController::class, "register"]);
Route::post('login', [UserController::class, "login"]);
Route::post('logout', [UserController::class, "logout"]);

Route::get('/', [ProductController::class, "indexProduct"]);
Route::post('add', [ProductController::class, "addProduct"]);
Route::post('edit', [ProductController::class, "editProduct"]);
Route::post('delete', [ProductController::class, "deleteProduct"]);

Route::prefix('cart')->group(function () {
    Route::get('', [CartController::class, "indexCart"]);
    Route::post('add', [CartController::class, "addCart"]);
    Route::post('increase', [CartController::class, "increaseCart"]);
    Route::post('decrease', [CartController::class, "decreaseCart"]);
    Route::post('delete', [CartController::class, "deleteCart"]);
});
Route::prefix('order')->group(function () {
    Route::get('', [CartController::class, "indexOrder"]);
    Route::post('add', [OrderController::class, "addOrdert"]);
    Route::post('pay', [OrderController::class, "payOrder"]);
    Route::post('complete', [OrderController::class, "completeOrder"]);
    Route::post('delete', [OrderController::class, "deleteOrder"]);
});
// Route::middleware(['auth', 'sanctum'])->group(function () { });
