<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// -------------------------------
// 商品一覧（PG01）
// -------------------------------
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// -------------------------------
// 商品登録（PG04）
// -------------------------------
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');

// -------------------------------
// 商品詳細（PG02）
// -------------------------------
Route::get('/products/detail/{productId}', [ProductController::class, 'show'])
    ->name('products.show');

// -------------------------------
// 商品更新（PG03）
// -------------------------------
Route::get('/products/{productId}/update', [ProductController::class, 'edit'])
    ->name('products.edit');
Route::post('/products/{productId}/update', [ProductController::class, 'update'])
    ->name('products.update');

// -------------------------------
// 商品削除（PG06）
// -------------------------------
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy'])
    ->name('products.destroy');
