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

// Route::get('/', function () {
//     // return redirect('home');
//     return view('welcome');
// });

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/about-us', [HomeController::class, 'about_us'])->name('about_us');

// Route::get('search', [HomeController::class, 'search'])->name('search');

// // ------------------------------------------------------------------------ products

// Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('product.show');

// Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Route::post('/product', [ProductController::class, 'filter'])->name('product.filter');

// Route::get('/category/{category_id}', [ProductController::class, 'category'])->name('category');

// // ------------------------------------------------------------------------ auth

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // ------------------------------------------------------------------------ profile

// Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

// Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// // ------------------------------------------------------------------------ buying 

// Route::get('/add-to-cart/{product_id}/', [BuyController::class, 'add_to_cart'])->name('add_to_cart');

// Route::get('/remove-from-cart/{product_id}', [BuyController::class, 'remove_from_cart'])->name('remove_from_cart');

// Route::get('/cart', [BuyController::class, 'cart'])->name('cart');

// Route::get('/checkout', [BuyController::class, 'checkout'])->name('checkout');

// Route::get('get-cities', [BuyController::class, 'getCities'])->name('getCities');

// Route::post('/buy', [BuyController::class, 'buy'])->name('buy');

// Route::get('/success/{order_code}', [BuyController::class, 'success'])->name('success');

// Route::get('/order/{order_code}', [BuyController::class, 'order'])->name('order.show');

// // --------------------------------------------------------------------------- admin

// Route::get('/admin', function () {
//     return redirect('admin/dashboard');
// });

// Route::get('/admin/login_page', [AdminAuthController::class, 'login_page'])->name('admin.login_page');

// Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');

// Route::get('/admin/product/delete/{product_id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');

// Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.createProduct');

// Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.storeProduct');

// Route::get('/admin/product/edit/{product_id}', [AdminController::class, 'editProduct'])->name('admin.editProduct');

// Route::post('/admin/products/update', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');