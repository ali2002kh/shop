<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.\,-]*');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/store-product', [AdminController::class, 'storeProduct']);

// Route::post('/admin/products/update', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');