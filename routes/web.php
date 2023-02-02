<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [HomeController::class, 'about_us'])->name('about_us');

Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('product.show');



// ------------------------------------------------------------------------ auth

Route::get('/signup_page', [AuthController::class, 'signup_page'])->name('signup_page');

Route::get('/login_page', [AuthController::class, 'login_page'])->name('login_page');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------------------------------------------------------------ profile

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// ------------------------------------------------------------------------ buying 

Route::get('/add-to-cart/{product_id}', [BuyController::class, 'add_to_cart'])->name('add_to_cart');

Route::get('/remove-from-cart/{product_id}', [BuyController::class, 'remove_from_cart'])->name('remove_from_cart');

Route::get('/cart', [BuyController::class, 'cart'])->name('cart');