<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\UserAddressController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::apiResource('sliders', SliderController::class)->only(['index']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

Route::apiResource('offers', OfferController::class)->only(['index', 'show']);

Route::apiResource('stores', StoreController::class)->only(['index', 'show']);

Route::apiResource('branches', BranchController::class)->only(['index']);

Route::apiResource('products', ProductController::class)->only(['index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('profile', [ProfileController::class, 'profile']);
    Route::post('profile', [ProfileController::class, 'update']);

    Route::apiResource('user-addresses', UserAddressController::class)->except(['show']);
});
