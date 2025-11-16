<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// -------------------------------
// 商品一覧（PG01）
// -------------------------------
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// -------------------------------
// 商品登録（PG04）
// -------------------------------
Route::get('/products/register', [ProductController::class, 'create'])
    ->name('products.create');
Route::post('/products/register', [ProductController::class, 'store'])
    ->name('products.store');

// -------------------------------
// 商品詳細 + 商品編集（PG02 + PG03 統合）
//   ※ show() 削除 → edit() に統合
// -------------------------------
Route::get('/products/{productId}', [ProductController::class, 'edit'])
    ->name('products.edit');

// 更新処理（POST のまま使用）
Route::post('/products/{productId}', [ProductController::class, 'update'])
    ->name('products.update');

// -------------------------------
// 商品削除（PG06）
// -------------------------------
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy'])
    ->name('products.destroy');
