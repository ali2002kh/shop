<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('recommended', [HomeController::class, 'recommended']);

Route::get('popular', [HomeController::class, 'popular']);

Route::get('newest', [HomeController::class, 'newest']);

Route::get('product/{id}', [ProductController::class, 'show']);

Route::get('categories', [HomeController::class, 'categories']);