<?php

use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\StoreController;
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

Route::apiResource('sliders', SliderController::class)->only(['index']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

Route::apiResource('offers', OfferController::class)->only(['index', 'show']);

Route::apiResource('stores', StoreController::class)->only(['index', 'show']);

Route::apiResource('branches', BranchController::class)->only(['index']);

Route::apiResource('products', ProductController::class)->only(['index']);
